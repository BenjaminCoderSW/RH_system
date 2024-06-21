<?php
require '../vendor/autoload.php';
require_once "./main.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Obtener los parámetros de búsqueda
$busqueda = isset($_GET['busqueda']) ? limpiar_cadena($_GET['busqueda']) : "";
$estado = isset($_GET['estado']) ? limpiar_cadena($_GET['estado']) : 'todos';

// Construir la consulta
$filtro_estado = "";
if ($estado != "todos") {
    $filtro_estado = " AND empleado_estado = :estado";
}

if ($busqueda != "") {
    $consulta_datos = "SELECT * FROM empleado WHERE ((empleado_nombres LIKE :busqueda OR empleado_apellido_paterno LIKE :busqueda OR empleado_apellido_materno LIKE :busqueda OR empleado_rfc LIKE :busqueda OR empleado_curp LIKE :busqueda OR empleado_nss LIKE :busqueda OR empleado_mes_de_ingreso LIKE :busqueda OR empleado_año_de_ingreso LIKE :busqueda OR empleado_fecha_de_ingreso LIKE :busqueda OR empleado_lugar_de_servicio_o_de_proyecto LIKE :busqueda))" . $filtro_estado . " ORDER BY empleado_nombres ASC";
    $consulta_total = "SELECT COUNT(empleado_id) FROM empleado WHERE ((empleado_nombres LIKE :busqueda OR empleado_apellido_paterno LIKE :busqueda OR empleado_apellido_materno LIKE :busqueda OR empleado_rfc LIKE :busqueda OR empleado_curp LIKE :busqueda OR empleado_nss LIKE :busqueda OR empleado_mes_de_ingreso LIKE :busqueda OR empleado_año_de_ingreso LIKE :busqueda OR empleado_fecha_de_ingreso LIKE :busqueda OR empleado_lugar_de_servicio_o_de_proyecto LIKE :busqueda))" . $filtro_estado;
} else {
    $consulta_datos = "SELECT * FROM empleado WHERE 1=1 " . $filtro_estado . " ORDER BY empleado_nombres ASC";
    $consulta_total = "SELECT COUNT(empleado_id) FROM empleado WHERE 1=1 " . $filtro_estado;
}

// Conexión a la base de datos
$conexion = conexion();

// Preparar y ejecutar consulta de datos
$stmt = $conexion->prepare($consulta_datos);
if ($estado != 'todos') {
    $stmt->bindParam(':estado', $estado);
}
if (isset($busqueda) && $busqueda != "") {
    $busqueda = "%$busqueda%";
    $stmt->bindParam(':busqueda', $busqueda);
}
$stmt->execute();
$datos = $stmt->fetchAll();

// Crear el archivo Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Empleados');

// Añadir encabezados (asegúrate de incluir todos los campos relevantes)
$sheet->setCellValue('A1', 'Nombres');
$sheet->setCellValue('B1', 'Apellido Paterno');
$sheet->setCellValue('C1', 'Apellido Materno');
$sheet->setCellValue('D1', 'Sexo');
$sheet->setCellValue('E1', 'Fecha de Nacimiento');
$sheet->setCellValue('F1', 'Lugar de Nacimiento');
$sheet->setCellValue('G1', 'Estado Civil');
$sheet->setCellValue('H1', 'Domicilio');
$sheet->setCellValue('I1', 'Teléfono');
$sheet->setCellValue('J1', 'Nombre de Contacto de Emergencia');
$sheet->setCellValue('K1', 'Parentezco');
$sheet->setCellValue('L1', 'Teléfono de Emergencia');
$sheet->setCellValue('M1', 'Puesto de Trabajo');
$sheet->setCellValue('N1', 'Día de Ingreso');
$sheet->setCellValue('O1', 'Mes de Ingreso');
$sheet->setCellValue('P1', 'Año de Ingreso');
$sheet->setCellValue('Q1', 'Fecha de Término de Contrato');
$sheet->setCellValue('R1', 'Lugar de Servicio o Proyecto');
$sheet->setCellValue('S1', 'Número de Contrato');
$sheet->setCellValue('T1', 'Inicio de Contrato Pemex');
$sheet->setCellValue('U1', 'Fin de Contrato Pemex');
$sheet->setCellValue('V1', 'Salario Diario Integrado');
$sheet->setCellValue('W1', 'Salario Diario Integrado en letra');
$sheet->setCellValue('X1', 'Crédito Infonavit');
$sheet->setCellValue('Y1', 'CURP');
$sheet->setCellValue('Z1', 'RFC');
$sheet->setCellValue('AA1', 'Número de Seguro Social');
$sheet->setCellValue('AB1', 'Tipo de Sangre');
$sheet->setCellValue('AC1', 'Alergias');
$sheet->setCellValue('AD1', 'Enfermedades');
$sheet->setCellValue('AE1', 'Nombre Completo de la Madre');
$sheet->setCellValue('AF1', 'Nombre Completo del Padre');
$sheet->setCellValue('AG1', 'Estado');

