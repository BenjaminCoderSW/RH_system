<?php
require_once "./php/main.php";

$id = isset($_GET['employee_id_exp']) ? limpiar_cadena($_GET['employee_id_exp']) : 0;

$conexion = conexion();
$stmt = $conexion->prepare("SELECT COUNT(*) FROM expediente WHERE empleado_id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$tiene_expediente = $stmt->fetchColumn() > 0;

$expediente_info = null;
if ($tiene_expediente) {
    // Obtener información del expediente para poder eliminarlo o descargarlo
    $stmt = $conexion->prepare("SELECT expediente_nombre_de_archivo_comprimido FROM expediente WHERE empleado_id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $expediente_info = $stmt->fetch();
}

?>
<div class="container">
    <div class="card">
        <?php
        $check_empleado_exp = conexion();
        $check_empleado_exp = $check_empleado_exp->query("SELECT * FROM empleado WHERE empleado_id='$id'");

        if ($check_empleado_exp->rowCount() > 0) {
            $datos = $check_empleado_exp->fetch();
            $nombreCompleto = $datos['empleado_nombres'] . " " . $datos['empleado_apellido_paterno'] . " " . $datos['empleado_apellido_materno'];
            ?>
        <div class="card-header">
            <h3 class="card-title">Expediente de <?php echo $nombreCompleto; ?></h3>
        </div>
        <div class="card-body">
            <?php if ($tiene_expediente) { ?>
                <!-- Botón para descargar el expediente -->
                <a href="./php/expediente_descargar.php?file=<?php echo urlencode($expediente_info['expediente_nombre_de_archivo_comprimido']); ?>" class="btn btn-success">Descargar Expediente</a>
                <!-- Botón para eliminar el expediente -->
                <button onclick="confirmarEliminacion('<?php echo $id; ?>', '<?php echo $expediente_info['expediente_nombre_de_archivo_comprimido']; ?>')" class="btn btn-danger">Eliminar Expediente</button>
            <?php } else { ?>
                <!-- Formulario para subir archivos, solo visible si no hay expediente cargado -->
                <form action="./php/expediente_guardar.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="employee_id_exp" value="<?php echo $id; ?>">
                    <input type="hidden" name="action" value="upload">
                    <div class="form-group">
                        <label for="file">Seleccione el archivo del expediente (.rar, .zip) MAX 20MB</label>
                        <input type="file" class="form-control-file" id="file" name="empleado_expediente" accept=".rar,.zip" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Subir Archivo</button>
                </form>
            <?php } ?>
        </div>
        <?php
        } else {
            include "./inc/error_alert.php";
        }
        $check_empleado_exp = null;
        ?>
    </div>
</div>
<script>
function confirmarEliminacion(empId, fileName) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción no se puede deshacer y eliminará el expediente permanentemente.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "./php/expediente_eliminar.php?employee_id_exp=" + empId + "&file=" + encodeURIComponent(fileName);
        }
    });
}
</script>
