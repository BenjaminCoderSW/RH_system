<?php
// Añadimos el archivo de inicio de sesion para ver quien contrato al empleado con la variable de sesion
require_once "../inc/session_start.php";

require_once "main.php";

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
$quienLoContrato = limpiar_cadena($_SESSION['usuario']);

if ($nombre == "" || $sexo == "" || $fechaDeNacimiento == "" || $lugarDeNacimiento == "" || $estadoCivil == "" 
|| $domicilio == "" || $telefono == "" || $nombreContactoEmergencia == "" || $parentezco == "" 
|| $telefonoEmergencia == "" || $puestoDeTrabajo == "" || $fechaDeIngreso == "" || $fechaDeTerminoDeContrato == "" 
|| $lugarDeServicio == "" || $numeroDeContrato == "" || $inicioContratoPemex == "" || $finContratoPemex == "" 
|| $salarioDiarioIntegrado == "" || $creditoInfonavit == "" || $curp == "" || $rfc == "" 
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

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}", $nombre)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#. ,]{3,255}", $lugarDeNacimiento)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El LUGAR DE NACIMIENTO no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#. ,]{3,255}", $domicilio)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El DOMICILIO no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("[\+]?[0-9]{1,4}[-\s]?([0-9]{3,4}[-\s]?)*[0-9]{3,4}", $telefono)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El TELEFONO del empleado no coincide con el formato solicitado.
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

if (verificar_datos("[\+]?[0-9]{1,4}[-\s]?([0-9]{3,4}[-\s]?)*[0-9]{3,4}", $telefonoEmergencia)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El TELEFONO DE EMERGENCIA no coincide con el formato solicitado.
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

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#. ,]{3,255}", $lugarDeServicio)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El LUGAR DE SERVICIO no coincide con el formato solicitado.
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

if (verificar_datos("^(\d{2}[-_ ]?\d{2}[-_ ]?\d{2}[-_ ]?\d{2}[-_ ]?\d{2}[-_ ]?\d{1}|\d{11})$", $nss)) {
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
$guardar_empleado = $guardar_empleado->prepare("INSERT into empleado (empleado_nombre_completo, empleado_sexo, empleado_domicilio, empleado_estado_civil, empleado_curp, empleado_rfc, empleado_nss, empleado_fecha_de_nacimiento, empleado_lugar_de_nacimiento, empleado_telefono, empleado_tipo_de_sangre, empleado_alergias, empleado_enfermedades, empleado_nombre_completo_de_la_madre, empleado_nombre_completo_del_padre, empleado_nombre_de_contacto_para_emergencia, empleado_parentezco_con_el_contacto_de_emergencia, empleado_telefono_de_contacto_para_emergencia, empleado_estado, empleado_credito_infonavit, empleado_salario_diario_integrado, empleado_fecha_de_ingreso, empleado_fecha_de_termino_de_contrato, empleado_puesto_de_trabajo, empleado_lugar_de_servicio_o_de_proyecto, empleado_numero_de_contrato, empleado_inicio_de_contrato_pemex, empleado_fin_de_contrato_pemex, empleado_quien_lo_contrato) 
VALUES(:nombre,:sexo,:domicilio,:estadoCivil,:curp,:rfc,:nss,:fechaDeNacimiento,:lugarDeNacimiento,:telefono,:tipoSangre,:alergias,:enfermedades,:nombreMadre,:nombrePadre,:nombreContactoEmergencia,:parentezco,:telefonoEmergencia,:estado,:creditoInfonavit,:salarioDiarioIntegrado,:fechaDeIngreso,:fechaDeTerminoDeContrato,:puestoDeTrabajo,:lugarDeServicio,:numeroDeContrato,:inicioContratoPemex,:finContratoPemex,:quienLoContrato)");

$marcadores = [
    ":nombre" => $nombre,
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
    ":fechaDeIngreso" => $fechaDeIngreso,
    ":fechaDeTerminoDeContrato" => $fechaDeTerminoDeContrato,
    ":lugarDeServicio" => $lugarDeServicio,
    ":numeroDeContrato" => $numeroDeContrato,
    ":inicioContratoPemex" => $inicioContratoPemex,
    ":finContratoPemex" => $finContratoPemex,
    ":salarioDiarioIntegrado" => $salarioDiarioIntegrado,
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
    echo '
            <div class="notification is-info is-light">
                <strong>¡EMPLEADO REGISTRADO!</strong><br>
                El empleado se registro con exito
            </div>
        ';
} else {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el empleado, por favor intente nuevamente
            </div>
        ';
}

$guardar_empleado = null;
