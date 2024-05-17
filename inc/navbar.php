<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <a class="navbar-brand" href="index.php?vista=employee_list">
    <img src="./img/logo.png" alt="" width="70" height="60">
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsuarios" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-users fa-xs"></i> Usuarios
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownUsuarios">
          <a class="dropdown-item" href="index.php?vista=user_new"><i class="fas fa-user-plus fa-xs"></i> Añadir usuario</a>
          <a class="dropdown-item" href="index.php?vista=user_search"><i class="fas fa-search"></i> Buscar usuario</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?vista=user_list"><i class="fas fa-eye fa-xs"></i> Ver Todos</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownEmpleados" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-address-card fa-xs"></i> Empleados
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownEmpleados">
          <a class="dropdown-item" href="index.php?vista=employee_new"><i class="fas fa-user-plus fa-xs"></i> Contratar empleado</a>
          <a class="dropdown-item" href="index.php?vista=employee_search"><i class="fas fa-search"></i> Buscar empleado</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?vista=employee_list"><i class="fas fa-eye fa-xs"></i> Ver Todos</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownContratos" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-file-contract fa-xs"></i> Contratos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownContratos">
          <a class="dropdown-item" href="index.php?vista=contract_new"><i class="fas fa-plus fa-xs"></i> Añadir contrato</a>
          <a class="dropdown-item" href="index.php?vista=contract_search"><i class="fas fa-search"></i> Buscar contrato</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?vista=contract_list"><i class="fas fa-eye fa-xs"></i> Ver Todos</a>
        </div>
      </li>

      <!-- Este modulo con estas secciones queda pendiente -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownVacaciones" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-umbrella-beach fa-xs"></i> Vacaciones
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownVacaciones">
          <a class="dropdown-item" href="index.php?vista=holiday_search"><i class="fas fa-search"></i> Ver vacaciones de empleados</a>
        </div>
      </li>

    </ul>

    <!-- Boton para cerrar sesion -->
    <!-- A este boton le ponemos en el href la direccion para cerrar sesion y salir al login -->
    <a href="index.php?vista=logout" class="my-2 my-lg-0 btn btn-danger">
        <i class="fas fa-sign-out-alt fa-xs"></i> Cerrar sesión
    </a>

  </div>
</nav>

