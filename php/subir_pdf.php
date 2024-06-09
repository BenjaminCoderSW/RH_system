<?php
require_once "main.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['archivo_pdf']) && isset($_POST['vacaciones_id'])) {
        $archivo_pdf = $_FILES['archivo_pdf'];
        $vacaciones_id = limpiar_cadena($_POST['vacaciones_id']);

        if ($archivo_pdf['error'] === UPLOAD_ERR_OK) {
            $nombre_archivo = basename($archivo_pdf['name']);
            $ruta_destino = "../img/pdfs/" . $nombre_archivo;

            // Crear el directorio si no existe
            if (!is_dir("../img/pdfs")) {
                mkdir("../img/pdfs", 0777, true);
            }

            if (move_uploaded_file($archivo_pdf['tmp_name'], $ruta_destino)) {
                $conexion = conexion();
                $update_query = $conexion->prepare("UPDATE vacaciones SET archivo_pdf = :archivo_pdf WHERE vacaciones_id = :vacaciones_id");
                $update_query->bindParam(':archivo_pdf', $nombre_archivo);
                $update_query->bindParam(':vacaciones_id', $vacaciones_id);
                $update_query->execute();
                $conexion = null;

                echo json_encode(['status' => true, 'message' => 'PDF subido exitosamente']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Error al mover el archivo']);
            }
        } else {
            echo json_encode(['status' => false, 'message' => 'Error al subir el archivo']);
        }
    } else {
        echo json_encode(['status' => false, 'message' => 'Parámetros faltantes']);
    }
} else {
    echo json_encode(['status' => false, 'message' => 'Método no permitido']);
}
?>