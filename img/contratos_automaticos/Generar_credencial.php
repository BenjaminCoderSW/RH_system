<?php
// Asegúrate de que los datos necesarios están presentes
if (!isset($datosEmpleado)) {
    echo "Datos del empleado no disponibles.";
    return;
}

// Extrae los datos necesarios de la base de datos para llenar la plantilla
$nombres = $datosEmpleado['empleado_nombres'];
$apellidoPaterno = $datosEmpleado['empleado_apellido_paterno'];
$apellidoMaterno = $datosEmpleado['empleado_apellido_materno'];
$rfc = $datosEmpleado['empleado_rfc'];
$nss = $datosEmpleado['empleado_nss'];
$categoria = $datosEmpleado['empleado_puesto_de_trabajo'];
$tipoSangre = $datosEmpleado['empleado_tipo_de_sangre'];
$alergias = $datosEmpleado['empleado_alergias'];
$enfermedades = $datosEmpleado['empleado_enfermedades'];
$numeroEmergencia = $datosEmpleado['empleado_telefono_de_contacto_para_emergencia'];
// Queda en duda las fechas de la vigencia y la fotografia del empleado

// Aquí empieza el contenido de la plantilla
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Credencial a un empleado</title>
    <style>
    </style>
</head>
<body>
    <div>
        Plantilla de credencial para un empleado
    </div>
</body>
</html>
