<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Bootstrap</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* Cambiar el color de fondo a tonalidades de gris claro */
    .navbar {
      background: linear-gradient(to right, #E6E6E6, #E6E6E6);
      /* tonalidades de gris claro */
    }
  </style>
</head>
<!-- cambios de benji -->
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <img src="./img/image.png" alt="" width="70" height="60">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsuarios" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-users"></i> Usuarios
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownUsuarios">
            <a class="dropdown-item" href="#"><i class="fas fa-user-plus fa-xs"></i> Añadir usuarios</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><i class="fas fa-eye fa-xs"></i> Ver Todos</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownEmpleados" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-address-card"></i> Empleados
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownEmpleados">
            <a class="dropdown-item" href="#"><i class="fas fa-user-plus fa-xs"></i> Añadir empleado</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><i class="fas fa-eye fa-xs"></i> Ver Todos</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownContratos" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-file-contract"></i> Contratos
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownContratos">
            <a class="dropdown-item" href="#"><i class="fas fa-plus fa-xs"></i> Añadir contrato</a>
            <a class="dropdown-item" href="#"><i class="fas fa-link fa-xs"></i> Asociar contrato</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><i class="fas fa-eye fa-xs"></i> Ver Todos</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownVacaciones" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-umbrella-beach"></i> Vacaciones
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownVacaciones">
            <a class="dropdown-item" href="#"><i class="fas fa-calendar-alt fa-xs"></i> Solicitudes de vacaciones</a>
            <a class="dropdown-item" href="#"><i class="fas fa-calendar-plus fa-xs"></i> Registrar vacaciones</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><i class="fas fa-calendar fa-xs"></i> Calendario de vacaciones</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownReferencias" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-gavel"></i> Referencias y disciplina
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownReferencias">
            <a class="dropdown-item" href="#"> Añadir referencias Laborales</a>
            <a class="dropdown-item" href="#"><i class="fas fa-user-friends fa-xs"></i> Referencias Laborales</a>
            <a class="dropdown-item" href="#"> Añadir a la lista negra</a>
            <a class="dropdown-item" href="#"><i class="fas fa-ban fa-xs"></i> Consultar lista negra</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"> Registrar despido</a>
            <a class="dropdown-item" href="#"><i class="fas fa-door-closed fa-xs"></i> Registro de despidos</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownExpediente" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-folder-open"></i> Expediente
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownExpediente">
            <a class="dropdown-item" href="#"><i class="fas fa-plus fa-xs"></i> Añadir nuevo expediente</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><i class="fas fa-eye fa-xs"></i> Ver todos</a>
          </div>
        </li>
      </ul>
      <!-- Botones de usuario -->
      <div class="my-2 my-lg-0">
        <button class="btn btn-primary mr-1" type="submit"><i class="fas fa-user-circle"></i> Mi cuenta</button>
        <button class="btn btn-danger" type="submit"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</button>
      </div>
    </div>
  </nav>


  <!-- jQuery and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>