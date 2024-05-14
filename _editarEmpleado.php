<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
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

        .form-section {
            margin-bottom: 20px;
        }

        .form-section h4 {
            margin-bottom: 15px;
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
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
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
        <div class="container">
            <h2 class="mt-4 mb-3">Editar Empleado</h2>
            <form id="editEmployeeForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-section">
                            <h4>Datos personales:</h4>
                            <div class="mb-3">
                                <label for="nombreCompleto" class="form-label">Nombre Completo:</label>
                                <input type="text" class="form-control" id="nombreCompleto">
                            </div>
                            <div class="mb-3">
                                <label for="sexo" class="form-label">Sexo:</label>
                                <select class="form-control" id="sexo">
                                    <option>Masculino</option>
                                    <option>Femenino</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" id="fechaNacimiento">
                            </div>
                            <div class="mb-3">
                                <label for="lugarNacimiento" class="form-label">Lugar de Nacimiento:</label>
                                <input type="text" class="form-control" id="lugarNacimiento">
                            </div>
                            <div class="mb-3">
                                <label for="estadoCivil" class="form-label">Estado Civil:</label>
                                <select class="form-control" id="estadoCivil">
                                    <option>Casado</option>
                                    <option>Soltero</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="domicilio" class="form-label">Domicilio:</label>
                                <input type="text" class="form-control" id="domicilio">
                            </div>
                        </div>
                        <div class="form-section">
                            <h4>Identificación y salud:</h4>
                            <div class="mb-3">
                                <label for="curp" class="form-label">CURP:</label>
                                <input type="text" class="form-control" id="curp">
                            </div>
                            <div class="mb-3">
                                <label for="rfc" class="form-label">RFC:</label>
                                <input type="text" class="form-control" id="rfc">
                            </div>
                            <div class="mb-3">
                                <label for="nss" class="form-label">Número de Seguro Social:</label>
                                <input type="text" class="form-control" id="nss">
                            </div>
                            <div class="mb-3">
                                <label for="tipoSangre" class="form-label">Tipo de Sangre:</label>
                                <input type="text" class="form-control" id="tipoSangre">
                            </div>
                            <div class="mb-3">
                                <label for="alergias" class="form-label">Alergias:</label>
                                <input type="text" class="form-control" id="alergias">
                            </div>
                            <div class="mb-3">
                                <label for="enfermedades" class="form-label">Enfermedades:</label>
                                <input type="text" class="form-control" id="enfermedades">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-section">
                            <h4>Datos laborales:</h4>
                            <div class="mb-3">
                                <label for="puestoTrabajo" class="form-label">Puesto de Trabajo:</label>
                                <input type="text" class="form-control" id="puestoTrabajo">
                            </div>
                            <div class="mb-3">
                                <label for="fechaIngreso" class="form-label">Fecha de Ingreso:</label>
                                <input type="date" class="form-control" id="fechaIngreso">
                            </div>
                            <div class="mb-3">
                                <label for="fechaTerminoContrato" class="form-label">Fecha de Término de
                                    Contrato:</label>
                                <input type="date" class="form-control" id="fechaTerminoContrato">
                            </div>
                            <div class="mb-3">
                                <label for="lugarServicio" class="form-label">Lugar de Servicio:</label>
                                <input type="text" class="form-control" id="lugarServicio">
                            </div>
                            <div class="mb-3">
                                <label for="numeroContrato" class="form-label">Número de Contrato:</label>
                                <input type="text" class="form-control" id="numeroContrato">
                            </div>
                            <div class="mb-3">
                                <label for="inicioContratoPemex" class="form-label">Inicio de Contrato Pemex:</label>
                                <input type="date" class="form-control" id="inicioContratoPemex">
                            </div>
                            <div class="mb-3">
                                <label for="finContratoPemex" class="form-label">Fin de Contrato Pemex:</label>
                                <input type="date" class="form-control" id="finContratoPemex">
                            </div>
                            <div class="mb-3">
                                <label for="salarioDiarioIntegrado" class="form-label">Salario Diario Integrado:</label>
                                <input type="number" step="0.01" class="form-control" id="salarioDiarioIntegrado">
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado:</label>
                                <select class="form-control" id="estado">
                                    <option>Activo</option>
                                    <option>Inactivo</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="creditoInfonavit" class="form-label">Crédito Infonavit:</label>
                                <input type="checkbox" id="creditoInfonavit">
                            </div>
                        </div>
                        <div class="form-section">
                            <h4>Contacto de Emergencia:</h4>
                            <div class="mb-3">
                                <label for="nombreContactoEmergencia" class="form-label">Nombre de Contacto de
                                    Emergencia:</label>
                                <input type="text" class="form-control" id="nombreContactoEmergencia">
                            </div>
                            <div class="mb-3">
                                <label for="parentezcoContactoEmergencia" class="form-label">Parentezco con el Contacto
                                    de Emergencia:</label>
                                <input type="text" class="form-control" id="parentezcoContactoEmergencia">
                            </div>
                            <div class="mb-3">
                                <label for="telefonoContactoEmergencia" class="form-label">Teléfono de Contacto de
                                    Emergencia:</label>
                                <input type="text" class="form-control" id="telefonoContactoEmergencia">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submitEdit()">Actualizar
                            Empleado</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function submitEdit() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Se actualizará la información del empleado.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, actualizar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simular actualización exitosa del empleado
                    Swal.fire(
                        '¡Actualizado!',
                        'El empleado ha sido actualizado exitosamente.',
                        'success'
                    ).then(() => {
                        // Redirigir a la lista de empleados
                        window.location.href = 'list_employees.php';
                    });
                }
            });
        }
    </script>
</body>

</html>