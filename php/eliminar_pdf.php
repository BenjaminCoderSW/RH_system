<?php
require_once "main.php";

if (!isset($_GET['vacacion_id'])) {
    echo json_encode(['status' => false, 'message' => 'Parámetro faltante']);
    exit();
}

$vacacion_id = limpiar_cadena($_GET['vacacion_id']);

// Obtener el nombre del archivo PDF
$conexion = conexion();
$pdf_query = $conexion->prepare("SELECT archivo_pdf FROM vacaciones WHERE vacaciones_id = :vacacion_id");
$pdf_query->bindParam(':vacacion_id', $vacacion_id);
$pdf_query->execute();
$pdf_result = $pdf_query->fetch(PDO::FETCH_ASSOC);

if ($pdf_result && !empty($pdf_result['archivo_pdf'])) {
    $pdf_path = '../img/pdfs/' . $pdf_result['archivo_pdf'];

    if (file_exists($pdf_path)) {
        unlink($pdf_path);
    }

    // Actualizar el registro de vacaciones para eliminar la referencia al archivo PDF
    $update_query = $conexion->prepare("UPDATE vacaciones SET archivo_pdf = NULL WHERE vacaciones_id = :vacacion_id");
    $update_query->bindParam(':vacacion_id', $vacacion_id);
    $update_query->execute();
    $conexion = null;

    echo json_encode(['status' => true, 'message' => 'PDF eliminado exitosamente']);
} else {
    echo json_encode(['status' => false, 'message' => 'Archivo PDF no encontrado']);
}
?>