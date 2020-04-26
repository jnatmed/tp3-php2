<?php
include "models/TurnosDBModel.php";

namespace \App\controlador;

use \App\models\TurnosDBModel;

class dbController
{
    public $datos;
    public $turno;

    public function __construct(){
        $this->turno = new dbTurnos();
    }

    public function getTurnos(){

        $this->datos = $turno->getTurnos();
    
        include "views/turnosView.php";
    }
}

?>