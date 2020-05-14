<?php

namespace App\controlador;

// include 'models/TurnosDBModel.php';
include 'controlador/imagenController.php';
include 'controlador/planilla.turnos.controller.php';

use \App\models\TurnosDBModel;
use \App\controlador\imagenController;
use \App\controlador\planillaTurnosController;

class form_controller
{
    public $lista_datos = [];
    public $tipo_restriccion = [];
    public $datos_reserva = [];
    public $planilla = [];
    public $planillaController = NULL;
    public $imgController = NULL;
    public $dbturnos;
    public $id_turno_update;

    public function __construct()
    {
        $this->planillaController = new planillaTurnosController;
        $this->dbturnos = new TurnosDBModel;
    }

    public function carga_arreglo($datosTurno, $pathImg = "", $tipo_imagen = "")
    {        
        // echo("<pre>");
        // var_dump($datosTurno);
        // exit(); 
        $this->datos_reserva['nombre_paciente'] = $datosTurno['Nombre_del_Paciente'];
        $this->datos_reserva['email'] = $datosTurno['Email'];
        $this->datos_reserva['telefono'] = $datosTurno['Telefono'];
        $this->datos_reserva['edad'] = intval($datosTurno['Edad']); 
        $this->datos_reserva['talla_calzado'] = $datosTurno['Talla_de_calzado'];
        $this->datos_reserva['altura'] = $datosTurno['altura'];
        $this->datos_reserva['fecha_nacimiento'] = $datosTurno['Fecha_de_nacimiento'];
        $this->datos_reserva['color_pelo'] = $datosTurno['Color_de_pelo'];
        $this->datos_reserva['fecha_turno'] = $datosTurno['Fecha_del_turno'];
        $this->datos_reserva['hora_turno'] = $datosTurno['Horario_del_turno'];
        $this->datos_reserva['dir_img'] = $pathImg;    
        $this->datos_reserva['tipo_imagen'] = $tipo_imagen;    
    }

    public function mostrarFormulario()
    {
        $this->agregar_dato('Nombre del Paciente','required','nombre','[a-zA-Z]+');
        $this->agregar_dato('Email', 'required','email','[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$');
        $this->agregar_dato('Telefono', 'required','tel','[0-1]{2}-[0-9]{4}-[0-9]{4}');
        $this->agregar_dato('Edad', '', 'edad','18-60');
        $this->agregar_dato('Talla de calzado', '', 'calzado','20-45');
        $this->agregar_dato('altura', '','altura','1-3');
        $this->agregar_dato('Fecha de nacimiento', 'required','date');
        $this->agregar_dato('Color de pelo','required','pelo','rubio-negro-castaño-marron');
        $this->agregar_dato('Fecha del turno', 'required','date');
        $this->agregar_dato('Horario del turno', '', 'horario_turno','8-17-15');
        
        include "views/form.persona.view.php";
    }

    public function modificacionTurno(){
        $valores = [];
        
        $valores = $this->dbturnos->getTurnoSeleccionado($_POST['modificacion_turno']);
        // echo("<pre>");
        // echo("modificacionTurno<br>");
        // var_dump($valores);
        // exit();
        $this->agregar_dato('Nombre del Paciente','required','nombre','[a-zA-Z]+',$valores[0]['nombre_paciente']);
        $this->agregar_dato('Email', 'required','email','[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$',$valores[0]['email']);
        $this->agregar_dato('Telefono', 'required','tel','[0-1]{2}-[0-9]{4}-[0-9]{4}',$valores[0]['telefono']);
        $this->agregar_dato('Edad', '', 'edad','18-60',$valores[0]['edad']);
        $this->agregar_dato('Talla de calzado', '', 'calzado','20-45',$valores[0]['talla_calzado']);
        $this->agregar_dato('altura', '','altura','1-3', $valores[0]['altura']);
        $this->agregar_dato('Fecha de nacimiento', 'required','date','',$valores[0]['fecha_nacimiento']);
        $this->agregar_dato('Color de pelo','required','pelo','rubio-negro-castaño-marron',$valores[0]['color_pelo']);
        $this->agregar_dato('Fecha del turno', 'required','date','',$valores[0]['fecha_turno']);
        $this->agregar_dato('Horario del turno', '', 'horario_turno','8-17-15',$valores[0]['hora_turno']);
        
        // echo("<pre>");
        // echo("modificacionTurno<br>");
        // var_dump($this->lista_datos);
        // exit();
        $this->id_turno_update = $_POST['modificacion_turno'];

        include "views/modificar.turno.view.php";
    }

