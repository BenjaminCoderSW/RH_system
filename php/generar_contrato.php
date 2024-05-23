<?php
require_once "../inc/session_start.php";
require_once "main.php";

$id = limpiar_cadena($_POST['empleado_id']);
$curp = limpiar_cadena($_POST['empleado_curp']);
$tipoDeContrato = limpiar_cadena($_POST['empleado_tipo_de_contrato']);

// lo que tengo pensado es que aqui se haga la conversion de una de las 4 plantillas a pdf con una libreria
// y se decarguen con el nombre o algo asi del empleado para poder identificar de hecho para eso es el curp.

echo "Hola". $curp; // Ya se comprobo que esto si se ve