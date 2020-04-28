<h1>Trabajo Practico Nº 3<br>
Persistencia y MVC</h1><br><br>

1) Extienda el sistema de gestión de turnos médicos para que los datos sean persistidos sobre
una base de datos MySQL usando PDO. La generación del número de turno debe hacerse vía
motor de base de datos. ¿Qué cambios hubo que realizar para la generación del id?

2) Modifique el sistema para permitir que las imágenes sean persistidas sobre la base de datos. El
software debe permitir cargar imágenes de hasta 10 MB. Si la imagen pesa más, se le debe
informar al usuario este inconveniente, y pre-cargando el formulario con los datos ingresados,
solicitar una nueva imagen.

3) Implemente Modificación y Baja de los registros del sistema de turnos.

4) Cada acción del ABM debe ser registrada usando el Logger del framework. Cada log debe ser
de tipo INFO y almacenar fecha y hora, operación (ABM), y turno afectado (id). En los casos de
modificación y baja, almacene el registro completo. ¿Considera esto util? ¿En que casos puede
llegar a utilizarse?

