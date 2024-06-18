<?php

/* Aqui en principal (main vamos a tener todas las funciones que se repiten en el sistema */

#  Conexion a la base de datos de manera local
//  function conexion(){
//      #  Creamos una variable de instancia a la clase PDO y la conexion a la BD inventario dentro de esa variable
//      $pdo = new PDO('mysql:host=localhost;dbname=hr_basededatos','root','Benji2003');
//      return $pdo;
// }

#  Conexion a la base de datos al hosting de la empresa
//function conexion(){
//    #  Creamos una variable de instancia a la clase PDO y la conexion a la BD inventario dentro de esa variable
//    $pdo = new PDO('mysql:host=srv1288.hstgr.io;dbname=u496700722_hr_basededatos','u496700722_benja','hGtH5T!>0X');
//    return $pdo;
// }

#  Conexion a la base de datos de mi hosting
function conexion(){
    #  Creamos una variable de instancia a la clase PDO y la conexion a la BD inventario dentro de esa variable
    $pdo = new PDO('mysql:host=srv867.hstgr.io;dbname=u954703204_hr_basededatos','u954703204_brian','p:0CSIT>l=Y4');
    return $pdo;
}

# Verificar datos
function verificar_datos($filtro, $cadena)
{
    // Si la cadena coincide con el filtro entonces:
    if (preg_match("/^" . $filtro . "$/", $cadena)) {
        return false;
    } else {
        return true;
    }
}

# Limpiar cadenas de texto #
function limpiar_cadena($cadena)
{
    $cadena = trim($cadena);
    $cadena = stripslashes($cadena);
    $cadena = str_ireplace("<script>", "", $cadena);
    $cadena = str_ireplace("</script>", "", $cadena);
    $cadena = str_ireplace("<script src", "", $cadena);
    $cadena = str_ireplace("<script type=", "", $cadena);
    $cadena = str_ireplace("SELECT * FROM", "", $cadena);
    $cadena = str_ireplace("DELETE FROM", "", $cadena);
    $cadena = str_ireplace("INSERT INTO", "", $cadena);
    $cadena = str_ireplace("DROP TABLE", "", $cadena);
    $cadena = str_ireplace("DROP DATABASE", "", $cadena);
    $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
    $cadena = str_ireplace("SHOW TABLES;", "", $cadena);
    $cadena = str_ireplace("SHOW DATABASES;", "", $cadena);
    $cadena = str_ireplace("<?php", "", $cadena);
    $cadena = str_ireplace("?>", "", $cadena);
    $cadena = str_ireplace("--", "", $cadena);
    $cadena = str_ireplace("^", "", $cadena);
    $cadena = str_ireplace("<", "", $cadena);
    $cadena = str_ireplace("[", "", $cadena);
    $cadena = str_ireplace("]", "", $cadena);
    $cadena = str_ireplace("==", "", $cadena);
    $cadena = str_ireplace(";", "", $cadena);
    $cadena = str_ireplace("::", "", $cadena);
    $cadena = trim($cadena);
    $cadena = stripslashes($cadena);
    return $cadena;
}

# Funcion renombrar fotos 
function renombrar_fotos($nombre)
{
    $nombre = str_ireplace(" ", "_", $nombre);
    $nombre = str_ireplace("/", "_", $nombre);
    $nombre = str_ireplace("#", "_", $nombre);
    $nombre = str_ireplace("-", "_", $nombre);
    $nombre = str_ireplace("$", "_", $nombre);
    $nombre = str_ireplace(".", "_", $nombre);
    $nombre = str_ireplace(",", "_", $nombre);
    $nombre = $nombre . "_" . rand(0, 100);
    return $nombre;
}

# Funcion paginador de tablas 
function paginador_tablas($pagina, $Npaginas, $url, $botones)
{
    $tabla = '<nav aria-label="Page navigation"><ul class="pagination">';

    # PARTE DEL BOTON ANTERIOR #
    if ($pagina <= 1) {
        // Botón 'Anterior' deshabilitado
        $tabla .= '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Anterior</a></li>';
    } else {
        // Botón 'Anterior' habilitado
        $tabla .= '<li class="page-item"><a class="page-link" href="' . $url . ($pagina - 1) . '">Anterior</a></li>';
        if ($pagina > 2) { // Si no estamos en la página 2, mostramos la página 1 y puntos suspensivos
            $tabla .= '<li class="page-item"><a class="page-link" href="' . $url . '1">1</a></li>';
            $tabla .= '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
        }
    }

    # PARTE DONDE SE VAN A MOSTRAR LOS BOTONES DEL PAGINADOR #
    $ci = 0;
    for ($i = $pagina; $i <= $Npaginas; $i++) {
        if ($ci >= $botones) {
            break;
        }

        if ($pagina == $i) {
            // Botón de la página actual con color distinto
            $tabla .= '<li class="page-item active"><a class="page-link" href="' . $url . $i . '">' . $i . '</a></li>';
        } else {
            // Botón de otras páginas
            $tabla .= '<li class="page-item"><a class="page-link" href="' . $url . $i . '">' . $i . '</a></li>';
        }
        $ci++;
    }

    # PARTE DEL BOTON SIGUIENTE #
    if ($pagina == $Npaginas) {
        // Botón 'Siguiente' deshabilitado
        $tabla .= '<li class="page-item disabled"><a class="page-link" href="#">Siguiente</a></li>';
    } else {
        if ($pagina < $Npaginas - 1) { // Si no estamos en la penúltima página, mostramos puntos suspensivos y la última página
            $tabla .= '<li class="page-item"><a class="page-link" href="' . $url . $Npaginas . '">' . $Npaginas . '</a></li>';
        }
        // Botón 'Siguiente' habilitado
        $tabla .= '<li class="page-item"><a class="page-link" href="' . $url . ($pagina + 1) . '">Siguiente</a></li>';
    }

    $tabla .= '</ul></nav>';
    return $tabla;
}
