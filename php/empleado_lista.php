<?php
// Incluye las configuraciones principales y la conexión a la base de datos
require_once "../inc/session_start.php";
require_once "main.php";

$response = ['success' => false, 'message' => 'Algo salió mal.', 'data' => []];

try {
    // Asegúrate de que se recibe el ID del empleado y es un número válido
    $empleado_id = isset($_POST['empleado_id']) ? (int)$_POST['empleado_id'] : 0;

    if ($empleado_id > 0) {
        $conexion = conexion();
        $consulta = $conexion->prepare("SELECT * FROM empleado WHERE empleado_id = :empleado_id");
        $consulta->execute(['empleado_id' => $empleado_id]);
        $empleado = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($empleado) {
            $response['success'] = true;
            $response['message'] = 'Datos del empleado cargados correctamente.';
            $response['data'] = $empleado;
        } else {
            $response['message'] = 'No se encontró el empleado.';
        }
    } else {
        $response['message'] = 'ID de empleado no válido.';
    }
} catch (PDOException $e) {
    $response['message'] = 'Error en la base de datos: ' . $e->getMessage();
}


echo json_encode($response);

?>
