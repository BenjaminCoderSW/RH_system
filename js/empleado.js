function mostrarDetallesEmpleado(empleadoId) {
    fetch(`./php/obtener_empleado_por_id.php?empleado_id=${empleadoId}`)
      .then(response => response.json())
      .then(data => {
        let detalles = `
          <Strong><p>Sexo:</Strong> ${data.empleado_sexo}</p>
          <Strong><p>Domicilio:</Strong> ${data.empleado_domicilio}</p>
          <Strong><p>Estado Civil:</Strong> ${data.empleado_estado_civil}</p>
          <Strong><p>CURP:</Strong> ${data.empleado_curp}</p>
          <Strong><p>RFC:</Strong> ${data.empleado_rfc}</p>
          <Strong><p>Numero de Seguro Social:</Strong> ${data.empleado_nss}</p>
          <Strong><p>Fecha de Nacimiento:</Strong> ${data.empleado_fecha_de_nacimiento}</p>
          <Strong><p>Lugar de Nacimiento:</Strong> ${data.empleado_lugar_de_nacimiento}</p>
          <Strong><p>Telefono del empleado:</Strong> ${data.empleado_telefono}</p>
          <Strong><p>Tipo de Sangre:</Strong> ${data.empleado_tipo_de_sangre}</p>
          <Strong><p>Alergias:</Strong> ${data.empleado_alergias}</p>
          <Strong><p>Enfermedades:</Strong> ${data.empleado_enfermedades}</p>
          <Strong><p>Nombre de la Madre:</Strong> ${data.empleado_nombre_completo_de_la_madre}</p>
          <Strong><p>Nombre del Padre:</Strong> ${data.empleado_nombre_completo_del_padre}</p>
          <Strong><p>Nombre de Contacto de Emergencia:</Strong> ${data.empleado_nombre_de_contacto_para_emergencia}</p>
          <Strong><p>Parentezco con el empleado:</Strong> ${data.empleado_parentezco_con_el_contacto_de_emergencia}</p>
          <Strong><p>Numero Telefonico de Emergencia:</Strong> ${data.empleado_telefono_de_contacto_para_emergencia}</p>
          <Strong><p>Estado:</Strong> ${data.empleado_estado}</p>
          <Strong><p>Credito Infonavit:</Strong> ${data.empleado_credito_infonavit}</p>
          <Strong><p>Salario Diario Integrado:</Strong> ${data.empleado_salario_diario_integrado}</p>
          <Strong><p>Fecha de ingreso:</Strong> ${data.empleado_fecha_de_ingreso}</p>
          <Strong><p>Fecha de termino de contrato:</Strong> ${data.empleado_fecha_de_termino_de_contrato}</p>
          <Strong><p>Puesto de Trabajo:</Strong> ${data.empleado_puesto_de_trabajo}</p>
          <Strong><p>Lugar de Servicio o de Proyecto:</Strong> ${data.empleado_lugar_de_servicio_o_de_proyecto}</p>
          <Strong><p>Numero de Contrato:</Strong> ${data.empleado_numero_de_contrato}</p>
          <Strong><p>Inicio de Contrato PEMEX:</Strong> ${data.empleado_inicio_de_contrato_pemex}</p>
          <Strong><p>Fin de Contrato PEMEX:</Strong> ${data.empleado_fin_de_contrato_pemex}</p>
          <Strong><p>Contratado por:</Strong> ${data.empleado_quien_lo_contrato}</p>
        `;
        // Actualizamos el contenido del modal
        document.getElementById('detallesEmpleado').innerHTML = detalles;
        // Actualizamos el título del modal con el nombre del empleado
        document.getElementById('nombreEmpleadoModal').textContent = data.empleado_nombre_completo;
        $('#modalDetallesEmpleado').modal('show');
      })
      .catch(error => {
        console.error('Error al obtener los detalles del empleado:', error);
      });
  }
  
  