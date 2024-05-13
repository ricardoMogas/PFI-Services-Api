<?php
/**
 * version: 0.0.1
 * Autor: Ricardo J Moo Vargas
 * Fecha de inicio: 25/01/2024
 */
date_default_timezone_set('America/Mexico_City');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}
require_once __DIR__ . '/core/FrontController.php';

// Crear una instancia de la clase FrontController
$frontController = new FrontController($inFolder = true);

// crear una pagina
