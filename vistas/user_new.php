<div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mb-5">
                    <div class="card-header">
                        <h4>Añadir Nuevo Usuario</h4>
                    </div>
                    <div class="card-body">

                        <!-- En este div vamos a mostrar la respuesta que nos devuelva el archivo que va a procesar los datos 
                        a traves de AJAX osea el archivo ajax.js a traves de la clase form-rest -->
                        <div class="form-rest mb-6 mt-6"></div>

                        <!-- En el action del formulario colocamos la ruta a la que queremos que se vayan estos datos al
                        enviarlos, y en la clase colocamos FormularioAjax ya que es la clase que tengo en ajax.js -->
                        <form action="./php/usuario_guardar.php" method="POST" class="FormularioAjax" autocomplete="off">

                            <!-- Nombre Completo del Usuario -->
                            <div class="form-group">
                                <label for="Usuario_nombre_completo">Nombre Completo</label>
                                <input type="text" class="form-control" id="Usuario_nombre_completo" name="usuario_nombre" placeholder="Nombre Completo del Usuario" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,200}" maxlength="200" >
                            </div>

                            <!-- Email del Usuario -->
                            <div class="form-group">
                                <label for="Usuario_email">Email</label>
                                <input type="email" class="form-control" id="Usuario_email" name="usuario_email" placeholder="Email del Usuario" maxlength="80" >
                            </div>

                            <!-- Nombre de Usuario -->
                            <div class="form-group">
                                <label for="Usuario_usuario">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="Usuario_usuario" name="usuario_usuario" placeholder="Nombre de Usuario" pattern="[a-zA-Z0-9]{4,50}" maxlength="50"  >
                            </div>

                            <!-- Clave del Usuario -->
                            <div class="form-group">
                                <label for="Usuario_clave">Contraseña</label>
                                <input type="password" class="form-control" id="Usuario_clave" name="usuario_clave_1" placeholder="Contraseña" pattern="[a-zA-Z0-9$@.-]{7,255}" maxlength="255"  >
                            </div>

                            <!-- Repetir Clave del Usuario para confirmar -->
                            <div class="form-group">
                                <label for="Usuario_clave_2">Confirmar contraseña</label>
                                <input type="password" class="form-control" id="Usuario_clave_2" name="usuario_clave_2" placeholder="Repite tu contraseña" pattern="[a-zA-Z0-9$@.-]{7,255}" maxlength="255"  >
                            </div>

                            <!-- Rol del Usuario -->
                            <div class="form-group">
                                <label for="Usuario_rol">Rol de usuario</label>

                                <select class="form-control" id="Usuario_rol" name="usuario_rol">
                                    <option value="Superadministrador" >Super administrador</option>
                                    <option value="Jefe de Proceso" >Jefe de Proceso</option>
                                    <option value="Auxiliar" >Auxiliar</option>
                                </select>
                            </div>

                            <!-- Botones de acción -->
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>