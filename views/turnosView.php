<html>
    <head>
        <title>DataBase Turnos</title>
    </head>
    <body>
        <header>    
            <h1>Conectamos con una base de datos de los turnos</h1>
        </header>
        <table>
            <tr>
                <td><strong>ID TURNO</strong></td>
                <td><strong>FECHA TURNO</strong></td>
                <td><strong>HORA TURNO</strong></td>
                <td><strong>NOMBRE PACIENTE</strong></td>
            </tr>
            <?php
                for ($i = 0; $i < count($this->datos); $i++){
            ?>  
            <tr>
                <td><?php echo $this->datos[$i]['id']?></td>
                <td><?php echo $this->datos[$i]['fecha_turno']?></td>
                <td><?php echo $this->datos[$i]['hora_turno']?></td>
                <td><?php echo $this->datos[$i]['nombre_paciente']?></td>
            </tr>
            <?php }?>
        </table>
    </body>
</html>