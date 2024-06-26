<?php
// Asegúrate de que los datos necesarios están presentes
if (!isset($datosEmpleado)) {
    echo "Datos del empleado no disponibles.";
    return;
}

// Extrae los datos necesarios para llenar la plantilla
$nombreCompleto = $datosEmpleado['empleado_nombres'] . ' ' . $datosEmpleado['empleado_apellido_paterno'] . ' ' . $datosEmpleado['empleado_apellido_materno'];
$domicilio = $datosEmpleado['empleado_domicilio'];
$diaIngreso = $datosEmpleado['empleado_dia_de_ingreso'];
$mesIngreso = $datosEmpleado['empleado_mes_de_ingreso'];
$anioIngreso = $datosEmpleado['empleado_año_de_ingreso'];
$estadoCivil = $datosEmpleado['empleado_estado_civil'];
$nacionalidad = 'MEXICANA'; // Asumido como constante
$sexo = $datosEmpleado['empleado_sexo'];
$puesto = $datosEmpleado['empleado_puesto_de_trabajo'];
$curp = $datosEmpleado['empleado_curp'];
$nss = $datosEmpleado['empleado_nss'];
$nombreEmpresa = 'CONSTRUCTORA ATZCO, S.A. DE C.V.';
$representanteLegal = 'Israel Rodríguez Escamilla';
$ciudad = $datosEmpleado['empleado_lugar_de_servicio_o_de_proyecto'];
$fechaActual = date('d/m/Y');
$sangre = $datosEmpleado['empleado_tipo_de_sangre'];
$numeroContrato = $datosEmpleado['empleado_numero_de_contrato'];
$salario = $datosEmpleado['empleado_salario_diario_integrado'];
$salarioEscrito = $datosEmpleado['empleado_salario_diario_integrado_escrito'];
$nombreEmergencia = $datosEmpleado['empleado_nombre_de_contacto_para_emergencia'];
$parentezcoEmergencia = $datosEmpleado['empleado_parentezco_con_el_contacto_de_emergencia'];
$telefonoEmergencia = $datosEmpleado['empleado_telefono_de_contacto_para_emergencia'];
$creditoInfonavit = $datosEmpleado['empleado_credito_infonavit'];
$testigo = $datosEmpleado['empleado_quien_lo_contrato'];


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
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTRATO INDIVIDUAL DE TRABAJO</title>


    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 40px;
            font-size: 14px;
        }
        .prefijo {
            display: inline-block; /* Hace que el span se comporte como un bloque pero en línea */
            width: 50px;          /* Establece un ancho fijo para el prefijo */
        }
        .prefijo2{
            display: inline-block;
            width: 50px;
        }

        .header,
        .footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            text-align: justify;
        }
        .content2 {
            text-align: justify;
            font-size: 7px;
        }
        .content-terms {
            text-align: justify;
            font-style: italic;
            font-size: 12px;
        }
        .content-terms2 {
            text-align: justify;
            font-style: italic;
        }
        .content-terms3 {
            text-align: justify;
            font-style: italic;
            font-weight: bold;
            font-size: 12px
        }
        .terminos{
            text-align: justify;
            font-style: italic;
            font-weight: bold;
            font-size: 20px;  
        }
        .underlined{
            font-style: underline;
        }

        .signature-block {
            text-align: center;
            margin-top: 30px;
        }

        .red-box {
            background-color: red;
            color: white;
            text-align: center;
            font-weight: bold;
        }
        .red-box2 {
            background-color: red;
            color: white;
            text-align: center;
            font-weight: bold;
            font-size: 9px;
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

        .signature-table {
            width: 100%;
            margin-top: 50px;
        }

        .signature-table td {
            width: 50%;
            vertical-align: top;
        }

        .titulo-centrado {
            text-align: center;
            font-weight: bold;
        }
        .indice {
            width: 100%;
            border-collapse: collapse;
        }

        .indice td {
            padding: 5px;
        }

        .indice td:nth-child(2) {
            text-align: right;
            white-space: nowrap;
        }

        .indice td:nth-child(1) {
            padding-right: 10px;
        }
        .centrado {
            text-align: center;
        }

        .page-break {
            page-break-before: always;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .blank-page .name-at-bottom {
            margin-top: auto;
            text-align: center;
        }

        .name-at-bottom {
            position: absolute;
            bottom: 20mm;
            width: 100%;
            text-align: center;
        }
        .blank-page {
            page-break-before: always;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }
        .tabled {
            width: 100%;
            border-collapse: collapse; /* Elimina el espacio entre los bordes */
        }
        .tabled th, .tabled td {
            padding: 8px;
            text-align: left;
            border: 1px solid black; /* Añade bordes sólidos a cada celda */
        }
        .tabled th, .tabled td {
            empty-cells: show; /* Asegura que las celdas vacías muestren bordes */
        }

    </style>
</head>

<body>

    <div class="content">
        <p>CONTRATO INDIVIDUAL DE TRABAJO POR OBRA DETERMINADA QUE CELEBRAN, POR UNA PARTE <strong><?php echo $nombreEmpresa; ?></strong>, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ <strong>“LA EMPRESA”</strong> Y POR LA OTRA, POR SU PROPIO DERECHO, <strong><?php echo $nombreCompleto; ?></strong> A QUIEN SE LE DENOMINARÁ <strong>“EL TRABAJADOR (A)”</strong>, DE CONFORMIDAD CON LAS SIGUIENTES DECLARACIONES Y SUBSECUENTES CLÁUSULAS.</p>

        <h3 class="titulo-centrado">DECLARACIONES:</h3>

        <h4>I.- DECLARA “LA EMPRESA”:</h4>
        <p><span class="prefijo">a)</span>Ser una sociedad mercantil debidamente constituida conforme a las leyes mexicanas, y estar 
        debidamente inscrita ante el Registro Público de la Propiedad y del Comercio de la ciudad de Salamanca, estado de Guanajuato.</p>
        <p><span class="prefijo">b)</span>Tener su domicilio en Cerrada. Boulevard paseo de los insurgentes #902 int. 7 Colonia Jardines del Moral, León Gto.
        </p>
        <h4>II.- DECLARA “EL TRABAJADOR (A)”:</h4>
            <p>a) Llamarse como ha quedado escrito en el encabezado de este contrato.</p>
            <p>b) Ser de nacionalidad Mexicana. <strong>PRIMERA.-</strong> "EL TRABAJADOR ( A )" se obliga a prestar a "LA EMPRESA" sus servicios por OBRA DETERMINADA a partir del día <?php echo $datosEmpleado['empleado_dia_de_ingreso'] . " " . $datosEmpleado['empleado_mes_de_ingreso'] . " " . $datosEmpleado['empleado_año_de_ingreso']; ?> y hasta el día que finalice el contrato <?php echo $datosEmpleado['empleado_numero_de_contrato']; ?> para desempeñar el cargo de: <?php echo $datosEmpleado['empleado_puesto_de_trabajo']; ?> que ejecutará en el domicilio ubicado en <?php echo $datosEmpleado['empleado_lugar_de_servicio_o_de_proyecto']; ?>, la cual una vez concluido el periodo de tiempo establecido en el presente contrato terminará la vigencia del mismo. "EL TRABAJADOR ( A )" prestará dichos servicios de forma subordinada bajo la dirección de los funcionarios designados al efecto, aceptando ejecutar al mismo tiempo aquellas labores similares y conexas, así como las que se deriven de los usos y prácticas, además de las señaladas en las disposiciones relativas en los procedimientos de trabajo, y administración del personal que "LA EMPRESA" tiene establecidos en relación a las actividades contratadas.</p>
            <p>c) Ser de sexo <?php echo $sexo; ?>.</p>
            <p>d) Ser su estado civil <?php echo $estadoCivil; ?>.</p>
            <p>e) Mayor de edad.</p>
            <p>f) Tener su domicilio en <?php echo $domicilio; ?>, y que es que señala para recibir notificaciones por parte de “LA EMPRESA”.</p>
            <p>g) Que su número de CURP es <?php echo $curp; ?>, y su número de afiliación ante el Instituto Mexicano del Seguro Social es <?php echo $nss; ?>.</p>
            <p>h) Que no tiene enfermedad ni incapacidad física o mental alguna que imposibilite para desempeñar el trabajo para el que se le contrata.</p>
            <p>i) Que cuenta con la capacidad, conocimientos y experiencia necesarios para prestar sus servicios personales en los términos del presente contrato.</p>
            <p>En virtud de lo anterior, ambas PARTES convienen en obligarse de acuerdo con las siguientes:</p>
            <br><br>

        <h3 class="titulo-centrado">CLAUSULAS:</h3>


        <p><strong>SEGUNDA.-</strong> "EL TRABAJADOR ( A )" prestará sus servicios a "LA EMPRESA" en el domicilio ubicado en SALAMANCA TIERRA BLANCA 400 COL BELLAVISTA C.P. 36730/o cualquiera de sus oficinas o sucursales ubicadas en el interior de la República Mexicana, por lo que previo su consentimiento podrá "LA EMPRESA" realizar los cambios necesarios al respecto, de acuerdo con sus necesidades, sin menoscabo de la categoría o salario asignados a "EL TRABAJADOR ( A )". Cuando por la naturaleza del trabajo "EL TRABAJADOR ( A )" tuviera que desempeñarlo fuera de las Instalaciones de "LA EMPRESA" deberá rendir un informe detallado de las labores y actividades desempeñadas en el local o empresa que se le asigne por parte de "LA EMPRESA", según las necesidades de ésta última.
            El presente contrato lo celebran las partes, conforme a lo estipulado en el artículo 39 A de la Ley Federal del Trabajo, el Trabajador se obliga a sus servicios personales, subordinado jurídicamente al Patrón, consistentes en: <?php echo $puesto ?> cuya descripción del puesto y/o funciones del mismo se adjuntan al presente contrato y son del conocimiento del Trabajador, con el único fin de verificar que éste cumple con los requisitos y conocimientos necesarios para desarrollar el trabajo que se le solicita. Durante este periodo de tiempo, el Trabajador disfrutará del salario, la garantía de seguridad social y de las prestaciones de la categoría o puesto que desempeñe. Al término del periodo de no acreditar el Trabajador que satisface los requisitos y conocimientos necesarios para desarrollar las labores, a juicio del Patrón, tomando en cuenta la opinión de la Comisión Mixta de Capacitación, Adiestramiento y Productividad en términos de la Ley Federal del Trabajo, así como la naturaleza de la categoría o puesto, se dará por terminada la relación de trabajo, sin responsabilidad para la Patrón
        </p>
        
        <p><strong>TERCERA.-</strong> "EL TRABAJADOR (A)" conviene con "LA EMPRESA", en prestar sus servicios dentro de las jornadas máximas previstas en la Ley Federal del Trabajo. Como consecuencia de lo anterior "EL TRABAJADOR (A)" se obliga a prestar sus servicios indistintamente dentro de dichas jornadas, que podrán ser distribuidas semanalmente de acuerdo con las necesidades de "LA EMPRESA" sin exceder los límites legales establecidos en los artículos 59, 60 y 61 de la Ley Federal de Trabajo vigente. Los tiempos de descanso durante la jornada de trabajo "EL TRABAJADOR (A)" podrá disfrutarlos fuera de la fuente de trabajo, de conformidad con lo establecido en el artículo 63 de la ley de la materia.</p>
        <p>Asimismo, el trabajador ( a ) conviene con "LA EMPRESA" que ésta podrá:</p>
        <p>a) Realizar, de manera temporal, la reducción del número de horas de la jornada de trabajo asignada a "EL TRABAJADOR ( A )", así como el ajuste correspondiente al salario a éste asignado dependiendo de las horas a laborar por el mismo, de acuerdo con las necesidades de "LA EMPRESA", considerando las exigencias del mercado de la industria al que "LA EMPRESA" provee de servicios y productos. No obstante estas reducciones de carácter temporal, sea su duración cual fuere, no sentarán precedente ni obligación para "LA EMPRESA", y una vez que resuelta sea la problemática que orillo a "LA EMPRESA" a la reducción de la jornada de trabajo y ajuste realizado al salario de "EL TRABAJADOR ( A )", "LA EMPRESA" restablecerá tanto la jornada de trabajo como el salario asignado a "EL TRABAJADOR ( A )" en las mismas condiciones previas a la reducción temporal referida</p>
        <p>b) "EL TRABAJADOR ( A )" está obligado a checar su tarjeta, plasmar su huella digital o firmar las listas de asistencia, a la entrada o la salida de sus labores, por lo que el incumplimiento de este requisito indicará la falta injustificada a sus labores, para todos los efectos legales.</p>
