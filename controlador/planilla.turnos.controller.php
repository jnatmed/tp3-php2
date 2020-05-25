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

    public function verPlanillaTurnos()
    {
        // echo("pre");
        // var_dump($this->planillaTurnos);
        $this->planillaTurnos = $this->dbturnos->getTurnos();

        include "views/listado.turnos.view.php";
    }

    public function verTurnoReservado()
    {
        $this->turno = $this->dbturnos->getTurnoSeleccionado($_POST['id_turno']);
        $this->imgController = new imagenController();
        if($this->turno[0]['imagen'] <> ''){
            $this->imgController->setTipoImagen($this->turno[0]['tipo_imagen']);
            $this->imgController->controlTipoImagenValida();
            $this->imgController->devolverPathImagen($this->turno[0]['imagen']);
        }
        // echo("<pre>");    
        // echo("verTurnoReservado<br>");    
        // var_dump($this->turno);
        // exit();

        include "views/consulta.turno.view.php";
    }
    public function bajaTurnoReservado()
    {
        // echo("<pre>");    
        // echo("bajaTurnoReservado<br>");    
        // var_dump($_POST);
        // exit();
        $this->turno = $this->dbturnos->bajaTurnoSeleccionado($_POST);
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