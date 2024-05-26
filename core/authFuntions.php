<?php
require_once "conexionDB.php";
require_once "responseData.class.php";

final class auth extends ConexionDB
{

    public function login($user, $password)
    {
        $responseData = new responseData;
        // si estan los campos entonces determinar si la contraseña
        // es correcata
        $usuario = $user;
        $contraseña = $password;
        $data = $this->getUser($usuario);
        if (!isset($data[0]['password'])) {
            return false;
        }
        $password = $data[0]['password'];
        if ($data && $password == $contraseña) {
            $response = [
                'id' => $data[0]['id'],
                "rol" => $data[0]['rol'],
            ];
            return $response;
        } else {
            return false;
        }
    }

    //Obtener usuario por medio del nombres
    private function getUser($name)
    {
        $query = "SELECT * FROM user WHERE name = '$name'";
        $data = parent::getData($query); //parent referencia a la clase padre extends ConexionDB
        if (isset($data[0]['id'])) {
            return $data;
        } else {
            return 0; //es igual a false
        }
    }
}
