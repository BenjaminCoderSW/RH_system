<div class="container mt-5">
    <h3 class="mb-4">Añadir Nuevo Empleado</h3>

  <!-- En este div vamos a mostrar la respuesta que nos devuelva el archivo que va a procesar los datos a treves de AJAX
  osea el archivo ajax.js a treves de la clase form-rest -->
	<div class="form-rest mb-6 mt-6"></div>
  
    <!-- En el action del formulario colocamos la ruta a la que queremos que se vayan estos datos al enviarlos, y en la clase 
     colocamos FormularioAjax ya que es la clase que tengo en ajax.js -->
    <form action="./php/empleado_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
      <div class="row">

        <!-- Datos Personales -->
        <div class="col-md-6">

          <h4>Datos Personales</h4>
          <div class="form-group">
            <label for="Empleado_nombres">Nombres:</label>
            <input type="text" class="form-control" id="Empleado_nombres" name="empleado_nombres" 
            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}" maxlength="100" data-toggle="tooltip" title="Solo letras Aa-Zz, mínimo 3 caracteres, máximo 100" required>
          </div>

          <div class="form-group">
            <label for="Empleado_apellido_paterno">Apellido Paterno:</label>
            <input type="text" class="form-control" id="Empleado_apellido_paterno" name="empleado_apellido_paterno"
            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,50}" maxlength="50" data-toggle="tooltip" title="Solo letras Aa-Zz, mínimo 3 caracteres, máximo 50" required>
          </div>

          <div class="form-group">
            <label for="Empleado_apellido_materno">Apellido Materno:</label>
            <input type="text" class="form-control" id="Empleado_apellido_materno" name="empleado_apellido_materno" 
            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,50}" maxlength="50" data-toggle="tooltip" title="Solo letras Aa-Zz, mínimo 3 caracteres, máximo 50" required>
          </div>

          <div class="form-group">
            <label for="Empleado_sexo">Sexo:</label>
            <select class="form-control" id="Empleado_sexo" name="empleado_sexo" data-toggle="tooltip" title="Selecciona el sexo" required>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
            </select>
          </div>

          <div class="form-group">
            <label for="Empleado_fechaNacimiento">Fecha de Nacimiento:</label>
            <input type="text" class="form-control" id="Empleado_fechaNacimiento" name="empleado_fecha_de_nacimiento" 
            pattern="^(0[1-9]|[12][0-9]|3[01]) de (Enero|Febrero|Marzo|Abril|Mayo|Junio|Julio|Agosto|Septiembre|Octubre|Noviembre|Diciembre) de (19[8-9][0-9]|20[0-9]{2}|2[1-9][0-9]{2})$" maxlength="30" data-toggle="tooltip" title="ejemplo: 01 de Enero de 1980" required>
          </div>

          <div class="form-group">
            <label for="Empleado_lugar_de_nacimiento">Lugar de Nacimiento:</label>
            <input type="text" class="form-control" id="Empleado_lugar_de_nacimiento" name="empleado_lugar_de_nacimiento"
            maxlength="255" data-toggle="tooltip" title="Máximo 255 caracteres" required>
          </div>

          <div class="form-group">
            <label for="Empleado_estado_civil">Estado Civil:</label>
            <select class="form-control" id="Empleado_estado_civil" name="empleado_estado_civil" data-toggle="tooltip" title="Selecciona el estado civil" required>
              <option value="Soltero">Soltero</option>
              <option value="Casado">Casado</option>
              <option value="Viudo">Viudo</option>
              <option value="Union libre">Unión Libre</option>
            </select>
          </div>

          <div class="form-group">
            <label for="Empleado_domicilio">Domicilio:</label>
            <input type="text" class="form-control" id="Empleado_domicilio" name="empleado_domicilio" 
            maxlength="255" data-toggle="tooltip" title="Máximo 255 caracteres" required>
          </div>

        </div>

        <!-- Datos de Contacto y Emergencia -->
        <div class="col-md-6">
            
          <h4>Contacto y Emergencia</h4>

          <div class="form-group">
            <label for="Empleado_Telefono">Teléfono del Empleado:</label>
            <input type="text" class="form-control" id="Empleado_Telefono" name="empleado_telefono" 
            pattern="[\+]?[0-9]{1,4}[-\s]?([0-9]{3,4}[-\s]?)*[0-9]{3,4}" maxlength="15" data-toggle="tooltip" title="Formato: 7732456777" required>
          </div>

          <div class="form-group">
            <label for="Empleado_Nombre_de_Contacto_para_emergencia">Nombre del Contacto de Emergencia:</label>
            <input type="text" class="form-control" id="Empleado_Nombre_de_Contacto_para_emergencia"
            name="empleado_nombre_de_contacto_para_emergencia" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" data-toggle="tooltip" title="Solo letras Aa-Zz, mínimo 3 caracteres, máximo 255" required>
          </div>

          <div class="form-group">
            <label for="Empleado_Parentezco_con_el_Contacto_de_emergencia">Parentezco:</label>
            <input type="text" class="form-control" id="Empleado_Parentezco_con_el_Contacto_de_emergencia" 
            name="empleado_parentezco_con_el_contacto_de_emergencia" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" data-toggle="tooltip" title="Solo letras Aa-Zz, mínimo 3 caracteres, máximo 50" required>
          </div>

          <div class="form-group">
            <label for="Empleado_Telefono_de_Contacto_para_Emergencia">Teléfono de Emergencia:</label>
            <input type="text" class="form-control" id="Empleado_Telefono_de_Contacto_para_Emergencia" 
            name="empleado_telefono_de_contacto_para_emergencia" pattern="[\+]?[0-9]{1,4}[-\s]?([0-9]{3,4}[-\s]?)*[0-9]{3,4}" maxlength="15" data-toggle="tooltip" title="Formato: 5578652345" required>
          </div>

          <div class="form-group">
              <label for="Empleado_foto">Foto del Empleado:</label>
              <input type="file" class="form-control" id="Empleado_foto" name="empleado_foto" accept="image/jpeg, image/png, image/jpg" data-toggle="tooltip" title="Formatos permitidos: JPEG, PNG, JPG. Tamaño máximo: 2MB" required>
          </div>

          <div class="form-group">
            <label for="Empleado_domicilio_empresa">Domicilio de la empresa:</label>
            <input type="text" class="form-control" id="Empleado_domicilio_empresa" name="empleado_domicilio_empresa" 
            maxlength="255" data-toggle="tooltip" title="Máximo 255 caracteres" required>
          </div>

        </div>
      </div>

      <div class="row">
        <!-- Datos Laborales -->
        <div class="col-md-6">

          <h4>Datos Laborales</h4>

          <div class="form-group">
            <label for="Empleado_Puesto_de_Trabajo">Puesto de Trabajo:</label>
            <input type="text" class="form-control" id="Empleado_Puesto_de_Trabajo" name="empleado_puesto_de_trabajo" 
            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}" maxlength="100" data-toggle="tooltip" title="Solo letras Aa-Zz, mínimo 3 caracteres, máximo 100" required>
          </div>

          <div class="form-group">
            <label for="Empleado_dia_de_ingreso">Dia de Ingreso:</label>
            <input type="text" class="form-control" id="Empleado_dia_de_ingreso" name="empleado_dia_de_ingreso"
            pattern="^(0[1-9]|[12][0-9]|3[01])$" maxlength="2" data-toggle="tooltip" title="Formato: DD (01-31)" required>
          </div>

          <div class="form-group">
            <label for="Empleado_mes_de_ingreso">Mes de Ingreso:</label>
            <select class="form-control" id="Empleado_mes_de_ingreso" name="empleado_mes_de_ingreso" data-toggle="tooltip" title="Selecciona el mes de ingreso" required>
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
              <label for="Empleado_año_de_ingreso">Año de Ingreso:</label>
              <input type="text" class="form-control" id="Empleado_año_de_ingreso" name="empleado_anio_de_ingreso"
              pattern="^(19[8-9][0-9]|20[0-9]{2}|2[1-9][0-9]{2})$" maxlength="4" data-toggle="tooltip" title="Formato: AAAA (1980 en adelante)" required>
          </div>

          <div class="form-group">
              <label for="Empleado_año_de_ingreso">Fecha Completa en que Ingreso el Empleado:</label>
              <input type="text" class="form-control" id="Empleado_Fecha_De_Ingreso" name="empleado_fecha_de_ingreso" 
              pattern="^(0[1-9]|[12][0-9]|3[01]) de (Enero|Febrero|Marzo|Abril|Mayo|Junio|Julio|Agosto|Septiembre|Octubre|Noviembre|Diciembre) de (19[8-9][0-9]|20[0-9]{2}|2[1-9][0-9]{2})$" maxlength="30" data-toggle="tooltip" title="ejemplo: 01 de Enero de 1980" required>
          </div>

          <div class="form-group">
            <label for="Empleado_Fecha_de_Termino_de_Contrato">Fecha de Término de Contrato:</label>
            <input type="text" class="form-control" id="Empleado_Fecha_de_Termino_de_Contrato" name="empleado_fecha_de_termino_de_contrato" maxlength="50" data-toggle="tooltip" title="Numeros o la fecha DD/MM/AAAA, maximo 50 caracteres">
          </div>

          <div class="form-group">
            <label for="Empleado_Lugar_de_Servicio_o_de_Proyecto">Lugar de Servicio o Proyecto:</label>
            <input type="text" class="form-control" id="Empleado_Lugar_de_Servicio_o_de_Proyecto"
            name="empleado_lugar_de_servicio_o_de_proyecto" maxlength="255" data-toggle="tooltip" title="Máximo 255 caracteres" required>
          </div>

          <div class="form-group">
              <label for="Empleado_Numero_de_Contrato">Número de Contrato:</label>
              <input type="text" class="form-control" id="Empleado_Numero_de_Contrato" name="empleado_numero_de_contrato"
              pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s]+" maxlength="100" data-toggle="tooltip" title="Letras, números, espacios y acentos permitidos, maximo 100 caracteres" required>
          </div>

          <div class="form-group">
            <label for="Empleado_Inicio_de_Contrato_Pemex">Inicio de Contrato Pemex:</label>
            <input type="text" class="form-control" id="Empleado_Inicio_de_Contrato_Pemex" name="empleado_inicio_de_contrato_pemex" maxlength="50" data-toggle="tooltip" title="Numeros o la fecha ejemplo: 01 de Enero de 1980, maximo 50 caracteres">
          </div>

          <div class="form-group">
            <label for="Empleado_Fin_de_Contrato_Pemex">Fin de Contrato Pemex:</label>
            <input type="text" class="form-control" id="Empleado_Fin_de_Contrato_Pemex" name="empleado_fin_de_contrato_pemex" maxlength="50" data-toggle="tooltip" title="Numeros o la fecha ejemplo: 01 de Enero de 1980, maximo 50 caracteres">
          </div>

          <div class="form-group">
            <label for="Empleado_Salario_Diario_Integrado">Salario Diario Integrado:</label>
            <input type="text" class="form-control" id="Empleado_Salario_Diario_Integrado" name="empleado_salario_diario_integrado"
            pattern="^-?\d{1,8}(\.\d{2})?$" maxlength="11" data-toggle="tooltip" title="Formato: 1234.56" required>
          </div>

          <div class="form-group">
              <label for="Empleado_Salario_Diario_integrado_escrito">Salario Diario Integrado en letra:</label>
              <input type="text" class="form-control" id="Empleado_Salario_Diario_integrado_escrito" name="empleado_salario_diario_integrado_escrito" 
              pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s/.]{3,255}" maxlength="255" data-toggle="tooltip" title="Letras, números, diagonales (/) y puntos (.), mínimo 3 caracteres, máximo 255" required>
          </div>

          <div class="form-group">
            <label for="Empleado_Credito_Infonavit">Crédito Infonavit:</label>
            <select class="form-control" id="Empleado_Credito_Infonavit" name="empleado_credito_infonavit" data-toggle="tooltip" title="Selecciona la entre si o no" required>
              <option value="No">No</option>
              <option value="Si">Si</option>
            </select>
          </div>

        </div>
        
        <!-- Datos de Identificación y Salud -->
        <div class="col-md-6">
          <h4>Identificación y Salud</h4>

          <div class="form-group">
            <label for="Empleado_Curp">CURP:</label>
            <input type="text" class="form-control" id="Empleado_Curp" name="empleado_curp"
            pattern="^([A-Z]{4}[0-9]{6}[HM]{1}[A-Z]{5}[0-9A-Z]{2})$" maxlength="18" data-toggle="tooltip" title="Formato: 18 caracteres, ejemplo: ABCD123456HDFGRT12" required>
          </div>

          <div class="form-group">
            <label for="Empleado_Rfc">RFC:</label>
            <input type="text" class="form-control" id="Empleado_Rfc" name="empleado_rfc"
            pattern="^([A-ZÑ&]{3,4}[0-9]{6}[A-Z0-9]{3})$" maxlength="13" data-toggle="tooltip" title="Formato: 13 caracteres, ejemplo: ABCD123456ABC" required>
          </div>

          <div class="form-group">
            <label for="Empleado_Nss">Número de Seguro Social:</label>
            <input type="text" class="form-control" id="Empleado_Nss" name="empleado_nss" 
            pattern="\d{2} \d{2} \d{2} \d{2} \d{2} \d{1}" maxlength="16" data-toggle="tooltip" title="Formato: 11 dígitos con espacios, ejemplo: 22 22 22 22 22 2" required>
          </div>

          <div class="form-group">
            <label for="Empleado_Tipo_de_sangre">Tipo de Sangre:</label>
            <input type="text" class="form-control" id="Empleado_Tipo_de_sangre" name="empleado_tipo_de_sangre"
            pattern="[a-zA-Z+\-]+" maxlength="3" data-toggle="tooltip" title="Formato: letras y signos (+, -), máximo 3 caracteres" required>
          </div>

          <div class="form-group">
            <label for="Empleado_Alergias">Alergias:</label>
            <input type="text" class="form-control" id="Empleado_Alergias" name="empleado_alergias" 
            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" data-toggle="tooltip" title="Solo letras Aa-Zz, mínimo 3 caracteres, máximo 255" required>
          </div>

          <div class="form-group">
            <label for="Empleado_Enfermedades">Enfermedades:</label>
            <input type="text" class="form-control" id="Empleado_Enfermedades" name="empleado_enfermedades"
            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" data-toggle="tooltip" title="Solo letras Aa-Zz, mínimo 3 caracteres, máximo 255" required>
          </div>

          <div class="form-group">
            <label for="Empleado_Nombre_Completo_de_la_Madre">Nombre Completo de la Madre:</label>
            <input type="text" class="form-control" id="Empleado_Nombre_Completo_de_la_Madre" name="empleado_nombre_completo_de_la_madre"
            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" data-toggle="tooltip" title="Solo letras Aa-Zz, mínimo 3 caracteres, máximo 255" required>
          </div>

          <div class="form-group">
            <label for="Empleado_Nombre_Completo_del_Padre">Nombre Completo del Padre:</label>
            <input type="text" class="form-control" id="Empleado_Nombre_Completo_del_Padre" name="empleado_nombre_completo_del_padre"
            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" data-toggle="tooltip" title="Solo letras Aa-Zz, mínimo 3 caracteres, máximo 255" required>
          </div>
          
          <div class="form-group">
            <label for="Empleado_Estado">Estado:</label>
            <select class="form-control" id="Empleado_Estado" name="empleado_estado" data-toggle="tooltip" title="Selecciona el estado" required>
              <option value="Activo">Activo</option>
              <option value="Inactivo">Inactivo</option>
            </select>
          </div>

        </div>
      </div>

      <button type="submit" class="btn btn-primary btn-md mb-4">Guardar Empleado</button>
    </form>

  </div>
