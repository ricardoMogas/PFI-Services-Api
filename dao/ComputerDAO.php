<?php
require_once(__DIR__ . "/../core/conexionDB.php");
require_once(__DIR__ . "/../models/Computer.php");

class ComputerDAO extends ConexionDB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetAll()
    {
        $query = "SELECT * FROM computer";
        $result = $this->getData($query);
        $computers = array();
        foreach ($result as $row) {
            $computer = new Computer();
            foreach ($row as $key => $value) {
                $computer->$key = $value;
            }
            $computers[] = $computer;
        }
        return $computers;
    }

    public function GetOne($id)
    {
        $query = "SELECT * FROM computer WHERE id = '$id'";
        $result = $this->getData($query);
        if (!empty($result)) {
            $computer = new Computer();
            $computer->id = $result[0]['id'];
            $computer->no_series = $result[0]['no_series'];
            $computer->id_borrowing = $result[0]['id_borrowing'];
            $computer->status = $result[0]['status'];
            $computer->model = $result[0]['model'];
            $computer->type = $result[0]['type'];
            $computer->description = $result[0]['description'];
        } else {
            $computer = null;
        }
        return $computer;
    }

    public function GetAllWithPagination($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM computer LIMIT $offset, $perPage";
        $result = $this->getData($query);
        $computers = array();
        foreach ($result as $row) {
            $computer = new Computer();
            foreach ($row as $key => $value) {
                $computer->$key = $value;
            }
            $computers[] = $computer;
        }
        return $computers;
    }

    public function InsertComputer($computer)
    {
        $valid = true;
        $requiredFields = [ 'no_series', 'id_borrowing', 'status', 'model', 'type', 'description'];
        foreach ($requiredFields as $field) {
            if ($computer->$field == null) {
                $valid = false;
                return "El campo $field es requerido";
            }
        }

        if ($valid) {
            $query = "INSERT INTO computer ( no_series, id_borrowing, status, model, type, description) VALUES (?, ?, ?, ?, ?, ?)";
            $params = [$computer->no_series, $computer->id_borrowing, $computer->status, $computer->model, $computer->type, $computer->description];
            return $this->insertData($query, $params);
        }
    }

    public function UpdateBorrowingComputer($id, $id_borrowing)
    {
        $queryComputer = "SELECT * FROM computer WHERE id = '$id'";
        $result = $this->getData($queryComputer);
        if (count($result) == 0){
            return false;
        }
        // si es null el $id_borrowing se actualiza a null
        if ($id_borrowing == null){
            $query = "UPDATE computer SET id_borrowing = ? WHERE id = ?";
            $params = [null, $id];
            return $this->updateData($query, $params);
        }

        $query = "UPDATE computer SET id_borrowing = ? WHERE id = ?";
        $params = [$id_borrowing, $id];
        return $this->updateData($query, $params);
    }
    
    public function UpdateComputer($id, $no_series, $id_borrowing, $status, $model, $type, $description)
    {
        $queryComputer = "SELECT * FROM computer WHERE id = '$id'";
        $result = $this->getData($queryComputer);
        if (count($result) == 0){
            return "No existe la computadora";
        }

        $query = "UPDATE computer SET no_series = ?, id_borrowing = ?, status = ?, model = ?, type = ?, description = ? WHERE id = ?";
        $params = [$no_series, $id_borrowing, $status, $model, $type, $description, $id];
        return $this->updateData($query, $params);
    }

    public function DeleteComputer($id)
    {
        $queryComputer = "SELECT * FROM computer WHERE id = '$id'";
        $result = $this->getData($queryComputer);
        if (count($result) == 0){
            return "No existe la computadora";
        }
        $query = "DELETE FROM computer WHERE id = ?";
        $params = [$id];
        return $this->deleteData($query, $params);
    }
}
// USE EXAMPLE DeleteComputer()
/*
$computerDAO = new ComputerDAO();
$result = $computerDAO->DeleteComputer(3);
echo "Computadora eliminada: " . ($result ? "true" : "false");
echo "<br>";
*/

// USE EXAMPLE UpdateBorrowingComputer()
/*
$computerDAO = new ComputerDAO();
$result = $computerDAO->UpdateBorrowingComputer(3, null);
echo "Computadora actualizada: " . ($result ? "true" : "false");
echo "<br>";
*/

// USE EXAMPLE InsertComputer()
/*
$computer = new Computer();
$computer->no_series = "123456";
$computer->id_borrowing = 1;
$computer->status = "Available";
$computer->model = "Test Model";
$computer->type = "Desktop";
$computer->description = "Test Computer";
$computerDAO = new ComputerDAO();
$result = $computerDAO->InsertComputer($computer);
echo "Computadora insertada: " . $result;
echo "<br>";
*/

// USE EXAMPLE GetOne()
/*
$computerDAO = new ComputerDAO();
$computer = $computerDAO->GetOne(1);
echo $computer->id . " " . $computer->model . " " . $computer->status;
*/

// USE EXAMPLE GetAll()
/*
$computerDAO = new ComputerDAO();
$computers = $computerDAO->GetAll();
foreach ($computers as $computer) {
    echo $computer->id . " -- " . $computer->no_series . " -- " . $computer->model . " -- " . $computer->status . "<br>";
}
*/
