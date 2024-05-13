<?php
require_once __DIR__ . "/../core/responseData.class.php";
require_once __DIR__ . "/../models/Student.php";
require_once __DIR__ . "/../dao/StudentDAO.php";

class DeleteStudentController extends responseData
{
    public function index(...$params)
    {
        /**
         * SI NO EXISTE EL doGet, doPost, doDelete y doPut
         * ENTONCES SE EJECUTA EL INDEX COMO METODO PRESETERMINADO
         **/
    }
    /**
     * ENDPOINT > /students
     * ENDPOINT > /students?page=1&perPage=10
     * ENDPOINT > /students?page=1&perPage=10
     * body:
    {
    "registration" : "null",
    "name" : "null",
    "gender" : "null",
    "ethnicity" : "null",
    "career" : "null",
    "status" : "null"
    }
     * @param $params
     * @return mixed
     */
    public function doGet(...$params)
    {
    }

    public function doPost(...$params)
    {
        if (!isset($params["registration"])) {
            return parent::error_400("No enviaste el parametro registration");
        }

        $studentDAO = new StudentDAO();
        $result = $studentDAO->DeleteStudent($params["registration"]);
        return parent::sendJsonResponse("ok", $result);
    }
}

