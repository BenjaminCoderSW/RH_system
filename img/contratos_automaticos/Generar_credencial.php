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
$anioActual = date('Y');
$fotoEmpleado = $datosEmpleado['empleado_foto'];

// Ruta absoluta desde la perspectiva del servidor para localhost
$rutaFotoEmpleado = "C:/laragon/www/HR_System/img/fotos_empleados/" . $fotoEmpleado;
$rutaLogo = "C:/laragon/www/HR_System/img/logo_fondo_blanco.jpg";
$imagenISO = "C:/laragon/www/HR_System/img/imagen_credencial.png";

// Ruta absoluta desde la perspectiva del servidor para el hosting
// $rutaFotoEmpleado = "/home/u954703204/domains/cinetickett.com/public_html/HR_System/img/fotos_empleados/" . $fotoEmpleado;
// $rutaLogo = "/home/u954703204/domains/cinetickett.com/public_html/HR_System/img/logo_fondo_blanco.jpg";
// $imagenISO = "/home/u954703204/domains/cinetickett.com/public_html/HR_System/img/imagen_credencial.png";

// Verifica si el archivo de la foto del empleado existe
if (file_exists($rutaFotoEmpleado)) {
    $tipoMimeFoto = mime_content_type($rutaFotoEmpleado);
    $dataFoto = base64_encode(file_get_contents($rutaFotoEmpleado));
    $rutaFotoEmpleadoBase64 = 'data:' . $tipoMimeFoto . ';base64,' . $dataFoto;
} else {
    $rutaFotoEmpleadoBase64 = ''; // Aquí puedes poner una imagen de respaldo en caso de que la imagen del empleado no exista
}

// Verifica si el archivo del logo existe
if (file_exists($rutaLogo)) {
    $tipoMimeLogo = mime_content_type($rutaLogo);
    $dataLogo = base64_encode(file_get_contents($rutaLogo));
    $rutaLogoBase64 = 'data:' . $tipoMimeLogo . ';base64,' . $dataLogo;
} else {
    $rutaLogoBase64 = ''; // Aquí puedes poner una imagen de respaldo en caso de que el logo no exista
}

// Verifica si el archivo de la imagen ISO existe
if (file_exists($imagenISO)) {
    $tipoMimeISO = mime_content_type($imagenISO);
    $dataISO = base64_encode(file_get_contents($imagenISO));
    $rutaISOBase64 = 'data:' . $tipoMimeISO . ';base64,' . $dataISO;
} else {
    $rutaISOBase64 = ''; // Aquí puedes poner una imagen de respaldo en caso de que la imagen ISO no exista
}
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
            margin-bottom: 0; /* Eliminar margen inferior */
            box-sizing: border-box;
            display: inline-block; /* Mostrar en línea para quitar el espacio */
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 5px;
        }
        .header img {
            width: 1.5cm; /* Ajusta el tamaño del logo */
            height: auto;
            margin-right: 5px;
            margin-top: 3px;
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
        .foto-area img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
            font-size: 9.5px;
        }
        .back-info {
            font-size: 10px;
            margin-bottom: 20px;
            position: relative;
        }
        .iso-image {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 3cm; /* Ajusta el tamaño de la imagen ISO */
            height: auto;
        }
    </style>
</head>
<body>
    <!-- Parte Frontal de la Credencial -->
    <div class="credencial">
        <div class="header">
            <?php if ($rutaLogoBase64): ?>
                <img src="<?php echo $rutaLogoBase64; ?>" alt="Logo de la empresa">
            <?php endif; ?>
            Atzco, S.A. de C.V.
        </div>
        <div class="foto-area">
            <?php if ($rutaFotoEmpleadoBase64): ?>
                <img src="<?php echo $rutaFotoEmpleadoBase64; ?>" alt="Foto del empleado">
            <?php else: ?>
                <span>Foto no disponible</span>
            <?php endif; ?>
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
            <?php if ($rutaISOBase64): ?>
                <img src="<?php echo $rutaISOBase64; ?>" alt="ISO" class="iso-image">
            <?php endif; ?>
            <p><strong class="label">Tipo de Sangre:</strong> <?php echo $tipoSangre; ?></p>
            <p><strong class="label">Alergias:</strong> <?php echo $alergias; ?></p>
            <p><strong class="label">Enfermedades:</strong> <?php echo $enfermedades; ?></p>
            <p><strong class="label">Emergencias avisar a:</strong> <?php echo $numeroEmergencia; ?></p>
            <div class="signature">
            <p><strong>Firma del Trabajador</strong> _____________ <strong>Recursos Humanos</strong> ____________</p>
        </div>
        </div>
    </div>
</body>
</html>
