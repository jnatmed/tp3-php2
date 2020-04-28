<?php

namespace App\controlador;

include "models/TurnosDBModel.php";

use \App\models\TurnosDBModel;

class dbController
{
    public $datos;
    public $turno;

    public function __construct(){
        $this->turno = new TurnosDBModel;
    }

    public function getTurnos(){

        $this->datos = $this->turno->getTurnos();
        
        var_dump($this->datos);
    
        include "views/turnosView.php";
    }
}



?>