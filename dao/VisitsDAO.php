<?php
require_once(__DIR__ . "/../models/RegisteredVisits.php");
require_once(__DIR__ . '/../core/conexionDB.php');

final class VisitsDAO extends ConexionDB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetAll()
    {
        $query = "SELECT * FROM registered_visits";
        $result = $this->getData($query);
        $registeredVisits = [];
        foreach ($result as $row) {
            $registeredVisit = new RegisteredVisits();
            foreach ($row as $key => $value) {
                $registeredVisit->$key = $value;
            }
            $registeredVisits[] = $registeredVisit;
        }
        return $registeredVisits;
    }

    public function GetAllWithPagination($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM registered_visits LIMIT $offset, $perPage";
        $result = $this->getData($query);
        $registeredVisits = [];
        foreach ($result as $row) {
            $registeredVisit = new RegisteredVisits();
            foreach ($row as $key => $value) {
                $registeredVisit->$key = $value;
            }
            $registeredVisits[] = $registeredVisit;
        }
        return $registeredVisits;
    }

    public function RegisterNewVisit($registration)
    {
        $registeredVisit = new RegisteredVisits();
        $registeredVisit->registration = $registration;
        $registeredVisit->entry_time = date("H:i:s");
        $registeredVisit->visit_date = date("Y-m-d");
        $data = [
            ':registration' => $registeredVisit->registration,
            ':entry_time' => $registeredVisit->entry_time,
            ':visit_date' => $registeredVisit->visit_date,
        ];
        $this->insertData('INSERT INTO registered_visits (registration, entry_time, exit_time, visit_date) VALUES (:registration, :entry_time, :exit_time, :visit_date)', $data);
        return true;
    }
}

//prueba de uso GetAll();
/*
$visitsDAO = new VisitsDAO();
$visits = $visitsDAO->GetAll();
foreach ($visits as $key => $visit) {
    echo "$key: {$visit->registration} : {$visit->entry_time} : {$visit->exit_time} : {$visit->visit_date}\n";
}
*/

// prueba de uso GetAllWithPaginatio
/*
$visitsDAO = new VisitsDAO();
$visits = $visitsDAO->GetAllWithPagination(2, 5);
foreach ($visits as $key => $visit) {
    echo "$key: {$visit->registration} : {$visit->entry_time} > {$visit->exit_time} ------ ";
}
*/

// prueba de uso RegisterVisit()
$visitsDAO = new VisitsDAO();
$visitsDAO->RegisterNewVisit(66208);
