<?php
// php/eliminar_backup.php
$response = array();

if (isset($_GET['nombre'])) {
    $backupDir = '../Backups/';
    $nombreBackup = $_GET['nombre'];
    $rutaBackup = $backupDir . $nombreBackup;

    if (file_exists($rutaBackup)) {
        if (unlink($rutaBackup)) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
    } else {
        $response['success'] = false;
    }
} else {
    $response['success'] = false;
}

echo json_encode($response);
?>
