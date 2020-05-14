<?php
namespace App\models;
include 'models/config.php';

use PDO;
use \App\controlador\imagenController;


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
        // include 'models/samples.php';

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
            // $this->insertarTurno($sample_1);
            // $this->insertarTurno($sample_2);
            // $this->insertarTurno($sample_3);    
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
        // echo("getTurnoSeleccionado<br>");
        // var_dump($id_turno);
        $sql = "SELECT * FROM turnos WHERE id ='{$id_turno}'";
        try{
            foreach ($this->db->query($sql) as $res){
                $resu[] = $res;
            }    

        // echo("<pre>");
        // echo("getTurnoSeleccionado<br>");
        // var_dump($resu);
        // exit();

            return $resu;
            $this->db = NULL;    
        }catch(Exception $e){
            echo($e);
        }
    }

    public function insertarTurno($valores){
        // echo("<pre>");
        // echo("insertarTurno<br>");
        // var_dump($valores);
        // exit(); 
        // $this->imgController = new imagenController();
        // $this->imgController->codificar($valores['dir_img']);
        $consulta = "INSERT INTO `turnos`(`id`, 
                                        `fecha_turno`, 
                                        `hora_turno`, 
                                        `nombre_paciente`, 
                                        `email`, 
                                        `telefono`, 
                                        `fecha_nacimiento`, 
                                        `edad`, 
                                        `talla_calzado`, 
                                        `altura`, 
                                        `color_pelo`, 
                                        `imagen`,
                                        `tipo_imagen`) VALUES (NULL,
                                                        '{$valores['fecha_turno']}',
                                                        '{$valores['hora_turno']}',
                                                        '{$valores['nombre_paciente']}',
                                                        '{$valores['email']}',
                                                        '{$valores['telefono']}',
                                                        '{$valores['fecha_nacimiento']}',
                                                        '{$valores['edad']}',
                                                        '{$valores['talla_calzado']}',
                                                        '{$valores['altura']}',
                                                        '{$valores['color_pelo']}',
                                                        '{$valores['dir_img']}',
                                                        '{$valores['tipo_imagen']}')";
        try{
            $this->motrarMsj($consulta);
            // echo($consulta);
            $sql = $this->db->prepare($consulta);
            $sql->execute();    
            // echo("Insercion realizada.!");
        }catch(Exception $e){
            echo($e);        
        }
    }
    public function actualizarTurno($valores,$img_receta){
        // echo("<pre>");
        // echo("insertarTurno<br>");
        // var_dump($img_receta);
        // exit(); 
        $this->imgController = new imagenController($img_receta);
        $this->imgController->codificar();
        $consulta = "UPDATE `turnos` SET 
                            `fecha_turno`='{$valores['Fecha_del_turno']}',
                            `hora_turno`='{$valores['Horario_del_turno']}',
                            `nombre_paciente`='{$valores['Nombre_del_Paciente']}',
                            `email`='{$valores['Email']}',
                            `telefono`='{$valores['Telefono']}',
                            `fecha_nacimiento`='{$valores['Fecha_de_nacimiento']}',
                            `edad`='{$valores['Edad']}',
                            `talla_calzado`='{$valores['Talla_de_calzado']}',
                            `altura`='{$valores['altura']}',
                            `color_pelo`='{$valores['Color_de_pelo']}', 
                            `imagen`='{$this->imgController->getImagenCodificada()}',
                            `tipo_imagen`='{$this->imgController->getTipoImagen()}' WHERE id = '{$valores['id']}'";
        try{
            // $this->motrarMsj($consulta);
            // echo($consulta);
            $sql = $this->db->prepare($consulta);
            // $sql->execute($valores);    
            $sql->execute();    
        }catch(Exception $e){
            echo($e);        
        }
    }

    public function bajaTurnoSeleccionado($id_turno){
        $consulta = "DELETE FROM turnos WHERE id = ?;";
        echo("id turno: ".$id_turno."<br>");
        // echo("<pre>");
        // var_dump($id_turno);
        // exit();
        try{
            $sql = $this->db->prepare($consulta);
            // $sql->bindColumn(':id',$id_turno);
            if($sql->execute([$id_turno]) === TRUE){
                echo("registro ha sido eliminado, id=>{$id_turno}");
            }else{
                echo("No se pudo eliminar el registro<br>");
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