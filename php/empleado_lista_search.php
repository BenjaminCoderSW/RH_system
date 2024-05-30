<?php
// Esta variable va a servir para saber desde donde vamos a empezar a contar los registros que vamos a mostrar en las tablas de usuarios, contendrá el índice 
// Si la página viene definida o sea es mayor a 0 entonces hace el cálculo para saber desde donde contar
// Sino se le agrega el valor 0 a la variable inicio (empezaremos a contar desde el índice 0)
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

// Esta variable llamada tabla va a ir generando toda la tabla con el listado de los usuarios
$tabla = "";

// Filtro entre activos e inactivos
$estado = isset($_GET['estado']) ? $_GET['estado'] : (isset($_SESSION['busqueda_empleado_estado']) ? $_SESSION['busqueda_empleado_estado'] : 'todos');

// Lógica para el filtro de estado
$filtro_estado = "";
if ($estado != "todos") {
    $filtro_estado = " AND empleado_estado = :estado";
}

$consulta_datos = "SELECT * FROM empleado WHERE 1=1 " . $filtro_estado . " ORDER BY empleado_nombres ASC LIMIT $inicio,$registros";
$consulta_total = "SELECT COUNT(empleado_id) FROM empleado WHERE 1=1 " . $filtro_estado;

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

// Preparar y ejecutar consulta total
$stmt = $conexion->prepare($consulta_total);
if ($estado != 'todos') {
    $stmt->bindParam(':estado', $estado);
}
if (isset($busqueda) && $busqueda != "") {
    $stmt->bindParam(':busqueda', $busqueda);
}
$stmt->execute();
$total = (int) $stmt->fetchColumn();

// En la variable Npaginas que estamos creando vamos a almacenar el número de páginas que se tienen que crear en el paginador
// para eso divido la cantidad de datos ($total) entre el número máximo de registros permitidos en cada página ($registros)
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
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
';

// Lo que hace este if es ver si hay registros y si estamos ubicados en una página existente es decir en una página válida.
// Si la cantidad de datos ($total) es mayor o igual a 1 AND la página en la que estamos ubicados ($pagina) es menor o igual al 
// número de páginas que se tienen que crear en el paginador ($Npaginas) entonces:
if ($total >= 1 && $pagina <= $Npaginas) {
    // Sumamos al índice ($inicio) un 1, para que empiece a contar en 1 el primer registro y no en 0 en la tabla y se lo agregamos a la variable ($contador)
    $contador = $inicio + 1;
    // En esta variable se almacenará el número del primer registro en esa página del paginador.
    // Esto para mostrar un mensaje como por ej. Mostrando usuarios del (1) al 5 de un total de 17 registros.
    // Esta variable tendría el número 1 en ese ejemplo, ese mensaje se mostrará debajo de la tabla de los registros en el sistema.
    $pag_inicio = $inicio + 1;
    // Recorremos todos los datos almacenados en el array ($datos) con una variable apenas creada llamada ($rows)
    foreach ($datos as $rows) {
        // Y vamos construyendo las filas($rows) de la tabla de datos, por medio de el nombre de su campo en la base de datos o su clave
        // añadiendo también sus botones para actualizar y eliminar en CADA fila de la tabla que se vaya generando dinámicamente.
        $tabla .= '
            <tr class="has-text-centered">
                <td>' . $contador . '</td>
                <td>' . $rows['empleado_nombres'] . '</td>
                <td>' . $rows['empleado_curp'] . '</td>
                <td>' . $rows['empleado_rfc'] . '</td>
                <td>' . $rows['empleado_nss'] . '</td>
                <td>' . $rows['empleado_puesto_de_trabajo'] . '</td>
                <td>' . $rows['empleado_dia_de_ingreso'] . " de " . $rows['empleado_mes_de_ingreso'] . " del " .$rows['empleado_año_de_ingreso'] . '</td>
                <td>' . $rows['empleado_quien_lo_contrato'] . '</td>
                <td>
                <button class="btn btn-primary btn-sm" onclick="mostrarDetallesEmpleado(\'' . $rows['empleado_id'] . '\')">Detalles</button>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="confirmarEliminacion(\'' . $rows['empleado_id'] . '\', \'' . $url . $pagina . '\')">Eliminar</button>
                </td>
                <td>
                    <a href="index.php?vista=employee_file&employee_id_exp='.$rows['empleado_id'].'" class="btn btn-sm"><i class="fas fa-upload"></i> Expediente </a>
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
    $tabla .= '<p class="has-text-right">Mostrando empleados <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
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
