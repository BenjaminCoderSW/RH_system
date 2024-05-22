<?php
require_once "main.php"; // Asegúrate de que este archivo contiene la conexión a la base de datos y cualquier función necesaria

$response = ['success' => false, 'message' => 'Error en la operación.'];

// Verifica si hay un archivo y si es una solicitud POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['expedienteArchivo'])) {
    $archivo = $_FILES['expedienteArchivo'];
    $nombreArchivo = $archivo['name'];
    $tipoArchivo = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

    // Solo permite .zip o .rar
    if ($tipoArchivo !== "zip" && $tipoArchivo !== "rar") {
        $response['message'] = 'Solo se permiten archivos .zip o .rar.';
        echo json_encode($response);
        exit();
    }

    // Normaliza el nombre del archivo (reemplaza espacios por guiones bajos)
    $nombreGuardado = str_replace(" ", "_", $nombreArchivo);

    // Ruta de la carpeta donde se guardarán los expedientes
    $directorioExpedientes = "../img/expedientes/";

    // Verifica y crea la carpeta si no existe
    if (!file_exists($directorioExpedientes)) {
        mkdir($directorioExpedientes, 0777, true);
    }

    // Intenta insertar el nombre del archivo en la base de datos
    $conexion = conexion();
    $consulta = $conexion->prepare("INSERT INTO expediente (expediente_nombre_de_archivo_comprimido) VALUES (?)");
    if ($consulta->execute([$nombreGuardado])) {
        // Intenta mover el archivo a la carpeta de expedientes
        if (move_uploaded_file($archivo['tmp_name'], $directorioExpedientes . $nombreGuardado)) {
            $response['success'] = true;
            $response['message'] = 'El expediente ha sido subido y registrado correctamente.';
        } else {
            // Si falla la subida del archivo, elimina la entrada de la base de datos
            $consulta = $conexion->prepare("DELETE FROM expediente WHERE expediente_nombre_de_archivo_comprimido = ?");
            $consulta->execute([$nombreGuardado]);
            $response['message'] = 'Error al subir el archivo.';
        }
    } else {
        $response['message'] = 'Error al guardar el nombre del archivo en la base de datos.';
    }
} else {
    $response['message'] = 'No se recibió el archivo o los datos necesarios.';
}

echo json_encode($response);
?>
