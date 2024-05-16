<?php

// Limpiamos de inyección SQL y almacenamos lo que contiene la variable de tipo GET llamada user_id_del en mi variable user_id_del
$user_id_del = limpiar_cadena($_GET['user_id_del']);

// Abrimos la conexión a la base de datos y la almacenamos en la variable $check_usuario
$check_usuario = conexion();
$check_usuario = $check_usuario->query("SELECT usuario_id FROM usuario WHERE usuario_id='$user_id_del'");

// Este if es para saber si existe el usuario que se quiso seleccionar en la base de datos
if ($check_usuario->rowCount() == 1) {
    $eliminar_usuario = conexion();
    $eliminar_usuario = $eliminar_usuario->prepare("DELETE FROM usuario WHERE usuario_id=:id");
    $eliminar_usuario->execute([":id" => $user_id_del]);

    // Si se eliminó un dato entonces:
    if ($eliminar_usuario->rowCount() == 1) {
        echo "<script>
                window.location.href='index.php?vista=user_list&success=1';
              </script>";
    } else {
        echo "<script>
                window.location.href='index.php?vista=user_list&error=1';
              </script>";
    }
    $eliminar_usuario = null;
} else {
    echo "<script>
            window.location.href='index.php?vista=user_list&error=1';
          </script>";
}
$check_usuario = null;
