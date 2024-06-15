<?php
require_once "main.php";

// Recuperamos el ID del empleado y el nombre del archivo desde la URL
$id = isset($_GET['employee_id_exp']) ? limpiar_cadena($_GET['employee_id_exp']) : 0;
$fileName = isset($_GET['file']) ? limpiar_cadena($_GET['file']) : '';

$conexion = conexion();

// Iniciamos una transacción para manejar las operaciones de base de datos
$conexion->beginTransaction();

try {
    // Eliminamos el registro del expediente de la base de datos
    $stmt = $conexion->prepare("DELETE FROM expediente WHERE empleado_id = :id AND expediente_nombre_de_archivo_comprimido = :fileName");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':fileName', $fileName);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Si el registro se eliminó exitosamente, eliminamos el archivo del sistema de archivos
        $filePath = '../img/expedientes/' . $fileName;
        if (file_exists($filePath)) {
            if (!unlink($filePath)) {
                // Si hay un error al eliminar el archivo, lanzamos una excepción
                throw new Exception("Error al eliminar el archivo.");
            }
        }
        // Si todo sale bien, confirmamos las operaciones de la base de datos
        $conexion->commit();
        echo '<div class="notification is-success is-light">
            <strong>¡Expediente eliminado con éxito!</strong>
        </div>';
        echo '<script>
            setTimeout(function() {
                window.location.href = "../index.php?vista=employee_list";
            }, 3000);
        </script>';
    } else {
        // Si no se encontró el registro, lanzamos una excepción
        throw new Exception("No se encontró el registro del expediente.");
    }
} catch (Exception $e) {
    // Si algo sale mal, revertimos las operaciones de la base de datos
    $conexion->rollBack();
    echo '<div class="notification is-danger is-light">
        <strong>¡Error!</strong><br>' . $e->getMessage() . '
    </div>';
}

$conexion = null;
?>
