<?php

namespace App\controlador;

include "models/TurnosDBModel.php";

use \App\models\TurnosDBModel;


class planillaTurnosController
{
    public $planillaTurnos = [];
    public $pathTurnos = "baseDatosTurnos/planillaTurnos.json";
    public $tamaño_planilla = 0;
    public $archivoTurnos = "";
    public $turno = [];
    public $dbturnos;
    // public $nombresColumnas;

    public function __construct()
    {
        // ACA SE OBTIENE LA BASE DE DATOS   
        $this->dbturnos = new TurnosDBModel;
        // $this->archivoTurnos = file_get_contents($this->pathTurnos);
        // $this->planillaTurnos = json_decode($this->archivoTurnos, true);
        // $this->nombresColumnas = [
        //     `id`, 
        //     `fecha_turno`, 
        //     `hora_turno`, 
        //     `nombre_paciente`, 
        //     `email`, 
        //     `telefono`, 
        //     `fecha_nacimiento`, 
        //     `edad`, 
        //     `talla_calzado`, 
        //     `altura`, 
        //     `color_pelo`
        // ];
        $this->planillaTurnos = $this->dbturnos->getTurnos();
    }

    public function guardarTurnoConfirmado($turno)
    {
        // $this->planillaTurnos[count($this->planillaTurnos)+1] = $turno;
        // $json_planillaTurnos = json_encode($this->planillaTurnos);
        // file_put_contents($this->pathTurnos, $json_planillaTurnos);
        
    }

    public function verPlanillaTurnos()
    {
        // echo("pre");
        // var_dump($this->planillaTurnos);

        include "views/planilla.turnos.view.php";
    }

    public function cargarTurno($id_turno)
    {
        var_dump($id_turno);
        var_dump(intval($id_turno));
        $this->turno[] = $this->planillaTurnos[$id_turno];
    }

    public function verTurnoReservado()
    {
        $this->turno = $this->dbturnos->getTurnoSeleccionado($_POST['id_turno']);
        include "views/turno.reservado.view.php";
    }
    public function bajaTurnoReservado()
    {
        $this->turno = $this->dbturnos->bajaTurnoSeleccionado($_POST['id_turno']);
        include "views/planilla.turnos.view.php";
    }

    public function buscarFechaTurno($fecha_turno, $hora_turno)
    {
        $existeTurno = false;
        foreach ($this->planillaTurnos as $id_turno => $turno):

            if ($turno['fecha_turno'] == $fecha_turno && $turno['hora_turno'] == $hora_turno)
            {
                $existeTurno = true;
            }
        endforeach;
        return $existeTurno;
    }

}

?>