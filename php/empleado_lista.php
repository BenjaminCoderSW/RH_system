<?php
// Esta variable va a servir para saber desde donde vamos a empezar a contar los registros que vamos a mostrar en las tablas de usuarios, contendra el indice 
// Si la pagina viene definida osea es mayor a 0 entonces hace el calculo para saber desde donde contar
// Sino se le agrega el valor 0 a la variable inicio (empezaremos a contar desde el indice 0)
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

// Esta variable llamada tabla va a ir generando toda la tabla con el listado de los usuarios
$tabla = "";

// Aqui veremos si generaremos el listado con busqueda o el listado normal sin nungun filtro de busqueda
// Si la variable busqueda viene definida y tiene algo almacenado entonces
if (isset($busqueda) && $busqueda != "") {
    $consulta_datos = "SELECT * FROM empleado WHERE ((empleado_nombre_completo LIKE '%$busqueda%' OR empleado_sexo LIKE '%$busqueda%' OR empleado_domicilio LIKE '%$busqueda%' OR empleado_estado_civil LIKE '%$busqueda%' OR empleado_curp LIKE '%$busqueda%' OR empleado_rfc LIKE '%$busqueda%' OR empleado_nss LIKE '%$busqueda%' OR empleado_lugar_de_nacimiento LIKE '%$busqueda%' OR empleado_telefono LIKE '%$busqueda%' OR empleado_tipo_de_sangre LIKE '%$busqueda%' OR empleado_alergias LIKE '%$busqueda%' OR empleado_enfermedades LIKE '%$busqueda%' OR empleado_nombre_de_contacto_para_emergencia LIKE '%$busqueda%' OR empleado_estado LIKE '%$busqueda%' OR empleado_credito_infonavit LIKE '%$busqueda%' OR empleado_salario_diario_integrado LIKE '%$busqueda%' OR empleado_puesto_de_trabajo LIKE '%$busqueda%' OR empleado_lugar_de_servicio_o_de_proyecto LIKE '%$busqueda%' OR empleado_numero_de_contrato LIKE '%$busqueda%' OR empleado_quien_lo_contrato LIKE '%$busqueda%')) ORDER BY empleado_nombre_completo ASC LIMIT $inicio,$registros";
    $consulta_total = "SELECT COUNT(empleado_id) FROM empleado WHERE ((empleado_nombre_completo LIKE '%$busqueda%' OR empleado_sexo LIKE '%$busqueda%' OR empleado_domicilio LIKE '%$busqueda%' OR empleado_estado_civil LIKE '%$busqueda%' OR empleado_curp LIKE '%$busqueda%' OR empleado_rfc LIKE '%$busqueda%' OR empleado_nss LIKE '%$busqueda%' OR empleado_lugar_de_nacimiento LIKE '%$busqueda%' OR empleado_telefono LIKE '%$busqueda%' OR empleado_tipo_de_sangre LIKE '%$busqueda%' OR empleado_alergias LIKE '%$busqueda%' OR empleado_enfermedades LIKE '%$busqueda%' OR empleado_nombre_de_contacto_para_emergencia LIKE '%$busqueda%' OR empleado_estado LIKE '%$busqueda%' OR empleado_credito_infonavit LIKE '%$busqueda%' OR empleado_salario_diario_integrado LIKE '%$busqueda%' OR empleado_puesto_de_trabajo LIKE '%$busqueda%' OR empleado_lugar_de_servicio_o_de_proyecto LIKE '%$busqueda%' OR empleado_numero_de_contrato LIKE '%$busqueda%' OR empleado_quien_lo_contrato LIKE '%$busqueda%'))";
} else {
    $consulta_datos = "SELECT * FROM empleado ORDER BY empleado_nombre_completo ASC LIMIT $inicio,$registros";
    $consulta_total = "SELECT COUNT(empleado_id) FROM empleado";
}

// Creamos la conexion a la BD en la variable conexion usando la funcion conexion() del archivo main.php
$conexion = conexion();
// Hacemos la consulta almacenada en la variable $consulta_datos
$datos = $conexion->query($consulta_datos);
// Y hacemos un array asociativo de todos los registros seleccionados de la consulta, con la funcion fetchAll() en la variable datos
$datos = $datos->fetchAll();
// Hacemos la consulta almacenada en la variable $consulta_total
$total = $conexion->query($consulta_total);
// Y almacenamos el valor de la columna, que nos devolvio la consulta, ya convertido a int en mi variable llamada $total
$total = (int) $total->fetchColumn();

// En la variable Npaginas que estamos creando vamos a almacenar el numero de paginas que se tienen que crear en el paginador
// para eso divido la cantidad de datos ($total) entre el numero maximo de registros permitidos en cada pagina ($registros) osea 15
// Y el resultado lo redondeo con la funcion ceil() a su numero proximo, por ejemplo 2.1 se redondea a 3
$Npaginas = ceil($total / $registros);

$tabla .= '
<div class="table-container">
    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr class="has-text-centered">
                <th>#</th>
                <th>Nombre</th>
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

// Lo que hace este if es ver si hay registros y si estamos ubicados en una pagina existente es decir en una pagina valida.
// Si la cantidad de datos ($total) es mayor o igual a 1 AND la pagina en la que estamos ubicados ($pagina) es menor o igual al 
// numero de paginas que se tienen que crear en el paginador ($Npaginas) entonces:
if ($total >= 1 && $pagina <= $Npaginas) {
    // Sumamos al indice ($inicio) un 1, para que empiece a contar en 1 el primer registro y no en 0 en la tabla y se lo agregamos a la variable ($contador)
    $contador = $inicio + 1;
    // En esta variable se almacenara el numero del primer registro en esa pagina del paginador.
	// Esto para mostrar un mensaje como por ej. Mostrando usuarios del (1) al 5 de un total de 17 registros.
	// Esta variable tendria el numero 1 en ese ejemplo, ese mensaje se mostrara debajo de la tabla de los registros en el sistema.
    $pag_inicio = $inicio + 1;
    // Recorremos todos los datos almacenados en el array ($datos) con una variable apenas creada llamada ($rows)
    foreach ($datos as $rows) {
        // Y vamos construyendo las filas($rows) de la tabla de datos, por medio de el nombre de su campo en la base de datos o su clave
		// añadiendo tambien sus botones para actualizar y eliminar en CADA fila de la tabla que se vaya generando dinamicamente.
        $tabla .= '
            <tr class="has-text-centered">
                <td>' . $contador . '</td>
                <td>' . $rows['empleado_nombre_completo'] . '</td>
                <td>' . $rows['empleado_curp'] . '</td>
                <td>' . $rows['empleado_rfc'] . '</td>
                <td>' . $rows['empleado_nss'] . '</td>
                <td>' . $rows['empleado_puesto_de_trabajo'] . '</td>
                <td>' . $rows['empleado_fecha_de_ingreso'] . '</td>
                <td>' . $rows['empleado_quien_lo_contrato'] . '</td>
                <td>
                    <a href="index.php?vista=employee_update&employee_id_up=' . $rows['empleado_id'] . '" class="btn btn-primary btn-sm">Ver Detalles</a>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="confirmarEliminacion(\'' . $rows['empleado_id'] . '\', \'' . $url . $pagina . '\')">Eliminar</button>
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