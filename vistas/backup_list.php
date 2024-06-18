<!-- vistas/backup_list.php -->
<div class="container mt-5">
    <h2 class="text-center">Historial de Backups</h2>
    <div class="mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre del Backup</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="backupList">
                <!-- Aquí se llenará la lista de backups -->
            </tbody>
        </table>
    </div>
</div>

<script>
    function cargarBackups() {
        fetch('php/listar_backups.php')
            .then(response => response.json())
            .then(data => {
                const backupList = document.getElementById('backupList');
                backupList.innerHTML = '';
                data.backups.forEach((backup, index) => {
                    const rutaRelativa = backup.ruta.replace('../', '');
                    const row = `<tr>
                        <td>${index + 1}</td>
                        <td>${backup.nombre}</td>
                        <td>${backup.fecha}</td>
                        <td>
                            <a href="${rutaRelativa}" class="btn btn-success" download>Descargar</a>
                            <button class="btn btn-danger" onclick="eliminarBackup('${backup.nombre}')">Eliminar</button>
                        </td>
                    </tr>`;
                    backupList.innerHTML += row;
                });
            });
    }

    function eliminarBackup(nombreBackup) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esto.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('php/eliminar_backup.php?nombre=' + nombreBackup)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Eliminado',
                                text: 'El backup se ha eliminado exitosamente.',
                                confirmButtonText: 'Aceptar'
                            });
                            cargarBackups();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un problema al eliminar el backup.',
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    });
            }
        });
    }

    document.addEventListener('DOMContentLoaded', cargarBackups);
</script>
