<?php
require_once "./php/main.php";

$id = isset($_GET['employee_id_up']) ? limpiar_cadena($_GET['employee_id_up']) : 0;
?>

<div class="container mt-5">
    <h3 class="mb-4">Actualizar datos del empleado</h3>

    <?php
    $check_empleado = conexion();
    $check_empleado = $check_empleado->query("SELECT * FROM empleado WHERE empleado_id='$id'");

    if ($check_empleado->rowCount() > 0) {
        $datos = $check_empleado->fetch();
        ?>

        <div class="form-rest mb-6 mt-6"></div>
        
        <form id="formEmpleado" action="./php/empleado_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">
            <div class="row">
                <div class="col-md-6">

                    <input type="hidden" name="empleado_id" value="<?php echo $datos['empleado_id']; ?>" required>
                    <input type="hidden" name="empleado_quien_lo_contrato" value="<?php echo $datos['empleado_quien_lo_contrato']; ?>" required>
                    <h4>Datos Personales</h4>

                    <div class="form-group">
                        <label for="Empleado_nombre_completo">Nombres:</label>
                        <input type="text" class="form-control" id="Empleado_nombre_completo_Update" name="empleado_nombres" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}" maxlength="100" required value="<?php echo $datos['empleado_nombres']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_apellido_paterno_Update">Apellido Paterno:</label>
                        <input type="text" class="form-control" id="Empleado_apellido_paterno_Update" name="empleado_apellido_paterno" 
                        pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,50}" maxlength="50" required value="<?php echo $datos['empleado_apellido_paterno']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_apellido_materno_Update">Apellido Materno:</label>
                        <input type="text" class="form-control" id="Empleado_apellido_materno_Update" name="empleado_apellido_materno" 
                        pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,50}" maxlength="50" required value="<?php echo $datos['empleado_apellido_materno']; ?>">
                    </div>


                    <div class="form-group">
                        <label for="Empleado_sexo_Update">Sexo:</label>
                        <select class="form-control" id="Empleado_sexo_Update" name="empleado_sexo">
                            <option value="Masculino" <?php if ($datos['empleado_sexo'] == "Masculino") echo 'selected'; ?>>Masculino</option>
                            <option value="Femenino" <?php if ($datos['empleado_sexo'] == "Femenino") echo 'selected'; ?>>Femenino</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Empleado_fechaNacimiento_Update">Fecha de Nacimiento:</label>
                        <input type="date" class="form-control" id="Empleado_fechaNacimiento_Update" name="empleado_fecha_de_nacimiento" required value="<?php echo $datos['empleado_fecha_de_nacimiento']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_lugar_de_nacimiento_Update">Lugar de Nacimiento:</label>
                        <input type="text" class="form-control" id="Empleado_lugar_de_nacimiento_Update" name="empleado_lugar_de_nacimiento" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#. ,]{3,255}" maxlength="255" required value="<?php echo $datos['empleado_lugar_de_nacimiento']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_estado_civil_Update">Estado Civil:</label>
                        <select class="form-control" id="Empleado_estado_civil_Update" name="empleado_estado_civil">
                            <option value="Casado" <?php if ($datos['empleado_estado_civil'] == "Casado") echo 'selected'; ?>>Casado</option>
                            <option value="Soltero" <?php if ($datos['empleado_estado_civil'] == "Soltero") echo 'selected'; ?>>Soltero</option>
                            <option value="Viudo" <?php if ($datos['empleado_estado_civil'] == "Viudo") echo 'selected'; ?>>Viudo</option>
                            <option value="Union libre" <?php if ($datos['empleado_estado_civil'] == "Union libre") echo 'selected'; ?>>Unión Libre</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Empleado_domicilio_Update">Domicilio:</label>
                        <input type="text" class="form-control" id="Empleado_domicilio_Update" name="empleado_domicilio" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#. ,]{3,255}" maxlength="255" required value="<?php echo $datos['empleado_domicilio']; ?>">
                    </div>

                </div>

                <div class="col-md-6">
                    <h4>Contacto y Emergencia</h4>

                    <div class="form-group">
                        <label for="Empleado_Telefono_Update">Teléfono:</label>
                        <input type="text" class="form-control" id="Empleado_Telefono_Update" name="empleado_telefono" pattern="[\+]?[0-9]{1,4}[-\s]?([0-9]{3,4}[-\s]?)*[0-9]{3,4}" maxlength="15" required value="<?php echo $datos['empleado_telefono']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Nombre_de_Contacto_para_emergencia_Update">Nombre del Contacto de Emergencia:</label>
                        <input type="text" class="form-control" id="Empleado_Nombre_de_Contacto_para_emergencia_Update" name="empleado_nombre_de_contacto_para_emergencia" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" required value="<?php echo $datos['empleado_nombre_de_contacto_para_emergencia']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Parentezco_con_el_Contacto_de_emergencia_Update">Parentezco:</label>
                        <input type="text" class="form-control" id="Empleado_Parentezco_con_el_Contacto_de_emergencia_Update" name="empleado_parentezco_con_el_contacto_de_emergencia" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required value="<?php echo $datos['empleado_parentezco_con_el_contacto_de_emergencia']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Telefono_de_Contacto_para_Emergencia_Update">Teléfono de Emergencia:</label>
                        <input type="text" class="form-control" id="Empleado_Telefono_de_Contacto_para_Emergencia_Update" name="empleado_telefono_de_contacto_para_emergencia" pattern="[\+]?[0-9]{1,4}[-\s]?([0-9]{3,4}[-\s]?)*[0-9]{3,4}" maxlength="15" required value="<?php echo $datos['empleado_telefono_de_contacto_para_emergencia']; ?>">
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h4>Datos Laborales</h4>

                    <div class="form-group">
                        <label for="Empleado_Puesto_de_Trabajo_Update">Puesto de Trabajo:</label>
                        <input type="text" class="form-control" id="Empleado_Puesto_de_Trabajo_Update" name="empleado_puesto_de_trabajo" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}" maxlength="100" required value="<?php echo $datos['empleado_puesto_de_trabajo']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_dia_de_ingreso_Update">Dia de Ingreso:</label>
                        <input type="text" class="form-control" id="Empleado_dia_de_ingreso_Update" name="empleado_dia_de_ingreso"
                        pattern="^(0[1-9]|[12][0-9]|3[01])$" maxlength="2" required value="<?php echo $datos['empleado_dia_de_ingreso']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_mes_de_ingreso_Update">Mes de Ingreso:</label>
                        <select class="form-control" id="Empleado_mes_de_ingreso_Update" name="empleado_mes_de_ingreso">
                            <option value="Enero" <?php if ($datos['empleado_mes_de_ingreso'] == "Enero") echo 'selected'; ?>>Enero</option>
                            <option value="Febrero" <?php if ($datos['empleado_mes_de_ingreso'] == "Febrero") echo 'selected'; ?>>Febrero</option>
                            <option value="Marzo" <?php if ($datos['empleado_mes_de_ingreso'] == "Marzo") echo 'selected'; ?>>Marzo</option>
                            <option value="Abril" <?php if ($datos['empleado_mes_de_ingreso'] == "Abril") echo 'selected'; ?>>Abril</option>
                            <option value="Mayo" <?php if ($datos['empleado_mes_de_ingreso'] == "Mayo") echo 'selected'; ?>>Mayo</option>
                            <option value="Junio" <?php if ($datos['empleado_mes_de_ingreso'] == "Junio") echo 'selected'; ?>>Junio</option>
                            <option value="Julio" <?php if ($datos['empleado_mes_de_ingreso'] == "Julio") echo 'selected'; ?>>Julio</option>
                            <option value="Agosto" <?php if ($datos['empleado_mes_de_ingreso'] == "Agosto") echo 'selected'; ?>>Agosto</option>
                            <option value="Septiembre" <?php if ($datos['empleado_mes_de_ingreso'] == "Septiembre") echo 'selected'; ?>>Septiembre</option>
                            <option value="Octubre" <?php if ($datos['empleado_mes_de_ingreso'] == "Octubre") echo 'selected'; ?>>Octubre</option>
                            <option value="Noviembre" <?php if ($datos['empleado_mes_de_ingreso'] == "Noviembre") echo 'selected'; ?>>Noviembre</option>
                            <option value="Diciembre" <?php if ($datos['empleado_mes_de_ingreso'] == "Diciembre") echo 'selected'; ?>>Diciembre</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Empleado_año_de_ingreso_Update">Año de Ingreso:</label>
                        <input type="text" class="form-control" id="Empleado_año_de_ingreso_Update" name="empleado_anio_de_ingreso" 
                        pattern="^(20[2-9]\d|21[0-9]\d)$" maxlength="4" required value="<?php echo $datos['empleado_año_de_ingreso']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Fecha_de_Termino_de_Contrato">Fecha de Término de Contrato:</label>
                        <input type="date" class="form-control" id="Empleado_Fecha_de_Termino_de_Contrato_Update" name="empleado_fecha_de_termino_de_contrato" required value="<?php echo $datos['empleado_fecha_de_termino_de_contrato']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Lugar_de_Servicio_o_de_Proyecto">Lugar de Servicio o Proyecto:</label>
                        <input type="text" class="form-control" id="Empleado_Lugar_de_Servicio_o_de_Proyecto_Update" name="empleado_lugar_de_servicio_o_de_proyecto" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#. ,]{3,255}" maxlength="255" required value="<?php echo $datos['empleado_lugar_de_servicio_o_de_proyecto']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Numero_de_Contrato">Número de Contrato:</label>
                        <input type="text" class="form-control" id="Empleado_Numero_de_Contrato_Update" name="empleado_numero_de_contrato" pattern="[0-9]+" maxlength="50" required value="<?php echo $datos['empleado_numero_de_contrato']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Inicio_de_Contrato_Pemex">Inicio de Contrato Pemex:</label>
                        <input type="date" class="form-control" id="Empleado_Inicio_de_Contrato_Pemex_Update" name="empleado_inicio_de_contrato_pemex" required value="<?php echo $datos['empleado_inicio_de_contrato_pemex']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Fin_de_Contrato_Pemex">Fin de Contrato Pemex:</label>
                        <input type="date" class="form-control" id="Empleado_Fin_de_Contrato_Pemex_Update" name="empleado_fin_de_contrato_pemex" required value="<?php echo $datos['empleado_fin_de_contrato_pemex']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Salario_Diario_Integrado_Update">Salario Diario Integrado:</label>
                        <input type="text" class="form-control" id="Empleado_Salario_Diario_Integrado_Update" name="empleado_salario_diario_integrado"
                        pattern="^-?\d{1,8}(\.\d{2})?$" maxlength="11" required value="<?php echo $datos['empleado_salario_diario_integrado']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Salario_Diario_integrado_escrito_Update">Salario Diario Integrado en letra:</label>
                        <input type="text" class="form-control" id="Empleado_Salario_Diario_integrado_escrito_Update" name="empleado_salario_diario_integrado_escrito"
                        pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" required value="<?php echo $datos['empleado_salario_diario_integrado_escrito']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Credito_Infonavit">Crédito Infonavit:</label>
                        <select class="form-control" id="Empleado_Credito_Infonavit_Update" name="empleado_credito_infonavit">
                            <option value="No" <?php if ($datos['empleado_credito_infonavit'] == "No") echo 'selected'; ?>>No</option>
                            <option value="Si" <?php if ($datos['empleado_credito_infonavit'] == "Si") echo 'selected'; ?>>Si</option>
                        </select>
                    </div>

                </div>

                <div class="col-md-6">
                    <h4>Identificación y Salud</h4>

                    <div class="form-group">
                        <label for="Empleado_Curp">CURP:</label>
                        <input type="text" class="form-control" id="Empleado_Curp_Update" name="empleado_curp" pattern="^([A-Z]{4}[0-9]{6}[HM]{1}[A-Z]{5}[0-9A-Z]{2})$" maxlength="18" required value="<?php echo $datos['empleado_curp']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Rfc">RFC:</label>
                        <input type="text" class="form-control" id="Empleado_Rfc_Update" name="empleado_rfc" pattern="^([A-ZÑ&]{3,4}[0-9]{6}[A-Z0-9]{3})$" maxlength="13" required value="<?php echo $datos['empleado_rfc']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Nss">Número de Seguro Social:</label>
                        <input type="text" class="form-control" id="Empleado_Nss_Update" name="empleado_nss" pattern="^(\d{2}[-_ ]?\d{2}[-_ ]?\d{2}[-_ ]?\d{2}[-_ ]?\d{2}[-_ ]?\d{1}|\d{11})$" maxlength="20" required value="<?php echo $datos['empleado_nss']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Tipo_de_sangre">Tipo de Sangre:</label>
                        <input type="text" class="form-control" id="Empleado_Tipo_de_sangre_Update" name="empleado_tipo_de_sangre" pattern="[a-zA-Z+\-]+" maxlength="3" required value="<?php echo $datos['empleado_tipo_de_sangre']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Alergias">Alergias:</label>
                        <input type="text" class="form-control" id="Empleado_Alergias_Update" name="empleado_alergias" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" required value="<?php echo $datos['empleado_alergias']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Enfermedades">Enfermedades:</label>
                        <input type="text" class="form-control" id="Empleado_Enfermedades_Update" name="empleado_enfermedades" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" required value="<?php echo $datos['empleado_enfermedades']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Nombre_Completo_de_la_Madre">Nombre Completo de la Madre:</label>
                        <input type="text" class="form-control" id="Empleado_Nombre_Completo_de_la_Madre_Update" name="empleado_nombre_completo_de_la_madre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" required value="<?php echo $datos['empleado_nombre_completo_de_la_madre']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Nombre_Completo_del_Padre">Nombre Completo del Padre:</label>
                        <input type="text" class="form-control" id="Empleado_Nombre_Completo_del_Padre_Update" name="empleado_nombre_completo_del_padre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" required value="<?php echo $datos['empleado_nombre_completo_del_padre']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Estado">Estado:</label>
                        <select class="form-control" id="Empleado_Estado_Update" name="empleado_estado">
                            <option value="Activo" <?php if ($datos['empleado_estado'] == "Activo") echo 'selected'; ?>>Activo</option>
                            <option value="Inactivo" <?php if ($datos['empleado_estado'] == "Inactivo") echo 'selected'; ?>>Inactivo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Empleado_Historial_Lugares_De_Servicio_Update">Historial de Lugares de Servicio:</label>
                        <textarea class="form-control" id="Empleado_Historial_Lugares_De_Servicio_Update" name="empleado_historial_lugares_de_servicio" rows="9" maxlength="65535" required><?php echo $datos['empleado_historial_lugares_de_servicio']; ?></textarea>
                    </div>


                </div>
            </div>

            <?php include "./inc/btn_back.php"; ?>
            <button type="submit" id="btnGuardarEmpleado_Update" class="btn btn-primary btn-md m-3">Actualizar Empleado</button>
        </form>
    <?php
    } else {
        include "./inc/error_alert.php";
    }
    $check_empleado = null;
    ?>
</div>

<script>
document.getElementById('formEmpleado').addEventListener('submit', function(event) {
    event.preventDefault();

    var form = event.target;
    var formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: '¡Operación exitosa!',
                text: data.message,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php?vista=employee_list&page=1';
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: '¡Ocurrió un error!',
                text: data.message
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: '¡Ocurrió un error!',
            text: 'No se pudo completar la operación. Intente de nuevo.'
        });
    });
});
</script>
