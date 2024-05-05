<?php
require_once(__DIR__ . "/../core/responseData.class.php");
require_once(__DIR__ . "/../core/conexionDB.php");
class GraphController extends responseData
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
        // DECLARAR VARIABLES
        $type = null; // Licenciatura, Visitas, Genero, etnia
        $typeFrequency = null;
        $endDate = null;
        $startDate = null;
        $consulta = new ConexionDB();
        $jsonBody = null;
        if (isset($params["type"])) {
            $type = $params["type"];
        } else {
            return parent::sendJsonResponse("error", "No se ha especificado el tipo de grafica");
        }

        // OPTENER LOS DATOS DE LA BASE DE DATOS DIRECTAMENTE
        if ($type === "Genero") {
            if(isset($params["startDate"]) && isset($params["endDate"])) {
                $startDate = $params["startDate"];
                $endDate = $params["endDate"];
            }
            $queryH = "SELECT COUNT(*) AS cauntity_male FROM students WHERE gender = '" . NAME_MALE . "'";
            $queryM = "SELECT COUNT(*) AS cuantity_female FROM students WHERE gender = '" . NAME_FEMALE . "'";
            if ($startDate !== null && $endDate !== null) {
                $queryH .= " AND date_of_registration BETWEEN '$startDate' AND '$endDate'";
                $queryM .= " AND date_of_registration BETWEEN '$startDate' AND '$endDate'";
            }
            $resultH = $consulta->getData($queryH);
            $resultM = $consulta->getData($queryM);
            $jsonBody = [
                ['name' => 'Hombre', 'value' => $resultH[0]['cauntity_male']],
                ['name' => 'Mujer', 'value' => $resultM[0]['cuantity_female']],
            ];
            return parent::sendJsonResponse("ok", $jsonBody);
        }
    }

    public function doPost(...$params)
    {
    }
}
