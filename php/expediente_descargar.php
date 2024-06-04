<?php
require_once "main.php";

// Recuperamos el nombre del archivo desde la URL
$fileName = isset($_GET['file']) ? limpiar_cadena($_GET['file']) : '';

// Definimos el directorio donde se almacenan los expedientes
$filePath = '../img/expedientes/' . $fileName;

// Verificamos si el archivo existe
if (file_exists($filePath)) {
    // Preparar headers para la descarga
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream'); // Puedes ser más específico según el tipo de archivo, ej: application/zip
    header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));

    // Limpiar el búfer de salida del sistema
    ob_clean();
    flush();

    // Leer el archivo y enviarlo al navegador
    readfile($filePath);

    exit;
} else {
    // Si el archivo no existe, enviamos un mensaje de error
    echo '<div class="notification is-danger is-light">
        <strong>Error:</strong> El archivo solicitado no existe.
    </div>';
}
?>
