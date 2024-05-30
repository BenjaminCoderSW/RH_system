<?php
// Esta variable va a servir para saber desde donde vamos a empezar a contar los registros que vamos a mostrar en las tablas de usuarios, contendrá el índice 
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

// Inicializar la variable $tabla al principio para asegurarse de que siempre esté definida
$tabla = "";

// Filtro entre activos e inactivos
$estado = isset($_GET['estado']) ? $_GET['estado'] : (isset($_SESSION['busqueda_empleado_estado']) ? $_SESSION['busqueda_empleado_estado'] : 'todos');

// Lógica para el filtro de estado
$filtro_estado = "";
$parametros = [];
if ($estado != "todos") {
    $filtro_estado = " AND empleado_estado = :estado";
    $parametros[':estado'] = $estado;
}

$consulta_datos = "SELECT * FROM empleado WHERE 1=1" . $filtro_estado . " ORDER BY empleado_nombres ASC LIMIT $inicio, $registros";
$consulta_total = "SELECT COUNT(empleado_id) FROM empleado WHERE 1=1" . $filtro_estado;

// Conexión a la base de datos
$conexion = conexion();

// Preparar y ejecutar consulta de datos
$stmt = $conexion->prepare($consulta_datos);
$stmt->execute($parametros);
$datos = $stmt->fetchAll();

// Preparar y ejecutar consulta total
$stmt = $conexion->prepare($consulta_total);
$stmt->execute($parametros);
$total = (int) $stmt->fetchColumn();

$Npaginas = ceil($total / $registros);

$tabla .= '
<div class="table-container">
    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr class="has-text-centered">
                <th>#</th>
                <th>Nombres</th>
                <th>CURP</th>
                <th>RFC</th>
                <th>Numero de Seguro Social</th>
                <th>Cargo</th>
                <th>Fecha de Ingreso</th>
                <th>Quien lo contrato</th>
                <th>Detalles</th>
                <th>Eliminar</th>
                <th>Expediente</th>
            </tr>
        </thead>
        <tbody>
';

if ($total >= 1 && $pagina <= $Npaginas) {
    $contador = $inicio + 1;
    foreach ($datos as $rows) {
        $tabla .= '
            <tr class="has-text-centered">
                <td>' . $contador++ . '</td>
                <td>' . $rows['empleado_nombres'] . '</td>
                <td>' . $rows['empleado_curp'] . '</td>
                <td>' . $rows['empleado_rfc'] . '</td>
                <td>' . $rows['empleado_nss'] . '</td>
                <td>' . $rows['empleado_puesto_de_trabajo'] . '</td>
                <td>' . $rows['empleado_dia_de_ingreso'] . " de " . $rows['empleado_mes_de_ingreso'] . " del " . $rows['empleado_año_de_ingreso'] . '</td>
                <td>' . $rows['empleado_quien_lo_contrato'] . '</td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="mostrarDetallesEmpleado(\'' . $rows['empleado_id'] . '\')">Detalles</button>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="confirmarEliminacion(\'' . $rows['empleado_id'] . '\', \'' . $url . $pagina . '\')">Eliminar</button>
                </td>
                <td>
                    <a href="index.php?vista=employee_file&employee_id_exp=' . $rows['empleado_id'] . '" class="btn btn-sm"><i class="fas fa-upload"></i> Expediente </a>
                </td>
            </tr>
        ';
    }
} else {
    $tabla .= '
        <tr class="has-text-centered">
            <td colspan="11">No hay registros en el sistema</td>
        </tr>
    ';
}

$tabla .= '</tbody></table></div>';

if ($total > 0 && $pagina <= $Npaginas) {
    $tabla .= '<p class="has-text-right">Mostrando empleados <strong>' . ($inicio + 1) . '</strong> al <strong>' . ($contador - 1) . '</strong> de un <strong>total de ' . $total . '</strong></p>';
}

echo $tabla;

if ($total >= 1 && $pagina <= $Npaginas) {
    echo paginador_tablas($pagina, $Npaginas, $url, 10);
}

$conexion = null;
?>
