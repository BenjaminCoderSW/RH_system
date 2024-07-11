<?php
include 'main.php';

// Credenciales de Hosting BD de la empresa
$servidor = 'srv1288.hstgr.io';
$usuario = 'u496700722_benja';
$contrasena = 'hGtH5T!>0X';
$baseDeDatos = 'u496700722_hr_basededatos';

// Credenciales de Hosting BD de mi hosting y mi base de datos
// $servidor = 'srv867.hstgr.io';
// $usuario = 'u954703204_brian';
// $contrasena = 'wRO9KdAc5|';
// $baseDeDatos = 'u954703204_hr_basededatos';

$backupDir = '../Backups/';
$nombreBackup = 'backup_' . date('Ymd_His') . '.sql';
$rutaBackup = realpath(dirname(__FILE__)) . '/../Backups/' . $nombreBackup;

// Verificar si la carpeta Backups existe, si no, crearla con los permisos necesarios
if (!is_dir($backupDir)) {
    mkdir($backupDir, 0777, true);
    if (!is_dir($backupDir)) {
        $response['success'] = false;
        $response['error'] = "No se pudo crear el directorio de backups.";
        echo json_encode($response);
        exit();
    }
}

// Escapar correctamente la contraseña en el comando
$comando = "mysqldump -h $servidor -u $usuario -p'$contrasena' $baseDeDatos > $rutaBackup 2>&1";

exec($comando, $output, $resultado);

$response = array();
$response['output'] = $output;
$response['resultado'] = $resultado;

if (file_exists($rutaBackup) && filesize($rutaBackup) > 0) {
    $response['success'] = true;
    $response['ruta'] = $rutaBackup; // Añadir ruta al response
    $response['nombre'] = $nombreBackup;
} else {
    $response['success'] = false;
    $response['error'] = implode("\n", $output);
}

header('Content-Type: application/json');
echo json_encode($response);
?>
