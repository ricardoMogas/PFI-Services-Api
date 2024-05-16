<?php
require_once(__DIR__ . "/../core/responseData.class.php");
require_once(__DIR__ . "/../core/conexionDB.php");
class ReportController extends responseData
{
    public function index(...$params)
    {
        /** 
         * SI NO EXISTE EL doGet, doPost, doDelete y doPut
         * ENTONCES SE EJECUTA EL INDEX COMO METODO PRESETERMINADO
         **/
    }
    public function doPost(...$params)
    {
        $type = null; // Licenciatura, Visitas, Genero, etnia
        $typeFrequency = null;
        $endDate = null;
        $startDate = null;
        $consulta = new ConexionDB();
        $jsonBody = null;

        if (isset($params["type"])) {
            $type = $params["type"];
        } else {
            return parent::sendJsonResponse("error", "No se ha especificado el tipo de gráfica");
        }

        // OPTENER LOS DATOS DE LA BASE DE DATOS DIRECTAMENTE
        if ($type === "Genero") {
            $startDate = isset($params["startDate"]) ? $params["startDate"] : date('Y-m-d', strtotime("-3 months"));
            $endDate = isset($params["endDate"]) ? $params["endDate"] : date('Y-m-d');
            $NAME_MALE = NAME_MALE;
            $NAME_FEMALE = NAME_FEMALE;
            $queryH = "SELECT *
                        FROM students
                        WHERE gender = '$NAME_MALE' AND date_of_registration BETWEEN '$startDate' AND '$endDate'";
            $queryM = "SELECT *
                        FROM students
                        WHERE gender = '$NAME_FEMALE' AND date_of_registration BETWEEN '$startDate' AND '$endDate'";
            $resultH = $consulta->getData($queryH);
            $resultM = $consulta->getData($queryM);

            $jsonBody = [
                [
                    'name' => 'Hombre',
                    'data' => $resultH
                ],
                [
                    'name' => 'Mujer',
                    'data' => $resultM
                ]
            ];

            return parent::sendJsonResponse("ok", $jsonBody);
        } else if ($type === "Etnia") {
            $startDate = isset($params["startDate"]) ? $params["startDate"] : date('Y-m-d', strtotime("-3 months"));
            $endDate = isset($params["endDate"]) ? $params["endDate"] : date('Y-m-d');

            $etniasList = ["Otro", "Maya", "Mixteca", "Afroamericano"];
            $jsonBody = [];

            foreach ($etniasList as $etnia) {
                $query = "SELECT *
                            FROM students 
                            WHERE ethnicity = '$etnia'
                            AND date_of_registration BETWEEN '$startDate' AND '$endDate'";

                $result = $consulta->getData($query);

                $jsonBody[] = [
                    'name' => $etnia,
                    'data' => $result
                ];
            }

            return parent::sendJsonResponse("ok", $jsonBody);
        } else if ($type === "Licenciatura") {
            $startDate = isset($params["startDate"]) ? $params["startDate"] : date('Y-m-d', strtotime("-3 months"));
            $endDate = isset($params["endDate"]) ? $params["endDate"] : date('Y-m-d');

            $LicenciaturasList = ["ISC", "IM", "ICA", "IE", "IME", "ITS"];
            $jsonBody = [];

            foreach ($LicenciaturasList as $licenciatura) {
                $query = "SELECT 
                    *
                    FROM students 
                    WHERE career = '$licenciatura'
                    AND date_of_registration BETWEEN '$startDate' AND '$endDate'";

                $result = $consulta->getData($query);

                $jsonBody[] = [
                    'name' => $licenciatura,
                    'data' => $result
                ];
            }

            return parent::sendJsonResponse("ok", $jsonBody);
        } else if ($type === "Visitas") {
            $startDate = isset($params["startDate"]) ? $params["startDate"] : date('Y-m-d', strtotime("-3 months"));
            $endDate = isset($params["endDate"]) ? $params["endDate"] : date('Y-m-d');
            $query = "SELECT *
                        FROM registered_visits 
                        WHERE visit_date BETWEEN '$startDate' AND '$endDate'";
            $result = $consulta->getData($query);
            return parent::sendJsonResponse("ok", $result);
        }
    }
}
