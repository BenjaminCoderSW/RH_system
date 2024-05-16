<?php
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";

if (isset($busqueda) && $busqueda != "") {
    $consulta_datos = "SELECT * FROM usuario WHERE ((usuario_nombre_completo LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%' OR usuario_clave LIKE '%$busqueda%' OR usuario_rol LIKE '%$busqueda%')) ORDER BY usuario_nombre_completo ASC LIMIT $inicio,$registros";
    $consulta_total = "SELECT COUNT(usuario_id) FROM usuario WHERE ((usuario_nombre_completo LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%' OR usuario_clave LIKE '%$busqueda%' OR usuario_rol LIKE '%$busqueda%'))";
} else {
    $consulta_datos = "SELECT * FROM usuario ORDER BY usuario_nombre_completo ASC LIMIT $inicio,$registros";
    $consulta_total = "SELECT COUNT(usuario_id) FROM usuario";
}

$conexion = conexion();
$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();
$total = $conexion->query($consulta_total);
$total = (int) $total->fetchColumn();
$Npaginas = ceil($total / $registros);

$tabla .= '
<div class="table-container">
    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr class="has-text-centered">
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th colspan="2">Acciones</th>
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
                <td>' . $rows['usuario_nombre_completo'] . '</td>
                <td>' . $rows['usuario_email'] . '</td>
                <td>' . $rows['usuario_usuario'] . '</td>
                <td>' . $rows['usuario_rol'] . '</td>
                <td>
                    <a href="index.php?vista=user_update&user_id_up=' . $rows['usuario_id'] . '" class="btn btn-primary btn-sm">Editar</a>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="confirmarEliminacion(\'' . $rows['usuario_id'] . '\', \'' . $url . $pagina . '\')">Eliminar</button>
                </td>
            </tr>
        ';
        $contador++;
    }
    $pag_final = $contador - 1;
} else {
    if ($total >= 1) {
        $tabla .= '
            <tr class="has-text-centered">
                <td colspan="7">
                    <a href="' . $url . '1" class="button is-link is-rounded is-small mt-4 mb-4">
                        Haga clic acá para recargar el listado
                    </a>
                </td>
            </tr>
        ';
    } else {
        $tabla .= '
            <tr class="has-text-centered">
                <td colspan="7">
                    No hay registros en el sistema
                </td>
            </tr>
        ';
    }
}

$tabla .= '</tbody></table></div>';

if ($total > 0 && $pagina <= $Npaginas) {
    $tabla .= '<p class="has-text-right">Mostrando usuarios <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
}

echo $tabla;

if ($total >= 1 && $pagina <= $Npaginas) {
    echo paginador_tablas($pagina, $Npaginas, $url, 7);
}

$conexion = null;

// Script JS para SweetAlert2
echo '
<script>
function confirmarEliminacion(userId, redirectUrl) {
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
            window.location.href = redirectUrl + "&user_id_del=" + userId;
        }
    });
}
</script>
';