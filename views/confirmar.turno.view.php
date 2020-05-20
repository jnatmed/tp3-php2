<!DOCTYPE html>

<html>
    <head>
        <title>Reserva de Turno</title>
        <link rel="stylesheet" href="css/contenido.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/cabecera.css">
    </head>
    <body>
        <main>
        <?php include "views/estructura/cabecera.view.php"; ?>
        <h1>Reserva de Turno</h1>
        <form action="/turno_confirmado" method = 'POST' enctype="multipart/form-data">
            <table id="turnos">
                <tr>
                    <th>Nombre del Paciente</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Edad</th>
                    <th>Talla del Calzado</th>
                    <th>Altura</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Color de Pelo</th>
                    <th>Fecha del Turno</th>
                    <th>Horario del Turno</th>
                    <th>Receta Cargada</th>
                </tr>
                <?php $turno = $this->datos_reserva;?>
                <tr>
                    <td><?= $turno['nombre_paciente']; ?></td> 
                    <td><?= $turno['email']; ?></td>
                    <td><?= $turno['telefono'];?></td>
                    <td><?= $turno['edad'];?></td>
                    <td><?= $turno['talla_calzado'];?></td>
                    <td><?= $turno['altura'];?></td>
                    <td><?= $turno['fecha_nacimiento'];?></td>
                    <td><?= $turno['color_pelo'];?></td>
                    <td><?= $turno['fecha_turno'];?></td>
                    <td><?= $turno['hora_turno'];?></td> 
                    <td><img src='<?php echo("{$this->imgController->cargarImagen()}"); ?>' alt="imagen" class="receta_cargada"><br>
                    </td>
                </tr>                                                        
            </table><br><br>
                <input type="text" value="<?= $turno['nombre_paciente']; ?>" name="Nombre_del_Paciente" hidden="true">
                <input type="text" value="<?= $turno['email']; ?>" name="Email" hidden="true">
                <input type="text" value="<?= $turno['telefono']; ?>" name="Telefono" hidden="true">
                <input type="text" value="<?= $turno['edad']; ?>" name="Edad" hidden="true">
                <input type="text" value="<?= $turno['talla_calzado']; ?>" name="Talla_de_calzado" hidden="true">
                <input type="text" value="<?= $turno['altura']; ?>" name="altura" hidden="true">
                <input type="text" value="<?= $turno['fecha_nacimiento']; ?>" name="Fecha_de_nacimiento" hidden="true">
                <input type="text" value="<?= $turno['color_pelo']; ?>" name="Color_de_pelo" hidden="true">
                <input type="text" value="<?= $turno['fecha_turno']; ?>" name="Fecha_del_turno" hidden="true">
                <input type="text" value="<?= $turno['hora_turno']; ?>" name="Horario_del_turno" hidden="true">
                <input type="text" value="<?= $turno['dir_img']; ?>" name="dir_img" hidden="true">
                <input type="text" value="<?= $turno['tipo_imagen']; ?>" name="tipo_imagen" hidden="true">
        <?php 
          if (!empty($this->datos_mal_cargados)){ ?>
            <input type="submit" name='enviar' value="Confirmar Turno" disabled>
            <input type="submit" name='corregir' value="Corregir Turno">
        </form>    

            <ul> Errores Encontrados:
            <?php foreach ($this->datos_mal_cargados as $error):?>
                <li>Error: <?= $error ?></li>
            <?php endforeach; ?>
            </ul>
        <?php }else{ ?>
                <input type="submit" name='enviar' value="Confirmar Turno">
            </form>    

           <?php echo "<h1>Datos correctamente cargados</h1>";} ?>
      </main>     
      <?php include "views/estructura/footer.view.php"; ?>

    </body>
</html>