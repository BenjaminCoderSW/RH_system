<?php

	// Limpiamos de inyeccion SQL y almacenamos lo que contiene la variable de tipo GET llamada user_id_del en mi variable user_id_del
    // la cual se define al presionar el boton de eliminar de un usuario en el listado, ese boton se crea en usuario_lista.php
    $user_id_del=limpiar_cadena($_GET['user_id_del']);

    // Abrimos la conexion a la base de datos y la almacenamos en la variable $check_usuario
    $check_usuario=conexion();
    // Despues hacemos un select del usuario_id de la tabla usuario donde usuario_id sea igual al usuario que estamos pasandole por medio de la variable get 
    // y esa peticion la almacenamos en la variable $check_usuario
    $check_usuario=$check_usuario->query("SELECT usuario_id FROM usuario WHERE usuario_id='$user_id_del'");
    
    // Este if es para saber si existe el usuario que se quizo seleccionar anteriormente en la base de datos
    // Si los datos seleccionados en la consulta es igual a 1 entonces significa que si existe, entonces:
    if($check_usuario->rowCount()==1){

        // Abrimos una segunda conexion a la base de datos y la almacenamos en la variable $eliminar_usuario
	    $eliminar_usuario=conexion();

        // Dentro de la variable $eliminar_usuario ahora vamos a almacenar la consulta delete que dice, elimina
        // de la tabla usuario al usuario con id que le mandamos usando prepare
	    $eliminar_usuario=$eliminar_usuario->prepare("DELETE FROM usuario WHERE usuario_id=:id");

        //Ejecutamos la consulta a la base de datos delete con execute, mandandole el marcador :id con el valor de la variable $user_id_del
	    $eliminar_usuario->execute([":id"=>$user_id_del]);

        // Si se elimino un dato entonces:
	    if($eliminar_usuario->rowCount()==1){
            // Mando una notificacion al usuario de que el usuario se elimno con exito
		    echo '
		        <div class="notification is-info is-light">
		            <strong>¡USUARIO ELIMINADO!</strong><br>
		            Los datos del usuario se eliminaron con exito
		        </div>
		    ';
        }else{
            // Si no se elimino nungun dato entonces:
		    echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    No se pudo eliminar el usuario, por favor intente nuevamente
                </div>
            ';
        }
        // Cierro mi segunda conexion a la base de datos
		$eliminar_usuario=null;
    }else{
        // En caso de que el usuario que se quiere eliminar no existe en la base de datos entonces:
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO que intenta eliminar no existe
            </div>
        ';
    }
    // Cerramos la conexion a la base de datos
    $check_usuario=null;