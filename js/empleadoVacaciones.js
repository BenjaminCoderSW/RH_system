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

function mostrarDetallesEmpleado(empleadoId, empleadoNombre) {
    fetch(`./php/obtener_empleado_id_vacaciones.php?empleado_id=${empleadoId}`)
        .then((response) => response.json())
        .then((data) => {
            let detalles;
            if (data.length > 0) {
                detalles = data.map(vacacion => `
                    <p><strong>Fecha de Solicitud:</strong> ${vacacion.vacaciones_dia_solicitud}-${vacacion.vacaciones_mes_solicitud}-${vacacion.vacaciones_anio_solicitud}</p>
                    <p><strong>Días Solicitados:</strong> ${vacacion.vacaciones_dias_solicitados}</p>
                    <form id="formSubirPDF_${vacacion.vacaciones_id}" class="formSubirPDF" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="archivo_pdf" accept=".pdf" ${vacacion.archivo_pdf ? 'style="display:none;"' : ''}>
                                <label class="custom-file-label" for="archivo_pdf">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-upload"></i></button>
                            </div>
                        </div>
                        <input type="hidden" name="vacaciones_id" value="${vacacion.vacaciones_id}">
                    </form>
                    ${vacacion.archivo_pdf ? `
                        <button class="btn btn-outline-success" onclick="descargarPDF('${vacacion.archivo_pdf}')">
                            <i class="fas fa-download"></i>
                        </button>
                        <button class="btn btn-outline-danger" onclick="eliminarPDF(${vacacion.vacaciones_id})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    ` : ''}
                    <button class="btn btn-danger" onclick="eliminarVacaciones(${vacacion.vacaciones_id}, ${vacacion.vacaciones_dias_solicitados})">Eliminar</button>
                    <hr>
                `).join('');
            } else {
                detalles = '<p>No se han realizado solicitudes de vacaciones.</p>';
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
            console.error("Error al obtener los detalles del empleado:", error);
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
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: data.message
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al subir el archivo.'
            });
        });
}

function descargarPDF(pdfFileName) {
    window.location.href = `./php/descargar_pdf.php?file=${pdfFileName}`;
}

function eliminarPDF(vacacionId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`./php/eliminar_pdf.php?vacacion_id=${vacacionId}`, {
                method: 'GET',
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Eliminado!',
                            text: data.message,
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message
                        });
                    }
                })
                .catch((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error al eliminar el archivo.'
                    });
                });
        }
    });
}

function eliminarVacaciones(vacacionesId, diasSolicitados) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`./php/eliminar_vacaciones.php?vacaciones_id=${vacacionesId}&dias_solicitados=${diasSolicitados}`, {
                method: 'GET',
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Eliminado!',
                            text: data.message,
                        }).then(() => {
                            window.location.href = 'index.php?vista=holiday_list';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                        });
                    }
                })
                .catch((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error al eliminar la solicitud.',
                    });
                });
        }
    });
}