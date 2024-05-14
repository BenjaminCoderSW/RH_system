<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contratos - Sistema de RRHH</title>
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

        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
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
        <div class="container-fluid">
            <h2>Lista de Contratos</h2>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Fecha de Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los datos del contrato se deben llenar aquí -->
                    <tr>
                        <td>1</td>
                        <td>Contrato Laboral</td>
                        <td>Contrato indefinido para nuevo empleado.</td>
                        <td>2023-05-01</td>
                        <td>
                            <button class="btn btn-primary btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </td>
                    </tr>
                    <!-- Más contratos -->
                </tbody>
            </table>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>