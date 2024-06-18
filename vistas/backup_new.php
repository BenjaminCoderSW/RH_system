<!-- vistas/backup_new.php -->
<div class="container mt-5">
    <h2 class="text-center">Crear Backup de la Base de Datos</h2>
    <div class="text-center mt-4">
        <button id="crearBackupBtn" class="btn btn-primary">Crear Backup</button>
    </div>
</div>

<script>
    document.getElementById('crearBackupBtn').addEventListener('click', function() {
        fetch('php/crear_backup.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Backup creado',
                        text: 'El backup se ha creado exitosamente.',
                        confirmButtonText: 'Aceptar'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al crear el backup.',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
    });
</script>
