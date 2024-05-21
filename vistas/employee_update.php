<?php
// Incluimos el archivo de main.php con las funciones
require_once "./php/main.php";

// Si la variable de tipo GET llamada employee_id_up viene definida entonces (?) 
// En caso de que si venga definida vamos a almacenarle el valor de la variable de tipo GET employee_id_up a la variable $id
// En caso de que no venga defindia vamos a colocarle a la variable $id el valor de 0
$id = (isset($_GET['employee_id_up'])) ? $_GET['employee_id_up'] : 0;

// Limpiamos su contenido de inyeccion sql o html
$id = limpiar_cadena($id);
?>

<div class="container mt-5">
    <h3 class="mb-4">Actualizar datos del empleado</h3>

    <?php

      /*== Verificando empleado ==*/
      // Hacemos la conexion a la base de datos almacenada en $check_empleado
      $check_empleado = conexion();
      // Hacemos una consulta select de todo en la tabla usuario donde usuario_id coincida con el id que tenemos almacenado en $id
      $check_empleado = $check_empleado->query("SELECT * FROM empleado WHERE empleado_id='$id'");

      // Si el select anterior selecciono algun registro, eso quiere decir que el id almacenado en $id si existe entonces
      if ($check_empleado->rowCount() > 0) {
        // convertimos los datos que se seleccionaron en un array con fetch y almacenamos ese array en $datos, 
        // solo son datos de UN SOLO REGISTRO, por eso ocupamos fetch y no fetchAll
        $datos = $check_empleado->fetch();
        ?>

        <!-- Aqui vamos a obtener la respuesta del formulario via ajax de abajo, por eso el div vacio tiene la clase form-rest con
        la que trabajamos en el archivo llamado ajax.js -->
	      <div class="form-rest mb-6 mt-6"></div>
        
        <!-- En el action del formulario colocamos la ruta a la que queremos que se vayan estos datos al enviarlos, y en la clase 
        colocamos FormularioAjax ya que es la clase que tengo en ajax.js -->
        <form id="formEmpleado" action="./php/empleado_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off"
        id="formEmpleadoActualizar">
          <div class="row">

            <!-- Datos Personales -->
            <div class="col-md-6">

              <!-- A traves de este input vamos a mandar el id al archivo llamado empleado_actualizar.php -->
              <input type="hidden" name="empleado_id" value="<?php echo $datos['empleado_id']; ?>" required>

              <!-- A traves de este input vamos a mandar quien lo contrato al archivo llamado empleado_actualizar.php -->
              <input type="hidden" name="empleado_quien_lo_contrato" value="<?php echo $datos['empleado_quien_lo_contrato']; ?>" required>

              <h4>Datos Personales</h4>
              <div class="form-group">
                <label for="Empleado_nombre_completo">Nombre Completo:</label>
                <input type="text" class="form-control" id="Empleado_nombre_completo_Update" name="empleado_nombre_completo" 
                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" required value="<?php echo $datos['empleado_nombre_completo']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_sexo">Sexo:</label>
                <select class="form-control" id="Empleado_sexo_Update" name="empleado_sexo">
                <?php 
                  if ($datos['empleado_nombre_completo'] == "Masculino") 
                     { 
                ?>
                  <option value="Masculino">Masculino</option>
                  <option value="Femenino">Femenino</option>
                <?php 
                     } else { 
                ?>
                  <option value="Femenino">Femenino</option>
                  <option value="Masculino">Masculino</option>
                <?php 
                     } 
                ?>
                </select>
              </div>

              <div class="form-group">
                <label for="Empleado_fechaNacimiento">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="Empleado_fechaNacimiento_Update" name="empleado_fecha_de_nacimiento" required
                value="<?php echo $datos['empleado_fecha_de_nacimiento']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_lugar_de_nacimiento">Lugar de Nacimiento:</label>
                <input type="text" class="form-control" id="Empleado_lugar_de_nacimiento_Update" name="empleado_lugar_de_nacimiento"
                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#. ,]{3,255}" maxlength="255" required
                value="<?php echo $datos['empleado_lugar_de_nacimiento']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_estado_civil">Estado Civil:</label>
                <select class="form-control" id="Empleado_estado_civil_Update" name="empleado_estado_civil">
                <?php 
                  if ($datos['empleado_estado_civil'] == "Casado") 
                     {
                ?>
                  <option value="Casado">Casado</option>
                  <option value="Soltero">Soltero</option>
                  <option value="Viudo">Viudo</option>
                  <option value="Union libre">Unión Libre</option>
                <?php 
                     } elseif($datos['empleado_estado_civil'] == "Viudo") { 
                ?>
                  <option value="Viudo">Viudo</option>
                  <option value="Casado">Casado</option>
                  <option value="Soltero">Soltero</option>
                  <option value="Union libre">Unión Libre</option>
                <?php 
                     }  elseif($datos['empleado_estado_civil'] == "Union libre") {
                ?>
                  <option value="Union libre">Unión Libre</option>
                  <option value="Viudo">Viudo</option>
                  <option value="Casado">Casado</option>
                  <option value="Soltero">Soltero</option>
                <?php 
                     } else { 
                ?>
                  <option value="Soltero">Soltero</option>
                  <option value="Viudo">Viudo</option>
                  <option value="Casado">Casado</option>
                  <option value="Union libre">Unión Libre</option>
                <?php 
                     } 
                ?>
                </select>
              </div>

              <div class="form-group">
                <label for="Empleado_domicilio">Domicilio:</label>
                <input type="text" class="form-control" id="Empleado_domicilio_Update" name="empleado_domicilio" 
                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#. ,]{3,255}" maxlength="255" required
                value="<?php echo $datos['empleado_domicilio']; ?>">
              </div>

            </div>

            <!-- Datos de Contacto y Emergencia -->
            <div class="col-md-6">
                
              <h4>Contacto y Emergencia</h4>

              <div class="form-group">
                <label for="Empleado_Telefono">Teléfono:</label>
                <input type="text" class="form-control" id="Empleado_Telefono_Update" name="empleado_telefono" 
                pattern="[\+]?[0-9]{1,4}[-\s]?([0-9]{3,4}[-\s]?)*[0-9]{3,4}" maxlength="15" required
                value="<?php echo $datos['empleado_telefono']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Nombre_de_Contacto_para_emergencia">Nombre del Contacto de Emergencia:</label>
                <input type="text" class="form-control" id="Empleado_Nombre_de_Contacto_para_emergencia_Update"
                name="empleado_nombre_de_contacto_para_emergencia" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" required
                value="<?php echo $datos['empleado_nombre_de_contacto_para_emergencia']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Parentezco_con_el_Contacto_de_emergencia">Parentezco:</label>
                <input type="text" class="form-control" id="Empleado_Parentezco_con_el_Contacto_de_emergencia_Update" 
                name="empleado_parentezco_con_el_contacto_de_emergencia" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required
                value="<?php echo $datos['empleado_parentezco_con_el_contacto_de_emergencia']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Telefono_de_Contacto_para_Emergencia">Teléfono de Emergencia:</label>
                <input type="text" class="form-control" id="Empleado_Telefono_de_Contacto_para_Emergencia_Update" 
                name="empleado_telefono_de_contacto_para_emergencia" pattern="[\+]?[0-9]{1,4}[-\s]?([0-9]{3,4}[-\s]?)*[0-9]{3,4}" maxlength="15" required
                value="<?php echo $datos['empleado_telefono_de_contacto_para_emergencia']; ?>">
              </div>

            </div>
          </div>

          <div class="row">
            <!-- Datos Laborales -->
            <div class="col-md-6">

              <h4>Datos Laborales</h4>

              <div class="form-group">
                <label for="Empleado_Puesto_de_Trabajo">Puesto de Trabajo:</label>
                <input type="text" class="form-control" id="Empleado_Puesto_de_Trabajo_Update" name="empleado_puesto_de_trabajo" 
                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}" maxlength="100" required
                value="<?php echo $datos['empleado_puesto_de_trabajo']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Fecha_de_Ingreso">Fecha de Ingreso:</label>
                <input type="date" class="form-control" id="Empleado_Fecha_de_Ingreso_Update" name="empleado_fecha_de_ingreso" required
                value="<?php echo $datos['empleado_fecha_de_ingreso']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Fecha_de_Termino_de_Contrato">Fecha de Término de Contrato:</label>
                <input type="date" class="form-control" id="Empleado_Fecha_de_Termino_de_Contrato_Update" name="empleado_fecha_de_termino_de_contrato" required
                value="<?php echo $datos['empleado_fecha_de_termino_de_contrato']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Lugar_de_Servicio_o_de_Proyecto">Lugar de Servicio o Proyecto:</label>
                <input type="text" class="form-control" id="Empleado_Lugar_de_Servicio_o_de_Proyecto_Update" 
                name="empleado_lugar_de_servicio_o_de_proyecto" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#. ,]{3,255}" maxlength="255" required
                value="<?php echo $datos['empleado_lugar_de_servicio_o_de_proyecto']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Numero_de_Contrato">Número de Contrato:</label>
                <input type="text" class="form-control" id="Empleado_Numero_de_Contrato_Update" name="empleado_numero_de_contrato"
                pattern="[0-9]+" maxlength="50" required value="<?php echo $datos['empleado_numero_de_contrato']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Inicio_de_Contrato_Pemex">Inicio de Contrato Pemex:</label>
                <input type="date" class="form-control" id="Empleado_Inicio_de_Contrato_Pemex_Update" name="empleado_inicio_de_contrato_pemex" required
                value="<?php echo $datos['empleado_inicio_de_contrato_pemex']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Fin_de_Contrato_Pemex">Fin de Contrato Pemex:</label>
                <input type="date" class="form-control" id="Empleado_Fin_de_Contrato_Pemex_Update" name="empleado_fin_de_contrato_pemex" required
                value="<?php echo $datos['empleado_fin_de_contrato_pemex']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Salario_Diario_Integrado">Salario Diario Integrado:</label>
                <input type="number" step=".01" class="form-control" id="Empleado_Salario_Diario_Integrado_Update" name="empleado_salario_diario_integrado" required
                value="<?php echo $datos['empleado_salario_diario_integrado']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Credito_Infonavit">Crédito Infonavit:</label>
                <select class="form-control" id="Empleado_Credito_Infonavit_Update" name="empleado_credito_infonavit">
                <?php 
                  if ($datos['empleado_credito_infonavit '] == "No") 
                     { 
                ?>
                  <option value="No">No</option>
                  <option value="Si">Si</option>
                <?php 
                     } else { 
                ?>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                <?php 
                     } 
                ?>
                </select>
              </div>

            </div>
            
            <!-- Datos de Identificación y Salud -->
            <div class="col-md-6">
              <h4>Identificación y Salud</h4>

              <div class="form-group">
                <label for="Empleado_Curp">CURP:</label>
                <input type="text" class="form-control" id="Empleado_Curp_Update" name="empleado_curp"
                pattern="^([A-Z]{4}[0-9]{6}[HM]{1}[A-Z]{5}[0-9A-Z]{2})$" maxlength="18" required
                value="<?php echo $datos['empleado_curp']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Rfc">RFC:</label>
                <input type="text" class="form-control" id="Empleado_Rfc_Update" name="empleado_rfc"
                pattern="^([A-ZÑ&]{3,4}[0-9]{6}[A-Z0-9]{3})$" maxlength="13" required
                value="<?php echo $datos['empleado_rfc']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Nss">Número de Seguro Social:</label>
                <input type="text" class="form-control" id="Empleado_Nss_Update" name="empleado_nss" 
                pattern="^(\d{2}[-_ ]?\d{2}[-_ ]?\d{2}[-_ ]?\d{2}[-_ ]?\d{2}[-_ ]?\d{1}|\d{11})$" maxlength="20" required
                value="<?php echo $datos['empleado_nss']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Tipo_de_sangre">Tipo de Sangre:</label>
                <input type="text" class="form-control" id="Empleado_Tipo_de_sangre_Update" name="empleado_tipo_de_sangre"
                pattern="[a-zA-Z+\-]+" maxlength="3" required value="<?php echo $datos['empleado_tipo_de_sangre']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Alergias">Alergias:</label>
                <input type="text" class="form-control" id="Empleado_Alergias_Update" name="empleado_alergias" 
                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" required
                value="<?php echo $datos['empleado_alergias']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Enfermedades">Enfermedades:</label>
                <input type="text" class="form-control" id="Empleado_Enfermedades_Update" name="empleado_enfermedades"
                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" required
                value="<?php echo $datos['empleado_enfermedades']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Nombre_Completo_de_la_Madre">Nombre Completo de la Madre:</label>
                <input type="text" class="form-control" id="Empleado_Nombre_Completo_de_la_Madre_Update" name="empleado_nombre_completo_de_la_madre"
                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" required
                value="<?php echo $datos['empleado_nombre_completo_de_la_madre']; ?>">
              </div>

              <div class="form-group">
                <label for="Empleado_Nombre_Completo_del_Padre">Nombre Completo del Padre:</label>
                <input type="text" class="form-control" id="Empleado_Nombre_Completo_del_Padre_Update" name="empleado_nombre_completo_del_padre"
                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" required
                value="<?php echo $datos['empleado_nombre_completo_del_padre']; ?>">
              </div>
              
              <div class="form-group">
                <label for="Empleado_Estado">Estado:</label>
                <select class="form-control" id="Empleado_Estado_Update" name="empleado_estado">
                <?php 
                  if ($datos['empleado_estado'] == "Activo") 
                     {
                ?>
                  <option value="Activo">Activo</option>
                  <option value="Inactivo">Inactivo</option>
                <?php 
                     } else { 
                ?>
                  <option value="Inactivo">Inactivo</option>
                  <option value="Activo">Activo</option>
                <?php 
                     } 
                ?>
                </select>
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