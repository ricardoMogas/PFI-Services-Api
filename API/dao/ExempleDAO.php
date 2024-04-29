<?php

require_once(__DIR__ . "/../core/conexionDB.php");
require_once(__DIR__ . "/../core/responseData.class.php");
// require_once(__DIR__ . "/../models/Exemple.php");

final class ExempleDAO extends ConexionDB
{

    public function __construct()
    {
        parent::__construct();  // Call the parent class' constructor
    }

    public function GetAll()
    {
    }
    
    public function GetAllWithPagination($id)
    {
    }

    public function GetOne($exemple)
    {
    }

    public function Insert($exemple)
    {
    }
    
    public function SearchExample($exempleParam = null , $exampleParam2 = null)
    {
    }

    public function InsertExample($exemple)
    {
    }

    public function UpdateExample($exemple)
    {
    }

    public function DeleteExample($exemple)
    {
    } 
}
