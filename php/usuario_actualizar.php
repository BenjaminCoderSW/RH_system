<!-- Este archivo va a tener todo lo necesario para ACTUALIZAR un usuario -->
<?php
    // incluimos solo para poder utilizar una vez el archivo que crea la sesion llamada IV
	require_once "../inc/session_start.php";

    // Incluimos el archivo con las funciones importantes
	require_once "main.php";

    // Almacenamos el id del usuario a actualizar mandado desde el formulario del archivo user_update.php en el
    // input con name usuario_id
    $id=limpiar_cadena($_POST['usuario_id']);

    /*== Verificando usuario ==*/

    // Abrimos una conexion a la base de datos
	$check_usuario=conexion();
    // Ahora almacenamos el resultado de la consulta select a la base de datos para poder verificar
    // si el usuario realmente existe en la base de datos mediante su id
	$check_usuario=$check_usuario->query("SELECT * FROM usuario WHERE usuario_id='$id'");

    // Verificamos si el usuario realmente existe en la base de datos mediante su id, a ver si la consulta trajo algun registro
    if($check_usuario->rowCount()<=0){
        // Si el usuario NO existe entonces
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El usuario no existe en el sistema
            </div>
        ';
        // Y detenemos la ejecucion del script
        exit();
    }else{
        //Si el usuario SI existe en la base de datos entonces:
        // Almacenamos los campos del registro que encontro dentro de un array con la funcion fetch en la variable datos
    	$datos=$check_usuario->fetch();
    }
    // Cerramos la conexion a la base de datos
    $check_usuario=null;

    /*== Almacenando datos del usuario ==*/
    // Limpiamos cada dato de inyeccion sql
    $nombre=limpiar_cadena($_POST['usuario_nombre']);
    $email=limpiar_cadena($_POST['usuario_email']);
    $usuario=limpiar_cadena($_POST['usuario_usuario']);
    $rol = limpiar_cadena($_POST['usuario_rol']);
    $clave_1=limpiar_cadena($_POST['usuario_clave_1']);
    $clave_2=limpiar_cadena($_POST['usuario_clave_2']);


    /*== Verificando campos obligatorios del usuario ==*/
    if($nombre=="" || $usuario=="" || $rol==""){
        // Si no se han llenado estos 3 campos obligatorios entonces:
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos (usuario) ==*/
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,200}",$nombre)){
        // Si el nombre NO coincide con el formato solicitado entonces:
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        // Detenemos la ejecucion del script
        exit();
    }

    /*== Verificando email ==*/
    // Si el correo NO esta vacio y si NO coincide con el que tenemos registrado en la base de datos entonces:
    if($email!="" && $email!=$datos['usuario_email']){
        // Verificamos que sea un correo valido
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

            // Creamos una conexion a la base de datos
            $check_email=conexion();
            // Hacemos un select del de usuario_email de la tabla usuario donde usuario_email sea igual al email que tenemos guardado
            $check_email=$check_email->query("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");

            // Si la consulta select Si selecciono un registro de la base de datos entonces:
            if($check_email->rowCount()>0){
                // El correo electronico ya se encuentra registrado
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El correo electrónico ingresado ya se encuentra registrado, por favor elija otro
                    </div>
                ';
                // Detenemos la ejecucion del script
                exit();
            }
            // Cerramos la conexion a la base de datos
            $check_email=null;
        }else{
            // Si la consulta select Si selecciono un registro de la base de datos entonces:
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    Ha ingresado un correo electrónico no valido
                </div>
            ';
            // Detenemos la ejecucion del script
            exit();
        } 
    }

    if(verificar_datos("[a-zA-Z0-9]{4,50}",$usuario)){
        // Si el usuario NO coincide con el formato solicitado entonces:
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO no coincide con el formato solicitado
            </div>
        ';
        // Detenemos la ejecucion del script
        exit();
    }

    /*== Verificando usuario ==*/
    // Verificamos que el usuario del formulario es el mismo que el que tenemos almacenado en la base de datos
    if($usuario!=$datos['usuario_usuario']){
        // Abrimos conexion a la base de datos
	    $check_usuario=conexion();
        // Hacemos una consulta select, selecciona usuario_usuario de la tabla usuario donde el usuario_usuario sea el mismo al que se mando en el formulario
	    $check_usuario=$check_usuario->query("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
        // Si la consulta select si selecciono un dato, significa que esa usuario SI existe en nuestra base de datos, entonces:
	    if($check_usuario->rowCount()>0){
            // Mandaremos una notificacion diciendo que el usuario ya se encuentra registrado
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El USUARIO ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
            // Detenemos la ejecucion del script
	        exit();
	    }
        // Cerrarmos la conexion a la base de datos
	    $check_usuario=null;
    }


    /*== Verificando claves ==*/

    // Si la clave NO viene vacia OR la clave2 NO viene vacia entonces:
    if($clave_1!="" || $clave_2!=""){
        // Veririfamos que ambas tengan el formato correcto que nosotros estamos solicitando
    	if(verificar_datos("[a-zA-Z0-9$@.-]{7,255}",$clave_1) || verificar_datos("[a-zA-Z0-9$@.-]{7,255}",$clave_2)){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                Las CLAVES no coinciden con el formato solicitado
	            </div>
	        ';
            // Detenemos la ejecucion del script
	        exit();
	    }else{
            // En caso de SI tengan el formato correcto:
            // Verificamos si las claves coinciden
		    if($clave_1!=$clave_2){
                // Si las claves son diferentes significa que no coinciden
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ocurrio un error inesperado!</strong><br>
		                Las CLAVES que ha ingresado no coinciden
		            </div>
		        ';
                // Detenemos la ejecucion del script
		        exit();
		    }else{
                // Si las claves NO son diferentes significa que SI coinciden entonces:
                // Encriptamos la clave
		        $clave=password_hash($clave_1,PASSWORD_BCRYPT,["cost"=>10]);
		    }
	    }
    }else{
        // En caso de que clave 1 o clave 2, en caso de que alguna venga vacia entonces:
        // Almacenamos en la variable $clave la clave que tenemos registrada en la base de datos
    	$clave=$datos['usuario_clave'];
    }


    /*== Actualizar datos ==*/
    // Abrimos conexion a la base de datos
    $actualizar_usuario=conexion();
    // Hacemos una consulta para actualizar UPDATE utilizando prepare para mayor seguridad
    // Actualiza de la tabla usuario los campos usuario_nombre, usuario_apellido, usuario_usuario, usuario_clave, usuario_email
    // DONDE usuario_id sea igual al id del usuario que esta enviando el formulario
    // Poniendoles el valor que almacena cada variable ($nombre, $apellido, $usuario, etc..) usando sus marcadores de posicion del array llamado $marcadores
    $actualizar_usuario=$actualizar_usuario->prepare("UPDATE usuario SET usuario_nombre_completo=:nombre,usuario_email=:email,usuario_usuario=:usuario,usuario_rol=:rol,usuario_clave=:clave WHERE usuario_id=:id");

    $marcadores=[
        ":nombre"=>$nombre,
        ":email"=>$email,
        ":usuario"=>$usuario,
        ":rol"=>$rol,
        ":clave"=>$clave,
        ":id"=>$id
    ];

    // Si el usuario se actualizo con exito entonces:
    if($actualizar_usuario->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡USUARIO ACTUALIZADO!</strong><br>
                El usuario se actualizo con exito
            </div>
        ';
    }else{
        // Si no se actualizo con exito entonces:
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el usuario, por favor intente nuevamente
            </div>
        ';
    }
    // Cerramos la conexion a la base de datos
    $actualizar_usuario=null;