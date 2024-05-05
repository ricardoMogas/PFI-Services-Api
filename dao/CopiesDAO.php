<?php

require_once(__DIR__ . "/../core/conexionDB.php");
require_once(__DIR__ . "/../models/Copies.php");

final class CopiesDAO extends ConexionDB
{

    public function __construct()
    {
        parent::__construct();  // Call the parent class' constructor
    }

    public function GetAll()
    {
        $query = "SELECT * FROM copies";
        $result = $this->getData($query);
        $copies = [];
        foreach ($result as $row) {
            $copie = new Copies();
            foreach ($row as $key => $value) {
                $copie->$key = $value;
            }
            $copies[] = $copie;
        }
        return $copies;
    }

    public function GetOne($id)
    {
        $query = "SELECT * FROM copies WHERE registration_number = $id";
        $result = $this->getData($query);
        $copie = new Copies();
        $copie->registration_number = $result[0]['registration_number'];
        $copie->registration = $result[0]['registration'];
        $copie->total = $result[0]['total'];
        $copie->date = $result[0]['date'];
        return $copie;
    }


    public function GetAllWithPagination($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM copies LIMIT $offset, $perPage";
        $result = $this->getData($query);
        $copies = [];
        foreach ($result as $row) {
            $copie = new Copies();
            foreach ($row as $key => $value) {
                $copie->$key = $value;
            }
            $copies[] = $copie;
        }
        return $copies;
    }

    /*
    * Inserta una copia en la base de datos
    * Si la fecha no se especifica se toma la fecha actual
    */
    public function InsertCopie($registration, $total, $date = null)
    {

        if ( $date == null ) {
            $date = date('Y-m-d');
        }

        $registrationQuery = "SELECT * FROM students WHERE registration = '$registration'";
        $resultRegistration = $this->getData($registrationQuery);
        if ( count($resultRegistration) == 0 ) {
            return "Estudiante no registrado";
        }

        $dateQuery = "SELECT * FROM copies WHERE date = '$date'";
        $resultDate = $this->getData($dateQuery);

        if ( count($resultDate) > 0 ) {
            // return "Ya existe una copia para esta fecha sumar a la existente";
            $queryUpdate = "UPDATE copies SET total = total + ? WHERE date = ?";
            $paramsUpdate = [$total, $date];
            return $susses = $this->updateData($queryUpdate, $paramsUpdate);
        } else {
            // return "No existe una copia para esta fecha insertar una nueva";
            $query = "INSERT INTO copies (registration, total, date) VALUES (?, ?, ?)";
            $params = [$registration, $total, $date];
            return $susses = $this->insertData($query, $params);
        }
    }
    /*
    * Obtiene el total de copias en la base de datos
    * Si se especifica un registro se obtiene el total de copias de ese registro
    */
    public function GetTotalCopiesStudent($registration = null, $date = null)
    {
        $registrationQuery = "SELECT * FROM students WHERE registration = '$registration'";
        $resultRegistration = $this->getData($registrationQuery);
        if ( count($resultRegistration) == 0 ) {
            return "Estudiante no registrado";
        }

        if ( $date == null ) {
            $date = date('Y-m-d');
        }

        if ( $registration == null ) {
            $query = "SELECT * FROM copies WHERE MONTH(date) = MONTH('$date') AND YEAR(date) = YEAR('$date')";
            $result = $this->getData($query);
            $total = 0;
            foreach ($result as $row) {
                $total += $row['total'];
            }
            return $total;
        }

        $dateMonth = "SELECT * FROM copies WHERE MONTH(date) = MONTH('$date') AND YEAR(date) = YEAR('$date') AND registration = '$registration'";
        $resultDateMonth = $this->getData($dateMonth);
        
        if ( count($resultDateMonth) == 0 ) {
            return "No tiene copias o impresiones hechas en este mes";
        } else {
            $total = 0;
            foreach ($resultDateMonth as $row) {
                $total += $row['total'];
            }
            return $total;
        }
    }

    public function DeleteCopie($id)
    {
        $queryId = "SELECT * FROM copies WHERE registration_number = $id";
        $resultId = $this->getData($queryId);
        if ( count($resultId) === 0 ) {
            // return "No existe una copia con ese id";
            return false;
        } else {
            $query = "DELETE FROM copies WHERE registration_number = ?";
            return $this->deleteData($query , [$id]);
        }
    }
}
// USE EXAMPLE DeleteCopie()
/*
$copiesDAO = new CopiesDAO();
$susses = $copiesDAO->DeleteCopie(8);
if ($susses) {
    echo "Copia eliminada correctamente";
} else {
    echo "Error al eliminar la copia";
}
*/


// USE EXAMPLE GetTotalCopiesStudent()
/*
$copiesDAO = new CopiesDAO();
$total = $copiesDAO->GetTotalCopiesStudent('66208');
echo "Total de copias: $total";
*/


// USE EXAMPLE InsertCopie()
/*
$copiesDAO = new CopiesDAO();
$susses = $copiesDAO->InsertCopie('66208', 10, null);
if ($susses) {
    echo "Copia insertada correctamente";
} else {
    echo "Error al insertar la copia";
}
*/

// USE EXAMPLE GetAll()
/*
$copiesDAO = new CopiesDAO();
$copies = $copiesDAO->GetAll();
foreach ($copies as $key => $copie) {
    echo "$key: $copie->registration_number, $copie->registration, $copie->total, $copie->date <br>";
}
*/

// USE EXAMPLE GetOne()
/*
$copiesDAO = new CopiesDAO();
$copie = $copiesDAO->GetOne(1);
echo "$copie->registration_number, $copie->registration, $copie->total, $copie->date <br>";
*/
