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
                <?php foreach ($this->planilla as $turno):?>
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
                <?php endforeach ?>
            </table>
            <input type="submit" name='enviar' value="Confirmar_Turno">
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