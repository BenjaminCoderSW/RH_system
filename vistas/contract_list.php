<div class="container">
    <h2 class="title">Lista de Contratos</h2>
    <?php
    require_once "./php/main.php";

    // Paginación
    if (!isset($_GET['page'])) {
        $pagina = 1;
    } else {
        $pagina = (int) $_GET['page'];
        if ($pagina <= 1) {
            $pagina = 1;
        }
    }

    $pagina = limpiar_cadena($pagina);
    $url = "index.php?vista=contract_list&page=";
    $registros = 10;
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

    $conexion = conexion();

    // Consulta de datos y total de registros
    $consulta_datos = "SELECT * FROM contrato ORDER BY fecha_de_creacion DESC LIMIT $inicio, $registros";
    $consulta_total = "SELECT COUNT(contrato_id) FROM contrato";

    $datos = $conexion->query($consulta_datos)->fetchAll(PDO::FETCH_ASSOC);
    $total = (int) $conexion->query($consulta_total)->fetchColumn();
    $Npaginas = ceil($total / $registros);
    ?>
    <div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                    <th>#</th>
                    <th>Nombre del Contrato</th>
                    <th>Descripción</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($total >= 1 && $pagina <= $Npaginas) {
                    $contador = $inicio + 1;
                    $pag_inicio = $inicio + 1;
                    foreach ($datos as $rows) {
                        echo '
                        <tr class="has-text-centered">
                            <td>' . $contador . '</td>
                            <td>' . htmlspecialchars($rows['contrato_tipo_contrato']) . '</td>
                            <td>' . htmlspecialchars($rows['contrato_descripcion']) . '</td>
                            <td>' . htmlspecialchars($rows['fecha_de_creacion']) . '</td>
                            <td>
                                <a href="./php/contrato_descargar.php?file=' . urlencode($rows['contrato_nombre_de_imagen']) . '" class="btn btn-success btn-sm">Descargar</a>
                                <button onclick="confirmarEliminacion(\'' . $rows['contrato_id'] . '\', \'' . urlencode($rows['contrato_nombre_de_imagen']) . '\')" class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        ';
                        $contador++;
                    }
                    $pag_final = $contador - 1;
                } else {
                    echo '
                    <tr class="has-text-centered">
                        <td colspan="5">
                            No hay registros en el sistema
                        </td>
                    </tr>
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    if ($total > 0 && $pagina <= $Npaginas) {
        echo '<p class="has-text-right">Mostrando contratos <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
    }

    echo paginador_tablas($pagina, $Npaginas, $url, 7);
    ?>
</div>

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
