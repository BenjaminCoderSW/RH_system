<?php
require_once "../inc/session_start.php";
require_once "main.php";
require_once "mailer.php"; // Incluir el archivo mailer.php

$id = limpiar_cadena($_POST['empleado_id']);

/*== Verificando empleado ==*/
$check_empleado = conexion();
$check_empleado = $check_empleado->query("SELECT * FROM empleado WHERE empleado_id='$id'");

if ($check_empleado->rowCount() <= 0) {
    echo json_encode(["status" => "error", "message" => "El empleado no existe en el sistema"]);
    exit();
} else {
    $datos = $check_empleado->fetch();
}
$check_empleado = null;

/*== Almacenando datos del empleado ==*/
$nombres = limpiar_cadena($_POST['empleado_nombres']);
$apellidoPaterno = limpiar_cadena($_POST['empleado_apellido_paterno']);
$apellidoMaterno = limpiar_cadena($_POST['empleado_apellido_materno']);
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
$diaDeIngreso = limpiar_cadena($_POST['empleado_dia_de_ingreso']);
$mesDeIngreso = limpiar_cadena($_POST['empleado_mes_de_ingreso']);
$anioDeIngreso = limpiar_cadena($_POST['empleado_anio_de_ingreso']);
$fechaCompletaDeIngreso = limpiar_cadena($_POST['empleado_fecha_de_ingreso']);
$fechaDeTerminoDeContrato = limpiar_cadena($_POST['empleado_fecha_de_termino_de_contrato']);
$lugarDeServicio = limpiar_cadena($_POST['empleado_lugar_de_servicio_o_de_proyecto']);
$lugaresDeServicioHistorial = limpiar_cadena($_POST['empleado_historial_lugares_de_servicio']);
$numeroDeContrato = limpiar_cadena($_POST['empleado_numero_de_contrato']);
$inicioContratoPemex = limpiar_cadena($_POST['empleado_inicio_de_contrato_pemex']);
$finContratoPemex = limpiar_cadena($_POST['empleado_fin_de_contrato_pemex']);
$salarioDiarioIntegrado = limpiar_cadena($_POST['empleado_salario_diario_integrado']);
$salarioDiarioIntegradoEscrito = limpiar_cadena($_POST['empleado_salario_diario_integrado_escrito']);
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



/*== Verificando empleado ==*/
if ($curp != $datos['empleado_curp']) {
    $check_empleado = conexion();
    $check_empleado = $check_empleado->query("SELECT empleado_curp FROM empleado WHERE empleado_curp='$curp'");
    if ($check_empleado->rowCount() > 0) {
        echo json_encode(["status" => "error", "message" => "El EMPLEADO ingresado ya se encuentra registrado, por favor elija otro"]);
        exit();
    }
    $check_empleado = null;
}

