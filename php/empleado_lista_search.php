<?php
require_once "./inc/session_start.php";

// Obtenemos el rol del usuario desde la sesión
$rol_usuario = $_SESSION['rol'];

// Esta variable va a servir para saber desde donde vamos a empezar a contar los registros que vamos a mostrar en las tablas de usuarios, contendrá el índice 
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

// Inicializar la variable $tabla al principio para asegurarse de que siempre esté definida
$tabla = "";

// Filtro entre activos e inactivos
$estado = isset($_SESSION['busqueda_empleado_estado']) ? $_SESSION['busqueda_empleado_estado'] : 'todos';
$busqueda = isset($_SESSION['busqueda_empleado']) ? $_SESSION['busqueda_empleado'] : "";

// Lógica para el filtro de estado
$filtro_estado = "";
$parametros = [];
if ($estado != "todos") {
    $filtro_estado = " AND empleado_estado = :estado";
    $parametros[':estado'] = $estado;
}

// Lógica para el filtro de búsqueda
$filtro_busqueda = "";
if ($busqueda != "") {
    $busqueda = "%$busqueda%";
    $filtro_busqueda = " AND (empleado_sexo LIKE :busqueda OR empleado_domicilio LIKE :busqueda OR empleado_estado_civil LIKE :busqueda OR empleado_curp LIKE :busqueda OR empleado_rfc LIKE :busqueda OR empleado_nss LIKE :busqueda OR empleado_tipo_de_sangre LIKE :busqueda OR empleado_alergias LIKE :busqueda OR empleado_enfermedades LIKE :busqueda OR empleado_telefono_de_contacto_para_emergencia LIKE :busqueda OR empleado_estado LIKE :busqueda OR empleado_puesto_de_trabajo LIKE :busqueda OR empleado_lugar_de_servicio_o_de_proyecto LIKE :busqueda OR empleado_numero_de_contrato LIKE :busqueda OR empleado_quien_lo_contrato LIKE :busqueda OR empleado_nombres LIKE :busqueda OR empleado_apellido_paterno LIKE :busqueda OR empleado_apellido_materno LIKE :busqueda OR empleado_mes_de_ingreso LIKE :busqueda OR empleado_año_de_ingreso LIKE :busqueda)";
    $parametros[':busqueda'] = $busqueda;
}

$consulta_datos = "SELECT * FROM empleado WHERE 1=1" . $filtro_estado . $filtro_busqueda . " ORDER BY empleado_nombres ASC LIMIT $inicio, $registros";
$consulta_total = "SELECT COUNT(empleado_id) FROM empleado WHERE 1=1" . $filtro_estado . $filtro_busqueda;

// Conexión a la base de datos
$conexion = conexion();

// Preparar y ejecutar consulta de datos
$stmt = $conexion->prepare($consulta_datos);

// Asignar parámetros a la consulta
foreach ($parametros as $clave => $valor) {
    $stmt->bindValue($clave, $valor);
}

$stmt->execute();
$datos = $stmt->fetchAll();

// Preparar y ejecutar consulta total
$stmt = $conexion->prepare($consulta_total);

// Asignar parámetros a la consulta
foreach ($parametros as $clave => $valor) {
    $stmt->bindValue($clave, $valor);
}

$stmt->execute();
$total = (int) $stmt->fetchColumn();

$Npaginas = ceil($total / $registros);

// Generar la tabla de resultados
$tabla = '
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr class="has-text-centered">
                <th>#</th>
                <th>Nombres</th>
                <th>RFC</th>
                <th>Numero de Seguro Social</th>
                <th>Cargo</th>
                <th>Fecha de Ingreso</th>
                <th>Quien lo contrato</th>
                <th>Detalles</th>';
                // Agregar los encabezados de las columnas Eliminar y Vacaciones solo si el rol no es Auxiliar
                if ($rol_usuario != 'Auxiliar') {
                    $tabla .= '
                <th>Eliminar</th>
                <th>Vacaciones</th>';
                }
$tabla .= '
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
                <td>' . $rows['empleado_rfc'] . '</td>
                <td>' . $rows['empleado_nss'] . '</td>
                <td>' . $rows['empleado_puesto_de_trabajo'] . '</td>
                <td>' . $rows['empleado_dia_de_ingreso'] . " de " . $rows['empleado_mes_de_ingreso'] . " del " . $rows['empleado_año_de_ingreso'] . '</td>
                <td>' . $rows['empleado_quien_lo_contrato'] . '</td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="mostrarDetallesEmpleado(\'' . $rows['empleado_id'] . '\')">Detalles</button>
                </td>';
        
        // Mostrar los botones de eliminación y vacaciones solo si el rol del usuario no es "Auxiliar"
        if ($rol_usuario != 'Auxiliar') {
            $tabla .= '
                <td>
                    <button class="btn btn-danger btn-sm" onclick="confirmarEliminacion(\'' . $rows['empleado_id'] . '\', \'' . $url . $pagina . '\')">Eliminar</button>
                </td>
                <td>
                    <a href="index.php?vista=holiday_new&employee_id_vac=' . $rows['empleado_id'] . '" class="btn btn-sm"><i class="fas fa-umbrella-beach"></i> Vacaciones </a>
                </td>';
        }
            // Para los auxiliares, mostrar solo los botones de detalles y expediente
            $tabla .= '
                <td>
                    <a href="index.php?vista=employee_file&employee_id_exp=' . $rows['empleado_id'] . '" class="btn btn-sm"><i class="fas fa-upload"></i> Expediente </a>
                </td>';

        $tabla .= '</tr>';
    }
} else {
    $tabla .= '
        <tr class="has-text-centered">
            <td colspan="10">No hay registros en el sistema</td>
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

// Script JS para SweetAlert2
echo '
<script>
function confirmarEliminacion(employeeId, redirectUrl) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = redirectUrl + "&employee_id_del=" + employeeId;
        }
    });
}
</script>
';
?>
