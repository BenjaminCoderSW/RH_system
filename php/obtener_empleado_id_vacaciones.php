<?php
require_once "main.php";

$empleado_id = limpiar_cadena($_GET['empleado_id']);

$conexion = conexion();

$vacaciones_query = $conexion->prepare("SELECT * FROM vacaciones WHERE empleado_id = :empleado_id ORDER BY vacaciones_dia_solicitud DESC");
$vacaciones_query->bindParam(':empleado_id', $empleado_id, PDO::PARAM_INT);
$vacaciones_query->execute();

$vacaciones_data = $vacaciones_query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($vacaciones_data);
$conexion = null;
?>