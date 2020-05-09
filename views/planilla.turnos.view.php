<html>
    <head>
        <title>Planilla de Turnos</title>
    </head>
    <?php include "views/panel_navegacion.php"; ?>
    <body>
        <form action="/ver_turno_reservado" method='POST'>
        <h1>Planilla de Turnos de Pacientes</h1>
        <table border = "2">
            <tr>
                <td>Fecha del Turno</td>
                <td>Horario del Turno</td>
                <td>Nombre del Paciente</td>
                <td>Telefono</td>
                <td>Email</td>
                <td>Consulta de Turno</td>
                <!-- <td>Eliminacion Turno</td> -->
            </tr>
            <?php foreach ($this->planillaTurnos as $nroTurno => $turno):?>
                <tr>
                    <td><?= $turno['fecha_turno'];?></td>
                    <td><?= $turno['hora_turno'];?></td> 
                    <td><?= $turno['nombre_paciente']; ?></td> 
                    <td><?= $turno['telefono'];?></td>
                    <td><?= $turno['email']; ?></td>                    
                    <td><button type="submit" name="id_turno" value="<?= $turno['id']; ?>" >Ver Turno</button></td>
                </tr>
            <?php endforeach ?>
        </table>
        </form>
    </body>
</html>