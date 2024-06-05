<?php
require_once(__DIR__ . "/../core/conexionDB.php");
require_once(__DIR__ . "/../models/Locker.php");

class LockerDAO extends ConexionDB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetAll()
    {
        $query = "SELECT * FROM locker";
        $result = $this->getData($query);
        $lockers = array();
        foreach ($result as $row) {
            $locker = new Locker();
            foreach ($row as $key => $value) {
                $locker->$key = $value;
            }
            $lockers[] = $locker;
        }
        return $lockers;
    }

    public function GetOne($id)
    {
        $query = "SELECT * FROM locker WHERE id_locker = '$id'";
        $result = $this->getData($query);
        $locker = new Locker();
        $locker->id_locker = $result[0]['id_locker'];
        $locker->id_borrowing = $result[0]['id_borrowing'];
        $locker->status = $result[0]['status'];
        $locker->description = $result[0]['description'];
        return $locker;
    }

    public function GetAllWithPagination($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM locker LIMIT $offset, $perPage";
        $result = $this->getData($query);
        $lockers = array();
        foreach ($result as $row) {
            $locker = new Locker();
            foreach ($row as $key => $value) {
                $locker->$key = $value;
            }
            $lockers[] = $locker;
        }
        return $lockers;
    }

    public function InsertLocker($locker)
    {
        $valid = true;
        $requiredFields = ['id_locker', 'status', 'description'];
        foreach ($requiredFields as $field) {
            if ($locker->$field == null) {
                $valid = false;
                return "El campo $field es requerido";

            }
        }

        if ($valid) {
            $query = "INSERT INTO locker (id_locker, status, description) VALUES (?, ?, ?)";
            $params = [$locker->id_locker, $locker->status, $locker->description];
            return $this->insertData($query, $params);
        }
    }

    public function UpdateBorrowingLoker($id_locker, $id_borrowing)
    {
        $queryLoker = "SELECT * FROM locker WHERE id_locker = '$id_locker'";
        $result = $this->getData($queryLoker);
        if (count($result) == 0){
            //return "No existe el locker";
            return false;
        }
        // si es null el $id_borrowing se actualiza a null
        if ($id_borrowing == null ){
            $query = "UPDATE locker SET id_borrowing = ?, status = 'Libre' WHERE id_locker = ?";
            $params = [null, $id_locker];
            return $this->updateData($query, $params);
        }

        $query = "UPDATE locker SET id_borrowing = ?, status = 'Ocupado' WHERE id_locker = ?";
        $params = [$id_borrowing, $id_locker];
        return $this->updateData($query, $params);
    }
    
    public function UpdateLoker($id_locker, $status, $description)
    {
        $queryLoker = "SELECT * FROM locker WHERE id_locker = '$id_locker'";
        $result = $this->getData($queryLoker);
        if (count($result) == 0){
            return "No existe el locker";
        }

        $query = "UPDATE locker SET status = ?, description = ? WHERE id_locker = ?";
        $params = [$status, $description, $id_locker];
        return $this->insertData($query, $params);
    }

    public function DeleteLocker($id_locker)
    {
        $queryLoker = "SELECT * FROM locker WHERE id_locker = '$id_locker'";
        $result = $this->getData($queryLoker);
        if (count($result) == 0){
            return "No existe el locker";
        }
        $query = "DELETE FROM locker WHERE id_locker = ?";
        $params = [$id_locker];
        return $this->insertData($query, $params);
    }
}
// USE EXAMPLE DeleteLocker()
/*
$lockerDAO = new LockerDAO();
$result = $lockerDAO->DeleteLocker("test2id");
echo "Locker eliminado:". ($result ? "true" : "false");
echo "<br>";
*/

// USE EXAMPLE UpdateBorrowingLoker()
/*
$lockerDAO = new LockerDAO();
$result = $lockerDAO->UpdateBorrowingLoker("test2id", null);
echo "Locker actualizado:". ($result ? "true" : "false");
echo "<br>";
*/

// USE EXAMPLE InsertLocker()
/*
$locker = new Locker();
$locker->id_locker = "test2id";
$locker->status = "Libre";
$locker->description = "Locker 2";
$lockerDAO = new LockerDAO();
$result = $lockerDAO->InsertLocker($locker);
echo "Locker insertado:". $result;
echo "<br>";
*/

//USE EXAMPLE GetOne()
/*
$lockerDAO = new LockerDAO();
$locker = $lockerDAO->GetOne(1);
echo $locker->id_locker . " " . $locker->description . " " . $locker->status;
*/

// USE EXAMPLE GetAll()
/*
$lockerDAO = new LockerDAO();
$lockers = $lockerDAO->GetAll();
foreach ($lockers as $locker) {
    echo $locker->id_locker . " -- " . $locker->id_borrowing ." -- ". $locker->description . " -- " . $locker->status . "<br>";
}
*/

?>