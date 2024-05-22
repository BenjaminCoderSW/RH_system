<?php
require_once "../inc/session_start.php";
require_once "main.php";

header('Content-Type: application/json');

$conexion = conexion();
$query = "SELECT * FROM empleado ORDER BY empleado_id ASC";
$statement = $conexion->prepare($query);
$statement->execute();
$empleados = $statement->fetchAll(PDO::FETCH_ASSOC);

// Genera la tabla HTML
$tablaHTML = '<table class="table table-hover" id="employeesTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>CURP</th>
                        <th>RFC</th>
                        <th>Número de Seguro Social</th>
                        <th>Cargo</th>
                        <th>Fecha de Ingreso</th>
                        <th>Quién lo Contrató</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

$modalesHTML = '';

foreach ($empleados as $rows) {
    $tablaHTML .= '
        <tr>
            <td>' . $rows['empleado_id'] . '</td>
            <td>' . $rows['empleado_nombre_completo'] . '</td>
            <td>' . $rows['empleado_curp'] . '</td>
            <td>' . $rows['empleado_rfc'] . '</td>
            <td>' . $rows['empleado_nss'] . '</td>
            <td>' . $rows['empleado_puesto_de_trabajo'] . '</td>
            <td>' . $rows['empleado_fecha_de_ingreso'] . '</td>
            <td>' . $rows['empleado_quien_lo_contrato'] . '</td>
            <td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#employeeModal-' . $rows['empleado_id'] . '">Ver Detalles</button>
                <button class="btn btn-danger btn-sm">Eliminar</button>
            </td>
        </tr>';
    
    // Genera el modal para cada empleado
    $modalesHTML .= '
        <div class="modal fade" id="employeeModal-' . $rows['empleado_id'] . '" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="employeeModalLabel">' . $rows['empleado_nombre_completo'] . '</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Sexo:</strong> ' . $rows['empleado_sexo'] . '</p>
                        <p><strong>Fecha de Nacimiento:</strong> ' . $rows['empleado_fecha_de_nacimiento'] . '</p>
                        <p><strong>Lugar de Nacimiento:</strong> ' . $rows['empleado_lugar_de_nacimiento'] . '</p>
                        <p><strong>Estado Civil:</strong> ' . $rows['empleado_estado_civil'] . '</p>
                        <p><strong>Domicilio:</strong> ' . $rows['empleado_domicilio'] . '</p>
                        <p><strong>CURP:</strong> ' . $rows['empleado_curp'] . '</p>
                        <p><strong>RFC:</strong> ' . $rows['empleado_rfc'] . '</p>
                        <p><strong>Número de Seguro Social:</strong> ' . $rows['empleado_nss'] . '</p>
                        <p><strong>Tipo de Sangre:</strong> ' . $rows['empleado_tipo_de_sangre'] . '</p>
                        <p><strong>Alergias:</strong> ' . $rows['empleado_alergias'] . '</p>
                        <p><strong>Enfermedades:</strong> ' . $rows['empleado_enfermedades'] . '</p>
                        <p><strong>Puesto de Trabajo:</strong> ' . $rows['empleado_puesto_de_trabajo'] . '</p>
                        <p><strong>Fecha de Ingreso:</strong> ' . $rows['empleado_fecha_de_ingreso'] . '</p>
                        <p><strong>Fecha de Término de Contrato:</strong> ' . $rows['empleado_fecha_de_termino_de_contrato'] . '</p>
                        <p><strong>Lugar de Servicio:</strong> ' . $rows['empleado_lugar_de_servicio_o_de_proyecto'] . '</p>
                        <p><strong>Número de Contrato:</strong> ' . $rows['empleado_numero_de_contrato'] . '</p>
                        <p><strong>Inicio de Contrato Pemex:</strong> ' . $rows['empleado_inicio_de_contrato_pemex'] . '</p>
                        <p><strong>Fin de Contrato Pemex:</strong> ' . $rows['empleado_fin_de_contrato_pemex'] . '</p>
                        <p><strong>Salario Diario Integrado:</strong> ' . $rows['empleado_salario_diario_integrado'] . '</p>
                        <p><strong>Estado:</strong> ' . $rows['empleado_estado'] . '</p>
                        <p><strong>Crédito Infonavit:</strong> ' . ($rows['empleado_credito_infonavit'] ? "Sí" : "No") . '</p>
                        <p><strong>Nombre de Contacto para Emergencia:</strong> ' . $rows['empleado_nombre_de_contacto_para_emergencia'] . '</p>
                        <p><strong>Parentezco con el Contacto de Emergencia:</strong> ' . $rows['empleado_parentezco_con_el_contacto_de_emergencia'] . '</p>
                        <p><strong>Teléfono de Contacto para Emergencia:</strong> ' . $rows['empleado_telefono_de_contacto_para_emergencia'] . '</p>
                        <p><strong>Contratado por:</strong> ' . $rows['empleado_quien_lo_contrato'] . '</p>
                        <a href="index.php?vista=employee_update" class="btn btn-primary">Editar</a>
                        <button type="button" class="btn btn-success" onclick="showContractGenerationModal()">Generar
                            Contrato</button>
                    </div>
                    <div class="modal-footer">
                    <label for="contractImage" class="form-label">Subir expediente:</label>
                    <input type="file" class="form-control" id="contractImage">
                    <button type="button" class="btn btn-primary" onclick="uploadFile()">Subir</button>
                    <button type="button" class="btn btn-success" onclick="downloadFile()">Descargar</button>

                </div>
                </div>
            </div>
        </div>';
}

$tablaHTML .= '</tbody></table>';

// Empaqueta la tabla y los modales en un único objeto JSONa
echo json_encode(['tabla' => $tablaHTML, 'modales' => $modalesHTML]);
?>
