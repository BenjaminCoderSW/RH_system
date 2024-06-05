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
    echo '<table class="table mt-4">';
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
                <button class="btn btn-danger btn-sm" onclick="eliminarVacacion(' . $row['vacaciones_id'] . ')">Eliminar</button>
              </td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';

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
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(./php/eliminar_vacacion.php?vacaciones_id=${id}, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    Swal.fire(
                        'Eliminado!',
                        data.message,
                        'success'
                    ).then(() => {
                        window.location.href = "index.php?vista=holiday_search&buscar=<?php echo $busqueda; ?>&page=<?php echo $pagina; ?>";
                    });
                } else {
                    Swal.fire(
                        'Error!',
                        data.message,
                        'error'
                    );
                }
            })
            .catch(error => {
                Swal.fire(
                    'Error!',
                    'Ocurrió un error al eliminar la solicitud de vacaciones.',
                    'error'
                );
            });
        }
    })
}
</script>