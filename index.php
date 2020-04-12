<?php

include 'controlador/form_controller.php';
include 'controlador/planilla.turnos.controller.php';

// use \App\controlador\form_controller;
use \App\controlador\planillaTurnosController;

$fController = new form_controller;
$planillaTurnos = new planillaTurnosController;

$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$http_method = $_SERVER["REQUEST_METHOD"];

if ($url_path == '/save_formulario' && $http_method == 'POST'){
    $fController->guardarFormulario();
}else if($url_path == '/turno_confirmado' && $http_method == 'POST'){
    $fController->reservarTurno();
}else if($url_path == '/planilla_turnos' && $http_method == 'GET'){
    $planillaTurnos->verPlanillaTurnos();
}else if($url_path == '/' && $http_method == 'GET'){
    $fController->mostrarFormulario();
}else {
    http_response_code(404);
    include "views/error.404.view.php"; 
}

?>