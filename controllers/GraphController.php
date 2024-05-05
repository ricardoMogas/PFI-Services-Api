<?php
require_once(__DIR__ . "/../core/responseData.class.php");

class GraphController extends responseData{
    public function index(...$params) 
    {
        /** 
         * SI NO EXISTE EL doGet, doPost, doDelete y doPut
         * ENTONCES SE EJECUTA EL INDEX COMO METODO PRESETERMINADO
        **/
    }
    
    public function doGet(...$params) 
    {

    }

    public function doPost(...$params) {
        
    }
}
?>