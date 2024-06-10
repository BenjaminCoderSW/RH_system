<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php'; // Utiliza una ruta absoluta

function enviar_correo($asunto, $cuerpo, $destinatario) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com'; // Cambia esto al servidor SMTP que estés usando
        $mail->SMTPAuth   = true;
        $mail->Username   = 'inventariosmart@cinetickett.com'; // Cambia esto por tu correo
        $mail->Password   = 'Hola123.'; // Cambia esto por tu contraseña
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // Configuración del remitente y destinatario
        $mail->setFrom('inventariosmart@cinetickett.com', 'Sistema RH Atzco');
        $mail->addAddress($destinatario);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpo;

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo 'No se a podido hacer la configuracion correctamente';
    }
}
?>
