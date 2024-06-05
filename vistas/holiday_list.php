<div class="container-fluid">
  <h2 class="title pl-5 mt-2 mb-2">Vacaciones de los Empleados</h2>
  <?php
  # Incluimos el archivo con nuestras funciones principales #
  require_once "./php/main.php";

  if (!isset($_GET['page'])) {
    $pagina = 1;
  } else {
    $pagina = (int) $_GET['page'];
    if ($pagina <= 1) {
      $pagina = 1;
    }
  }

  $pagina = limpiar_cadena($pagina);
  $url = "index.php?vista=holiday_list&page=";
  $registros = 30;
  $busqueda = "";

  require_once "./php/vacaciones_lista.php";
  ?>
  <br>
</div>