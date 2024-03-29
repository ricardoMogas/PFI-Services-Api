<?php
require_once(__DIR__ . "/../dao/VisitsDAO.php");
require_once(__DIR__ . "/../core/responseData.class.php");

class VisitsController extends responseData{
    public function index(...$params) 
    {}
    /*
        ENDPOINT PARA OBTENER TODOS LOS REGISTROS DE VISITAS CON PAGINACIÓN
        http://localhost/PFI-Services-Api/visits?page=1&perPage=3
    */
    public function doGet(...$params) 
    {
        if (!isset($params["page"]) || !isset($params["perPage"])) {
            return parent::error_400();
        }
        $page = intval($params["page"]);
        $perPage = intval($params["perPage"]);
        $visitsDAO = new VisitsDAO();
        $result = $visitsDAO->GetAllWithPagination($page, $perPage);
        return parent::sendJsonResponse("ok", $result);
    }
    public function doPost(...$params) {}
}