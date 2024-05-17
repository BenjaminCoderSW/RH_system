<?php
require_once "main.php";

$nombre = limpiar_cadena($_POST['usuario_nombre']);
$email = limpiar_cadena($_POST['usuario_email']);
$usuario = limpiar_cadena($_POST['usuario_usuario']);
$clave_1 = limpiar_cadena($_POST['usuario_clave_1']);
$clave_2 = limpiar_cadena($_POST['usuario_clave_2']);
$rol = limpiar_cadena($_POST['usuario_rol']);

if ($nombre == "") {
    echo json_encode(['status' => false, 'message' => 'Debes de ingresar el nombre.']);
    exit();
}

if ($usuario == "") {
    echo json_encode(['status' => false, 'message' => 'Debes ingresar el usuario.']);
    exit();
}

if ($clave_1 == "") {
    echo json_encode(['status' => false, 'message' => 'Debes ingresar una contraseña.']);
    exit();
}

if ($clave_2 == "") {
    echo json_encode(['status' => false, 'message' => 'Debes ingresar la confirmacion de la contraseña.']);
    exit();
}

if ($email == "") {
    echo json_encode(['status' => false, 'message' => 'Debes ingresar un correo electronico.']);
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,200}", $nombre)) {
    echo json_encode(['status' => false, 'message' => 'El NOMBRE no coincide con el formato solicitado.']);
    exit();
}


if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $check_email = conexion();
    $check_email = $check_email->query("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
    if ($check_email->rowCount() > 0) {
        echo json_encode(['status' => false, 'message' => 'El correo ingresado ya se encuentra registrado, elija otro.']);
        exit();
    }
    $check_email = null;
} else {
    echo json_encode(['status' => false, 'message' => 'El CORREO ELECTRÓNICO ingresado no es válido.']);
    exit();
}


if (verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)) {
    echo json_encode(['status' => false, 'message' => 'El USUARIO no coincide con el formato solicitado.']);
    exit();
}

if (verificar_datos("[a-zA-Z0-9$@.-]{7,255}", $clave_1) || verificar_datos("[a-zA-Z0-9$@.-]{7,255}", $clave_2)) {
    echo json_encode(['status' => false, 'message' => 'Las CONTRASEÑAS no coinciden con el formato solicitado.']);
    exit();
}

$check_usuario = conexion();
$check_usuario = $check_usuario->query("SELECT usuario_usuario FROM usuario WHERE usuario_usuario = '$usuario'");
if ($check_usuario->rowCount() > 0) {
    echo json_encode(['status' => false, 'message' => 'El USUARIO ingresado ya se encuentra registrado, elija otro.']);
    exit();
}
$check_usuario = null;

if ($clave_1 != $clave_2) {
    echo json_encode(['status' => false, 'message' => 'Las contraseñas que ha ingresado no coinciden, revise.']);
    exit();
} else {
    $clave = password_hash($clave_1, PASSWORD_BCRYPT, ["cost" => 10]);
}

$guardar_usuario = conexion();
$guardar_usuario = $guardar_usuario->prepare("INSERT into usuario (usuario_nombre_completo, usuario_email, usuario_usuario, usuario_clave, usuario_rol) VALUES(:nombre, :email, :usuario, :clave, :rol)");
$marcadores = [":nombre" => $nombre, ":email" => $email, ":usuario" => $usuario, ":clave" => $clave, ":rol" => $rol];
$guardar_usuario->execute($marcadores);

if ($guardar_usuario->rowCount() == 1) {
    echo json_encode(['status' => true, 'message' => 'El usuario se registró con éxito.']);
} else {
    echo json_encode(['status' => false, 'message' => 'No se pudo registrar el usuario, intente nuevamente.']);
}

$guardar_usuario = null;
