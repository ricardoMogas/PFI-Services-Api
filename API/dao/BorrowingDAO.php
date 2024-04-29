<?php
require_once(__DIR__ . "/../core/conexionDB.php");
require_once(__DIR__ . "/../models/Borrowing.php");
require_once(__DIR__ . "/../models/TypeBorrowing.php");
class BorrowingDAO extends ConexionDB {
    public function __construct()
    {
        parent::__construct();
    }

    public function GetAll()
    {
        $query = "SELECT * FROM borrowing";
        $result = $this->getData($query);
        $borrowings = array();
        foreach ($result as $row) {
            $borrowing = new Borrowing();
            foreach ($row as $key => $value) {
                $borrowing->$key = $value;
            }
            $borrowings[] = $borrowing;
        }
        return $borrowings;
    }
    
    public function GetAllWithPagination($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM borrowing LIMIT $offset, $perPage";
        $result = $this->getData($query);
        $borrowings = array();
        foreach ($result as $row) {
            $borrowing = new Borrowing();
            foreach ($row as $key => $value) {
                $borrowing->$key = $value;
            }
            $borrowings[] = $borrowing;
        }
        return $borrowings;
    }

    public function GetOne($id)
    {
        $query = "SELECT * FROM borrowing WHERE id_borrowing = '$id'";
        $result = $this->getData($query);
        $borrowing = new Borrowing();
        $borrowing->id_borrowing = $result[0]['id_borrowing'];
        $borrowing->registration = $result[0]['registration'];
        $borrowing->type_borrowing = $result[0]['type_borrowing'];
        $borrowing->borrowing_date = $result[0]['borrowing_date'];
        $borrowing->return_date = $result[0]['return_date'];
        return $borrowing;
    }

    public function InsertBorrowing($borrowing, $id_item)
    {
        //existe el estudiante
        $queryRegistration = "SELECT registration FROM students WHERE registration = '$borrowing->registration'";
        $resultRegistration = $this->getData($queryRegistration);
        if ($resultRegistration === []) {
            // return "El estudiante con matricula $borrowing->registration no existe";
            return false;
        }

        // Existe el tipo de prestamo
        $queryTypeBorrowing = "SELECT * FROM type_borrowing WHERE id_type = '$borrowing->type_borrowing'";
        $resultTypeBorrowing = $this->getData($queryTypeBorrowing);
        if ($resultTypeBorrowing === []) {
            // return "El tipo de prestamo con id $borrowing->type_borrowing no existe";
            return false;
        }

        // insertar prestamo nuevo
        $query = "INSERT INTO borrowing (registration, type_borrowing, borrowing_date, return_date) VALUES (?, ?, ?, ?)";
        $params = [$borrowing->registration, $borrowing->type_borrowing, $borrowing->borrowing_date, $borrowing->return_date];
        $borrowingId = $this->insertDataId($query, $params);
        return $borrowingId;
        // Actualizar tabla respectiva de los diferentes servicios
        /* ERROR NO LO ACTUALIZA PENDIENTE REVISAR
        if ($borrowingId != false) {
            switch ($borrowing->type_borrowing) {
                case computer:
                    $query = "SELECT * FROM computer WHERE id = '$id_item'";
                    $result = $this->getData($query);
                    if ($result === []) {
                        // return "La computadora con id $id_item no existe";
                        return false;
                    }
                    $queryUpdate = "UPDATE computer SET id_borrowing = ? WHERE id = ?";
                    $resultUpdate = $this->updateData($queryUpdate, [$borrowingId, $id_item]);
                    return $resultUpdate;
                    break;
                case book:
                    $query = "SELECT * FROM book WHERE id_book = '$id_item'";
                    $result = $this->getData($query);
                    if ($result === []) {
                        // return "El libro con id $id_item no existe";
                        return false;
                    }
                    $queryUpdate = "UPDATE book SET id_borrowing = ? WHERE id_book = ?";
                    $resultUpdate = $this->updateData($queryUpdate, [$borrowingId, $id_item]);
                    return $resultUpdate;
                    break;
                case locker:
                    $query = "SELECT * FROM locker WHERE id_locker = '$id_item'";
                    $result = $this->getData($query);
                    if ($result === []) {
                        // return "El locker con id $id_item no existe";
                        return false;
                    }
                    $queryUpdate = "UPDATE locker SET id_borrowing = ? WHERE id_locker = ?";
                    $resultUpdate = $this->updateData($queryUpdate, [$borrowingId, $id_item]);
                    return $resultUpdate;
                    break;
                default:
                    return false;
                    break;
            }
        }
        */
    }

