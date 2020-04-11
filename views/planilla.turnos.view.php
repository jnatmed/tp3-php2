<html>
    <head>
        <title>Planilla de Turnos</title>
    </head>
    <?php include "views/panel_navegacion.php"; ?>
    <body>
        <h1>Planilla de Turnos de Pacientes</h1>
        <table border = "2">
            <?php foreach ($planilla as $turno):?>
                <tr>
                    <td><?= $turno['nombre_paciente']; ?></td> 
                    <td><?= $turno['email']; ?></td>
                    <td><?= $turno['telefono'];?></td>
                    <td><?= $turno['edad'];?></td>
                    <td><?= $turno['talla_calzado'];?></td>
                    <td><?= $turno['fecha_nacimiento'];?></td>
                    <td><?= $turno['color_pelo'];?></td>
                    <td><?= $turno['fecha_turno'];?></td>
                    <td><?= $turno['hora_turno'];?></td> 
                </tr>
            <?php endforeach ?>
        </table>
    </body>
</html>