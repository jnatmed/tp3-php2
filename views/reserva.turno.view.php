<html>
    <head>
        <title>Reserva de Turno</title>
    </head>
    <?php include "views/panel_navegacion.php"; ?>
    <body>
        <h1>Reserva de Turno</h1>
        <form action="/turno_confirmado" method = 'POST' enctype="multipart/form-data">
            <table border = "2">
                <tr>
                    <td>Nombre del Paciente</td>
                    <td>Email</td>
                    <td>Telefono</td>
                    <td>Edad</td>
                    <td>Talla del Calzado</td>
                    <td>Fecha de Nacimiento</td>
                    <td>Color de Pelo</td>
                    <td>Fecha del Turno</td>
                    <td>Horario del Turno</td>
                    <td>Receta Cargada</td>
                </tr>
                <?php $turno = $this->planilla[0];?>
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
                    <td><img src='<?= $turno['dir_img']; ?>' alt="imagen" width="500" height="333"></td>
                </tr>                                                        
            </table><br><br>
                <input type="text" value="<?= $turno['nombre_paciente']; ?>" name="<?= $turno['nombre_paciente']; ?>"hidden="true">
                <input type="text" value="<?= $turno['email']; ?>" name="<?= $turno['email']; ?>"hidden="true">
                <input type="text" value="<?= $turno['telefono']; ?>" name="<?= $turno['telefono']; ?>"hidden="true">
                <input type="text" value="<?= $turno['edad']; ?>" name="<?= $turno['edad']; ?>"hidden="true">
                <input type="text" value="<?= $turno['talla_calzado']; ?>" name="<?= $turno['talla_calzado']; ?>"hidden="true">
                <input type="text" value="<?= $turno['fecha_nacimiento']; ?>" name="<?= $turno['fecha_nacimiento']; ?>"hidden="true">
                <input type="text" value="<?= $turno['color_pelo']; ?>" name="<?= $turno['color_pelo']; ?>"hidden="true">
                <input type="text" value="<?= $turno['fecha_turno']; ?>" name="<?= $turno['fecha_turno']; ?>"hidden="true">
                <input type="text" value="<?= $turno['hora_turno']; ?>" name="<?= $turno['hora_turno']; ?>"hidden="true">
                <input type="text" value="<?= $turno['dir_img']; ?>" name="<?= $turno['dir_img']; ?>" hidden="true">
            <input type="submit" name='enviar' value="Confirmar Turno">
        </form>    
        <?php 
          if (!empty($this->datos_mal_cargados)){ ?>
            <ul> Errores Encontrados:
            <?php foreach ($this->datos_mal_cargados as $error):?>
                <li>Error: <?= $error ?></li>
            <?php endforeach; ?>
            </ul>
        <?php }else{ echo "<h1>Datos correctamente cargados</h1>";} ?>
    </body>
</html>