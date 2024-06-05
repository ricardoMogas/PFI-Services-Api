<?php

require_once(__DIR__ . '/../core/conexionDB.php');
require_once(__DIR__ . "/../models/Student.php");

final class StudentDAO extends ConexionDB
{

    public function __construct()
    {
        parent::__construct();
    }

    public function GetOne($registration)
    {
        $query = "SELECT * FROM students WHERE registration = $registration";
        $result = $this->getData($query);
        if (count($result) == 0) {
            return false;
        }
        $student = new Student();
        foreach ($result[0] as $key => $value) {
            $student->$key = $value;
        }
        return $student;
    }

    public function GetAll()
    {
        $query = "SELECT * FROM students";
        $result = $this->getData($query);
        $students = [];
        foreach ($result as $row) {
            $student = new Student();
            foreach ($row as $key => $value) {
                $student->$key = $value;
            }
            $students[] = $student;
        }
        return $students;
    }

    public function GetAllWithPagination($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM students LIMIT $offset, $perPage";
        $result = $this->getData($query);
        $students = [];
        foreach ($result as $row) {
            $student = new Student();
            foreach ($row as $key => $value) {
                $student->$key = $value;
            }
            $students[] = $student;
        }
        return $students;
    }
    public function GetTotalStudents()
    {
        $query = "SELECT COUNT(*) as total FROM students";
        $result = $this->getData($query);
        return $result[0]['total'];
    }

    public function SearchStudent(
        $page = 1,
        $perPage = 10,
        $registration = null,
        $name = null,
        $p_last_name = null,
        $m_last_name = null,
        $gender = null,
        $birthday_date = null,
        $ethnicity = null,
        $career = null,
        $status = null,
        $origin_place = null,
        $date_of_registration = null
    ) {
        $query = "SELECT * FROM students WHERE 1"; // Comienza con una consulta básica

        // Construye la consulta SQL y los parámetros según los datos proporcionados
        if ($registration !== null) {
            $query .= " AND registration LIKE '%$registration%'";
        }
        if ($name !== null) {
            $query .= " AND name LIKE '%$name%'";
        }
        if ($p_last_name !== null) {
            $query .= " AND p_last_name LIKE '%$p_last_name%'";
        }
        if ($m_last_name !== null) {
            $query .= " AND m_last_name LIKE '%$m_last_name%'";
        }
        if ($gender !== null) {
            $query .= " AND gender LIKE '%$gender%'";
        }
        if ($birthday_date !== null) {
            $query .= " AND birthday_date LIKE '%$birthday_date%'";
        }
        if ($ethnicity !== null) {
            $query .= " AND ethnicity LIKE '%$ethnicity%'";
        }
        if ($career !== null) {
            $query .= " AND career LIKE '%$career%'";
        }
        if ($status !== null) {
            $query .= " AND status LIKE '%$status%'";
        }
        if ($origin_place !== null) {
            $query .= " AND origin_place LIKE '%$origin_place%'";
        }
        if ($date_of_registration !== null) {
            $query .= " AND date_of_registration <= '%$date_of_registration%'";
        }
        if ($page !== null && $perPage !== null) {
            $offset = ($page - 1) * $perPage;
            $query .= " LIMIT $offset, $perPage";
        } else {
            return "no hagas eso bro";
        }
        return $this->getData($query);
    }

