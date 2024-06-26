<?php
require_once "main.php";
require_once '../vendor/autoload.php';
use Dompdf\Dompdf;

// Obtenemos los datos del formulario
$empleadoId = isset($_POST['empleado_id']) ? limpiar_cadena($_POST['empleado_id']) : 0;
$tipoDeContrato = isset($_POST['empleado_tipo_de_contrato']) ? $_POST['empleado_tipo_de_contrato'] : '';

// Verifica que el tipo de contrato sea uno de los permitidos
$plantillasPermitidas = [
    "13_Convenio_de_Confidencialidad_Anexo_8.php",
    "CONTRATO_2021_OBRA_DETERMINADA_ATZCO_ADM-OPERATIVOS_MODF.php",
    "CONTRATO_2021_OBRA_DETERMINADA_ATZCO_CAMPO_MODF.php",
    "CONTRATO_TIEMPO_DETERMINADO.php",
    "GRUPO_ATZCO_CAMPO.php",
    "Generar_credencial.php",
    "Generar_Credencial_Grupo.php"
];

if (!in_array($tipoDeContrato, $plantillasPermitidas)) {
    die("Tipo de contrato no permitido.");
}

// Conexión a la base de datos y obtención de datos del empleado
$conexion = conexion();
$stmt = $conexion->prepare("SELECT * FROM empleado WHERE empleado_id = :id");
$stmt->bindParam(':id', $empleadoId, PDO::PARAM_INT);
$stmt->execute();
$datosEmpleado = $stmt->fetch();

if (!$datosEmpleado) {
    die("Empleado no encontrado.");
}

// Ruta a la plantilla seleccionada
$rutaPlantilla = "../img/contratos_automaticos/" . $tipoDeContrato;

// Verifica que el archivo de plantilla exista
if (!file_exists($rutaPlantilla)) {
    die("Plantilla de contrato no encontrada.");
}

// Carga el contenido de la plantilla PHP
ob_start();
include $rutaPlantilla;
$html = ob_get_clean();

// Crea el PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Envía el PDF al navegador
$dompdf->stream("contrato_{$datosEmpleado['empleado_nombres']}.pdf", ["Attachment" => false]);
