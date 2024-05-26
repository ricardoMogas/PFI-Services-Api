<?php
require_once(__DIR__ . "/../core/responseData.class.php");
require_once(__DIR__ . "/../core/authFuntions.php");
class SessionController extends responseData{
    public function index(...$params) 
    {
    }
    public function doGet(...$params) 
    {
    }
     public function doPost(...$params) 
    {   
        if (!isset($params["user"]) || !isset($params["password"]) ) {
            return parent::sendJsonResponse("error", "No se ha especificado el usuario o la contraseña");
        }
        $auth = new auth;
        $datosArray = $auth->login($params["user"], $params["password"]);
        return parent::sendJsonResponse("ok", $datosArray);
    }
}
?>