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
            if (isset($_POST['buscar']) || isset($_GET['page'])) {
                $busqueda = isset($_POST['buscar']) ? limpiar_cadena($_POST['buscar']) : limpiar_cadena($_GET['buscar']);
                $pagina = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                if ($pagina <= 1) {
                    $pagina = 1;
                }
                $url = "index.php?vista=holiday_search&buscar=$busqueda&page=";
                $registros = 10;
                require_once "./php/vacaciones_search.php";
            }
            ?>
        </div>
    </div>
</div>