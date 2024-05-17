<?php
require_once "main.php"; 

$response = ['success' => false, 'message' => 'Algo salió mal.'];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['contractImage'])) {
        if ($_FILES['contractImage']['size'] > 33554432) { 
            $response['message'] = 'El archivo supera el peso máximo de 32 MB.';
            echo json_encode($response);
            exit();
        }

        $tipoContrato = limpiar_cadena($_POST['contractType']);
        $descripcion = limpiar_cadena($_POST['description']);
        $archivo = $_FILES['contractImage'];

        $nombreArchivo = $archivo['name'];
        $tipoArchivo = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        // Normaliza el nombre del archivo
        $nombreGuardado = str_replace(" ", "_", $nombreArchivo);

        // Comprueba si el archivo ya existe en la base de datos
        $conexion = conexion();
        $consulta_existencia = $conexion->prepare("SELECT COUNT(*) FROM contrato WHERE contrato_nombre_de_imagen = ?");
        $consulta_existencia->execute([$nombreGuardado]);
        if ($consulta_existencia->fetchColumn() > 0) {
            $response['message'] = 'Un archivo con este nombre ya existe';
            echo json_encode($response);
            exit();
        }

        // Comprueba si el archivo ya existe en el directorio
        if (file_exists("../img/contratos/" . $nombreGuardado)) {
            $response['message'] = 'Un archivo con este nombre ya existe en el servidor.';
            echo json_encode($response);
            exit();
        }

        if ($tipoArchivo == "doc" || $tipoArchivo == "docx" || $tipoArchivo == "pdf") {
            $consulta = $conexion->prepare("INSERT INTO contrato (contrato_tipo_contrato, contrato_descripcion, contrato_nombre_de_imagen, fecha_de_creacion) VALUES (?, ?, ?, NOW())");
            if ($consulta->execute([$tipoContrato, $descripcion, $nombreGuardado])) {
                $rutaGuardado = "../img/contratos/" . $nombreGuardado;
                if (move_uploaded_file($archivo['tmp_name'], $rutaGuardado)) {
                    $response['success'] = true;
                    $response['message'] = 'El contrato ha sido guardado correctamente.';
                } else {
                    $response['message'] = 'Error al guardar el archivo en el servidor.';
                }
            } else {
                $response['message'] = 'No se pudo guardar la información en la base de datos: ' . implode(",", $consulta->errorInfo());
            }
        } else {
            $response['message'] = 'Solo se permiten archivos de tipo Word (.doc, .docx) o PDF.';
        }
    } else {
        $response['message'] = 'No se recibieron datos o el archivo necesario.';
    }
} catch (Exception $e) {
    $response['message'] = 'Error del servidor: ' . $e->getMessage();
}

echo json_encode($response);
?>
