<div class="container-fluid">
  <h2 class="title pl-5 mt-2 mb-2">Empleados</h2>
  <?php
  # Incluimos el archivo con nuestras funciones principales #
  require_once "./php/main.php";

  # Comprobación de parámetros para mostrar SweetAlert2 #
  if (isset($_GET['success'])) {
    echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "¡Operación exitosa!",
                    text: "El empleado ha sido eliminado correctamente."
                });
              </script>';
  } elseif (isset($_GET['error'])) {
    echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Ocurrió un error!",
                    text: "No se pudo completar la operación. Intente de nuevo."
                });
              </script>';
  }

  # Eliminar empleado #
  if (isset($_GET['employee_id_del'])) {
    require_once "./php/empleado_eliminar.php";
  }

  if (!isset($_GET['page'])) {
    $pagina = 1;
  } else {
    $pagina = (int) $_GET['page'];
    if ($pagina <= 1) {
      $pagina = 1;
    }
  }

  $pagina = limpiar_cadena($pagina);
  $url = "index.php?vista=employee_list&page=";
  $registros = 30;
  $busqueda = "";

  require_once "./php/empleado_lista.php";
  ?>
  <br>
</div>

<div class="modal fade" id="modalDetallesEmpleado" tabindex="-1" role="dialog" aria-labelledby="modalDetallesEmpleadoLabel" aria-hidden="true">
  <div class="modal-dialog modal-personalizado" role="document"> <!-- Cambio aquí -->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalDetallesEmpleadoLabel"><span id="nombreEmpleadoModal"></span></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí se cargarán los detalles del empleado -->
        <div id="detallesEmpleado"></div>
      </div>
      <div class="modal-footer">
      <label for="expedienteArchivo" class="form-label">Subir expediente:</label>
        <input type="file" class="form-control" id="expedienteArchivo" accept=".zip,.rar">
        <button type="button" class="btn btn-primary" onclick="subirExpediente()">
          <i class="fas fa-upload"></i> Subir
        </button>

        <button type="button" class="btn btn-danger" onclick="downloadFile()">
          <i class="fas fa-download"></i> Descargar
        </button>

      </div>
    </div>
  </div>
</div>

<!-- Modal para generar contrato -->
<div class="modal fade" id="modalContratos" tabindex="-1" aria-labelledby="modalContratosLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalContratoslLabel">Generar Contrato</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="mb-3">
          <label for="contractList" class="form-label">Seleccionar Contrato:</label>
          <select class="form-control" id="contractList">

          </select>
        </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" onclick="downloadFile()">
          <i class="fas fa-download"></i> Descargar
        </button>
    </div>
    </div>
  </div>
</div>

<script src="./js/empleado.js"></script>