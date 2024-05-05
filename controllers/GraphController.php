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
            if (isset($params["startDate"]) && isset($params["endDate"])) {
                $startDate = $params["startDate"];
                $endDate = $params["endDate"];
            }
            $query = "SELECT 
                        SUM(CASE WHEN gender = '" . NAME_MALE . "' THEN 1 ELSE 0 END) AS cauntity_male,
                        SUM(CASE WHEN gender = '" . NAME_FEMALE . "' THEN 1 ELSE 0 END) AS cuantity_female
                        FROM students";
            if ($startDate !== null && $endDate !== null) {
                $query .= " WHERE date_of_registration BETWEEN '$startDate' AND '$endDate'";
            }
            $result = $consulta->getData($query);
            $jsonBody = [
                [
                    'name' => 'Hombre', 
                    'Total' => is_numeric($result[0]["cauntity_male"]) ? (int)$result[0]["cauntity_male"] : 0
                ],
                [
                    'name' => 'Mujer', 
                    'Total' => is_numeric($result[0]["cuantity_female"]) ? (int)$result[0]["cuantity_female"] : 0
                ],
            ];
            return parent::sendJsonResponse("ok", $jsonBody);


        } else if ($type === "Etnia") {
            $etniasList = ["Otro", "Maya", "Mixteca", "Maya", "Afroamericano"];
            $jsonBody = [];
            foreach ($etniasList as $etnia) {
                $query = "SELECT 
                            SUM(CASE WHEN gender = '" . NAME_MALE . "' THEN 1 ELSE 0 END) AS cauntity_male,
                            SUM(CASE WHEN gender = '" . NAME_FEMALE . "' THEN 1 ELSE 0 END) AS cuantity_female
                            FROM students 
                            WHERE ethnicity = '$etnia'";

                if ($startDate !== null && $endDate !== null) {
                    $query .= " AND date_of_registration BETWEEN '$startDate' AND '$endDate'";
                }

                $result = $consulta->getData($query);

                $jsonBody[] = [
                    'name' => $etnia,
                    'Hombre' => is_numeric($result[0]["cauntity_male"]) ? (int)$result[0]["cauntity_male"] : 0,
                    'Mujer' => is_numeric($result[0]["cuantity_female"]) ? (int)$result[0]["cuantity_female"] : 0
                ];
            }
            return parent::sendJsonResponse("ok", $jsonBody);
        } else if ($type === "Licenciatura") {
            $LicenciaturasList = ["ISC", "IM", "ICA", "IE", "IME", "ITS"];
            $jsonBody = [];
            foreach ($LicenciaturasList as $licenciatura) {
                $query = "SELECT 
                SUM(CASE WHEN gender = '" . NAME_MALE . "' THEN 1 ELSE 0 END) AS cauntity_male,
                SUM(CASE WHEN gender = '" . NAME_FEMALE . "' THEN 1 ELSE 0 END) AS cuantity_female
                FROM students 
                WHERE career = '$licenciatura'";
                if ($startDate !== null && $endDate !== null) {
                    $query .= " AND date_of_registration BETWEEN '$startDate' AND '$endDate'";
                }
                $result = $consulta->getData($query);
                $jsonBody[] = [
                    'name' => $licenciatura,
                    'Hombre' => is_numeric($result[0]["cauntity_male"]) ? (int)$result[0]["cauntity_male"] : 0,
                    'Mujer' => is_numeric($result[0]["cuantity_female"]) ? (int)$result[0]["cuantity_female"] : 0
                ];
            }
            return parent::sendJsonResponse("ok", $jsonBody);
        } else if ($type === "Visitas") {
            return parent::sendJsonResponse("ok", "En proceso de desarrollo");
        }
    }

    public function doPost(...$params)
    {
    }
}