    public function UpdateBorrowing($id, $registration, $type_borrowing, $borrowing_date, $return_date)
    {
        $queryBorrowing = "SELECT * FROM borrowing WHERE id_borrowing = '$id'";
        $result = $this->getData($queryBorrowing);
        if (count($result) == 0){
            // return "No existe el prestamo";
            return false;
        }
        $query = "UPDATE borrowing SET registration = ?, type_borrowing = ?, borrowing_date = ?, return_date = ? WHERE id_borrowing = ?";
        $params = [$registration, $type_borrowing, $borrowing_date, $return_date, $id];
        return $this->updateData($query, $params);
    }

    public function DeleteBorrowing($id)
    {
        $queryBorrowing = "SELECT * FROM borrowing WHERE id_borrowing = '$id'";
        $result = $this->getData($queryBorrowing);
        if (count($result) == 0){
            // return "No existe el prestamo";
            return false;
        }
        $query = "DELETE FROM borrowing WHERE id_borrowing = ?";
        $params = [$id];
        return $this->deleteData($query, $params);
    }
}
// USE EXAMPLE DeleteBorrowing()
/*
$borrowingDAO = new BorrowingDAO();
$result = $borrowingDAO->DeleteBorrowing(0);
echo "Prestamo eliminado: " . ($result ? "true" : "false");
echo "<br>";
*/

// USE EXAMPLE InsertBorrowing()
/*
echo "COMPUTADORAS ESTADO <br>";
require_once(__DIR__ . "/ComputerDAO.php");
$ComputerDAO = new ComputerDAO();
$computers = $ComputerDAO->GetAll();
$computer = new Computer();
foreach($computers as $computer){
    echo $computer->id . " " . $computer->no_series . " " . $computer->id_borrowing . " " . $computer->status . " " . $computer->model . " " . $computer->type . " " . $computer->description . "<br>";
}
echo "<br>";

$borrowingDAO = new BorrowingDAO();
$borrowing = new Borrowing();
$borrowing->registration = "66208";
$borrowing->type_borrowing = 1;
$borrowing->borrowing_date = "2024-04-22 10:00:00";
$borrowing->return_date = "2024-04-22 15:00:00";
$result = $borrowingDAO->InsertBorrowing($borrowing, 3);
echo ($result === false ? "error " : $result);
*/

// USE EXAMPLE GetOne()
/*
$borrowingDAO = new BorrowingDAO();
$borrowing = $borrowingDAO->GetOne(1);
echo $borrowing->id_borrowing . " " . $borrowing->registration . " " . $borrowing->type_borrowing . " " . $borrowing->borrowing_date . " " . $borrowing->return_date;
*/

// USE EXAMPLE GetAllWithPagination()
/*
$borrowingDAO = new BorrowingDAO();
$borrowings = $borrowingDAO->GetAllWithPagination(1, 3);
foreach ($borrowings as $borrowing) {
    echo $borrowing->id_borrowing . " " . $borrowing->registration . " " . $borrowing->type_borrowing . " " . $borrowing->borrowing_date . " " . $borrowing->return_date . "<br>";
}
*/


// USE EXAMPLE GetAll()
/*
$borrowingDAO = new BorrowingDAO();
$borrowings = $borrowingDAO->GetAll();
foreach ($borrowings as $borrowing) {
    echo $borrowing->id_borrowing . " " . $borrowing->registration . " " . $borrowing->type_borrowing . " " . $borrowing->borrowing_date . " " . $borrowing->return_date . "<br>";
}
*/

