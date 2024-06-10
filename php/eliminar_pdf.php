<?php
require_once "main.php";

if (isset($_GET['vacacion_id'])) {
    $vacacion_id = (int) $_GET['vacacion_id'];

    // Conectar a la base de datos
    $conexion = conexion();

    // Obtener el nombre del archivo PDF de la base de datos
    $consulta = $conexion->prepare("SELECT archivo_pdf FROM vacaciones WHERE vacaciones_id = :vacacion_id");
    $consulta->bindParam(':vacacion_id', $vacacion_id, PDO::PARAM_INT);
    $consulta->execute();
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        $archivo_pdf = $resultado['archivo_pdf'];
        
        // Ruta completa del archivo PDF
        $ruta_archivo = "../img/pdfs/" . $archivo_pdf;

        // Eliminar el archivo del servidor si existe
        if (file_exists($ruta_archivo)) {
            if (unlink($ruta_archivo)) {
                // Eliminar el registro de la base de datos
                $consulta_eliminar = $conexion->prepare("UPDATE vacaciones SET archivo_pdf = NULL WHERE vacaciones_id = :vacacion_id");
                $consulta_eliminar->bindParam(':vacacion_id', $vacacion_id, PDO::PARAM_INT);
                if ($consulta_eliminar->execute()) {
                    $response = [
                        'status' => true,
                        'message' => 'Archivo eliminado correctamente.'
                    ];
                } else {
                    $response = [
                        'status' => false,
                        'message' => 'No se pudo eliminar el registro de la base de datos.'
                    ];
                }
            } else {
                $response = [
                    'status' => false,
                    'message' => 'No se pudo eliminar el archivo del servidor.'
                ];
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'El archivo no existe en el servidor.'
            ];
        }
    } else {
        $response = [
            'status' => false,
            'message' => 'No se encontró el registro en la base de datos.'
        ];
    }

    echo json_encode($response);
    $conexion = null;
} else {
    echo json_encode([
        'status' => false,
        'message' => 'Solicitud inválida.'
    ]);
}
?>