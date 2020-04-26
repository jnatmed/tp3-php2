<?php

namespace App\models;


class dbTurnos
{
    public $turnos;
    private $db;

    public function __construct(){
        $this->conexion = array();
        $this->db = PDO('mysql:host=localhost;dbname=dbturnos', "root", "y00s4d14");
    }

    private function setNames(){
        return $this->db->query("SET NAMES 'utf8'");
    }

    public function getTurnos(){
        self::setNames();
        $sql = "SELECT id, fecha_turno, hora_turno, nombre_paciente FROM dbturnos";
        foreach ($this->db->query($sql) as $res){
            $this->turnos[] = $res;
        }

        return $this->turnos;
        $this->db = NULL;
    }       

    public function setTurno($fecha_turno, $hora_turno){
        self::setNames();
        $sql = "INSERT INTO dbturnos(fecha_turno,hora_turno) VALUES ('".$fecha_turno."','".$hora_turno."')";
        $result = $this->db->query($sql);
        if ($result){
            return true;
        }else{
            return false;
        }
    }
}


?>