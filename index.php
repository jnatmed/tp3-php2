<?php

// phpinfo();
// exit();
// echo("hola mundo");

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

if($url_path == '/' && $http_method == 'GET'){
    $formController->mostrarFormulario();    
}else if ($url_path == '/planilla_turnos' && $http_method == 'GET'){
    $planillaTurnos->verPlanillaTurnos();
}else if ($url_path == '/save_formulario' && $http_method == 'POST'){
    $formController->guardarFormulario();
}else if ($url_path == '/turno_confirmado' && $http_method == 'POST'){
    $formController->reservarTurno();
}else if ($url_path == '/ver_turno_reservado' && $http_method == 'POST'){
    $planillaTurnos->verTurnoReservado();
}else if ($url_path == '/guardar_modificacion_turno' && $http_method == 'POST'){
    // echo("<pre>");
    // echo("guardar_modificacion_turno<br>");
    // var_dump($_FILES);
    // exit(); 
    $formController->guardarTurnoModificado();
}else if ($url_path == '/edicion_turno' && $http_method == 'POST'){
    if(isset($_POST['baja_turno'])){
        $planillaTurnos->bajaTurnoReservado();
    }else if($_POST['modificacion_turno']){
        $formController->modificacionTurno();
    }else{
        http_response_code(404);
        include "views/estructura/error.404.view.php";     
    }
}else {
    http_response_code(404);
    include "views/estructura/error.404.view.php"; 
}

?>