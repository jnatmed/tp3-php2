<?php


class form_controller
{
    public $lista_datos = [];
    public $tipo_restriccion = [];
    public $datos_reserva = [];
    public $planilla = [];
    


    public function listar_datos()
    {
        include "views/form.persona.view.php";
    }

    public function mostrarFormulario()
    {
        $this->agregar_dato('Nombre del Paciente','required','nombre','[a-zA-Z]+');
        $this->agregar_dato('Email', 'required','email','[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$');
        $this->agregar_dato('Telefono', 'required','tel','[0-1]{3}-[0-9]{4}-[0-9]{4}');
        $this->agregar_dato('Edad', '', 'edad','18-60');
        $this->agregar_dato('Talla de calzado', '', 'calzado','20-45');
        $this->agregar_dato('Altura', '','altura','1-3');
        $this->agregar_dato('Fecha de nacimiento', 'required','date');
        $this->agregar_dato('Color de pelo','required','pelo','rubio-negro-castaño-marron');
        $this->agregar_dato('Fecha del turno', 'required','date');
        $this->agregar_dato('Horario del turno', '', 'horario_turno','8-17-15');
        
        // echo "<pre>";
        // var_dump($this->lista_datos[5]['tipo']);
        // var_dump($this->lista_datos[5]['nombre_campo']);
        // exit(0);

        $this->listar_datos();
    }

    public function agregar_dato($nombre_campo, $obligatorio = '', $tipo, $restriccion='')
    {
        $this->tipo_restriccion['nombre_campo'] = $nombre_campo;
        $this->tipo_restriccion['obligatorio'] = $obligatorio;
        $this->tipo_restriccion['tipo'] = $tipo;
        $this->tipo_restriccion['restriccion'] = $restriccion;
        $this->lista_datos[] = $this->tipo_restriccion;
    }
  
    public function guardarFormulario(){
        // echo "<pre>";
        // var_dump($_POST);
        // exit(0);
        $this->datos_reserva['nombre_paciente'] = $_POST['Nombre_del_Paciente'];
        $this->datos_reserva['email'] = $_POST['Email'];
        $this->datos_reserva['telefono'] = $_POST['Telefono'];
        $this->datos_reserva['edad'] = intval($_POST['Edad']); 
        $this->datos_reserva['talla_calzado'] = $_POST['Talla_de_calzado'];
        $this->datos_reserva['altura'] = $_POST['Color_de_Pelo'];
        $this->datos_reserva['fecha_nacimiento'] = $_POST['Fecha_de_nacimiento'];
        $this->datos_reserva['color_pelo'] = $_POST['Color_de_pelo'];
        $this->datos_reserva['fecha_turno'] = $_POST['Fecha_del_turno'];
        $this->datos_reserva['hora_turno'] = $_POST['Horario_del_turno'];

        $this->planilla[] = $this->datos_reserva;
        $datos_mal_cargados = [];

        $fecha_actual = strtotime(date("d-m-Y",time()));
        $fecha_turno = strtotime(date("d-m-Y",strtotime($_POST['Fecha_del_turno'])));
        $fecha_nacimiento = date("d-m-Y H:i:00",strtotime($_POST['Fecha_de_nacimiento']));
        $año_nacimiento = intval(date("o",strtotime($_POST['Fecha_de_nacimiento'])));
        $edad_ingresada = $this->datos_reserva['edad'];
        $año_actual = intval(date("o",time()));
        $dia_turno = date("l",$fecha_turno);

        // echo "<pre>";
        // var_dump($fecha_actual);
        // var_dump($fecha_turno);
        // var_dump($fecha_nacimiento);
        // var_dump($dia_turno);
        // var_dump($edad_ingresada);
        // var_dump($año_nacimiento);
        // var_dump($año_actual);
        // var_dump($_POST['Fecha_del_turno']);

        if (($edad_ingresada + $año_nacimiento) < $año_actual){ // comprobar edad y fecha nacimiento
            $this->datos_mal_cargados[] = 'la edad debe ser consistente con la fecha de nacimiento';
        }
        if(date("l",$fecha_turno) == 'Sunday'){ // que no sea dia domingo
            $this->datos_mal_cargados[] = 'la fecha del turno no puede ser domingo';
        }
        if( $fecha_actual > $fecha_turno){ // que sea superior a la fecha actual
            $this->datos_mal_cargados[] = 'la fecha del turno debe ser superior o igual al dia actual';    
        }
        // exit(0);
    
        include "views/reserva.turno.view.php";
    }
}

?>