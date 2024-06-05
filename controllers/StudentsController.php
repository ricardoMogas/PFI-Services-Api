<?php
require_once __DIR__ . "/../core/responseData.class.php";
require_once __DIR__ . "/../models/Student.php";
require_once __DIR__ . "/../dao/StudentDAO.php";

class StudentsController extends responseData
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
        $studentDAO = new StudentDAO();
        $page = 1;
        $perPage = 10;
        $registration = null;
        $name = null;
        $p_last_name = null;
        $m_last_name = null;
        $gender = null;
        $ethnicity = null;
        $career = null;
        $status = null;

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
            $page, $perPage, $registration, $name, $p_last_name, $m_last_name, $gender, $ethnicity, $career, $status
        );
        $resultTotal = $studentDAO->GetTotalStudents();
        $response = array(
            "total" => $resultTotal,
            "data" => $result,
        );
        return parent::sendJsonResponse("ok", $response);
    }

    /*
     * ENDPOINT > /students
     * body:
        {
            "registration" : "66209",
            "name" : "Alvira Jesus Hidalgo pech",
            "gender" : "Mujer",
            "birthday_date" : "2001-10-28",
            "ethnicity" : "Otro",
            "career" : "ISC",
            "status" : "Activo",
            "origin_place" : "Campeche"
            'date_of_registration' : "2021-10-28"
        }

     */
    public function doPost(...$params)
    {

        if (!isset($params["registration"]) || !isset($params["name"]) || !isset($params["gender"]) ||
            !isset($params["birthday_date"]) || !isset($params["ethnicity"]) || !isset($params["career"]) ||
            !isset($params["status"]) || !isset($params["origin_place"]) || !isset($params["date_of_registration"])) {
            return parent::error_400($params["date_of_registration"]);
        }

        $studentDAO = new StudentDAO();
        $student = new Student();
        $student->registration = $params["registration"];
        $student->name = $params["name"];
        $student->p_last_name = "N/A";
        $student->m_last_name = "N/A";
        $student->gender = rtrim($params["gender"], ".");
        $student->birthday_date = $params["birthday_date"];
        $student->ethnicity = $params["ethnicity"];
        $student->career = $params["career"];
        $student->status = $params["status"];
        $student->origin_place = $params["origin_place"];
        $student->date_of_registration = empty($params["date_of_registration"]) ? date("Y-m-d") : $params["date_of_registration"];

        $result = $studentDAO->InsertStudent($student);
        return parent::sendJsonResponse("ok", $result);
    }
    /*
     * ENDPOINT > /students
     * body:
    {
        "registration" : "66209",
        "name" : "Alvira Jesus Hidalgo pech",
        "gender" : "Mujer",
        "birthday_date" : "2001-10-29",
        "ethnicity" : "Otro",
        "career" : "ISC",
        "status" : "Activo",
        "origin_place" : "Campeche"
    }
    */
    public function doPut(...$params)
    {
        if (!isset($params["registration"]) || !isset($params["name"]) || !isset($params["gender"]) ||
            !isset($params["birthday_date"]) || !isset($params["ethnicity"]) || !isset($params["career"]) ||
            !isset($params["status"]) || !isset($params["origin_place"])) {
            return parent::error_400("Faltan datos obligatorios");
        }

        $studentDAO = new StudentDAO();
        $student = new Student();
        $student->registration = $params["registration"];
        $student->name = $params["name"];
        $student->p_last_name = "N/A";
        $student->m_last_name = "N/A";
        $student->gender = $params["gender"];
        $student->birthday_date = $params["birthday_date"];
        $student->ethnicity = $params["ethnicity"];
        $student->career = $params["career"];
        $student->status = $params["status"];
        $student->origin_place = $params["origin_place"];
        $student->date_of_registration = date("Y-m-d");

        $result = $studentDAO->UpdateStudent($student);
        return parent::sendJsonResponse("ok", $result);
    }
    /*
        * ENDPOINT > /students?registration=12345
    */
    
    public function doDelete(...$params)
    {
        if (!isset($params["registration"])) {
            return parent::error_400("No enviaste el parametro registration");
        }

        $studentDAO = new StudentDAO();
        $result = $studentDAO->DeleteStudent($params["registration"]);
        return parent::sendJsonResponse("ok", $result);
    }
}

