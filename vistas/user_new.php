<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-5">
                <div class="card-header">
                    <h4>Añadir Nuevo Usuario</h4>
                </div>
                <div class="card-body">
                    <div class="form-rest mb-6 mt-6"></div>
                    <form action="./php/usuario_guardar.php" method="POST" class="FormularioAjax" autocomplete="off"
                        id="formUsuario">
                        <div class="form-group">
                            <label for="Usuario_nombre_completo">Nombre Completo</label>
                            <input type="text" class="form-control" id="Usuario_nombre_completo" name="usuario_nombre"
                                placeholder="Nombre Completo del Usuario" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,200}"
                                maxlength="200">
                        </div>

                        <div class="form-group">
                            <label for="Usuario_email">Email</label>
                            <input type="email" class="form-control" id="Usuario_email" name="usuario_email"
                                placeholder="Email del Usuario" maxlength="80">
                        </div>

                        <div class="form-group">
                            <label for="Usuario_usuario">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="Usuario_usuario" name="usuario_usuario"
                                placeholder="Nombre de Usuario" pattern="[a-zA-Z0-9]{4,50}" maxlength="50">
                        </div>

                        <div class="form-group">
                            <label for="Usuario_clave">Contraseña</label>
                            <input type="password" class="form-control" id="Usuario_clave" name="usuario_clave_1"
                                placeholder="Contraseña" pattern="[a-zA-Z0-9$@.-]{7,255}" maxlength="255">
                        </div>

                        <div class="form-group">
                            <label for="Usuario_clave_2">Confirmar contraseña</label>
                            <input type="password" class="form-control" id="Usuario_clave_2" name="usuario_clave_2"
                                placeholder="Repite tu contraseña" pattern="[a-zA-Z0-9$@.-]{7,255}" maxlength="255">
                        </div>

                        <div class="form-group">
                            <label for="Usuario_rol">Rol de usuario</label>
                            <select class="form-control" id="Usuario_rol" name="usuario_rol">
                                <option value="Superadministrador">Super administrador</option>
                                <option value="Jefe de Proceso">Jefe de Proceso</option>
                                <option value="Auxiliar">Auxiliar</option>
                            </select>
                        </div>

                        <button type="button" class="btn btn-primary" onclick="confirmarRegistro()">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Función para confirmar y enviar el registro de usuario
        function confirmarRegistro() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Confirma si deseas registrar este usuario",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, registrar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData(document.getElementById('formUsuario'));
                    fetch('./php/usuario_guardar.php', {
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
                                    window.location.href = 'index.php?vista=user_list'; // Ajusta según sea necesario
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
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrió un error al procesar tu solicitud.'
                            });
                        });
                }
            });
        }

        const botonGuardar = document.querySelector('button.btn.btn-primary');
        botonGuardar.addEventListener('click', confirmarRegistro);
    });
</script>