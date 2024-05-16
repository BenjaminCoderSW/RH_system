<div class="container mt-5">
    <h3 class="mb-4">Añadir Nuevo Empleado</h3>

    <!-- En este div vamos a mostrar la respuesta que nos devuelva el archivo que va a procesar los datos a treves de AJAX
    osea el archivo ajax.js a treves de la clase form-rest -->
	<div class="form-rest mb-6 mt-6"></div>

    <!-- En el action del formulario colocamos la ruta a la que queremos que se vayan estos datos al enviarlos, y en la clase 
    colocamos FormularioAjax ya que es la clase que tengo en ajax.js -->
    <form action="./php/empleado_guardar.php" method="POST" class="FormularioAjax" autocomplete="off">
      <div class="row">

        <!-- Datos Personales -->
        <div class="col-md-6">

          <h4>Datos Personales</h4>
          <div class="form-group">
            <label for="Empleado_nombre_completo">Nombre Completo:</label>
            <input type="text" class="form-control" id="Empleado_nombre_completo" name="empleado_nombre_completo" 
            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" required>
          </div>

          <div class="form-group">
            <label for="Empleado_sexo">Sexo:</label>
            <select class="form-control" id="Empleado_sexo" name="empleado_sexo">
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
            </select>
          </div>

          <div class="form-group">
            <label for="Empleado_fechaNacimiento">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" id="Empleado_fechaNacimiento" name="empleado_fecha_de_nacimiento " required>
          </div>

          <div class="form-group">
            <label for="lugarNacimiento">Lugar de Nacimiento:</label>
            <input type="text" class="form-control" id="lugarNacimiento" name="lugar_de_nacimiento">
          </div>

          <div class="form-group">
            <label for="estadoCivil">Estado Civil:</label>
            <select class="form-control" id="estadoCivil" name="estado_civil">
              <option>Casado</option>
              <option>Soltero</option>
              <option>Viudo</option>
              <option>Casada</option>
              <option>Soltera</option>
              <option>Viuda</option>
              <option>Unión Libre</option>
            </select>
          </div>

          <div class="form-group">
            <label for="domicilio">Domicilio:</label>
            <input type="text" class="form-control" id="domicilio" name="domicilio" required>
          </div>

        </div>

        <!-- Datos de Contacto y Emergencia -->
        <div class="col-md-6">
            
          <h4>Contacto y Emergencia</h4>

          <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
          </div>

          <div class="form-group">
            <label for="nombreContactoEmergencia">Contacto de Emergencia:</label>
            <input type="text" class="form-control" id="nombreContactoEmergencia" name="nombre_de_contacto_para_emergencia" required>
          </div>

          <div class="form-group">
            <label for="parentezcoContactoEmergencia">Parentezco:</label>
            <input type="text" class="form-control" id="parentezcoContactoEmergencia" name="parentezco_con_el_contacto_de_emergencia" required>
          </div>

          <div class="form-group">
            <label for="telefonoEmergencia">Teléfono de Emergencia:</label>
            <input type="text" class="form-control" id="telefonoEmergencia" name="telefono_de_contacto_para_emergencia" required>
          </div>

        </div>
      </div>

      <div class="row">
        <!-- Datos Laborales -->
        <div class="col-md-6">

          <h4>Datos Laborales</h4>

          <div class="form-group">
            <label for="puestoTrabajo">Puesto de Trabajo:</label>
            <input type="text" class="form-control" id="puestoTrabajo" name="puesto_de_trabajo" required>
          </div>

          <div class="form-group">
            <label for="fechaIngreso">Fecha de Ingreso:</label>
            <input type="date" class="form-control" id="fechaIngreso" name="fecha_de_ingreso" required>
          </div>

          <div class="form-group">
            <label for="fechaTerminoContrato">Fecha de Término de Contrato:</label>
            <input type="date" class="form-control" id="fechaTerminoContrato" name="fecha_de_termino_de_contrato">
          </div>

          <div class="form-group">
            <label for="lugarServicio">Lugar de Servicio:</label>
            <input type="text" class="form-control" id="lugarServicio" name="lugar_de_servicio">
          </div>

          <div class="form-group">
            <label for="lugarProyecto">Lugar de Servicio o Proyecto:</label>
            <input type="text" class="form-control" id="lugarProyecto" name="lugar_de_servicio_o_de_proyecto">
          </div>

          <div class="form-group">
            <label for="numeroContrato">Número de Contrato:</label>
            <input type="text" class="form-control" id="numeroContrato" name="numero_de_contrato">
          </div>

          <div class="form-group">
            <label for="inicioContratoPemex">Inicio de Contrato Pemex:</label>
            <input type="date" class="form-control" id="inicioContratoPemex" name="inicio_de_contrato_pemex">
          </div>

          <div class="form-group">
            <label for="finContratoPemex">Fin de Contrato Pemex:</label>
            <input type="date" class="form-control" id="finContratoPemex" name="fin_de_contrato_pemex">
          </div>

          <div class="form-group">
            <label for="salarioDiarioIntegrado">Salario Diario Integrado:</label>
            <input type="number" step="0.01" class="form-control" id="salarioDiarioIntegrado" name="salario_diario_integrado" required>
          </div>

          <div class="form-group">
            <label for="creditoInfonavit">Crédito Infonavit:</label>
            <input type="checkbox" id="creditoInfonavit" name="credito_infonavit">
          </div>

        </div>
        
        <!-- Datos de Identificación y Salud -->
        <div class="col-md-6">
          <h4>Identificación y Salud</h4>

          <div class="form-group">
            <label for="curp">CURP:</label>
            <input type="text" class="form-control" id="curp" name="curp" required>
          </div>

          <div class="form-group">
            <label for="rfc">RFC:</label>
            <input type="text" class="form-control" id="rfc" name="rfc" required>
          </div>

          <div class="form-group">
            <label for="nss">Número de Seguro Social:</label>
            <input type="text" class="form-control" id="nss" name="numero_de_seguro_social" required>
          </div>

          <div class="form-group">
            <label for="tipoSangre">Tipo de Sangre:</label>
            <input type="text" class="form-control" id="tipoSangre" name="tipo_de_sangre">
          </div>

          <div class="form-group">
            <label for="alergias">Alergias:</label>
            <input type="text" class="form-control" id="alergias" name="alergias">
          </div>

          <div class="form-group">
            <label for="enfermedades">Enfermedades:</label>
            <input type="text" class="form-control" id="enfermedades" name="enfermedades">
          </div>

          <div class="form-group">
            <label for="nombreMadre">Nombre Completo de la Madre:</label>
            <input type="text" class="form-control" id="nombreMadre" name="nombre_completo_de_la_madre">
          </div>

          <div class="form-group">
            <label for="nombrePadre">Nombre Completo del Padre:</label>
            <input type="text" class="form-control" id="nombrePadre" name="nombre_completo_del_padre">
          </div>
          
          <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado">
              <option>Activo</option>
              <option>Inactivo</option>
            </select>
          </div>

        </div>
      </div>

      <button type="submit" class="btn btn-primary btn-md mb-4">Guardar Empleado</button>
    </form>

  </div>
