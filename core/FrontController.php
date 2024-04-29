<?php

class FrontController
{
    private $checkSession = true; // Indica si se debe verificar la sesión

    public function __construct()
    {
        spl_autoload_register([$this, 'autoload']);
        $this->handleRouting();
    }

    public function isSessionStarted()
    {
        return $this->checkSession && isset($_SESSION['user_id']);
    }

    private function autoload($nameClass)
    {
        $classFile = __DIR__ .'/controllers/' . $nameClass . '.php';
        if (file_exists($classFile)) {
            include_once $classFile;
        } else {
            return;
        }
    }

    private function goToController($url, $urlSegments, $action, $body)
    {
        $params = array();
        $NameComplete = !empty($urlSegments[1]) ? ucfirst($urlSegments[1]) : 'Help';
        // si es nameComplete es igual a Help, entonces se redirige a la página de ayuda
        if ($NameComplete == 'Help') {
            $this->goToDocs();
            return;
        }

        // Determinar si hay parámetros en la URL
        if (strpos($NameComplete, '?') !== false) {
            $controllerName = strstr($NameComplete, '?', true);
            $urlComponents = parse_url($url);
            parse_str($urlComponents['query'], $params);
        } else {
            $controllerName = $NameComplete;
        }

        $controllerClassName = $controllerName . 'Controller';

        try {
            // Intentar instanciar el controlador
            if (class_exists($controllerClassName)) {
                $controller = new $controllerClassName();

                // Verificar si el método existe en el controlador
                if (method_exists($controller, $action)) {
                    return call_user_func_array([$controller, $action], array_merge($params ?? [], $body ?? []));
                } elseif (method_exists($controller, 'index')) {
                    $action = 'index';
                    return call_user_func_array([$controller, $action], array_merge($params ?? [], $body ?? []));
                } else {
                    header('Content-Type: application/json');
                    throw new Exception("Método Index no encontrado, declarar método index en el controlador");
                }
            } else {
                header('Content-Type: application/json');
                throw new Exception("Controlador no encontrado: $controllerClassName");
            }
        } catch (Exception $e) {
            // Manejar la excepción
            return "Error: " . $e->getMessage();
        }
    }

    private function handleRouting()
    {
        $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        $action = !empty($urlSegments[2]) ? $urlSegments[2] : 'index'; //ya no uso los segmentes para la acción REVISAR 
        $method = $_SERVER['REQUEST_METHOD'];
        $urlSegments = explode('/', trim($url, '/'));
        $body = json_decode(file_get_contents('php://input'), true);

        switch ($method) {
            case 'GET':
                $action = 'doGet';
                echo json_encode($this->goToController($url, $urlSegments, $action, $body));
                break;
            case 'POST':
                $action = 'doPost';
                echo json_encode($this->goToController($url, $urlSegments, $action, $body));
                break;
            case 'PUT':
                $action = 'doPut';
                echo json_encode($this->goToController($url, $urlSegments, $action, $body));
                break;
            case 'DELETE':
                $action = 'doDelete';
                echo json_encode($this->goToController($url, $urlSegments, $action, $body));
                break;
            default:
                echo json_encode(['error' => '404', 'error_msg' => 'Método no permitido']);
                break;
        }
    }

    public function goToDocs()
    {
        header('Location: '.__DIR__.'/docs/index.html');
    }
}
