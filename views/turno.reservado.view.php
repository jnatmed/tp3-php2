<html>
    <head>
        <title>Turno Paciente</title>
    </head>
    <?php include "views/panel_navegacion.php"; ?>
    <body>
        <h1>Turno del Paciente <?= $this->turno[0]['nombre_paciente']; ?></h1>
        <form action="baja_turno_reservado" method='POST'>
            <table border = "2">
                <tr>
                    <td>Fecha del Turno</td>
                    <td>Horario del Turno</td>
                    <td>Nombre del Paciente</td>
                    <td>Telefono</td>
                    <td>Email</td>

                    <td>Edad</td>
                    <td>Talla del Calzado</td>
                    <td>Fecha de Nacimiento</td>
                    <td>Color de Pelo</td>
                    <td>Receta Cargada</td>
                </tr>
                    <tr>
                        <td><?= $this->turno[0]['fecha_turno'];?></td>
                        <td><?= $this->turno[0]['hora_turno'];?></td> 
                        <td><?= $this->turno[0]['nombre_paciente']; ?></td> 
                        <td><?= $this->turno[0]['telefono'];?></td>
                        <td><?= $this->turno[0]['email']; ?></td> 

                        <td><?= $this->turno[0]['edad']; ?></td>                
                        <td><?= $this->turno[0]['talla_calzado']; ?></td>                
                        <td><?= $this->turno[0]['fecha_nacimiento']; ?></td>                
                        <td><?= $this->turno[0]['color_pelo']; ?></td>                
                        <td><img src='<?= $this->turno[0]['dir_img']; ?>' alt="imagen" width="500" height="333"></td>
                    </tr>
            </table>
            <td><button type="submit" name='id_turno' value="<?= $this->turno[0]['id']; ?>" >Eliminar Turno</button></td>
        </form>
    </body>
</html>