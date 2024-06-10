<?php
require_once "../inc/session_start.php";
require_once "main.php";

$correo_notificaciones = limpiar_cadena($_POST['correo_notificaciones']);
$action = limpiar_cadena($_POST['action']);

$config = conexion();

if ($action == 'guardar') {
    // Verificar si ya hay un correo configurado
    $resultado = $config->query("SELECT id FROM configuracion LIMIT 1");
    if ($resultado->rowCount() > 0) {
        // Actualizar el correo existente
        $update = $config->prepare("UPDATE configuracion SET correo = :correo LIMIT 1");
        $update->execute([":correo" => $correo_notificaciones]);
    } else {
        // Insertar el nuevo correo
        $insert = $config->prepare("INSERT INTO configuracion (correo) VALUES (:correo)");
        $insert->execute([":correo" => $correo_notificaciones]);
    }

    echo '<div class="notification is-success is-light">
            <strong>¡Correo Configurado!</strong><br>
            El correo para notificaciones ha sido configurado correctamente.
          </div>';
    echo '<script>
            setTimeout(function() {
                window.location.href = "../index.php?vista=mail_configuration";
            }, 3000);
          </script>';
} elseif ($action == 'eliminar') {
    // Eliminar el correo existente
    $delete = $config->prepare("DELETE FROM configuracion LIMIT 1");
    $delete->execute();

    echo '<div class="notification is-success is-light">
            <strong>¡Correo Eliminado!</strong><br>
            El correo para notificaciones ha sido eliminado correctamente.
          </div>';
    echo '<script>
            setTimeout(function() {
                window.location.href = "../index.php?vista=mail_configuration";
            }, 3000);
          </script>';
}

$config = null;
?>
