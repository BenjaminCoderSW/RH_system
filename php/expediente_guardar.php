<?php
require_once "main.php";

$id = limpiar_cadena($_POST['employee_id_exp']);

$conexion = conexion();

// Verificar si el empleado ya tiene un expediente registrado
$stmt = $conexion->prepare("SELECT COUNT(*) FROM expediente WHERE empleado_id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

if ($stmt->fetchColumn() > 0) {
    echo '<div class="notification is-warning is-light">
        <strong>¡Atención!</strong><br>
        Este empleado ya tiene un expediente cargado.
    </div>';
    exit; // Salir si ya existe un expediente para evitar duplicados
}

$exp_dir = '../img/expedientes/';

if ($_FILES['empleado_expediente']['name'] != "" && $_FILES['empleado_expediente']['size'] > 0) {
    if (!file_exists($exp_dir) && !mkdir($exp_dir, 0777, true)) {
        echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            Error al crear el directorio de imágenes
        </div>';
        exit();
    }

    $fileType = mime_content_type($_FILES['empleado_expediente']['tmp_name']);
    $allowedTypes = [
        'application/x-rar-compressed' => '.rar',
        'application/x-rar' => '.rar', // Asegurándonos de incluir este tipo MIME
        'application/zip' => '.zip'
    ];

    if (!array_key_exists($fileType, $allowedTypes)) {
        echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El archivo que ha seleccionado es de un formato que no está permitido (' . $fileType . ')
        </div>';
        exit();
    }

    if ($_FILES['empleado_expediente']['size'] > 20971520) {
        echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El archivo que ha seleccionado supera el límite de peso permitido de 20 MB.
        </div>';
        exit();
    }

    $exp_ext = $allowedTypes[$fileType];
    $exp_nombre = renombrar_fotos($_FILES['empleado_expediente']['name']);
    $expediente = $exp_nombre . $exp_ext;

    if (!move_uploaded_file($_FILES['empleado_expediente']['tmp_name'], $exp_dir . $expediente)) {
        echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No podemos subir el archivo al sistema en este momento, por favor intente nuevamente
        </div>';
        exit();
    }
} else {
    $expediente = "";
}

$stmt = $conexion->prepare("INSERT INTO expediente (expediente_nombre_de_archivo_comprimido, empleado_id) VALUES (:expediente, :id)");
$stmt->bindParam(':expediente', $expediente);
$stmt->bindParam(':id', $id);
$stmt->execute();

if ($stmt->rowCount() == 1) {
    echo '<div class="notification is-info is-light">
        <strong>¡EXPEDIENTE AGREGADO!</strong><br>
        El expediente se subió con éxito
    </div>';
} else {
    if (is_file($exp_dir . $expediente)) {
        unlink($exp_dir . $expediente);
    }
    echo '<div class="notification is-danger is-light">
        <strong>¡Ocurrió un error inesperado!</strong><br>
        No se pudo subir el expediente, por favor intente nuevamente
    </div>';
}
$conexion = null;
?>
