<?php
if (isset($_GET['file'])) {
    $file = basename($_GET['file']);
    $filepath = "../img/pdfs/" . $file;

    if (file_exists($filepath)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        readfile($filepath);
        exit;
    } else {
        die('Archivo no encontrado');
    }
} else {
    die('Parámetro faltante');
}
?>