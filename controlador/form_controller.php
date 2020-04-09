<?php


class form_controller
{
    public $lista_datos = [];
    public $tipo_restriccion = [];

    public function listar_datos()
    {
        include "views/form.persona.view.php";
    }

    public function mostrarFormulario()
    {
        $this->agregar_dato('Nombre del Paciente','required','nombre','[a-zA-Z]+');
        $this->agregar_dato('Email', 'required','email','[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$');
        $this->agregar_dato('Telefono', 'required','telefono','/^\(?\d{2}\)?[\s\.-]?\d{4}[\s\.-]?\d{4}$/');
        $this->agregar_dato('Edad', '', 'edad','18-60');
        $this->agregar_dato('Talla de calzado', '', 'calzado','20-45');
        $this->agregar_dato('Altura', '','altura','1-3');
        $this->agregar_dato('Fecha de nacimiento', 'required','date');
        $this->agregar_dato('Color de pelo','required','color');
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
    
}

?>