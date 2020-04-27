<?php
include "models/TurnosDBModel.php";

// namespace \App\controlador;


use \App\models\TurnosDBModel;

// class dbController
// {
$datos;
$turno;
$turno = new TurnosDBModel;
$datos = $turno->getTurnos();    
include "views/turnosView.php";

//     public function __construct(){
//         $this->turno = new TurnosDBModel;
//     }

//     public function getTurnos(){

//         $this->datos = $turno->getTurnos();
    
//         include "views/turnosView.php";
//     }
// }



?>