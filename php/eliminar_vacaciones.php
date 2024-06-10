<?php
require_once "main.php";

if (isset($_GET['vacaciones_id']) && isset($_GET['dias_solicitados'])) {
    $vacaciones_id = (int) $_GET['vacaciones_id'];
    $dias_solicitados = (int) $_GET['dias_solicitados'];

    // Conectar a la base de datos
    $conexion = conexion();

    // Obtener el nombre del archivo PDF de la base de datos
    $consulta_pdf = $conexion->prepare("SELECT archivo_pdf FROM vacaciones WHERE vacaciones_id = :vacaciones_id");
    $consulta_pdf->bindParam(':vacaciones_id', $vacaciones_id, PDO::PARAM_INT);
    $consulta_pdf->execute();
    $resultado_pdf = $consulta_pdf->fetch(PDO::FETCH_ASSOC);

    if ($resultado_pdf && !empty($resultado_pdf['archivo_pdf'])) {
        $archivo_pdf = $resultado_pdf['archivo_pdf'];
        $ruta_archivo = "../img/pdfs/" . $archivo_pdf;

        // Eliminar el archivo del servidor si existe
        if (file_exists($ruta_archivo)) {
            unlink($ruta_archivo);
        }
    }

    // Eliminar el registro de vacaciones de la base de datos
    $consulta_eliminar = $conexion->prepare("DELETE FROM vacaciones WHERE vacaciones_id = :vacaciones_id");
    $consulta_eliminar->bindParam(':vacaciones_id', $vacaciones_id, PDO::PARAM_INT);
    if ($consulta_eliminar->execute()) {
        $response = [
            'status' => true,
            'message' => 'Solicitud de vacaciones y archivo (si existía) eliminados correctamente.'
        ];
    } else {
        $response = [
            'status' => false,
            'message' => 'No se pudo eliminar la solicitud de vacaciones.'
        ];
    }

    echo json_encode($response);
    $conexion = null;
} else {
    echo json_encode([
        'status' => false,
        'message' => 'Parámetros faltantes.'
    ]);
}
?>