<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir nuevo contrato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="content container">
    <div class="container-fluid mt-3">
        <h2>Añadir nuevo contrato</h2>
        <form id="contractForm" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="contractType" class="form-label">Nombre del contrato:</label>
                <input type="text" class="form-control" id="contractType" name="contractType" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="contractImage" class="form-label">Subir contrato:</label>
                <input type="file" class="form-control" id="contractImage" name="contractImage" required>
            </div>
            <button type="button" onclick="submitContract()" class="btn btn-primary">Guardar Contrato</button>
        </form>
    </div>
</div>

<script>
function submitContract() {
    const fileInput = document.getElementById('contractImage');
    const file = fileInput.files[0];
    if (file.size > 33554432) { // 32 MB
        Swal.fire('Error', 'El archivo supera el peso máximo de 32 MB.', 'error');
        return;
    }

    const formData = new FormData(document.getElementById('contractForm'));
    fetch('./php/contrato_guardar.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire('Éxito', data.message, 'success').then(() => {
                window.location.href = 'index.php?vista=contract_list';
            });
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(error => Swal.fire('Error', 'No se pudo enviar el formulario: ' + error.message, 'error'));
}

    fetch('./php/contrato_guardar.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire('Éxito', data.message, 'success');
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(error => Swal.fire('Error', 'No se pudo enviar el formulario: ' + error.message, 'error'));
    
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>