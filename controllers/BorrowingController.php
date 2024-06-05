<?php
require_once(__DIR__ . "/../core/responseData.class.php");
require_once(__DIR__ . "/../dao/BorrowingDAO.php");
class BorrowingController extends responseData{
    public function index(...$params) 
    {
    }
    /**
     * ENDPOINT > /copies
     * ENDPOINT > /copies?registration=20160234
     * ENDPOINT > /copies?registration=20160234&date=2021-10-10
     * no le envias nada entonces te regresa todas las copias existentes
     * si le das la matricula solo, te regresa las copias hechas por esa persona en el mes actual
     * y si le das las dos cosas, te regresa las copias hechas por esa persona en la fecha especificada
     */
    public function doGet(...$params) 
    {
        if (isset($params["GetTypeBorrowing"])) {
            $borrowingDAO = new BorrowingDAO();
            $result = $borrowingDAO->GetTypeBorrowing();
            return parent::sendJsonResponse("ok", $result);
        }

    }
    /**
     * ENDPOINT > /Copies?registration=66208&total=1
     * ENDPOINT > /Copies?registration=66208&total=1&date=2021-10-10
     * Cuando le das la matricula y el total, se inserta una copia en la base de datos con la fecha actual
     * si le das la fecha, se inserta la copia con la fecha especificada
     * 
    */
     public function doPost(...$params) 
    {
    }
}
?>