    public function InsertStudent($student)
    {
        $valid = true;
        $requiredFields = ['registration', 'name', 'gender', 'birthday_date', 'ethnicity', 'career', 'status', 'origin_place', 'date_of_registration'];

        $query = "SELECT registration FROM students WHERE registration = $student->registration";
        $result = $this->getData($query);

        if (count($result) > 0) {
            return "Ya existe un estudiante con esa matrícula";
        }

        foreach ($requiredFields as $field) {
            if (!isset($student->$field) || empty($student->$field)) {
                $valid = false;
                break;
            }
        }
        if ($valid) {
            // All values are not null and registration is a number
            $query = "INSERT INTO `students` (`registration`, `name`, `p_last_name`, `m_last_name`, `gender`, `birthday_date`, `ethnicity`, `career`, `status`, `origin_place`, `date_of_registration`)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $params = [
                $student->registration,
                strtoupper($student->name),
                $student->p_last_name,
                $student->m_last_name,
                $student->gender,
                $student->birthday_date,
                $student->ethnicity,
                $student->career,
                $student->status,
                $student->origin_place,
                $student->date_of_registration
            ];
            $success = $this->insertData($query, $params);
            return $success;
        } else {
            // Invalid student object
            return false;
        }
    }

    public function UpdateStudent($student)
    {
        // All required fields are not null
        // Construct the SQL query for updating the student record
        $query = "UPDATE `students` SET `name`=?, `p_last_name`=?, `m_last_name`=?, `gender`=?, `birthday_date`=?, `ethnicity`=?, `career`=?, `status`=?, `origin_place`=?, `date_of_registration`=? WHERE `registration`=?";

        
        // Set the parameters for the prepared statement
        $params = [
            $student->name,
            $student->p_last_name,
            $student->m_last_name,
            $student->gender,
            $student->birthday_date,
            $student->ethnicity,
            $student->career,
            $student->status,
            $student->origin_place,
            $student->date_of_registration,
            $student->registration // Assuming 'registration' is the unique identifier for the student
        ];

        // Call the updateData() method to execute the query
        $success = $this->updateData($query, $params);
        return $success;
    }

    public function DeleteStudent($registration)
    {
        $sqlStudent = "SELECT * FROM students WHERE registration = $registration";
        $result = $this->getData($sqlStudent);
        if (count($result) == 0) {
            return "No existe el estudiante";
        }
        // Verificar si la matrícula no está vacía
        if (!empty($registration)) {
            // Construir la consulta SQL de eliminación para eliminar el estudiante con la matrícula proporcionada
            $sql = "DELETE FROM students WHERE registration = ?";
            $params = [$registration];

            try {
                // Llamar a la función deleteData() para ejecutar la consulta
                $this->deleteData($sql, $params);
                return true; // Si se ejecuta sin errores, el estudiante se eliminó correctamente
            } catch (Exception $e) {
                // Capturar cualquier excepción y devolver false si ocurre algún error
                return false;
            }
        } else {
            // La matrícula está vacía
            return false;
        }
    }

    public function usageExample()
    {
        // Operación de obtener todos los estudiantes
        $students = $this->getAll();
        foreach ($students as $student) {
            echo "Registration: " . $student->registration . "<br>";
            echo "Name: " . $student->name . "<br>";
            echo "First Last Name: " . $student->p_last_name . "<br>";
            echo "Second Last Name: " . $student->m_last_name . "<br>";
            echo "Gender: " . $student->gender . "<br>";
            echo "Birthday Date: " . $student->birthday_date . "<br>";
            echo "Ethnicity: " . $student->ethnicity . "<br>";
            echo "Date of Registration: " . $student->date_of_registration . "<br><br>";
        }

        $updatedStudent = new Student();
        $updatedStudent->registration = "123456"; // El número de registro del estudiante que deseas actualizar
        $updatedStudent->name = "Nuevo Nombre";
        $updatedStudent->p_last_name = "Nuevo Apellido";
        $updatedStudent->m_last_name = "Nuevo Apellido";
        $updatedStudent->gender = "Femenino";
        $updatedStudent->birthday_date = "1990-01-01";
        $updatedStudent->ethnicity = "Nueva Etnia";
        $updatedStudent->date_of_registration = "2024-01-01";

        $updated = $this->updateStudent($updatedStudent);

        if ($updated) {
            echo "Student updated successfully.";
        } else {
            echo "Failed to update student.";
        }

        $registrationNumberToDelete = "123456"; // Número de registro del estudiante a eliminar

        $deleted = $this->deleteStudent($registrationNumberToDelete);

        if ($deleted) {
            echo "Student deleted successfully.";
        } else {
            echo "Failed to delete student.";
        }
    }
}
// USE EXAMPLE SearchStudent
// $name, $p_last_name, $m_last_name, $gender, $birthday_date, $ethnicity, $career, $status, $origin_place, $date_of_registration
/*
$studentDAO = new StudentDAO();
$student = $studentDAO->SearchStudent(null, null, null, null, null, null, null, null, "Campeche", null);
foreach ($student as $key => $student) {
    echo "$key: {$student['name']} : {$student['p_last_name']} : {$student['status']} : {$student['birthday_date']}\n";
}
*/

//USE EXAMPLE DeleteStudent
/*
$studentDAO = new StudentDAO();
$success = $studentDAO->DeleteStudent("11111");
echo $success ? "Student deleted successfully." : "Failed to delete student.";
*/
// USE EXAMPLE UpdateStudent
/*
$studentDAO = new StudentDAO();
$student = new Student();
$student->name = "testawa";
$student->p_last_name = "test2";
$student->m_last_name = "test2";
$student->gender = "Hombre";
$student->birthday_date = "1990-01-01";
$student->ethnicity = "Otro";
$student->career = "ISC";
$student->status = "Activo";
$student->origin_place = "Campeche";
$student->date_of_registration = "2024-04-11";
$student->registration = 0;
$success = $studentDAO->UpdateStudent($student);
echo $success ? "Student updated successfully." : "Failed to update student.";
*/

// USE EXAMPLE InsertStudent
/*
$studentDAO = new StudentDAO();
$student = new Student();
$student->registration = 123452;
$student->name = "Juan";
$student->p_last_name = "Pérez";
$student->m_last_name = "Gómez";
$student->gender = "Hombre";
$student->birthday_date = "1990-01-01";
$student->ethnicity = "Otro";
$student->career = "ISC";
$student->status = "Activo";
$student->origin_place = "Campeche";
$student->date_of_registration = "2024-04-11";
$success = $studentDAO->InsertStudent($student);
echo $success ? "Student inserted successfully." : "Failed to insert student.";
*/

// USE EXAMPLE GetAllWithPagination
/*
$studentDAO = new StudentDAO();
$students = $studentDAO->GetAllWithPagination(2, 5);
foreach ($students as $key => $student) {
    echo "$key: {$student->name}\n";
}
*/

// USE EXAMPLE GetAll
/*
$studentDAO = new StudentDAO();
$students = $studentDAO->GetAll();
foreach ($students as $key => $student) {
    echo "$key: {$student->name} : {$student-> p_last_name} : {$student-> status} : {$student-> birthday_date}\n";
}
*/
