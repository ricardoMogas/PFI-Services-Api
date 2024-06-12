<?php
require_once __DIR__ . "/../core/responseData.class.php";
require_once __DIR__ . "/../core/conexionDB.php";
class AdvanceController extends responseData
{
    public function index(...$params)
    {
        /**
         * SI NO EXISTE EL doGet, doPost, doDelete y doPut
         * ENTONCES SE EJECUTA EL INDEX COMO METODO PRESETERMINADO
         **/
    }
    public function doGet(...$params)
    {
        $conn = new conexionDB();
        $conn->conectar();
        if (isset($params["query"])) {
            $sql = $params["query"];
            $result = $conn->getDataEs($sql);
            if ($result["status"]) {
                return parent::sendJsonResponse("ok", $result["data"]);
            } else {
                return parent::sendJsonResponse("error", $result["data"]);
            }
        }
    }

    public function doPost(...$params)
    {
    }
}
