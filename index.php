<?php

include 'controlador/form_controller.php';
// include 'controlador/planilla.turnos.controller.php';

use \App\controlador\form_controller;
use \App\controlador\planillaTurnosController;

$formController = new form_controller;
$planillaTurnos = new planillaTurnosController;

$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$http_method = $_SERVER["REQUEST_METHOD"];

// echo ("<pre>");
// var_dump($_SERVER);
// exit(0);
error_reporting(E_ALL);
ini_set('display_errors','On');

if($url_path == '/' && $http_method == 'GET'){
    echo ("hola estoy aqui");
    // $formController->mostrarFormulario();    
    $planillaTurnos->verPlanillaTurnos();
}else if ($url_path == '/planilla_turnos' && $http_method == 'GET'){
    $planillaTurnos->verPlanillaTurnos();
}else {
    http_response_code(404);
    include "views/error.404.view.php"; 
}

?>