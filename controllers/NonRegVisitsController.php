<?php
require_once(__DIR__ . '/../core/responseData.class.php');
require_once(__DIR__ . '/../dao/VisitsNonRegisteredDAO.php');

class NonRegVisitsController extends responseData
{
    public function index(...$params)
    {
    }

    /*
        ENDPOINT PARA OBTENER TODOS LOS REGISTROS DE VISITAS NO REGISTRADAS CON PAGINACIÓN
        /nonRegVisits?page=1&perPage=3
    */
    /*
        ENDPOINT PARA OBTENER TODOS LOS REGISTROS DE VISITAS NO REGISTRADAS CON PAGINACIÓN
        /nonRegVisits?todayNotExit=null
    */
    public function doGet(...$params)
    {
        if ((!isset($params["page"]) || !isset($params["perPage"])) && !isset($params["todayNotExit"])) {
            return parent::error_400();
        } elseif ( isset($params["todayNotExit"]) ) {

            if ( $params["todayNotExit"] == "null"){
                $NonRegVisitsDAO = new VisitsNonRegisteredDAO();
                $result = $NonRegVisitsDAO->GetAllVisistsNotExitToday();
                return parent::sendJsonResponse("ok", $result);
            } elseif (isset($params["todayNotExit"]) && preg_match('/^\d{2}-\d{2}-\d{2}$/', $params["todayNotExit"])){
                $NonRegVisitsDAO = new VisitsNonRegisteredDAO();
                $result = $NonRegVisitsDAO->GetAllVisistsNotExitToday($params["todayNotExit"]);
                return parent::sendJsonResponse("ok", $result);
            } elseif (isset($params["todayNotExit"]) && !preg_match('/^\d{2}-\d{2}-\d{2}$/', $params["todayNotExit"])){
                return parent::error_400();
            }

        } elseif (!isset($params["todayNotExit"])) {
            $page = intval($params["page"]);
            $perPage = intval($params["perPage"]);
            $NonRegVisitsDAO = new VisitsNonRegisteredDAO();
            $result = $NonRegVisitsDAO->GetAllWithPagination($page, $perPage);
            return parent::sendJsonResponse("ok", $result);
        } else {
            return parent::error_400();
        }
    }

    /*
        ENDPOINT PARA REGISTRAR UNA NUEVA VISITA NO REGISTRADA
        /nonRegVisits?matricula=66208
        /nonRegVisits?date=2024-04-10&matricula=66208
    */
    public function doPost(...$params)
    {
        if ( isset($params["matricula"]) && !isset($params["date"]) ) {
            $NonRegVisitsDAO = new VisitsNonRegisteredDAO();
            $result = $NonRegVisitsDAO->RegisterNewVisit($params["matricula"]);
            return parent::sendJsonResponse("ok", $result);
        } elseif ( isset($params["matricula"]) && isset($params["date"]) ) {
            $NonRegVisitsDAO = new VisitsNonRegisteredDAO();
            $result = $NonRegVisitsDAO->RegisterNewVisit($params["matricula"], $params["date"]);
            return parent::sendJsonResponse("ok", $result);
        } else {
            return parent::error_400();
        }        
    }

    public function doPut(...$params)
    {
        if ( isset($params["matricula"]) && !isset($params["date"]) ) {
            $NonRegVisitsDAO = new VisitsNonRegisteredDAO();
            $result = $NonRegVisitsDAO->RegisterExitVisit($params["matricula"]);
            return parent::sendJsonResponse("ok", $result);
        } elseif ( isset($params["matricula"]) && isset($params["date"]) ) {
            $NonRegVisitsDAO = new VisitsNonRegisteredDAO();
            $result = $NonRegVisitsDAO->RegisterExitVisit($params["matricula"], $params["date"]);
            return parent::sendJsonResponse("ok", $result);
        } else {
            return parent::error_400();
        }
    }
}