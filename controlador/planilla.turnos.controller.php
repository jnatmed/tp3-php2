<?php

namespace App\controlador;

class planillaTurnosController
{
    public $planillaTurnos = [];
    public $pathTurnos = "baseDatosTurnos/planillaTurnos.json";
    public $tamaño_planilla = 0;
    public $archivoTurnos = "";

    public function __construct()
    {
        $this->archivoTurnos = file_get_contents($this->pathTurnos);
        $this->planillaTurnos = json_decode($this->archivoTurnos, true);
        // $this->$tamaño_planilla = count($this->planillaTurnos);
        // var_dump(count($this->planillaTurnos));    

    }


    public function guardarTurnoConfirmado($turno)
    {
        
        $this->planillaTurnos[count($this->planillaTurnos)+1] = $turno;
        $json_planillaTurnos = json_encode($this->planillaTurnos);
        file_put_contents($this->pathTurnos, $json_planillaTurnos);
    }

    public function verPlanillaTurnos()
    {

        include "views/planilla.turnos.view.php";
    }

}

?>