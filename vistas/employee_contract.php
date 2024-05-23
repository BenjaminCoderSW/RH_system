<?php
require_once "./php/main.php";

$id = isset($_GET['employee_id_generate']) ? limpiar_cadena($_GET['employee_id_generate']) : 0;

$nombre = conexion();
$nombre = $nombre->query("SELECT empleado_nombre_completo FROM empleado WHERE empleado_id='$id'");
$dato_nombre = $nombre->fetch();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="mb-4">Generar Contrato a <?php echo $dato_nombre['empleado_nombre_completo']; ?></h3>
                    <?php
                    // Cierro la conexion anterior que ocupe para el nombre
                    $nombre = null;
                    // Abro una nueva conexion
                    $check_empleado = conexion();
                    $check_empleado = $check_empleado->query("SELECT * FROM empleado WHERE empleado_id='$id'");

                    // Si el empleado si existe en mi base de datos
                    if ($check_empleado->rowCount() > 0) {
                        // Coloco los datos de ese registro en un array llamado $datos
                        $datos = $check_empleado->fetch();
                        ?>
                        <div class="card-body">
                            <div class="form-rest mb-6 mt-6"></div>
                            
                            <form id="formEmpleadoGenerarContrato" action="./php/generar_contrato.php" method="POST" class="FormularioAjax" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="empleado_id" value="<?php echo $datos['empleado_id']; ?>" required>
                                        <input type="hidden" name="empleado_curp" value="<?php echo $datos['empleado_curp']; ?>" required>
                                        
                                        <div class="form-group">
                                            <label for="Empleado_estado_civil">Seleccionar contrato</label>
                                            <select class="form-control" id="Empleado_estado_civil_Update" name="empleado_tipo_de_contrato">
                                                <option value="13_Convenio_de_Confidencialidad_Anexo_8" >13_Convenio_de_Confidencialidad_Anexo_8</option>
                                                <option value="CONTRATO_2021_OBRA_DETERMINADA_ATZCO_ADM-OPERATIVOS_MODF" >CONTRATO_2021_OBRA_DETERMINADA_ATZCO_ADM-OPERATIVOS_MODF</option>
                                                <option value="CONTRATO_2021_OBRA_DETERMINADA_ATZCO_CAMPO_MODF" >CONTRATO_2021_OBRA_DETERMINADA_ATZCO_CAMPO_MODF</option>
                                                <option value="CONTRATO_TIEMPO_DETERMINADO" >CONTRATO_TIEMPO_DETERMINADO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php include "./inc/btn_back.php"; ?>
                                <button type="submit" id="btnGenerarContrato_a_empleado" class="btn btn-primary btn-md m-3">Descargar</button>
                            </form>
                        </div>
                    <?php
                    } else {
                        include "./inc/error_alert.php";
                    }
                    $check_empleado = null;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
