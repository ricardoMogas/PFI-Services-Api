<?php

require_once(__DIR__ . '/../core/conexionDB.php');
require_once(__DIR__ . "/../core/responseData.class.php");
require_once(__DIR__ . "/../models/Student.php");

final class StudentDAO extends ConexionDB 
{

        public function __construct()
    {
        parent::__construct();
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

    public function selectStudentByRegistration($registrationNumber)
    {
        $query = "SELECT * FROM students WHERE registration = :registration";
        $params = array(':registration' => $registrationNumber);
        $result = $this->getData($query, $params);
    
        if ($result) {
            $row = $result[0];
            $student = new Student();
            $student->registration = $row["registration"];
            $student->name = $row["name"];
            $student->p_last_name = $row["p_last_name"];
            $student->m_last_name = $row["m_last_name"];
            $student->gender = $row["gender"];
            $student->birthday_date = $row["birthday_date"];
            $student->ethnicity = $row["origin_place"];
            $student->date_of_registration = $row["date_of_registration"];
            return $student;
        } else {
            return null; 
        }
    }

    public function insertStudent($student)
    {
        $query = "INSERT INTO students (registration, name, p_last_name, m_last_name, gender, birthday_date, origin_place, date_of_registration) 
                  VALUES (:registration, :name, :p_last_name, :m_last_name, :gender, :birthday_date, :origin_place, :date_of_registration)";
        $params = array(
            ':registration' => $student->registration,
            ':name' => $student->name,
            ':p_last_name' => $student->p_last_name,
            ':m_last_name' => $student->m_last_name,
            ':gender' => $student->gender,
            ':birthday_date' => $student->birthday_date,
            ':origin_place' => $student->ethnicity,
            ':date_of_registration' => $student->date_of_registration
        );
        $success = $this->executeQuery($query, $params);
        return $success;
    }
    
    public function updateStudent($student)
    {
        $query = "UPDATE students SET name = :name, p_last_name = :p_last_name, m_last_name = :m_last_name, gender = :gender, birthday_date = :birthday_date, origin_place = :origin_place, date_of_registration = :date_of_registration WHERE registration = :registration";
        $params = array(
            ':name' => $student->name,
            ':p_last_name' => $student->p_last_name,
            ':m_last_name' => $student->m_last_name,
            ':gender' => $student->gender,
            ':birthday_date' => $student->birthday_date,
            ':origin_place' => $student->ethnicity,
            ':date_of_registration' => $student->date_of_registration,
            ':registration' => $student->registration
        );
        $success = $this->executeQuery($query, $params);
        return $success;
    }
    
    public function deleteStudent($registrationNumber)
    {
        $query = "DELETE FROM students WHERE registration = :registration";
        $params = array(':registration' => $registrationNumber);
        $success = $this->executeQuery($query, $params);
        return $success;
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
// Ejemplo de uso GetAllWithPagination
/*
$studentDAO = new StudentDAO();
$students = $studentDAO->GetAllWithPagination(2, 5);
foreach ($students as $key => $student) {
    echo "$key: {$student->name}\n";
}
*/

// Ejemplo de uso GetAll
/*
$studentDAO = new StudentDAO();
$students = $studentDAO->GetAll();
foreach ($students as $key => $student) {
    echo "$key: {$student->name} : {$student-> p_last_name} : {$student-> status} : {$student-> birthday_date}\n";
}
*/
/* ejemplo de SELECT */
/*
    $querySelect = "SELECT * FROM usuarios WHERE id = 1";
    $resultadoSelect = $conexionDB->getData($querySelect);
    print_r($resultadoSelect);
*/

/* ejemplo de INSERT */
/*
    $nombre = "Juan";
    $email = "juan@example.com";
    $queryInsert = "INSERT INTO usuarios (nombre, email) VALUES (?, ?)";
    $insertId = $conexionDB->insertDataId($queryInsert, [$nombre, $email]);
*/

/* ejemplo de UPDATE */
/*
    $nuevoNombre = "Pedro";
    $idActualizar = 2;
    $queryUpdate = "UPDATE usuarios SET nombre = ? WHERE id = ?";
    $conexionDB->updateData($queryUpdate, [$nuevoNombre, $idActualizar]);
*/
/* ejemplo de DELETE */
/*
    $idEliminar = 3;
    $queryDelete = "DELETE FROM usuarios WHERE id = ?";
    $conexionDB->deleteData($queryDelete, [$idEliminar]);
*/