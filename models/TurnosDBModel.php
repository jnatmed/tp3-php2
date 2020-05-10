<?php
namespace App\models;
include 'models/config.php';

use PDO;

class TurnosDBModel
{
   
    public $turnos;
    private $db, $dsn, $conexion;
    public $params = [
        'host' => 'localhost',
        'user' => 'root',
        'pwd' => 'y00s4d14',
        'db' => 'dbturnos'
    ];
    
    public function motrarMsj($msj){
        // echo($msj);
    }

    public function crearDB(){
        //1 - me conecto al servidor
        //2 - creo la base de datos
        $sqlDB = "CREATE DATABASE dbturnos";
       
        //1 - conecto al servidor
        try{
            $this->db = new PDO("mysql:host={$this->params['host']}", $this->params['user'],$this->params['pwd']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
            $this->motrarMsj("1 - Conexion establecida..<br>");
        }catch(\Throwable $th){
            $this->motrarMsj("1E - Error al conectar al Servidor!<br>");
            // echo($th);    
        }
        //2 - creo dbturnos
        try{
            $this->db->exec($sqlDB);
            $this->motrarMsj("2 - Base de Datos dbturnos Creada..<br>");
            $this->db = null;
        }catch(\Throwable $th){
            $this->motrarMsj("2E - Error al crear la DB dbturnos!<br>");
            // echo($th);    
        }
    }    

    public function crearTabla(){
        // 3 - Creo tabla turnos 
        include 'models/config.php';
 
        try{
            $this->db->exec($sqlTabla);
            $this->motrarMsj("3 - Tabla turnos Creada..<br>");
        }catch(\Throwable $th){
            $this->motrarMsj("3E - Error al crear Tabla turnos!<br>");
            // echo($th);    
        }
        
    }
    public function __construct(){
        include 'models/samples.php';

        $this->crearDB();    
        $this->dsn = sprintf("mysql:host=%s;dbname=%s", $this->params['host'], $this->params['db']);
        try {
            $this->db = new PDO($this->dsn, $this->params['user'],$this->params['pwd']);    
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->crearTabla();
            $this->insertarTurno($sample_1);
        } catch (\Throwable $th) {
            echo ("<pre>");
            var_dump($th);
            exit(0);   
        }
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
        $consulta = "INSERT INTO `turnos` (`id`, 
                                           `fecha_turno`, 
                                           `hora_turno`, 
                                           `nombre_paciente`, 
                                           `email`, 
                                           `telefono`, 
                                           `fecha_nacimiento`, 
                                           `edad`, `talla_calzado`, 
                                           `altura`, 
                                           `color_pelo`) VALUES (NULL,'{$valores['fecha_turno']}', 
                                                                '{$valores['hora_turno']}', '{$valores['nombre_paciente']}', 
                                                                '{$valores['email']}', '{$valores['telefono']}', 
                                                                '{$valores['fecha_nacimiento']}', 
                                                                '{$valores['edad']}', '{$valores['talla_calzado']}', 
                                                                '{$valores['altura']}', '{$valores['color_pelo']}' )";
        try{
            $this->motrarMsj($consulta);
            $sql = $this->db->prepare($consulta);
            $sql->execute($valores);    
        }catch(Exception $e){
            echo($e);        
        }
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