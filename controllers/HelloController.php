<?php
require_once(__DIR__ . "/../core/responseData.class.php");

class HelloController extends responseData{
    public function index(...$params) 
    {
        /** 
         * SI NO EXISTE EL doGet, doPost, doDelete y doPut
         * ENTONCES SE EJECUTA EL INDEX COMO METODO PRESETERMINADO
        **/
    }
    
    public function doGet(...$params) 
    {
        // 
        /*
        PARA EVITAR EL ERROR DE QUE NO EXISTA EL PARAMETRO NAME
        if (!isset($params["name"])) {
            $responseError = parent::error_400();
            echo json_encode($responseError);
            return;
        }
        */

        $data = array(
            "name" => "Ricardo",
            "data" => "hola mundo"
        );
        if (isset($data)) {
            return $data;
        } else {
            $responseError = parent::error_404();
            return $responseError;
        }
    }
    public function doPost(...$params) {
        return "Hola mundo";
    }
}
?>