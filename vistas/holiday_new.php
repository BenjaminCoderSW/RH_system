<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 offset-md-3">
            <div class="mb-5">
                <div>
                    <h1>Solicitar Vacaciones</h1>
                </div>

    <form action="../php/solicitar_vacaciones.php" autocomplete="off" id="formVacaciones">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vacaciones_dias_solicitados" name="vacaciones_dias_solicitados">Días solicitados:</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="vacaciones_dia">Dia en que se solicita:</label>
                    <input type="text" class="form-control" id="vacaciones_dia" name="vacaciones_dia">
                </div>

                <div class="form-group">
                    <label for="vacaciones_mes">Mes en que se solicitan:</label>
                    <select class="form-control" id="vacaciones_mes" name="vacaciones_mes">
                        <option value="Enero">Enero</option>
                        <option value="Febrero">Febrero</option>
                        <option value="Marzo">Marzo</option>
                        <option value="Abril">Abril</option>
                        <option value="Mayo">Mayo</option>
                        <option value="Junio">Junio</option>
                        <option value="Julio">Julio</option>
                        <option value="Agosto">Agosto</option>
                        <option value="Septiembre">Septiembre</option>
                        <option value="Octubre">Octubre</option>
                        <option value="Noviembre">Noviembre</option>
                        <option value="Diciembre">Diciembre</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="vacaciones_anio">Año en que se solicitan:</label>
                    <input type="text" class="form-control" id="vacaciones_anio" name="vacaciones_anio">
                </div>
                <div class="mt-2">
                    <h5 class="text-left">Periodo:</h5>
                </div>
                <div>
                    <div class="row row-cols-2 form-group">
                        <div class="col">
                            <input type="text" class="form-control" name="periodo1">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="periodo2">
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" onclick="registrarVacaciones()">Guardar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function registrarVacaciones() {
        const formData = new FormData(document.getElementById('formVacaciones'));
        fetch('../php/solicitar_vacaciones.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Vacaciones registradas exitosamente',
                        text: data.message
                    }).then(() => {
                        // aqui nos redirecciobnamos al listado de usuarios
                        window.location.href = 'index.php?vista=user_list';
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
                    title: 'Error de conexión',
                    text: 'No se pudo establecer conexión con el servidor'
                });
            });
    }
</script>