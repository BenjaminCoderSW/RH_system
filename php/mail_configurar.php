<?php
require_once "../inc/session_start.php";
require_once "main.php";
require_once "mailer.php"; // Incluir el archivo mailer.php

// Función para validar el formato del correo electrónico
function validar_correo($correo) {
    return filter_var($correo, FILTER_VALIDATE_EMAIL);
}

$correo_notificaciones = limpiar_cadena($_POST['correo_notificaciones']);
$action = limpiar_cadena($_POST['action']);

// Verificar el formato del correo
if (!validar_correo($correo_notificaciones)) {
    echo '<div class="notification is-danger is-light">
            <strong>¡Correo Inválido!</strong><br>
            El correo electrónico ingresado no tiene un formato válido.
          </div>';
    echo '<script>
            setTimeout(function() {
                window.location.href = "../index.php?vista=mail_configuration";
            }, 3000);
          </script>';
    exit();
}

$config = conexion();

if ($action == 'guardar') {
    // Generar un token de verificación
    $token = bin2hex(random_bytes(16));
    // Establecer fecha de expiración (5 minutos desde la creación)
    $fecha_expiracion = date("Y-m-d H:i:s", strtotime('+5 minutes'));

    // Guardar el correo y el token temporalmente en la base de datos
    $insert = $config->prepare("INSERT INTO configuracion_temporal (correo, token, fecha_expiracion) VALUES (:correo, :token, :fecha_expiracion)");
    $insert->execute([":correo" => $correo_notificaciones, ":token" => $token, ":fecha_expiracion" => $fecha_expiracion]);

    // Enviar el correo de verificación
    $asunto = "Verificación de correo electrónico";
    $cuerpo = "Tu token de verificación es: $token. Ingresa este token en el sistema para verificar tu correo. Este token expira en 5 minutos.";

    if (enviar_correo($asunto, $cuerpo, $correo_notificaciones)) {
        echo '<div class="notification is-success is-light">
                <strong>¡Correo enviado!</strong><br>
                Revisa tu bandeja de entrada para obtener el token de verificación.
              </div>';
        echo '<script>
              setTimeout(function() {
                  window.location.href = "../index.php?vista=verify_token";
              }, 3000);
        </script>';
    } else {
        echo '<div class="notification is-danger is-light">
                <strong>¡Error al enviar el correo!</strong><br>
                No se pudo enviar el correo de verificación. Inténtalo de nuevo.
              </div>';
        echo '<script>
              setTimeout(function() {
                  window.location.href = "../index.php?vista=mail_configuration";
              }, 3000);
        </script>';
    }

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