/*== Validar y actualizar la foto si se subió una nueva ==*/
if (isset($_FILES['empleado_foto']) && $_FILES['empleado_foto']['error'] == UPLOAD_ERR_OK) {
    $foto = $_FILES['empleado_foto'];
    $fotoNombre = $foto['name'];
    $fotoTmp = $foto['tmp_name'];
    $fotoTipo = $foto['type'];
    $fotoSize = $foto['size'];

    $extensionesPermitidas = ['image/jpeg', 'image/png', 'image/jpg'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if (!in_array($fotoTipo, $extensionesPermitidas)) {
        echo json_encode(["status" => "error", "message" => "Solo se permiten archivos JPEG, PNG y JPG."]);
        exit();
    }

    if ($fotoSize > $maxSize) {
        echo json_encode(["status" => "error", "message" => "El tamaño del archivo debe ser menor a 2MB."]);
        exit();
    }

    // Crear la carpeta si no existe
    $carpetaFotos = "../img/fotos_empleados/";
    if (!file_exists($carpetaFotos)) {
        mkdir($carpetaFotos, 0777, true);
    }

    // Eliminar la foto antigua
    $fotoAntiguaRuta = $carpetaFotos . $datos['empleado_foto'];
    if (file_exists($fotoAntiguaRuta)) {
        unlink($fotoAntiguaRuta);
    }

    // Generar un nombre único para la foto nueva
    $fotoNombreNuevo = uniqid() . "_" . $fotoNombre;
    $fotoRuta = $carpetaFotos . $fotoNombreNuevo;

    // Mover la foto nueva a la carpeta
    if (!move_uploaded_file($fotoTmp, $fotoRuta)) {
        echo json_encode(["status" => "error", "message" => "No se pudo subir la foto del empleado."]);
        exit();
    }
} else {
    $fotoNombreNuevo = $datos['empleado_foto']; // Mantener la foto antigua si no se subió una nueva
}

/*== Actualizar datos ==*/
$actualizar_empleado = conexion();
$actualizar_empleado = $actualizar_empleado->prepare("UPDATE empleado SET empleado_sexo=:sexo,
empleado_domicilio=:domicilio,
empleado_estado_civil=:estadoCivil,
empleado_curp=:curp,
empleado_rfc=:rfc,
empleado_nss=:nss,
empleado_fecha_de_nacimiento=:fechaDeNacimiento,
empleado_lugar_de_nacimiento=:lugarDeNacimiento,
empleado_telefono=:telefono,
empleado_tipo_de_sangre=:tipoSangre,
empleado_alergias=:alergias,
empleado_enfermedades=:enfermedades,
empleado_nombre_completo_de_la_madre=:nombreMadre,
empleado_nombre_completo_del_padre=:nombrePadre,
empleado_nombre_de_contacto_para_emergencia=:nombreContactoEmergencia,
empleado_parentezco_con_el_contacto_de_emergencia=:parentezco,
empleado_telefono_de_contacto_para_emergencia=:telefonoEmergencia,
empleado_estado=:estado,
empleado_credito_infonavit=:creditoInfonavit,
empleado_salario_diario_integrado=:salarioDiarioIntegrado,
empleado_fecha_de_ingreso=:fechaCompletaDeIngreso,
empleado_fecha_de_termino_de_contrato=:fechaDeTerminoDeContrato,
empleado_puesto_de_trabajo=:puestoDeTrabajo,
empleado_lugar_de_servicio_o_de_proyecto=:lugarDeServicio,
empleado_numero_de_contrato=:numeroDeContrato,
empleado_inicio_de_contrato_pemex=:inicioContratoPemex,
empleado_fin_de_contrato_pemex=:finContratoPemex,
empleado_quien_lo_contrato=:quienLoContrato,
empleado_nombres=:nombre,
empleado_apellido_paterno=:apellidoPaterno,
empleado_apellido_materno=:apellidoMaterno,
empleado_dia_de_ingreso=:diaDeIngreso,
empleado_mes_de_ingreso=:mesDeIngreso,
empleado_año_de_ingreso=:anioDeIngreso,
empleado_salario_diario_integrado_escrito=:salarioDiarioIntegradoEscrito,
empleado_historial_lugares_de_servicio=:lugaresDeServicioHistorial,
empleado_foto=:foto WHERE empleado_id=:id");

$marcadores = [
    ":nombre" => $nombres,
    ":apellidoPaterno" => $apellidoPaterno,
    ":apellidoMaterno" => $apellidoMaterno,
    ":sexo" => $sexo,
    ":fechaDeNacimiento" => $fechaDeNacimiento,
    ":lugarDeNacimiento" => $lugarDeNacimiento,
    ":estadoCivil" => $estadoCivil,
    ":domicilio" => $domicilio,
    ":telefono" => $telefono,
    ":nombreContactoEmergencia" => $nombreContactoEmergencia,
    ":parentezco" => $parentezco,
    ":telefonoEmergencia" => $telefonoEmergencia,
    ":puestoDeTrabajo" => $puestoDeTrabajo,
    ":diaDeIngreso" => $diaDeIngreso,
    ":mesDeIngreso" => $mesDeIngreso,
    ":anioDeIngreso" => $anioDeIngreso,
    ":fechaCompletaDeIngreso" => $fechaCompletaDeIngreso,
    ":fechaDeTerminoDeContrato" => $fechaDeTerminoDeContrato,
    ":lugarDeServicio" => $lugarDeServicio,
    "lugaresDeServicioHistorial" => $lugaresDeServicioHistorial,
    ":numeroDeContrato" => $numeroDeContrato,
    ":inicioContratoPemex" => $inicioContratoPemex,
    ":finContratoPemex" => $finContratoPemex,
    ":salarioDiarioIntegrado" => $salarioDiarioIntegrado,
    ":salarioDiarioIntegradoEscrito" => $salarioDiarioIntegradoEscrito,
    ":creditoInfonavit" => $creditoInfonavit,
    ":curp" => $curp,
    ":rfc" => $rfc,
    ":nss" => $nss,
    ":tipoSangre" => $tipoSangre,
    ":alergias" => $alergias,
    ":enfermedades" => $enfermedades,
    ":nombreMadre" => $nombreMadre,
    ":nombrePadre" => $nombrePadre,
    ":estado" => $estado,
    ":quienLoContrato" => $quienLoContrato,
    ':foto' => $fotoNombreNuevo,
    ':id' => $id
];

if ($actualizar_empleado->execute($marcadores)) {
    // Obtener el correo de notificaciones
    $config = conexion();
    $resultado = $config->query("SELECT correo FROM configuracion LIMIT 1");
    if ($resultado->rowCount() > 0) {
        $correo_destino = $resultado->fetchColumn();
        $asunto = "Empleado actualizado";
        $cuerpo = "Se ha actualizado al empleado: {$nombres} {$apellidoPaterno} {$apellidoMaterno} por {$_SESSION['nombre']}";
        enviar_correo($asunto, $cuerpo, $correo_destino);
    }
    $config = null;

    echo json_encode(["status" => "success", "message" => "Empleado actualizado correctamente"]);
} else {
    echo json_encode(["status" => "error", "message" => "No se pudo actualizar el empleado, por favor intente nuevamente"]);
}
?>
