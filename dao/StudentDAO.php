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
            $student->registration = $row["registration"];
            $student->name = $row["name"];
            $student->p_last_name = $row["p_last_name"];
            $student->m_last_name = $row["m_last_name"];
            $student->gender = $row["gender"];
            $student->birthday_date = $row["birthday_date"];
            $student->ethnicity = $row["origin_place"];
            $student->date_of_registration = $row["date_of_registration"];
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
            $student->registration = $row["registration"];
            $student->name = $row["name"];
            $student->p_last_name = $row["p_last_name"];
            $student->m_last_name = $row["m_last_name"];
            $student->gender = $row["gender"];
            $student->birthday_date = $row["birthday_date"];
            $student->ethnicity = $row["origin_place"];
            $student->date_of_registration = $row["date_of_registration"];
            $students[] = $student;
        }
        return $students;
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
    echo "$key: {$student->name}\n";
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