<div class="container is-fluid mb-6">
    <h2 class="title">Usuarios</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
    # Incluimos el archivo con nuestras funciones principales #
    require_once "./php/main.php";

    # Comprobación de parámetros para mostrar SweetAlert2 #
    if (isset($_GET['success'])) {
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "¡Operación exitosa!",
                    text: "El usuario ha sido eliminado correctamente."
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

    # Eliminar usuario #
    if (isset($_GET['user_id_del'])) {
        require_once "./php/usuario_eliminar.php";
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
    $url = "index.php?vista=user_list&page=";
    $registros = 20;
    $busqueda = "";

    require_once "./php/usuario_lista.php";
    ?>
    <br>
</div>