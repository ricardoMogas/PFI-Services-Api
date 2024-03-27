<?php
include(dirname(__FILE__) . '/../config.php');

class ConexionDB
{
    private $host;
    private $username;
    private $password;
    private $db;
    private $conexion;

    //constructor 
    public function __construct()
    {
        $this->host = DB_HOST;
        $this->username = DB_USERNAME;
        $this->password = DB_PASSWORD;
        $this->db = DB_NAME;
        $this->conectar(); // Conecta al construir el objeto
    }

    public function conectar()
    {
        $this->conexion = new mysqli($this->host, $this->username, $this->password, $this->db);
        if ($this->conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $this->conexion->connect_error);
        }
        //echo "Conexion establecida.";
    }

    // Método para cerrar la conexión a la base de datos
    public function cerrar()
    {
        if ($this->conexion) {
            $this->conexion->close();
            //echo "Conexión a la base de datos cerrada.";
        }
    }

    // Método para convertir UTF8
    private function convertUTF8($array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });
        return $array;
    }

    // Método para ejecutar una consulta SELECT y obtener los resultados
    public function getData($sqlstr)
    {
        try {
            $stmt = $this->conexion->prepare($sqlstr); //evitar inyecciones de codigo
            if ($stmt === false) {
                throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
            }

            $stmt->execute();
            $result = $stmt->get_result();
            $resultArray = $result->fetch_all(MYSQLI_ASSOC); //función para convertir consultas hechas directamente en arreglos

            return $this->convertUTF8($resultArray);
        } catch (Exception $e) {
            throw new Exception("Error al obtener datos: " . $e->getMessage());
        }
    }

    // Método para ejecutar una consulta INSERT
    public function insertData($sqlstr, $params)
    {
        try {
            // Verificar si la consulta comienza con "INSERT"
            if (stripos(trim($sqlstr), 'insert') === 0) {
                $stmt = $this->conexion->prepare($sqlstr);
                if ($stmt === false) {
                    throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
                }

                $stmt->execute($params);
                $stmt->close();
            } else {
                throw new Exception("Solo se permiten consultas INSERT.");
            }
        } catch (Exception $e) {
            throw new Exception("Error al ejecutar el query: " . $e->getMessage());
        }
    }

    // Método para ejecutar una consulta INSERT y obtener el ID insertado
    public function insertDataId($sqlstr, $params)
    {
        try {
            // Verificar si la consulta comienza con "INSERT"
            if (stripos(trim($sqlstr), 'insert') === 0) {
                $stmt = $this->conexion->prepare($sqlstr);
                if ($stmt === false) {
                    throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
                }

                $stmt->execute($params);
                $insertId = $stmt->insert_id;  // Obtener el ID de la fila insertada
                $stmt->close();

                return $insertId;
            } else {
                throw new Exception("Solo se permiten consultas INSERT.");
            }
        } catch (Exception $e) {
            throw new Exception("Error al ejecutar el query: " . $e->getMessage());
        }
    }

    // Método para ejecutar una consulta UPDATE
    public function updateData($sqlstr, $params = [])
    {
        try {
            // Verificar si la consulta comienza con "UPDATE"
            if (stripos(trim($sqlstr), 'update') === 0) {
                $stmt = $this->conexion->prepare($sqlstr);
                if ($stmt === false) {
                    throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
                }

                // Vincular los parámetros y ejecutar la consulta
                if (!empty($params)) {
                    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
                }
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("Solo se permiten consultas UPDATE.");
            }
        } catch (Exception $e) {
            throw new Exception("Error al ejecutar el query: " . $e->getMessage());
        }
    }

    // Método para ejecutar una consulta DELETE
    public function deleteData($sqlstr, $params = [])
    {
        try {
            // Verificar si la consulta comienza con "DELETE"
            if (stripos(trim($sqlstr), 'delete') === 0) {
                $stmt = $this->conexion->prepare($sqlstr);
                if ($stmt === false) {
                    throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
                }

                // Vincular los parámetros y ejecutar la consulta
                if (!empty($params)) {
                    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
                }
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("Solo se permiten consultas DELETE.");
            }
        } catch (Exception $e) {
            throw new Exception("Error al ejecutar el query: " . $e->getMessage());
        }
    }
}
/*
// Ejemplo de uso de insertData CON PARAMETROS
$conexionDB = new ConexionDB();
$sql = "INSERT INTO registered_visits (no_Visit, registration, entry_time, exit_time, visit_date) 
        VALUES (?, ?, ?, ?, ?)";
$params = [
    $no_visitValue = null, // reemplaza esto con el valor real
    $registrationValue = 68322, // reemplaza esto con el valor real
    $entry_time = date("H:i:s"), // reemplaza esto con el valor real
    $exit_time = null, // reemplaza esto con el valor real
    $visit_date = date("Y-m-d"), // reemplaza esto con el valor real
];

try {
    $conexionDB->insertData($sql, $params);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
*/