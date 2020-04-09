<!DOCTYPE html>
<html>
    <title>Formulario de Datos del Paciente</title>
<body>
    <header>
        <h1>Nombre del Paciente</h1>
    </header>
    <main>
        <form action="/save_data" method = 'POST'>
          <?php foreach($this->lista_datos as $id_dato => $obligatorio):?>  
            <p>
            <label for="<?= $id_dato?>"><?= $id_dato?></label>
            <?php if ($obligatorio == true)
              {$requerido = "required";
              }else{$requerido = "";}?>
            <?php if($tipo_restriccion == 'altura'){?>  
              <input type="text" name='<?= $id_dato?>' id='<?= $id_dato?>' <?= $requerido?>>
            <?php }else{ ?>
              <input type="text" name='<?= $id_dato?>' id='<?= $id_dato?>' <?= $requerido?>>
            <?php } ?>                
            </p>
            <?php  endforeach?>  
            <input type="submit" name='enviar' value="Enviar">
            <input type="reset" name='limpiar' value="Limpiar">
        </form>
    </main>