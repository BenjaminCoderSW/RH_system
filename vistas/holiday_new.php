<?php
require_once "./php/main.php";

$id = isset($_GET['employee_id_vac']) ? limpiar_cadena($_GET['employee_id_vac']) : 0;

$check_empleado = conexion();
$check_empleado = $check_empleado->query("SELECT * FROM empleado WHERE empleado_id='$id'");

if ($check_empleado->rowCount() > 0) {
    $datos = $check_empleado->fetch();
}

?>

<!-- En este div vamos a mostrar la respuesta que nos devuelva el archivo que va a procesar los datos a treves de AJAX
osea el archivo ajax.js a treves de la clase form-rest -->
<div class="form-rest mb-6 mt-6"></div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 offset-md-3">
            <div class="mb-5">
                <div>
                    <h1>Solicitar Vacaciones</h1>
                </div>

                <form action="./php/solicitar_vacaciones.php" method="POST" class="FormularioAjax" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6">

                            <!-- Campo de texto invisible que ya me trae el id del empleado -->
                            <input type="hidden" name="empleado_vacaciones_id" value="<?php echo $id; ?>" required>
                            <input type="hidden" name="empleado_nombres" value="<?php echo $datos['empleado_nombres']; ?>" required>
                            <input type="hidden" name="empleado_curp" value="<?php echo $datos['empleado_curp']; ?>" required>

                            <div class="form-group">
                                <label for="Vacaciones_Dias_Solicitados">Días solicitados:</label>
                                <input type="text" class="form-control" id="Vacaciones_Dias_Solicitados" name="vacaciones_dias_solicitados"
                                pattern="^\d+$" maxlength="2" required>
                            </div>

                            <div class="form-group">
                                <label for="Vacaciones_Dia_Solicitud">Dia en que se solicita:</label>
                                <input type="text" class="form-control" id="Vacaciones_Dia_Solicitud" name="vacaciones_dia_solicitud"
                                pattern="^(0[1-9]|[12][0-9]|3[01])$" maxlength="2" required>
                            </div>

                            <div class="form-group">
                                <label for="Vacaciones_Mes_Solicitud">Mes en que se solicitan:</label>
                                <select class="form-control" id="Vacaciones_Mes_Solicitud" name="vacaciones_mes_solicitud">
                                    <option value="Enero">Enero</option>
                                    <option value="Febrero">Febrero</option>
                                    <option value="Marzo">Marzo</option>
                                    <option value="Abril">Abril</option>
                                    <option value="Mayo">Mayo</option>
                                    <option value="Junio">Junio</option>
                                    <option value="Julio">Julio</option>
                                    <option value="Agosto">Agosto</option>
                                    <option value="Septiembre">Septiembre</option>
                                    <option value="Octubre">Octubre</option>
                                    <option value="Noviembre">Noviembre</option>
                                    <option value="Diciembre">Diciembre</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Vacaciones_Anio_Solicitud">Año en que se solicitan:</label>
                                <input type="text" class="form-control" id="Vacaciones_Anio_Solicitud" name="vacaciones_anio_solicitud"
                                pattern="^(20[2-9]\d|21[0-9]\d)$" maxlength="4" required>
                            </div>

                            <div class="mt-2">
                                <h5 class="text-left">Periodo:</h5>
                            </div>

                            <div>
                                <div class="row row-cols-2 form-group">
                                    <div class="col">
                                        <input type="text" class="form-control" id="Vacaciones_Periodo_Inicio" name="vacaciones_periodo_inicio" pattern="^(20[2-9]\d|21[0-9]\d)$" maxlength="4" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="Vacaciones_Periodo_Fin" name="vacaciones_periodo_fin" pattern="^(20[2-9]\d|21[0-9]\d)$" maxlength="4" required>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>

                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
<?php
    $check_empleado = null;
?>