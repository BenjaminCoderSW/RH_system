<div class="container mt-5">
    <h3 class="mb-4">Verificación de Token</h3>

    <form action="./php/verificar_token.php" method="POST">
        <div class="form-group">
            <label for="token">Token de Verificación:</label>
            <input type="text" class="form-control" id="token" name="token" required>
        </div>

        <button type="submit" class="btn btn-primary">Verificar</button>
    </form>
</div>
