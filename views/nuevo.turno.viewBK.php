<!DOCTYPE html>
<html>
    <head>
        <title>Formulario de Datos del Paciente</title>
        <link rel="stylesheet" href="css/contenido.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/cabecera.css">
        <link rel="Shortcut Icon" href=”img/favicon.ico” type=”image/x-icon” />

      </head>
<body>
  <main>  
    <?php include "views/estructura/cabecera.view.php"; ?>
      <section class="contenedor_principal">
        <section>
        <header>
          <h1>Nombre del Paciente</h1>
        </header>
        <form action="/save_formulario" method = 'POST' enctype="multipart/form-data">
          <!-- <filesets> -->
          <?php foreach($this->lista_datos as $id_campo => $campo):?>  
           
            <label for  ="<?= $campo['nombre_campo']?>"><?= $campo['nombre_campo']?></label>
            <?php if($campo['tipo'] == 'date'){ ?>  <!-- FECHA NACIMIENTO o FECHA TURNO-->
              <input type="date" name='<?= $campo['nombre_campo']?>' id='<?= $campo['nombre_campo']?>' <?= $campo['obligatorio']?>>
            <?php }else if($campo['tipo'] == 'email'){ ?>  <!-- EMAIL -->
              <input type="text" name='<?= $campo['nombre_campo']?>' id='<?= $campo['nombre_campo']?>' pattern = <?= $campo['restriccion']?> placeholder = "ej: pepej@servidor.com" <?= $campo['obligatorio']?>>
             <?php }else if($campo['tipo'] == 'tel'){ ?>    <!-- TELEFONO -->
            
              <label for="phone">Ingrese el Nro de Telefono:</label>
              <input class="telefono" type="tel" id="<?= $campo['nombre_campo']?>" name="<?= $campo['nombre_campo']?>" placeholder="11-3438-7233" pattern="<?= $campo['restriccion']?>" <?= $campo['obligatorio']?>>
              <small>Formato: 11-3438-7233</small>

            <?php }else if($campo['tipo'] == 'altura'){   // ALTURA
              list($min,$max) = explode("-",$campo['restriccion'])
              ?>  
              <input type="range" name='<?= $campo['nombre_campo']?>' id='<?= $campo['nombre_campo']?>' placeholder="Entre {<?= $min?>} y {<?= $max?>}" min="100" max="280" <?= $campo['obligatorio']?>>
            <?php }else if($campo['tipo'] == 'calzado' || $campo['tipo'] == 'edad' ){  // CALZADO O EDAD 
              list($min, $max) = explode("-",$campo['restriccion']);
              ?>  
              <input type="number" name='<?= $campo['nombre_campo']?>' id='<?= $campo['nombre_campo']?>' min="<?= $min?>" max="<?= $max?>" <?= $campo['obligatorio']?>>
            <?php }else if($campo['tipo'] == 'pelo'){ ?>  <!-- PELO -->
              <select name="<?= $campo['nombre_campo']?>">
               <?php $pelo = explode("-",$campo['restriccion']); 
                       foreach ($pelo as $color):?>
                          <option value="<?= $color?>"><?= $color?></option>
                <?php  endforeach  ?>        
              </select>   
            <?php }else if($campo['tipo'] == 'horario_turno'){ ?>  <!-- HORARIO TURNO -->
              <select name="<?= $campo['nombre_campo']?>">
               <?php 
                  list($desde, $hasta, $intervalo) = explode("-", $campo['restriccion']);
                  for ($hora = $desde; $hora < $hasta; $hora++) {
                    for($min = 0; $min < 60; $min = $min + $intervalo) { ?>
                        <option value="<?= $hora?>:<?= $min?>"><?= $hora?>:<?= $min?></option>
                <?php  } } ?>        
                <option value="<?= $hora?>:<?= $min?>"><?= $hora?>:00</option>       
                </select>   

            <?php }else{ ?>
              <input type="text" name='<?= $campo['nombre_campo']?>' id='<?= $campo['nombre_campo']?>' <?= $campo['obligatorio']?>>
            <?php } ?>                
        
            <?php  endforeach?>  
            
            <input type="file" name="imagen_receta" id="imagen_receta"> 

            <input class="boton" type="submit" name='enviar' value="Enviar">
            <input class="boton" type="reset" name='limpiar' value="Limpiar">
        </form>
        </section>

        </section>  
    </main>
    <?php include "views/estructura/footer.view.php"; ?>

</body>
</html>