<!-- Este archivo va a tener todo lo necesario para ACTUALIZAR un usuario -->
<?php
    // incluimos solo para poder utilizar una vez el archivo que crea la sesion llamada IV
	require_once "../inc/session_start.php";

    // Incluimos el archivo con las funciones importantes
	require_once "main.php";

    // Almacenamos el id mandado desde el formulario del archivo employee_update.php en el input con name empleado_id
    $id=limpiar_cadena($_POST['empleado_id']);

    /*== Verificando empleado ==*/

    // Abrimos una conexion a la base de datos
	$check_empleado=conexion();
    // Ahora almacenamos el resultado de la consulta select a la base de datos para poder verificar
    // si el usuario realmente existe en la base de datos mediante su id
	$check_empleado=$check_empleado->query("SELECT * FROM empleado WHERE empleado_id='$id'");

    // Verificamos si el empleado realmente existe en la base de datos mediante su id, a ver si la consulta trajo algun registro
    if($check_empleado->rowCount()<=0){
        // Si el empleado NO existe entonces
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El empleado no existe en el sistema
            </div>
        ';
        // Y detenemos la ejecucion del script
        exit();
    }else{
        //Si el usuario SI existe en la base de datos entonces:
        // Almacenamos los campos del registro que encontro dentro de un array con la funcion fetch en la variable datos
    	$datos=$check_empleado->fetch();
    }
    // Cerramos la conexion a la base de datos
    $check_empleado=null;

    /*== Almacenando datos del empleado ==*/

    // Obtención de datos del formulario y limpieza de los mismos
    $nombre = limpiar_cadena($_POST['empleado_nombre_completo']);
    $sexo = limpiar_cadena($_POST['empleado_sexo']);
    $fechaDeNacimiento = limpiar_cadena($_POST['empleado_fecha_de_nacimiento']);
    $lugarDeNacimiento = limpiar_cadena($_POST['empleado_lugar_de_nacimiento']);
    $estadoCivil = limpiar_cadena($_POST['empleado_estado_civil']);
    $domicilio = limpiar_cadena($_POST['empleado_domicilio']);
    $telefono = limpiar_cadena($_POST['empleado_telefono']);
    $nombreContactoEmergencia = limpiar_cadena($_POST['empleado_nombre_de_contacto_para_emergencia']);
    $parentezco = limpiar_cadena($_POST['empleado_parentezco_con_el_contacto_de_emergencia']);
    $telefonoEmergencia = limpiar_cadena($_POST['empleado_telefono_de_contacto_para_emergencia']);
    $puestoDeTrabajo = limpiar_cadena($_POST['empleado_puesto_de_trabajo']);
    $fechaDeIngreso = limpiar_cadena($_POST['empleado_fecha_de_ingreso']);
    $fechaDeTerminoDeContrato = limpiar_cadena($_POST['empleado_fecha_de_termino_de_contrato']);
    $lugarDeServicio = limpiar_cadena($_POST['empleado_lugar_de_servicio_o_de_proyecto']);
    $numeroDeContrato = limpiar_cadena($_POST['empleado_numero_de_contrato']);
    $inicioContratoPemex = limpiar_cadena($_POST['empleado_inicio_de_contrato_pemex']);
    $finContratoPemex = limpiar_cadena($_POST['empleado_fin_de_contrato_pemex']);
    $salarioDiarioIntegrado = limpiar_cadena($_POST['empleado_salario_diario_integrado']);
    $creditoInfonavit = limpiar_cadena($_POST['empleado_credito_infonavit']);
    $curp = limpiar_cadena($_POST['empleado_curp']);
    $rfc = limpiar_cadena($_POST['empleado_rfc']);
    $nss = limpiar_cadena($_POST['empleado_nss']);
    $tipoSangre = limpiar_cadena($_POST['empleado_tipo_de_sangre']);
    $alergias = limpiar_cadena($_POST['empleado_alergias']);
    $enfermedades = limpiar_cadena($_POST['empleado_enfermedades']);
    $nombreMadre = limpiar_cadena($_POST['empleado_nombre_completo_de_la_madre']);
    $nombrePadre = limpiar_cadena($_POST['empleado_nombre_completo_del_padre']);
    $estado = limpiar_cadena($_POST['empleado_estado']);
    $quienLoContrato = limpiar_cadena($_POST['empleado_quien_lo_contrato']);

    /*== Verificando campos obligatorios del empleado para actualizarlo ==*/
    if($nombre == "" || $sexo == "" || $fechaDeNacimiento == "" || $lugarDeNacimiento == "" || $estadoCivil == "" 
    || $domicilio == "" || $telefono == "" || $nombreContactoEmergencia == "" || $parentezco == "" 
    || $telefonoEmergencia == "" || $puestoDeTrabajo == "" || $fechaDeIngreso == "" || $fechaDeTerminoDeContrato == "" 
    || $lugarDeServicio == "" || $numeroDeContrato == "" || $inicioContratoPemex == "" || $finContratoPemex == "" 
    || $salarioDiarioIntegrado == "" || $creditoInfonavit == "" || $curp == "" || $rfc == "" 
    || $nss == "" || $tipoSangre == "" || $alergias == "" || $enfermedades == ""
    || $nombreMadre == "" || $nombrePadre == "" || $estado == "" || $quienLoContrato == ""){
        // Si no se han llenado estos  campos obligatorios entonces:
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    /*== Verificando empleado ==*/
    // Verificamos que el empleado del formulario es el mismo que el que tenemos almacenado en la base de datos
    if($curp!=$datos['empleado_curp']){
        // Abrimos conexion a la base de datos
	    $check_empleado=conexion();
        // Hacemos una consulta select, selecciona empleado_curp de la tabla empleado donde el empleado_curp sea el mismo al que se mando en el formulario
	    $check_empleado=$check_empleado->query("SELECT empleado_curp FROM empleado WHERE empleado_curp='$curp'");
        // Si la consulta select si selecciono un dato, significa que ese empleado SI existe en nuestra base de datos, entonces:
	    if($check_empleado->rowCount()>0){
            // Mandaremos una notificacion diciendo que el empleado ya se encuentra registrado
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El EMPLEADO ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
            // Detenemos la ejecucion del script
	        exit();
	    }
        // Cerrarmos la conexion a la base de datos
	    $check_empleado=null;
    }


    /*== Actualizar datos ==*/

    // Abrimos conexion a la base de datos
    $actualizar_empleado=conexion();
    // Hacemos una consulta para actualizar UPDATE utilizando prepare para mayor seguridad
    // Actualiza de la tabla empleado los campos que se ven en la consulta, (son los campos de la base de datos)
    // DONDE usuario_id sea igual al id del usuario que esta enviando el formulario
    // Poniendoles el valor que almacena cada variable ($nombre, $apellido, $usuario, etc..) usando sus marcadores de posicion del array llamado $marcadores
    $actualizar_empleado=$actualizar_empleado->prepare("UPDATE empleado SET empleado_nombre_completo=:nombre,empleado_sexo=:sexo,empleado_fecha_de_nacimiento=:fechaDeNacimiento,empleado_lugar_de_nacimiento=:lugarDeNacimiento,empleado_estado_civil=:estadoCivil,empleado_domicilio=:domicilio,empleado_telefono=:telefono,empleado_nombre_de_contacto_para_emergencia=:nombreContactoEmergencia,empleado_parentezco_con_el_contacto_de_emergencia=:parentezco,empleado_telefono_de_contacto_para_emergencia=:telefonoEmergencia,empleado_puesto_de_trabajo=:puestoDeTrabajo,empleado_fecha_de_ingreso=:fechaDeIngreso,empleado_fecha_de_termino_de_contrato=:fechaDeTerminoDeContrato,empleado_lugar_de_servicio_o_de_proyecto=:lugarDeServicio,empleado_numero_de_contrato=:numeroDeContrato,empleado_inicio_de_contrato_pemex=:inicioContratoPemex,empleado_fin_de_contrato_pemex=:finContratoPemex,empleado_salario_diario_integrado=:salarioDiarioIntegrado,empleado_credito_infonavit=:creditoInfonavit,empleado_curp=:curp,empleado_rfc=:rfc,empleado_nss=:nss,empleado_tipo_de_sangre=:tipoSangre,empleado_alergias=:alergias,empleado_enfermedades=:enfermedades,empleado_nombre_completo_de_la_madre=:nombreMadre,empleado_nombre_completo_del_padre=:nombrePadre,empleado_estado=:estado,empleado_quien_lo_contrato=:quienLoContrato WHERE empleado_id=:id");

    $marcadores=[
        ':nombre' => $nombre,
        ':sexo' => $sexo,
        ':fechaDeNacimiento' => $fechaDeNacimiento,
        ':lugarDeNacimiento' => $lugarDeNacimiento,
        ':estadoCivil' => $estadoCivil,
        ':domicilio' => $domicilio,
        ':telefono' => $telefono,
        ':nombreContactoEmergencia' => $nombreContactoEmergencia,
        ':parentezco' => $parentezco,
        ':telefonoEmergencia' => $telefonoEmergencia,
        ':puestoDeTrabajo' => $puestoDeTrabajo,
        ':fechaDeIngreso' => $fechaDeIngreso,
        ':fechaDeTerminoDeContrato' => $fechaDeTerminoDeContrato,
        ':lugarDeServicio' => $lugarDeServicio,
        ':numeroDeContrato' => $numeroDeContrato,
        ':inicioContratoPemex' => $inicioContratoPemex,
        ':finContratoPemex' => $finContratoPemex,
        ':salarioDiarioIntegrado' => $salarioDiarioIntegrado,
        ':creditoInfonavit' => $creditoInfonavit,
        ':curp' => $curp,
        ':rfc' => $rfc,
        ':nss' => $nss,
        ':tipoSangre' => $tipoSangre,
        ':alergias' => $alergias,
        ':enfermedades' => $enfermedades,
        ':nombreMadre' => $nombreMadre,
        ':nombrePadre' => $nombrePadre,
        ':estado' => $estado,
        ':quienLoContrato' => $quienLoContrato,
        ':id' => $id
    ];

    // Si el usuario se actualizo con exito entonces:
    if($actualizar_empleado->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>EMPLEADO ACTUALIZADO!</strong><br>
                El empleado se actualizo con exito
            </div>
        ';
    }else{
        // Si no se actualizo con exito entonces:
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el empleado, por favor intente nuevamente
            </div>
        ';
    }
    // Cerramos la conexion a la base de datos
    $actualizar_empleado=null;