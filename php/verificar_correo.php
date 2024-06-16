<?php
require_once "main.php";

$token = limpiar_cadena($_GET['token']);

$config = conexion();
$query = $config->prepare("SELECT correo FROM configuracion_temporal WHERE token = :token LIMIT 1");
$query->execute([":token" => $token]);

if ($query->rowCount() > 0) {
    $correo = $query->fetchColumn();

    // Verificar si ya hay un correo configurado
    $resultado = $config->query("SELECT id FROM configuracion LIMIT 1");
    if ($resultado->rowCount() > 0) {
        // Actualizar el correo existente
        $update = $config->prepare("UPDATE configuracion SET correo = :correo LIMIT 1");
        $update->execute([":correo" => $correo]);
    } else {
        // Insertar el nuevo correo
        $insert = $config->prepare("INSERT INTO configuracion (correo) VALUES (:correo)");
        $insert->execute([":correo" => $correo]);
    }

    // Eliminar la entrada temporal
    $delete = $config->prepare("DELETE FROM configuracion_temporal WHERE token = :token");
    $delete->execute([":token" => $token]);

    echo '<div class="notification is-success is-light">
            <strong>¡Correo verificado y configurado!</strong><br>
            El correo para notificaciones ha sido configurado correctamente.
          </div>';
} else {
    echo '<div class="notification is-danger is-light">
            <strong>¡Token inválido!</strong><br>
            El enlace de verificación no es válido o ha expirado.
          </div>';
}

echo '<script>
        setTimeout(function() {
            window.location.href = "../index.php?vista=mail_configuration";
        }, 3000);
      </script>';

$config = null;
?>
