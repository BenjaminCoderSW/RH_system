<?php
require_once "main.php"; // Asegúrate de incluir main.php para las funciones de conexión y limpieza
require_once "mailer.php"; // Incluir el archivo mailer.php

// Limpiamos de inyeccion SQL y almacenamos lo que contiene la variable de tipo GET llamada employee_id_del en mi variable employee_id_del
// que es el id del usuario que se quiere eliminar
$employee_id_del = limpiar_cadena($_GET['employee_id_del']);

// Abrimos la conexion a la base de datos y la almacenamos en la variable $check_empleado
$check_empleado = conexion();
// Despues hacemos un select del empleado_id de la tabla empleado donde empleado_id sea igual al empleado que estamos pasandole por medio de la variable get 
// y esa peticion la almacenamos en la variable $check_empleado
$check_empleado = $check_empleado->query("SELECT * FROM empleado WHERE empleado_id='$employee_id_del'");

// Este if es para saber si existe el empleado que se quizo seleccionar anteriormente en la base de datos
// Si los datos seleccionados en la consulta es igual a 1 entonces significa que si existe, entonces
if ($check_empleado->rowCount() == 1) {
    $empleado = $check_empleado->fetch();

    // Abrimos conexion a la base de datos
    $eliminar_empleado = conexion();
    // Preparamos una consulta delete a la base de datos para eliminar todo ese registro de ese empleado mediante su id
    $eliminar_empleado = $eliminar_empleado->prepare("DELETE FROM empleado WHERE empleado_id=:id");
    // Ejecuto la consulta enviandole el valor real al marcador que hice del id
    $eliminar_empleado->execute([":id" => $employee_id_del]);

    // Si se eliminó un dato (un empleado) entonces:
    if ($eliminar_empleado->rowCount() == 1) {
        // Obtener el correo de notificaciones
        $config = conexion();
        $resultado = $config->query("SELECT correo FROM configuracion LIMIT 1");
        if ($resultado->rowCount() > 0) {
            $correo_destino = $resultado->fetchColumn();
            $asunto = "Empleado eliminado";
            $cuerpo = "Se ha eliminado al empleado: {$empleado['empleado_nombres']} {$empleado['empleado_apellido_paterno']} {$empleado['empleado_apellido_materno']} por {$_SESSION['nombre']}";
            enviar_correo($asunto, $cuerpo, $correo_destino);
        }
        $config = null;

        echo '<div class="notification is-success is-light">
                <strong>¡Empleado Eliminado!</strong><br>
                El empleado ha sido eliminado correctamente.
              </div>';
        echo '<script>
                setTimeout(function() {
                    window.location.href = "index.php?vista=employee_list";
                }, 3000);
              </script>';
    } else {
        echo '<div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo eliminar el empleado, por favor intente nuevamente.
              </div>';
        echo '<script>
                setTimeout(function() {
                    window.location.href = "index.php?vista=employee_list";
                }, 3000);
              </script>';
    }
    $eliminar_empleado = null;
} else {
    echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El empleado no existe en el sistema.
          </div>';
    echo '<script>
            setTimeout(function() {
                window.location.href = "index.php?vista=employee_list";
            }, 3000);
          </script>';
}
$check_empleado = null;
?>
