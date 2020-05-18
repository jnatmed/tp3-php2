<h1>Trabajo Practico Nº 3<br>
Persistencia y MVC</h1><br><br>

CONFIGURACION

Para la prueba del Proyecto: 
- importar el archivo SQL '001_create_database_dbturnos', en el mismo se encuentra la creacion
de la base de datos y la tabla turnos, junto a la insercion de 5 tuplas para realizar las pruebas. 
- en el archivo de php.ini, hay que cambiar las variables 
upload_max_filesize = 20M 
post_max_size  = 20M
para la subida de archivos de mayor tamaño.

CONSIGNAS: 

1) Extienda el sistema de gestión de turnos médicos para que los datos sean persistidos sobre
una base de datos MySQL usando PDO. La generación del número de turno debe hacerse vía
motor de base de datos. ¿Qué cambios hubo que realizar para la generación del id?

-RESPUESTA: En la version anterior, tomaba como id a los campos: id (autoincremental), fecha turno, hora turno. 
en esta version, el id cambio al campo id(autoincremental), ya que todos los demas fueron considerados
repetibles.Todo lo demas quedo igual, en lo que a generacion de id se refiere. 

2) Modifique el sistema para permitir que las imágenes sean persistidas sobre la base de datos. El
software debe permitir cargar imágenes de hasta 10 MB. Si la imagen pesa más, se le debe
informar al usuario este inconveniente, y pre-cargando el formulario con los datos ingresados,
solicitar una nueva imagen.

RESPUESTA: <br>
Para guardar las imagenes de las recetas use la funcion "base64encode()"<br>
INSERCION: el archivo en binario lo inserto en un campo 'imagen' de la base de datos<br>
'dbturnos' del tipo "MEDIUMBLOB", el cual previamente fue codificado en binario.
CONSULTA: para la consulta:<br>
- traigo el archivo de la base de datos,
- lo decodifico 
- los guardo en un archivo temporal ubicado en "img/tmp.[jpeg/jpg/jpg]" 
- y en la vista leo directamente de ese archivo temporal, solo si existe una imagen
de receta guardada. 

<pre>
"Parte del codigo para decodificar la imagen"

    public function devolverPathImagen($imgBase64){
        $decoded = base64_decode($imgBase64);
        $this->setPathFile('img/tmp.'.$this->getExtension());
        file_put_contents($this->getPathFile(),$decoded);
        $this->setTamanioImagen(filesize($this->getPathFile()));
    }
</pre>

Para informar al usuario el inconveniente, al cargar los datos ingresados por el usuario, los errores
encontrados se van guardando en un arreglo. Si el arreglo esta vacio se ingresan los datos del turno.
Si arreglo tiene algun error, se informa al usuario y mediante un boton "corregir" se puede volver atras
al formulario de carga con los datos pre-cargados.


3) Implemente Modificación y Baja de los registros del sistema de turnos.

-RESPUESTA: Realizado, con algunas cuestiones pendientes en lo que refiere a la seguridad, es decir:
al momento de realizar la modificacion del turno, envio mediante POST el id del turno
en un tag del tipo INPUT oculto, lo cual es bastante vulnerable en la capa del cliente. 
En caso de encontrar una mejora al respecto, estare haciendo el commit correspondiente.

4) Cada acción del ABM debe ser registrada usando el Logger del framework. Cada log debe ser
de tipo INFO y almacenar fecha y hora, operación (ABM), y turno afectado (id). En los casos de
modificación y baja, almacene el registro completo. ¿Considera esto util? ¿En que casos puede
llegar a utilizarse?