<br>
        <p><strong>CUARTA.-</strong>Las partes convienen que la retribución que se pagará a "EL TRABAJADOR (A)" por sus servicios será una cuota diaria de $<?php echo $salario; ?> <strong>(<?php echo $salarioEscrito; ?>)</strong>, o la cantidad que de acuerdo con el tabulador de salarios vigente se tenga convenida. Asimismo, que el salario le será pagado los días sábado de cada semana, el cual incluye la parte proporcional del Séptimo día.
            Las PARTES convienen que, en razón del Sistema Computarizado de pago establecido en "LA EMPRESA" cualquier cantidad entregada a "EL TRABAJADOR ( A )" en efectivo, cheque, depósito bancario o transferencia electrónica por concepto de sueldos o pago de prestaciones, en fecha posterior a la terminación de la relación de trabajo y, en su caso, cualquier cantidad entregada en exceso deberá ser reembolsada a "LA EMPRESA" de forma inmediata, de acuerdo a lo establecido en el artículo 110 de la Ley Federal de Trabajo vigente.
        </p>
        <p>"EL TRABAJADOR (A)" manifiesta en éste acto su consentimiento de manera expresa para que "LA EMPRESA", en caso de así considerarlo necesario, le cubra el pago de su salario y prestaciones a través de depósito en cuenta bancaria, tarjeta de débito, transferencia o cualquier otro medio electrónico, sin costo por el manejo de cuenta, quedando los retiros en cajeros de disposición en efectivo, sujetos a los lineamientos de la Institución Bancaria donde se le transfiera o deposite el pago de su salario y prestaciones.</p>

        <p><strong>QUINTA.-</strong> "EL TRABAJADOR (A)" se obliga a firmar todos los recibos de pago correspondientes que le expida "LA EMPRESA" y le sean entregados por la misma. Toda reclamación sobre el particular deberá hacerse precisamente al momento de firmar cada recibo, para que "LA EMPRESA", en caso de proceder dicha reclamación, realice el ajuste correspondiente y el pago del monto o de los montos que corresponda(n).</p>

        <p><strong>SEXTA.-</strong> Beneficiario "EL TRABAJADOR (A)" en este acto acorde a su consentimiento expreso y libre designa para el pago de salarios y prestaciones devengadas y no cobradas a la muerte del mismo a los siguientes beneficiarios y sus porcentajes:
            <br><br>
            Esposa(o):_________________________________________________________en____%
            Hijo(a):____________________________________________________________en____%
            Padre:_______________________________________________________________en____%
            Madre:_______________________________________________________________en____%
            Dependiente económico:_________________________________parentesco_________en____%
            <br>
        <p>Lo anterior en cumplimiento con lo establecido en el artículo 25 fracción X de la Ley Federal del Trabajo.</p>

        <p><strong>SEPTIMA.-</strong> "EL TRABAJADOR (A)" prestará sus servicios con el cuidado, intensidad y esmero apropiados, y expresamente se obliga a observar todas las instrucciones, políticas, reglamentos y manuales internos así como los Procedimientos que "LA EMPRESA" tiene establecidos o establezca, y a vigilar, en su caso, que estos sean cumplidos por el personal a su cargo, para el debido cumplimiento del trabajo referido en éste contrato.</p>

        <p><strong>OCTAVA.-</strong> "EL TRABAJADOR (A)" conviene en que dedicará al desempeño de sus labores el tiempo de manera efectiva de la duración de su jornada de trabajo a efecto de que no haya atraso ni retraso algunos en el trabajo contratado durante la vigencia del presente contrato. Asimismo, las partes convienen que "EL TRABAJADOR" no podrá laborar jornada extraordinaria, sin el previo consentimiento <strong><u>expreso y por escrito</u></strong> de "LA EMPRESA".</p>
        <br>
        <p><strong>NOVENA.-</strong>Las partes convienen que derivado de la importancia del trabajo contratado, regulado en éste contrato y materia del mismo, "EL TRABAJADOR (A)” manifiesta expresamente en éste acto su conformidad y conviene que se abstendrá de abandonar el mismo por ninguna razón o motivo, en ninguna etapa de la misma, salvo casos fortuitos o de fuerza mayor, y continuará en su cargo y en el desempeño de sus funciones hasta la conclusión del trabajo materia del presente contrato y durante la vigencia del mismo, referido de forma específica en la cláusula Primera del mismo.</p>

        <p><strong>DECIMA.-</strong>Las partes convienen que para el caso de que "EL TRABAJADOR (A)" abandone el trabajo materia del presente contrato, éste último (a) manifiesta expresamente en éste acto su conformidad y conviene de manera voluntaria que "LA EMPRESA" de acuerdo con su criterio podrá sancionarla de 1 a 7 días como máximo sin goce de sueldo. Para el caso de reincidencia, “LA EMPRESA” podrá rescindir el presente contrato, sin causa imputable alguna para la misma.</p>

        <p><strong>DECIMA PRIMERA</strong>Después de 1 (un) año de servicio, "EL TRABAJADOR (A)" tendrá derecho a disfrutar de un periodo de vacaciones pagadas, de acuerdo con el Artículo 76 de la Ley Federal del Trabajo, o en su caso, al pago proporcional al periodo de tiempo en que prestó sus servicios durante ese año.</p>
        <p>Asimismo, "EL TRABAJADOR (A)" disfrutará de un 25 % por concepto de prima vacacional, sobre el salario que le corresponda durante el periodo de vacaciones. Lo anterior, de acuerdo con lo establecido en los Artículos 79 y 80 de la Ley Federal Del Trabajo, vigente.</p>

        <p><strong>DECIMA SEGUNDA</strong> "EL TRABAJADOR (A)" gozará de los días de descanso obligatorios establecidos en el artículo 74 de la Ley Federal del Trabajo vigente. Para el caso de que "LA EMPRESA", de acuerdo con sus necesidades, requiera que "EL TRABAJADOR (A)" labore uno o varios de los días de descanso legal referidos, "EL TRABAJADOR (A)" acudirá a desempeñar sus labores de forma habitual, no obstante "LA EMPRESA" considerará en todo momento lo establecido en el artículo 73 de la Ley de la materia.</p>

        <p><strong>DECIMA TERCERA</strong> "LA EMPRESA" pagará a "EL TRABAJADOR (A)" el equivalente a 15 días de trabajo como aguinaldo, que se pagará antes del día 20 de Diciembre de cada año o, en su caso, en proporción al periodo de tiempo en que prestó sus servicios durante ese año. Además tendrá derecho al reparto de utilidades de "LA EMPRESA", de acuerdo con lo establecido en los Artículos 117 al 131 de la Ley Federal del Trabajo vigente.</p>

        <p><strong>DECIMA CUARTA</strong> Para seguridad de los contratantes, "EL TRABAJADOR (A)" estará obligado a someterse a los exámenes médicos que establezca "LA EMPRESA", y a poner en práctica las medidas profilácticas y de higiene que "LA EMPRESA" en apoyo con las Autoridades del ramo acuerden, en los términos de la fracción X del artículo 134 de la Ley Federal del Trabajo; en la inteligencia de que el médico que los practique será designado y retribuido por el patrón.</p>

        <p><strong>DECIMA QUINTA</strong> "EL TRABAJADOR (A)" se obliga a participar en todos y cada uno de los programas de capacitación, adiestramiento y productividad que se establezcan sea en el centro de trabajo o fuera del mismo, en cumplimiento de los planes y programas de capacitación y productividad de "LA EMPRESA". Las partes convienen que la capacitación podrá hacerse dentro o fuera de los horarios de trabajo indistintamente. "EL TRABAJADOR (A)" deberá asistir puntualmente a los cursos, sesiones de grupo, y demás actividades que forman parte de la capacitación o adiestramiento, así como atenderá las indicaciones del personal que imparta la capacitación y cumplirá con los programas respectivos; "EL TRABAJADOR (A)" deberá presentar los exámenes de conocimiento o competencia laboral que sean requeridos, de acuerdo con la capacitación y/o adiestramiento recibidos.</p>

        <p><strong>DECIMA SEXTA.-</strong> "EL TRABAJADOR (A)" reconoce que son propiedad exclusiva de "LA EMPRESA" los estudios, información, procedimientos, secretos comerciales, clientes, factibilidad de negocio, proyectos fallidos o no terminados, prospectos de clientes, folletos, publicaciones, manuales, dibujos, trazos, planos, diseños industriales, fotografías, “paquetes de software” y sistemas de informática o cualquier otro trabajo intelectual que "EL TRABAJADOR (A)" desarrolle durante la vigencia de este contrato y en general todos los documentos e información física, electrónica o verbal que se le proporcione o elabore con motivo de la relación de trabajo que le une con "LA EMPRESA", así como aquellos que el propio "TRABAJADOR (A)" prepare, descubra o formule en relación o conexión con sus servicios, por lo que se obliga a conservarlos en buen estado, a no sustraerlos del lugar de trabajo, salvo por necesidades del servicio y con la autorización expresa y por escrito de "LA EMPRESA", y a devolverlos en el momento que ésta se lo requiera o bien al término de la presente relación de trabajo, por el motivo que éste fuera. Asimismo, "EL TRABAJADOR (A)" conviene que estará obligado a guardar estricta reserva de la información, procedimientos y todos aquellos hechos y actos que con motivo de su trabajo sean de su conocimiento y por lo tanto se obliga a no utilizar en beneficio propio, o en beneficio de terceras personas ya sea directa o indirectamente, en forma enunciativa más no limitativa: información física, a través de documentos o medios electrónicos, secretos comerciales, secretos industriales, diseños industriales, trazados de circuito, lay outs, formulas, secretos de informática, de “software”, información de todo tipo que le sea proporcionada por "LA EMPRESA" y que sea parte integrante de la información de un tercero, logística, información en general de clientes o proveedores de "LA EMPRESA", bases de datos, y cualesquier tipo de información que se encuentren protegidos por la Ley y que puedan significar una ventaja competitiva para "LA EMPRESA". "EL TRABAJADOR (A)" deberá guardar absoluta confidencia sobre los asuntos que le sean encomendados o cualquier información que en razón de sus funciones llegase a tener en su poder, y usarla exclusivamente en beneficio del "LA EMPRESA" debiendo guardar expresa reserva sobre la información privilegiada que pudiera tener en su poder y le es confiada por "LA EMPRESA", y es propiedad de la misma, para el buen desempeño de sus funciones.</p>

        <p><strong>DECIMA SEPTIMA.-</strong> "EL TRABAJADOR (A)" se compromete a cumplir con la normatividad que establezca "LA EMPRESA" y con el REGLAMENTO INTERIOR DE TRABAJO de la misma, con relación a las políticas empresariales, disciplina, higiene, capacitación, adiestramiento, desarrollo de habilidades, seguridad y desempeño laboral, manifestando en éste acto de forma expresa y por escrito que a la firma de éste contrato ha recibido de "LA EMPRESA" copia simple del REGLAMENTO INTERIOR DE TRABAJO de la misma, el cual observará siempre en todas su partes y cumplirá durante la vigencia de la presente relación de trabajo con "LA EMPRESA".</p>

        <p><strong>DECIMA OCTAVA.-</strong> El presente Contrato podrá ser rescindido o terminado de conformidad a lo establecido en la Ley Federal de Trabajo vigente.</p>

        <p><strong>DECIMA NOVENA.-</strong> "EL TRABAJADOR (A)" se compromete a apegarse a las causales de suspensión temporal en la prestación de servicios sin responsabilidad para el Patrón, de acuerdo a lo establecido en los artículos 42 y 427 de la Ley Federal del Trabajo, por las cuales se confirma que no existe responsabilidad de remunerar por los días que dure dicha suspensión.</p>

        <p><strong>VIGESIMA.-</strong> "LA EMPRESA" podrá rescindir la presente relación laboral, sin responsabilidad para el mismo, en los siguientes casos:
        <p><strong>l.</strong> En caso de incompetencia evidente por parte de "EL TRABAJADOR (A)" en el desempeño de las funciones y actividades para las que se le contrata de conformidad con el presente contrato, así como por falta de probidad u honradez en el desarrollo de sus labores;</p>
        <p><strong>ll.</strong> Si "EL TRABAJADOR (A)" no cumple con las instrucciones, funciones y obligaciones determinadas por "LA EMPRESA" y sus representantes, y con las establecidas en el REGLAMENTO INTERIOR DE TRABAJO de ésta;</p>
        <p><strong>lll.</strong> Si "EL TRABAJADOR (A)" incurre en faltas graves a los principios y políticas empresariales de "LA EMPRESA", establecidas en el presente Contrato;</p>
        <p><strong>lV.</strong> Por la comisión, por parte de "EL TRABAJADOR (A)", de cualesquiera de los supuestos establecidos en el Artículo 47 de la Ley Federal del Trabajo.</p>
        </p>
        <br><br><br><br><br><br><br><br>
        <p><strong>VIGESIMA PRIMERA.-</strong> "LA EMPRESA" y "EL TRABAJADOR (A)" podrán dar por terminada la presente relación laboral, en los siguientes casos, de conformidad con lo establecido en el Artículo 53 de la Ley Federal del Trabajo:
            <br>
        <p><strong>l.</strong> El mutuo consentimiento de las partes;</p>
        <p><strong>ll.</strong> La muerte de "EL TRABAJADOR (A)";</p>
        <p><strong>lll.</strong> La incapacidad física o mental o inhabilidad manifiesta de "EL TRABAJADOR (A)" que haga imposible la prestación del trabajo, y</p>
        <p><strong>lV.</strong> Los casos a que se refiere el Artículo 434 de la Ley Federal del Trabajo.</p>
        </p>

        <p><strong>VIGESIMA SEGUNDA.-</strong> Las partes acuerdan sujetarse, en los casos no previstos en este contrato, a las disposiciones establecidas en la Ley Federal del Trabajo vigente y en el REGLAMENTO INTERIOR DE TRABAJO de "LA EMPRESA" y, en caso de conflicto, a los criterios y jurisdicción de la Junta de Conciliación y Arbitraje de la ciudad de León, Guanajuato.</p>

        <p>Las partes, conscientes del contenido, obligaciones, alcance y fuerza legal del presente contrato por tiempo determinado, lo firman y ratifican por duplicado ante testigos, en la ciudad de SALAMANCA, a los días <?php echo $diaIngreso; ?> del mes de <?php echo $mesIngreso; ?> de <?php echo $anioIngreso; ?></p>

        <table class="signature-table">
            <tr>
                <td>
                    <div class="signature-block">
                        <strong><p>"LA EMPRESA"</p></strong>
                        <br><br>
                        <p>________________________</p>
                        <p><strong>Ing. José Dolores Cu Guerrero</strong></p>
                        <p><strong>Apoderado Legal de</p></strong>
                        <p><strong>Constructora ATZCO, S.A. de C.V.</strong></p>
                        <br><br>
                        <p><strong>TESTIGO</strong></p>
                        <br>
                        <p>________________________</p>
                        <strong>
                            <p>Lic. Elizabeth Barrientos Ruiz</p>
                        </strong>
                    </div>
                </td>
                <td>
                    <div class="signature-block">
                        <p><strong>"EL TRABAJADOR (A)</strong>"</p>
                        <br><br>
                        <p>________________________</p>
                        <p><strong><?php echo $nombreCompleto ?></strong></p>
                        <br><br><br><br><br><br>
                        <p><strong>TESTIGO</strong></p>
                        <br>
                        <p>________________________</p>
                        <strong>
                            <p>Lic. <?php echo $testigo?></p>
                        </strong>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>




    <div class="content">
        <p><strong>CONSTRUCTORA ATZCO", S.A. DE C.V.</strong></p>
        <p>PRESENTE,</p>
        <p>POR MEDIO DEL PRESENTE ESCRITO, Y POR ASÍ CONVENIR A MIS INTERESES PERSONALES, DESDE ESTE MOMENTO LES INFORMO QUE RENUNCIO DE MANERA VOLUNTARIA A LA RELACIÓN DE TRABAJO QUE ME UNIA CON LA EMPRESA DENOMINADA <strong>"CONSTRUCTORA ATZCO", S.A. DE C.V.</strong></p>
        <p>ASIMISMO, MANIFIESTO EXPRESAMENTE QUE MIENTRAS PRESTE MIS SERVICIOS PARA LA EMPRESA, NO SUFRÍ ACCIDENTES DE TRABAJO, NI RIESGO PROFESIONAL ALGUNO. DE IGUAL FORMA, MANIFIESTO QUE RECIBÍ, A MI ENTERA SATISFACCIÓN, EL PAGO DE TODAS Y CADA UNA DE LAS PRESTACIONES LABORALES A QUE TENGO DERECHO TALES COMO VACACIONES, PRIMA VACACIONAL, AGUINALDO, PRIMA DE ANTIGÜEDAD, SALARIOS Y GRATIFICACIÓN, ASÍ COMO CUALESQUIER OTRAS PRESTACIONES A QUE PUDIERA TENER DERECHO Y ME PUDIERAN CORRESPONDER DE CONFORMIDAD CON LO ESTABLECIDO EN LA LEY FEDERAL DEL TRABAJO VIGENTE.</p>
        <p>ASI MISMO, MANIFIESTO EXPRESAMENTE QUE SIEMPRE LABORE UNA JORNADA LABORAL MAXIMA DE 48 HORAS SEMANALES, MANIFESTANDO ASI MISMO QUE JAMAS DESEMPEÑE JORNADA EXTRAORDINARIA EN BENEFICIO DE <strong>"CONSTRUCTORA ATZCO", S.A. DE C.V.”</strong></p>
        <p>DERIVADO DE LO ANTERIOR, MANIFIESTO QUE NO SE ME ADEUDA CANTIDAD ALGUNA POR NINGÚN CONCEPTO, POR LO QUE NO ME RESERVO ACCIÓN O DERECHO ALGUNOS QUE EJERCITAR EN CONTRA DE <strong>"CONSTRUCTORA ATZCO", S.A. DE C.V.”</strong>, ASÍ COMO EN CONTRA DE CUALQUIER OTRA PERSONA QUE PRESTE SUS SERVICIOS EN SU BENEFICIO, LA REPRESENTE LEGALMENTE, O SEA ACCIONISTA DE LA MISMA.</p>
        <p>POR LO ANTERIOR, RATIFICO EL PRESENTE ESCRITO EN TODAS Y CADA UNA DE SUS PARTES Y LO FIRMO AL CALCE, PARA TODOS LOS EFECTOS LEGALES A QUE HAYA LUGAR.</p>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <p><strong><?php echo $nombreCompleto; ?></strong></p>
