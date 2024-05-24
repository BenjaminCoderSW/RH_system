<?php
// Asegúrate de que los datos necesarios están presentes
if (!isset($datosEmpleado)) {
    echo "Datos del empleado no disponibles.";
    return;
}

// Extrae los datos necesarios para llenar la plantilla
$nombreCompleto = $datosEmpleado['empleado_nombre_completo'];
$domicilio = $datosEmpleado['empleado_domicilio']; 
$fechaIngreso = $datosEmpleado['empleado_fecha_de_ingreso'];

// Aquí empieza el contenido de la plantilla
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Convenio de Confidencialidad</title>
    <link rel="stylesheet" href="./css/13_Convenio_de_Confidencialidad_Anexo_8.css">
</head>
<body>
    <div class="header">
        <p>CONVENIO DE CONFIDENCIALIDAD QUE CELEBRAN POR UNA PARTE LA SOCIEDAD <br>
            DENOMINADA CONSTRUCTORA ATZCO SA DE CV, REPRESENTADA EN ESTE ACTO <br>
            POR ISRAEL RODRÍGUEZ ESCAMILLA A QUIÉN EN LO SUCESIVO Y PARA EFECTOS <br>
            DEL PRESENTE CONVENIO SE DENOMINARÁ "LA EMPRESA", Y POR LA OTRA EL <br>
            EMPLEADO <strong><?php echo $nombreCompleto; ?></strong> Y A QUIÉN EN LO SUCESIVO Y PARA <br>
            EFECTOS DEL PRESENTE CONVENIO SE DENOMINARÁ "EL CONFIDENTE", AL <br>
            TENOR DE LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS. <br>
        </p>
    </div>
    <div class="content">
        <h3>DECLARACIONES</h3>
        <ol>
            <li><strong>LA EMPRESA</strong>, a través de su representante legal declara que:
                <ul>
                    <li>Es una sociedad mercantil debidamente constituida de conformidad con las leyes que rigen en la República Mexicana, como se desprende de la Escritura Pública número 16,419 de fecha 12 de Noviembre de 1992, otorgada ante el Lic. Carlos A. Solís del Registro Mercantil.</li>
                    <li>Su domicilio se encuentra en <strong><?php echo $domicilio; ?></strong>.</li>
                    <li>Se presenta por su representante legal, Israel Rodríguez Escamilla.</li>
                </ul>
            </li>
            <li><strong>EL EMPLEADO</strong>, identificado como <strong><?php echo $nombreCompleto; ?></strong>, manifiesta su conformidad en celebrar el presente Convenio de Confidencialidad bajo las siguientes cláusulas y condiciones.</li>
        </ol>
        <h4>CLAUSULAS</h4>
        <p>Detalla aquí las cláusulas específicas del convenio.</p>
    </div>
    <div class="footer">
        <p>Ciudad y Fecha: <strong><?php echo $fechaIngreso; ?></strong></p>
    </div>
</body>
</html>
