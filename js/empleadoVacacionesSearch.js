function eliminarVacaciones(vacacionesId, diasSolicitados) {
    if (confirm('¿Estás seguro de eliminar esta solicitud de vacaciones y su archivo asociado?')) {
        fetch(`./php/eliminar_vacaciones.php?vacaciones_id=${vacacionesId}&dias_solicitados=${diasSolicitados}`, {
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const notification = document.createElement('div');
                notification.className = 'notification is-success is-light';
                notification.innerHTML = `<strong>¡Eliminado!</strong> ${data.message}`;
                document.body.appendChild(notification);
                setTimeout(() => {
                    window.location.href = 'index.php?vista=holiday_list';
                }, 3000);
            } else {
                const notification = document.createElement('div');
                notification.className = 'notification is-danger is-light';
                notification.innerHTML = `<strong>Error:</strong> ${data.message}`;
                document.body.appendChild(notification);
            }
        })
        .catch(error => {
            const notification = document.createElement('div');
            notification.className = 'notification is-danger is-light';
            notification.innerHTML = `<strong>Error:</strong> Ocurrió un error al eliminar la solicitud y el archivo.`;
            document.body.appendChild(notification);
        });
    }
}
