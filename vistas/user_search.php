<div class="container-fluid mb-3">
    <h3>Buscar usuario</h3>
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

        // Si la variable de sesion llamada busqueda_usuario NO viene definida y esta vacia entonces:
        if(!isset($_SESSION['busqueda_usuario']) && empty($_SESSION['busqueda_usuario'])){
            // Mostramos el formulario con codigo HTML para realizar la busqueda 
    ?>
    <div class="row">
        <div class="col">
            <form action="" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="usuario">   
                <div class="form-group d-flex">
                    <input class="form-control me-2" type="text" name="txt_buscador" placeholder="Ingresa cualquier cosa relacionada con el usuario que buscas" maxlength="100" >
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
                <input type="hidden" name="modulo_buscador" value="usuario"> 
                <input type="hidden" name="eliminar_buscador" value="usuario">
                <p>Tu busqueda fue: <strong>“<?php echo $_SESSION['busqueda_usuario']; ?>”</strong></p>
                <br>
                <button type="submit" class="btn btn-warning rounded-pill">Cancelar búsqueda</button>
            </form>
        </div>
    </div>
    <?php
            # Eliminar usuario #
            // Si la variable de tipo GET viene definida entonces:
            if(isset($_GET['user_id_del'])){
                // Incluimos el contenido del archivo usuario_eliminar.php
                require_once "./php/usuario_eliminar.php";
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
            $url="index.php?vista=user_search&page="; /* <== */
            $registros=20;
            $busqueda=$_SESSION['busqueda_usuario']; /* <== */

            # Paginador usuario #
            require_once "./php/usuario_lista.php";
        } 
    ?>
</div>
