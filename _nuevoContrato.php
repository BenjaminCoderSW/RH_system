<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir nuevo contrato</title>
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
            <img src="/img/image.png" alt="Logo" style="width: 100px;">
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
        <div class="container-fluid">
            <h2>Añadir nuevo contrato</h2>
            <form>
                <div class="mb-3">
                    <label for="employeeName" class="form-label">Nombre del empleado:</label>
                    <input type="text" class="form-control" id="employeeName" placeholder="Buscar...">
                </div>
                <div class="mb-3">
                    <label for="contractType" class="form-label">Tipo de contrato:</label>
                    <input type="text" class="form-control" id="contractType">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción:</label>
                    <textarea class="form-control" id="description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="contractImage" class="form-label">Imagen del contrato:</label>
                    <input type="file" class="form-control" id="contractImage">
                </div>
                <button type="submit" class="btn btn-primary">Guardar Contrato</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>