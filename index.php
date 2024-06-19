<?php
    require "./inc/session_start.php";
    require_once "./php/main.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "./inc/head.php";
    ?>
</head>
<body>
    <?php
    // Definir las vistas permitidas para cada rol
    $vistas_por_rol = [
        'Jefe de Proceso' => ['employee_list', 'user_new', 'user_update', 'user_search', 'user_list', 'employee_new', 'employee_update', 'employee_search', 'employee_contract', 'employee_file', 'contract_new', 'contract_search', 'contract_list', 'holiday_new', 'holiday_search', 'holiday_list', 'logout'],
        'Auxiliar' => ['employee_list', 'employee_new', 'employee_update', 'employee_search', 'employee_contract', 'employee_file', 'contract_new', 'contract_search', 'contract_list', 'logout'],
        'Superadministrador' => ['employee_list', 'user_new', 'user_update', 'user_search', 'employee_contract', 'user_list', 'employee_new', 'employee_update', 'employee_search', 'employee_file', 'contract_new', 'contract_search', 'contract_list', 'holiday_new', 'holiday_search', 'holiday_list', 'backup_new', 'backup_list', 'mail_configuration', 'logout', 'verify_token']
    ];

    // Verificar si la sesión ha expirado por tiempo limite y mostrar la alerta
    if (isset($_GET['expirado']) && $_GET['expirado'] == 1) {
        echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Sesión Expirada',
                    text: 'Tu tiempo de sesión ha expirado. Por favor, inicia sesión nuevamente.',
                    confirmButtonText: 'Aceptar'
                });
              </script>";
    }

    // Determinación de la Vista:
    if (!isset($_GET['vista']) || $_GET['vista'] == "") {
        $_GET['vista'] = "login";
    }

    // Verificación de sesión y rol de usuario
    if (!isset($_SESSION['id']) || $_SESSION['id'] == "" || !isset($_SESSION['nombre']) || $_SESSION['nombre'] == "") {
        if ($_GET['vista'] != "login") {
            include "./vistas/logout.php";
            exit();
        }
    }

    // Obtener el rol del usuario desde la sesión para restringir vistas según el rol de usuario
    if (isset($_SESSION['rol'])) {
        $rol_usuario = $_SESSION['rol'];
        $vistas_permitidas = isset($vistas_por_rol[$rol_usuario]) ? $vistas_por_rol[$rol_usuario] : [];
    } else {
        $vistas_permitidas = [];
    }

    // Carga de Vistas:
    if (is_file("./vistas/".$_GET['vista'].".php") && ($_GET['vista'] == "login" || in_array($_GET['vista'], $vistas_permitidas))) {
        if ($_GET['vista'] != "login") {
            include "./inc/navbar.php";
        }
        include "./vistas/".$_GET['vista'].".php";
    } else {
        include "./vistas/404.php";
    }

    include "./inc/end.php";
    ?>
</body>
</html>