<br>
        <h3 class="titulo-centrado">RECIBO DE FINIQUITO</h3>
        <p>RECIBÍ DEL ING. JOSE DOLORES CU GUERRERO, EN SU CARÁCTER DE REPRESENTANTE LEGAL DE <strong>"CONSTRUCTORA ATZCO", S.A. DE C.V.”</strong>, QUIEN ES MI ÚNICO PATRON, LA CANTIDAD DE $</p>
        <p><strong>POR LOS SIGUIENTES CONCEPTOS:</strong></p>
            <p><strong>1.</strong> Salarios Devengados: $</p>
            <p><strong>2.</strong> Aguinaldo: $</p>
            <p><strong>3.</strong> Vacaciones: $</p>
            <p><strong>4.</strong> Prima Vacacional: $</p>
            <p><strong>5.</strong> Horas Extras: $</p>
            <p><strong>6.</strong> Séptimos Días: $</p>
            <p><strong>7.</strong> Días de Descanso Obligatorios: $</p>
            <p><strong>8.</strong> Prima de Antigüedad: $</p>
            <p><strong>9.</strong> Gratificación: $</p>
        <p><strong>TOTAL QUE SE PAGA: $</strong></p>
        <p><strong>DEDUCCIONES</strong></p>
            <p><strong>1.</strong> PRÉSTAMOS: $</p>
            <p><strong>2.</strong> ADEUDOS: $</p>
        <p><strong>TOTAL DEDUCCIONES: $</strong></p>
        <p><strong>TOTAL A RECIBIR: $</strong></p>

        <div class="content">
        <p>Asimismo, quiero manifestar expresamente que durante todo el tiempo que labore para la sociedad mercantil denominada <strong>"CONSTRUCTORA ATZCO", S.A. DE C.V.”</strong>, quien reconozco como mi único patrón, me fueron cubiertos a mi entera y total satisfacción todos y cada uno de los conceptos mencionados anteriormente, por lo que a través del presente finiquito extiendo el más amplio recibo que en derecho proceda, manifestando además que no me reservo acción legal o derecho algunos que hacer valer en contra de cualquier persona ya sea física o moral, así como de cualquier persona que legalmente le represente o trabaje para dicha empresa.</p>
        <p>Por último, manifiesto expresamente y de manera voluntaria mi conformidad con el contenido del presente documento, mismo que firmo al calce, para todos los efectos legales a que haya lugar, en la ciudad de <?php echo $ciudad; ?>,</p>
        <br><br><br>
        <p class="centrado"><strong><?php echo $nombreCompleto; ?></strong></p>
    </div>

    <div class="blank-page">
            
    </div>

    <div class="content">
    <div class="name-at-bottom">

    <p><strong><?php echo $nombreCompleto; ?></strong></p>
        </div><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <p>CONVENIO DE CONFIDENCIALIDAD QUE CELEBRAN POR UNA PARTE LA SOCIEDAD DENOMINADA CONSTRUCTORA ATZCO SA DE CV, REPRESENTADA EN ESTE ACTO POR ISRAEL RODRÍGUEZ ESCAMILLA A QUIÉN EN LO SUCESIVO Y PARA EFECTOS DEL PRESENTE CONVENIO SE DENOMINARÁ “LA EMPRESA”, Y POR LA OTRA CUEVAS HERNANDEZ EDWIN RODOLFO Y A QUIÉN EN LO SUCESIVO Y PARA EFECTOS DEL PRESENTE CONVENIO SE DENOMINARÁ “EL CONFIDENTE”, AL TENOR DE LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS.</p>

        <h4 class="titulo-centrado">D E C L A R A C I O N E S</h4>
        <h4 class="titulo-centrado">I . LA EMPRESA, a través de su representante legal declara que:</h4>
        <p><span class="prefijo2"> a)</span> Es una sociedad mercantil debidamente constituida de conformidad con las leyes que rigen en la República Mexicana, como se desprende de la Escritura Pública número 16,419 de fecha 12 de Noviembre de 1992, otorgada ante la fe del Lic. Carlos A. Sotelo Regil Hernández Notario Público número 165 del Distrito Federal.</p>
        <p><span class="prefijo2"> b)</span> Su domicilio se encuentra en. Boulevard paseo de los insurgentes #902 int. 7 Colonia Jardines del Moral, León Gto.</p>
        <p><span class="prefijo2"> c)</span> Su representante legal, Israel Rodríguez Escamilla, cuenta con las facultades suficientes para celebrar el presente Convenio y obligar a su representada en términos del mismo y que dichas facultades no le han sido modificadas, limitadas o restringidas en forma alguna a la fecha del presente Convenio, como se desprende de la escritura pública número 29,286, de fecha 29 de Agosto del 2012, otorgada ante la fe del Lic. Alejandro Duran Llamas, Notario Público número 44 de la ciudad de León, Gto.</p>
        <p><span class="prefijo2"> d)</span>Cuenta con las facultades suficientes para celebrar el presente Convenio y obligarse en términos del mismo.</p>
        <p><span class="prefijo2"> e)</span>En virtud de los servicios que presta, sus empleados tienen acceso a su Información Confidencial, así como a Información Confidencial de los clientes de la Empresa; dicha información es considerada de gran valor para cualquier persona relacionada directa o indirectamente con el sector y mercados en los que tanto la empresa como sus clientes llevan a cabo sus operaciones.</p>
        <p><span class="prefijo2"> f)</span> Que en virtud de la relación laboral de EL CONFIDENTE con LA EMPRESA, desde <?php echo $diaIngreso  ?> de <?php echo $mesIngreso ?> de <?php echo $anioIngreso ?> ha tenido acceso a toda la Información Confidencial (según dicho término se define más adelante) de LA EMPRESA, de sus clientes, así como de las compañías relacionadas directa o indirectamente con la misma. Dicha información se encuentra vinculada con el objeto social y las operaciones desarrolladas por LA EMPRESA y los clientes de la misma, con su manejo y cuestiones estructurales, así como con derecho de propiedad intelectual propiedad de cada una de las personas mencionadas anteriormente. Se considerará Información Confidencial, independientemente de lo establecido en la Cláusula Segunda del presente Convenio, y en forma enunciativa más no limitativa, la descrita en <strong>Anexo A</strong> del presente Convenio, el cual forma parte integrante del mismo.</p>
        <p><span class="prefijo2"> g)</span> Por la delicadeza, valor, ventaja que implica, relevancia o características de la documentación e Información Confidencial a la que EL CONFIDENTE tiene acceso, sea propiedad de LA EMPRESA, de sus clientes, de personas jurídicamente relacionadas o de terceros, desea que EL CONFIDENTE: (1) se obligue a guardar plena discreción y confidencialidad de éstas, (2) se obligue a indemnizarle por los daños o perjuicios que el incumplimiento de las obligaciones derivadas de este Convenio pudiera generarle y (3) sea consciente de algunas de las consecuencias jurídicas que el incumplimiento de las obligaciones aquí adquiridas puede generar.</p>
