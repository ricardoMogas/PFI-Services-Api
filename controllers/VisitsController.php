<?php
require_once(__DIR__ . "/../dao/VisitsDAO.php");
require_once(__DIR__ . "/../core/responseData.class.php");

class VisitsController extends responseData
{
    public function index(...$params)
    {
    }
    /*
        ENDPOINT PARA OBTENER TODOS LOS REGISTROS DE VISITAS CON PAGINACIÓN
        /visits?page=1&perPage=3
        ENDPOINT PARA OBTENER LAS VISITAS DEL DIA SIN SALIDA
        /visits?todayNotExit=null
    */
    public function doGet(...$params)
    {
        if ( ( !isset($params["page"]) || !isset($params["perPage"]) ) && !isset($params["todayNotExit"]) ) {
            // Si no se le pasa ningun parametro
            return parent::error_400();
        } elseif( isset($params["todayNotExit"])) {
            // Si se le pasa el parametro todayNotExit
            if ($params["todayNotExit"] == "null") {
                $visitsDAO = new VisitsDAO();
                $result = $visitsDAO->GetAllVisistsNotExitToday();
                return parent::sendJsonResponse("ok", $result);
            } elseif( isset($params["todayNotExit"]) && preg_match('/^\d{2}-\d{2}-\d{2}$/', $params["todayNotExit"]) ) {
                // Si el valor de todayNotExit es una fecha válida en el formato "y-m-d"
                $visitsDAO = new VisitsDAO();
                $result = $visitsDAO->GetAllVisistsNotExitToday($params["todayNotExit"]);
                return parent::sendJsonResponse("ok", $result);
            } elseif( isset($params["todayNotExit"]) && !preg_match('/^\d{2}-\d{2}-\d{2}$/', $params["todayNotExit"]) ) {
                // Si el valor de todayNotExit no es una fecha válida en el formato "yy-mm-dd"
                return parent::error_400();
            }
        } elseif( !isset($params["todayNotExit"]) ) {
            // si no se le pasa el parametro todayNotExit
            $page = intval($params["page"]);
            $perPage = intval($params["perPage"]);
            $visitsDAO = new VisitsDAO();
            $result = $visitsDAO->GetAllWithPagination($page, $perPage);
            return parent::sendJsonResponse("ok", $result);
        } else {
            // cualquier caso, como cuando se le pasa los tres parametro page, perPage y todayNotExit a la ves
            return parent::error_400();
        }
        
    }
    /*
        ENDPOINT PARA REGISTRAR UNA NUEVA VISITA
        /visits?matricula=66208
        /visits?date=2024-04-10&matricula=66208
    */
    public function doPost(...$params)
    {
        if ( isset($params["matricula"]) && !isset($params["date"]) ) {
            // Cunado solo se envia la matricula
            $visitsDAO = new VisitsDAO();
            $result = $visitsDAO->RegisterNewVisit($params["matricula"]);
            return parent::sendJsonResponse("ok", $result);
        } elseif ( isset($params["matricula"]) && isset($params["date"]) )  {
            // Cuando se envia la matricula y la fecha
            $visitsDAO = new VisitsDAO();
            $result = $visitsDAO->RegisterNewVisit($params["matricula"], $params["date"]);
            return parent::sendJsonResponse("ok", $result);
        }
        if ( isset($params["deleteVisit"]) ){
            // Cuando se envia el parametro deleteVisit
            $visitsDAO = new VisitsDAO();
            $result = $visitsDAO->DeleteVisit($params["deleteVisit"]);
            return parent::sendJsonResponse("ok", $result);
        } else {
            // Cualquier otro caso
            return parent::error_400();
        }

    }
    /*
        ENDPOINT PARA REGISTRAR LA SALIDA DE UNA VISITA
        /visits?matricula=66208
        /visits?matricula=66208&date=2024-04-10
    */
    public function doPut(...$params)
    {
        if ( isset($params["matricula"]) && !isset($params["date"]) ) {
            //return "correcto solo matricula";
            $visitsDAO = new VisitsDAO();
            $result = $visitsDAO->RegisterExitVisit($params["matricula"]);
            return parent::sendJsonResponse("ok", $result);
        } elseif ( isset($params["matricula"]) && isset($params["date"]) ) {
            // return "correcto matricula y fecha";
            $visitsDAO = new VisitsDAO();
            $result = $visitsDAO->RegisterExitVisit($params["matricula"], $params["date"]);
            return parent::sendJsonResponse("ok", $result);
        } else {
            // return "error";
            return parent::error_400();
        }
    }
}
