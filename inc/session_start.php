<?php
session_name("IV");
session_start();

// Definir tiempo de inactividad en segundos (900 segundos = 15 minutos)
$tiempo_inactividad = 900;

// Comprobar si la variable de tiempo de inactividad está configurada
if (isset($_SESSION['ultimo_acceso'])) {
    // Calcular el tiempo de inactividad
    $inactividad = time() - $_SESSION['ultimo_acceso'];

    // Si el tiempo de inactividad es mayor que el tiempo permitido, cerrar la sesión
    if ($inactividad >= $tiempo_inactividad) {
        session_unset();
        session_destroy();
        header("Location: index.php?vista=login&expirado=1");
        exit();
    }
}

// Actualizar el tiempo de último acceso
$_SESSION['ultimo_acceso'] = time();
?>
