<?php
// Asegúrate de que los datos necesarios están presentes
if (!isset($datosEmpleado)) {
    echo "Datos del empleado no disponibles.";
    return;
}

// Extrae los datos necesarios de la base de datos para llenar la plantilla
$nombres = $datosEmpleado['empleado_nombres'];
$apellidoPaterno = $datosEmpleado['empleado_apellido_paterno'];
$apellidoMaterno = $datosEmpleado['empleado_apellido_materno'];
$sexo = $datosEmpleado['empleado_sexo'];
$estadoCivil = $datosEmpleado['empleado_estado_civil'];
$domicilio = $datosEmpleado['empleado_domicilio'];
$curp = $datosEmpleado['empleado_curp'];
$nss = $datosEmpleado['empleado_nss'];
$diaDeIngreso = $datosEmpleado['empleado_dia_de_ingreso'];
$mesDeIngreso = $datosEmpleado['empleado_mes_de_ingreso'];
$anioDeIngreso = $datosEmpleado['empleado_año_de_ingreso'];
$fechaDeTerminoDeContrato = $datosEmpleado['empleado_fecha_de_termino_de_contrato'];
$cargo = $datosEmpleado['empleado_puesto_de_trabajo'];
$salario = $datosEmpleado['empleado_salario_diario_integrado'];
$salarioConLetra = $datosEmpleado['empleado_salario_diario_integrado_escrito'];
$nombreEmergencia = $datosEmpleado['empleado_nombre_de_contacto_para_emergencia'];
$parentezcoEmergencia = $datosEmpleado['empleado_parentezco_con_el_contacto_de_emergencia'];
$telefonoEmergencia = $datosEmpleado['empleado_telefono_de_contacto_para_emergencia'];
$tipoDeSangre = $datosEmpleado['empleado_tipo_de_sangre'];
$creditoInfonavit = $datosEmpleado['empleado_credito_infonavit'];
$lugarDeServicio = $datosEmpleado['empleado_lugar_de_servicio_o_de_proyecto'];
$empresaDireccion = $datosEmpleado['empleado_domicilio_empresa'];
// Se ocupa tambien la ciudad y estado y ubicacion en la que va a trabajar

// EN TODA ESTA PARTE CALCULAMOS LA EDAD DEL EMPLEADO
if (isset($datosEmpleado['empleado_fecha_de_nacimiento']) && !empty($datosEmpleado['empleado_fecha_de_nacimiento'])) {
    $fechaNacimientoStr = $datosEmpleado['empleado_fecha_de_nacimiento'];
    $meses = [
        'Enero' => '01',
        'Febrero' => '02',
        'Marzo' => '03',
        'Abril' => '04',
        'Mayo' => '05',
        'Junio' => '06',
        'Julio' => '07',
        'Agosto' => '08',
        'Septiembre' => '09',
        'Octubre' => '10',
        'Noviembre' => '11',
        'Diciembre' => '12'
    ];

    // Extraer día, mes y año
    if (preg_match('/(\d{1,2}) de (\w+) de (\d{4})/', $fechaNacimientoStr, $matches)) {
        $dia = $matches[1];
        $mes = $meses[$matches[2]];
        $anio = $matches[3];
        $fechaNacimiento = "$anio-$mes-$dia";
        
        try {
            $fechaNacimientoObj = new DateTime($fechaNacimiento);
            $hoy = new DateTime();
            $edad = $hoy->diff($fechaNacimientoObj)->y;
            echo $edad;
        } catch (Exception $e) {
            echo 'Error al crear el objeto DateTime: ',  $e->getMessage();
        }
    } else {
        echo 'Formato de fecha de nacimiento no válido.';
    }
} else {
    echo 'Fecha de nacimiento no disponible o no válida.';
}

