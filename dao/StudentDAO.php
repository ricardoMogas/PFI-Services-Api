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

$studentDAO = new StudentDAO();

$updatedStudent = new Student();
$updatedStudent->registration = " "; // El número de registro del estudiante que deseas actualizar
$updatedStudent->name = " "; // Nuevo nombre
$updatedStudent->p_last_name = " "; // Nuevo primer apellido
$updatedStudent->m_last_name = " "; // Nuevo segundo apellido
$updatedStudent->gender = " "; // Nuevo género
$updatedStudent->birthday_date = " "; // Nueva fecha de nacimiento
$updatedStudent->ethnicity = " "; // Nueva etnia
$updatedStudent->date_of_registration = " "; // Nueva fecha de registro

$updated = $studentDAO->updateStudent($updatedStudent);

if ($updated) {
    echo "Student updated successfully.";
} else {
    echo "Failed to update student.";
}

public function deleteStudent($registrationNumber)
{
    $query = "DELETE FROM students WHERE registration = :registration";
    $params = array(':registration' => $registrationNumber);
    $success = $this->executeQuery($query, $params);
    return $success;
}

$studentDAO = new StudentDAO();

$registrationNumberToDelete = " "; // Número de registro del estudiante a eliminar

$deleted = $studentDAO->deleteStudent($registrationNumberToDelete);

if ($deleted) {
    echo "Student deleted successfully.";
} else {
    echo "Failed to delete student.";
}
