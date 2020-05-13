<!DOCTYPE html>
<html>
    <head>
        <title>Formulario de Datos del Paciente</title>
    </head>
    <?php include "views/panel_navegacion.php"; ?>
<body>
    <header>
        <h1>Nombre del Paciente</h1>
    </header>
    <main>
      <?php //echo("<pre>")?>
      <?php //var_dump($this->lista_datos)?>
      <?php //exit();?>
        <form action="/guardar_modificacion_turno" method = 'POST' enctype="multipart/form-data">
          <?php foreach($this->lista_datos as $id_campo => $campo):?>  
            <p>
            <label for  ="<?= $campo['nombre_campo']?>"><?= $campo['nombre_campo']?></label>
            <?php if($campo['tipo'] == 'date'){ ?>  <!-- FECHA NACIMIENTO o FECHA TURNO-->
              <input type="date" name='<?= $campo['nombre_campo']?>' value = '<?= $campo['valor']?>' id='<?= $campo['nombre_campo']?>' <?= $campo['obligatorio']?>>
            <?php }else if($campo['tipo'] == 'email'){ ?>  <!-- EMAIL -->
              <input type="text" name='<?= $campo['nombre_campo']?>' value = '<?= $campo['valor']?>' id='<?= $campo['nombre_campo']?>' pattern = <?= $campo['restriccion']?> placeholder = "ej: pepe@servidor.com" <?= $campo['obligatorio']?>>
             <?php }else if($campo['tipo'] == 'tel'){ ?>    <!-- TELEFONO -->
            
              <label for="phone">Ingrese el Nro de Telefono:</label><br><br>
              <input type="tel" id="<?= $campo['nombre_campo']?>" name="<?= $campo['nombre_campo']?>" value = '<?= $campo['valor']?>' placeholder="11-3438-7233" pattern="<?= $campo['restriccion']?>" <?= $campo['obligatorio']?>><br><br>
              <small>Formato: 11-3438-7233</small><br><br>

            <?php }else if($campo['tipo'] == 'altura'){   // ALTURA
              list($min,$max) = explode("-",$campo['restriccion'])
              ?>  
              <input type="range" name='<?= $campo['nombre_campo']?>' id='<?= $campo['nombre_campo']?>' value = '<?= $campo['valor']?>' placeholder="Entre {<?= $min?>} y {<?= $max?>}" min="100" max="280" <?= $campo['obligatorio']?>>
            <?php }else if($campo['tipo'] == 'calzado' || $campo['tipo'] == 'edad' ){  // CALZADO O EDAD 
              list($min, $max) = explode("-",$campo['restriccion']);
              ?>  
              <input type="number" name='<?= $campo['nombre_campo']?>' value = '<?= $campo['valor']?>' id='<?= $campo['nombre_campo']?>' min="<?= $min?>" max="<?= $max?>" <?= $campo['obligatorio']?>>
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
                <option value="<?= $campo['valor']?>" selected><?= $campo['valor']?></option>       

                </select>   

            <?php }else{ ?>
              <input type="text" name='<?= $campo['nombre_campo']?>' value = '<?= $campo['valor']?>' id='<?= $campo['nombre_campo']?>' <?= $campo['obligatorio']?>>
            <?php } ?>                
            </p>
            <?php  endforeach?>  
            <input type="file" name="imagen_receta" id="imagen_receta"> <br><br>

            <input type="text" name ='id' value = <?= $this->id_turno_update?> hidden = True>
            <input type="submit" name='modificar_turno' value= "modificar">
        </form>
    </main>
</body>
</html>