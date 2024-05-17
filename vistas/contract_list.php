<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contratos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="content container">
    <div class="container-fluid mt-4">
        <h2>Lista de Contratos</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nombre de Contrato</th>
                    <th>Descripción</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "./php/main.php";
                $conexion = conexion();
                $consulta = $conexion->query("SELECT contrato_id, contrato_tipo_contrato, contrato_descripcion, fecha_de_creacion FROM contrato");
                while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['contrato_tipo_contrato']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['contrato_descripcion']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['fecha_de_creacion']) . "</td>";
                    echo "<td>";
                    echo '<button class="btn btn-primary btn-sm" onclick="editarContrato(' . $row['contrato_id'] . ')">Editar</button> ';
                    echo '<button class="btn btn-danger btn-sm" onclick="eliminarContrato(' . $row['contrato_id'] . ')">Eliminar</button>';
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function eliminarContrato(idContrato) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esto.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`./php/contrato_eliminar.php?id=${idContrato}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Eliminado!',
                            'El contrato ha sido eliminado.',
                            'success'
                        ).then(() => {
                            location.reload();  // Recargar la página para actualizar la lista
                        });
                    } else {
                        Swal.fire(
                            'Error',
                            'No se pudo eliminar el contrato.',
                            'error'
                        );
                    }
                })
                .catch(error => Swal.fire('Error', 'Hubo un problema con la petición: ' + error.message, 'error'));
        }
    });
}
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