    public function agregar_dato($nombre_campo, $obligatorio = '', $tipo, $restriccion='', $valor = '')
    {
        $this->tipo_restriccion['nombre_campo'] = $nombre_campo;
        $this->tipo_restriccion['obligatorio'] = $obligatorio;
        $this->tipo_restriccion['tipo'] = $tipo;
        $this->tipo_restriccion['restriccion'] = $restriccion;
        $this->tipo_restriccion['valor'] = $valor;
        $this->lista_datos[] = $this->tipo_restriccion;
    }
  
    public function guardarFormulario(){

        $datos_mal_cargados = [];

        $this->carga_arreglo($_POST);

        $fecha_actual = strtotime(date("d-m-Y",time()));
        $fecha_turno = strtotime(date("d-m-Y",strtotime($_POST['Fecha_del_turno'])));
        $fecha_nacimiento = date("d-m-Y H:i:00",strtotime($_POST['Fecha_de_nacimiento']));
        $año_nacimiento = intval(date("o",strtotime($_POST['Fecha_de_nacimiento'])));
        $edad_ingresada = $this->datos_reserva['edad'];
        $año_actual = intval(date("o",time()));
        $dia_turno = date("l",$fecha_turno);

        if (($edad_ingresada + $año_nacimiento) < $año_actual){ // comprobar edad y fecha nacimiento
            $this->datos_mal_cargados[] = '#ERROR EDAD FECHA NACIMIENTO: la edad debe ser consistente con la fecha de nacimiento';
        }
        if(date("l",$fecha_turno) == 'Sunday'){ // que no sea dia domingo
            $this->datos_mal_cargados[] = '#ERROR DIA TURNO: la fecha del turno no puede ser domingo';
        }
        if( $fecha_actual > $fecha_turno){ // que sea superior a la fecha actual
            $this->datos_mal_cargados[] = '#ERROR FECHA TURNO: la fecha del turno debe ser superior o igual al dia actual';    
        }


        $this->imgController = new imagenController($_FILES);

        if ($this->imgController->getTamanioImagen() <> 0){
            if($this->imgController->controlTamanioMaximoImagen()){
                if($this->imgController->controlTipoImagenValida()){
                    $this->imgController->codificar();
                    $this->datos_reserva['dir_img'] = $this->imgController->getImagenCodificada();
                    $this->datos_reserva['tipo_imagen'] = $this->imgController->getTipoImagen();
                    $this->imgController->devolverPathImagen($this->datos_reserva['dir_img']);                
                }else{
                    $this->datos_mal_cargados[] = "#ERROR IMAGEN: Tipo de imagen no valido.";
                }    
            }else{
                $this->datos_mal_cargados[] = "#ERROR IMAGEN: Imagen no cargada, Tamanio de carga Excedido => ".$this->imgController->getTamanioEnMB();
             }
        }else{
            echo("Imagen no cargada");
        } 

        if ($this->planillaController->buscarFechaTurno($this->datos_reserva['fecha_turno'],$this->datos_reserva['hora_turno'])){
            $this->datos_mal_cargados[] =  "#ERROR FECHA Y HORA TURNO: La fecha y turno cargados ya fueron asignados a otro paciente.";    
        }
        

        include "views/reserva.turno.view.php";
    }

    public function reservarTurno()
    {   
        // echo("<pre>");
        // echo("reservarTurno<br>");
        // var_dump($_POST);
        // exit();

        if (array_key_exists('enviar',$_POST)){
            $this->carga_arreglo($_POST,$_POST['dir_img'], $_POST['tipo_imagen']);
            $this->planillaController->guardarTurnoConfirmado($this->datos_reserva);
            $this->planillaController->verPlanillaTurnos();
        }else{
            $this->mostrarFormulario();
        }
    }

}

?>