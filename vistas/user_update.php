<?php
    // Incluimos el archivo de main.php con las funciones
	require_once "./php/main.php";

    // Si la variable de tipo GET llamada user_id_up viene definida entonces (?) 
    // En caso de que si venga definida vamos a almacenarle el valor de la variable de tipo GET user_id_up a la variable $id
    // En caso de que no venga defindia vamos a colocarle a la variable $id el valor de 0
    $id = (isset($_GET['user_id_up'])) ? $_GET['user_id_up'] : 0;
    // Limpiamos su contenido de inyeccion sql o html
    $id=limpiar_cadena($id);
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-5">

                <div class="card-header">
                    <!-- Si el id es igual al id se la sesion iniciada osea a la variable de sesion llamada id  significa que quiere actualizar su propia cuenta-->
                    <?php if($id==$_SESSION['id']){ ?>
                        <!-- Entonces se van a poner los titulos de la cuenta del usuario -->
                        <h4 class="subtitle">Actualizar datos de mi cuenta</h4>
                    <!-- En caso de que no -->
                    <?php }else{ ?>
                        <!-- Significa que quiere actualizar un usuario que no es el suyo, y el contenido de los titulos sera diferente -->
                        <h4 class="subtitle">Actualizar este usuario</h4>
                    <?php } ?>
                </div>

                <div class="card-body">

                <?php
                    /*== Verificando usuario ==*/
                    // Hacemos la conexion a la base de datos almacenada en $check_usuario
                    $check_usuario=conexion();
                    // Hacemos una consulta select de todo en la tabla usuario donde usuario_id coincida con el id que tenemos almacenado en $id
                    $check_usuario=$check_usuario->query("SELECT * FROM usuario WHERE usuario_id='$id'");

                    // Si el select anterior selecciono algun registro, eso quiere decir que el id almacenado en $id si existe entonces
                    if($check_usuario->rowCount()>0){
                        // convertimos los datos que se seleccionaron en un array con fetch y almacenamos ese array en $datos, 
                        // solo son datos de UN SOLO REGISTRO, por eso ocupamos fetch y no fetchAll
                        $datos=$check_usuario->fetch();
                ?>

                    <!-- Aqui vamos a obtener la respuesta del formulario via ajax de abajo, por eso el div vacio tiene la clase form-rest con
                    la que trabajamos en el archivo llamado ajax.js -->
                    <div class="form-rest mb-6 mt-6"></div>

                    <!-- Aqui en este formulario tenemos la clase FormularioAjax para enviar los datos por via ajax usando el archivo ajax.php -->
	                <!-- igual tenemos en action (a que archivo se van a mandar los datos) en este caso a usuario_actualizar.php de la carpeta php -->
                    <form action="./php/usuario_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off"
                        id="formUsuarioActualizar">

                        <!-- A traves de este input vamos a mandar el id del usuario a actualizar, al archivo llamado usuario_actulizar.php -->
		                <input type="hidden" name="usuario_id" value="<?php echo $datos['usuario_id']; ?>" required >
                        
                        <div class="form-group">
                            <label for="Usuario_nombre_completo">Nombre Completo</label>
                            <input type="text" class="form-control" id="Usuario_nombre_completo_Update" name="usuario_nombre"
                                placeholder="Nombre Completo del Usuario" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,200}"
                                maxlength="200" required value="<?php echo $datos['usuario_nombre_completo']; ?>" >
                        </div>

                        <div class="form-group">
                            <label for="Usuario_email">Email</label>
                            <input type="email" class="form-control" id="Usuario_email_Update" name="usuario_email"
                                placeholder="Email del Usuario" maxlength="80" value="<?php echo $datos['usuario_email']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Usuario_usuario">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="Usuario_usuario_Update" name="usuario_usuario"
                                placeholder="Nombre de Usuario" pattern="[a-zA-Z0-9]{4,50}" maxlength="50" 
                                required value="<?php echo $datos['usuario_usuario']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Usuario_rol">Rol de usuario</label>
                            <select class="form-control" id="Usuario_rol_Update" name="usuario_rol">
                                <?php 
                                    if($datos['usuario_rol'] == "Superadministrador"){
                                ?>
                                        <option value="Superadministrador">Super administrador</option>
                                        <option value="Jefe de Proceso">Jefe de Proceso</option>
                                        <option value="Auxiliar">Auxiliar</option>
                                <?php
                                    }elseif($datos['usuario_rol'] == "Jefe de Proceso"){
                                ?>
                                        <option value="Jefe de Proceso">Jefe de Proceso</option>
                                        <option value="Superadministrador">Super administrador</option>
                                        <option value="Auxiliar">Auxiliar</option>
                                <?php    
                                    }else{
                                ?>
                                        <option value="Auxiliar">Auxiliar</option>
                                        <option value="Jefe de Proceso">Jefe de Proceso</option>
                                        <option value="Superadministrador">Super administrador</option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <br>
                        <p>
                            SI desea actualizar la clave de este usuario por favor llene los 2 campos. <strong>Si NO</strong> desea actualizar la clave deje los campos <strong>VACIOS</strong>.
                        </p>
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

                        <?php 
                            // Incluimos el boton que tenemos para retroceder de la carpeta inc
                            include "./inc/btn_back.php";
                        ?>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        
                    </form>
                    <?php 
                        // Si el select anterior NO selecciono algun registro, eso quiere decir que el id almacenado en $id NO existe entonces:
                        }else{
                            // Incluimos el codigo html del mensaje de error
                            include "./inc/error_alert.php";
                        }
                        // Cerramos la conexion a la base de datos
                        $check_usuario=null;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>