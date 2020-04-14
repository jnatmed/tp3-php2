<?php

namespace App\controlador;

class imagenController
{
    public $target_dir = "recetas/";
    public $target_file = "";
    public $tiposPermitidos = ['jpg','png','jpeg'];
    public $dirTemp = "";
    public $nombreImagenMd5 = "";

    public function __construct($array_FILES,$fechaTurno, $horaTurno)
    {
        $this->dirTemp = $array_FILES['imagen_receta']['tmp_name'];
        $this->nombreImagenMd5 = md5($fechaTurno.$horaTurno);
        $this->tipoImagen = strtolower(pathinfo(basename($array_FILES['imagen_receta']['name']),PATHINFO_EXTENSION));
        $this->target_file = $this->target_dir.$this->nombreImagenMd5.'.'.$this->tipoImagen;
    }
    
    public function tipoImagenValida()
    {
        $encontrado = false;
        foreach ($this->tiposPermitidos as $extension){
            if ($this->tipoImagen == $extension){
                $encontrado = true;
            }
        }
        if ($encontrado) {return true;} else {return false;}
    }
    public function getDirTemp()
    {
        return $this->dirTemp;
    }
    public function getTargetFile()
    {
        return $this->target_file;
    }
    public function guardarImagen(){
        return move_uploaded_file($this->getDirTemp(),$this->getTargetFile());

    }

}

?>