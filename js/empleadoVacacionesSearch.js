document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.formSubirPDF').forEach(form => {
        form.addEventListener('submit', subirPDF);
    });
});

function validarArchivo(input) {
    const file = input.files[0];
    if (file) {
        const fileType = file.type;
        const fileSize = file.size;
        const allowedTypes = ['application/pdf'];

        if (!allowedTypes.includes(fileType)) {
            alert("Solo se permiten archivos PDF.");
            input.value = ''; // Limpiar el campo de entrada
            return false;
        }

        if (fileSize > 1048576) { // 1MB en bytes
            alert("El archivo debe ser menor a 1MB.");
            input.value = ''; // Limpiar el campo de entrada
            return false;
        }
    }
    return true;
}

function mostrarDetallesVacacion(vacacionId, empleadoNombre) {
    fetch(`./php/obtener_vacacion_id.php?vacacion_id=${vacacionId}`)
        .then((response) => response.json())
        .then((data) => {
            let detalles;
            if (data) {
                detalles = `
                    <p><strong>Fecha de Solicitud:</strong> ${data.vacaciones_dia_solicitud}-${data.vacaciones_mes_solicitud}-${data.vacaciones_anio_solicitud}</p>
                    <p><strong>Días Solicitados:</strong> ${data.vacaciones_dias_solicitados}</p>
                    <form id="formSubirPDF_${data.vacaciones_id}" class="formSubirPDF" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="archivo_pdf" accept=".pdf" ${data.archivo_pdf ? 'style="display:none;"' : ''}>
                                <label class="custom-file-label" for="archivo_pdf">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-upload"></i></button>
                            </div>
                        </div>
                        <input type="hidden" name="vacaciones_id" value="${data.vacaciones_id}">
                    </form>
                    ${data.archivo_pdf ? `
                        <button class="btn btn-outline-success" onclick="descargarPDF('${data.archivo_pdf}')">
                            <i class="fas fa-download"></i>
                        </button>
                        <button class="btn btn-outline-danger" onclick="eliminarPDF(${data.vacaciones_id})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    ` : ''}
                    <hr>
                `;
            } else {
                detalles = '<p>No se encontraron detalles para esta solicitud de vacaciones.</p>';
            }
  
            document.getElementById("detallesEmpleado").innerHTML = detalles;
            document.getElementById("nombreEmpleadoModal").textContent = "Historial de Vacaciones - " + empleadoNombre;
            $("#modalDetallesEmpleado").modal("show");
  
            // Añadir el evento de subida de archivo
            document.querySelectorAll('.formSubirPDF').forEach(form => {
                form.addEventListener('submit', subirPDF);
            });
        })
        .catch((error) => {
            console.error("Error al obtener los detalles de la solicitud de vacaciones:", error);
        });
}

function subirPDF(event) {
    event.preventDefault();
    const form = event.target;
    const fileInput = form.querySelector('input[type="file"]');
    if (!validarArchivo(fileInput)) {
        return;
    }
    const formData = new FormData(form);
    fetch('./php/subir_pdf.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const notification = document.createElement('div');
                notification.className = 'notification is-success is-light';
                notification.innerHTML = `<strong>¡Éxito!</strong> ${data.message}`;
                document.body.appendChild(notification);
                setTimeout(() => {
                    window.location.reload();
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
            notification.innerHTML = `<strong>Error:</strong> Ocurrió un error al subir el archivo.`;
            document.body.appendChild(notification);
        });
}

function descargarPDF(pdfFileName) {
    window.location.href = `./php/descargar_pdf.php?file=${pdfFileName}`;
}

function eliminarPDF(vacacionId) {
    if (confirm('¿Estás seguro de eliminar este archivo?')) {
        fetch(`./php/eliminar_pdf.php?vacacion_id=${vacacionId}`, {
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
                    window.location.reload();
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
            notification.innerHTML = `<strong>Error:</strong> Ocurrió un error al eliminar el archivo.`;
            document.body.appendChild(notification);
        });
    }
}

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
                    window.location.href = 'index.php?vista=holiday_search&buscar=<?php echo $busqueda; ?>&page=<?php echo $pagina; ?>';
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