</div>
<br>
        <h4>II. EL CONFIDENTE declara que:</h4>
        <p>a) Tener nacionalidad Mexicana.</p>
        <p>b) Estado Civil SOLTERO.</p>
        <p>c) Que tiene como domicilio el ubicado en <?php echo $domicilio ?> mismo que señala para oír y recibir todo tipo de notificaciones en los términos de la ley federal del trabajo, legislación civil y mercantil aplicable, obligándose a proporcionar cualquier cambio de domicilio y en caso de que no lo hiciere, acepta que serán válidas las que se practiquen en el antes señalado.</p>
        <p>d) Cuenta con las facultades suficientes para celebrar el presente Convenio y obligarse en términos del mismo.</p>
        <p>e) Reconoce que como consecuencia de su relación laboral con LA EMPRESA, y de las actividades que ha venido desempeñando y desempeñará en la misma, ha tenido pleno acceso a información que resulta delicada, valiosa, ventajosa o relevante para la propia EMPRESA, para sus clientes, para personas jurídicamente relacionadas con ésta o para terceros, y que su uso, revelación o divulgación no autorizada, podría causar graves repercusiones jurídicas y económicas a dichas personas.</p>
        <h4>III. Ambas Partes declaran que:</h4>
        <p>a) Que por así convenir a sus intereses, es su deseo y libre voluntad obligarse a lo dispuesto por las siguientes:</p>
        <h3 class="titulo-centrado">C L A U S U L A S</h3>
        <p><strong>PRIMERA.-</strong> Se tienen por puestas todas y cada una de las DECLARACIONES inmediatas anteriores en la presente cláusula como si a la letra se insertasen, para todos los efectos legales a los que haya lugar.</p>
        <p><strong>SEGUNDA.-</strong> EL CONFIDENTE se obliga a guardar en pleno secreto y confidencia la totalidad de la documentación e información a la que tiene acceso como consecuencia directa o indirecta de su relación laboral con LA EMPRESA y con los clientes de la misma, la cual se encuentra descrita en forma enunciativa, más no limitativa, en el Anexo A del presente Convenio (la “Información Confidencial”).
        <p>No se considerará que la documentación o información es confidencial, relevante o delicada para LA EMPRESA cuando sea del dominio público legítimamente o cuando deba ser divulgada por disposición legal o por orden de autoridad competente.</p>
        <p><strong>TERCERA.-</strong> EL CONFIDENTE se obliga a no mantener en su poder copia alguna o reproducción, total o parcial de la documentación o Información Confidencial señalada, bajo cualquier forma o medio de constancia, archivo o almacenamiento, salvo que sea para cumplir las obligaciones de carácter laboral o jurídicas que hayan pactado.</p>
        <p><strong>CUARTA.-</strong> Toda la Información o documentación comercial relevante, delicada o secreta de LA EMPRESA y/o de sus clientes, tiene el carácter de confidencial, y por tanto de secreto industrial, en los términos del artículo 82 de la Ley de la Propiedad Industrial, por tratarse de aplicaciones de carácter industrial y/o comerciales que significan obtener o mantener una ventaja competitiva o económica frente a terceros en la realización de las actividades económicas que le son propias a LA EMPRESA y/o a los clientes de la misma, y respecto de las cuales se han adoptado los medios o sistemas suficientes para preservar su confidencialidad y acceso restringido.</p>
        <p>De acuerdo con lo anterior, EL CONFIDENTE manifiesta para todos los efectos a que haya lugar, que conoce y entiende cabalmente el artículo 223 de la Ley de la Propiedad Industrial, conforme al cual, las siguientes conductas inadecuadas respecto del manejo de los secretos industriales se tipifican como delictivas:</p>
        <p><strong>“Artículo 223</strong>: Son delitos:</p>
        <p class="content-terms2">...IV. Revelar a un tercero un secreto industrial, que se conozca con motivo de su trabajo, puesto, cargo, desempeño de su profesión, relación de negocios o en virtud del otorgamiento de una licencia para su uso, sin consentimiento de la persona que guarde el secreto industrial, habiendo sido prevenido de su confidencialidad, con el propósito de obtener un beneficio económico para sí o para el tercero o con el fin de causar un perjuicio a la persona que guarde el secreto;</p>
        <p class="content-terms2">V. Apoderarse de un secreto industrial sin derecho y sin consentimiento de la persona que lo guarde o de su usuario autorizado, para usarlo o revelarlo a un tercero, con el propósito de obtener un beneficio económico para sí o para el tercero o con el fin de causar un perjuicio a la persona que guarde el secreto industrial o a su usuario autorizado, y</p>
        <p class="content-terms2">VI. Usar la información contenida en un secreto industrial, que conozca por virtud de su trabajo, cargo o puesto, ejercicio de su profesión o relación de negocios, sin consentimiento de quien lo guarde o de su usuario autorizado, o que le haya sido revelado por un tercero, a sabiendas que éste no contaba para ello con el consentimiento de la persona que guarde el secreto industrial o su usuario autorizado, con el propósito de obtener un beneficio económico o con el fin de causar un perjuicio a la persona que guarde el secreto industrial o su usuario autorizado…”</p>
        <p><strong>QUINTA.-</strong> Si EL CONFIDENTE fuera requerido por autoridad competente de cualquier tipo para revelar información delicada, relevante o Información Confidencial de LA EMPRESA y/o de clientes de la misma, se obliga a dar aviso por escrito a LA EMPRESA y/o al cliente de que se trate, dentro de los 3 (tres) días hábiles siguientes a la recepción del documento respectivo, con la finalidad de que la parte que corresponda pueda ejercitar los actos o derechos que correspondan para salvaguardar sus intereses.</p>
        <p><strong>SEXTA.-</strong> EL CONFIDENTE al momento de la terminación de la relación de trabajo con LA EMPRESA, se obliga a devolver en ese mismo momento, en el domicilio que LA EMPRESA ha señalado en las Declaraciones del presente Convenio, o en su defecto la que la misma le señale, absolutamente toda la Información Confidencial que obre en su poder, sea propiedad de LA EMPRESA o de los clientes de la misma, especialmente la detallada en el <b>Anexo A</b> de este Convenio, y a no mantener en su poder ninguna copia o reproducción, total o parcial de la información señalada bajo cualquier forma o medio de constancia o almacenamiento.</p>
        <p><strong>SÉPTIMA.-</strong> EL CONFIDENTE se obliga a sacar en paz y a salvo e indemnizar inmediatamente a LA EMPRESA y/o a los clientes de la misma, por cualquier daño o perjuicio que el incumplimiento de las obligaciones adquiridas en este Convenio le causara.</p>
        <p><strong>OCTAVA.-</strong> Este Convenio tendrá una vigencia de 5 cinco años a partir de la fecha de firma de este documento, sin perjuicio de que EL CONFIDENTE no podrá en ningún momento usar o disponer de documentación o Información Confidencial que no le sea propia por sí mismo o por interpósita persona física o moral.</p>
        <p><strong>NOVENA.-</strong> Las obligaciones expuestas en este convenio tendrán efectos en toda la República Mexicana.</p>

        <p><strong>DÉCIMA.-</strong> Para cualquier notificación, aviso o comunicado vinculado con este convenio, las Partes señalan como sus domicilios convencionales los siguientes:</p>
        <table class="tabled">
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
        <p><strong>DÉCIMA PRIMERA.-</strong> Este Convenio constituye y expresa el total entendimiento entre las Partes en relación con su objeto, así como su total entendimiento y condiciones, ya sean implícitas o expresas, orales o escritas. Ni el Convenio en su totalidad ni alguna parte del mismo podrán ser alterados, cambiados, renunciados o modificados sino mediante un convenio por escrito debidamente aceptado y firmado por ambas Partes.</p>
        <p><strong>DÉCIMA SEGUNDA.-</strong> La invalidez o exclusión de alguna de las Cláusulas de este Convenio o parte de ella, no modificará ni alterará el contenido de las cláusulas que permanezcan, mismas que deberán continuar en vigor y en efecto, e interpretadas como si las inválidas o excluidas no hubieren sido insertadas.</p>
        <p><strong>DÉCIMA TERCERA.-</strong> En caso de que EL CONFIDENTE incumpla con las obligaciones asumidas en el presente convenio, se obliga a pagar a LA EMPRESA la cantidad de $3’000,000.00 (Tres Millones de Pesos 00/100 M.N.); bien sea por incumplimiento en forma parcial o total, con o sin beneficio económico; por incumplimiento llevado a cabo por sí mismo o por medio de terceros.</p>
        <p>Independientemente de la cantidad que deba pagar EL CONFIDENTE por dicho incumplimiento, LA EMPRESA podrá presentar la querella por el delito de revelación de secretos tipificado en el Código Penal para el Estado de Guanajuato en su artículo 229 o bien por el delito que corresponda ante las autoridades judiciales en materia penal, así como el pago de daños y perjuicios ante el juzgado civil en turno y/o a interponer demanda en cualquier vía según sea el caso.</p>

        <p><strong>DÉCIMA CUARTA.-</strong> Para la interpretación y cumplimiento de este Convenio las Partes aceptan sujetarse a la jurisdicción y leyes de los Tribunales competentes de la ciudad de León, Guanajuato, renunciando expresamente a cualquier otro fuero que por razón de sus domicilios presentes o futuros, o por cualquier otra razón, pudiera corresponderles.</p>
        <p><strong>DÉCIMA QUINTA.-</strong> El presente Convenio y sus Anexos son la compilación completa y exclusiva de todos los términos y condiciones que rigen el acuerdo de las Partes en relación con el objeto del mismo. Ninguna declaración de ningún agente, empleado o representante de LA EMPRESA realizada con anterioridad a la celebración del presente Convenio admitida en la interpretación de los términos del mismo. En caso de que existiera conflicto entre el texto del presente Convenio y su Anexo, el texto del presente Convenio prevalecerá sobre el Anexo.</p>

        <p>Leído que fue este Convenio por las Partes y enteradas plenamente de su contenido y efectos legales y no existiendo ninguna clase de vicio, dolo o mala fe, ambas lo firman en original en 2 (dos) tantos de conformidad, en la ciudad de <?php echo $ciudad ?>, el día <?php echo $diaIngreso ?> de <?php echo $mesIngreso ?> de <?php echo $anioIngreso ?></p>
        <br><br><br><br><br>

        <table class="signature-table">
            <tr>
                <td>
                    <div class="signature-block">
                        <p>LA EMPRESA</p>
                        <p>________________________</p>
                        <strong>
                            <p class="company-name">CONSTRUCTORA ATZCO SA DE CV</p>
                        </strong>
                        <strong>
                            <p>ING. ISRAEL RODRÍGUEZ ESCAMILLA</p>
                        </strong>
                    </div>
                </td>
                <td>
                    <div class="signature-block">
                        <p>EL CONFIDENTE</p>
                        <p>________________________</p>
                        <strong>
                            <p class="signature-name"><?php echo $nombreCompleto; ?></p>
                        </strong>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="signature-block">
                        <p>TESTIGO</p>
                        <p>________________________</p>
                        <strong>
                            <p class="signature-name">LIC. ELIZABETH BARRIENTOS RUIZ</p>
                        </strong>
                    </div>
                </td>
                <td>
                    <div class="signature-block">
                        <p>TESTIGO</p>
                        <p>________________________</p>
                        <strong>
                            <p class="signature-name">MARISOL SANTOS RAMOS</p><strong>
                    </div>
                </td>
            </tr>
        </table>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

        <div class="content">
            <h3 class="titulo-centrado">ANEXO A</h3>

            <p>ESTE ANEXO FORMA PARTE INTEGRANTE DEL CONVENIO DE CONFIDENCIALIDAD CELEBRADO ENTRE CONSTRUCTORA ATZCO SA DE CV, REPRESENTADA EN ESTE ACTO POR ISRAEL RODRÍGUEZ ESCAMILLA, EN LO SUCESIVO DENOMINADA LA EMPRESA, Y <?php echo $nombreCompleto ?> DE FECHA <?php echo $diaIngreso ?> <?php echo $mesIngreso ?> <?php echo $anioIngreso; ?> </p>

            <p>A continuación se detalla de manera enunciativa y no limitativa, parte de la Información Confidencial a la que por virtud del Convenio celebrado, se obliga a guardar pleno secreto y discreción:</p>

            <ul>
                <li>Manuales integrados propiedad de LA EMPRESA en donde se establecen políticas de gestión de la calidad, seguridad, salud laboral y ambiental que tengan como finalidad y objetivo el uso racional de los recursos de la empresa, reducción de contaminación y generación de residuos, prevención de riesgos, enfermedades y/o accidentes de trabajo.</li>
                <li>Manuales y procedimientos del sistema integrado de gestión de la calidad propiedad de LA EMPRESA en donde se establecen control de documentos, control de registros, elaboración de plan de calidad, licitaciones y propuestas, compras, control de almacén, recursos humanos, mantenimiento a infraestructura, fichas de procesos, entre otros.</li>
                <li>Manuales y procedimientos del sistema integrado de gestión de la calidad propiedad de LA EMPRESA en las diferentes ramas de seguridad y salud ocupacional.</li>
                <li>Manuales y procedimientos del sistema integrado de gestión de la calidad propiedad de LA EMPRESA en la rama del medio ambiente, respecto de los diferentes procesos y políticas en el manejo de residuos peligrosos, residuos no peligrosos, manejo y control de residuos sanitarios, conservación y protección de la flora y fauna, atención a derrames y fugas, así como todo lo relacionado con la identificación y evaluación de aspectos ambientales.</li>
                <li>Información relativa a precios y costos de mercancías; información contable y financiera; información de volúmenes y consumos de la empresa, sus filiales, partes relacionadas, así como de los clientes de las mismas.</li>
                <li>Información de los proveedores que le suministran insumos a LA EMPRESA y a los clientes de la misma.</li>
                <li>Información relativa a insumos estratégicos de LA EMPRESA y de los clientes de la misma. De forma enunciativa más no limitativa, se define como estratégicos aquellos productos que representen una parte importante de los costos del servicio o aquellos productos y servicios que por sus características o entorno del mercado, contribuyan con un beneficio adicional.</li>
                <li>Información relativa a costos, proveedores, redes de distribución, y cualquier otra que sea relativa respecto a la línea de productos y servicios en los que participan LA EMPRESA y los clientes de la misma.</li>
                <li>Información relativa a las negociaciones efectuadas por LA EMPRESA y los clientes de la misma, con sus respectivos proveedores y/o clientes, así como a la logística, distribución de la operación, términos y condiciones de pago, mecanismos de fondeo, y cualquier otros mecanismo o producto financiero y/o instrumento bursátil utilizado en las operaciones.</li>
                <li>Manejo de LA EMPRESA y de los clientes de la misma, información de procedimientos y trámites internos y externos, incluyendo de manera enunciativa pero no limitativa los documentos que contengan las estrategias de LA EMPRESA y/o de sus clientes, así como know how o conocimiento adquirido, entre otros.</li>
                <li>Información o documentación confidencial, relevante o delicada para o relacionada con LA EMPRESA o con los clientes de la misma, sus accionistas, funcionarios, directivos, trabajadores, prestadores de servicios, colaboradores, proveedores, o personas de cualquier manera vinculadas jurídicamente con las anteriores.</li>
                <li>Información referente a la administración, contabilidad, situación fiscal, estados financieros, planta laboral, principales ejecutivos, software, integración de su capital, accionistas, proyectos por desarrollar, relaciones comerciales, financieras y de negocios de LA EMPRESA y/o de los clientes de la misma.</li>
            </ul>

            <p>Se considera Información Confidencial, relevante y delicada para LA EMPRESA y/o para los clientes de la misma (según se define en el cuerpo principal del Convenio), todo lo relacionado directa o indirectamente con los rubros antes mencionados, entre otros las claves de acceso (passwords), saldos, disponibilidades, características, manejos históricos o de cualquier clase, etc.</p>

            <p><?php echo $ciudad; ?> a <?php echo $diaIngreso ?> <?php echo $mesIngreso ?> de <?php echo $anioIngreso ?> </p>

            <table class="signature-table">
                <tr>
                    <td>
                        <div class="signature-block">
                            <p>LA EMPRESA</p>
                            <p>________________________</p>
                            <strong><span>CONSTRUCTORA ATZCO SA DE CV</span></strong>
                            <p><strong>ING. ISRAEL RODRÍGUEZ ESCAMILLA</strong></p>

                        </div>
                    </td>
                    <td>
                        <div class="signature-block">
                            <p>EL CONFIDENTE</p>
                            <p>________________________</p>
                            <strong>
                                <p><?php echo $nombreCompleto; ?></p>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="signature-block">
                            <p>TESTIGO</p>
                            <p>________________________</p>
                            <p><strong>LIC. ELIZABETH BARRIENTOS RUIZ</strong></p>
                        </div>
                    </td>
                    <td>
                        <div class="signature-block">
                            <p>TESTIGO</p>
                            <p>________________________</p>
                            <p><strong>MARISOL SANTOS RAMOS</strong></p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <div class="red-box">AVISO DE PRIVACIDAD Y/O COLABORADORES</div>
        <p class="centrado"><?php echo $ciudad; ?> a <?php echo $diaIngreso; ?> <?php echo $mesIngreso; ?> <?php echo $anioIngreso; ?>.</p>
        <p class="terminos"><?php echo $nombreCompleto;?>, <small>(el "Titular") con domicilio en</small> <?php echo $domicilio; ?></p>
