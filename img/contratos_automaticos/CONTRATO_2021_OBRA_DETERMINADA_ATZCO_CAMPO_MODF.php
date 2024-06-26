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
$domicilioEmpresa = $datosEmpleado['empleado_domicilio_empresa'];

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
            display: inline-block;
            /* Hace que el span se comporte como un bloque pero en línea */
            width: 50px;
            /* Establece un ancho fijo para el prefijo */
        }

        .prefijo2 {
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

        .terminos {
            text-align: justify;
            font-style: italic;
            font-weight: bold;
            font-size: 20px;
        }

        .underlined {
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
            border-collapse: collapse;
            /* Elimina el espacio entre los bordes */
        }

        .tabled th,
        .tabled td {
            padding: 8px;
            text-align: left;
            border: 1px solid black;
            /* Añade bordes sólidos a cada celda */
        }

        .tabled th,
        .tabled td {
            empty-cells: show;
            /* Asegura que las celdas vacías muestren bordes */
        }
    </style>
</head>

<body>

    <div class="content">
        <p>CONTRATO INDIVIDUAL DE TRABAJO POR OBRA DETERMINADA QUE CELEBRAN, POR UNA PARTE
            <strong><?php echo $nombreEmpresa; ?></strong>, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ <strong>“LA
                EMPRESA”</strong> Y POR LA OTRA, POR SU PROPIO DERECHO, <strong><?php echo $nombreCompleto; ?></strong>
            A QUIEN SE LE DENOMINARÁ <strong>“EL TRABAJADOR (A)”</strong>, DE CONFORMIDAD CON LAS SIGUIENTES
            DECLARACIONES Y SUBSECUENTES CLÁUSULAS.
        </p>

        <h3 class="titulo-centrado">DECLARACIONES:</h3>

        <h4>I.- DECLARA “LA EMPRESA”:</h4>
        <p><span class="prefijo">a)</span>Ser una sociedad mercantil debidamente constituida conforme a las leyes
            mexicanas, y estar
            debidamente inscrita ante el Registro Público de la Propiedad y del Comercio de la ciudad de Salamanca,
            estado de Guanajuato.</p>
        <p><span class="prefijo">b)</span>Tener su domicilio en Cerrada. Boulevard paseo de los insurgentes #902 int. 7
            Colonia Jardines del Moral, León Gto.
        </p>
        <h4>II.- DECLARA “EL TRABAJADOR (A)”:</h4>
        <p>a) Llamarse como ha quedado escrito en el encabezado de este contrato.</p>
        <p>b) Ser de nacionalidad Mexicana. <strong>PRIMERA.-</strong> "EL TRABAJADOR ( A )" se obliga a prestar a "LA
            EMPRESA" sus servicios por OBRA DETERMINADA a partir del día
            <?php echo $datosEmpleado['empleado_dia_de_ingreso'] . " " . $datosEmpleado['empleado_mes_de_ingreso'] . " " . $datosEmpleado['empleado_año_de_ingreso']; ?>
            y hasta el día que finalice el contrato <?php echo $datosEmpleado['empleado_numero_de_contrato']; ?> para
            desempeñar el cargo de: <?php echo $datosEmpleado['empleado_puesto_de_trabajo']; ?> que ejecutará en el
            domicilio ubicado en <?php echo $datosEmpleado['empleado_lugar_de_servicio_o_de_proyecto']; ?>, la cual una
            vez concluido el periodo de tiempo establecido en el presente contrato terminará la vigencia del mismo. "EL
            TRABAJADOR ( A )" prestará dichos servicios de forma subordinada bajo la dirección de los funcionarios
            designados al efecto, aceptando ejecutar al mismo tiempo aquellas labores similares y conexas, así como las
            que se deriven de los usos y prácticas, además de las señaladas en las disposiciones relativas en los
            procedimientos de trabajo, y administración del personal que "LA EMPRESA" tiene establecidos en relación a
            las actividades contratadas.
        </p>
        <p>c) Ser de sexo <?php echo $sexo; ?>.</p>
        <p>d) Ser su estado civil <?php echo $estadoCivil; ?>.</p>
        <p>e) Mayor de edad.</p>
        <p>f) Tener su domicilio en <?php echo $domicilio; ?>, y que es que señala para recibir notificaciones por parte
            de “LA EMPRESA”.</p>
        <p>g) Que su número de CURP es <?php echo $curp; ?>, y su número de afiliación ante el Instituto Mexicano del
            Seguro Social es <?php echo $nss; ?>.</p>
        <p>h) Que no tiene enfermedad ni incapacidad física o mental alguna que imposibilite para desempeñar el trabajo
            para el que se le contrata.</p>
        <p>i) Que cuenta con la capacidad, conocimientos y experiencia necesarios para prestar sus servicios personales
            en los términos del presente contrato.</p>
        <p>En virtud de lo anterior, ambas PARTES convienen en obligarse de acuerdo con las siguientes:</p>
        <br><br>

        <h3 class="titulo-centrado">CLAUSULAS:</h3>


        <p><strong>SEGUNDA.-</strong> "EL TRABAJADOR ( A )" prestará sus servicios a "LA EMPRESA" en el domicilio
            ubicado en <?php echo $domicilioEmpresa; ?>/o cualquiera de sus oficinas o
            sucursales ubicadas en el interior de la República Mexicana, por lo que previo su consentimiento podrá "LA
            EMPRESA" realizar los cambios necesarios al respecto, de acuerdo con sus necesidades, sin menoscabo de la
            categoría o salario asignados a "EL TRABAJADOR ( A )". Cuando por la naturaleza del trabajo "EL TRABAJADOR (
            A )" tuviera que desempeñarlo fuera de las Instalaciones de "LA EMPRESA" deberá rendir un informe detallado
            de las labores y actividades desempeñadas en el local o empresa que se le asigne por parte de "LA EMPRESA",
            según las necesidades de ésta última.
            El presente contrato lo celebran las partes, conforme a lo estipulado en el artículo 39 A de la Ley Federal
            del Trabajo, el Trabajador se obliga a sus servicios personales, subordinado jurídicamente al Patrón,
            consistentes en: <?php echo $puesto ?> cuya descripción del puesto y/o funciones del mismo se adjuntan al
            presente contrato y son del conocimiento del Trabajador, con el único fin de verificar que éste cumple con
            los requisitos y conocimientos necesarios para desarrollar el trabajo que se le solicita. Durante este
            periodo de tiempo, el Trabajador disfrutará del salario, la garantía de seguridad social y de las
            prestaciones de la categoría o puesto que desempeñe. Al término del periodo de no acreditar el Trabajador
            que satisface los requisitos y conocimientos necesarios para desarrollar las labores, a juicio del Patrón,
            tomando en cuenta la opinión de la Comisión Mixta de Capacitación, Adiestramiento y Productividad en
            términos de la Ley Federal del Trabajo, así como la naturaleza de la categoría o puesto, se dará por
            terminada la relación de trabajo, sin responsabilidad para la Patrón
        </p>

        <p><strong>TERCERA.-</strong> "EL TRABAJADOR (A)" conviene con "LA EMPRESA", en prestar sus servicios dentro de
            las jornadas máximas previstas en la Ley Federal del Trabajo. Como consecuencia de lo anterior "EL
            TRABAJADOR (A)" se obliga a prestar sus servicios indistintamente dentro de dichas jornadas, que podrán ser
            distribuidas semanalmente de acuerdo con las necesidades de "LA EMPRESA" sin exceder los límites legales
            establecidos en los artículos 59, 60 y 61 de la Ley Federal de Trabajo vigente. Los tiempos de descanso
            durante la jornada de trabajo "EL TRABAJADOR (A)" podrá disfrutarlos fuera de la fuente de trabajo, de
            conformidad con lo establecido en el artículo 63 de la ley de la materia.</p>
        <p>Asimismo, el trabajador ( a ) conviene con "LA EMPRESA" que ésta podrá:</p>
        <p>a) Realizar, de manera temporal, la reducción del número de horas de la jornada de trabajo asignada a "EL
            TRABAJADOR ( A )", así como el ajuste correspondiente al salario a éste asignado dependiendo de las horas a
            laborar por el mismo, de acuerdo con las necesidades de "LA EMPRESA", considerando las exigencias del
            mercado de la industria al que "LA EMPRESA" provee de servicios y productos. No obstante estas reducciones
            de carácter temporal, sea su duración cual fuere, no sentarán precedente ni obligación para "LA EMPRESA", y
            una vez que resuelta sea la problemática que orillo a "LA EMPRESA" a la reducción de la jornada de trabajo y
            ajuste realizado al salario de "EL TRABAJADOR ( A )", "LA EMPRESA" restablecerá tanto la jornada de trabajo
            como el salario asignado a "EL TRABAJADOR ( A )" en las mismas condiciones previas a la reducción temporal
            referida</p>
        <p>b) "EL TRABAJADOR ( A )" está obligado a checar su tarjeta, plasmar su huella digital o firmar las listas de
            asistencia, a la entrada o la salida de sus labores, por lo que el incumplimiento de este requisito indicará
            la falta injustificada a sus labores, para todos los efectos legales.</p>
        <br>
        <p><strong>CUARTA.-</strong>Las partes convienen que la retribución que se pagará a "EL TRABAJADOR (A)" por sus
            servicios será una cuota diaria de $<?php echo $salario; ?>
            <strong>(<?php echo $salarioEscrito; ?>)</strong>, o la cantidad que de acuerdo con el tabulador de salarios
            vigente se tenga convenida. Asimismo, que el salario le será pagado los días sábado de cada semana, el cual
            incluye la parte proporcional del Séptimo día.
            Las PARTES convienen que, en razón del Sistema Computarizado de pago establecido en "LA EMPRESA" cualquier
            cantidad entregada a "EL TRABAJADOR ( A )" en efectivo, cheque, depósito bancario o transferencia
            electrónica por concepto de sueldos o pago de prestaciones, en fecha posterior a la terminación de la
            relación de trabajo y, en su caso, cualquier cantidad entregada en exceso deberá ser reembolsada a "LA
            EMPRESA" de forma inmediata, de acuerdo a lo establecido en el artículo 110 de la Ley Federal de Trabajo
            vigente.
        </p>
        <p>"EL TRABAJADOR (A)" manifiesta en éste acto su consentimiento de manera expresa para que "LA EMPRESA", en
            caso de así considerarlo necesario, le cubra el pago de su salario y prestaciones a través de depósito en
            cuenta bancaria, tarjeta de débito, transferencia o cualquier otro medio electrónico, sin costo por el
            manejo de cuenta, quedando los retiros en cajeros de disposición en efectivo, sujetos a los lineamientos de
            la Institución Bancaria donde se le transfiera o deposite el pago de su salario y prestaciones.</p>

        <p><strong>QUINTA.-</strong> "EL TRABAJADOR (A)" se obliga a firmar todos los recibos de pago correspondientes
            que le expida "LA EMPRESA" y le sean entregados por la misma. Toda reclamación sobre el particular deberá
            hacerse precisamente al momento de firmar cada recibo, para que "LA EMPRESA", en caso de proceder dicha
            reclamación, realice el ajuste correspondiente y el pago del monto o de los montos que corresponda(n).</p>

        <p><strong>SEXTA.-</strong> Beneficiario "EL TRABAJADOR (A)" en este acto acorde a su consentimiento expreso y
            libre designa para el pago de salarios y prestaciones devengadas y no cobradas a la muerte del mismo a los
            siguientes beneficiarios y sus porcentajes:
            <br><br>
            Esposa(o):_________________________________________________________en____%
            Hijo(a):____________________________________________________________en____%
            Padre:_______________________________________________________________en____%
            Madre:_______________________________________________________________en____%
            Dependiente económico:_________________________________parentesco_________en____%
            <br>
        <p>Lo anterior en cumplimiento con lo establecido en el artículo 25 fracción X de la Ley Federal del Trabajo.
        </p>

        <p><strong>SEPTIMA.-</strong> "EL TRABAJADOR (A)" prestará sus servicios con el cuidado, intensidad y esmero
            apropiados, y expresamente se obliga a observar todas las instrucciones, políticas, reglamentos y manuales
            internos así como los Procedimientos que "LA EMPRESA" tiene establecidos o establezca, y a vigilar, en su
            caso, que estos sean cumplidos por el personal a su cargo, para el debido cumplimiento del trabajo referido
            en éste contrato.</p>

        <p><strong>OCTAVA.-</strong> "EL TRABAJADOR (A)" conviene en que dedicará al desempeño de sus labores el tiempo
            de manera efectiva de la duración de su jornada de trabajo a efecto de que no haya atraso ni retraso algunos
            en el trabajo contratado durante la vigencia del presente contrato. Asimismo, las partes convienen que "EL
            TRABAJADOR" no podrá laborar jornada extraordinaria, sin el previo consentimiento expreso y por escrito de
            "LA EMPRESA".</p>
        <br>
        <p><strong>NOVENA.-</strong>Las partes convienen que derivado de la importancia del trabajo contratado, regulado
            en éste contrato y materia del mismo, "EL TRABAJADOR (A)” manifiesta expresamente en éste acto su
            conformidad y conviene que se abstendrá de abandonar el mismo por ninguna razón o motivo, en ninguna etapa
            de la misma, salvo casos fortuitos o de fuerza mayor, y continuará en su cargo y en el desempeño de sus
            funciones hasta la conclusión del trabajo materia del presente contrato y durante la vigencia del mismo,
            referido de forma específica en la cláusula Primera del mismo.</p>

        <p><strong>DECIMA.-</strong>Las partes convienen que para el caso de que "EL TRABAJADOR (A)" abandone el trabajo
            materia del presente contrato, éste último (a) manifiesta expresamente en éste acto su conformidad y
            conviene de manera voluntaria que "LA EMPRESA" de acuerdo con su criterio podrá sancionarla de 1 a 7 días
            como máximo sin goce de sueldo. Para el caso de reincidencia, “LA EMPRESA” podrá rescindir el presente
            contrato, sin causa imputable alguna para la misma.</p>

        <p><strong>DECIMA PRIMERA</strong>Después de 1 (un) año de servicio, "EL TRABAJADOR (A)" tendrá derecho a
            disfrutar de un periodo de vacaciones pagadas, de acuerdo con el Artículo 76 de la Ley Federal del Trabajo,
            o en su caso, al pago proporcional al periodo de tiempo en que prestó sus servicios durante ese año.</p>
        <p>Asimismo, "EL TRABAJADOR (A)" disfrutará de un 25 % por concepto de prima vacacional, sobre el salario que le
            corresponda durante el periodo de vacaciones. Lo anterior, de acuerdo con lo establecido en los Artículos 79
            y 80 de la Ley Federal Del Trabajo, vigente.</p>

        <p><strong>DECIMA SEGUNDA</strong> "EL TRABAJADOR (A)" gozará de los días de descanso obligatorios establecidos
            en el artículo 74 de la Ley Federal del Trabajo vigente. Para el caso de que "LA EMPRESA", de acuerdo con
            sus necesidades, requiera que "EL TRABAJADOR (A)" labore uno o varios de los días de descanso legal
            referidos, "EL TRABAJADOR (A)" acudirá a desempeñar sus labores de forma habitual, no obstante "LA EMPRESA"
            considerará en todo momento lo establecido en el artículo 73 de la Ley de la materia.</p>

        <p><strong>DECIMA TERCERA</strong> "LA EMPRESA" pagará a "EL TRABAJADOR (A)" el equivalente a 15 días de trabajo
            como aguinaldo, que se pagará antes del día 20 de Diciembre de cada año o, en su caso, en proporción al
            periodo de tiempo en que prestó sus servicios durante ese año. Además tendrá derecho al reparto de
            utilidades de "LA EMPRESA", de acuerdo con lo establecido en los Artículos 117 al 131 de la Ley Federal del
            Trabajo vigente.</p>

        <p><strong>DECIMA CUARTA</strong> Para seguridad de los contratantes, "EL TRABAJADOR (A)" estará obligado a
            someterse a los exámenes médicos que establezca "LA EMPRESA", y a poner en práctica las medidas
            profilácticas y de higiene que "LA EMPRESA" en apoyo con las Autoridades del ramo acuerden, en los términos
            de la fracción X del artículo 134 de la Ley Federal del Trabajo; en la inteligencia de que el médico que los
            practique será designado y retribuido por el patrón.</p>

        <p><strong>DECIMA QUINTA</strong> "EL TRABAJADOR (A)" se obliga a participar en todos y cada uno de los
            programas de capacitación, adiestramiento y productividad que se establezcan sea en el centro de trabajo o
            fuera del mismo, en cumplimiento de los planes y programas de capacitación y productividad de "LA EMPRESA".
            Las partes convienen que la capacitación podrá hacerse dentro o fuera de los horarios de trabajo
            indistintamente. "EL TRABAJADOR (A)" deberá asistir puntualmente a los cursos, sesiones de grupo, y demás
            actividades que forman parte de la capacitación o adiestramiento, así como atenderá las indicaciones del
            personal que imparta la capacitación y cumplirá con los programas respectivos; "EL TRABAJADOR (A)" deberá
            presentar los exámenes de conocimiento o competencia laboral que sean requeridos, de acuerdo con la
            capacitación y/o adiestramiento recibidos.</p>

        <p><strong>DECIMA SEXTA.-</strong> "EL TRABAJADOR (A)" reconoce que son propiedad exclusiva de "LA EMPRESA" los
            estudios, información, procedimientos, secretos comerciales, clientes, factibilidad de negocio, proyectos
            fallidos o no terminados, prospectos de clientes, folletos, publicaciones, manuales, dibujos, trazos,
            planos, diseños industriales, fotografías, “paquetes de software” y sistemas de informática o cualquier otro
            trabajo intelectual que "EL TRABAJADOR (A)" desarrolle durante la vigencia de este contrato y en general
            todos los documentos e información física, electrónica o verbal que se le proporcione o elabore con motivo
            de la relación de trabajo que le une con "LA EMPRESA", así como aquellos que el propio "TRABAJADOR (A)"
            prepare, descubra o formule en relación o conexión con sus servicios, por lo que se obliga a conservarlos en
            buen estado, a no sustraerlos del lugar de trabajo, salvo por necesidades del servicio y con la autorización
            expresa y por escrito de "LA EMPRESA", y a devolverlos en el momento que ésta se lo requiera o bien al
            término de la presente relación de trabajo, por el motivo que éste fuera. Asimismo, "EL TRABAJADOR (A)"
            conviene que estará obligado a guardar estricta reserva de la información, procedimientos y todos aquellos
            hechos y actos que con motivo de su trabajo sean de su conocimiento y por lo tanto se obliga a no utilizar
            en beneficio propio, o en beneficio de terceras personas ya sea directa o indirectamente, en forma
            enunciativa más no limitativa: información física, a través de documentos o medios electrónicos, secretos
            comerciales, secretos industriales, diseños industriales, trazados de circuito, lay outs, formulas, secretos
            de informática, de “software”, información de todo tipo que le sea proporcionada por "LA EMPRESA" y que sea
            parte integrante de la información de un tercero, logística, información en general de clientes o
            proveedores de "LA EMPRESA", bases de datos, y cualesquier tipo de información que se encuentren protegidos
            por la Ley y que puedan significar una ventaja competitiva para "LA EMPRESA". "EL TRABAJADOR (A)" deberá
            guardar absoluta confidencia sobre los asuntos que le sean encomendados o cualquier información que en razón
            de sus funciones llegase a tener en su poder, y usarla exclusivamente en beneficio del "LA EMPRESA" debiendo
            guardar expresa reserva sobre la información privilegiada que pudiera tener en su poder y le es confiada por
            "LA EMPRESA", y es propiedad de la misma, para el buen desempeño de sus funciones.</p>

        <p><strong>DECIMA SEPTIMA.-</strong> "EL TRABAJADOR (A)" se compromete a cumplir con la normatividad que
            establezca "LA EMPRESA" y con el REGLAMENTO INTERIOR DE TRABAJO de la misma, con relación a las políticas
            empresariales, disciplina, higiene, capacitación, adiestramiento, desarrollo de habilidades, seguridad y
            desempeño laboral, manifestando en éste acto de forma expresa y por escrito que a la firma de éste contrato
            ha recibido de "LA EMPRESA" copia simple del REGLAMENTO INTERIOR DE TRABAJO de la misma, el cual observará
            siempre en todas su partes y cumplirá durante la vigencia de la presente relación de trabajo con "LA
            EMPRESA".</p>

        <p><strong>DECIMA OCTAVA.-</strong> El presente Contrato podrá ser rescindido o terminado de conformidad a lo
            establecido en la Ley Federal de Trabajo vigente.</p>

        <p><strong>DECIMA NOVENA.-</strong> "EL TRABAJADOR (A)" se compromete a apegarse a las causales de suspensión
            temporal en la prestación de servicios sin responsabilidad para el Patrón, de acuerdo a lo establecido en
            los artículos 42 y 427 de la Ley Federal del Trabajo, por las cuales se confirma que no existe
            responsabilidad de remunerar por los días que dure dicha suspensión.</p>

        <p><strong>VIGESIMA.-</strong> "LA EMPRESA" podrá rescindir la presente relación laboral, sin responsabilidad
            para el mismo, en los siguientes casos:
        <p><strong>l.</strong> En caso de incompetencia evidente por parte de "EL TRABAJADOR (A)" en el desempeño de las
            funciones y actividades para las que se le contrata de conformidad con el presente contrato, así como por
            falta de probidad u honradez en el desarrollo de sus labores;</p>
        <p><strong>ll.</strong> Si "EL TRABAJADOR (A)" no cumple con las instrucciones, funciones y obligaciones
            determinadas por "LA EMPRESA" y sus representantes, y con las establecidas en el REGLAMENTO INTERIOR DE
            TRABAJO de ésta;</p>
        <p><strong>lll.</strong> Si "EL TRABAJADOR (A)" incurre en faltas graves a los principios y políticas
            empresariales de "LA EMPRESA", establecidas en el presente Contrato;</p>
        <p><strong>lV.</strong> Por la comisión, por parte de "EL TRABAJADOR (A)", de cualesquiera de los supuestos
            establecidos en el Artículo 47 de la Ley Federal del Trabajo.</p>
        </p>
        <br><br><br><br><br><br><br><br>
        <p><strong>VIGESIMA PRIMERA.-</strong> "LA EMPRESA" y "EL TRABAJADOR (A)" podrán dar por terminada la presente
            relación laboral, en los siguientes casos, de conformidad con lo establecido en el Artículo 53 de la Ley
            Federal del Trabajo:
            <br>
        <p><strong>l.</strong> El mutuo consentimiento de las partes;</p>
        <p><strong>ll.</strong> La muerte de "EL TRABAJADOR (A)";</p>
        <p><strong>lll.</strong> La incapacidad física o mental o inhabilidad manifiesta de "EL TRABAJADOR (A)" que haga
            imposible la prestación del trabajo, y</p>
        <p><strong>lV.</strong> Los casos a que se refiere el Artículo 434 de la Ley Federal del Trabajo.</p>
        </p>

        <p><strong>VIGESIMA SEGUNDA.-</strong> Las partes acuerdan sujetarse, en los casos no previstos en este
            contrato, a las disposiciones establecidas en la Ley Federal del Trabajo vigente y en el REGLAMENTO INTERIOR
            DE TRABAJO de "LA EMPRESA" y, en caso de conflicto, a los criterios y jurisdicción de la Junta de
            Conciliación y Arbitraje de la ciudad de León, Guanajuato.</p>

        <p>Las partes, conscientes del contenido, obligaciones, alcance y fuerza legal del presente contrato por tiempo
            determinado, lo firman y ratifican por duplicado ante testigos, en la ciudad de <?php echo $ciudad; ?>, a los días
            <?php echo $diaIngreso; ?> del mes de <?php echo $mesIngreso; ?> de <?php echo $anioIngreso; ?>
        </p>

        <table class="signature-table">
            <tr>
                <td>
                    <div class="signature-block">
                        <strong>
                            <p>"LA EMPRESA"</p>
                        </strong>
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
                            <p>MARISOL SANTOS RAMOS</p>
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
        <p>POR MEDIO DEL PRESENTE ESCRITO, Y POR ASÍ CONVENIR A MIS INTERESES PERSONALES, DESDE ESTE MOMENTO LES INFORMO
            QUE RENUNCIO DE MANERA VOLUNTARIA A LA RELACIÓN DE TRABAJO QUE ME UNIA CON LA EMPRESA DENOMINADA
            <strong>"CONSTRUCTORA ATZCO", S.A. DE C.V.</strong>
        </p>
        <p>ASIMISMO, MANIFIESTO EXPRESAMENTE QUE MIENTRAS PRESTE MIS SERVICIOS PARA LA EMPRESA, NO SUFRÍ ACCIDENTES DE
            TRABAJO, NI RIESGO PROFESIONAL ALGUNO. DE IGUAL FORMA, MANIFIESTO QUE RECIBÍ, A MI ENTERA SATISFACCIÓN, EL
            PAGO DE TODAS Y CADA UNA DE LAS PRESTACIONES LABORALES A QUE TENGO DERECHO TALES COMO VACACIONES, PRIMA
            VACACIONAL, AGUINALDO, PRIMA DE ANTIGÜEDAD, SALARIOS Y GRATIFICACIÓN, ASÍ COMO CUALESQUIER OTRAS
            PRESTACIONES A QUE PUDIERA TENER DERECHO Y ME PUDIERAN CORRESPONDER DE CONFORMIDAD CON LO ESTABLECIDO EN LA
            LEY FEDERAL DEL TRABAJO VIGENTE.</p>
        <p>ASI MISMO, MANIFIESTO EXPRESAMENTE QUE SIEMPRE LABORE UNA JORNADA LABORAL MAXIMA DE 48 HORAS SEMANALES,
            MANIFESTANDO ASI MISMO QUE JAMAS DESEMPEÑE JORNADA EXTRAORDINARIA EN BENEFICIO DE <strong>"CONSTRUCTORA
                ATZCO", S.A. DE C.V.”</strong></p>
        <p>DERIVADO DE LO ANTERIOR, MANIFIESTO QUE NO SE ME ADEUDA CANTIDAD ALGUNA POR NINGÚN CONCEPTO, POR LO QUE NO ME
            RESERVO ACCIÓN O DERECHO ALGUNOS QUE EJERCITAR EN CONTRA DE <strong>"CONSTRUCTORA ATZCO", S.A. DE
                C.V.”</strong>, ASÍ COMO EN CONTRA DE CUALQUIER OTRA PERSONA QUE PRESTE SUS SERVICIOS EN SU BENEFICIO,
            LA REPRESENTE LEGALMENTE, O SEA ACCIONISTA DE LA MISMA.</p>
        <p>POR LO ANTERIOR, RATIFICO EL PRESENTE ESCRITO EN TODAS Y CADA UNA DE SUS PARTES Y LO FIRMO AL CALCE, PARA
            TODOS LOS EFECTOS LEGALES A QUE HAYA LUGAR.</p>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <p><strong><?php echo $nombreCompleto; ?></strong></p>
        <br>
        <h3 class="titulo-centrado">RECIBO DE FINIQUITO</h3>
        <p>RECIBÍ DEL ING. JOSE DOLORES CU GUERRERO, EN SU CARÁCTER DE REPRESENTANTE LEGAL DE <strong>"CONSTRUCTORA
                ATZCO", S.A. DE C.V.”</strong>, QUIEN ES MI ÚNICO PATRON, LA CANTIDAD DE $</p>
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
            <p>Asimismo, quiero manifestar expresamente que durante todo el tiempo que labore para la sociedad mercantil
                denominada <strong>"CONSTRUCTORA ATZCO", S.A. DE C.V.”</strong>, quien reconozco como mi único patrón,
                me fueron cubiertos a mi entera y total satisfacción todos y cada uno de los conceptos mencionados
                anteriormente, por lo que a través del presente finiquito extiendo el más amplio recibo que en derecho
                proceda, manifestando además que no me reservo acción legal o derecho algunos que hacer valer en contra
                de cualquier persona ya sea física o moral, así como de cualquier persona que legalmente le represente o
                trabaje para dicha empresa.</p>
            <p>Por último, manifiesto expresamente y de manera voluntaria mi conformidad con el contenido del presente
                documento, mismo que firmo al calce, para todos los efectos legales a que haya lugar, en la ciudad de
                <?php echo $ciudad; ?></p>
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

            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <div class="red-box">AVISO DE PRIVACIDAD</div>
            <p class="centrado"><?php echo $ciudad; ?> a <?php echo $diaIngreso; ?> de <?php echo $mesIngreso; ?>
                de <?php echo $anioIngreso; ?>.
            </p>
            <p class="terminos"><?php echo $nombreCompleto; ?>, <small>(el "Titular") con domicilio en</small>
                <?php echo $domicilio; ?>,</p>
                <div class="content-terms">
            <p>Reconoce que nos estás proporcionando tus datos personales, laborales y académicos que aparecen en tu CV
                y/ o Solicitud de empleo, así como en la documentación de contratación solicitada. Nuestro compromiso es
                tratar los datos únicamente para los fines de Reclutamiento, Selección,
                Contratación y Administración de personal y las Relaciones laborales propios del "Responsable".
                Salvo para cumplir con las anteriores finalidades, no transferiremos tus datos a ningún tercero.
                Este aviso de privacidad se pone a disposición de Usted (el "Titular") previo a la obtención y
                tratamiento de sus datos personales ("los Datos")
            </p>
            <p><strong>I. Datos recabados y su finalidad:</strong> los datos que usted nos proporciona incluyen: (a)
                nombre, (b) domicilio completo; (c) correo electrónico; (d) teléfono celular o particular, (e)
                fotografía; (f) datos académicos y laborales (empleos anteriores); (g) datos personales y datos
                relativos a interés en puestos de trabajo, incluyendo aptitudes y capacidades, nivel socioeconómico y
                pretensiones laborales (incluyendo sueldo), los cuales serán tratados con la única finalidad de
                Reclutamiento, Selección, Contratación y
                Administración del personal y las relaciones laborales.
                Hacemos de su conocimiento que en todo momento los "datos personales" serán tratados con apego a los
                principios y requisitos contenidos en la Ley.</p>
            <p><strong>II. Datos sensibles</strong>El Titular declara que no ha proporcionado y en ningún caso
                proporcionará al
                Responsable "datos personales sensibles", es decir, aquellos datos personales íntimos o cuya utilización
                debida o indebida pueda dar origen a discriminación o conlleve un riesgo grave para éste.
                PEn particular, el Titular se obliga a no proporcionar al Responsable ningún Dato relativo a origen
                racial o étnico, información genética, creencias religiosas, filosóficas y morales, opiniones políticas
                o
                preferencia sexual.
            </p>
            <p><strong>III. Almacenamiento y divuigación:</strong>Para poder cumplir con las finalidades de este aviso,
                así como para
                poder almacenar y tratar sus datos, es posible que el Responsable entregue todo o parte de los Datos a
                terceros, incluyendo proveedores de bienes o servicios, nacionales o extranjeros, que requieren conocer
                esta información, como por ejemplo servidores de almacenamiento de información, quienes quedarán
                obligados, por contrato, a mantener la confidencialidad de los Datos y conforme a este Aviso de
                Privacidad. El Responsable se compromete a contar con las medidas legales y de segundad suficiente y
                necesara para garantizar que sus Datos permanezcan
                confidenciales y seguros.
            </p>
            <p><strong>IV. Acceso, rectificación:</strong>El Titular tendrá derecho para solicitar al Responsable en
                cualquier momento el acceso, rectificación, cancelación u oposición respecto de sus Datos, para lo cual
                deberá enviar una solicitud a los datos que aparecen a continuación:
                La solicitud de acceso, rectificación, cancelación u oposición deberá contener y acompañar lo siguiente:
                (1) El nombre del Titular y domicilio u otro medio para comunicarle la respuesta a su solicitud; (2) Los
                documentos que acrediten la identidad o, en su caso, la representación legal del Titular, (3) La
                descripción clara y precisa de los Datos respecto de los que se busca ejercer alguno de los derechos
                antes mencionados, y (4) Cualquier otro elemento o documento que facilite la localización de los datos
                del Titular.</p>
                <p>V. El Titular está de acuerdo y conforme en que cualquier cambio a este "Aviso de Privacidad" o a las políticas de privacidad se notifique avisos interos, por lo que es obligación del Titular solicitar al
                Departamento de Capital Humano la versión más actual del Aviso de Privacidad.</p>
                </div>
            <div class="signature-block">
                <p>___________________________________________</p>
                <strong>
                    <p><?php echo $nombreCompleto; ?></p>
                </strong>
                <p><strong>Nombre, Firma y Huella</strong></p>
                
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <p>Yo <?php echo $nombreCompleto ?> por este conducto autorizo para que en mi nombre y representación y solo
                para el caso de enfermedad, se cobre mi sueldo mediante carta de poder que entregaré, y con firma de dos
                testigos.</p>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <p><?php echo $nombreCompleto ?></p>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <div class="red-box">CARTA DE CONSENTIMIENTO</div>
            <p>Por medio de la presente el que suscribe C. <?php echo $nombreCompleto; ?> le externo mi consentimiento y
                aceptación de manera libre y espontánea, para que se me entreviste y se realice el llenado de mi
                declaración de estado de salud para cuestiones informativas.</p>
            <p>Por lo expuesto, no tengo inconveniente alguno en que la Empresa <strong>Constructora Atzco S.A de
                    C.V</strong> me pida que realice el llenado de mi declaratoria de estado de salud, agradeciendo de
                antemano la atención y facilidades que le puedan brindar para agilizar los trámites que le interesen.
            </p>
            <p class="centrado">Finalmente</p>
            <p class="centrado">EN <?php echo $ciudad; ?>, a <?php echo $diaIngreso; ?> de <?php echo $mesIngreso; ?> de
                <?php echo $anioIngreso; ?>.
            </p>
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
                        <td><?php echo $datosEmpleado['empleado_nombres'] . ' ' . $datosEmpleado['empleado_apellido_paterno'] . ' ' . $datosEmpleado['empleado_apellido_materno']; ?>
                        </td>
                        <th>SEXO:</th>
                        <td><?php echo $datosEmpleado['empleado_sexo']; ?></td>
                    </tr>
                    <tr>
                        <th>EDAD:</th>
                        <td><?php echo $edad; ?></td>
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
                            Parentezco:<?php echo $parentezcoEmergencia ?> ¿Le puede donar sangre? SI__ NO__
                            Teléfono:<?php echo $telefonoEmergencia ?> <br>
                            Dirección:<?php echo $domicilio ?>

                        </td>
                    </tr>
                </table>
            </div>
            <div class="red-box2">ESTADO DE SALUD</div>
            <div class="content2">
                <p>Marcar con una "X" si su respuesta es afirmativa o negativa.</p>
                <p>Ha padecido, padece o es tratado actualmente de alguna enfermedad o incapacidad relacionada con lo
                    siguiente:</p>
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
                <div class="red-box">Las preguntas de esta sección deben ser respondidas SOLAMENTE por el SEXO FEMENINO
                </div>
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
                <h5>Declaro bajo protesta de decir verdad que las contestaciones que anteceden son ciertas y verídicas,
                    y que la detección de algún padecimiento no declarado podrá ser considerado como intento de engaño o
                    abuso de confianza, pudiendo ser causal de recisión de contrato sin responsabilidad para la empresa
                    de acuerdo a lo establecido en el artículo 47 de la Ley Federal del Trabajo y en el reglamento
                    interno de trabajo.</h5>
                <div class="">
                    <h5>Firma del aspirante: ___________________________ Huella: _____________________ Ciudad y Fecha</h5>
                </div>
            </div>
        </div>
        <br><br><br>
        <div class="red-box">DECLARACIÓN INFONAVIT</div>
        <p class="centrado">FECHA: <?php echo $fechaActual; ?></p>
        <p>POR ÉSTE MEDIO, YO <strong><?php echo $nombreCompleto; ?></strong> COMUNICO A CONSTRUCTORA ATZCO SA DE CV QUE
            <?php echo $creditoInfonavit ?> TENGO CRÉDITO DE INFONAVIT:
        </p>
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

        <p>-------------------------------------------------------------------------------------------------------------------------------
        </p>

        <div class="red-box">ACUSE DE RECIBO</div>
        <p>Recibí el <strong>reglamento interior de trabajo</strong> de la empresa <strong>Constructora Atzco S.A de
                C.V</strong></p>
        <p>Responsabilizándome a conservarlo durante mi permanencia laboral y dar seguimiento puntual a este.</p>
        <p>Nombre completo del colaborador: <strong><?php echo $nombreCompleto; ?></strong></p>
        <div>
            <p><i>Firma:</i> ________________________</p>
            <p><i>Fecha:</i> ________________________</p>
        </div>
    </div>
    
</body>

</html>