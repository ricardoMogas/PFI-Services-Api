<?php
// Habilitar CORS
require_once(__DIR__ . '/../core/conexionDB.php');
require_once(__DIR__ . "/../core/responseData.class.php");

class GetUserController extends responseData{
    public function index(...$params) 
    {
        if (!isset($params["name"])) {
            $responseError = parent::error_400();
            echo $responseError;
            return;
        }
        return parent::sendJsonResponse('ok', $params["name"]);
    }

    public function doGet()
    {
        //crear datos domy para pruebas que asemejen a los datos optenido de la base de datos
        $data = array(
            array(
                "id" => 1,
                "name" => "Ricardo",
                "password" => "1234"
            ),
            array(
                "id" => 2,
                "name" => "Maria",
                "password" => "5678"
            ),
            array(
                "id" => 3,
                "name" => "Juan",
                "password" => "abcd"
            ),
            array(
                "id" => 4,
                "name" => "Ana",
                "password" => "efgh"
            )
        );
        if (isset($data)) {
            return parent::sendJsonResponse('ok', $data);
        } else {
            return 0;
        }
    }
}
?>

