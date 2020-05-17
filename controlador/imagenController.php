<?php

namespace App\controlador;

class imagenController
{
    public $extensionImagen;
    public $tamanioImagen;
    public $nombreImagen;
    public $imagenCodificada;
    public $tiposPermitidos = ['jpg','png','jpeg'];
    public $maximo_tamanio_imagen_valido;
    const MAXIMO_TAMANIO_IMAGEN = 10;

    public function __construct($array_FILES = NULL)
    {
        if (isset($array_FILES)){
            $this->extensionImagen = $_FILES['imagen_receta']['type'];
            $this->tamanioImagen = $_FILES['imagen_receta']['size'];
            $this->nombreImagen = $_FILES['imagen_receta']['tmp_name'];
        }else{
            $this->extensionImagen = "";
            $this->tamanioImagen = 0;
            $this->nombreImagen = "";
        }
        $this->setMaximo_tamanio_imagen_valido(floatval(self::MAXIMO_TAMANIO_IMAGEN));
    }

    public function controlTamanioMaximoImagen(){
        
        if (($this->getTamanioEnMB()) <= $this->getMaximo_tamanio_imagen_valido()) {
            return true;
        }else{
            return false;
        } 
    }

    public function getMaximo_tamanio_imagen_valido(){
        return $this->maximo_tamanio_imagen_valido;
    }

    public function setMaximo_tamanio_imagen_valido($val){
        $this->maximo_tamanio_imagen_valido = $val;
    }
    public function codificar(){
        $fp = fopen($this->nombreImagen,"rb");
        $this->imagenCodificada = fread($fp, filesize($this->nombreImagen));
        $this->imagenCodificada = base64_encode($this->imagenCodificada);
        fclose($fp);
    }
    
    public function decodificar(){
        return base64_decode($this->getImagenCodificada());
    }

    public function setTipoImagen($tipoImg){
        $this->extensionImagen = $tipoImg;
    }
    public function getTipoImagen(){
        return $this->extensionImagen;
    }

    public function devolverPathImagen($imgBase64){
        $decoded = base64_decode($imgBase64);
        $this->pathFile = 'img/tmp.jpeg';
        file_put_contents($this->pathFile,$decoded);
        $this->setTamanioImagen(filesize($this->pathFile));
    }

    public function getPathFile(){
        return $this->pathFile;
    }

    public function getTamanioEnMB(){
        return ($this->getTamanioImagen() / 1048576);
    }

    public function getImagenCodificada(){
        return $this->imagenCodificada;
    }


    public function setTamanioImagen($tamanio){
        $this->tamanioImagen = $tamanio;
    }
    public function getTamanioImagen(){
        return $this->tamanioImagen;
    }
    public function controlTipoImagenValida()
    {
        $encontrado = false;
        foreach ($this->tiposPermitidos as $extension){
            if (strpos($this->getTipoImagen(),$extension)!==false){
                $encontrado = true;
            }
        }
        if ($encontrado) {return true;} else {return false;}
    }

}

?>