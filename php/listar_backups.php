<?php
// php/listar_backups.php
$backupDir = '../Backups/';
$backups = array();

if (is_dir($backupDir)) {
    $files = scandir($backupDir);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $backups[] = array(
                'nombre' => $file,
                'fecha' => date('Y-m-d H:i:s', filemtime($backupDir . $file)),
                'ruta' => $backupDir . $file
            );
        }
    }
}

echo json_encode(array('backups' => $backups));
?>
