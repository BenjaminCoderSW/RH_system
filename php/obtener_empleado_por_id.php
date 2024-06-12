<?php
require_once "main.php";
$conexion = conexion();
$empleado_id = $_GET['empleado_id'];
$query = $conexion->prepare("SELECT * FROM empleado WHERE empleado_id = :empleado_id");
$query->execute([':empleado_id' => $empleado_id]);
$empleado = $query->fetch(PDO::FETCH_ASSOC);

// Agregar la ruta de la foto al array de datos del empleado
$empleado['foto_ruta'] = !empty($empleado['empleado_foto']) ? './img/fotos_empleados/' . $empleado['empleado_foto'] : null;

echo json_encode($empleado);
?>
