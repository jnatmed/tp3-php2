<?php

namespace App\models;

// $dbPDO =new PDO('mysql:host=localhost;dbname=dbturnos', "root", "y00s4d14");


class TurnosDBModel
{
    public $turnos;
    private $db, $dsn;
    public $params = [
        'host' => 'localhost',
        'user' => 'root',
        'pwd' => 'y00s4d14',
        'db' => 'dbturnos'
    ];
    
    public function __construct(){

        $this->dsn = sprintf("mysql:host=%s;dbname=%s", $this->params['host'], $this->params['db']);

        $this->turnos = array();
        $this->db = new PDO($dsn, $params['user'], $params['pwd']);
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