// Aquí empieza el contenido de la plantilla del CONTRATO
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Convenio de Tiempo Determinado</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif; /* Lista de fuentes alternativas */
            font-size: 12px;
            margin: 40px;
        }
        .justificado{
            text-align: justify;
            text-justify: inter-word;
            line-height: 20px;
        }
        .sangria{
            text-indent: 35px;
        }
        .prefijo {
            display: inline-block; /* Hace que el span se comporte como un bloque pero en línea */
            width: 50px;          /* Establece un ancho fijo para el prefijo */
        }
        .prefijo2 {
            display: inline-block; /* Hace que el span se comporte como un bloque pero en línea */
            width: 27px;          /* Establece un ancho fijo para el prefijo */
        }
        .sub-tituloCentrado {
            text-align: center;
            font-size: 13px;
        }
        .centrado{
            text-align: center;
        }
        .pieDePagina{
            text-align: right;
        }
        .negritas{
            font-weight: bold;
        }
        .margen-solo-izquierdo{
            margin-left: 25px;
        }
        .apartadoArticulo{
            margin-left: 40px;
            margin-right: 40px;
        }
        .rojo-blanco{
            background-color: red;
            color: white;
        }
        .letraBlanca{
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse; /* Elimina el espacio entre los bordes */
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid black; /* Añade bordes sólidos a cada celda */
        }
        th, td {
            empty-cells: show; /* Asegura que las celdas vacías muestren bordes */
        }
        .white{
            color: white;
        }
        .red-box {
            background-color: red;
            color: white;
            text-align: center;
            padding: 5px;
            font-weight: bold;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table,
        .table th,
        .table td {
            border: 1px solid black;
        }
        .anexo10{
            color: grey;
        }
        .puntitos{
            font-size: 20px;
        }
        .table th,
        .table td {
            padding: 5px;
            text-align: left;
        }

        .signature-block {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 30px;
            line-height: 1.2;
        }
    </style>
</head>
<body>
    <div class="header justificado">
        <p>CONTRATO INDIVIDUAL DE TRABAJO POR TIEMPO DETERMINADO QUE CELEBRAN, POR UNA PARTE <strong>CONSTRUCTORA ATZCO, 
            S.A DE C.V.</strong>, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ <strong>“LA EMPRESA”</strong> Y POR LA OTRA, <strong><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " .$nombres; ?> </strong>POR
             SU PROPIO DERECHO, A QUIEN SE LE DENOMINARÁ <strong>“EL TRABAJADOR ( A )”</strong>, DE CONFORMIDAD CON LAS SIGUIENTES 
             DECLARACIONES Y SUBSECUENTES CLÁUSULAS.
        </p>
    </div>
    <div class="content">
        <div class="justificado">
            <div class="sub-tituloCentrado" ><strong>DECLARACIONES:</strong></div>
            <p><strong>I.- DECLARA “LA EMPRESA”:</strong></p>
            <p><span class="prefijo">a)</span> Ser una sociedad mercantil debidamente constituida conforme a las leyes mexicanas, y estar debidamente inscrita ante el Registro Público de la Propiedad y del Comercio de la ciudad de Salamanca, estado de Guanajuato.</p>
            <p><span class="prefijo">b)</span> Tener su domicilio en Boulevard Paseo De Los Insurgentes #902 Int. 7 Colonia Jardines Del Moral León, Gto.</p>
            <p><strong>II.- DECLARA “EL TRABAJADOR ( A )”:</strong></p>
            <p><span class="prefijo2">a)</span> Llamarse como ha quedado escrito en el encabezado de este contrato.</p>
            <p><span class="prefijo2">b)</span> Ser de nacionalidad Mexicana.</p>
            <p><span class="prefijo2">c)</span> Ser de sexo <?php echo $sexo; ?>.</p>
            <p><span class="prefijo2">d)</span> Ser su estado civil <?php echo $estadoCivil; ?>.</p>
            <p><span class="prefijo2">e)</span> Mayor de edad.</p>
            <p><span class="prefijo2">f)</span> Tener su domicilio en <strong><?php echo $domicilio; ?></strong>, y que es que señala para recibir notificaciones por parte de “LA EMPRESA”.</p>
            <p><span class="prefijo2">g)</span> Que su número de CURP es <?php echo $curp; ?>, y su número de afiliación ante el Instituto Mexicano del Seguro Social es <?php echo $nss; ?>.</p>
            <p><span class="prefijo2">h)</span> Que no tiene enfermedad ni incapacidad física o mental alguna que imposibilite para desempeñar el trabajo para el que se le contrata.</p>
            <p><span class="prefijo2">i)</span> Que cuenta con la capacidad, conocimientos y experiencia necesarios para prestar sus servicios personales en los términos del presente contrato.</p>
            <p>En virtud de lo anterior, ambas PARTES convienen en obligarse de acuerdo con las siguientes:</p>
            <div class="sub-tituloCentrado" ><strong>CLAUSULAS:</strong></div>
            <p><strong>PRIMERA.- </strong>"EL TRABAJADOR (A)" se obliga a prestar a "LA EMPRESA" sus servicios por <u>CONTRATO DETERMINADO</u> a partir del día <?php echo $diaDeIngreso . " de " . $mesDeIngreso . " de " . $anioDeIngreso; ?> AL <?php echo $fechaDeTerminoDeContrato; ?>, para desempeñar el cargo  de: <?php echo $cargo; ?> que ejecutará en el domicilio ubicado en MONTES URALES NO. 107 de la ciudad de GUANAJUATO la cual una vez concluido el periodo de tiempo establecido en el presente contrato terminará la vigencia del mismo. "EL TRABAJADOR ( A )" prestará dichos servicios de forma subordinada bajo la dirección de los </p>
            <p class="pieDePagina" >1</p>
            <p>funcionarios designados al efecto, aceptando ejecutar al mismo tiempo aquellas labores similares y conexas, así como las que se deriven de los usos y prácticas, además de las señaladas en las disposiciones relativas en los procedimientos de trabajo, y administración del personal que "LA EMPRESA" tiene establecidos en relación a las actividades contratadas.</p>
            <p><strong>SEGUNDA.- </strong>"EL TRABAJADOR ( A )" prestará sus servicios a "LA EMPRESA" en el domicilio ubicado en <?php echo $empresaDireccion; ?>  y/o cualquiera de sus oficinas o sucursales ubicadas en el interior de la República Mexicana, por lo que previo su consentimiento podrá "LA EMPRESA" realizar los cambios necesarios al respecto, de acuerdo con sus necesidades, sin menoscabo de la categoría o salario asignados a "EL TRABAJADOR ( A )". Cuando por la naturaleza del trabajo "EL TRABAJADOR ( A )" tuviera que desempeñarlo fuera de las Instalaciones de "LA EMPRESA" deberá rendir un informe detallado de las labores y actividades desempeñadas en el local o empresa que se le asigne por parte de "LA EMPRESA", según las necesidades de ésta última.</p>
            <p><strong>TERCERA.- </strong>"EL TRABAJADOR ( A )" conviene con "LA EMPRESA", en prestar sus servicios dentro de las jornadas máximas previstas en la Ley Federal del Trabajo. Como consecuencia de lo anterior "EL TRABAJADOR ( A )" se obliga a prestar sus servicios indistintamente dentro de dichas jornadas, que podrán ser distribuidas semanalmente de acuerdo con las necesidades de "LA EMPRESA" sin exceder los límites legales establecidos en los artículos 59, 60 y 61 de la Ley Federal de Trabajo vigente. Los tiempos de descanso durante la jornada de trabajo "EL TRABAJADOR ( A )" podrá disfrutarlos fuera de la fuente de trabajo, de conformidad con lo establecido en el artículo 63 de la ley de la materia.</p>
            <p>Asimismo, el trabajador ( a ) conviene con "LA EMPRESA" que ésta podrá realizar, de manera temporal, la reducción del número de horas de la jornada de trabajo asignada a "EL TRABAJADOR ( A )", así como el ajuste correspondiente al salario a éste asignado dependiendo de las horas a laborar por el mismo, de acuerdo con las necesidades de "LA EMPRESA", considerando las exigencias del mercado de la industria al que "LA EMPRESA" provee de servicios y productos. No obstante estas reducciones de carácter temporal, sea su duración cual fuere, no sentarán precedente ni obligación para "LA EMPRESA", y una vez que resuelta sea la problemática que orillo a "LA EMPRESA" a la reducción de la jornada de trabajo y ajuste realizado al salario de "EL TRABAJADOR ( A )", "LA EMPRESA" restablecerá tanto la jornada de trabajo como el salario asignado a "EL TRABAJADOR ( A )" en las mismas condiciones previas a la reducción temporal referida.</p>
            <p><strong>CUARTA.- </strong>Las partes convienen que la retribución que se pagará a "EL TRABAJADOR ( A )" por sus servicios será una cuota diaria de $ <strong><?php echo $salario; ?>, <?php echo $salarioConLetra; ?></strong> o la cantidad que de acuerdo con el tabulador de salarios vigente se tenga convenida. Asimismo, que el salario le será pagado los días sábado de cada semana, el cual incluye la parte proporcional del Séptimo día. Las PARTES convienen que, en razón del Sistema Computarizado de pago establecido en "LA EMPRESA" cualquier cantidad entregada a "EL TRABAJADOR ( A )" en efectivo, cheque, depósito bancario o transferencia electrónica por concepto de sueldos o pago de prestaciones, en fecha posterior a la terminación de la relación de trabajo y, en su caso, cualquier cantidad entregada en exceso deberá ser reembolsada a "LA EMPRESA" de forma inmediata.</p>
            <p>"EL TRABAJADOR ( A )"  manifiesta en éste acto su consentimiento de manera expresa para que "LA EMPRESA", en caso de así considerarlo necesario, le cubra el pago de su salario y prestaciones a través de depósito en cuenta bancaria, tarjeta de débito, transferencia o cualquier otro medio electrónico, sin costo por el manejo de cuenta,</p>
            <br>
            <p class="pieDePagina" >2</p>
            <br>
            <p>quedando los retiros en cajeros de disposición en efectivo, sujetos a los lineamientos de la Institución Bancaria donde se le transfiera o deposite el pago de su salario y prestaciones.</p>
            <p><strong>QUINTA.- </strong>"EL TRABAJADOR ( A )" se obliga a firmar todos los recibos de pago correspondientes que le expida  "LA EMPRESA" y le sean entregados por la misma. Toda reclamación sobre el particular deberá hacerse precisamente al momento de firmar  cada recibo, para que "LA EMPRESA", en caso de proceder dicha reclamación, realice el ajuste correspondiente y el pago del monto o de los montos que corresponda (n).</p>
            <p><strong>SEXTA.- </strong>"EL TRABAJADOR ( A )" prestará sus servicios con el cuidado, intensidad y esmero apropiados, y expresamente se obliga a observar todas las instrucciones, políticas, reglamentos y manuales internos así como los Procedimientos que "LA EMPRESA" tiene establecidos o establezca, y a vigilar, en su caso, que estos sean cumplidos por el personal a su cargo, para el debido cumplimiento del trabajo referido en éste contrato.</p>
            <p><strong>SÉPTIMA.- </strong>"EL TRABAJADOR ( A )" conviene en que dedicará al desempeño de sus labores el tiempo de manera efectiva de la duración de su jornada de trabajo a efecto de que no haya atraso ni retraso algunos en el trabajo contratado durante la vigencia del presente contrato. Asimismo, las partes convienen que "EL TRABAJADOR" no podrá laborar jornada extraordinaria, sin el previo consentimiento <strong><u>expreso y por escrito</u></strong> de "LA EMPRESA".</p>
            <p><strong>OCTAVA.- </strong>Las partes convienen que derivado de la importancia del trabajo contratado, regulado en éste contrato y materia del mismo, "EL TRABAJADOR ( A )” manifiesta expresamente en éste acto su conformidad y conviene que se abstendrá de abandonar el mismo por ninguna razón o motivo, en ninguna etapa de la misma, salvo casos fortuitos o de fuerza mayor, y continuará en su cargo y en el desempeño de sus funciones hasta la conclusión del trabajo materia del presente contrato y durante la vigencia del mismo, referido de forma específica en la cláusula Primera del mismo.</p>
            <p><strong>NOVENA.- </strong>Las partes convienen que para el caso de que el "EL TRABAJADOR ( A )" abandone el trabajo materia del presente contrato, éste último ( a ) manifiesta expresamente en éste acto su conformidad y conviene de manera voluntaria que "LA EMPRESA" de acuerdo con su criterio podrá sancionarla de 1 a 7 días como máximo sin goce de sueldo. Para el caso de reincidencia, “LA EMPRESA” podrá rescindir el presente contrato, sin causa imputable alguna para la misma.</p>
            <p><strong>DÉCIMA.- </strong>Después de 1 (un) año de servicio, "EL TRABAJADOR ( A )" tendrá derecho a disfrutar de un periodo de vacaciones pagadas, de acuerdo con el Artículo 76 de la Ley Federal del Trabajo, o en su caso, al pago proporcional al periodo de tiempo en que prestó sus servicios durante ese año.</p>
            <p>Asimismo, "EL TRABAJADOR ( A )"  disfrutará de un 25 % por concepto de prima vacacional, sobre el salario que le corresponda durante el periodo de vacaciones. Lo anterior, de acuerdo con lo establecido en los Artículos 79 y 80 de la Ley Federal Del Trabajo, vigente. </p>
            <p><strong>DÉCIMA PRIMERA.- </strong>"EL TRABAJADOR ( A )" gozará de los días de descanso obligatorios establecidos en el artículo 74 de la Ley Federal del Trabajo vigente. Para el caso de que "LA EMPRESA", de acuerdo con sus necesidades, requiera que "EL TRABAJADOR ( A )" labore uno o varios de los días de descanso legal referidos, "EL TRABAJADOR ( A )" acudirá a desempeñar sus labores de forma habitual, no obstante "LA EMPRESA" considerara en todo momento lo establecido en el artículo 73 de la Ley de la materia.</p>
            <br><p class="pieDePagina" >3</p>
            <p><strong>DECIMA SEGUNDA.- </strong>"LA EMPRESA" pagará a "EL TRABAJADOR ( A )" el equivalente a 15 días de trabajo como aguinaldo, que se pagará antes del día 20 de Diciembre de cada año o, en su caso, en proporción al periodo de tiempo en que prestó sus servicios durante ese año. Además tendrá derecho al reparto de utilidades de "LA EMPRESA", de acuerdo con lo establecido en los Artículos 117 al 131 de la Ley Federal del Trabajo vigente.</p>
            <p><strong>DECIMA TERCERA.- </strong>Para seguridad de los contratantes, "EL TRABAJADOR ( A )" estará obligado a someterse a los exámenes médicos que establezca "LA EMPRESA", y a poner en práctica las medidas profilácticas y de higiene que "LA EMPRESA" en apoyo con las Autoridades del ramo acuerden. </p>
            <p><strong>DECIMA CUARTA.- </strong>"EL TRABAJADOR ( A )" se obliga a participar en todos y cada uno de los programas de capacitación, adiestramiento y productividad que se establezcan sea en el centro de trabajo o fuera del mismo, en cumplimiento de los planes y programas de capacitación y productividad de "LA EMPRESA". Las partes convienen que la capacitación podrá hacerse dentro o fuera de los horarios de trabajo indistintamente. "EL TRABAJADOR ( A )" deberá asistir puntualmente a los cursos, sesiones de grupo, y demás actividades que forman parte de la capacitación o adiestramiento, así como atenderá las indicaciones del personal que imparta la capacitación y cumplirá con los programas respectivos; "EL TRABAJADOR ( A )" deberá presentar los exámenes de conocimiento o competencia laboral que sean requeridos, de acuerdo con la capacitación y/o adiestramiento recibidos. </p>
            <p><strong>DECIMA QUINTA.- </strong>"EL TRABAJADOR ( A )" reconoce que son propiedad exclusiva de "LA EMPRESA" los estudios, información, procedimientos, secretos comerciales, clientes, factibilidad de negocio, proyectos fallidos o no terminados, prospectos de clientes, folletos, publicaciones, manuales, dibujos, trazos, planos, diseños industriales, fotografías, “paquetes de software” y sistemas de informática o cualquier otro trabajo intelectual que "EL TRABAJADOR ( A )" desarrolle durante la vigencia de este contrato y en general todos los documentos e información física, electrónica o verbal que se le proporcione o elabore con motivo de la relación de trabajo que le une con "LA EMPRESA", así como aquellos que el propio "TRABAJADOR ( A )" prepare, descubra o formule en relación o conexión con sus servicios, por lo que se obliga a conservarlos en buen estado, a no sustraerlos del lugar de trabajo, salvo por necesidades del servicio y con la autorización expresa y por escrito de "LA EMPRESA", y a devolverlos en el momento que ésta se lo requiera o bien al término de la presente relación de trabajo, por el motivo que éste fuera. Asimismo, "EL TRABAJADOR ( A )" conviene que estará obligado a guardar estricta reserva de la información, procedimientos y todos aquellos hechos y actos que con motivo de su trabajo sean de su conocimiento y por lo tanto se obliga a no utilizar en beneficio propio, o en beneficio de terceras personas ya sea directa o indirectamente, en forma enunciativa más no limitativa: información física, a través de documentos o medios electrónicos, secretos comerciales, secretos industriales, diseños industriales, trazados de circuito, lay outs, formulas, secretos de informática, de “software”, información de todo tipo que le sea proporcionada por "LA EMPRESA" y que sea parte integrante de la información de un tercero, logística, información en general de clientes o proveedores de "LA EMPRESA", bases de datos, y cualesquier tipo de información que se encuentren protegidos por la Ley y que puedan significar una ventaja competitiva para "LA EMPRESA". "EL TRABAJADOR ( A )" deberá guardar absoluta confidencia sobre los asuntos que le sean encomendados o cualquier información que en razón de sus funciones llegase a tener en su poder, y usarla exclusivamente en beneficio del "LA EMPRESA" debiendo guardar expresa reserva sobre la información privilegiada que pudiera tener en su poder y le es confiada por "LA EMPRESA", y es propiedad de la misma, para el buen desempeño de sus funciones.</p>
            <br><br><p class="pieDePagina" >4</p>
            <p><strong>DECIMA SEXTA.- </strong>"EL TRABAJADOR ( A )" se compromete a cumplir con la normatividad que establezca "LA EMPRESA" y con el REGLAMENTO INTERIOR DE TRABAJO de la misma, con relación a las políticas empresariales, disciplina, higiene, capacitación, adiestramiento, desarrollo de habilidades, seguridad y desempeño laboral, manifestando en éste acto de forma expresa y por escrito que a la firma de éste contrato ha recibido de "LA EMPRESA" copia simple del REGLAMENTO INTERIOR DE TRABAJO de la misma, el cual observará siempre en todas su partes y cumplirá durante la vigencia de la presente relación de trabajo con "LA EMPRESA".</p>
            <p><strong>DECIMA SÉPTIMA.- </strong>El presente Contrato podrá ser rescindido o terminado de conformidad a lo establecido en la Ley Federal de Trabajo vigente.</p>
            <p><strong>DECIMA OCTAVA.- </strong>"LA EMPRESA" podrá rescindir la presente relación laboral, sin responsabilidad para el mismo, en los siguientes casos:En caso de incompetencia evidente por parte de "EL TRABAJADOR ( A )" en el desempeño de las funciones y actividades para las que se le contrata de conformidad con el presente contrato, así como por falta de probidad u honradez en el desarrollo de sus labores;</p>
            <p><strong>I.</strong>   Si "EL TRABAJADOR ( A )" no cumple con las instrucciones, funciones y obligaciones determinadas por "LA EMPRESA" y sus representantes, y con las establecidas en la REGLAMENTO INTERIOR DE TRABAJO de ésta;</p>
            <p><strong>II.</strong>  Si "EL TRABAJADOR ( A )" incurre en faltas graves a los principios y políticas empresariales de "LA EMPRESA", establecidas en el presente Contrato, y </p>
            <p><strong>III.</strong>  Por la comisión, por parte de "EL TRABAJADOR ( A )", de cualesquiera de los supuestos establecidos en el Artículo 47 de la Ley Federal del Trabajo. </p>
            <p><strong>DECIMA NOVENA.- </strong>"LA EMPRESA" y "EL TRABAJADOR ( A )" podrán dar por terminada la presente relación laboral, en los siguientes casos, de conformidad con lo establecido en el Artículo 53 de la Ley Federal del Trabajo: </p>
            <p><strong>I.</strong>	El mutuo consentimiento de las partes;</p>
            <p><strong>II.</strong>	La muerte de "EL TRABAJADOR ( A )";</p>
            <p><strong>III.</strong>	La incapacidad física o mental o inhabilidad manifiesta de "EL TRABAJADOR ( A )" que haga imposible la prestación del trabajo, y</p>
            <p><strong>IV.</strong>	Los casos a que se refiere el Artículo 434 de la Ley Federal del Trabajo.</p>
            <p><strong>VIGÉSIMA.- </strong>Las partes acuerdan sujetarse, en los casos no previstos en este contrato, a las disposiciones establecidas en la Ley Federal del Trabajo vigente y en el REGLAMENTO INTERIOR DE TRABAJO de "LA EMPRESA" y, en caso de conflicto, a los criterios y jurisdicción de la Junta de Conciliación y Arbitraje de la ciudad de León Guanajuato.</p>
            <br><br><br><br><p class="pieDePagina">5</p><br><br>
            <p>Las partes, conscientes del contenido, obligaciones, alcance y fuerza legal del presente contrato por tiempo determinado, lo firman y ratifican por duplicado ante testigos, en <?php echo $lugarDeServicio ?>, a los dias <?php echo $diaDeIngreso . " del mes de " . $mesDeIngreso . " de " . $anioDeIngreso; ?> </p>
            <div class="negritas">
                <br><pre>             "LA EMPRESA"                         "EL TRABAJADOR ( A )"            </pre>
                <br><br><br>
                <pre>___________________________________       ______________________________________</pre>
                <pre>ING.JOSÉ DOLORES CU GUERRERO.            <?php echo $apellidoPaterno . " " .$apellidoMaterno . " " . $nombres; ?></pre>
                <pre>APODERADO LEGAL DE</pre>
                <pre>CONSTRUCTURA ATZCO,S.A DE C.V.</pre>

                <b><br></b><pre>               TESTIGO                                 TESTIGO            </pre>
                <br><br><br>
                <pre>___________________________________       ______________________________________</pre>
                <pre>LIC.FABIOLA ESQUIVEL MEZA                 ING.SANCHEZ SERRANO ANA DANIELA</pre>
                    <br><br>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><p class="pieDePagina" >6</p><br><br><br><br>
            <p><strong>CONSTRUCTORA ATZCO", S.A. DE C.V.</strong><br>PRESENTE,</p>
            <br>
            <p>POR MEDIO DEL PRESENTE ESCRITO, Y POR ASÍ CONVENIR A MIS INTERESES PERSONALES, DESDE ESTE MOMENTO LES INFORMO QUE RENUNCIO DE MANERA VOLUNTARIA A LA RELACIÓN DE TRABAJO QUE ME UNIA CON LA EMPRESA DENOMINADA <strong>"CONSTRUCTORA ATZCO", S.A. DE C.V.</strong></p>
            <p>ASI MISMO, MANIFIESTO EXPRESAMENTE QUE MIENTRAS PRESTE MIS SERVICIOS PARA LA EMPRESA, NO SUFRÍ ACCIDENTES DE TRABAJO, NI RIESGO PROFESIONAL ALGUNO. DE IGUAL FORMA, MANIFIESTO QUE RECIBÍ, A MI ENTERA SATISFACCIÓN, EL PAGO DE TODAS Y CADA UNA DE LAS PRESTACIONES LABORALES A QUE TENGO DERECHO TALES COMO VACACIONES, PRIMA VACACIONAL, AGUINALDO, PRIMA DE ANTIGÜEDAD, SALARIOS Y GRATIFICACIÓN, ASÍ COMO CUALESQUIER OTRAS PRESTACIONES A QUE PUDIERA TENER DERECHO Y ME PUDIERAN CORRESPONDER DE CONFORMIDAD CON LO ESTABLECIDO EN LA LEY FEDERAL DEL TRABAJO VIGENTE.</p>
            <p>ASI MISMO, MANIFIESTO EXPRESAMENTE QUE SIEMPRE LABORE UNA JORNADA LABORAL MAXIMA DE 48 HORAS SEMANALES, MANIFESTANDO ASI MISMO QUE JAMAS DESEMPEÑE JORNADA EXTRAORDINARIA EN BENEFICIO DE <strong>"CONSTRUCTORA ATZCO", S.A. DE C.V.”</strong></p>
            <p>DERIVADO DE LO ANTERIOR, MANIFIESTO QUE NO SE ME ADEUDA CANTIDAD ALGUNA POR NINGÚN CONCEPTO, POR LO QUE NO ME RESERVO ACCIÓN O DERECHO ALGUNOS QUE EJERCITAR EN CONTRA DE <strong>"CONSTRUCTORA ATZCO", S.A. DE C.V.</strong>, ASÍ COMO EN CONTRA DE CUALQUIER OTRA PERSONA QUE PRESTE SUS SERVICIOS EN SU BENEFICIO, LA REPRESENTE LEGALMENTE, O SEA ACCIONISTA DE LA MISMA.</p>
            <p>POR LO ANTERIOR, RATIFICO EL PRESENTE ESCRITO EN TODAS Y CADA UNA DE SUS PARTES Y LO FIRMO AL CALCE, PARA TODOS LOS EFECTOS LEGALES A QUE HAYA LUGAR.</p>
            <br><br><br><br><br><br><br><br><br><br><br><br>
            <p><strong><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " . $nombres; ?></strong></p>
            <br><br><br><br>
            <div class="sub-tituloCentrado" ><strong><U>RECIBO DE FINIQUITO:</U></strong></div>
            <p>RECIBÍ DEL LIC. GILBERTO GARCIA VELA, EN SU CARÁCTER DE REPRESENTANTE LEGAL DE <strong>“CONSTRUCTORA ATZCO”, S.A. DE C.V.</strong>, QUIEN ES MI ÚNICO PATRON, LA CANTIDAD DE $ <br><br><strong>PARA LOS SIGUIENTES CONCEPTOS:</strong></p>
            <div class="negritas" >
                <pre>1.	Salarios Devengados:                                 $</pre>
                <pre>2.	Aguinaldo:                                           $</pre>
                <pre>3.	Vacaciones:                                          $</pre>
                <pre>4.	Prima Vacacional:                                    $</pre>
                <pre>5.	Horas Extras:                                        $</pre>
                <pre>6.	Séptimos Días:                                       $</pre>
                <pre>7.	Días de Descanso Obligatorios:                       $</pre>
                <pre>8.	Prima de Antigüedad:                                 $</pre>
                <pre>9.	Gratificación:                                       $</pre>
                <pre>TOTAL QUE SE PAGA:                                      $</pre>
                <pre>DEDUCCIONES</pre>
                <pre>1.	I.S.P.T. :                                           $</pre>
                <pre>2.	I.M.S.S. :                                           $</pre>
                <pre>3.	PRÉSTAMOS:                                           $</pre>
                <pre>4.	ADEUDOS:                                             $</pre>
                <pre>TOTAL DEDUCCIONES:                                      $</pre>
                <pre>TOTAL A RECIBIR:                                        $</pre>
            </div>
            <p>Asimismo, quiero manifestar expresamente que durante todo el tiempo que labore para  la sociedad mercantil denominada <strong>“CONSTRUCTORA ATZCO”, S.A. DE C.V.</strong>, quien reconozco como mi único patrón, me fueron cubiertos a mi entera y total satisfacción todos y cada uno de los conceptos mencionados anteriormente, por lo que a través del presente finiquito extiendo el más amplio recibo que en derecho proceda, manifestando además que no me reservo acción legal o derecho algunos que hacer valer en contra de cualquier persona ya sea física o moral, así como de cualquier persona que legalmente le represente o trabaje para dicha empresa.</p>
            <p>Por último, manifiesto expresamente y de manera voluntaria mi conformidad con el contenido del presente documento, mismo que firmo al calce, para todos los efectos legales a que haya lugar, en la ciudad de <?php echo $lugarDeServicio; ?> </p>
            <br><p><strong><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " . $nombres; ?></strong></p>
            <br><br><br><b<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <p class="letraBlanca">.</p>
            <br><br>
            <p><strong><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " . $nombres; ?></strong></p><br><br><br><br>
            <p>CONVENIO DE CONFIDENCIALIDAD QUE CELEBRAN POR UNA PARTE LA SOCIEDAD DENOMINADA CONSTRUCTORA ATZCO SA DE CV, REPRESENTADA EN ESTE ACTO POR ISRAEL RODRÍGUEZ ESCAMILLA A QUIÉN EN LO SUCESIVO Y PARA EFECTOS DEL PRESENTE CONVENIO SE DENOMINARÁ “LA EMPRESA”, Y POR LA OTRA EL EMPLEADO <strong><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " . $nombres; ?></strong> Y A QUIÉN EN LO SUCESIVO Y PARA EFECTOS DEL PRESENTE CONVENIO SE DENOMINARÁ “EL CONFIDENTE”, AL TENOR DE LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS.</p>
            <div class="sub-tituloCentrado" ><strong>D E C L A R A C I O N E S</strong></div>
            <p><strong>I.	LA EMPRESA, a través de su representante legal declara que:</strong></p>
            <p><span class="prefijo2">a)</span>	Es una sociedad mercantil debidamente constituida de conformidad con las leyes que rigen en la República Mexicana, como se desprende de la Escritura Pública número 16,419 de fecha 12 de Noviembre de 1992, otorgada ante la fe del Lic. Carlos A. Sotelo Regil Hernández Notario Público número 165 del Distrito Federal.</p>
            <p><span class="prefijo2">b)</span>	Su domicilio se encuentra en Boulevard paseo de los insurgentes 902 int. 7 Colonia Jardines del Moral  León, Gto. </p>
            <p><span class="prefijo2">c)</span>	Su representante legal, Israel Rodríguez Escamilla, cuenta con las facultades suficientes para celebrar el presente Convenio y obligar a su representada en términos del mismo y que dichas facultades no le han sido modificadas, limitadas o restringidas en forma alguna a la fecha del presente Convenio, como se desprende de la escritura pública número 29,286, de fecha 29 de Agosto del 2012, otorgada ante la fe del Lic. Alejandro Duran Llamas, Notario Público número 44 de la ciudad de León, Gto.</p>
            <p><span class="prefijo2">d)</span>	Cuenta con las facultades suficientes para celebrar el presente Convenio y obligarse en términos del mismo.</p>
            <p><span class="prefijo2">e)</span>	En virtud de los servicios que presta, sus empleados tienen acceso a su Información Confidencial, así como a Información Confidencial de los clientes de la Empresa; dicha información es considerada de gran valor para cualquier persona relacionada directa o indirectamente con el sector y mercados en los que tanto la empresa como sus clientes llevan a cabo sus operaciones. </p>
            <p><span class="prefijo2">f)</span>	Que en virtud de la relación laboral de EL CONFIDENTE con LA EMPRESA, desde  3 de MAYO de 2024 ha tenido acceso a toda la Información Confidencial (según dicho término se define más adelante) de LA EMPRESA, de sus clientes, así como de las compañías relacionadas directas o indirectamente con la misma. Dicha información se encuentra vinculada con el objeto social y las operaciones desarrolladas por LA EMPRESA y los clientes de la misma, con su manejo y cuestiones estructurales, así como con derecho de propiedad intelectual propiedad de cada una de las personas mencionadas anteriormente. Se considerará Información Confidencial, independientemente de lo establecido en la Cláusula Segunda del presente Convenio, y en forma enunciativa más no limitativa, la descrita en <strong><u>Anexo A</u></strong> del presente Convenio, el cual forma parte integrante del mismo.</p>
            <p><span class="prefijo2">g)</span>	Por la delicadeza, valor, ventaja que implica, relevancia o características de la documentación e Información Confidencial a la que EL CONFIDENTE tiene acceso, sea propiedad de LA EMPRESA, de sus clientes, de personas jurídicamente relacionadas o de terceros, desea que EL CONFIDENTE: (1) se obligue a guardar plena discreción y confidencialidad de éstas, (2) se obligue a indemnizarle por los daños o perjuicios que el incumplimiento de las obligaciones derivadas de este Convenio pudiera generarle y (3) sea consciente de algunas de las consecuencias jurídicas que el incumplimiento de las obligaciones aquí adquiridas puede generar.</p>
            <br><br>
            <p><strong>II.	EL CONFIDENTE declara que:</strong></p>
            <p><span class="prefijo2">a)</span>	Tener nacionalidad Mexicana</p>
            <p><span class="prefijo2">b)</span>	Estado Civil <?php echo $estadoCivil; ?></p>
            <p><span class="prefijo2">c)</span>	Que tiene como domicilio el ubicado en <strong><?php echo $domicilio; ?></strong> mismo que señala para oír y recibir todo tipo de notificaciones en los términos de la ley federal del trabajo, legislación civil y mercantil aplicable, obligándose a proporcionar cualquier cambio de domicilio y en caso de que no lo hiciere, acepta que serán válidas las que se practiquen en el antes señalado.</p>
            <p><span class="prefijo2">d)</span>	Cuenta con las facultades suficientes para celebrar el presente Convenio y obligarse en términos del mismo.</p>
            <p><span class="prefijo2">e)</span>	Reconoce que como consecuencia de su relación laboral con LA EMPRESA, y de las actividades que ha venido desempeñando y desempeñará en la misma, ha tenido pleno acceso a información que resulta delicada, valiosa, ventajosa o relevante para la propia EMPRESA, para sus clientes, para personas jurídicamente relacionadas con ésta o para terceros, y que su uso, revelación o divulgación no autorizada, podría causar graves repercusiones jurídicas y económicas a dichas personas.</p>
            <p><strong>III.	Ambas Partes declaran que:</strong></p>
            <p><span class="prefijo2">a)</span>	Que por así convenir a sus intereses, es su deseo y libre voluntad obligarse a lo dispuesto por las siguientes:</p>
            <br><br>
            <div class="sub-tituloCentrado" ><strong>C L A U S U L A S</strong></div>
            <br>
            <p><strong>PRIMERA.- </strong>Se tienen por puestas todas y cada una de las DECLARACIONES inmediatas anteriores en la presente cláusula como si a la letra se insertasen, para todos los efectos legales a los que haya lugar.</p>
            <p><strong>SEGUNDA.- </strong>EL CONFIDENTE se obliga a guardar en pleno secreto y confidencia la totalidad de la documentación e información a la que tiene acceso como consecuencia directa o indirecta de su relación laboral con LA EMPRESA y con los clientes de la misma, la cual se encuentra descrita en forma enunciativa, más no limitativa, en el <strong><u>Anexo A</u></strong> del presente Convenio (la “Información Confidencial”).</p>
            <p>No se considerará que la documentación o información es confidencial, relevante o delicada para LA EMPRESA cuando sea del dominio público legítimamente o cuando deba ser divulgada por disposición legal o por orden de autoridad competente.</p>
            <p><strong>TERCERA.- </strong>EL CONFIDENTE se obliga a no mantener en su poder copia alguna o reproducción, total o parcial de la documentación o Información Confidencial señalada, bajo cualquier forma o medio de constancia, archivo o almacenamiento, salvo que sea para cumplir las obligaciones de carácter laboral o jurídicas que hayan pactado.</p>
            <p><strong>CUARTA.- </strong>Toda la Información o documentación comercial relevante, delicada o secreta de LA EMPRESA y/o de sus clientes, tiene el carácter de confidencial, y por tanto de secreto industrial, en los términos del artículo 82 de la Ley de la Propiedad Industrial, por tratarse de aplicaciones de carácter industrial y/o comerciales que significan obtener o mantener una ventaja competitiva o económica frente a terceros en la realización de las actividades económicas que le son propias a LA EMPRESA y/o a los clientes de la misma, y respecto de las cuales se han adoptado los medios o sistemas suficientes para preservar su confidencialidad y acceso restringido. </p>
            <p>De acuerdo con lo anterior, EL CONFIDENTE manifiesta para todos los efectos a que haya lugar, que conoce y entiende cabalmente el artículo 223 de la Ley de la Propiedad Industrial, conforme al cual, las siguientes conductas inadecuadas respecto del manejo de los secretos industriales se tipifican como delictivas:</p>
            <div class="apartadoArticulo">
                <p>“<strong>Artículo 223</strong>: Son delitos:</p>
                <p>...IV. Revelar a un tercero un secreto industrial, que se conozca con motivo de su trabajo, puesto, cargo, desempeño de su profesión, relación de negocios o en virtud del otorgamiento de una licencia para su uso, sin consentimiento de la persona que guarde el secreto industrial, habiendo sido prevenido de su confidencialidad, con el propósito de obtener un beneficio económico para sí o para el tercero o con el fin de causar un perjuicio a la persona que guarde el secreto;</p>
                <p>V. Apoderarse de un secreto industrial sin derecho y sin consentimiento de la persona que lo guarde o de su usuario autorizado, para usarlo o revelarlo a un tercero, con el propósito de obtener un beneficio económico para sí o para el tercero o con el fin de causar un perjuicio a la persona que guarde el secreto industrial o a su usuario autorizado, y</p>
                <p>VI. Usar la información contenida en un secreto industrial, que conozca por virtud de su trabajo, cargo o puesto, ejercicio de su profesión o relación de negocios, sin consentimiento de quien lo guarde o de su usuario autorizado, o que le haya sido revelado por un tercero, a sabiendas que éste no contaba para ello con el consentimiento de la persona que guarde el secreto industrial o su usuario autorizado, con el propósito de obtener un beneficio económico o con el fin de causar un perjuicio a la persona que guarde el secreto industrial o su usuario autorizado…”</p>
            </div>
            <p><strong>QUINTA.- </strong>Si EL CONFIDENTE fuera requerido por autoridad competente de cualquier tipo para revelar información delicada, relevante o Información Confidencial de LA EMPRESA y/o de clientes de la misma, se obliga a dar aviso por escrito a LA EMPRESA y/o al cliente de que se trate, dentro de los 3 (tres) días hábiles siguientes a la recepción del documento respectivo, con la finalidad de que la parte que corresponda pueda ejercitar los actos o derechos que correspondan para salvaguardar sus intereses.</p>
            <p><strong>SEXTA.- </strong>EL CONFIDENTE al momento de la terminación de la relación de trabajo con LA EMPRESA, se obliga a devolver en ese mismo momento, en el domicilio que LA EMPRESA ha señalado en las Declaraciones del presente Convenio, o en su defecto la que la misma le señale, absolutamente toda la Información Confidencial que obre en su poder, sea propiedad de LA EMPRESA o de los clientes de la misma, especialmente la detallada en el <strong><u>Anexo A</u></strong> de este Convenio, y a no mantener en su poder ninguna copia o reproducción, total o parcial de la información señalada bajo cualquier forma o medio de constancia o almacenamiento.</p>
            <p><strong>SÉPTIMA.- </strong>EL CONFIDENTE se obliga a sacar en paz y a salvo e indemnizar inmediatamente a LA EMPRESA y/o a los clientes de la misma, por cualquier daño o perjuicio que el incumplimiento de las obligaciones adquiridas en este Convenio le causara.</p>
            <p><strong>OCTAVA.- </strong>Este Convenio tendrá una vigencia de 5 cinco años a partir de la fecha de firma de este documento, sin perjuicio de que EL CONFIDENTE no podrá en ningún momento usar o disponer de documentación o Información Confidencial que no le sea propia por sí mismo o por interpósita persona física o moral.</p>
            <p><strong>NOVENA.- </strong>Las obligaciones expuestas en este convenio tendrán efectos en toda la República Mexicana.</p>
            <p><strong>DÉCIMA.- </strong>Para cualquier notificación, aviso o comunicado vinculado con este convenio, las Partes señalan como sus domicilios convencionales los siguientes:</p>
            <table>
                <tr>
                    <th><strong>LA EMPRESA</strong></th>
                    <th> </th>
                    <th><strong>EL CONFIDENTE</strong></th>
                </tr>
                <tr>
                    <td>BOULEVARD PASEO DE LOS INSURGENTES 902 INT. 7 COLONIA JARDINES DEL MORAL  LEÓN, GTO C.P 37160.</td>
                    <td> </td>
                    <td><?php echo $domicilio; ?></td>
                </tr>
            </table>
            <p><strong>DÉCIMA PRIMERA.- </strong>Este Convenio constituye y expresa el total entendimiento entre las Partes en relación con su objeto, así como su total entendimiento y condiciones, ya sean implícitas o expresas, orales o escritas. Ni el Convenio en su totalidad ni alguna parte del mismo podrán ser alterados, cambiados, renunciados o modificados sino mediante un convenio por escrito debidamente aceptado y firmado por ambas Partes.</p>
            <p><strong>DÉCIMA SEGUNDA.- </strong>La invalidez o exclusión de alguna de las Cláusulas de este Convenio o parte de ella, no modificará ni alterará el contenido de las cláusulas que permanezcan, mismas que deberán continuar en vigor y en efecto, e interpretadas como si las inválidas o excluidas no hubieren sido insertadas.</p>
            <p><strong>DÉCIMA TERCERA.- </strong>En caso de que EL CONFIDENTE incumpla con las obligaciones asumidas en el presente convenio, se obliga a pagar a LA EMPRESA la cantidad de $3’000,000.00 (Tres Millones de Pesos 00/100 M.N.); bien sea por incumplimiento en forma parcial o total, con o sin beneficio económico; por incumplimiento llevado a cabo por sí mismo o por medio de terceros.</p>
            <p>Independientemente de la cantidad que deba pagar EL CONFIDENTE por dicho incumplimiento, LA EMPRESA podrá presentar la querella por el delito de revelación de secretos tipificado en el Código Penal para el Estado de Guanajuato en su artículo 229 o bien por el delito que corresponda ante las autoridades judiciales en materia penal, así como el pago de daños y perjuicios ante el juzgado civil en turno y/o a interponer demanda en cualquier vía según sea el caso.</p>
            <p><strong>DÉCIMA CUARTA.- </strong>Para la interpretación y cumplimiento de este Convenio las Partes aceptan sujetarse a la jurisdicción y leyes de los Tribunales competentes de la ciudad de León, Guanajuato, renunciando expresamente a cualquier otro fuero que por razón de sus domicilios presentes o futuros, o por cualquier otra razón, pudiera corresponderles.</p>
            <p><strong>DÉCIMA QUINTA.- </strong>El presente Convenio y sus Anexos son la compilación completa y exclusiva de todos los términos y condiciones que rigen el acuerdo de las Partes en relación con el objeto del mismo.  Ninguna declaración de ningún agente, empleado o representante de LA EMPRESA realizada con anterioridad a la celebración del presente Convenio admitida en la interpretación de los términos del mismo.  En caso de que existiera conflicto entre el texto del presente Convenio y su Anexo, el texto del presente Convenio prevalecerá sobre el Anexo.</p>
            <br><br><br><br><br><br><br><br><br><br>
            <p>Leído que fue este Convenio por las Partes y enteradas plenamente de su contenido y efectos legales y no existiendo ninguna clase de vicio, dolo o mala fe, ambas lo firman en original en 2 (dos) tantos de conformidad, en la ciudad de SALAMANCA,GTO, GUANAJUATO, el día <?php echo $diaDeIngreso . " del mes de " . $mesDeIngreso . " de " . $anioDeIngreso; ?></p>
            <div class="negritas">
                <br><pre>             "LA EMPRESA"                           "EL CONFIDENTE"            </pre>
                <br><br><br>
                <pre>___________________________________       ______________________________________</pre>
                <pre>LIC.ELIZABETH BARRIENTOS RUIZ.            <?php echo $apellidoPaterno . " " .$apellidoMaterno . " " . $nombres; ?></pre>
                <pre>APODERADO LEGAL DE</pre>
                <pre>CONSTRUCTURA ATZCO,S.A DE C.V.</pre>

                <b><br></b><pre>               TESTIGO                                 TESTIGO            </pre>
                <br><br><br>
                <pre>___________________________________       ______________________________________</pre>
                <pre>LIC.FABIOLA ESQUIVEL MEZA                 ING.SANCHEZ SERRANO ANA DANIELA</pre>
                    <br><br>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <div class="sub-tituloCentrado" ><strong><U>A N E X O  A</U></strong></div>
            <p>ESTE ANEXO FORMA PARTE INTEGRANTE DEL CONVENIO DE CONFIDENCIALIDAD CELEBRADO ENTRE CONSTRUCTORA ATZCO SA DE CV, REPRESENTADA EN ESTE ACTO POR ISRAEL RODRÍGUEZ ESCAMILLA, EN LO SUCESIVO DENOMINADA LA EMPRESA, Y <strong><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " . $nombres; ?></strong> DE FECHA <?php echo $diaDeIngreso . " DEL MES DE " . $mesDeIngreso . " DE " . $anioDeIngreso; ?></p>
            <p>A continuación, se detalla de manera enunciativa y no limitativa, parte de la Información Confidencial a la que, por virtud del Convenio celebrado, se obliga a guardar pleno secreto y discreción:</p>
            <ul>
                <li>Manuales integrados propiedad de LA EMPRESA en donde se establecen  políticas de gestión de la calidad, seguridad, salud laboral y ambiental que tengan como finalidad y objetivo el uso racional de los recursos de la empresa, reducción de contaminación y generación de residuos, prevención de riesgos, enfermedades y/o accidentes de trabajo.</li>
                <li>Manuales y procedimientos del sistema integrado de gestión de la calidad propiedad de LA EMPRESA en donde se establecen control de documentos, control de registros, elaboración de plan de calidad, licitaciones y propuestas, compras, control de almacén, recursos humanos, mantenimiento a infraestructura, fichas de procesos, entre otros.</li>
                <li>Manuales y procedimientos del sistema integrado de gestión de la calidad propiedad de LA EMPRESA en las diferentes ramas de seguridad y salud ocupacional.</li>
                <li>Manuales y procedimientos del sistema integrado de gestión de la calidad propiedad de LA EMPRESA en la rama del medio ambiente, respecto de los diferentes procesos y políticas en el manejo de residuos peligrosos, residuos no peligrosos, manejo y control de residuos sanitarios, conservación y protección de la flora y fauna, atención a derrames y fugas, así como todo lo relacionado con la identificación y evaluación de aspectos ambientales.</li>
                <li>Información relativa a precios y costos de mercancías; información contable y financiera; información de volúmenes y consumos de la empresa, sus filiales, partes relacionadas, así como de los clientes de las mismas.</li>
                <li>Información de los proveedores que le suministran insumos a LA EMPRESA y a los clientes de la misma. </li>
                <li>Información relativa a insumos estratégicos de LA EMPRESA y de los clientes de la misma. De forma enunciativa más no limitativa, se define como estratégicos aquellos productos que representen una parte importante de los costos del servicio o aquellos productos y servicios que por sus características o entorno del mercado, contribuyan con un beneficio adicional.</li>
                <li>Información relativa a costos, proveedores, redes de distribución, y cualquier otra que sea relativa respecto a la línea de productos y servicios en los que participan LA EMPRESA y los clientes de la misma.</li>
                <li>Información relativa a las negociaciones efectuadas por LA EMPRESA y los clientes de la misma, con sus respectivos proveedores y/o clientes, así como a la logística, distribución de la operación, términos y condiciones de pago, mecanismos de fondeo, y cualquier otros mecanismo o producto financiero y/o instrumento bursátil utilizado en las operaciones.</li>
                <li>Manejo de LA EMPRESA y de los clientes de la misma, información de procedimientos y trámites internos y externos, incluyendo de manera enunciativa pero no limitativa los documentos que contengan las estrategias de LA EMPRESA y/o de sus clientes, así como know how o conocimiento adquirido, entre otros.</li>
                <li>Información o documentación confidencial, relevante o delicada para o relacionada con LA EMPRESA o con los clientes de la misma, sus accionistas, funcionarios, directivos, trabajadores, prestadores de servicios, colaboradores, proveedores, o personas de cualquier manera vinculadas jurídicamente con las anteriores.</li>
                <br>
                <li>Información referente a la administración, contabilidad, situación fiscal, estados financieros, planta laboral, principales ejecutivos, software, integración de su capital, accionistas, proyectos por desarrollar, relaciones comerciales, financieras y de negocios de LA EMPRESA y/o de los clientes de la misma.</li>
            </ul>
            <p>Se considera Información Confidencial, relevante y delicada para LA EMPRESA y/o para los clientes de la misma (según se define en el cuerpo principal del Convenio), todo lo relacionado directa o indirectamente con los rubros antes mencionados, entre otros las claves de acceso (passwords), saldos, disponibilidades, características, manejos históricos o de cualquier clase, etc.</p>
            <br><br><br>
            <p class="centrado"><?php echo $lugarDeServicio; ?> A <?php echo $diaDeIngreso . " de " . $mesDeIngreso . " de " . $anioDeIngreso; ?></p>
            <div class="negritas">
                <br><pre>             "LA EMPRESA"                           "EL CONFIDENTE"            </pre>
                <br><br><br>
                <pre>___________________________________       ______________________________________</pre>
                <pre>CONSTRUCTURA ATZCO,S.A DE C.V.            <?php echo $apellidoPaterno . " " .$apellidoMaterno . " " . $nombres; ?></pre>
                <pre>ING.ISRAEL RODRÍGUEZ ESCAMILLA</pre>

                <b><br></b><pre>               TESTIGO                                 TESTIGO            </pre>
                <br><br><br>
                <pre>___________________________________       ______________________________________</pre>
                <pre>LIC.ELIZABETH BARRIENTOS RUIZ             ING.SANCHEZ SERRANO ANA DANIELA</pre>
                    <br><br>
            </div>
            <br><br><br><br><br><br><br><br><br><br>
            <P class="sub-tituloCentrado rojo-blanco negritas">CARTA DE CONSENTIMIENTO</P>
            <div class="margen-solo-izquierdo">
                <p>Por medio de la presente el que suscribe C. <strong><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " . $nombres; ?></strong> le externo mi consentimiento y aceptación de manera libre y espontánea, para que se me entreviste y se realice el llenado de mi declaración de estado de salud para cuestiones informativas.</p>
                <p>Por lo expuesto, no tengo inconveniente alguno en que la <strong>Empresa Constructora Atzco S.A de C.V</strong> me pida que realice el llenado de mi declaratoria de estado de salud, agradeciendo de antemano la atención y facilidades que le puedan brindar para agilizar los trámites que le interesen.</p>
                <br><br><br><br><br><br><br>
                <p>Finalmente</p>
                <p>En <?php echo $lugarDeServicio; ?>, a <?php echo $diaDeIngreso . " de " . $mesDeIngreso . " de " . $anioDeIngreso; ?>.</p>
                <br><br>
                <div class="sub-tituloCentrado negritas">
                    <p>ATENTAMENTE</p><br><br><br>
                    <p>________________________________</p>
                    <p>NOMBRE Y FIRMA</p>
                </div>
            </div>
        </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

            <div class="red-box">DECLARACIÓN DEL ESTADO DE SALUD</div>
                <div class="content">
                    <table class="table">
                        <tr>
                            <th>NOMBRE DEL ASPIRANTE:</th>
                            <td><?php echo $nombres . ' ' . $apellidoPaterno . ' ' . $apellidoMaterno; ?></td>
                            <th>SEXO:</th>
                            <td> <?php echo $sexo ?> </td>
                        </tr>
                        <tr>
                            <th>EDAD: <?php echo $edad; ?></th>
                            <td></td>
                            <th></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Fecha de su última consulta médica:</th>
                            <td>________</td>
                            <th>Tipo de Sangre:</th>
                            <td> <?php echo $tipoDeSangre ?> </td>
                        </tr>
                        <tr>
                            <th>En caso de accidente, favor de avisar a:</th>
                            <td colspan="3">
                                Nombre:<?php echo $nombreEmergencia ?> <br>
                                Parentezco:<?php echo $parentezcoEmergencia?>
                                Teléfono:<?php echo $telefonoEmergencia ?> <br>
                                Dirección:<?php echo $domicilio ?><br>
                                ¿Le puede donar sangre? Si_______ No_______

                            </td>
                        </tr>
                    </table>
                </div>
                <div class="red-box">ESTADO DE SALUD</div>
                <div class="content">
                    <p>Marcar con una "X" si su respuesta es afirmativa o negativa <br>Ha parecido, padece o es tratado actualmente de alguna enfermedad o incapacidad relacionada con lo siguiente:</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Enfermedades</th>
                                <th>SI</th>
                                <th>NO</th>
                                <th>Enfermedades</th>
                                <th>SI</th>
                                <th>NO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1. Desmayos</td>
                                <td>_</td>
                                <td>_</td>
                                <td>29. Enfisema pulmonar</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>2. Accidente cerebral</td>
                                <td>_</td>
                                <td>_</td>
                                <td>30. Asma</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>3. Tumores en cerebro</td>
                                <td>_</td>
                                <td>_</td>
                                <td>31. Cirugía del corazón</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>4. Enfermedades neurológicas</td>
                                <td>_</td>
                                <td>_</td>
                                <td>32. Cirugía del pulmón</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>5. Trauma craneo encefálico</td>
                                <td>_</td>
                                <td>_</td>
                                <td>33. Úlcera gástrica o duodenal</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>6. Convulsiones</td>
                                <td>_</td>
                                <td>_</td>
                                <td>34. Hernia diafragmática</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>7. Poliomyelitis</td>
                                <td>_</td>
                                <td>_</td>
                                <td>35. Reflujo gastroesofático</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>8. Sordera</td>
                                <td>_</td>
                                <td>_</td>
                                <td>36. Cálculos biliares</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>9. Otitis</td>
                                <td>_</td>
                                <td>_</td>
                                <td>37. Pancreatitis</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>10. Cirugía de oído</td>
                                <td>_</td>
                                <td>_</td>
                                <td>38. Hernia umbilical</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>11. Defecto de la visión</td>
                                <td>_</td>
                                <td>_</td>
                                <td>39. Hernia inguinal</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>12. Estrabismo</td>
                                <td>_</td>
                                <td>_</td>
                                <td>40. Hepatitis B - C - D</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>13. Catarata</td>
                                <td>_</td>
                                <td>_</td>
                                <td>41. Cirugía abdominal</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>14. Cirugía ocular</td>
                                <td>_</td>
                                <td>_</td>
                                <td>42. Cáncer del estomago o intestinal</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>15. Desviación del tabique nasal</td>
                                <td>_</td>
                                <td>_</td>
                                <td>43. Prolapso genital</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>16. Cirugía de la nariz</td>
                                <td>_</td>
                                <td>_</td>
                                <td>44. Miomatosis uterina</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>17. Bocio</td>
                                <td>_</td>
                                <td>_</td>
                                <td>45. Incontinencia urinaria</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>18. Masas del cuello</td>
                                <td>_</td>
                                <td>_</td>
                                <td>46. Cálculos renales</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>19. Tumores, quistes en mamas</td>
                                <td>_</td>
                                <td>_</td>
                                <td>47. Várices miembros inferiores</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>20. Cirugía de mamas</td>
                                <td>_</td>
                                <td>_</td>
                                <td>48. Fracturas</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>21. Hipertensión arterial</td>
                                <td>_</td>
                                <td>_</td>
                                <td>49. Juanetes</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>22. Diabetes</td>
                                <td>_</td>
                                <td>_</td>
                                <td>50. Trastornos de la columna</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>23. Infarto de miocardio</td>
                                <td>_</td>
                                <td>_</td>
                                <td>51. Lesión de ligamentos y/o meniscos</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>24. Soplos</td>
                                <td>_</td>
                                <td>_</td>
                                <td>52. Infección por VIH (SIDA)</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>25. Enfermedad de las válvulas cardiacas</td>
                                <td>_</td>
                                <td>_</td>
                                <td>53. Tumores malignos</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>26. Reumatismo</td>
                                <td>_</td>
                                <td>_</td>
                                <td>54. Leucemia</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>27. Enfermedad congénita del corazón</td>
                                <td>_</td>
                                <td>_</td>
                                <td>55. Otros (especificar)</td>
                                <td>_</td>
                                <td>_</td>
                            </tr>
                            <tr>
                                <td>28. Tuberculosis pulmonar</td>
                                <td>_</td>
                                <td>_</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="red-box">Las preguntas de esta sección deben ser respondidas SOLAMENTE por el SEXO FEMENINO</div>
                    <table class="table">
                        <tr>
                            <th>¿Cuántas veces ha estado embarazada?</th>
                            <td>_</td>
                            <th>Observaciones</th>
                        </tr>
                        <tr>
                            <th>¿Número de partos?</th>
                            <td>_</td>
                            <td rowspan="4"></td>
                        </tr>
                        <tr>
                            <th>¿Número de hijos vivos?</th>
                            <td>_</td>
                        </tr>
                        <tr>
                            <th>¿Número Cesáreas (C)?</th>
                            <td>_</td>
                        </tr>
                    </table>
                    <p>Declaro bajo protesta de decir verdad que las contestaciones que anteceden son ciertas y verídicas, y que la detección de algún padecimiento no declarado podrá ser considerado como intento de engaño o abuso de confianza, pudiendo ser causal de recisión de contrato sin responsabilidad para la empresa de acuerdo a lo establecido en el artículo 47 de la Ley Federal del Trabajo y en el reglamento interno de trabajo.</p>
                    <div><br><br><br><br>
                        <p>Firma del aspirante: ___________________ Huella: ___________________</p><br><br><br><br>
                        <p>Ciudad y Fecha ___________________________</p>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br>
            <P class="sub-tituloCentrado rojo-blanco negritas">AVISO DE PRIVACIDAD</P>
            <p class="pieDePagina"><?php echo $lugarDeServicio; ?> a <?php echo $diaDeIngreso . " del mes " . $mesDeIngreso . " del " . $anioDeIngreso; ?>.</p>
            <div class="margen-solo-izquierdo justificado">
                <p class="justificado"><strong><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " . $nombres; ?></strong> (el responsable) con domicilio en  <strong><?php echo $domicilio; ?></strong> reconoce que nos estás proporcionando tus datos personales, laborales y académicos que aparecen en tu CV y/ o Solicitud de empleo, así como en la documentación de contratación solicitada. Nuestro compromiso es tratar los datos únicamente para los fines de Reclutamiento, Selección, Contratación y Administración de personal y las Relaciones laborales propios del  “Responsable”.</p>
            </div>
            <p>Salvo para cumplir con las anteriores finalidades, no transferiremos tus datos a ningún tercero.</p>
            <p>Este aviso de privacidad se pone a disposición de Usted (el “Titular”) previo a la obtención y tratamiento de sus datos personales (los “Datos”)</p>
            <p>I.	<strong>Datos recabados y su finalidad:</strong> los datos que usted nos proporciona incluyen: (a) nombre, (b) domicilio completo; (c) correo electrónico; (d) teléfono celular o particular; (e) fotografía; (f) datos académicos y laborales (empleos anteriores); (g) datos personales y datos relativos a interés en puestos de trabajo, incluyendo aptitudes y capacidades, nivel socioeconómico y</p>
            <p>II.	 pretensiones laborales (incluyendo sueldo), los cuales serán tratados con la única finalidad de Reclutamiento, Selección, Contratación y Administración del personal y las relaciones laborales. <br>Hacemos de su conocimiento que en todo momento los “datos personales” serán tratados con apego a los principios y requisitos contenidos en la Ley.</p>
            <p>III.	<strong>Datos sensibles:</strong> El Titular declara que no ha proporcionado y en ningún caso proporcionará al Responsable “datos personales sensibles”, es decir, aquellos datos personales íntimos o cuya utilización debida o indebida pueda dar origen a discriminación o conlleve un riesgo grave para éste. En particular, el Titular se obliga a no proporcionar al Responsable ningún Dato relativo a origen racial o étnico, información genética, creencias religiosas, filosóficas y morales, opiniones políticas o preferencia sexual.</p>
            <p>IV.	<strong>Almacenamiento y divulgación:</strong> Para poder cumplir con las finalidades de este aviso, así como para poder almacenar y tratar sus datos, es posible que el Responsable entregue todo o parte de los Datos a terceros, incluyendo proveedores de bienes o servicios, nacionales o extranjeros, que requieren conocer esta información, como por ejemplo servidores de almacenamiento de información, quienes quedarán obligados, por contrato, a mantener la confidencialidad de los Datos y conforme a este Aviso de Privacidad. El Responsable se compromete a contar con las medidas legales y de seguridad suficiente y necesaria para garantizar que sus Datos permanezcan confidenciales y seguros.</p>
            <p>V.	<strong>Acceso, rectificación:</strong> El Titular tendrá derecho para solicitar al Responsable en cualquier momento el acceso, rectificación, cancelación u oposición respecto de sus Datos, para lo cual deberá enviar una solicitud a los datos que aparecen a continuación:<br>La solicitud de acceso, rectificación, cancelación u oposición deberá contener y acompañar lo siguiente: (1) El nombre del Titular y domicilio u otro medio para comunicarle la respuesta a su solicitud; (2) Los documentos que acrediten la identidad o, en su caso, la representación legal del Titular; (3) La descripción clara y precisa de los Datos respecto de los que se busca ejercer alguno de los derechos antes mencionados, y (4) Cualquier otro elemento o documento que facilite la localización de los Datos del Titular.</p>
            <p>VI.	El Titular está de acuerdo y conforme en que cualquier cambio a este “Aviso de Privacidad” o a las políticas de privacidad se notifique avisos internos, por lo que es obligación del Titular solicitar al Departamento de Capital Humano la versión más actual del Aviso de Privacidad.</p>
            <div class="centrado negritas"><br><br><br><br>
                <p>____________________________________________</p>
                <p><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " . $nombres; ?></p>
                <p>Nombre, Firma y Huella</p>
            </div>
            <div class="justificado">
                <P class="sub-tituloCentrado rojo-blanco negritas">ACUSE DE RECIBO</P>
                <p>Recibí el <strong>reglamento interior de trabajo</strong> de la empresa <strong>Constructora Atzco S.A de C.V</strong><br>
                    Responsabilizándome a conservarlo durante mi permanencia laboral y dar seguimiento puntual a este.<br>
                    Nombre completo del colaborador:</p>
                <p><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " . $nombres; ?></p>
                <div class="negritas"><br>
                    <p>Firma: ____________________________________</p><br>
                    <p>Fecha: ____________________________________</p>
                </div>
                <br><br>
                <p class="pieDePagina anexo10" >ANEXO 10</p><br>
                <p class="puntitos">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</p>
                <P class="sub-tituloCentrado rojo-blanco negritas">DECLARACION INFONAVIT</P>
                <p class="pieDePagina" >FECHA: <?php echo $diaDeIngreso . "/" . $mesDeIngreso . "/" . $anioDeIngreso; ?></p>
                <p>POR ÉSTE MEDIO, YO <strong><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " . $nombres; ?></strong> COMUNICO A <strong>CONSTRUCTORA ATZCO SA DE CV</strong> QUE <?php echo $creditoInfonavit; ?> TENGO CRÉDITO DE INFONAVIT:</p>
                <p>NÚMERO DE SEGURIDAD SOCIAL: <?php echo $nss; ?></p>
                <p>NÚMERO DE CRÉDITO:</p>
                <p>FECHA DEL OTORGAMIENTO:</p>
                <p>FACTOR DE CUOTA FIJA:</p>
                <div class="centrado negritas">
                    <p><strong><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " . $nombres; ?></strong></p>
                    <p>NOMBRE COMPLETO</p>
                    <br><br><br><br>
                    <p>____________________________________________</p>
                    <p>FIRMA</p>
                </div>
                <p class="puntitos">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</p>
        <div class="justificado">
                <p>Yo <strong><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " . $nombres; ?></strong> por este conducto autorizo para que en mi nombre y representación y solo para el caso de enfermedad, se cobre mi sueldo mediante carta poder que entregaré, y con la firma de dos testigos.</p>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <p class="white">.</p>
                <br><br><br><br><br><br>
                <p class="centrado"><strong><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " . $nombres; ?></strong></p>
                <br><br><br><br><br><br><br>
                <p class="centrado">CÓDIGO DE ÉTICA</p>
                <p class="centrado anexo10">ÍNDICE</p>
                <p>ÍNDICE <br>
                    I.	Antecedentes............................................................................................................................................23<br>
                    II.	Objetivos..................................................................................................................................................23<br>
                    III.	Alcance...................................................................................................................................................23<br>
                    IV.	Valores...................................................................................................................................................24<br>
                    V.	Normas de ética generales.....................................................................................................................24<br>
                    a)	En relación con clientes y proveedores..................................................................................................24<br>
                    b)	Competencia...........................................................................................................................................25<br>
                    c)	En relación con los colaboradores..........................................................................................................25<br>
                    d)	En relación con la Sociedad...................................................................................................................25<br>
                    e)	Protección de activos..............................................................................................................................26<br>
                    f)	Privacidad................................................................................................................................................26<br>
                    g)	Conflicto de interés.................................................................................................................................26<br>
                    h)	Integridad y corrupción...........................................................................................................................27<br>
                    i)	Relaciones personales y familiares.........................................................................................................27<br>
                    j)	Faltas al código de ética...........................................................................................................................27<br>
                </p>
                <p><strong>I. Antecedentes</strong></p>
                <p>a)	El apego a principios éticos habla de un sentido de respeto, honestidad e integridad, valores imprescindibles para el desempeño armonioso del trabajo.</p>
                <p>b)	 Estos valores constituyen una parte esencial de nuestra cultura corporativa y son una pieza fundamental en la vida de nuestra empresa.</p>
                <p>c)	Estos valores son parte de nuestra cultura organizacional y de nuestro quehacer diario, por lo que es necesario formalizarlos y establecer un marco de referencia común que unifique los criterios y oriente las acciones de todas las personas que integramos ATZCO</p>
                <p>d)	ATZCO opera bajo la premisa fundamental de que se rige por leyes y ordenamientos, cuya observancia y cumplimiento es indispensable para existir y funcionar óptimamente en su entorno social.</p>
                <p>e)	Este código parte del hecho que la mayoría de las veces la acción correcta es clara, independientemente de que esté incorporada a un código</p>
                <br><br><br><br><br>
                <p><strong>II.	Objetivos</strong></p>
                <p>El presente Código de Ética tiene los siguientes objetivos: </p>
                <p>a)	Dar a conocer a los Directivos, Gerentes y colaboradores de ATZCO sus  obligaciones de carácter ético hacia la empresa, clientes, proveedores, competidores, autoridades, medio ambiente y comunidad.</p>
                <p>b)	Establecer criterios básicos para normar el comportamiento ético de todos los colaboradores de ATZCO.</p>
                <p>c)	Compartir nuestros valores éticos con las personas interesadas en conocer ATZCO.</p>
                <p>d)	Señalar el procedimiento para sancionar a quienes cometen faltas en contra de nuestro código de ética.</p>
                <p><strong>III.	Alcance</strong></p>
                <p>a)	El presente código de ética fue elaborado para su observancia de todos los colaboradores de ATZCO</p>
                <p>b)	Los nuevos temas que surjan de la dinámica de las situaciones de negocio y del entorno en general, se incorporan a este código conforme sea necesario.</p>
                <p>c)	Este documento no es ni pretende ser exhaustivo, ni incluir todas las situaciones donde pudiera presentarse un conflicto de índole de ética. Por lo tanto, las situaciones no previstas en este código de ética se resolverán de acuerdo a un criterio sano de administración. En caso de duda, se consultara con las áreas de recursos humanos o Dirección General.</p>
                <p><strong>IV.	 Valores</strong></p>
                <p>En ATZCO, vivimos el compromiso con un sentido de pertenencia y responsabilidad en nuestras acciones a través de los valores que forman parte integral de la organización y proporcionan el fundamento para el desarrollo de una normatividad sobre la cual se toman decisiones y se ejecutan acciones con valor.<br>Los Valores de ATZCO son los siguientes:</p>
                <ul>
                    <li><strong>Lealtad:</strong> Ganar la confianza que se deposita en ti, generando un compromiso de colaboración total y recíproco, mientras trabajemos juntos.</li>
                    <li><strong>Responsabilidad:</strong> Cumplimiento de los deberes laborales establecidos.</li>
                    <li><strong>Respeto:</strong> Aceptar a las personas tal cual son, para que el valor sea recíproco.</li>
                    <li><strong>Puntualidad:</strong> Cumplir con los compromisos adquiridos en tiempo y forma.</li>
                    <li><strong>Excelencia:</strong> Lograr cualquier objetivo a la primera.</li>
                    <li><strong>Trabajo en equipo:</strong> Grupo de personas que unen sus talentos enfocados a desarrollar un trabajo en común.</li>
                    <li><strong>Creatividad:</strong> Conjunto de ideas innovadoras para la creación de valor.</li>
                </ul>
                <p><strong>V.	Normas de ética generales</strong></p>
                <p><strong>a)	En relación con clientes y proveedores.</strong></p>
                <p>Atendemos a clientes ofreciéndoles un trato equitativo y honesto en cada transacción, proporcionando los productos y servicios que les competen con la mayor calidad y oportunidad a su alcance, apegándonos en todo momento a la regulación oficial y a la normatividad interna de ATZCO.<br>
                    No hacemos comparaciones falsas o engañosas con productos o servicios equivalentes a los que ofrecen los competidores.<br>
                    Relacionarse con los proveedores de bienes y servicios de forma ética y lícita.<br>
                    Buscar y seleccionar únicamente proveedores cuyas prácticas empresariales respeten la dignidad humana, no incumplan la ley y no pongan en peligro la reputación de ATZCO<br>
                    Seleccionar a los proveedores con base a la idoneidad de sus productos o servicios , así como de su precio, condiciones de entrega y calidad, no aceptando ni ofreciendo regalos o comisiones, en dinero o en especie, que puedan alterar las reglas de la libre competencia en la producción y distribución de bienes y servicios.
                </p>
                <p>En caso de que no se pueda rechazar el regalo o comisión, deberá comunicarlo inmediatamente a Dirección General y/o Recursos Humanos.<br>
                    Buscar la excelencia de los bienes y servicios de ATZCO de modo que los clientes obtengan la satisfacción esperada.<br>
                    Garantizar los productos y servicios de ATZCO y atender de forma rápida y eficaz las reclamaciones de clientes buscando su satisfacción más allá del mero cumplimento.
                </p>
                <p><strong>b)	Competencia</strong></p>
                <p>En ATZCO competimos vigorosamente cumpliendo con las leyes y reglamentos sobre competencia justa existentes en los estados que tenemos presencia.<br>
                    ATZCO no participa en ningún acuerdo que pretenda limitar el libre juego de las fuerzas de los mercados en los que operamos y no utilizamos medios impropios para mejorar nuestra posición competitiva en dichos mercados.<br>
                    Los colaboradores que tengan contacto con representantes de competidores, deberán mostrar una actitud profesional, apegada a los valores de la empresa y cuidamos la imagen personal y la de ATZCO.<br>
                    En la interacción con competidores, ya sea individual o en foros y asociaciones empresariales o profesionales, se evitaran temas que pudieran generar riesgos o posibles contingencias para ATZCO en materia de cumplimiento de leyes y reglamento sobre competencia.<br>
                    Los colaboradores de ATZCO deberán evitar en lo posible hacer comentarios o declaraciones sobre la competencia, pero cuando resulta necesario la hacemos con justicia y objetividad.<br>
                    En ningún caso, se intentara obtener secretos comerciales o cualquier otra información confidencial de un competidor.
                </p>
                <p><strong>c)	En relación con los colaboradores </strong></p>
                <p>Tratar con dignidad respeto y justicia a los colaboradores, teniendo en consideración su diferente sensibilidad cultural.<br>
                    No discriminar a los colaboradores por razón de raza, religión, edad, nacionalidad, sexo o cualquier otra condición personal o social ajena a sus condiciones de mérito y capacidad.<br>
                    No permitir ninguna forma de violencia, acoso, o abuso en el trabajo.<br>
                    Fomentar el desarrollo, formación y promoción profesional de los colaboradores.<br>
                    Vincular la retribución y promoción de los colaboradores a sus condiciones de mérito y capacidad.<br>
                    Establecer y comunicar criterios y reglas claras que mantengan equilibrados los derechos de ATZCO y los colaboradores en los procesos de contratación y en los de separación de estos incluso en caso de cambio voluntario del empleador.<br>
                    Garantizar la seguridad e higiene en el trabajo adoptando cuantas medidas sean razonables para maximizar la prevención de los riesgos laborales.<br>
                    Procurar la conciliación del trabajo en ATZCO con la vida personal y familiar de los colaboradores.<br>
                    Procurar la integración laboral con los colaboradores con discapacidad o minusvalía, eliminando todo tipo de barreras de la empresa para su inserción.<br>
                    Facilitar la participación de los colaboradores en los programas de integración y acción social de ATZCO.
                </p>
                <br>
                <p><strong>d)	En relación con la Sociedad </strong></p>
                <p>Respetar el derecho humano y las instituciones democráticas y promoverlos donde sea posible.<br><br>
                    Mantener el principio de neutralidad política, no interfiriendo políticamente en las comunidades donde desarrolla sus actividades, como muestra además de respeto a las diferentes opiniones y sensibilidades de las personas vinculadas con ATZCO.<br>
                    Relacionarse con las autoridades e instituciones públicas de manera lícita y respetuosa no aceptando ni ofreciendo regalos o comisiones, en dinero o especie.<br>
                    Estamos comprometidos con los crecimientos económicos y sociales creando y manteniendo fuentes de empleo digno y productivo.<br>
                    Estamos comprometidos a buscar permanentemente los medios para disminuir el impacto en el medio ambiente mediante, la mejora continua en el control de emisiones, manejo de residuos, tratamiento de aguas, ahorro de energía y todo elemento que potencialmente le pueda afectar.
                </p>
                <p><strong>e)	Protección de activos</strong></p>
                <p>Nuestro compromiso es proteger y optimizar el valor de la inversión, principalmente a través de la utilización prudente y rentable de los recursos, vigilando que cumplan las normas de seguridad pertinentes.<br>
                    La custodia y preservación de los activos de ATZCO es responsabilidad de todos y cada uno de los que integramos la empresa.<br>
                    Entendemos por activos de la empresa  no solo la maquinaria , edificios, vehículos o mobiliario sino también los planos, diseños, formulas, procesos, sistemas , dibujos, tecnología, estrategias de negocio, y desde  luego nuestra marca.<br>
                    Los colaboradores tenemos el compromiso de salvaguardar los activos de la empresa. En especial, estamos comprometidos con la protección de la propiedad intelectual, representada esencialmente por sus procesos de fabricación, sistemas de información y esquemas de comercialización, incluyendo también información financiera, de producto y del personal.<br>
                    El uso de los activos se destinara al objeto del negocio y está estrictamente prohibido hacer otro uso de los mismos. Todos los colaboradores de ATZCO tenemos la obligación de denunciar cualquier desviación que sea de nuestro conocimiento.
                </p>
                <p><strong>f)	Privacidad</strong></p>
                <p>ATZCO respeta la privacidad de todos sus colaboradores, proveedores y clientes. Tratamos los datos personales con responsabilidad y en cumplimiento de todas las leyes de privacidad aplicables.</p>
                <p><strong>g)	Conflicto de interés</strong></p>
                <p>Esperamos que todos los colaboradores trabajen dedicadamente en beneficio de ATZCO y de todos los que la integramos, sin que nuestra toma de decisiones se vea afectada por cualquier factor que favorezca intereses ajenos a la productividad, eficiencia, eficacia el cumplimiento de nuestras metas.<br>
                    Con el propósito de evitar que se presenten conflictos entre los intereses personales y los de ATZCO, y para propiciar una solucione en caso de requerirse todos los colaboradores tenemos la responsabilidad de declarar cualquier interés financiero o de otra índole que pueda entrar en conflicto con la empresa.<br>
                    Si algún colaborador considera que existen interese personales que pueden influir en su desempeño en el trabajo o en su toma de decisiones habrá de comunicárselo por escrito a su jefe inmediato y/o Recursos Humanos.
                </p>
                <p><strong>h)	Integridad y corrupción</strong></p>
                <p>En ATZCO no sobornamos, no recibimos favores ni dinero para otorgar beneficios a quien sea.
                    Entendemos con toda claridad que para evitar estos actos, debemos remover cualquier anomalía para que no haya motivo alguno de caer en corrupción.
                    Sobornar para obtener algún beneficio no ayuda en la nada a ATZCO y la pone en una situación muy grave e impide su avance.
                    Recibir dinero, obsequios o favores afecta profundamente los resultados y pone en entredicho la reputación de la empresa y todos sus colaboradores.
                    Estas acciones son ilegales y puedes constituir un delito.
                </p>
                <p><strong>i)	Relaciones personales y familiares</strong></p>
                <p>Es importante comunicar al superior correspondiente las relaciones personales que surjan entre colaboradores o entre profesionales de ATZCO y colaboradores de un cliente, con el fin de prevenir eventuales riesgos de independencia y/o conflicto de interés.</p>
                <p><strong>j)	Faltas al código de ética</strong></p>
                <p>La observancia de este código es estrictamente obligatoria.<br>
                    Los Jefes de ATZCO, en cualquier nivel, serán ejemplo intachable de su cumplimiento, de difundirlo constantemente y tomara las medidas disciplinarias que correspondan cuando alguno de sus colaboradores lo incumpla.<br>
                    Cualquier colaborador que realice prácticas de negocios, en términos diferentes a las establecidas en este código, será sujeto a medidas disciplinarias que pueden llegar hasta la terminación de la relación laboral y/o acción legal.<br>
                    En ATZCO es inevitable que ocurran situaciones que no estén previstas en este código. En esos casos deben guiarnos el apego a la ley, nuestros valores y la buena voluntad.<br>
                    Los colaboradores de ATZCO siempre tendremos la libertad de consultar a nuestros jefes acerca de las situaciones donde se generen dudas.<br>
                    La Dirección General y Recursos Humanos incluirá en sus revisiones el cumplimiento de este código.<br><br>
                    La Dirección General Elaborará planes para la difusión de este código.<br><br>
                    Este Código entra en vigor a partir de Septiembre 2016.
                </p>
                <br><br><br><br><br><br><br><br><br><br><br><br>
                <p>Nombre y firma del colaborador</p>
                <p><strong><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " . $nombres; ?></strong></p>
            </div>
        </div>
        <p></p>
    </div>
</body>
</html>
