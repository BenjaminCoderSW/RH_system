<?php
// Esta variable va a servir para saber desde dónde vamos a empezar a contar los registros que vamos a mostrar en las tablas de contratos, contendrá el índice 
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

$conexion = conexion();

$tabla = "";

// Consulta de datos y total de registros
$consulta_datos = "SELECT * FROM contrato WHERE contrato_tipo_contrato LIKE '%$busqueda%' OR contrato_descripcion LIKE '%$busqueda%' ORDER BY fecha_de_creacion DESC LIMIT $inicio, $registros";
$consulta_total = "SELECT COUNT(contrato_id) FROM contrato WHERE contrato_tipo_contrato LIKE '%$busqueda%' OR contrato_descripcion LIKE '%$busqueda%'";

$datos = $conexion->query($consulta_datos)->fetchAll(PDO::FETCH_ASSOC);
$total = (int) $conexion->query($consulta_total)->fetchColumn();
$Npaginas = ceil($total / $registros);

$tabla .= '
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr class="has-text-centered">
                <th>#</th>
                <th>Nombre del Contrato</th>
                <th>Descripción</th>
                <th>Fecha de Creación</th>
                <th>Descargar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
';

if ($total >= 1 && $pagina <= $Npaginas) {
    $contador = $inicio + 1;
    $pag_inicio = $inicio + 1;
    foreach ($datos as $rows) {
        $tabla .= '
            <tr class="has-text-centered">
                <td>' . $contador . '</td>
                <td>' . htmlspecialchars($rows['contrato_tipo_contrato']) . '</td>
                <td>' . htmlspecialchars($rows['contrato_descripcion']) . '</td>
                <td>' . htmlspecialchars($rows['fecha_de_creacion']) . '</td>
                <td>
                    <a href="./php/contrato_descargar.php?file=' . urlencode($rows['contrato_nombre_de_imagen']) . '" class="btn btn-success btn-sm">Descargar</a>
                </td>
                <td>
                    <button onclick="confirmarEliminacion(\'' . $rows['contrato_id'] . '\', \'' . urlencode($rows['contrato_nombre_de_imagen']) . '\')" class="btn btn-danger btn-sm">Eliminar</button>
                </td>
            </tr>
        ';
        $contador++;
    }
    $pag_final = $contador - 1;
} else {
    $tabla .= '
        <tr class="has-text-centered">
            <td colspan="5">
                No hay registros en el sistema
            </td>
        </tr>
    ';
}

$tabla .= '</tbody></table></div>';

if ($total > 0 && $pagina <= $Npaginas) {
    $tabla .= '<p class="has-text-right">Mostrando contratos <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
}

echo $tabla;

if ($total >= 1 && $pagina <= $Npaginas) {
    echo paginador_tablas($pagina, $Npaginas, $url, 7);
}

$conexion = null;

echo '
<script>
function confirmarEliminacion(contratoId, fileName) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción no se puede deshacer y eliminará el contrato permanentemente.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "./php/contrato_eliminar.php?contract_id=" + contratoId + "&file=" + encodeURIComponent(fileName);
        }
    });
}
</script>
';
?>
