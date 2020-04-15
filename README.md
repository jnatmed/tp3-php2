<h1>Trabajo Practico <br>
Tecnologias del Lado del Servidor</h1><br><br>

1) Elabore una aplicación que presente al usuario un formulario implementado por HTML para la
carga de los datos de una persona que solicita turno médico) El formulario deberá disponer de los
siguientes campos : <br><br>
    a) Nombre del paciente (obligatorio)<br>
    b) Email (obligatorio)<br>
    c) Teléfono (obligatorio)<br>
    d) Edad<br>
    e) Talla de calzado (desde 20 a 45 enteros)<br>
    f) Altura (usando la herramienta de deslizador)<br>
    g) Fecha de nacimiento (obligatorio)<br><br>
    h) Color de pelo (Usando un elemento select con las opciones que usted considere adecuadas)<br>
    i) Fecha del turno (obligatorio)<br>
    j) Horario del turno (Entre las 8:00 hasta las 17:00 con turnos cada 15 minutos)<br>
    k) 2 botones: Enviar y Limpiar.<br><br>

Todos los elementos del formulario deben validarse del lado de cliente y servidor , con el formato
que mejor se ajuste y permitan HTML y PHP. Además, tomar en cuenta de validar que los datos
ingresados se encuentren en los rangos especificados. ¿Por qué cree usted que se requiere validar
los datos en ambos extremos de la comunicación?<br><br>

<p>Respuesta: La razon por la cual se requiere es que, del lado del cliente solo se pueden verificar 
el formator de los datos, es decir, formato de fecha, de email, rango de datos acotados como altura, edad, etc.
Pero lo que solo se puede verificar del lado del servidor es la consistencia de los mismos; un ejemplo de ello es
la fecha de turno, se debe verificar que sea superior o igual a la actual, y asimismo que no sea un dia no laborable. 
Ademas se puede verificar relacion entre campos, como puede ser la edad y la fecha de nacimiento, deben ser consistentes.</p>

<p>Nota: La hora del Turno no esta tildada como obligatoria, sin embargo para la implementacion del codigo<br>
que arme, la considere como obligatoria. las razones son que del lado del servidor, debo evitar que <br>
se reserve un turno en la misma fecha y hora, y la carga de la hora debe estar siempre, a mi consideracion.</p>

2) Extienda el ejercicio anterior para que al enviar el formulario mediante el método POST se muestre
al usuario un resumen del turno. <br><br>

En el siguiente commit se encuentra realizada la resolucion de los puntos 1 y 2. 

- https://github.com/jnatmed/tp2-php-paw/commit/30a74eff839939d449ddd4f2727f116267eb4609

3) Realice las modificaciones necesarias para que el script del punto anterior reciba los datos
mediante el método GET . ¿Qué diferencia nota? ¿Cuándo es conveniente usar cada método?<br><br>

En este commit se puede ver como al cambiar los campos correspondientes para el uso mediante GET
los datos del usuario viajan mediante la URL del usuario. Dependiendo del caso, si la informacion 
no es sensible, se puede optar por usar un metodo de envio mediante GET, caso constrario debe usarse
POST. 

Un detalle no menor para agregar, es que si en el formulario se agrega la insercion de una imagen
no se puede usar el metodo GET para el envio de la misma, en este caso el uso de POST es obligatorio.   

Utilizando las herramientas de Navegador (Pestaña Red), se puede observar que la informacion viaja en el encabezado, mediante GET. 

- https://github.com/jnatmed/tp2-php-paw/commit/cc8579347e386a09ef0065adb35bdd8cade79076


4) Agregue al formulario un campo que permita adjuntar una imagen , y que la etiqueta del campo sea
Diagnóstico. El campo debe validar que sea un tipo de imagen valido (.jpg o .png) y será optativo.
La imagen debe almacenarse en un subdirectorio del proyecto y también debe mostrarse al
usuario al mostrar el resumen del turno del ejercicio 2. ¿Qué sucede si 2 usuarios cargan imágenes
con el mismo nombre de imagen? ¿Qué mecanismo implementar para evitar que un usuario
sobrescriba una imagen con el mismo nombre?

¿Qué sucede si 2 usuarios cargan imágenes con el mismo nombre de imagen?
Pude notar que efectivamente la imagen se sobreescribe, si dos usuarios suben una imagen con el 
mismo nombre. <br>
<p>¿Qué mecanismo implementar para evitar que un usuario sobrescriba una imagen con el mismo nombre?<br>
Una forma de hacerlo es concatenar "la fecha del turno" + "la hora del turno" y pasarlo por una 
funcion HASH, usando el modulo "md5" de php; de esta forma evitando que dos pacientes reserven un turno
en la misma fecha y hora, que eso ya forma parte de las primeras  restricciones en carga de datos, 
se independiza el nombre con que cargue la imagen de la receta, ya que sera cambiada por una manejada 
por el sistema. <br></p>

5) Utilice las herramientas para desarrollador del navegador y observe cómo fueron codificados por
el navegador los datos enviados por el navegador en los dos ejercicios anteriores. ¿Qué diferencia
nota?

<p>Se puede notar en la pestaña de red que cuando se envia el formulario mediante POST, los datos viajan <br>
en el cuerpo de la peticion, se puede ver en el request payload. <br></p>

<img src='img/punto5-tp2-php.png' alt="imagen" width="500" height="333">

<p> mientras que en una peticion GET se puede observar que los datos viajan en la URL de la peticion. </p>