<p class="content-terms3">AVISO DE PRIVACIDAD relacionado con los datos personales de los Prospectos y/o Colaboradores, (en adelante el “Titular”), recabados por CONSTRUCTORA ATZCO, S.A. DE C.V., sus filiales y subsidiarias (en adelante denominada como “ATZCO”).</p>
<div class="content-terms">
    <p><strong>1.-Generales</strong></p>
    <p>1.1.- ATZCO es una persona moral comprometida y respetuosa de los derechos sobre los datos personales de las personas físicas, reconocidos en el artículo 16, párrafo II de la Constitución Política de los Estados Unidos Mexicanos, así como de las disposiciones de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, su Reglamento y la demás normativa aplicable. Por lo anterior, pone a su disposición el presente Aviso de Privacidad, en aras de que el titular de los datos personales, se encuentre facultado a ejercitar su derecho a la autodeterminación informativa.</p>
    <p>1.2.- Que derivado de los procesos de selección de y administración de personal que lleva a cabo ATZCO, requiere inminentemente obtener y almacenar los datos personales sensibles y no sensibles de EL TITULAR, por lo que es su deseo tratar los datos personales de éste, de conformidad con lo estipulado en el presente Aviso de Privacidad. Si EL TITULAR no acepta en forma absoluta y completa los términos y condiciones de este Aviso, deberá abstenerse de compartir cualquier tipo de información a ATZCO por cualquier medio.</p>
    <p>1.3.- EL TITULAR, es una persona física, mayor de edad, con capacidad jurídica, que reconoce que derivado del proceso de selección de personal, al que es su deseo someterse, ATZCO directamente o a través del Encargado, requiere realizar el tratamiento de sus datos personales, sensibles y no sensibles y, por lo tanto, otorga su consentimiento expreso a ATZCO, para que éste los trate, en términos de lo estipulado en el presente Aviso de Privacidad.</p>
    <p>Las partes declaran que, al no existir error, dolo, mala fe o cualquier otro vicio de la voluntad que pudiera nulificar la validez del presente instrumento, ambas acuerdan en sujetarse al tenor de lo estipulado en el presente documento:</p>
    <p><strong>2.- Definiciones</strong></p>
    <p><strong>2.1.- Datos personales.-</strong> Cualquier información concerniente a una persona física identificada o identificable.</p>
    <p><strong>2.2.- Datos personales sensibles.-</strong> Aquellos datos personales que afecten a la esfera más íntima de su TITULAR, o cuya utilización indebida pueda dar origen a discriminación o conlleve un riesgo grave para éste. En particular, se consideran sensibles aquellos que puedan revelar aspectos como origen racial o étnico, estado de salud presente y futuro, información genética, creencias religiosas, filosóficas y morales, afiliación sindical, opiniones políticas, preferencia sexual.</p>
    <p><strong>2.3.- Titular.-</strong> La persona física (EL TITULAR) a quien identifican o corresponden los datos personales.</p>
    <p><strong>2.4.- Responsable.-</strong> Persona física o moral (ATZCO) de carácter privado que decide sobre el tratamiento de los datos personales.</p>
    <p><strong>2.5.- Encargado.-</strong> La persona física o moral que sola o conjuntamente con otras trate datos personales por cuenta del responsable.</p>
    <p><strong>2.6.- Tratamiento.-</strong> La obtención, uso (que incluye el acceso, manejo, aprovechamiento, transferencia o disposición de datos personales), divulgación o almacenamiento de datos personales por cualquier medio.</p>
    <p><strong>2.6.1.- Transferencia.-</strong> Toda comunicación de datos realizada a persona distinta del responsable o encargado del tratamiento.</p>
    <p><strong>2.6.2.- Remisión.-</strong> La comunicación de datos personales entre el responsable y el encargado, dentro o fuera del territorio mexicano.</p>
    <p><strong>2.7.- Tercero.-</strong> La persona física o moral, nacional o extranjera, distinta del titular o del responsable de los datos.</p>
    <p><strong>2.8.- Derechos ARCO.-</strong> Derechos de Acceso, Rectificación, Cancelación y Oposición.</p>
    <p><strong>2.9.- Consentimiento Tácito.-</strong> Se entenderá que EL TITULAR ha consentido en el tratamiento de los datos, cuando habiéndose puesto a su disposición el Aviso de Privacidad, no manifieste su oposición.</p>
    <p><strong>2.10.- Finalidades Primarias.-</strong> Son aquellas finalidades para las cuales se solicitan principalmente los datos personales y por lo que se da origen a la relación entre ATZCO y EL TITULAR.</p>
    <p><strong>2.11.- Finalidades Secundarias.-</strong> Son aquellas finalidades que no son imprescindibles para la relación entre ATZCO y EL TITULAR, pero que con su tratamiento contribuyen al cumplimiento del objeto social.</p>
    <p><strong>3.- Identidad y domicilio del responsable que trata los datos personales</strong></p>
    <p>3.1.- La responsable del tratamiento de los datos personales es CONSTRUCTORA ATZCO, S.A. DE C.V., persona moral constituida de conformidad con las leyes de la República Mexicana, (en adelante denominada como ATZCO), quien se compromete a respetar lo establecido en el presente Aviso de Privacidad (en lo sucesivo el “Aviso” o el “Aviso de Privacidad” indistintamente), mismo que está puesto a su disposición en cumplimiento de lo establecido en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares (en lo sucesivo la “Ley” o “LFPDPPP” indistintamente) y es aplicable respecto de los datos personales de EL TITULAR.</p>
    <p>3.2.- El domicilio que para los efectos del presente Aviso establece ATZCO es el ubicado en Boulevard Paseo de los Insurgentes No.902 Int. 7 Col. Jardines del Moral León Guanajuato. y/o su portal de internet es www.atzco.com.mx.</p>
    <p><strong>4.- Datos que se recaban y su origen</strong></p>
    <p>EL TITULAR acepta y reconoce que ATZCO obtendrá directamente, a través de recomendaciones de otros colaboradores, a través de Bolsas de Trabajo o publicaciones en redes sociales los datos personales sensibles y no sensibles de EL TITULAR, mismos que corresponden a los siguientes:</p>
    <p><strong>Generales:</strong> Nombre, Dirección, Teléfono de casa y para recados, teléfono móvil, dirección de correo electrónico, estado civil, número de seguridad social, afore, Clave Única de Registro de Población, dirección y fotografías. </p>
    <p><strong>Académicos:</strong> nivel de estudios, escuela, período de estudios, manejo de idiomas y software, cursos de capacitación, pasatiempos, características de la personalidad, valores.</p>
    <p><strong>Referencias personales (de las cuales, EL TITULAR asegura contar con el consentimiento para compartir los datos personales de dichos terceros):</strong> nombre, domicilio, teléfono, ocupación, tiempo de conocerle y motivo de conocerle. </p>
    <p><strong>Referencias laborales (de las cuales, EL TITULAR asegura contar con el consentimiento para compartir los datos personales de dichos terceros):</strong> empresas donde ha laborado, nombre de los jefes inmediatos, sueldos percibidos, teléfonos, motivos de salida. </p>
    <p><strong>Datos familiares:</strong> nombres y ocupación de padres y hermanos, nombres de hijos y cónyuge.</p>
    <p><strong>Datos Médicos:</strong> Estado de salud actual, enfermedades, padecimientos, operaciones, accidentes, hábitos alimenticios, deportes y vicios.</p>
    <p><strong>Vida social:<strong> pasatiempos, grupos y asociaciones y religión. </p>
    <p><strong>Datos Económicos:</strong> Cuentas bancarias, gastos actuales, servicios adquiridos y créditos, nivel de ingresos y egresos, propiedades.</p>
    <p>4.1.- EL TITULAR en este acto, otorga su consentimiento expreso en términos del artículo 9 de la ley de la materia, para que ATZCO, trate sus datos personales, incluidos los denominados sensibles, contenidos en ésta cláusula, para cumplir con las finalidades que establece el presente Aviso de Privacidad y en cumplimiento de la legislación vigente se recabará el consentimiento expreso, por escrito y con la firma autógrafa del TITULAR a través del presente.</p>
    <p>4.2.- ATZCO manifiesta que única y exclusivamente accederá y, tratará los datos personales de EL TITULAR, a efecto de llevar a cabo la selección, contratación y administración de personal, debiendo realizar el tratamiento de los datos personales de conformidad con el presente aviso de privacidad.</p>
    <p>4.3.- EL TITULAR en este acto, bajo protesta de decir verdad, acepta que los datos que ha proporcionado a ATZCO son veraces, actuales y correctos. Además, se compromete a sacar en paz y a salvo a ATZCO de cualquier demanda o reclamación, derivada de los errores en los datos que le haya entregado.</p>
    <p>4.4.- ATZCO manifiesta que podrá obtener los datos personales de EL TITULAR mediante las denominadas fuentes de acceso público, a efecto de validar y actualizar los datos de EL TITULAR, respetando en todo momento la expectativa razonable de privacidad, a que se refiere el artículo 7 de la LFPDPPP.</p>
    <p><strong>5.- Finalidades del tratamiento de los datos personales</strong></p>
    <p>5.1.- ATZCO acepta y reconoce que podrá tratar los datos personales de EL TITULAR, directamente y/o a través de encargados, de conformidad al tipo de relación que tiene con EL TITULAR, para las siguientes finalidades primarias:</p>
    <ul>
        <li>Contactarlo para efectuar los trámites que en su momento se estén llevando a cabo.</li>
        <li>Validar la información personal presentada por el titular de los datos.</li>
        <li>Contactar a sus familiares para el caso de emergencia.</li>
        <li>Hacer intercambios de bolsas de trabajo con terceros y hacer recomendaciones personales de EL TITULAR o dar referencias al respecto del mismo. </li>
        <li>Conocer las competencias lingüísticas, experiencia laboral y el estado de salud de EL TITULAR a efecto de identificar algún antecedente patológico, hereditario y traumatológico que pueda influir en su desempeño y desarrollo en la empresa y, conocer la viabilidad de que realice otras funciones. </li>
        <li>Realizar un expediente de EL TITULAR que será resguardado en las oficinas de Recursos Humanos ya sea en medios físicos, magnéticos o electrónicos. Para el caso de los prospectos/candidatos que no hayan sido seleccionados por ATZCO para una determinada posición, sus datos serán conservados por el plazo de 1-un año desde el momento de su recolección. Para aquellos prospectos/candidatos que hayan sido seleccionados para desempeñar una determinada posición, sus datos serán conservados por toda la vigencia de la relación laboral que los une con ATZCO y hasta 5 años luego de finalizada dicha relación laboral.</li>
        <li>En su caso, para realizar los trámites de selección y administración de personal, tales como alta ante el Instituto Mexicano del Seguro Social y demás instituciones que se requiera. </li>
        <li>Dar cumplimiento a lo establecido en las reformas fiscales vigentes y/o que estén por entrar en vigor.</li>
    </ul>
    <p>5.2.- Las partes acuerdan que ATZCO se obliga a observar respecto de los datos personales que recaba de EL TITULAR, los principios de licitud, consentimiento, información, calidad, finalidad, lealtad, proporcionalidad y responsabilidad.</p>
    <p><strong>6.- Limitaciones para el acceso y divulgación de los datos personales</strong></p>
    <p>6.1.- ATZCO, se compromete a realizar su mejor esfuerzo para proteger la seguridad de los datos personales que EL TITULAR le está entregando, adoptando, estableciendo y manteniendo, en la medida de sus capacidades, medidas de seguridad administrativas, legales, técnicas y físicas que permitan proteger los datos personales contra daño, pérdida, alteración, destrucción o el uso, acceso o tratamiento no autorizado. (i) utiliza redes privadas, (ii) mantenimientos programados al site donde se guarda la información (iii) se utilizan equipos firewall, (iv) equipos no-breaks, (v) restricciones de Internet en equipos de cómputo (vi) bloqueos a través de antivirus, de salidas USB y de quemadores de discos compactos, en todos los equipos de su personal y colaboradores (vii) mantiene actualizados los equipos de respaldo, (viii) cuentas de acceso personalizado al sistema a través de usuarios y contraseñas; (ix) garantiza la confidencialidad de la información y de los datos personales que trata, a través de la celebración de contratos de confidencialidad con todos los proveedores, prestadores de servicios y colaboradores.</p>
    <p>6.2.- En este tenor, ATZCO se obliga a tomar las medidas necesarias para garantizar que los encargados que utilice cumplan con lo establecido en el presente Aviso de Privacidad, con las obligaciones a su cargo.</p>
    <p>6.3.- No obstante lo anterior y, en caso de que se presenten vulneraciones de seguridad ocurridas en cualquier fase del tratamiento, que afecten de forma significativa los derechos patrimoniales o morales de LOS TITULARES, esto será informado por correo electrónico, de forma inmediata, por ATZCO, a fin de que estos últimos puedan tomar las medidas correspondientes a la defensa de sus derechos, deslindando de cualquier responsabilidad a ATZCO si la vulneración no es imputable a él.</p>
    <p><strong>7.- Designado para tramitar las solicitudes</strong></p>
    <p>7.1.- En caso de que EL TITULAR necesite revocar su consentimiento, así como acceder, rectificar, cancelar u oponerse al tratamiento de los datos personales que ha proporcionado, lo deberá hacer a través de la persona designada por ATZCO cuyos datos se describen a continuación:<br> Correo electrónico: datos.legal@atzco.com.mx. </p>
    <p><strong>8.- Medios para revocar el consentimiento</strong></p>
    <p>EL TITULAR de los datos personales podrá revocar el consentimiento que se otorga con la aceptación del presente. Dicha revocación del consentimiento se deberá de hacer observando el siguiente procedimiento que ATZCO pone a su disposición:</p>
    <p>8.1.- Enviar un correo electrónico en atención al Designado en el punto 7-siete del presente Aviso, mediante el cual serán atendidas dichas solicitudes.</p>
    <p>8.2.- Enviar una solicitud o mensaje de datos al correo electrónico antes precisado, en el que señale:</p>
    <ul>
        <li>8.2.1.- El nombre completo de EL TITULAR, domicilio y correo electrónico para recibir la respuesta que se genere con motivo de su solicitud;</li>
        <li>8.2.2.- El motivo de su solicitud;</li>
        <li>8.2.3.- Los argumentos que sustenten su solicitud o petición;</li>
        <li>8.2.4.- Documento oficial que acredite su identidad y que demuestre que es quien dice ser; </li>
        <li>8.2.5.- Fecha a partir de la cual, se hace efectiva la revocación de su consentimiento.</li>
    </ul>
    <p>8.3.- ATZCO notificará a EL TITULAR, en un plazo máximo de 20-veinte días, contados desde la fecha en que se recibió la solicitud sobre la revocación del consentimiento, la resolución adoptada, a efecto de que, si resulta procedente, se haga efectiva la misma dentro de los 15-quince días siguientes a la fecha en que se comunica la respuesta, mediante un mensaje que contenga que ha ejecutado de todos los actos tendientes a no tratar los datos personales de EL TITULAR.</p>
    <p><strong>9.- Medios para ejercer los derechos ARCO</strong></p>
    <p>9.1.- En caso de que EL TITULAR necesite Acceder, Rectificar, Cancelar u Oponerse a los datos personales que ha proporcionado a ATZCO, EL TITULAR deberá seguir el siguiente procedimiento que ATZCO pone a su disposición:</p>
    <p>9.2.- Enviar un correo electrónico en atención al Designado del punto 7-siete del presente Aviso, mediante el cual serán atendidas dichas solicitudes, señalando lo siguiente:</p>
    <ul>
        <li>9.2.1.- El nombre completo de EL TITULAR, domicilio y correo electrónico para recibir la respuesta que se genere con motivo de su solicitud;</li>
        <li>9.2.2.- El motivo de su solicitud;</li>
        <li>9.2.3.- Los argumentos que sustenten su solicitud o petición;</li>
        <li>9.2.4.- Documento oficial que acredite su identidad y que demuestre que es quien dice ser;</li>
        <li>9.2.5.- Descripción clara y precisa de los datos personales respecto de los que se busca ejercer alguno de los derechos ARCO, y cualquier otro elemento o documento que facilite la localización de los datos personales.</li>
        <li>9.2.6.- Tratándose de solicitudes de rectificación de datos personales, EL TITULAR deberá indicar, además de lo señalado, las modificaciones a realizarse y aportar la documentación que sustente su petición.</li>
    </ul>
    <p>9.3.- ATZCO notificará a EL TITULAR, en un plazo máximo de 20-veinte días contados desde la fecha en que se recibió la solicitud de acceso, rectificación, cancelación u oposición, la resolución adoptada, a efecto de que, si resulta procedente, se haga efectiva la misma dentro de los 15-quince días siguientes a la fecha en que se comunica la respuesta. Tratándose de solicitudes de acceso a datos personales, procederá la entrega previa acreditación de la identidad del solicitante o representante legal, según corresponda.</p>
    <p><strong>10.- Transferencia de datos personales</strong></p>
    <p>10.1.- ATZCO se obliga a no transferir o compartir los datos a que se refiere el presente Aviso, a favor de terceros, salvo en los casos en que resulte necesario para cumplir con las finalidades del presente Aviso, o bien, sean necesarios en cumplimiento de un requerimiento de autoridad.</p>
    <p>10.2.- Asimismo, en cumplimiento de sus obligaciones legales, y con efectos informativos a EL TITULAR, se le indica que ATZCO podrá realizar las siguientes transferencias:</p>
    <ul>
        <li>10.2.1.- IMSS, INFONAVIT y SAT, a efecto de dar cumplimiento a la legislación laboral, de seguridad social, así como el pago de impuestos.</li>
        <li>10.2.2.- Instituciones bancarias, a efecto de realizar el cobro de los productos y/o servicios comercializados por ATZCO así como el pago de los productos y/o servicios adquiridos por ATZCO.</li>
    </ul>
    <p><strong>11.- Modificaciones</strong></p>
    <p>11.1.- Las partes acuerdan que el Aviso de Privacidad, puede ser modificado en el tiempo y forma que ATZCO lo determine, atendiendo al estudio y las regulaciones que en materia de protección de datos personales surjan, por lo que se obliga a mantener actualizado el presente aviso a efecto de que, en su caso, EL TITULAR se encuentre en posibilidad de ejercer sus derechos ARCO.</p>
    <p><strong>12.- Autoridad garante</strong></p>
    <p>12.1.- Si EL TITULAR considera que su derecho a la protección de sus datos personales ha sido lesionado por alguna conducta u omisión por parte de ATZCO o presume alguna violación a las disposiciones previstas en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, su Reglamento y demás ordenamientos aplicables, podrá interponer su inconformidad o denuncia ante el Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales (INAI). Para mayor información, le sugerimos visitar su página oficial de Internet www.inai.org.mx.</p>
    <p><strong>13.- Ley aplicable y jurisdicción</strong></p>
    <p>13.1.- Las partes expresan que el presente aviso, se regirá por las disposiciones legales aplicables en la República Mexicana, en especial, por lo dispuesto en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, su Reglamento y la demás normativa vinculada aplicable.</p>
    <p>13.2.- Para el caso de que exista una disputa o controversia, derivada de la interpretación, ejecución o cumplimiento del aviso o de cualquiera de los documentos que del mismo se deriven, o que guarden relación con éste, las partes amigablemente, buscarán llegar a un acuerdo dentro de un plazo de 30-treinta días naturales, contados a partir de la fecha en que surja cualquier diferencia y se notifique por escrito sobre dicho evento a la contraparte, deduciendo el proceso de mediación ante el Instituto Nacional de Transparencia, Acceso a la información y Protección de Datos Personales (INAI). </p>
    <p>13.3.- En caso de que las partes no lleguen a un acuerdo, convienen en este acto en someter todas las desavenencias que deriven del presente Aviso de Privacidad o de cualquiera de los documentos que del mismo se deriven, o que guarden relación con éste o con aquéllos, a ser resueltas de manera definitiva, sometiéndose a la competencia y leyes de las Autoridades Administrativas Federales o Tribunales del Estado de Guanajuato, renunciando expresamente a cualquier fuero distinto que por razones de sus domicilios presentes o futuros pudieren corresponderles.</p>
    <p>Fecha última de actualización: 22 de junio del 2022</p>
