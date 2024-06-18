<?php
require_once "./php/main.php";
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h2 class="mb-4">Buscar Solicitudes de Vacaciones</h2>
            <form action="index.php?vista=holiday_search" method="POST" class="form-inline w-100">
                <div class="form-group mb-2 flex-grow-1">
                    <label for="buscar" class="sr-only">Buscar</label>
                    <input type="text" class="form-control w-100" id="buscar" name="buscar" placeholder="Nombre, CURP, RFC">
                </div>
                <button type="submit" class="btn btn-primary mb-2 ml-2">Buscar</button>
            </form>

            <?php
            if (isset($_POST['buscar']) || isset($_GET['buscar'])) {
                $busqueda = isset($_POST['buscar']) ? limpiar_cadena($_POST['buscar']) : limpiar_cadena($_GET['buscar']);
                $pagina = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                if ($pagina <= 1) {
                    $pagina = 1;
                }
                $url = "index.php?vista=holiday_search&buscar=$busqueda&page=";
                $registros = 30;
                require_once "./php/vacaciones_search.php";
            }
            ?>
        </div>
    </div>
</div>

<!-- Modal para mostrar detalles de vacaciones -->
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

<script src="./js/empleadoVacacionesSearch.js"></script>
