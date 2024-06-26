<?php
require_once "./php/main.php";

// Obtener el correo configurado actualmente
$correo_configurado = "";
$config = conexion();
$resultado = $config->query("SELECT correo FROM configuracion LIMIT 1");
if ($resultado->rowCount() > 0) {
    $correo_configurado = $resultado->fetchColumn();
}
$config = null;
?>

<div class="container mt-5">
    <h3 class="mb-4">Configuración de Correo para Notificaciones</h3>

    <form id="correo-form" action="./php/mail_configurar.php" method="POST" class="FormularioAjax" autocomplete="off">
        <div class="form-group">
            <label for="correo_notificaciones">Correo Electrónico:</label>
            <input type="email" class="form-control" id="correo_notificaciones" name="correo_notificaciones" value="<?php echo $correo_configurado; ?>" required>
        </div>

        <button type="submit" name="action" value="guardar" class="btn btn-primary">Guardar</button>
        <?php if ($correo_configurado): ?>
            <button type="button" id="eliminar-correo" class="btn btn-danger">Eliminar</button>
        <?php endif; ?>
    </form>
</div>

<script>
document.getElementById('eliminar-correo').addEventListener('click', function() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('correo-form');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'action';
            input.value = 'eliminar';
            form.appendChild(input);
            form.submit();
        }
    });
});
</script>
