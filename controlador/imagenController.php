<?php

namespace App\controlador;

class imagenController
{
    public $extensionImagen;
    public $tamanioImagen;
    public $nombreImagen;
    public $imagenCodificada;
    public $tiposPermitidos = ['jpg','png','jpeg'];


    public function __construct($array_FILES = NULL)
    {
        if (isset($array_FILES)){
            $this->extensionImagen = $_FILES['imagen_receta']['type'];
            $this->tamanioImagen = $_FILES['imagen_receta']['size'];
            $this->nombreImagen = $_FILES['imagen_receta']['tmp_name'];
        }
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

}

?>