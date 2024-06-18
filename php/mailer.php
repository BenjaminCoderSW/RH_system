<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php'; // Utiliza una ruta absoluta

function enviar_correo($asunto, $cuerpo, $destinatario) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host       = 'smx5.hostdime.com.mx'; // Cambia esto al servidor SMTP que estés usando
        $mail->SMTPAuth   = true;
        $mail->Username   = 'soporte@atzco.com.mx';
        $mail->Password   = 'Atzco.170624*SPT';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // Configuración del remitente y destinatario
        $mail->setFrom('soporte@atzco.com.mx', 'Sistema RH Atzco');
        $mail->addAddress($destinatario);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpo;

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo 'No se pudo enviar el correo de verificación. Error: ', $mail->ErrorInfo;
        return false;
    }
}
?>
