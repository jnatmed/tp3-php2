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
        <form action="/save_formulario" method = 'POST'>
          <?php foreach($this->lista_datos as $id_campo => $campo):?>  
            <p>
            <label for  ="<?= $campo['nombre_campo']?>"><?= $campo['nombre_campo']?></label>
            <?php if($campo['tipo'] == 'date'){ ?>  
              <input type="date" name='<?= $campo['nombre_campo']?>' id='<?= $campo['nombre_campo']?>' <?= $campo['obligatorio']?>>
            <?php }else if($campo['tipo'] == 'email'){ ?>  
              <input type="text" name='<?= $campo['nombre_campo']?>' id='<?= $campo['nombre_campo']?>' pattern = <?= $campo['restriccion']?> placeholder = "ej: pepe@servidor.com" <?= $campo['obligatorio']?>>
            <?php }else if($campo['tipo'] == 'tel'){ ?>  
            
              <label for="phone">Ingrese el Nro de Telefono:</label><br><br>
              <input type="tel" id="<?= $campo['nombre_campo']?>" name="<?= $campo['nombre_campo']?>" placeholder="011-3438-7233" pattern="<?= $campo['restriccion']?>" <?= $campo['obligatorio']?>><br><br>
              <small>Formato: 011-3438-7233</small><br><br>

            <?php }else if($campo['tipo'] == 'altura'){ 
              list($min,$max) = explode("-",$campo['restriccion'])
              ?>  
              <input type="range" name='<?= $campo['nombre_campo']?>' id='<?= $campo['nombre_campo']?>' placeholder="Entre {<?= $min?>} y {<?= $max?>}" min="100" max="280" <?= $campo['obligatorio']?>>
            <?php }else if($campo['tipo'] == 'calzado' || $campo['tipo'] == 'edad' ){ 
              list($min, $max) = explode("-",$campo['restriccion']);
              ?>  
              <input type="number" name='<?= $campo['nombre_campo']?>' id='<?= $campo['nombre_campo']?>' min="<?= $min?>" max="<?= $max?>" <?= $campo['obligatorio']?>>
            <?php }else if($campo['tipo'] == 'pelo'){ ?>  
              <select name="<?= $campo['nombre_campo']?>">
               <?php $pelo = explode("-",$campo['restriccion']); 
                       foreach ($pelo as $color):?>
                          <option value="<?= $color?>"><?= $color?></option>
                <?php  endforeach  ?>        
              </select>   
            <?php }else if($campo['tipo'] == 'horario_turno'){ ?>  
              <select name="<?= $campo['nombre_campo']?>">
               <?php 
                  list($desde, $hasta, $intervalo) = explode("-", $campo['restriccion']);
                  for ($hora = $desde; $hora < $hasta; $hora++) {
                    for($min = 00; $min < 60; $min = $min + $intervalo) { ?>
                        <option value="<?= $hora?>:<?= $min?>"><?= $hora?>:<?= $min?></option>
                <?php  } } ?>        
                <option value="<?= $hora?>:<?= $min?>"><?= $hora?>:00</option>       
                </select>   

            <?php }else{ ?>
              <input type="text" name='<?= $campo['nombre_campo']?>' id='<?= $campo['nombre_campo']?>' <?= $campo['obligatorio']?>>
            <?php } ?>                
            </p>
            <?php  endforeach?>  
            <input type="submit" name='enviar' value="Enviar">
            <input type="reset" name='limpiar' value="Limpiar">
        </form>
    </main>
</body>
</html>