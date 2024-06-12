<?php
// Añadimos el archivo de inicio de sesion para ver quien contrato al empleado con la variable de sesion
require_once "../inc/session_start.php";

require_once "main.php";
require_once "mailer.php"; // Incluir el archivo mailer.php

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
$fechaDeTerminoDeContrato = limpiar_cadena($_POST['empleado_fecha_de_termino_de_contrato']);
$lugarDeServicio = limpiar_cadena($_POST['empleado_lugar_de_servicio_o_de_proyecto']);
$lugaresDeServicioHistorial = $lugarDeServicio;
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
$quienLoContrato = limpiar_cadena($_SESSION['nombre']);

if ($nombres == "" || $apellidoPaterno == "" || $apellidoMaterno == "" || $sexo == "" || $fechaDeNacimiento == "" || $lugarDeNacimiento == "" || $estadoCivil == "" 
|| $domicilio == "" || $telefono == "" || $nombreContactoEmergencia == "" || $parentezco == "" 
|| $telefonoEmergencia == "" || $puestoDeTrabajo == "" || $diaDeIngreso == "" || $mesDeIngreso == "" || $anioDeIngreso == "" || $fechaDeTerminoDeContrato == "" 
|| $lugarDeServicio == "" || $numeroDeContrato == "" || $inicioContratoPemex == "" || $finContratoPemex == "" 
|| $salarioDiarioIntegrado == "" || $salarioDiarioIntegradoEscrito == "" || $creditoInfonavit == "" || $curp == "" || $rfc == "" 
|| $nss == "" || $tipoSangre == "" || $alergias == "" || $enfermedades == ""
|| $nombreMadre == "" || $nombrePadre == "" || $estado == "" || $quienLoContrato == "") {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos
            </div>
        ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}", $nombres)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,50}", $apellidoPaterno)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El APELLIDO PATERNO no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,50}", $apellidoMaterno)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El APELLIDO MATERNO no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}", $nombreContactoEmergencia)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE DEL CONTACTO DE EMERGENCIA no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}", $parentezco)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El PARENTEZCO no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}", $puestoDeTrabajo)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El PUESTO DE TRABAJO no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("^(0[1-9]|[12][0-9]|3[01])$", $diaDeIngreso)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El DIA DE INGRESO no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("^(20[2-9]\d|21[0-9]\d)$", $anioDeIngreso)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El AÑO DE INGRESO no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("[0-9]+", $numeroDeContrato)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NUMERO DE CONTRATO no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("^-?\d{1,8}(\.\d{2})?$", $salarioDiarioIntegrado)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El SALARIO CON LETRA no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

// shidgha
if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}", $salarioDiarioIntegradoEscrito)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El SALARIO CON LETRA no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("^([A-Z]{4}[0-9]{6}[HM]{1}[A-Z]{5}[0-9A-Z]{2})$", $curp)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El CURP no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("^([A-ZÑ&]{3,4}[0-9]{6}[A-Z0-9]{3})$", $rfc)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El RFC no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("\d{2} \d{2} \d{2} \d{2} \d{2} \d{1}", $nss)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NSS no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}", $alergias)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El campo de ALERGIAS no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}", $enfermedades)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El campo de ENFERMEDADES no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}", $nombreMadre)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE DE LA MADRE no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}", $nombrePadre)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE DEL PADRE no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

// ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo

$check_empleado = conexion();
$check_empleado = $check_empleado->query("SELECT empleado_curp FROM empleado WHERE empleado_curp = '$curp'");
// Revisamos si el empleado ya esta registrado en nuestra base de datos
if ($check_empleado->rowCount() > 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El EMPLEADO ingresado ya se encuentra registrado, por
            favor elija otro
        </div>
    ';
    exit();
}
$check_empleado = null;

$guardar_empleado = conexion();
$guardar_empleado = $guardar_empleado->prepare("INSERT into empleado (empleado_sexo, empleado_domicilio, empleado_estado_civil, empleado_curp, empleado_rfc, empleado_nss, empleado_fecha_de_nacimiento, empleado_lugar_de_nacimiento, empleado_telefono, empleado_tipo_de_sangre, empleado_alergias, empleado_enfermedades, empleado_nombre_completo_de_la_madre, empleado_nombre_completo_del_padre, empleado_nombre_de_contacto_para_emergencia, empleado_parentezco_con_el_contacto_de_emergencia, empleado_telefono_de_contacto_para_emergencia, empleado_estado, empleado_credito_infonavit, empleado_salario_diario_integrado, empleado_fecha_de_termino_de_contrato, empleado_puesto_de_trabajo, empleado_lugar_de_servicio_o_de_proyecto, empleado_numero_de_contrato, empleado_inicio_de_contrato_pemex, empleado_fin_de_contrato_pemex, empleado_quien_lo_contrato, empleado_nombres, empleado_apellido_paterno, empleado_apellido_materno, empleado_dia_de_ingreso, empleado_mes_de_ingreso, empleado_año_de_ingreso, empleado_salario_diario_integrado_escrito, empleado_historial_lugares_de_servicio)
VALUES(:sexo,:domicilio,:estadoCivil,:curp,:rfc,:nss,:fechaDeNacimiento,:lugarDeNacimiento,:telefono,:tipoSangre,:alergias,:enfermedades,:nombreMadre,:nombrePadre,:nombreContactoEmergencia,:parentezco,:telefonoEmergencia,:estado,:creditoInfonavit,:salarioDiarioIntegrado,:fechaDeTerminoDeContrato,:puestoDeTrabajo,:lugarDeServicio,:numeroDeContrato,:inicioContratoPemex,:finContratoPemex,:quienLoContrato,:nombre,:apellidoPaterno,:apellidoMaterno,:diaDeIngreso,:mesDeIngreso,:anioDeIngreso,:salarioDiarioIntegradoEscrito,:lugaresDeServicioHistorial)");

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
    ":quienLoContrato" => $quienLoContrato
];

$guardar_empleado->execute($marcadores);

if ($guardar_empleado->rowCount() == 1) {
    // Obtener el correo de notificaciones
    $config = conexion();
    $resultado = $config->query("SELECT correo FROM configuracion LIMIT 1");
    if ($resultado->rowCount() > 0) {
        $correo_destino = $resultado->fetchColumn();
        $asunto = "Nuevo empleado agregado";
        $cuerpo = "Se ha registrado un nuevo empleado: {$nombres} {$apellidoPaterno} {$apellidoMaterno} por {$_SESSION['nombre']}";
        enviar_correo($asunto, $cuerpo, $correo_destino);
    }
    $config = null;

    echo '
            <div class="notification is-info is-light">
                <strong>¡EMPLEADO REGISTRADO!</strong><br>
                El empleado se registró con éxito
            </div>
        ';
    echo "<script>
            window.location.href='../index.php?vista=employee_list';
        </script>";
} else {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo registrar el empleado, por favor intente nuevamente
            </div>
        ';
    echo "<script>
            window.location.href='../index.php?vista=employee_list';
        </script>";
}
?>
