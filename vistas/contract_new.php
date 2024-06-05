<div class="content container">
    <div class="container-fluid mt-3">
        <h2>Añadir nuevo contrato</h2>
        <form id="contractForm" action="./php/contrato_guardar.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="contractType" class="form-label">Nombre del contrato:</label>
                <input type="text" class="form-control" id="contractType" name="contractType" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="contractImage" class="form-label">Subir contrato en word o pdf MAX 2MB</label>
                <input type="file" class="form-control" id="contractImage" name="contractImage" accept=".doc,.docx,.pdf" required>
            </div>
            <button type="submit" class="btn btn-primary">Almacenar Contrato</button>
        </form>
    </div>
</div>
