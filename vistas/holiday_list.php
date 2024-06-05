<div class="container-fluid">
  <h2 class="title pl-5 mt-2 mb-2">Vacaciones de los Empleados</h2>
  <?php
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

<!-- Modal -->
<div class="modal fade" id="modalDetallesEmpleado" tabindex="-1" role="dialog" aria-labelledby="modalDetallesEmpleadoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nombreEmpleadoModal">Historial de Vacaciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detallesEmpleado">
        <!-- El historial de vacaciones se mostrará aquí -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="./js/empleadoVacaciones.js"></script>