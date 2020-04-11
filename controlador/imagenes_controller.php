<?php


class imagen_controller
{
    public $target_dir = "recetas/";
    public $target_file = "";
    public $tipoImagen = ['JPG','PNG'];

    public function guardarReceta($nombre_archivo)
    {
        $this->target_file = $this->target_dir.$nombre_archivo;
    }

    public function tipoImagen($tipoArchivo)
    {
        $encontrado = false;
        foreach ($this->tipoImagen as $extension){
            if ($tipoArchivo == $extension){
                $encontrado = true;
            }
        }
        if ($encontrado) {return true;} else {return false;}
    }

        
}

?>