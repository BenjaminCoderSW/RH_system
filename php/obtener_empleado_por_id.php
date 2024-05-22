<?php
require_once "main.php";
$conexion = conexion();
$empleado_id = $_GET['empleado_id'];
$query = $conexion->prepare("SELECT * FROM empleado WHERE empleado_id = :empleado_id");
$query->execute([':empleado_id' => $empleado_id]);
$empleado = $query->fetch(PDO::FETCH_ASSOC);
echo json_encode($empleado);
