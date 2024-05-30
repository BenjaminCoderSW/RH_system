<?php
require_once "./php/main.php";

$id = isset($_GET['employee_id_exp']) ? limpiar_cadena($_GET['employee_id_exp']) : 0;
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
                <form action="upload_expediente.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="employee_id" value="">
                    <div class="form-group">
                        <label for="file">Seleccione el archivo del expediente (.rar, .zip) MAX 3MB</label>
                        <input type="file" class="form-control-file" id="file" name="file" accept=".rar,.zip" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Subir Archivo</button>
                </form>
            </div>
            <?php
            } else {
                include "./inc/error_alert.php";
            }
            $check_empleado_exp = null;
            ?>
        </div>
    </div>