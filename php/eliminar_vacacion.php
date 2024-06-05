<!-- Este es para la busqueda -->
<?php
require_once "main.php";

$vacaciones_id = limpiar_cadena($_GET['vacaciones_id']);

$conexion = conexion();

$consulta = $conexion->prepare("DELETE FROM vacaciones WHERE vacaciones_id = :vacaciones_id");
$consulta->bindParam(':vacaciones_id', $vacaciones_id, PDO::PARAM_INT);

if ($consulta->execute()) {
    echo json_encode(['status' => true, 'message' => 'Solicitud de vacaciones eliminada correctamente.']);
} else {
    echo json_encode(['status' => false, 'message' => 'No se pudo eliminar la solicitud de vacaciones.']);
}
?>