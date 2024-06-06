<div class="container-fluid mb-3">
    <h3>Buscar contrato</h3>
</div>

<div class="container pb-3 pt-3">
    <?php
        // Incluimos el archivo con las funciones
        require_once "./php/main.php";

        // Si la variable de tipo post llamada modulo_buscador viene definida entonces:
        if(isset($_POST['modulo_buscador'])){
            // Incluye el contenido del archivo buscador.php para buscar
            require_once "./php/buscador.php";
        }

        // Si la variable de sesión llamada busqueda_contrato NO viene definida y está vacía entonces:
        if(!isset($_SESSION['busqueda_contrato']) && empty($_SESSION['busqueda_contrato']))
        {
    ?>
            <!-- Mostramos el formulario con código HTML para realizar la búsqueda -->
            <div class="row">
                <div class="col">
                    <form action="" method="POST" autocomplete="off" >
                        <input type="hidden" name="modulo_buscador" value="contrato">   
                        <div class="form-group d-flex">
                            <input class="form-control me-2" type="text" name="txt_buscador" placeholder="Ingresa cualquier cosa relacionada con el contrato que buscas" >
                            <button class="btn btn-info" type="submit" >Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
    <?php 
        // Sino: Si la variable de sesión llamada busqueda_contrato SI viene definida y NO está vacía entonces:
        // significa que el usuario ya hizo una búsqueda en la lupa y presionó el botón entonces:
        }else{
     ?>
    <div class="row">
        <div class="col">
            <form class="text-center mt-3 mb-3" action="" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="contrato"> 
                <input type="hidden" name="eliminar_buscador" value="contrato">
                <p>Tu búsqueda fue: <strong>“<?php echo $_SESSION['busqueda_contrato']; ?>”</strong></p>
                <br>
                <button type="submit" class="btn btn-warning rounded-pill">Cancelar búsqueda</button>
            </form>
        </div>
    </div>
    <?php
            // Paginador y listado de contratos
            if(!isset($_GET['page'])){
                $pagina=1;
            }else{
                $pagina=(int) $_GET['page'];
                if($pagina<=1){
                    $pagina=1;
                }
            }

            $pagina=limpiar_cadena($pagina);
            $url="index.php?vista=contract_search&page=";
            $registros=30;
            $busqueda=$_SESSION['busqueda_contrato'];

            // Paginador contratos
            require_once "./php/contrato_lista_search.php";
        } 
    ?>
</div>
