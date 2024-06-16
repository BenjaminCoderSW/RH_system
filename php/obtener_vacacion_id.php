<?php
require_once "main.php";

if (isset($_GET['vacacion_id'])) {
    $vacacion_id = limpiar_cadena($_GET['vacacion_id']);
    $conexion = conexion();
    $consulta = $conexion->prepare("SELECT * FROM vacaciones WHERE vacaciones_id = :vacacion_id");
    $consulta->bindParam(':vacacion_id', $vacacion_id, PDO::PARAM_INT);
    $consulta->execute();
    $vacacion = $consulta->fetch(PDO::FETCH_ASSOC);
    echo json_encode($vacacion);
} else {
    echo json_encode(null);
}
?>
