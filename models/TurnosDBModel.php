<?php

namespace App\models;

use PDO;

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
        try {
            $this->turnos = array();
            $this->db = new PDO($this->dsn, $this->params['user'],$this->params['pwd']);    
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Throwable $th) {
            echo ("<pre>");
            var_dump($th);
            exit(0);   
        }
    }   

    public function crearDBTurnos(){

    }

    private function setNames(){
        return $this->db->query("SET NAMES 'utf8'");
    }

    public function getTurnos(){
        // self::setNames();
        // var_dump($this->db);

        $sql = "SELECT * FROM turnos";   

        foreach ($this->db->query($sql) as $res){
            $this->turnos[] = $res;
        }

        return $this->turnos;
        $this->db = NULL;
    }       

    public function getTurnoSeleccionado($id_turno){

        // echo("<pre>");

        // var_dump($this->db);
        $sql = "SELECT * FROM turnos WHERE id ='{$id_turno}'";
        try{
            foreach ($this->db->query($sql) as $res){
                $resu[] = $res;
            }    
        }catch(Exception $e){
            echo($e);
        }
        return $resu;
        $this->db = NULL;
    }

    public function insertarTurno($valores){
        $consulta = "INSERT INTO turnos(id,
                                        fecha_turno,
                                        hora_turno,
                                        nombre_paciente,
                                        email,
                                        telefono,
                                        fecha_nacimiento,
                                        edad,
                                        talla_calzado,
                                        altura,
                                        color_pelo) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt->execute($valores);
    }

    public function bajaTurnoSeleccionado($id_turno){
        $consulta = "DELETE FROM turnos WHERE 'id' =:id";
        try{
            $sql = $this->db->prepare($consulta);
            $sql->bindParam(':id',$id,PDO::PARAM_INT);
            $id = trim($id_turno);
            $sql->execute();
            if($sql->rowCount() > 0){
                $count = $sql->rowCount();
                echo("{$count} registro ha sido eliminado");
            }else{
                echo("No se pudo eliminar el registro<br>");
                print_r($sql->errorInfo());
            }    
        }catch(Exception $e){
            echo($e);
        }
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