<?php
require_once "main.php";

$contractType = limpiar_cadena($_POST['contractType']);
$description = limpiar_cadena($_POST['description']);

$conexion = conexion();

// Verificar si ya existe un contrato con el mismo nombre
$stmt = $conexion->prepare("SELECT COUNT(*) FROM contrato WHERE contrato_tipo_contrato = :contractType");
$stmt->bindParam(':contractType', $contractType);
$stmt->execute();
if ($stmt->fetchColumn() > 0) {
    echo '<div class="notification is-warning is-light">
        <strong>¡Atención!</strong><br>
        Ya existe un contrato con este nombre. Por favor, use un nombre diferente.
    </div>';
    echo '<script>
            setTimeout(function() {
                window.location.href = "../index.php?vista=contract_new";
            }, 3000);
        </script>';
    exit();
}

// Directorio donde se almacenarán los contratos
$contrato_dir = '../img/contratos/';

if ($_FILES['contractImage']['name'] != "" && $_FILES['contractImage']['size'] > 0) {
    if (!file_exists($contrato_dir) && !mkdir($contrato_dir, 0777, true)) {
        echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            Error al crear el directorio de contratos
        </div>';
        echo '<script>
            setTimeout(function() {
                window.location.href = "../index.php?vista=contract_new";
            }, 3000);
        </script>';
        exit();
    }

    $fileType = mime_content_type($_FILES['contractImage']['tmp_name']);
    $allowedTypes = [
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => '.docx',
        'application/msword' => '.doc',
        'application/pdf' => '.pdf'
    ];

    if (!array_key_exists($fileType, $allowedTypes)) {
        echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El archivo que ha seleccionado es de un formato que no está permitido (' . $fileType . ')
        </div>';
        echo '<script>
            setTimeout(function() {
                window.location.href = "../index.php?vista=contract_new";
            }, 3000);
        </script>';
        exit();
    }

    if ($_FILES['contractImage']['size'] > 2097152) { // 2MB
        echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El archivo que ha seleccionado supera el límite de peso permitido de 2 MB.
        </div>';
        echo '<script>
            setTimeout(function() {
                window.location.href = "../index.php?vista=contract_new";
            }, 3000);
        </script>';
        exit();
    }

    // Generar un nombre único para el archivo y limpiar caracteres problemáticos
    $contract_ext = $allowedTypes[$fileType];
    $contract_nombre = pathinfo($_FILES['contractImage']['name'], PATHINFO_FILENAME);
    $contract_nombre = preg_replace('/[^a-zA-Z0-9_-]/', '_', $contract_nombre);
    $documento = $contract_nombre . '_' . time() . $contract_ext;

    if (!move_uploaded_file($_FILES['contractImage']['tmp_name'], $contrato_dir . $documento)) {
        echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No podemos subir el archivo al sistema en este momento, por favor intente nuevamente
        </div>';
        echo '<script>
            setTimeout(function() {
                window.location.href = "../index.php?vista=contract_new";
            }, 3000);
        </script>';
        exit();
    }
} else {
    echo '<div class="notification is-danger is-light">
        <strong>¡Ocurrió un error inesperado!</strong><br>
        No se ha seleccionado ningún archivo.
    </div>';
    echo '<script>
            setTimeout(function() {
                window.location.href = "../index.php?vista=contract_new";
            }, 3000);
        </script>';
    exit();
}

$stmt = $conexion->prepare("INSERT INTO contrato (contrato_tipo_contrato, contrato_descripcion, contrato_nombre_de_imagen, fecha_de_creacion) VALUES (:contractType, :description, :documento, NOW())");
$stmt->bindParam(':contractType', $contractType);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':documento', $documento);
$stmt->execute();

if ($stmt->rowCount() == 1) {
    echo '<div class="notification is-info is-light">
        <strong>¡CONTRATO AGREGADO!</strong><br>
        El contrato se subió con éxito
    </div>';
    echo '<script>
        setTimeout(function() {
            window.location.href = "../index.php?vista=contract_list";
        }, 3000);
    </script>';
} else {
    if (is_file($contrato_dir . $documento)) {
        unlink($contrato_dir . $documento);
    }
    echo '<div class="notification is-danger is-light">
        <strong>¡Ocurrió un error inesperado!</strong><br>
        No se pudo subir el contrato, por favor intente nuevamente
    </div>';
}

$conexion = null;
?>
