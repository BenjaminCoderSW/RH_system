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
$dia = $datosEmpleado['empleado_dia_de_ingreso'];
$mes = $datosEmpleado['empleado_mes_de_ingreso'];

// Obtén el año actual
$anioActual = date('Y');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Credencial a un empleado</title>
    <style>
        .credencial {
            width: 9cm;
            height: 5cm;
            border: 1px solid #000;
            padding: 5px;
            font-family: Arial, sans-serif;
            color: #000;
            position: relative;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            margin-bottom: 5px;
        }
        .header img {
            width: 2cm;
            height: auto;
        }
        .foto-area {
            width: 2.5cm;  /* Ancho de una foto tamaño infantil */
            height: 3cm;   /* Altura de una foto tamaño infantil */
            border: 1px solid #000;
            margin-bottom: 5px;
            background-color: #e0e0e0;
            text-align: center;
            line-height: 3cm;
            font-size: 10px;
            color: #777;
            float: left;
            margin-right: 5px;
        }
        .info {
            font-size: 10px;
        }
        .info .label {
            font-weight: bold;
        }
        .signature {
            position: absolute;
            bottom: 5px;
            width: 100%;
            text-align: center;
            font-size: 8px;
        }
        .back-info {
            font-size: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Parte Frontal de la Credencial -->
    <div class="credencial">
        <div class="header">
            <p>Constructora Atzco, S.A. de C.V.</p>
        </div>
        <div class="foto-area">
            Foto
        </div>
        <div class="info">
            <p><span class="label">Nombre:</span> <?php echo "$nombres $apellidoPaterno $apellidoMaterno"; ?></p>
            <p><span class="label">RFC:</span> <?php echo $rfc; ?></p>
            <p><span class="label">No. IMSS:</span> <?php echo $nss; ?></p>
            <p><span class="label">Categoría:</span> <?php echo $categoria; ?></p>
            <p><span class="label">Vigencia:</span> <?php echo "$dia de $mes al 31 de diciembre de $anioActual"; ?></p>
        </div>
    </div>

    <!-- Parte Trasera de la Credencial -->
    <div class="credencial">
        <div class="back-info">
            <p><strong class="label">Tipo de Sangre:</strong> <?php echo $tipoSangre; ?></p>
            <p><strong class="label">Alergias:</strong> <?php echo $alergias; ?></p>
            <p><strong class="label">Enfermedades:</strong> <?php echo $enfermedades; ?></p>
            <p><strong class="label">Emergencias avisar a:</strong> <?php echo $numeroEmergencia; ?></p>
        </div>
        <div class="signature">
            <p>Firma del Trabajador _______ Recursos Humanos _______</p>
        </div>
    </div>
</body>
</html>