</div>
        <div class="signature-block">
            <p>___________________________________________</p>
            <strong><p><?php echo $nombreCompleto; ?></p></strong>
            <br>
            <p>Consiento y autorizo que mis datos personales sensibles sean tratados por CONSTRUCTORA ATZCO SA. DE C.V., conforme el presente aviso de privacidad.</p>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <p>Yo <?php echo $nombreCompleto ?> por este conducto autorizo para que en mi nombre y representación y solo para el caso de enfermedad, se cobre mi sueldo mediante carta de poder que entregaré, y con firma de dos testigos.</p>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <p><?php echo $nombreCompleto ?></p>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <div class="red-box">CARTA DE CONSENTIMIENTO</div>
        <p>Por medio de la presente el que suscribe C. <?php echo $nombreCompleto; ?> le externo mi consentimiento y aceptación de manera libre y espontánea, para que se me entreviste y se realice el llenado de mi declaración de estado de salud para cuestiones informativas.</p>
        <p>Por lo expuesto, no tengo inconveniente alguno en que la Empresa <strong>Constructora Atzco S.A de C.V</strong> me pida que realice el llenado de mi declaratoria de estado de salud, agradeciendo de antemano la atención y facilidades que le puedan brindar para agilizar los trámites que le interesen.</p>
        <p class="centrado">Finalmente</p>
        <p class="centrado">EN <?php echo $ciudad; ?>, a <?php echo $diaIngreso; ?> de <?php echo $mesIngreso; ?> de <?php echo $anioIngreso; ?>.</p>
        <div class="signature-block">
            <p><strong>ATENTAMENTE</strong></p>
            <p>___________________________________________</p>
            <p>NOMBRE Y FIRMA</p>
        </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

        <div class="red-box2">DECLARACIÓN DEL ESTADO DE SALUD</div>
        <div class="content2">
            <table class="table">
                <tr>
                    <th>NOMBRE DEL ASPIRANTE:</th>
                    <td><?php echo $datosEmpleado['empleado_nombres'] . ' ' . $datosEmpleado['empleado_apellido_paterno'] . ' ' . $datosEmpleado['empleado_apellido_materno']; ?></td>
                    <th>SEXO:</th>
                    <td><?php echo $datosEmpleado['empleado_sexo']; ?></td>
                </tr>
                <tr>
                    <th>EDAD:</th>
                    <td> <?php echo $edad; ?></td>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th>Fecha de su última consulta médica:</th>
                    <td></td>
                    <th>Tipo de Sangre:</th>
                    <td><?php echo $sangre ?></td>
                </tr>
                <tr>
                    <th>En caso de accidente, favor de avisar a:</th>
                    <td colspan="3">
                        Nombre:<?php echo $nombreEmergencia ?> <br>
                        Parentezco:<?php echo $parentezcoEmergencia?> ¿Le puede donar sangre? SI__ NO__
                        Teléfono:<?php echo $telefonoEmergencia ?> <br>
                        Dirección:<?php echo $domicilio ?>

                    </td>
                </tr>
            </table>
        </div>
        <div class="red-box2">ESTADO DE SALUD</div>
        <div class="content2">
            <p>Marcar con una "X" si su respuesta es afirmativa o negativa.</p>
            <p>Ha padecido, padece o es tratado actualmente de alguna enfermedad o incapacidad relacionada con lo siguiente:</p>
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
                        <td>__</td>
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
            <h5>Declaro bajo protesta de decir verdad que las contestaciones que anteceden son ciertas y verídicas, y que la detección de algún padecimiento no declarado podrá ser considerado como intento de engaño o abuso de confianza, pudiendo ser causal de recisión de contrato sin responsabilidad para la empresa de acuerdo a lo establecido en el artículo 47 de la Ley Federal del Trabajo y en el reglamento interno de trabajo.</h5>
            <div class="">
                <h5>Firma del aspirante: ___________________________ Huella: _____________________ Ciudad y Fecha</h5> 
            </div>
        </div>
    </div>
    <br><br><br>
    <div class="red-box">DECLARACIÓN INFONAVIT</div>
    <p class="centrado">FECHA: <?php echo $fechaActual; ?></p>
    <p>POR ÉSTE MEDIO, YO <strong><?php echo $nombreCompleto; ?></strong> COMUNICO A CONSTRUCTORA ATZCO SA DE CV QUE <?php echo $creditoInfonavit ?> TENGO CRÉDITO DE INFONAVIT:</p>
    <p><strong>NÚMERO DE SEGURIDAD SOCIAL:</strong> <?php echo $nss; ?></p>
    <p><strong>NÚMERO DE CRÉDITO:</strong> <strong></strong></p>
    <p><strong>FECHA DEL OTORGAMIENTO:</strong> <strong></strong></p>
    <p><strong>FACTOR DE CUOTA FIJA:</strong></p>
    <br>
    <div class="signature-block">
        <br><br>
        <p class="centrado"><strong><?php echo $nombreCompleto; ?></strong></p>
        <p>________________________</p>
        <p>FIRMA</p>
    </div>

    <p>-------------------------------------------------------------------------------------------------------------------------------</p>

    <div class="red-box">ACUSE DE RECIBO</div>
    <p>Recibí el <strong>reglamento interior de trabajo</strong> de la empresa <strong>Constructora Atzco S.A de C.V</strong></p>
    <p>Responsabilizándome a conservarlo durante mi permanencia laboral y dar seguimiento puntual a este.</p>
    <p>Nombre completo del colaborador: <strong><?php echo $nombreCompleto; ?></strong></p>
    <div>
        <p><i>Firma:</i> ________________________</p>
        <p><i>Fecha:</i> ________________________</p>
    </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="titulo-centrado">CÓDIGO DE ÉTICA</div>
    <h2 class="titulo-centrado">ÍNDICE</h2>
    <table class="indice">
        <tr>
            <td>I. Antecedentes</td>
            <td>24</td>
        </tr>
        <tr>
            <td>II. Objetivos</td>
            <td>25</td>
        </tr>
        <tr>
            <td>III. Alcance</td>
            <td>25</td>
        </tr>
        <tr>
            <td>IV. Valores</td>
            <td>25</td>
        </tr>
        <tr>
            <td>V. Normas de ética generales</td>
            <td>25</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;a) En relación con clientes y proveedores</td>
            <td>25</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;b) Competencia</td>
            <td>26</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;c) En relación con los colaboradores</td>
            <td>27</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;d) En relación con la Sociedad</td>
            <td>27</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;e) Protección de activos</td>
            <td>27</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;f) Privacidad</td>
            <td>28</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;g) Conflicto de interés</td>
            <td>28</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;h) Integridad y corrupción</td>
            <td>28</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;i) Relaciones personales y familiares</td>
            <td>29</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;j) Faltas al código de ética</td>
            <td>29</td>
        </tr>
    </table>
            <div class="content">
    <h3>Antecedentes</h3>
    <p>a) El apego a principios éticos habla de un sentido de respeto, honestidad e integridad, valores imprescindibles para el desempeño armonioso del trabajo.</p>
    <p>b) Estos valores constituyen una parte esencial de nuestra cultura corporativa y son una pieza fundamental en la vida de nuestra empresa.</p>
    <p>c) Estos valores son parte de nuestra cultura organizacional y de nuestro quehacer diario, por lo que es necesario formalizarlos y establecer un marco de referencia común que unifique los criterios y oriente las acciones de todas las personas que integramos ATZCO.</p>
    <p>d) ATZCO opera bajo la premisa fundamental de que se rige por leyes y ordenamientos, cuya observancia y cumplimiento es indispensable para existir y funcionar óptimamente en su entorno social.</p>
    <p>e) Este código parte del hecho que la mayoría de las veces la acción correcta es clara, independientemente de que esté incorporada a un código.</p>

    <h3><span class="prefijo">I.</span>Objetivos</h3>
    <p>El presente Código de Ética tiene los siguientes objetivos:</p>
    <p>a) Dar a conocer a los Directivos, Gerentes y colaboradores de ATZCO sus obligaciones de carácter ético hacia la empresa, clientes, proveedores, competidores, autoridades, medio ambiente y comunidad.</p>
    <p>b) Establecer criterios básicos para normar el comportamiento ético de todos los colaboradores de ATZCO.</p>
    <p>c) Compartir nuestros valores éticos con las personas interesadas en conocer ATZCO.</p>
    <p>d) Señalar el procedimiento para sancionar a quienes cometen faltas en contra de nuestro código de ética.</p>

    <h3><span class="prefijo">II.</span>Alcance</h3>
    <p>a) El presente código de ética fue elaborado para su observancia de todos los colaboradores de ATZCO.</p>
    <p>b) Los nuevos temas que surjan de la dinámica de las situaciones de negocio y del entorno en general, se incorporan a este código conforme sea necesario.</p>
    <p>c) Este documento no es ni pretende ser exhaustivo, ni incluir todas las situaciones donde pudiera presentarse un conflicto de índole de ética. Por lo tanto, las situaciones no previstas en este código de ética se resolverán de acuerdo a un criterio sano de administración. En caso de duda, se consultara con las áreas de recursos humanos o Dirección General.</p>

    <h3><span class="prefijo">III.</span>Valores</h3>
    <p>En ATZCO, vivimos el compromiso con un sentido de pertenencia y responsabilidad en nuestras acciones a través de los valores que forman parte integral de la organización y proporcionan el fundamento para el desarrollo de una normatividad sobre la cual se toman decisiones y se ejecutan acciones con valor.</p>
    <p>Los Valores de ATZCO son los siguientes:</p>
    <ul>
        <li>Lealtad: Ganar la confianza que se deposita en ti, generando un compromiso de colaboración total y recíproco, mientras trabajemos juntos.</li>
        <li>Responsabilidad: Cumplimiento de los deberes laborales establecidos.</li>
        <li>Respeto: Aceptar a las personas tal cual son, para que el valor sea recíproco.</li>
        <li>Puntualidad: Cumplir con los compromisos adquiridos en tiempo y forma.</li>
        <li>Excelencia: Lograr cualquier objetivo a la primera.</li>
        <li>Trabajo en equipo: Grupo de personas que unen sus talentos enfocados a desarrollar un trabajo en común.</li>
        <li>Creatividad: Conjunto de ideas innovadoras para la creación de valor.</li>
    </ul>

    <h3><span class="prefijo">IV.</span>Normas de ética generales</h3>
    <h4>a) En relación con clientes y proveedores.</h4>
    <p>Atendemos a clientes ofreciéndoles un trato equitativo y honesto en cada transacción, proporcionando los productos y servicios que les competen con la mayor calidad y oportunidad a su alcance, apegándonos en todo momento a la regulación oficial y a la normatividad interna de ATZCO.</p>
    <p>No hacemos comparaciones falsas o engañosas con productos o servicios equivalentes a los que ofrecen los competidores.</p>
    <p>Relacionarse con los proveedores de bienes y servicios de forma ética y lícita.</p>
    <p>Buscar y seleccionar únicamente proveedores cuyas prácticas empresariales respeten la dignidad humana, no incumplan la ley y no pongan en peligro la reputación de ATZCO.</p>
    <p>Seleccionar a los proveedores con base a la idoneidad de sus productos o servicios, así como de su precio, condiciones de entrega y calidad, no aceptando ni ofreciendo regalos o comisiones, en dinero o en especie, que puedan alterar las reglas de la libre competencia en la producción y distribución de bienes y servicios.</p>
    <p>En caso de que no se pueda rechazar el regalo o comisión, deberá comunicarlo inmediatamente a Dirección General y/o Recursos Humanos.</p>
    <p>Buscar la excelencia de los bienes y servicios de ATZCO de modo que los clientes obtengan la satisfacción esperada.</p>
    <p>Garantizar los productos y servicios de ATZCO y atender de forma rápida y eficaz las reclamaciones de clientes buscando su satisfacción más allá del mero cumplimento.</p>

    <h4>b) Competencia</h4>
    <p>En ATZCO competimos vigorosamente cumpliendo con las leyes y reglamentos sobre competencia justa existentes en los estados que tenemos presencia.</p>
    <p>ATZCO no participa en ningún acuerdo que pretenda limitar el libre juego de las fuerzas de los mercados en los que operamos y no utilizamos medios impropios para mejorar nuestra posición competitiva en dichos mercados.</p>
    <p>Los colaboradores que tengan contacto con representantes de competidores, deberán mostrar una actitud profesional, apegada a los valores de la empresa y cuidamos la imagen personal y la de ATZCO.</p>
    <p>En la interacción con competidores, ya sea individual o en foros y asociaciones empresariales o profesionales, se evitaran temas que pudieran generar riesgos o posibles contingencias para ATZCO en materia de cumplimiento de leyes y reglamento sobre competencia.</p>
    <p>Los colaboradores de ATZCO deberán evitar en lo posible hacer comentarios o declaraciones sobre la competencia, pero cuando resulta necesario la hacemos con justicia y objetividad.</p>
    <p>En ningún caso, se intentara obtener secretos comerciales o cualquier otra información confidencial de un competidor.</p>

    <h4>c) En relación con los colaboradores</h4>
    <p>Tratar con dignidad respeto y justicia a los colaboradores, teniendo en consideración su diferente sensibilidad cultural.</p>
    <p>No discriminar a los colaboradores por razón de raza, religión, edad, nacionalidad, sexo o cualquier otra condición personal o social ajena a sus condiciones de mérito y capacidad.</p>
    <p>No permitir ninguna forma de violencia, acoso, o abuso en el trabajo.</p>
    <p>Fomentar el desarrollo, formación y promoción profesional de los colaboradores.</p>
    <p>Vincular la retribución y promoción de los colaboradores a sus condiciones de mérito y capacidad.</p>
    <p>Establecer y comunicar criterios y reglas claras que mantengan equilibrados los derechos de ATZCO y los colaboradores en los procesos de contratación y en los de separación de estos incluso en caso de cambio voluntario del empleador.</p>
    <p>Garantizar la seguridad e higiene en el trabajo adoptando cuantas medidas sean razonables para maximizar la prevención de los riesgos laborales.</p>
    <p>Procurar la conciliación del trabajo en ATZCO con la vida personal y familiar de los colaboradores.</p>
    <p>Procurar la integración laboral con los colaboradores con discapacidad o minusvalía, eliminando todo tipo de barreras de la empresa para su inserción.</p>
    <p>Facilitar la participación de los colaboradores en los programas de integración y acción social de ATZCO.</p>

    <h4>d) En relación con la Sociedad</h4>
    <p>Respetar el derecho humano y las instituciones democráticas y promoverlos donde sea posible.</p>
    <p>Mantener el principio de neutralidad política, no interfiriendo políticamente en las comunidades donde desarrolla sus actividades, como muestra además de respeto a las diferentes opiniones y sensibilidades de las personas vinculadas con ATZCO.</p>
    <p>Relacionarse con las autoridades e instituciones públicas de manera lícita y respetuosa no aceptando ni ofreciendo regalos o comisiones, en dinero o especie.</p>
    <p>Estamos comprometidos con los crecimientos económicos y sociales creando y manteniendo fuentes de empleo digno y productivo.</p>
    <p>Estamos comprometidos a buscar permanentemente los medios para disminuir el impacto en el medio ambiente mediante, la mejora continua en el control de emisiones, manejo de residuos, tratamiento de aguas, ahorro de energía y todo elemento que potencialmente le pueda afectar.</p>

    <h4>e) Protección de activos</h4>
    <p>Nuestro compromiso es proteger y optimizar el valor de la inversión, principalmente a través de la utilización prudente y rentable de los recursos, vigilando que cumplan las normas de seguridad pertinentes.</p>
    <p>La custodia y preservación de los activos de ATZCO es responsabilidad de todos y cada uno de los que integramos la empresa.</p>
    <p>Entendemos por activos de la empresa no solo la maquinaria, edificios, vehículos o mobiliario sino también los planos, diseños, formulas, procesos, sistemas, dibujos, tecnología, estrategias de negocio, y desde luego nuestra marca.</p>
    <p>Los colaboradores tenemos el compromiso de salvaguardar los activos de la empresa. En especial, estamos comprometidos con la protección de la propiedad intelectual, representada esencialmente por sus procesos de fabricación, sistemas de información y esquemas de comercialización, incluyendo también información financiera, de producto y del personal.</p>
    <p>El uso de los activos se destinara al objeto del negocio y está estrictamente prohibido hacer otro uso de los mismos. Todos los colaboradores de ATZCO tenemos la obligación de denunciar cualquier desviación que sea de nuestro conocimiento.</p>

    <h4>f) Privacidad</h4>
    <p>ATZCO respeta la privacidad de todos sus colaboradores, proveedores y clientes. Tratamos los datos personales con responsabilidad y en cumplimiento de todas las leyes de privacidad aplicables.</p>

    <h4>g) Conflicto de interés</h4>
    <p>Esperamos que todos los colaboradores trabajen dedicadamente en beneficio de ATZCO y de todos los que la integramos, sin que nuestra toma de decisiones se vea afectada por cualquier factor que favorezca intereses ajenos a la productividad, eficiencia, eficacia el cumplimiento de nuestras metas.</p>
    <p>Con el propósito de evitar que se presenten conflictos entre los intereses personales y los de ATZCO, y para propiciar una solucione en caso de requerirse todos los colaboradores tenemos la responsabilidad de declarar cualquier interés financiero o de otra índole que pueda entrar en conflicto con la empresa.</p>
    <p>Si algún colaborador considera que existen interese personales que pueden influir en su desempeño en el trabajo o en su toma de decisiones habrá de comunicárselo por escrito a su jefe inmediato y/o Recursos Humanos.</p>

    <h4>h) Integridad y corrupción</h4>
    <p>En ATZCO no sobornamos, no recibimos favores ni dinero para otorgar beneficios a quien sea.</p>
    <p>Entendemos con toda claridad que para evitar estos actos, debemos remover cualquier anomalía para que no haya motivo alguno de caer en corrupción.</p>
    <p>Sobornar para obtener algún beneficio no ayuda en la nada a ATZCO y la pone en una situación muy grave e impide su avance.</p>
    <p>Recibir dinero, obsequios o favores afecta profundamente los resultados y pone en entredicho la reputación de la empresa y todos sus colaboradores.</p>
    <p>Estas acciones son ilegales y puedes constituir un delito.</p>

    <h4>i) Relaciones personales y familiares</h4>
    <p>Es importante comunicar al superior correspondiente las relaciones personales que surjan entre colaboradores o entre profesionales de ATZCO y colaboradores de un cliente, con el fin de prevenir eventuales riesgos de independencia y/o conflicto de interés.</p>

    <h4>j) Faltas al código de ética</h4>
    <p>La observancia de este código es estrictamente obligatoria.</p>
    <p>Los Jefes de ATZCO, en cualquier nivel, serán ejemplo intachable de su cumplimiento, de difundirlo constantemente y tomara las medidas disciplinarias que correspondan cuando alguno de sus colaboradores lo incumpla.</p>
    <p>Cualquier colaborador que realice prácticas de negocios, en términos diferentes a las establecidas en este código, será sujeto a medidas disciplinarias que pueden llegar hasta la terminación de la relación laboral y/o acción legal.</p>
    <p>En ATZCO es inevitable que ocurran situaciones que no estén previstas en este código. En esos casos deben guiarnos el apego a la ley, nuestros valores y la buena voluntad.</p>
    <p>Los colaboradores de ATZCO siempre tendremos la libertad de consultar a nuestros jefes acerca de las situaciones donde se generen dudas.</p>
    <p>La Dirección General y Recursos Humanos incluirá en sus revisiones el cumplimiento de este código.</p>
    <p>La Dirección General Elaborará planes para la difusión de este código.</p>
    <p>Este Código entra en vigor a partir de Septiembre 2016.</p>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <p>Nombre y firma del colaborador</p>
    <p><?php echo $nombreCompleto; ?></p>
    </div>
    </div>
    </div>
</body>

</html>