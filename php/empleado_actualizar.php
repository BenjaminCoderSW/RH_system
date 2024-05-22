<?php
require_once "../inc/session_start.php";
require_once "main.php";

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
if ($nombre == "" || $sexo == "" || $fechaDeNacimiento == "" || $lugarDeNacimiento == "" || $estadoCivil == "" 
    || $domicilio == "" || $telefono == "" || $nombreContactoEmergencia == "" || $parentezco == "" 
    || $telefonoEmergencia == "" || $puestoDeTrabajo == "" || $fechaDeIngreso == "" || $fechaDeTerminoDeContrato == "" 
    || $lugarDeServicio == "" || $numeroDeContrato == "" || $inicioContratoPemex == "" || $finContratoPemex == "" 
    || $salarioDiarioIntegrado == "" || $creditoInfonavit == "" || $curp == "" || $rfc == "" 
    || $nss == "" || $tipoSangre == "" || $alergias == "" || $enfermedades == ""
    || $nombreMadre == "" || $nombrePadre == "" || $estado == "" || $quienLoContrato == "") {
    echo json_encode(["status" => "error", "message" => "No has llenado todos los campos que son obligatorios"]);
    exit();
}

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

/*== Actualizar datos ==*/
$actualizar_empleado = conexion();
$actualizar_empleado = $actualizar_empleado->prepare("UPDATE empleado SET empleado_nombre_completo=:nombre,empleado_sexo=:sexo,empleado_fecha_de_nacimiento=:fechaDeNacimiento,empleado_lugar_de_nacimiento=:lugarDeNacimiento,empleado_estado_civil=:estadoCivil,empleado_domicilio=:domicilio,empleado_telefono=:telefono,empleado_nombre_de_contacto_para_emergencia=:nombreContactoEmergencia,empleado_parentezco_con_el_contacto_de_emergencia=:parentezco,empleado_telefono_de_contacto_para_emergencia=:telefonoEmergencia,empleado_puesto_de_trabajo=:puestoDeTrabajo,empleado_fecha_de_ingreso=:fechaDeIngreso,empleado_fecha_de_termino_de_contrato=:fechaDeTerminoDeContrato,empleado_lugar_de_servicio_o_de_proyecto=:lugarDeServicio,empleado_numero_de_contrato=:numeroDeContrato,empleado_inicio_de_contrato_pemex=:inicioContratoPemex,empleado_fin_de_contrato_pemex=:finContratoPemex,empleado_salario_diario_integrado=:salarioDiarioIntegrado,empleado_credito_infonavit=:creditoInfonavit,empleado_curp=:curp,empleado_rfc=:rfc,empleado_nss=:nss,empleado_tipo_de_sangre=:tipoSangre,empleado_alergias=:alergias,empleado_enfermedades=:enfermedades,empleado_nombre_completo_de_la_madre=:nombreMadre,empleado_nombre_completo_del_padre=:nombrePadre,empleado_estado=:estado,empleado_quien_lo_contrato=:quienLoContrato WHERE empleado_id=:id");

$marcadores = [
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

if ($actualizar_empleado->execute($marcadores)) {
    echo json_encode(["status" => "success", "message" => "Empleado actualizado correctamente"]);
} else {
    echo json_encode(["status" => "error", "message" => "No se pudo actualizar el empleado, por favor intente nuevamente"]);
}

$actualizar_empleado = null;
?>
