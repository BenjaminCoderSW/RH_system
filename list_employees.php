<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados - Sistema de RRHH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .sidebar {
            min-height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
        }

        .search-bar {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="sidebar d-flex flex-column">
        <a href="#" class="navbar-brand text-center py-3">
            <img src="./img/image.png" alt="Logo" style="width: 100px;">
        </a>
        <nav class="nav flex-column">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle active" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-users"></i> Empleados
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="_agregarEmpleado.php">Contratar Empleado</a></li>
                    <li><a class="dropdown-item" href="list_employees.php">Lista de Empleados</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-file-contract"></i> Contratos
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="_nuevoContrato.php">Agregar Contrato</a></li>
                    <li><a class="dropdown-item" href="_listaContratos.php">Lista de Contratos</a></li>
                </ul>
            </div>
            <a class="nav-link" href="_vacaciones.php"><i class="fas fa-umbrella-beach"></i> Vacaciones</a>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-users"></i> Usuarios
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="_agregarUsuario.php">Agregar Usuario</a></li>
                    <li><a class="dropdown-item" href="_verUsuarios.php">Ver Usuarios</a></li>
                </ul>
            </div>
            <a class="nav-link" href="index.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </nav>
    </div>
    <div class="content">
        <nav class="navbar">
            <div class="container-fluid">
                <h1 class="h4">Lista de Empleados</h1>
            </div>
        </nav>
        <div class="search-bar mt-3">
            <input type="text" class="form-control" id="searchEmployee" placeholder="Buscar empleado...">
        </div>
        <div class="container-fluid">
            <table class="table table-hover" id="employeesTable">
                <thead>
                    <tr>
                        <th>ID</th>
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
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Juan Pérez</td>
                        <td>PEJL980401HDFRLL00</td>
                        <td>JPL9804015M5</td>
                        <td>123456789012</td>
                        <td>Analista</td>
                        <td>2023-04-15</td>
                        <td>Maria López</td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="showModal(1)">Ver Detalles</button>
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de detalles del empleado -->
    <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeModalLabel">Detalles del Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>ID:</strong> <span id="modalId"></span></p>
                    <p><strong>Nombre Completo:</strong> <span id="modalNombreCompleto"></span></p>
                    <p><strong>Sexo:</strong> <span id="modalSexo"></span></p>
                    <p><strong>Fecha de Nacimiento:</strong> <span id="modalFechaNacimiento"></span></p>
                    <p><strong>Lugar de Nacimiento:</strong> <span id="modalLugarNacimiento"></span></p>
                    <p><strong>Estado Civil:</strong> <span id="modalEstadoCivil"></span></p>
                    <p><strong>Domicilio:</strong> <span id="modalDomicilio"></span></p>
                    <p><strong>CURP:</strong> <span id="modalCurp"></span></p>
                    <p><strong>RFC:</strong> <span id="modalRfc"></span></p>
                    <p><strong>Número de Seguro Social:</strong> <span id="modalNss"></span></p>
                    <p><strong>Tipo de Sangre:</strong> <span id="modalTipoSangre"></span></p>
                    <p><strong>Alergias:</strong> <span id="modalAlergias"></span></p>
                    <p><strong>Enfermedades:</strong> <span id="modalEnfermedades"></span></p>
                    <p><strong>Puesto de Trabajo:</strong> <span id="modalPuesto"></span></p>
                    <p><strong>Fecha de Ingreso:</strong> <span id="modalFechaIngreso"></span></p>
                    <p><strong>Fecha de Término de Contrato:</strong> <span id="modalFechaTerminoContrato"></span></p>
                    <p><strong>Lugar de Servicio:</strong> <span id="modalLugarServicio"></span></p>
                    <p><strong>Número de Contrato:</strong> <span id="modalNumeroContrato"></span></p>
                    <p><strong>Inicio de Contrato Pemex:</strong> <span id="modalInicioContratoPemex"></span></p>
                    <p><strong>Fin de Contrato Pemex:</strong> <span id="modalFinContratoPemex"></span></p>
                    <p><strong>Salario Diario Integrado:</strong> <span id="modalSalarioDiarioIntegrado"></span></p>
                    <p><strong>Estado:</strong> <span id="modalEstado"></span></p>
                    <p><strong>Crédito Infonavit:</strong> <span id="modalCreditoInfonavit"></span></p>
                    <p><strong>Nombre de Contacto para Emergencia:</strong> <span
                            id="modalNombreContactoEmergencia"></span></p>
                    <p><strong>Parentezco con el Contacto de Emergencia:</strong> <span
                            id="modalParentezcoContactoEmergencia"></span></p>
                    <p><strong>Teléfono de Contacto para Emergencia:</strong> <span
                            id="modalTelefonoContactoEmergencia"></span></p>
                    <p><strong>Contrato Persona:</strong> <span id="modalContratoPersona"></span></p>
                    <a href="_editarEmpleado.php?id=1" class="btn btn-primary">Editar</a>
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
    </div>

    <!-- Modal para generar contrato -->
    <div class="modal fade" id="contractGenerationModal" tabindex="-1" aria-labelledby="contractGenerationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contractGenerationModalLabel">Generar Contrato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="contractList" class="form-label">Seleccionar Contrato:</label>
                        <select class="form-control" id="contractList">
                            <option>Contrato de confidencialidad</option>
                            <option>Contrato de un mes</option>
                            <option>Contrato por proyecto</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="downloadContract()">Descargar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showModal(id) {
            const employeeData = {
                id: id,
                nombre_completo: "Juan Pérez",
                sexo: "Masculino",
                fecha_de_nacimiento: "1980-04-01",
                lugar_de_nacimiento: "Ciudad de México",
                estado_civil: "Casado",
                domicilio: "Calle Falsa 123, Ciudad de México",
                curp: "PEJL980401HDFRLL00",
                rfc: "JPL9804015M5",
                numero_de_seguro_social: "123456789012",
                tipo_de_sangre: "O+",
                alergias: "Polen, polvo",
                enfermedades: "Ninguna",
                puesto_de_trabajo: "Analista",
                fecha_de_ingreso: "2023-04-15",
                fecha_de_termino_de_contrato: "2024-04-14",
                lugar_de_servicio: "Oficina Central",
                numero_de_contrato: "1234",
                inicio_de_contrato_pemex: "2023-05-01",
                fin_de_contrato_pemex: "2024-05-01",
                salario_diario_integrado: 200.00,
                estado: "Activo",
                credito_infonavit: true,
                nombre_de_contacto_para_emergencia: "Maria López",
                parentezco_con_el_contacto_de_emergencia: "Esposa",
                telefono_de_contacto_para_emergencia: "5555555555",
                contrato_persona: "Contrato Indefinido"
            };
            document.getElementById('modalId').textContent = employeeData.id;
            document.getElementById('modalNombreCompleto').textContent = employeeData.nombre_completo;
            document.getElementById('modalSexo').textContent = employeeData.sexo;
            document.getElementById('modalFechaNacimiento').textContent = employeeData.fecha_de_nacimiento;
            document.getElementById('modalLugarNacimiento').textContent = employeeData.lugar_de_nacimiento;
            document.getElementById('modalEstadoCivil').textContent = employeeData.estado_civil;
            document.getElementById('modalDomicilio').textContent = employeeData.domicilio;
            document.getElementById('modalCurp').textContent = employeeData.curp;
            document.getElementById('modalRfc').textContent = employeeData.rfc;
            document.getElementById('modalNss').textContent = employeeData.numero_de_seguro_social;
            document.getElementById('modalTipoSangre').textContent = employeeData.tipo_de_sangre;
            document.getElementById('modalAlergias').textContent = employeeData.alergias;
            document.getElementById('modalEnfermedades').textContent = employeeData.enfermedades;
            document.getElementById('modalPuesto').textContent = employeeData.puesto_de_trabajo;
            document.getElementById('modalFechaIngreso').textContent = employeeData.fecha_de_ingreso;
            document.getElementById('modalFechaTerminoContrato').textContent = employeeData.fecha_de_termino_de_contrato;
            document.getElementById('modalLugarServicio').textContent = employeeData.lugar_de_servicio;
            document.getElementById('modalNumeroContrato').textContent = employeeData.numero_de_contrato;
            document.getElementById('modalInicioContratoPemex').textContent = employeeData.inicio_de_contrato_pemex;
            document.getElementById('modalFinContratoPemex').textContent = employeeData.fin_de_contrato_pemex;
            document.getElementById('modalSalarioDiarioIntegrado').textContent = employeeData.salario_diario_integrado;
            document.getElementById('modalEstado').textContent = employeeData.estado;
            document.getElementById('modalCreditoInfonavit').textContent = employeeData.credito_infonavit ? "Sí" : "No";
            document.getElementById('modalNombreContactoEmergencia').textContent = employeeData.nombre_de_contacto_para_emergencia;
            document.getElementById('modalParentezcoContactoEmergencia').textContent = employeeData.parentezco_con_el_contacto_de_emergencia;
            document.getElementById('modalTelefonoContactoEmergencia').textContent = employeeData.telefono_de_contacto_para_emergencia;
            document.getElementById('modalContratoPersona').textContent = employeeData.contrato_persona;

            new bootstrap.Modal(document.getElementById('employeeModal')).show();
        }

        function showContractGenerationModal() {
            new bootstrap.Modal(document.getElementById('contractGenerationModal')).show();
        }

        function downloadContract() {
            const selectedContract = document.getElementById('contractList').value;
            if (!selectedContract) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Debes seleccionar un contrato antes de descargar.'
                });
                return;
            }
            Swal.fire({
                icon: 'success',
                title: 'Descarga Completada',
                text: 'El contrato ha sido descargado exitosamente.',
                confirmButtonText: 'Aceptar'
            });
        }

        function uploadFile() {
            // Simula la carga de un archivo
            const fileInput = document.getElementById('contractImage');
            if (!fileInput.files.length) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Selecciona un archivo para subir.'
                });
                return;
            }
            // Implementa lógica de carga real aquí
            Swal.fire({
                icon: 'success',
                title: 'Carga Completada',
                text: 'El archivo ha sido cargado exitosamente.',
                confirmButtonText: 'Aceptar'
            });
        }

        function downloadFile() {
            // Simula la descarga de un archivo
            // Implementa lógica de descarga real aquí
            Swal.fire({
                icon: 'success',
                title: 'Descarga Completada',
                text: 'El archivo ha sido descargado exitosamente.',
                confirmButtonText: 'Aceptar'
            });
        }
    </script>
</body>

</html>