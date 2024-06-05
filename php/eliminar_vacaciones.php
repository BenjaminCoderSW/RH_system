<?php
require_once "main.php";

$vacaciones_id = limpiar_cadena($_GET['vacaciones_id']);
$dias_solicitados = limpiar_cadena($_GET['dias_solicitados']);

try {
    $conexion = conexion();
    $consulta = $conexion->prepare("DELETE FROM vacaciones WHERE vacaciones_id = :vacaciones_id");
    $consulta->bindParam(':vacaciones_id', $vacaciones_id, PDO::PARAM_INT);
    $consulta->execute();

    if ($consulta->rowCount() == 1) {
        echo json_encode(['status' => true, 'message' => 'La solicitud de vacaciones ha sido eliminada.']);
    } else {
        echo json_encode(['status' => false, 'message' => 'No se pudo eliminar la solicitud de vacaciones.']);
    }
    $conexion = null;
} catch (PDOException $e) {
    echo json_encode(['status' => false, 'message' => 'Error al eliminar la solicitud de vacaciones: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['status' => false, 'message' => 'Error inesperado: ' . $e->getMessage()]);
}
?>