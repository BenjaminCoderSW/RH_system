<div class="container-fluid mb-3">
    <h3>Buscar empleado</h3>
</div>

<div class="container pb-3 pt-3">
    <?php
        // Incluimos el archivo con las funciones
        require_once "./php/main.php";

        // Si la variable de tipo post llamada modulo_buscador viene definida entonces:
        if(isset($_POST['modulo_buscador'])){
            // Incluye el contenido del valor del archivo buscador.php para buscar
            require_once "./php/buscador.php";
        }

        // Si la variable de sesion llamada busqueda_empleado NO viene definida y esta vacia entonces:
        if(!isset($_SESSION['busqueda_empleado']) && empty($_SESSION['busqueda_empleado']))
        {
    ?>
            <!-- Mostramos el formulario con codigo HTML para realizar la busqueda  -->
            <div class="row">
                <div class="col">
                    <form action="" method="POST" autocomplete="off" >
                        <input type="hidden" name="modulo_buscador" value="empleado">   
                        <div class="form-group d-flex">
                            <input class="form-control me-2" type="text" name="txt_buscador" placeholder="Ingresa cualquier cosa relacionada con el empleado que buscas" >
                            <select name="estado" class="custom-select" id="estado-select">
                                <option value="selecciona">Selecciona un filtro</option>
                                <option value="todos">Ver Todos</option>
                                <option value="Activo">Ver Activos</option>
                                <option value="Inactivo">Ver Inactivos</option>
                            </select>
                            <button class="btn btn-info" type="submit" >Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
    <?php 
        // Sino: Si la variable de sesion llamada busqueda_usuario SI viene definida y NO esta vacia entonces:
        // significa que el usario ya hizo una busqueda en la lupa y presiono el boton entonces:
        }else{
     ?>
    <div class="row">
        <div class="col">
            <form class="text-center mt-3 mb-3" action="" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="empleado"> 
                <input type="hidden" name="eliminar_buscador" value="empleado">
                <p>Tu busqueda fue: <strong>“<?php echo $_SESSION['busqueda_empleado']; ?>”</strong></p>
                <br>
                <button type="submit" class="btn btn-warning rounded-pill">Cancelar búsqueda</button>
            </form>
            <!-- Botón para exportar a Excel -->
            <form action="./php/exportar_empleados.php" method="GET" class="text-center mt-3 mb-3">
                <input type="hidden" name="busqueda" value="<?php echo $_SESSION['busqueda_empleado']; ?>">
                <input type="hidden" name="estado" value="<?php echo $_SESSION['busqueda_empleado_estado']; ?>">
                <button type="submit" class="btn btn-success rounded-pill">Exportar a Excel</button>
            </form>
        </div>
    </div>
    <?php
            # Eliminar empleado #
            // Si la variable de tipo GET viene definida entonces:
            if(isset($_GET['employee_id_del'])){
                // Incluimos el contenido del archivo usuario_eliminar.php
                require_once "./php/empleado_eliminar.php";
            }

            if(!isset($_GET['page'])){
                $pagina=1;
            }else{
                $pagina=(int) $_GET['page'];
                if($pagina<=1){
                    $pagina=1;
                }
            }

            $pagina=limpiar_cadena($pagina);
            $url="index.php?vista=employee_search&page="; /* <== */
            $registros=1;
            $busqueda=$_SESSION['busqueda_empleado']; /* <== */

            if (!isset($_SESSION['busqueda_empleado_estado'])) {
                $estado = 'todos'; // El estado por defecto si no hay búsqueda
            } else {
                $estado = $_SESSION['busqueda_empleado_estado']; // El estado guardado en la sesión
            }
              
            # Paginador usuario #
            require_once "./php/empleado_lista.php";
        } 
    ?>
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

<script src="./js/empleado2.js"></script>
