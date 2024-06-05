<?php
// Añadimos el archivo de inicio de sesion para ver quien contrato al empleado con la variable de sesion
require_once "../inc/session_start.php";

require_once "main.php";

$empleado_id = limpiar_cadena($_POST['empleado_vacaciones_id']);
$dias_solicitados = limpiar_cadena($_POST['vacaciones_dias_solicitados']);
$dia_solicitud = limpiar_cadena($_POST['vacaciones_dia_solicitud']);
$mes_solicitud = limpiar_cadena($_POST['vacaciones_mes_solicitud']);
$anio_solicitud = limpiar_cadena($_POST['vacaciones_anio_solicitud']);
$periodo_inicio = limpiar_cadena($_POST['vacaciones_periodo_inicio']);
$periodo_fin = limpiar_cadena($_POST['vacaciones_periodo_fin']);
$quienLasRegistro = limpiar_cadena($_SESSION['nombre']);

if ($empleado_id == "" || $dias_solicitados == "" || $dia_solicitud == "" ||$mes_solicitud == "" || 
$anio_solicitud == "" || $periodo_inicio == "" || $periodo_fin == "" || $quienLasRegistro == "") {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos
            </div>
        ';
    exit();
}

if (verificar_datos("^\d+$", $dias_solicitados)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Los DIAS SOLICITADOS no coinciden con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("^(0[1-9]|[12][0-9]|3[01])$", $dia_solicitud)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El DIA DE SOLICITUD no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("^(20[2-9]\d|21[0-9]\d)$", $anio_solicitud)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El AÑO DE SOLICITUD no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("^(20[2-9]\d|21[0-9]\d)$", $periodo_inicio)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El INICIO DEL PERIODO no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

if (verificar_datos("^(20[2-9]\d|21[0-9]\d)$", $periodo_fin)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El FIN DEL PERIODO no coincide con el formato solicitado.
            </div>
        ';
    exit();
}

// ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo

$check_empleado = conexion();
$check_empleado = $check_empleado->query("SELECT * FROM empleado WHERE empleado_id = '$empleado_id'");

// Revisamos si el empleado NO existe nuestra base de datos
if ($check_empleado->rowCount() <= 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El EMPLEADO al que se quieren registrar vacaciones NO EXISTE, por
            favor elija otro
        </div>
    ';
    exit();
}else{

    $guardar_vacaciones = conexion();
    $guardar_vacaciones = $guardar_vacaciones->prepare("INSERT into vacaciones (empleado_id, vacaciones_dias_solicitados, vacaciones_dia_solicitud, vacaciones_mes_solicitud, vacaciones_anio_solicitud, vacaciones_periodo_inicio, vacaciones_periodo_fin, vacaciones_quien_las_registro)
    VALUES(:id_empleado,:dias_solicitados,:dia_solicitud,:mes_solicitud,:anio_solicitud,:periodo_inicio,:periodo_fin,:quienLasRegistro)");

    $marcadores = [
        ":id_empleado" => $empleado_id,
        ":dias_solicitados" => $dias_solicitados,
        ":dia_solicitud" => $dia_solicitud,
        ":mes_solicitud" => $mes_solicitud,
        ":anio_solicitud" => $anio_solicitud,
        ":periodo_inicio" => $periodo_inicio,
        ":periodo_fin" => $periodo_fin,
        ":quienLasRegistro" => $quienLasRegistro
    ];

    $guardar_vacaciones->execute($marcadores);

    if ($guardar_vacaciones->rowCount() == 1) {
        echo '
                <div class="notification is-info is-light">
                    <strong>¡EMPLEADO REGISTRADO!</strong><br>
                    Las vacaciones se registraron con exito
                </div>
            ';
    } else {
        echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    No se pudieron registrar las vacaciones al empleado, por favor intente nuevamente
                </div>
            ';
    }
    $guardar_vacaciones = null;
}
$check_empleado = null;