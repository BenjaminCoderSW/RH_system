<?php
require_once "../inc/session_start.php";
require_once "main.php";

$response = ['status' => 0, 'message' => 'Un error ocurrió'];

$id = limpiar_cadena($_POST['usuario_id']);
$check_usuario = conexion();
$check_usuario = $check_usuario->query("SELECT * FROM usuario WHERE usuario_id='$id'");

if ($check_usuario->rowCount() <= 0) {
    $response['message'] = 'El usuario no existe en el sistema';
} else {
    $datos = $check_usuario->fetch();
    $nombre = limpiar_cadena($_POST['usuario_nombre']);
    $email = limpiar_cadena($_POST['usuario_email']);
    $usuario = limpiar_cadena($_POST['usuario_usuario']);
    $rol = limpiar_cadena($_POST['usuario_rol']);
    $clave_1 = limpiar_cadena($_POST['usuario_clave_1']);
    $clave_2 = limpiar_cadena($_POST['usuario_clave_2']);

    if ($nombre == "" || $usuario == "" || $rol == "") {
        $response['message'] = 'No has llenado todos los campos que son obligatorios';
    } else {
        if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,200}", $nombre)) {
            $response['message'] = 'El NOMBRE no coincide con el formato solicitado';
        } else if ($email != "" && $email != $datos['usuario_email']) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $check_email = conexion();
                $check_email = $check_email->query("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
                if ($check_email->rowCount() > 0) {
                    $response['message'] = 'El correo electrónico ingresado ya se encuentra registrado, por favor elija otro';
                }
                $check_email = null;
            } else {
                $response['message'] = 'Ha ingresado un correo electrónico no válido';
            }
        } else if (verificar_datos("[a-zA-Z0-9]{4,50}", $usuario)) {
            $response['message'] = 'El USUARIO no coincide con el formato solicitado';
        } else if ($usuario != $datos['usuario_usuario']) {
            $check_usuario = conexion();
            $check_usuario = $check_usuario->query("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
            if ($check_usuario->rowCount() > 0) {
                $response['message'] = 'El USUARIO ingresado ya se encuentra registrado, por favor elija otro';
            }
            $check_usuario = null;
        } else if ($clave_1 != "" || $clave_2 != "") {
            if (verificar_datos("[a-zA-Z0-9$@.-]{7,255}", $clave_1) || verificar_datos("[a-zA-Z0-9$@.-]{7,255}", $clave_2)) {
                $response['message'] = 'Las CLAVES no coinciden con el formato solicitado';
            } else if ($clave_1 != $clave_2) {
                $response['message'] = 'Las CLAVES que ha ingresado no coinciden';
            } else {
                $clave = password_hash($clave_1, PASSWORD_BCRYPT, ["cost" => 10]);
            }
        } else {
            $clave = $datos['usuario_clave'];
        }

        if (isset($clave)) {
            $actualizar_usuario = conexion();
            $actualizar_usuario = $actualizar_usuario->prepare("UPDATE usuario SET usuario_nombre_completo=:nombre, usuario_email=:email, usuario_usuario=:usuario, usuario_rol=:rol, usuario_clave=:clave WHERE usuario_id=:id");
            $marcadores = [
                ":nombre" => $nombre,
                ":email" => $email,
                ":usuario" => $usuario,
                ":rol" => $rol,
                ":clave" => $clave,
                ":id" => $id
            ];
            if ($actualizar_usuario->execute($marcadores)) {
                $response['status'] = 1;
                $response['message'] = 'El usuario se actualizó correctamente';
            } else {
                $response['message'] = 'No se pudo actualizar el usuario, por favor intente nuevamente';
            }
            $actualizar_usuario = null;
        }
    }
}
echo json_encode($response);
?>
