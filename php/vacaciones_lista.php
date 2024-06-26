<?php
require_once "main.php";

$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

$tabla = "";

$consulta_datos = "SELECT * FROM empleado ORDER BY empleado_nombres ASC LIMIT $inicio,$registros";
$consulta_total = "SELECT COUNT(empleado_id) FROM empleado";

$conexion = conexion();
$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();
$total = $conexion->query($consulta_total);
$total = (int) $total->fetchColumn();
$Npaginas = ceil($total / $registros);

function calcular_dias_vacaciones($dia_ingreso, $mes_ingreso, $anio_ingreso) {
    $fecha_ingreso_str = $anio_ingreso . '-' . $mes_ingreso . '-' . $dia_ingreso;
    $fecha_ingreso = date_create($fecha_ingreso_str);
    $fecha_actual = date_create(date("Y-m-d"));
    $diferencia = date_diff($fecha_ingreso, $fecha_actual);
    $anios_antiguedad = $diferencia->y;

    $dias_vacaciones = 0;
    for ($i = 1; $i <= $anios_antiguedad; $i++) {
        if ($i == 1) {
            $dias_vacaciones += 12;
        } elseif ($i == 2) {
            $dias_vacaciones += 14;
        } elseif ($i == 3) {
            $dias_vacaciones += 16;
        } elseif ($i == 4) {
            $dias_vacaciones += 18;
        } elseif ($i == 5) {
            $dias_vacaciones += 20;
        } elseif ($i >= 6 && $i <= 10) {
            $dias_vacaciones += 22;
        } elseif ($i >= 11 && $i <= 15) {
            $dias_vacaciones += 24;
        } elseif ($i >= 16) {
            $dias_vacaciones += 26;
        }
    }

    return $dias_vacaciones;
}

// Incluir el enlace al archivo CSS para hacer la tabla responsiva
$tabla .= '<link rel="stylesheet" href="../css/estilos2.css">';

$tabla .= '
<div class="table-responsive">
    <table class="table is-hover">
        <thead>
            <tr class="has-text-centered">
                <th>#</th>
                <th>Nombres</th>
                <th>CURP</th>
                <th>RFC</th>
                <th>Cargo</th>
                <th>Dias disponibles para vacaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
';

if ($total >= 1 && $pagina <= $Npaginas) {
    $contador = $inicio + 1;
    $pag_inicio = $inicio + 1;
    foreach ($datos as $rows) {
        $meses = [
            'Enero' => '01', 'Febrero' => '02', 'Marzo' => '03', 'Abril' => '04',
            'Mayo' => '05', 'Junio' => '06', 'Julio' => '07', 'Agosto' => '08',
            'Septiembre' => '09', 'Octubre' => '10', 'Noviembre' => '11', 'Diciembre' => '12'
        ];
        $mes_ingreso_num = $meses[$rows['empleado_mes_de_ingreso']];

        $dias_vacaciones = calcular_dias_vacaciones($rows['empleado_dia_de_ingreso'], $mes_ingreso_num, $rows['empleado_año_de_ingreso']);

        $consulta_vacaciones = $conexion->prepare("SELECT SUM(vacaciones_dias_solicitados) as dias_usados FROM vacaciones WHERE empleado_id = :empleado_id");
        $consulta_vacaciones->bindParam(':empleado_id', $rows['empleado_id'], PDO::PARAM_INT);
        $consulta_vacaciones->execute();
        $resultado_vacaciones = $consulta_vacaciones->fetch(PDO::FETCH_ASSOC);
        $dias_usados = $resultado_vacaciones['dias_usados'] ? (int)$resultado_vacaciones['dias_usados'] : 0;

        $dias_disponibles = $dias_vacaciones - $dias_usados;

        $tabla .= '
            <tr class="has-text-centered">
                <td>' . $contador . '</td>
                <td>' . $rows['empleado_nombres'] . '</td>
                <td>' . $rows['empleado_curp'] . '</td>
                <td>' . $rows['empleado_rfc'] . '</td>
                <td>' . $rows['empleado_puesto_de_trabajo'] . '</td>
                <td>' . $dias_disponibles . '</td>
                <td>
                    <button class="btn btn-sm btn-primary" onclick="mostrarDetallesEmpleado(' . $rows['empleado_id'] . ', \'' . $rows['empleado_nombres'] . '\')"><i class="fas fa-umbrella-beach"></i> Historial</button>
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
?>