<?php
require_once "./php/main.php";
$id = (isset($_GET['user_id_up'])) ? $_GET['user_id_up'] : 0;
$id = limpiar_cadena($id);
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-5">
                <div class="card-header">
                    <?php if ($id == $_SESSION['id']) { ?>
                        <h4 class="subtitle">Actualizar datos de mi cuenta</h4>
                    <?php } else { ?>
                        <h4 class="subtitle">Actualizar este usuario</h4>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <?php
                    $check_usuario = conexion();
                    $check_usuario = $check_usuario->query("SELECT * FROM usuario WHERE usuario_id='$id'");

                    if ($check_usuario->rowCount() > 0) {
                        $datos = $check_usuario->fetch();
                        ?>
                        <form action="./php/usuario_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off"
                            id="formUsuarioActualizar">
                            <input type="hidden" name="usuario_id" value="<?php echo $datos['usuario_id']; ?>" required>

                            <div class="form-group">
                                <label for="Usuario_nombre_completo">Nombre Completo</label>
                                <input type="text" class="form-control" id="Usuario_nombre_completo_Update"
                                    name="usuario_nombre" placeholder="Nombre Completo del Usuario"
                                    pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,200}" maxlength="200" required
                                    value="<?php echo $datos['usuario_nombre_completo']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="Usuario_email">Email</label>
                                <input type="email" class="form-control" id="Usuario_email_Update" name="usuario_email"
                                    placeholder="Email del Usuario" maxlength="80"
                                    value="<?php echo $datos['usuario_email']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="Usuario_usuario">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="Usuario_usuario_Update" name="usuario_usuario"
                                    placeholder="Nombre de Usuario" pattern="[a-zA-Z0-9]{4,50}" maxlength="50" required
                                    value="<?php echo $datos['usuario_usuario']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="Usuario_rol">Rol de usuario</label>
                                <select class="form-control" id="Usuario_rol_Update" name="usuario_rol">
                                    <?php
                                    $roles = ['Superadministrador', 'Jefe de Proceso', 'Auxiliar'];
                                    foreach ($roles as $rol) {
                                        echo '<option value="' . $rol . '"' . ($datos['usuario_rol'] == $rol ? ' selected' : '') . '>' . $rol . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <br>
                            <p>SI desea actualizar la clave de este usuario por favor llene los 2 campos. <strong>Si
                                    NO</strong> desea actualizar la clave deje los campos <strong>VACIOS</strong>.</p>
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

                            <br>
                            <?php include "./inc/btn_back.php"; ?>
                            <button type="button" onclick="actualizarUsuario()" class="btn btn-primary">Guardar</button>
                        </form>
                        <?php
                    } else {
                        include "./inc/error_alert.php";
                    }
                    $check_usuario = null;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function actualizarUsuario() {
        const formData = new FormData(document.getElementById('formUsuarioActualizar'));
        fetch('./php/usuario_actualizar.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Actualizado',
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