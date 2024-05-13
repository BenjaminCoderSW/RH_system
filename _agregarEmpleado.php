<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
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
            <a class="nav-link" href="list_employees.html"><i class="fas fa-home"></i> Empleados</a>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-file-contract"></i> Contratos
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="_nuevoContrato.html">Agregar Contrato</a></li>
                    <li><a class="dropdown-item" href="_listaContratos.html">Lista de Contratos</a></li>
                </ul>
            </div>
            <a class="nav-link" href="_vacaciones.html"><i class="fas fa-umbrella-beach"></i> Vacaciones</a>
            <div class="dropdown">
                <a class="nav-link active dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-users"></i> Usuarios
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="_agregarUsuario.html">Agregar Usuario</a></li>
                    <li><a class="dropdown-item" href="_verUsuarios.html">Ver Usuarios</a></li>
                </ul>
            </div>
            <a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </nav>
    </div>
    <div class="content">
        <div class="container">
            <h2 class="mt-4 mb-3">Añadir Empleado</h2>
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-section">
                            <h4>Datos personales:</h4>
                            <div class="mb-3">
                                <label for="nombreCompleto" class="form-label">Nombre Completo:</label>
                                <input type="text" class="form-control" id="nombreCompleto" name="nombre_completo"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="sexo" class="form-label">Sexo:</label>
                                <select class="form-control" id="sexo" name="sexo" required>
                                    <option>Masculino</option>
                                    <option>Femenino</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="fechaNacimiento" class="form-label">Fecha de nacimiento:</label>
                                <input type="date" class="form-control" id="fechaNacimiento" name="fecha_de_nacimiento"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="lugarNacimiento" class="form-label">Lugar de nacimiento:</label>
                                <input type="text" class="form-control" id="lugarNacimiento" name="lugar_de_nacimiento"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="estadoCivil" class="form-label">Estado civil:</label>
                                <select class="form-control" id="estadoCivil" name="estado_civil" required>
                                    <option>Casado</option>
                                    <option>Soltero</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="domicilio" class="form-label">Domicilio:</label>
                                <input type="text" class="form-control" id="domicilio" name="domicilio" required>
                            </div>
                        </div>
                        <div class="form-section">
                            <h4>Identificación y salud:</h4>
                            <div class="mb-3">
                                <label for="curp" class="form-label">CURP:</label>
                                <input type="text" class="form-control" id="curp" name="curp" required>
                            </div>
                            <div class="mb-3">
                                <label for="rfc" class="form-label">RFC:</label>
                                <input type="text" class="form-control" id="rfc" name="rfc" required>
                            </div>
                            <div class="mb-3">
                                <label for="nss" class="form-label">Número de Seguro Social:</label>
                                <input type="text" class="form-control" id="nss" name="numero_de_seguro_social"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="tipoSangre" class="form-label">Tipo de sangre:</label>
                                <input type="text" class="form-control" id="tipoSangre" name="tipo_de_sangre" required>
                            </div>
                            <div class="mb-3">
                                <label for="alergias" class="form-label">Alergias:</label>
                                <input type="text" class="form-control" id="alergias" name="alergias" required>
                            </div>
                            <div class="mb-3">
                                <label for="enfermedades" class="form-label">Enfermedades:</label>
                                <input type="text" class="form-control" id="enfermedades" name="enfermedades" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-section">
                            <h4>Datos laborales:</h4>
                            <div class="mb-3">
                                <label for="puestoTrabajo" class="form-label">Puesto de trabajo:</label>
                                <input type="text" class="form-control" id="puestoTrabajo" name="puesto_de_trabajo"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="fechaIngreso" class="form-label">Fecha de ingreso:</label>
                                <input type="date" class="form-control" id="fechaIngreso" name="fecha_de_ingreso"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="fechaTerminoContrato" class="form-label">Fecha de término de
                                    contrato:</label>
                                <input type="date" class="form-control" id="fechaTerminoContrato"
                                    name="fecha_de_termino_de_contrato" required>
                            </div>
                            <div class="mb-3">
                                <label for="lugarServicio" class="form-label">Lugar de servicio o de proyecto:</label>
                                <input type="text" class="form-control" id="lugarServicio" name="lugar_de_servicio"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="numeroContrato" class="form-label">Número de contrato:</label>
                                <input type="text" class="form-control" id="numeroContrato" name="numero_de_contrato"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="inicioContratoPemex" class="form-label">Inicio de contrato Pemex:</label>
                                <input type="date" class="form-control" id="inicioContratoPemex"
                                    name="inicio_de_contrato_pemex" required>
                            </div>
                            <div the="mb-3">
                                <label for="finContratoPemex" class="form-label">Fin de contrato Pemex:</label>
                                <input type="date" class="form-control" id="finContratoPemex"
                                    name="fin_de_contrato_pemex" required>
                            </div>
                            <div the="mb-3">
                                <label for="salarioDiarioIntegrado" class="form-label">Salario diario integrado:</label>
                                <input type="number" step="0.01" class="form-control" id="salarioDiarioIntegrado"
                                    name="salario_diario_integrado" required>
                            </div>
                            <div the="mb-3">
                                <label for="estado" class="form-label">Estado:</label>
                                <select class="form-control" id="estado" name="estado" required>
                                    <option>Activo</option>
                                    <option>Inactivo</option>
                                </select>
                            </div>
                            <div the="mb-3">
                                <label for="creditoInfonavit" class="form-label">Crédito Infonavit:</label>
                                <input type="checkbox" id="creditoInfonavit" name="credito_infonavit">
                            </div>
                        </div>
                        <div class="form-section">
                            <h4>Contacto de emergencia:</h4>
                            <div the="mb-3">
                                <label for="nombreContactoEmergencia" the="form-label">Nombre del contacto de
                                    emergencia:</label>
                                <input type="text" class="form-control" id="nombreContactoEmergencia"
                                    name="nombre_de_contacto_para_emergencia" required>
                            </div>
                            <div the="mb-3">
                                <label for="parentezcoContactoEmergencia" the="form-label">Parentezco del contacto con
                                    el empleado:</label>
                                <input type="text" class="form-control" id="parentezcoContactoEmergencia"
                                    name="parentezco_con_el_contacto_de_emergencia" required>
                            </div>
                            <div the="mb-3">
                                <label for="telefonoContactoEmergencia" the="form-label">Teléfono de
                                    emergencia:</label>
                                <input type="text" class="form-control" id="telefonoContactoEmergencia"
                                    name="telefono_de_contacto_para_emergencia" required. </div>
                                <div class="mb-3">
                                    <label for="contratoPersona" class="form-label">¿Quién lo contrató?</label>
                                    <input type="text" class="form-control" id="contratoPersona" name="contrato_persona"
                                        required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Empleado</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelector('form').addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Éxito!',
                text: 'El empleado ha sido contratado exitosamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'list_employees.html'; // Asegúrate de tener la ruta correcta para tu aplicación
                }
            });
        });
    </script>
</body>

</html>