<?php

include 'controlador/form_controller.php';

$fController = new form_controller;

$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$http_method = $_SERVER["REQUEST_METHOD"];

// echo "<pre>";
// var_dump($_SERVER);
// var_dump($url_path);
// var_dump($http_method);
// exit(0);


if ($url_path == '/save_formulario' && $http_method == 'POST'){
    $fController->guardarFormulario();
}else if($url_path == '/turno_confirmado' && $http_method == 'POST'){
    $fController->reservarTurno();
}else if($url_path == '/' && $http_method == 'GET'){
    $fController->mostrarFormulario();
}else {
    http_response_code(404);
    include "views/error.404.view.php"; 
}


?>