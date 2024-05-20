<?php
require_once "main.php";  // Asegúrate de que este archivo contiene la función para conectarte a la base de datos.

$response = ['success' => false, 'message' => 'No se pudo procesar la solicitud.'];

try {
    if (isset($_GET['id'])) {
        $idContrato = $_GET['id'];

        $conexion = conexion();

        // Obtén el nombre del archivo antes de eliminar el registro.
        $consulta = $conexion->prepare("SELECT contrato_nombre_de_imagen FROM contrato WHERE contrato_id = ?");
        $consulta->execute([$idContrato]);
        $nombreArchivo = $consulta->fetchColumn();

        if ($nombreArchivo) {
            // Elimina el registro de la base de datos.
            $consulta = $conexion->prepare("DELETE FROM contrato WHERE contrato_id = ?");
            if ($consulta->execute([$idContrato])) {
                // Verifica y elimina el archivo del servidor.
                $rutaArchivo = "../img/contratos/" . $nombreArchivo;
                if (file_exists($rutaArchivo) && unlink($rutaArchivo)) {
                    $response['success'] = true;
                    $response['message'] = 'El contrato y el archivo han sido eliminados correctamente.';
                } else {
                    $response['message'] = 'El contrato fue eliminado de la base de datos, pero el archivo no pudo ser eliminado o ya fue eliminado.';
                }
            } else {
                $response['message'] = 'No se pudo eliminar el contrato de la base de datos.';
            }
        } else {
            $response['message'] = 'No se encontró el archivo del contrato especificado.';
        }
    } else {
        $response['message'] = 'No se recibió el identificador del contrato.';
    }
} catch (PDOException $e) {
    $response['message'] = 'Error en la base de datos: ' . $e->getMessage();
}

echo json_encode($response);
?>
