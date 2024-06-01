<?php
require_once __DIR__ . "/../core/responseData.class.php";
require_once __DIR__ . "/../core/authFuntions.php";
require_once __DIR__ . "/../core/conexionDB.php";
class SessionController extends responseData
{
    public function index(...$params)
    {
    }
    public function doGet(...$params)
    {
    }
    public function doPost(...$params)
    {
        $conexion = new ConexionDB();
        if (isset($params["user"]) || isset($params["password"])) {
            $auth = new auth;
            $datosArray = $auth->login($params["user"], $params["password"]);
            return parent::sendJsonResponse("ok", $datosArray);
        }if (isset($params["recoverPass"]) && isset($params["email"])) {
            $resultUser = $conexion->getData("SELECT * FROM user WHERE email = '" . $params["email"] . "'");
            if ($resultUser > 0){
                $queryUpdate = "UPDATE user SET password = ? WHERE email = ?";
                $params = array($params["recoverPass"], $params["email"]);
                $resultUpdate = $conexion->updateData($queryUpdate, $params);
                return parent::sendJsonResponse("ok", $resultUpdate);
            } else {
                return parent::sendJsonResponse("error", "No se ha encontrado el usuario");
            }
            return parent::sendJsonResponse("ok", );
        } else {
            return parent::sendJsonResponse("error", "No se ha especificado el usuario o la contraseña");
        }
        

    }
}
