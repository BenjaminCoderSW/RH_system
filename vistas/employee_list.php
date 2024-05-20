<div class="container is-fluid mb-6">
    <h2 class="title">Empleados</h2>
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
    $registros = 20;
    $busqueda = "";

    require_once "./php/empleado_lista.php";
    ?>
    <br>
</div>