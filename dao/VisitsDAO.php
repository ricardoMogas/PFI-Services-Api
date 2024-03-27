<?php
require_once(__DIR__ . "/../models/RegisteredVisits.php");
require_once(__DIR__ . '/../core/conexionDB.php');

final class VisitsDAO extends ConexionDB
{
    public function __construct()
    {
        parent::__construct();
    }

    /*
        Función que obtiene todos los registros de visitas.
    */
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
    /*
        Función que obtiene todos los registros de visitas con paginación.
    */
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
    /*
        Función que busca segun la FECHA(date) de visita si existe un registro de visita.
    */
    public function GetAllByDate($date)
    {
        $query = "SELECT * FROM registered_visits WHERE visit_date = $date";
        $result = $this->getData($query);
        if ($result == null) {
            // echo "No existen registros de visitas el día $date";
            return false;
        }
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
    /*
        Función que busca segun la MATRICULA(registration) si existe un registro de visita sin registrar la salida.
        de HOY siempre.
    */
    public function RegisterNewVisit($registration)
    {
        $student = $this->getData("SELECT * FROM students WHERE registration = $registration");
        if ($student == null) {
            // echo "No existe el estudiante con matricula $registration";
            return false;
        }

        $entry_time = date("H:i:s");
        $visit_date = date("Y-m-d");

        $params = [
            null, // no_Visit
            $registration, // registration
            $entry_time, // entry_time
            null, // exit_time
            $visit_date // visit_date
        ];

        $sql = 'INSERT INTO registered_visits (no_Visit, registration, entry_time, exit_time, visit_date) VALUES (?, ?, ?, ?, ?)';
        $this->insertData($sql, $params);

        return true;
    }
    /*
        Función que busca segun la MATRICULA(registration) y la FECHA(date de hoy normalmente) 
        de visita si existe un registro de visita sin registrar la salida.
    */
    public function RegisterExitVisit($registration)
    {
        $date = date("Y-m-d");
        $result = $this->getData(
            "SELECT * FROM registered_visits WHERE registration = $registration AND exit_time IS NULL AND visit_date = $date"
        );
        $resultNotNull = $this->getData(
            "SELECT * FROM registered_visits WHERE registration = $registration AND exit_time IS NOT NULL AND visit_date = $date"
        );
        if (($result) === null) {
            // echo "No existe registro de visita de $registration el día $date";
            return false;
        } elseif ($resultNotNull !== null){
            // echo "Ya se ha registrado la salida de $registration el día $date";
            return true;
        } else {
            $exit_time = date("H:i:s");
            $params = [
                $exit_time, // exit_time
                $registration // registration
            ];
            $sql = 'UPDATE registered_visits SET exit_time = ? WHERE registration = ?';
            $this->updateData($sql, $params);
            return true;
        }
        /*

        */
    }
}

// PRUEBA DE USO RegisterExitVisit()
/*
$visitsDAO = new VisitsDAO();
if ($visitsDAO->RegisterExitVisit(66208)) {
    echo "Salida registrada exitosamente o ya se registro salida\n";
} else {
    print_r("Error al registrar la salida, no existe usuario o no hay registros del dia\n");
}
*/

// PRUEBA DE USO RegisterVisit()
/*
$visitsDAO = new VisitsDAO();
$statusConsult = $visitsDAO->RegisterNewVisit(66208);
if ($statusConsult) {
    echo "Registro de visita exitosa \n";
} else {
    print_r("Error al registrar la visita \n");
}
*/

// PRUEBA DE USO GetAllByDate()
/*
$visitsDAO = new VisitsDAO();
$visits = $visitsDAO->GetAllByDate($date = date("Y-m-d"));
foreach ($visits as $key => $visit) {
    echo "$key: {$visit->registration} : {$visit->entry_time} : {$visit->exit_time} : {$visit->visit_date}\n";
}
*/

// PRUEBA DE USO GetAll();
/*
$visitsDAO = new VisitsDAO();
$visits = $visitsDAO->GetAll();
foreach ($visits as $key => $visit) {
    echo "$key: {$visit->registration} : {$visit->entry_time} : {$visit->exit_time} : {$visit->visit_date}\n";
}
*/

// PRUEBA DE USO GetAllWithPaginatio
/*
$visitsDAO = new VisitsDAO();
$visits = $visitsDAO->GetAllWithPagination(2, 5);
foreach ($visits as $key => $visit) {
    echo "$key: {$visit->registration} : {$visit->entry_time} > {$visit->exit_time} ------ ";
}
*/

