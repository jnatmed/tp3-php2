<html>
    <head>
        <title>Planilla de Turnos</title>
        <link rel="stylesheet" href="css/contenido.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/cabecera.css">
    </head>
    <?php include "views/estructura/panel_navegacion.php"; ?>
    <body>
        <form action="/ver_turno_reservado" method='POST'>
        <h1>Planilla de Turnos de Pacientes</h1>
        <table id="turnos">
            <tr>
                <th>Fecha del Turno</th>
                <th>Horario del Turno</th>
                <th>Nombre del Paciente</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Consulta de Turno</th>
                <!-- <th>Eliminacion Turno</th> -->
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
    <?php include "views/estructura/footer.view.php"; ?>
</html>