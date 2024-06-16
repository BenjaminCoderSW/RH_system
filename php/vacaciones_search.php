<?php
require_once "main.php";

$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

$consulta_datos = "SELECT * FROM vacaciones 
                   INNER JOIN empleado ON vacaciones.empleado_id = empleado.empleado_id 
                   WHERE empleado.empleado_nombres LIKE '%$busqueda%' 
                   OR empleado.empleado_curp LIKE '%$busqueda%' 
                   OR empleado.empleado_rfc LIKE '%$busqueda%'
                   ORDER BY vacaciones.vacaciones_dia_solicitud DESC
                   LIMIT $inicio,$registros";

$consulta_total = "SELECT COUNT(*) FROM vacaciones 
                   INNER JOIN empleado ON vacaciones.empleado_id = empleado.empleado_id 
                   WHERE empleado.empleado_nombres LIKE '%$busqueda%' 
                   OR empleado.empleado_curp LIKE '%$busqueda%' 
                   OR empleado.empleado_rfc LIKE '%$busqueda%'";

$conexion = conexion();
$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll(PDO::FETCH_ASSOC);
$total = $conexion->query($consulta_total);
$total = (int) $total->fetchColumn();
$Npaginas = ceil($total / $registros);

if (count($datos) > 0) {
    echo '<div class="table-responsive">';
    echo '<table class="table table-hover">';
    echo '<thead><tr><th>Nombre</th><th>CURP</th><th>RFC</th><th>Días Solicitados</th><th>Fecha de Solicitud</th><th>Acciones</th></tr></thead>';
    echo '<tbody>';
    foreach ($datos as $row) {
        echo '<tr>';
        echo '<td>' . $row['empleado_nombres'] . '</td>';
        echo '<td>' . $row['empleado_curp'] . '</td>';
        echo '<td>' . $row['empleado_rfc'] . '</td>';
        echo '<td>' . $row['vacaciones_dias_solicitados'] . '</td>';
        echo '<td>' . $row['vacaciones_dia_solicitud'] . '/' . $row['vacaciones_mes_solicitud'] . '/' . $row['vacaciones_anio_solicitud'] . '</td>';
        echo '<td>
                <button class="btn btn-sm btn-primary" onclick="mostrarDetallesVacacion(' . $row['vacaciones_id'] . ', \'' . $row['empleado_nombres'] . '\')"><i class="fas fa-umbrella-beach"></i> Detalles</button>
                <button class="btn btn-danger btn-sm" onclick="eliminarVacacion(' . $row['vacaciones_id'] . ')">Eliminar</button>
              </td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';

    // Paginador
    if ($total > 0 && $pagina <= $Npaginas) {
        echo '<p class="has-text-right">Mostrando registros <strong>' . ($inicio + 1) . '</strong> al <strong>' . ($inicio + count($datos)) . '</strong> de un total de <strong>' . $total . '</strong></p>';
        echo paginador_tablas($pagina, $Npaginas, $url, 10);
    }
} else {
    echo '<p class="mt-4">No se encontraron resultados para la búsqueda: ' . htmlspecialchars($busqueda) . '</p>';
}
?>

<script>
function eliminarVacacion(id) {
    if (confirm('¿Estás seguro de eliminar esta solicitud de vacaciones?')) {
        fetch(`./php/eliminar_vacacion.php?vacaciones_id=${id}`, {
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const notification = document.createElement('div');
                notification.className = 'notification is-success is-light';
                notification.innerHTML = `<strong>¡Eliminado!</strong> ${data.message}`;
                document.body.appendChild(notification);
                setTimeout(() => {
                    window.location.href = `index.php?vista=holiday_search&buscar=<?php echo $busqueda; ?>&page=<?php echo $pagina; ?>`;
                }, 3000);
            } else {
                const notification = document.createElement('div');
                notification.className = 'notification is-danger is-light';
                notification.innerHTML = `<strong>Error:</strong> ${data.message}`;
                document.body.appendChild(notification);
            }
        })
        .catch(error => {
            const notification = document.createElement('div');
            notification.className = 'notification is-danger is-light';
            notification.innerHTML = `<strong>Error:</strong> Ocurrió un error al eliminar la solicitud de vacaciones.`;
            document.body.appendChild(notification);
        });
    }
}
</script>
