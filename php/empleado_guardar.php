<?php
require_once "../inc/session_start.php";
require_once "main.php";

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
$quienLoContrato = limpiar_cadena($_SESSION['usuario_nombre_completo']);

header('Content-Type: application/json');

// Iniciamos la conexión a la base de datos
$conexion = conexion();

// Validación de campos requeridos
if ($nombre == "" || $sexo == "" || $fechaDeNacimiento == "" || $lugarDeNacimiento == "" || $estadoCivil == "" 
    || $domicilio == "" || $telefono == "" || $nombreContactoEmergencia == "" || $parentezco == "" 
    || $telefonoEmergencia == "" || $puestoDeTrabajo == "" || $fechaDeIngreso == "" || $fechaDeTerminoDeContrato == "" 
    || $lugarDeServicio == "" || $numeroDeContrato == "" || $inicioContratoPemex == "" || $finContratoPemex == "" 
    || $salarioDiarioIntegrado == "" || $creditoInfonavit == "" || $curp == "" || $rfc == "" 
    || $nss == "" || $tipoSangre == "" || $alergias == "" || $enfermedades == ""
    || $nombreMadre == "" || $nombrePadre == "" || $estado == "" || $quienLoContrato == "") {
    echo json_encode(['type' => 'error', 'message' => 'No has llenado todos los campos']);
    exit();
}

// Verificación de existencia del empleado
$query = $conexion->prepare("SELECT empleado_curp FROM empleado WHERE empleado_curp = :curp");
$query->execute([':curp' => $curp]);
if ($query->fetch()) {
    echo json_encode(['type' => 'error', 'message' => 'El EMPLEADO ingresado ya se encuentra registrado, por favor elija otro']);
    exit();
}

// Preparación e inserción de datos
try {
    $insertQuery = $conexion->prepare("INSERT INTO empleado (empleado_nombre_completo, empleado_sexo, empleado_fecha_de_nacimiento, empleado_lugar_de_nacimiento, empleado_estado_civil, empleado_domicilio, empleado_telefono, empleado_nombre_de_contacto_para_emergencia, empleado_parentezco_con_el_contacto_de_emergencia, empleado_telefono_de_contacto_para_emergencia, empleado_puesto_de_trabajo, empleado_fecha_de_ingreso, empleado_fecha_de_termino_de_contrato, empleado_lugar_de_servicio_o_de_proyecto, empleado_numero_de_contrato, empleado_inicio_de_contrato_pemex, empleado_fin_de_contrato_pemex, empleado_salario_diario_integrado, empleado_credito_infonavit, empleado_curp, empleado_rfc, empleado_nss, empleado_tipo_de_sangre, empleado_alergias, empleado_enfermedades, empleado_nombre_completo_de_la_madre, empleado_nombre_completo_del_padre, empleado_estado, empleado_quien_lo_contrato)
    VALUES (:nombre, :sexo, :fechaDeNacimiento, :lugarDeNacimiento, :estadoCivil, :domicilio, :telefono, :nombreContactoEmergencia, :parentezco, :telefonoEmergencia, :puestoDeTrabajo, :fechaDeIngreso, :fechaDeTerminoDeContrato, :lugarDeServicio, :numeroDeContrato, :inicioContratoPemex, :finContratoPemex, :salarioDiarioIntegrado, :creditoInfonavit, :curp, :rfc, :nss, :tipoSangre, :alergias, :enfermedades, :nombreMadre, :nombrePadre, :estado, :quienLoContrato)");

    // Vinculación de parámetros
    $insertQuery->execute([
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
        ':quienLoContrato' => $quienLoContrato
    ]);

    if ($insertQuery->rowCount() > 0) {
        echo json_encode(['type' => 'success', 'message' => 'El empleado se registró con éxito', 'redirect' => 'index.php?vista=employee_list']);
    } else {
        echo json_encode(['type' => 'error', 'message' => 'No se pudo registrar el empleado, por favor intente nuevamente']);
    }
} catch (PDOException $e) {
    echo json_encode(['type' => 'error', 'message' => '¡Ocurrió un error inesperado! ' . $e->getMessage()]);
}
?>
