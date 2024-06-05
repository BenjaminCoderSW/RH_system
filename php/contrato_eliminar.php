<?php
require_once "main.php";

$id = isset($_GET['contract_id']) ? limpiar_cadena($_GET['contract_id']) : 0;
$fileName = isset($_GET['file']) ? limpiar_cadena($_GET['file']) : '';

$conexion = conexion();
$conexion->beginTransaction();

try {
    $stmt = $conexion->prepare("DELETE FROM contrato WHERE contrato_id = :id AND contrato_nombre_de_imagen = :fileName");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':fileName', $fileName);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $filePath = '../img/contratos/' . $fileName;
        if (file_exists($filePath)) {
            if (!unlink($filePath)) {
                throw new Exception("Error al eliminar el archivo.");
            }
        }
        $conexion->commit();
        echo '<div class="notification is-success is-light">
            <strong>¡Contrato eliminado con éxito!</strong>
        </div>';
        echo '<script>
            setTimeout(function() {
                window.location.href = "../index.php?vista=contract_list";
            }, 3000);
        </script>';
    } else {
        throw new Exception("No se encontró el registro del contrato.");
    }
} catch (Exception $e) {
    $conexion->rollBack();
    echo '<div class="notification is-danger is-light">
        <strong>¡Error!</strong><br>' . htmlspecialchars($e->getMessage()) . '
    </div>';
}

$conexion = null;
?>
