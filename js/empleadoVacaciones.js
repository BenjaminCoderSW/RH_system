function mostrarDetallesEmpleado(empleadoId) {
    fetch(`./php/obtener_empleado_id_vacaciones.php?empleado_id=${empleadoId}`)
        .then((response) => response.json())
        .then((data) => {
            let detalles;
            if (data.length > 0) {
                detalles = data.map(vacacion => `
                    <p><strong>Fecha de Solicitud:</strong> ${vacacion.vacaciones_dia_solicitud}-${vacacion.vacaciones_mes_solicitud}-${vacacion.vacaciones_anio_solicitud}</p>
                    <p><strong>Días Solicitados:</strong> ${vacacion.vacaciones_dias_solicitados}</p>
                    <button class="btn btn-danger" onclick="eliminarVacaciones(${vacacion.vacaciones_id}, ${vacacion.vacaciones_dias_solicitados})">Eliminar</button>
                    <hr>
                `).join('');
            } else {
                detalles = '<p>No se han realizado solicitudes de vacaciones.</p>';
            }
  
            document.getElementById("detallesEmpleado").innerHTML = detalles;
            document.getElementById("nombreEmpleadoModal").textContent = "Historial de Vacaciones";
            $("#modalDetallesEmpleado").modal("show");
        })
        .catch((error) => {
            console.error("Error al obtener los detalles del empleado:", error);
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
                            text: data.message
                        });
                    }
                })
                .catch((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error al eliminar la solicitud.'
                    });
                });
        }
    });
  }