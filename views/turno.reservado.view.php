<html>
    <head>
        <title>Turno Paciente</title>
    </head>
    <?php include "views/panel_navegacion.php"; ?>
    <body>
        <h1>Turno del Paciente <?= $this->turno[0]['nombre_paciente']; ?></h1>
        <table border = "2">
            <tr>
                <td>Fecha del Turno</td>
                <td>Horario del Turno</td>
                <td>Nombre del Paciente</td>
                <td>Telefono</td>
                <td>Email</td>
            </tr>
                <tr>
                    <td><?= $this->turno[0]['fecha_turno'];?></td>
                    <td><?= $this->turno[0]['hora_turno'];?></td> 
                    <td><?= $this->turno[0]['nombre_paciente']; ?></td> 
                    <td><?= $this->turno[0]['telefono'];?></td>
                    <td><?= $this->turno[0]['email']; ?></td>                    
                </tr>
        </table>
    </body>
</html>