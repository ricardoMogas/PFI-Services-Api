<?php
require_once(__DIR__ . "/../models/UnregisteredVisits.php");
require_once(__DIR__ . '/../core/conexionDB.php');

final class VisitsNonRegisteredDAO extends ConexionDB
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
        $query = "SELECT * FROM unregistered_visits";
        $result = $this->getData($query);
        $unregisteredVisits = [];
        foreach ($result as $row) {
            $unregisteredVisit = new UnregisteredVisits();
            foreach ($row as $key => $value) {
                $unregisteredVisit->$key = $value;
            }
            $result[] = $unregisteredVisit;
        }
        return $result;
    }
    /*
        Función que obtiene todos los registros de visitas con paginación.
    */
    public function GetAllWithPagination($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM unregistered_visits LIMIT $offset, $perPage";
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
        $query = "SELECT * FROM unregistered_visits WHERE visit_date = $date";
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
    public function RegisterNewVisit($registration, $date = null)
    {
        if ($date === null) {
            $date = date("Y-m-d");
        }
        // si hay mas de 5 registros de visitas de una matricula en total no se puede registrar otra visita
        $count = $this->getData("SELECT COUNT(*) FROM unregistered_visits WHERE registration = $registration");
        if ($count[0]['COUNT(*)'] >= 5) {
            echo "No se puede registrar otra visita, ya hay 5 registros de visitas de $registration";
            return false;
        }

        $entry_time = date("H:i:s");
        $visit_date = $date;
        $params = [
            null, // no_Visit
            $registration, // registration
            $entry_time, // entry_time
            null, // exit_time
            $visit_date // visit_date
        ];

        $sql = 'INSERT INTO unregistered_visits (no_Visit, registration, entry_time, exit_time, visit_date) VALUES (?, ?, ?, ?, ?)';
        $this->insertData($sql, $params);
        return true;
    }
    /*
        Función que busca segun la MATRICULA(registration) y la FECHA(date de hoy normalmente) 
        de visita si existe un registro de visita sin registrar la salida.
        Si existen mas de una visita sin registrar la salida, se registra la salida con la misma
        hora en todas las visitas con exit_time null del dia respectivo.    
    */
    public function RegisterExitVisit($registration, $date = null)
    {
        if ($date === null) {
            $date = date("Y-m-d");
        }
        $results = $this->getData(
            "SELECT * FROM unregistered_visits WHERE registration = $registration AND exit_time IS NULL AND visit_date = $date"
        );
        $resultNotNull = $this->getData(
            "SELECT * FROM unregistered_visits WHERE registration = $registration AND exit_time IS NOT NULL AND visit_date = $date"
        );
        if ($results === [] || $resultNotNull !== []) {
            // echo " --- No existe registro de visita de $registration el día $date ---";
            return false;
        } else {
            // echo "faltan registros de salida de $registration el día $date";
            $params = [
                date("H:i:s"), // exit_time
                $registration,
                $date
            ];
            $sql = "UPDATE unregistered_visits SET exit_time = ? WHERE registration = ? AND visit_date = ?";
            $this->updateData($sql, $params);
            return true;
        }
    }
    public function DeleteVisit($no_Visit = null, $resistration = null, $date = null)
    {
        if ($date === null) {
            $date = date("Y-m-d");
        }
        if ($resistration != null) {
            $resultDate = $this->getData("SELECT * FROM unregistered_visits WHERE registration = $resistration AND visit_date = $date");
            if ($resultDate === []) {
                //echo "No existe el registro de visita de $resistration el día $date";
                return false;
            }
            $sql = "DELETE FROM unregistered_visits WHERE registration = ? AND visit_date = ?";
            $params = [$resistration, $date];
            $this->deleteData($sql, $params);
            return true;
        }
        if ($no_Visit != null) {
            $result = $this->getData("SELECT * FROM unregistered_visits WHERE no_Visit = $no_Visit");
            if ($result === []) {
                //echo "No existe el registro de visita con no_Visit $no_Visit";
                return false;
            }
            $sql = "DELETE FROM unregistered_visits WHERE no_Visit = ?";
            $params = [$no_Visit];
            $this->deleteData($sql, $params);
            return true;
        }
        
    }
}

// PRUEBA DE USO RegisterExitVisit()
/*
$VisitsNonRegisteredDAO = new VisitsNonRegisteredDAO();
$result = $VisitsNonRegisteredDAO->RegisterExitVisit(66209, '2024-03-28');
if ($result) {
    echo "Salida registrada exitosamente o ya se registró salida\n";
} else {
    echo "No hay salida que se pueda registrar de ese estudiante\n";
}
*/
// PRUEBA DE USO RegisterVisit()
/*
$VisitsNonRegisteredDAO = new VisitsNonRegisteredDAO();
$statusConsult =  $VisitsNonRegisteredDAO->RegisterNewVisit(66209);
if ($statusConsult) {
    echo "Registro de visita exitosa \n";
} else {
    print_r("Error al registrar la visita \n");
}
*/


// PRUEBA DE USO GetAllByDate()
/*
 VisitsNonRegisteredDAO = new VisitsNonRegisteredDAO();
$visits =  VisitsNonRegisteredDAO->GetAllByDate($date = date("Y-m-d"));
foreach ($visits as $key => $visit) {
    echo "$key: {$visit->registration} : {$visit->entry_time} : {$visit->exit_time} : {$visit->visit_date}\n";
}
*/

// PRUEBA DE USO GetAll();
/*
$VisitsNonRegisteredDAO = new VisitsNonRegisteredDAO();
$visits = $VisitsNonRegisteredDAO->GetAll();
foreach ($visits as $key => $visit) {
    if (is_object($visit)) {
        echo "$key: {$visit->registration} : {$visit->entry_time} : {$visit->exit_time} : {$visit->visit_date} ---- \n";
    }
}
/*

// PRUEBA DE USO GetAllWithPaginatio
/*
 VisitsNonRegisteredDAO = new VisitsNonRegisteredDAO();
$visits =  VisitsNonRegisteredDAO->GetAllWithPagination(2, 5);
foreach ($visits as $key => $visit) {
    echo "$key: {$visit->registration} : {$visit->entry_time} > {$visit->exit_time} ------ ";
}
*/

