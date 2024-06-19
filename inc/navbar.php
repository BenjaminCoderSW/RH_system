<?php
  // Incluimos el archivo de main.php con las funciones
	require_once "./php/main.php";

  $id = $_SESSION['id'];//Puedo ocupar las variables de sesion ya que este archivo lo ejecuta index.php
  $check_usuario=conexion();
  $check_usuario=$check_usuario->query("SELECT * FROM usuario WHERE usuario_id='$id'");
  if($check_usuario->rowCount()>0){
    // convertimos los datos que se seleccionaron en un array con fetch y almacenamos ese array en $datos,
    // solo son datos de UN SOLO REGISTRO, por eso ocupamos fetch y no fetchAll
    $datos=$check_usuario->fetch();
  }
  // Si el rol que tiene el usuario que inicio sesion es de jefe de proceso entonces:
  if($datos['usuario_rol'] == "Jefe de Proceso"){
?>
<!-- Se carga un navbar con las opciones para un jefe de proceso -->
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
        <!-- Aqui va a ir el formulario de dias solicitados, fecha y periodo -->
        <a class="dropdown-item" href="index.php?vista=holiday_search"><i class="fas fa-search"></i> Buscar vacaciones de un empleado</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="index.php?vista=holiday_list"><i class="fas fa-eye fa-xs"></i> Ver Todos</a>
      </div>
    </li>
  </ul>

  <!-- Boton de descarga del manual -->
  <a href="Manual.pdf" class="btn btn-success my-2 my-lg-0 mx-2" download>
    <i class="fas fa-file-download"></i> Descargar Manual
  </a>

  <!-- Boton para cerrar sesion -->
  <!-- A este boton le ponemos en el href la direccion para cerrar sesion y salir al login -->
  <a href="index.php?vista=logout" class="my-2 my-lg-0 btn btn-danger">
      <i class="fas fa-sign-out-alt fa-xs"></i> Cerrar sesión
  </a>

</div>
</nav>
<?php
  // Si el rol que tiene el usuario que inicio sesion es de auxiliar entonces:
  }elseif($datos['usuario_rol'] == "Auxiliar"){
?>
<!-- Se carga un navbar con las opciones para un auxiliar -->
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
  </ul>

  <!-- Boton de descarga del manual -->
  <a href="Manual.pdf" class="btn btn-success my-2 my-lg-0 mx-2" download>
    <i class="fas fa-file-download"></i> Descargar Manual
  </a>

  <!-- Boton para cerrar sesion -->
  <!-- A este boton le ponemos en el href la direccion para cerrar sesion y salir al login -->
  <a href="index.php?vista=logout" class="my-2 my-lg-0 btn btn-danger">
      <i class="fas fa-sign-out-alt fa-xs"></i> Cerrar sesión
  </a>

</div>
</nav>
<?php
  // Si el rol que tiene el usuario que inicio sesion es de super administrador entonces:
  }else{
?>
<!-- Se carga un navbar con las opciones para el super administrador -->
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
        <!-- Aqui va a ir el formulario de dias solicitados, fecha y periodo -->
        <a class="dropdown-item" href="index.php?vista=holiday_search"><i class="fas fa-search"></i> Buscar vacaciones de un empleado</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="index.php?vista=holiday_list"><i class="fas fa-eye fa-xs"></i> Ver Todos</a>
      </div>
    </li>

    <!-- Este modulo con estas secciones queda pendiente -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBackups" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-database fa-xs"></i> Base de datos
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdownBackups">
        <a class="dropdown-item" href="index.php?vista=backup_new"><i class="fas fa-database fa-xs"></i> Crear Backup</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="index.php?vista=backup_list"><i class="fas fa-eye fa-xs"></i> Historial de Backups</a>
      </div>
    </li>

    <!-- Este modulo con estas secciones queda pendiente -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownNotificaciones" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-xs"></i> Notificaciones
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdownNotificaciones">
        <a class="dropdown-item" href="index.php?vista=mail_configuration"><i class="fas fa-envelope fa-xs"></i> Configuraciones de correo</a>
      </div>
    </li>

  </ul>

  <!-- Boton de descarga del manual -->
  <a href="Manual.pdf" class="btn btn-success my-2 my-lg-0 mx-2" download>
    <i class="fas fa-file-download"></i> Descargar Manual
  </a>

  <!-- Boton para cerrar sesion -->
  <!-- A este boton le ponemos en el href la direccion para cerrar sesion y salir al login -->
  <a href="index.php?vista=logout" class="my-2 my-lg-0 btn btn-danger">
      <i class="fas fa-sign-out-alt fa-xs"></i> Cerrar sesión
  </a>

</div>
</nav>
<?php
  }
?>

