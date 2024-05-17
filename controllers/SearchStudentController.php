<?php
require_once __DIR__ . "/../core/responseData.class.php";
require_once __DIR__ . "/../models/Student.php";
require_once __DIR__ . "/../dao/StudentDAO.php";

class SearchStudentController extends responseData
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
    public function doPost(...$params)
    {
        $studentDAO = new StudentDAO();
        $page = 1;
        $perPage = 10;
        $registration = null;
        $name = null;
        $p_last_name = null;
        $m_last_name = null;
        $birth_date = null;
        $ethnicity = null;
        $gender = null;
        $career = null;
        $status = null;
        $origin_place = null;
        $date_of_registration = null;

        if (!isset($params["page"]) || !isset($params["perPage"])) {
            $result = $studentDAO->GetAll();
            return parent::sendJsonResponse("ok", $result);
        } else {
            if (!is_numeric($params["page"]) || !is_numeric($params["perPage"])) {
                return $this->error_400("page, perPage, FORMATO INCORRECTO");
            }
            $page = $params["page"];
            $perPage = $params["perPage"];
        }
        // COMPROBAR EXISTENCIA DE CADA FILTRO
        if (!isset($params["registration"]) && !isset($params["name"]) &&
            !isset($params["gender"]) && !isset($params["ethnicity"]) &&
            !isset($params["career"]) && !isset($params["status"])) {
            $result = $studentDAO->SearchStudent(
                $page, $perPage, $registration, $name, $p_last_name, $m_last_name, $gender, $ethnicity, $career, $status
            );
            $resultTotal = $studentDAO->GetTotalStudents();
            $response = array(
                "total" => $resultTotal,
                "data" => $result,
            );
            return parent::sendJsonResponse("ok", $response);
        } else {
            if ($params["registration"] !== "null") {
                $registration = $params["registration"];
            } elseif ($params["name"] !== "null") {
                $name = $params["name"];
            } elseif ($params["gender"] !== "null") {
                $gender = $params["gender"];
            } elseif ($params["ethnicity"] !== "null") {
                $ethnicity = $params["ethnicity"];
            } elseif ($params["career"] !== "null") {
                $career = $params["career"];
            } elseif ($params["status"] !== "null") {
                $status = $params["status"];
            }

        }
        $result = $studentDAO->SearchStudent(
            $page, $perPage, $registration, $name, $p_last_name, $m_last_name, $gender, $birthday_date = null, $ethnicity, $career, $status
        );
        $resultTotal = $studentDAO->GetTotalStudents();
        $response = array(
            "total" => $resultTotal,
            "data" => $result,
            "TEST" => $params
        );
        return parent::sendJsonResponse("ok", $response);
    }
}