// Ajustar el ancho de las columnas automáticamente
foreach (range('A', 'AG') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Añadir datos
$fila = 2;
foreach ($datos as $row) {
    $sheet->setCellValue('A' . $fila, $row['empleado_nombres']);
    $sheet->setCellValue('B' . $fila, $row['empleado_apellido_paterno']);
    $sheet->setCellValue('C' . $fila, $row['empleado_apellido_materno']);
    $sheet->setCellValue('D' . $fila, $row['empleado_sexo']);
    $sheet->setCellValue('E' . $fila, $row['empleado_fecha_de_nacimiento']);
    $sheet->setCellValue('F' . $fila, $row['empleado_lugar_de_nacimiento']);
    $sheet->setCellValue('G' . $fila, $row['empleado_estado_civil']);
    $sheet->setCellValue('H' . $fila, $row['empleado_domicilio']);
    $sheet->setCellValue('I' . $fila, $row['empleado_telefono']);
    $sheet->setCellValue('J' . $fila, $row['empleado_nombre_de_contacto_para_emergencia']);
    $sheet->setCellValue('K' . $fila, $row['empleado_parentezco_con_el_contacto_de_emergencia']);
    $sheet->setCellValue('L' . $fila, $row['empleado_telefono_de_contacto_para_emergencia']);
    $sheet->setCellValue('M' . $fila, $row['empleado_puesto_de_trabajo']);
    $sheet->setCellValue('N' . $fila, $row['empleado_dia_de_ingreso']);
    $sheet->setCellValue('O' . $fila, $row['empleado_mes_de_ingreso']);
    $sheet->setCellValue('P' . $fila, $row['empleado_año_de_ingreso']);
    $sheet->setCellValue('Q' . $fila, $row['empleado_fecha_de_termino_de_contrato']);
    $sheet->setCellValue('R' . $fila, $row['empleado_lugar_de_servicio_o_de_proyecto']);
    $sheet->setCellValue('S' . $fila, $row['empleado_numero_de_contrato']);
    $sheet->setCellValue('T' . $fila, $row['empleado_inicio_de_contrato_pemex']);
    $sheet->setCellValue('U' . $fila, $row['empleado_fin_de_contrato_pemex']);
    $sheet->setCellValue('V' . $fila, $row['empleado_salario_diario_integrado']);
    $sheet->setCellValue('W' . $fila, $row['empleado_salario_diario_integrado_escrito']);
    $sheet->setCellValue('X' . $fila, $row['empleado_credito_infonavit']);
    $sheet->setCellValue('Y' . $fila, $row['empleado_curp']);
    $sheet->setCellValue('Z' . $fila, $row['empleado_rfc']);
    $sheet->setCellValue('AA' . $fila, $row['empleado_nss']);
    $sheet->setCellValue('AB' . $fila, $row['empleado_tipo_de_sangre']);
    $sheet->setCellValue('AC' . $fila, $row['empleado_alergias']);
    $sheet->setCellValue('AD' . $fila, $row['empleado_enfermedades']);
    $sheet->setCellValue('AE' . $fila, $row['empleado_nombre_completo_de_la_madre']);
    $sheet->setCellValue('AF' . $fila, $row['empleado_nombre_completo_del_padre']);
    $sheet->setCellValue('AG' . $fila, $row['empleado_estado']);
    $fila++;
}

// Crear el escritor de Excel y guardar el archivo en un buffer
$writer = new Xlsx($spreadsheet);
$filename = "empleados_" . date('Ymd_His') . ".xlsx";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');

$writer->save('php://output');
exit();
?>