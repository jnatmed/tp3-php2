<?php

namespace App\controlador;

include "models/TurnosDBModel.php";

use \App\models\TurnosDBModel;
use \App\controlador\imagenController;

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

        // $this->planillaTurnos = $this->dbturnos->getTurnos();
    }

    public function guardarTurnoModificado(){
        // echo("<pre>");
        // echo("guardarTurnoModificado<br>");
        // var_dump($_POST);
        // exit();        

        $this->dbturnos->actualizarTurno($_POST,$_FILES);
        $this->verPlanillaTurnos();
    }

    public function guardarTurnoConfirmado($turno)
    {
        // echo("<pre>");
        // echo("guardarTurnoConfirmado<br>");
        // var_dump($turno);
        // exit();        
        $this->dbturnos->insertarTurno($turno);
    }

    public function verPlanillaTurnos()
    {
        // echo("pre");
        // var_dump($this->planillaTurnos);
        $this->planillaTurnos = $this->dbturnos->getTurnos();

        include "views/planilla.turnos.view.php";
    }

    // public function cargarTurno($id_turno)
    // {
    //     var_dump($id_turno);
    //     var_dump(intval($id_turno));
    //     $this->turno[] = $this->planillaTurnos[$id_turno];
    // }

    public function verTurnoReservado()
    {
        $this->turno = $this->dbturnos->getTurnoSeleccionado($_POST['id_turno']);
        $this->imgController = new imagenController();
        $this->turno[0]['imagen'] = $this->imgController->devolverPathImagen($this->turno[0]['imagen']);
        // echo("<pre>");    
        // echo("verTurnoReservado<br>");    
        // var_dump($this->turno);
        // exit();

        include "views/turno.reservado.view.php";
    }
    public function bajaTurnoReservado()
    {
        // echo("<pre>");    
        // echo("bajaTurnoReservado<br>");    
        // var_dump($_POST);
        // exit();
        $this->turno = $this->dbturnos->bajaTurnoSeleccionado($_POST['baja_turno']);
        $this->verPlanillaTurnos();
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