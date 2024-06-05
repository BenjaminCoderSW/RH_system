<?php
require_once "main.php";

$fileName = isset($_GET['file']) ? limpiar_cadena($_GET['file']) : '';
$filePath = '../img/contratos/' . $fileName;

if (file_exists($filePath)) {
    $fileType = mime_content_type($filePath);
    header('Content-Description: File Transfer');
    header('Content-Type: ' . $fileType);
    header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));

    ob_clean();
    flush();

    readfile($filePath);
    exit();
} else {
    echo '<div class="notification is-danger is-light">
        <strong>Error:</strong> El archivo solicitado no existe.
    </div>';
}
?>
