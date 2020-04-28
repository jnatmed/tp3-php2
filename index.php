<?php

include 'controlador/form_controller.php';
include 'controlador/planilla.turnos.controller.php';
include 'controlador/dbController.php';

// use \App\controlador\form_controller;
use \App\controlador\planillaTurnosController;
use \App\controlador\dbController;

$fController = new form_controller;
$planillaTurnos = new planillaTurnosController;
$dbController = new dbController;

$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$http_method = $_SERVER["REQUEST_METHOD"];

// echo ("<pre>");
// var_dump($url_path);
// exit(0);

if ($url_path == '/save_formulario' && $http_method == 'POST'){
    $fController->guardarFormulario();
}else if($url_path == '/turno_confirmado' && $http_method == 'POST'){
    $fController->reservarTurno();
}else if($url_path == '/tp3-php2/' && $http_method == 'GET'){
    // $planillaTurnos->verPlanillaTurnos();
    $dbController->getTurnos();
// }else if($url_path == '/' && $http_method == 'POST'){
//     $planillaTurnos->verTurnoReservado();
// }else if($url_path == '/' && $http_method == 'GET'){
//     $fController->mostrarFormulario();
}else {
    http_response_code(404);
    include "views/error.404.view.php"; 
}

?>