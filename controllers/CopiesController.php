<?php
require_once(__DIR__ . "/../core/responseData.class.php");
require_once(__DIR__ . "/../dao/CopiesDAO.php");
class CopiesController extends responseData{
    public function index(...$params) 
    {
    }
    /**
     * ENDPOINT > /copies
     * ENDPOINT > /copies?registration=20160234
     * ENDPOINT > /copies?registration=20160234&date=2021-10-10
     * no le envias nada entonces te regresa todas las copias existentes
     * si le das la matricula solo, te regresa las copias hechas por esa persona en el mes actual
     * y si le das las dos cosas, te regresa las copias hechas por esa persona en la fecha especificada
     */
    public function doGet(...$params) 
    {
        $copiesDAO = new CopiesDAO();
        $registration = null;
        $date = null;
        if (isset($params["registration"])) {
            $registration = $params["registration"];
        }
        if (isset($params["date"])) {
            $date = $params["date"];
        }

        $result = $copiesDAO->GetTotalCopiesStudent($registration, $date);
        return parent::sendJsonResponse("ok", $result);
    }
    /**
     * ENDPOINT > /Copies?registration=66208&total=1
     * ENDPOINT > /Copies?registration=66208&total=1&date=2021-10-10
     * Cuando le das la matricula y el total, se inserta una copia en la base de datos con la fecha actual
     * si le das la fecha, se inserta la copia con la fecha especificada
     * 
    */
     public function doPost(...$params) {
        $copiesDAO = new CopiesDAO();
        $date = null;
        if (!isset($params["registration"]) || !isset($params["total"])) {
            return $this->error_400("registration y total son requeridos");
        }
        if (!is_numeric($params["total"])) {
            return $this->error_400("total debe ser un numero");
        }
        if (isset($params["date"])) {
            $date = $params["date"];
        } else {
            $date = date("Y-m-d");
        }

        $registration = $params["registration"];
        $total = $params["total"];

        $resultTotal = $copiesDAO->GetTotalCopiesStudent($registration, $date);
        if ($resultTotal >= TOTAL_COPIES) {
            return $this->sendJsonResponse("ok", "Ya completaste las copias totales del mes : " . date("Y-m"));
        }
        if (($total + $resultTotal) > 50) {
            return $this->sendJsonResponse("ok","Se excendio el limite de copias, solo puedes hacer 50 copias al mes:".$total."-".$resultTotal);
        }


        $result = $copiesDAO->InsertCopie($registration, $total, $date);
        return parent::sendJsonResponse("ok", $result);

    }
}
?>