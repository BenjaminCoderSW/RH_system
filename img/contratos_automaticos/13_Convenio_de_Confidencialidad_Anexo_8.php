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
$domicilio = $datosEmpleado['empleado_domicilio'];
$diaDeIngreso = $datosEmpleado['empleado_dia_de_ingreso'];
$mesDeIngreso = $datosEmpleado['empleado_mes_de_ingreso'];
$anioDeIngreso = $datosEmpleado['empleado_año_de_ingreso'];
$estadoCivil = $datosEmpleado['empleado_estado_civil'];

// Aquí empieza el contenido de la plantilla
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Convenio de Confidencialidad</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif; /* Lista de fuentes alternativas */
            font-size: 15px;
            margin: 45px;
        }
        .sub-titulo1 {
            text-align: center;
            font-size: 15px;
        }
        .sub-titulo2 {
            text-align: center;
            font-size: 15px;
        }
        .sub-titulo3 {
            text-align: center;
            font-size: 15px;
        }
        .Hoja1 {
            text-align: justify;
            text-justify: inter-word;
        }
        .Hoja2 {
            text-align: justify;
            text-justify: inter-word;
        }
        .Hoja3 {
            text-align: justify;
            text-justify: inter-word;
        }
        .Hoja4{
            text-align: justify;
            text-justify: inter-word;
        }
        .Hoja5{
            text-align: justify;
            text-justify: inter-word;
            font-weight: bold;
        }
        .Hoja7{
            text-align: justify;
            text-justify: inter-word;
        }
        .Hoja8{
            text-align: justify;
            text-justify: inter-word;
        }
        .negritas{
            font-weight: bold;
        }
        .seccionDeArticulo {
            margin-left: 40px;
            margin-right: 40px;
        }
        .pieDePagina {
            text-align: center;
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
        .header { 
            text-align: justify;
            text-justify: inter-word;
            margin-bottom: 20px; 
        }
        .content { 
            margin: 20px; 
        }
        .footer { 
            text-align: center; 
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <p>CONVENIO DE CONFIDENCIALIDAD QUE CELEBRAN POR UNA PARTE LA SOCIEDAD
            DENOMINADA CONSTRUCTORA ATZCO SA DE CV, REPRESENTADA EN ESTE ACTO
            POR ISRAEL RODRÍGUEZ ESCAMILLA A QUIÉN EN LO SUCESIVO Y PARA EFECTOS
            DEL PRESENTE CONVENIO SE DENOMINARÁ "LA EMPRESA", Y POR LA OTRA EL
            EMPLEADO <strong><?php echo $apellidoPaterno . " " . $apellidoMaterno . " " .$nombres; ?></strong> Y A QUIÉN EN LO SUCESIVO Y PARA
            EFECTOS DEL PRESENTE CONVENIO SE DENOMINARÁ "EL CONFIDENTE", AL
            TENOR DE LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS.
        </p>
    </div>
    <div class="content">
        <div class="Hoja1">
        <div class="sub-titulo1" ><strong>D E C L A R A C I O N E S</strong></div>
            <strong><p>I.     LA EMPRESA, a través de su representante legal declara que:</p></strong>
            <p>a)	Es una sociedad mercantil debidamente constituida de conformidad con las leyes que rigen en la República Mexicana, como se desprende de la Escritura Pública número 16,419 de fecha 12 de Noviembre de 1992, otorgada ante la fe del Lic. Carlos A. Sotelo Regil Hernández Notario Público número 165 del Distrito Federal.</p>
            <p>b)	Su domicilio se encuentra en <?php echo $domicilio; ?></p>
            <p>c)	Su representante legal, Israel Rodríguez Escamilla, cuenta con las facultades suficientes para celebrar el presente Convenio y obligar a su representada en términos del mismo y que dichas facultades no le han sido modificadas, limitadas o restringidas en forma alguna a la fecha del presente Convenio, como se desprende de la escritura pública número 29,286, de fecha 29 de Agosto del 2012, otorgada ante la fe del Lic. Alejandro Duran Llamas, Notario Público número 44 de la ciudad de León, Gto.</p>
            <p>d)	Cuenta con las facultades suficientes para celebrar el presente Convenio y obligarse en términos del mismo.</p>
            <p>e)	En virtud de los servicios que presta, sus empleados tienen acceso a su Información Confidencial, así como a Información Confidencial de los clientes de la Empresa; dicha información es considerada de gran valor para cualquier persona relacionada directa o indirectamente con el sector y mercados en los que tanto la empresa como sus clientes llevan a cabo sus operaciones.</p>
            <p>f)	Que en virtud de la relación laboral de EL CONFIDENTE con LA EMPRESA, desde <?php echo $diaDeIngreso . " de " . $mesDeIngreso . " de " . $anioDeIngreso; ?> ha tenido acceso a toda la Información Confidencial (según dicho término se define más adelante) de LA EMPRESA, de sus clientes, así como de las compañías relacionadas directas o indirectamente con la misma. Dicha información se encuentra vinculada con el objeto social y las operaciones desarrolladas por LA EMPRESA y los clientes de la misma, con su manejo y cuestiones estructurales, así como con derecho de propiedad intelectual propiedad de cada una de las personas mencionadas anteriormente. Se considerará Información</p>
            <p class="pieDePagina" >1</p>
            <p>Confidencial, independientemente de lo establecido en la Cláusula Segunda del presente Convenio, y en forma enunciativa más no limitativa, la descrita en en Anexo A del presente Convenio, el cual forma parte integrante del mismo.</p>
        </div>
        <div class="Hoja2">
        <p>g)	Por la delicadeza, valor, ventaja que implica, relevancia o características de la documentación e Información Confidencial a la que EL CONFIDENTE tiene acceso, sea propiedad de LA EMPRESA, de sus clientes, de personas jurídicamente relacionadas o de terceros, desea que EL CONFIDENTE: (1) se obligue a guardar plena discreción y confidencialidad de éstas, (2) se obligue a indemnizarle por los daños o perjuicios que el incumplimiento de las obligaciones derivadas de este Convenio pudiera generarle y (3) sea consciente de algunas de las consecuencias jurídicas que el incumplimiento de las obligaciones aquí adquiridas puede generar.</p>
            <strong><p>II.     EL CONFIDENTE declara que:</p></strong>
            <p>a)	Tener nacionalidad Mexicana</p>
            <p>b)	Estado Civil <?php echo $estadoCivil; ?></p>
            <p>c)	Que tiene como domicilio el ubicado en <?php echo $domicilio; ?> mismo que señala para oír y recibir todo tipo de notificaciones en los términos de la ley federal del trabajo, legislación civil y mercantil aplicable, obligándose a proporcionar cualquier cambio de domicilio y en caso de que no lo hiciere, acepta que serán válidas las que se practiquen en el antes señalado.</p>
            <p>d)	Cuenta con las facultades suficientes para celebrar el presente Convenio y obligarse en términos del mismo.</p>
            <p>e)	Reconoce que como consecuencia de su relación laboral con LA EMPRESA, y de las actividades que ha venido desempeñando y desempeñará en la misma, ha tenido pleno acceso a información que resulta delicada, valiosa, ventajosa o relevante para la propia EMPRESA, para sus clientes, para personas jurídicamente relacionadas con ésta o para terceros, y que su uso, revelación o divulgación no autorizada, podría causar graves repercusiones jurídicas y económicas a dichas personas.</p>
            <strong><p>III.     Ambas Partes declaran que:</p></strong>
            <p>a)	Que por así convenir a sus intereses, es su deseo y libre voluntad obligarse a lo dispuesto por las siguientes:</p>
            <br><br><br>
            <p class="pieDePagina" >2</p>
        <div class="sub-titulo2" ><strong>C L A U S U L A S</strong></div>
            <p><strong>PRIMERA.- </strong>Se tienen por puestas todas y cada una de las DECLARACIONES inmediatas anteriores en la presente cláusula como si a la letra se insertasen, para todos los efectos legales a los que haya lugar.</p>
            <p><strong>SEGUNDA.- </strong>EL CONFIDENTE se obliga a guardar en pleno secreto y confidencia la totalidad de la documentación e información a la que tiene acceso como consecuencia directa o</p>
        </div>
        <div class="Hoja3">
            <p>indirecta de su relación laboral con LA EMPRESA y con los clientes de la misma, la cual se encuentra descrita en forma enunciativa, más no limitativa, en el Anexo A del presente Convenio (la “Información Confidencial”).</p>
            <p>No se considerará que la documentación o información es confidencial, relevante o delicada para LA EMPRESA cuando sea del dominio público legítimamente o cuando deba ser divulgada por disposición legal o por orden de autoridad competente.</p>
            <p><strong>TERCERA.- </strong>EL CONFIDENTE se obliga a no mantener en su poder copia alguna o reproducción, total o parcial de la documentación o Información Confidencial señalada, bajo cualquier forma o medio de constancia, archivo o almacenamiento, salvo que sea para cumplir las obligaciones de carácter laboral o jurídicas que hayan pactado.</p>
            <p><strong>CUARTA.- </strong>Toda la Información o documentación comercial relevante, delicada o secreta de LA EMPRESA y/o de sus clientes, tiene el carácter de confidencial, y por tanto de secreto industrial, en los términos del artículo 82 de la Ley de la Propiedad Industrial, por tratarse de aplicaciones de carácter industrial y/o comerciales que significan obtener o mantener una ventaja competitiva o económica frente a terceros en la realización de las actividades económicas que le son propias a LA EMPRESA y/o a los clientes de la misma, y respecto de las cuales se han adoptado los medios o sistemas suficientes para preservar su confidencialidad y acceso restringido. </p>
            <p>De acuerdo con lo anterior, EL CONFIDENTE manifiesta para todos los efectos a que haya lugar, que conoce y entiende cabalmente el artículo 223 de la Ley de la Propiedad Industrial, conforme al cual, las siguientes conductas inadecuadas respecto del manejo de los secretos industriales se tipifican como delictivas:</p>
            <div class="seccionDeArticulo">
                <p><strong>“Artículo 223: </strong>Son delitos:</p>
                <p>...IV. Revelar a un tercero un secreto industrial, que se conozca con motivo de su trabajo, puesto, cargo, desempeño de su profesión, relación de negocios o en virtud del otorgamiento de una licencia para su uso, sin consentimiento de la persona que guarde el secreto industrial, habiendo sido prevenido de su confidencialidad, con el propósito de obtener un</p>
                <p class="pieDePagina">3</p>
                <p>beneficio económico para sí o para el tercero o con el fin de causar un perjuicio a la persona que guarde el secreto;</p>
                <p>V. Apoderarse de un secreto industrial sin derecho y sin consentimiento de la persona que lo guarde o de su usuario autorizado, para usarlo o prevelarlo a un tercero, con el propósito de obtener un beneficio económico para sí o para el tercero o con el fin de causar un perjuicio a la persona que guarde el secreto industrial o a su usuario autorizado, y</p>
                <p>VI. Usar la información contenida en un secreto industrial, que conozca por virtud de su trabajo, cargo o puesto, ejercicio de su profesión o relación de</p>
                <p>negocios, sin consentimiento de quien lo guarde o de su usuario autorizado, o que le haya sido revelado por un tercero, a sabiendas que éste no contaba para ello con el consentimiento de la persona que guarde el secreto industrial o su usuario autorizado, con el propósito de obtener un beneficio económico o con el fin de causar un perjuicio a la persona que guarde el secreto industrial o su usuario autorizado…”</p>
            </div>
            <p><strong>QUINTA.- </strong>Si EL CONFIDENTE fuera requerido por autoridad competente de cualquier tipo para revelar información delicada, relevante o Información Confidencial de LA EMPRESA y/o de clientes de la misma, se obliga a dar aviso por escrito a LA EMPRESA y/o al cliente de que se trate, dentro de los 3 (tres) días hábiles siguientes a la recepción del documento respectivo, con la finalidad de que la parte que corresponda pueda ejercitar los actos o derechos que correspondan para salvaguardar sus intreses.</p>
            <p><strong>SEXTA.- </strong>EL CONFIDENTE al momento de la terminación de la relación de trabajo con LA EMPRESA, se obliga a devolver en ese mismo momento, en el domicilio que LA EMPRESA ha señalado en las Declaraciones del presente Convenio, o en su defecto la que la misma le señale, absolutamente toda la Información Confidencial que obre en su poder, sea propiedad de LA EMPRESA o de los clientes de la misma, especialmente la detallada en el Anexo A de este Convenio, y a no mantener en su poder ninguna copia o reproducción, total o parcial de la información señalada bajo cualquier forma o medio de constancia o almacenamiento.</p>
            <p><strong>SÉPTIMA.- </strong>EL CONFIDENTE se obliga a sacar en paz y a salvo e indemnizar inmediatamente a LA EMPRESA y/o a los clientes de la misma, por cualquier daño o perjuicio que el incumplimiento de las obligaciones adquiridas en este Convenio le causara.</p>
            <p><strong>OCTAVA.- </strong>Este Convenio tendrá una vigencia de 5 cinco años a partir de la fecha de firma de este documento, sin perjuicio de que EL CONFIDENTE no podrá en ningún momento usar o disponer de documentación o Información Confidencial que no le sea propia por sí mismo o por interpósita persona física o moral.</p>
            <p class="pieDePagina" >4</p><br>
            <p><strong>NOVENA.- </strong>Las obligaciones expuestas en este convenio tendrán efectos en toda la República Mexicana.</p>
            <p><strong>DÉCIMA.- </strong>Para cualquier notificación, aviso o comunicado vinculado con este convenio, las Partes señalan como sus domicilios convencionales los siguientes:</p>
            <table>
                <tr>
                    <th><strong>LA EMPRESA</strong></th>
                    <th> </th>
                    <th><strong>EL CONFIDENTE</strong></th>
                </tr>
                <tr>
                    <td>CARRETERA JOROBAS KM.26.5 COL LA LOMA ATITALAQUIA,HGO.</td>
                    <td> </td>
                    <td><?php echo $domicilio; ?></td>
                </tr>
            </table>
            <p><strong>DÉCIMA PRIMERA.- </strong>Este Convenio constituye y expresa el total entendimiento entre las Partes en relación con su objeto, así como su total entendimiento y condiciones, ya sean implícitas o expresas, orales o escritas. Ni el Convenio en su totalidad ni alguna parte del mismo podrán ser alterados, cambiados, renunciados o modificados sino mediante un convenio por escrito debidamente aceptado y firmado por ambas Partes. </p>
        </div>
        <div class="Hoja4">
            <p><strong>DÉCIMA SEGUNDA.- </strong>La invalidez o exclusión de alguna de las Cláusulas de este Convenio o parte de ella, no modificará ni alterará el contenido de las cláusulas que permanezcan, mismas que deberán continuar en vigor y en efecto, e interpretadas como si las inválidas o excluidas no hubieren sido insertadas.</p>
            <p><strong>DÉCIMA TERCERA.- </strong>En caso de que EL CONFIDENTE incumpla con las obligaciones asumidas en el presente convenio, se obliga a pagar a LA EMPRESA la cantidad de $3’000,000.00 (Tres Millones de Pesos 00/100 M.N.); bien sea por incumplimiento en forma parcial o total, con o sin beneficio económico; por incumplimiento llevado a cabo por sí mismo o por medio de terceros. 
            <br>Independientemente de la cantidad que deba pagar EL CONFIDENTE por dicho incumplimiento, LA EMPRESA podrá presentar la querella por el delito de revelación de secretos tipificado en el Código Penal para el Estado de Guanajuato en su artículo 229 o bien por el delito que corresponda ante las autoridades judiciales en materia penal, así como el pago de daños y perjuicios ante el juzgado civil en turno y/o a interponer demanda en cualquier vía según sea el caso.</p>
            <p><strong>DÉCIMA CUARTA.- </strong>Para la interpretación y cumplimiento de este Convenio las Partes aceptan sujetarse a la jurisdicción y leyes de los Tribunales competentes de la ciudad de León, Guanajuato, renunciando expresamente a cualquier otro fuero que por razón de sus domicilios presentes o futuros, o por cualquier otra razón, pudiera corresponderles.</p>
            <p><strong>DÉCIMA QUINTA</strong>.- </strong>El presente Convenio y sus Anexos son la compilación completa y exclusiva de todos los términos y condiciones que rigen el acuerdo de las Partes en relación con el objeto del mismo.  Ninguna declaración de ningún agente, empleado o</p>
            <p class="pieDePagina">5</p>
            <p>representante de LA EMPRESA realizada con anterioridad a la celebración del presente Convenio admitida en la interpretación de los términos del mismo.  En caso de que existiera conflicto entre el texto del presente Convenio y su Anexo, el texto del presente Convenio prevalecerá sobre el Anexo.</p>
            <p>Leído que fue este Convenio por las Partes y enteradas plenamente de su contenido y efectos legales y no existiendo ninguna clase de vicio, dolo o mala fe, ambas lo firman en original en 2 (dos) tantos de conformidad, en la ciudad de León, Guanajuato, el día <?php echo $diaDeIngreso; ?> de <?php echo $mesDeIngreso; ?> de <?php echo $anioDeIngreso; ?></p>

        </div>
        <div class="Hoja5">
            <b><br></b><pre>          LA EMPRESA                     EL CONFIDENTE            </pre>
            <br><br><br>
            <pre>_____________________________    _______________________________</pre>
            <pre>CONSTRUCTORA ATZCO SA DE CV      <?php echo $apellidoPaterno . " " .$apellidoMaterno . " " . $nombres; ?></pre>
            <pre>LIC.ELIZABETH BARRIENTOS RUIZ</pre>

            <b><br></b><pre>           TESTIGO                          TESTIGO            </pre>
            <br><br><br>
            <pre>_____________________________    _______________________________</pre>
            <pre>LIC.FABIOLA ESQUIVEL MEZA        ING.CARLOS ROMERO GUERRERO</pre>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <p class="pieDePagina">6</p><br>
        </div>
        <div class="Hoja7">
        <div class="sub-titulo3" ><strong><u>A N E X O</u></strong></div>
            <p>ESTE ANEXO FORMA PARTE INTEGRANTE DEL CONVENIO DE CONFIDENCIALIDAD CELEBRADO ENTRE CONSTRUCTORA ATZCO SA DE CV, REPRESENTADA EN ESTE ACTO POR ISRAEL RODRÍGUEZ ESCAMILLA, EN LO SUCESIVO DENOMINADA LA EMPRESA, Y <?php echo $apellidoPaterno . " " .$apellidoMaterno . " " . $nombres; ?> DE FECHA <?php echo $diaDeIngreso . " DE " .$mesDeIngreso . " DE " . $anioDeIngreso; ?> <br>
            A continuación se detalla de manera enunciativa y no limitativa, parte de la Información Confidencial a la que por virtud del Convenio celebrado, se obliga a guardar pleno secreto y discreción: </p>
            <ul>
                <li>Manuales integrados propiedad de LA EMPRESA en donde se establecen  políticas de gestión de la calidad, seguridad, salud laboral y ambiental que tengan como finalidad y objetivo el uso racional de los recursos de la empresa, reducción de contaminación y generación de residuos, prevención de riesgos, enfermedades y/o accidentes de trabajo.</li>
                <br>
                <li>Manuales y procedimientos del sistema integrado de gestión de la calidad propiedad de LA EMPRESA en donde se establecen control de documentos, control de registros, elaboración de plan de calidad, licitaciones y propuestas, compras, control de almacén, recursos humanos, mantenimiento a infraestructura, fichas de procesos, entre otros.</li>
                <br>
                <li>Manuales y procedimientos del sistema integrado de gestión de la calidad propiedad de LA EMPRESA en las diferentes ramas de seguridad y salud ocupacional.</li>
                <br>
                <li>Manuales y procedimientos del sistema integrado de gestión de la calidad propiedad de LA EMPRESA en la rama del medio ambiente, respecto de los diferentes procesos y políticas en el manejo de residuos peligrosos, residuos no peligrosos, manejo y control de residuos sanitarios, conservación y protección de la flora y fauna, atención a derrames y fugas, así como todo lo relacionado con la identificación y evaluación de aspectos ambientales.</li>
                <br>
                <li>Información relativa a precios y costos de mercancías; información contable y financiera; información de volúmenes y consumos de la empresa, sus filiales, partes relacionadas, así como de los clientes de las mismas.</li>
                <br>
                <li>Información de los proveedores que le suministran insumos a LA EMPRESA y a los clientes de la misma. </li>
                <br>
                <li>Información relativa a insumos estratégicos de LA EMPRESA y de los clientes de la misma. De forma enunciativa más no limitativa, se define como estratégicos aquellos productos que representen una parte importante de los costos del servicio o aquellos productos y servicios que por sus características o entorno del mercado, contribuyan con un beneficio adicional.</li>
                <p class="pieDePagina">7</p>
                <br>
                <li>Información relativa a costos, proveedores, redes de distribución, y cualquier otra que sea relativa respecto a la línea de productos y servicios en los que participan LA EMPRESA y los clientes de la misma.</li>
            </ul>
        </div>
        <div class="Hoja8">
            <ul>
                <li>Información relativa a las negociaciones efectuadas por LA EMPRESA y los clientes de la misma, con sus respectivos  proveedores y/o clientes, así como a la logística, distribución de la operación, términos y condiciones de pago, mecanismos de fondeo, y cualquier otros mecanismo o producto financiero y/o instrumento bursátil utilizado en las operaciones.</li>
                <br>
                <li>Manejo de LA EMPRESA y de los clientes de la misma, información de procedimientos y trámites internos y externos, incluyendo de manera enunciativa pero no limitativa los documentos que contengan las estrategias de LA EMPRESA y/o de sus clientes, así como know how o conocimiento adquirido, entre otros.</li>
                <br>
                <li>Información o documentación confidencial, relevante o delicada para o relacionada con LA EMPRESA o con los clientes de la misma, sus accionistas, funcionarios, directivos, trabajadores, prestadores de servicios, colaboradores, proveedores, o personas de cualquier manera vinculadas jurídicamente con las anteriores.</li>
                <br>
                <li>Información referente a la administración, contabilidad, situación fiscal, estados financieros, planta laboral, principales ejecutivos, software, integración de su capital, accionistas, proyectos por desarrollar, relaciones comerciales, financieras y de negocios de LA EMPRESA y/o de los clientes de la misma.</li>
            </ul>
            <p>Se considera Información Confidencial, relevante y delicada para LA EMPRESA y/o para los clientes de la misma (según se define en el cuerpo principal del Convenio), todo lo relacionado directa o indirectamente con los rubros antes mencionados, entre otros las claves de acceso (passwords), saldos, disponibilidades, características, manejos históricos o de cualquier clase, etc.</p>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <p class="pieDePagina">8</p>
        </div>
        <div class="Hoja9">
            <div class="pieDePagina">
                <p>Atitalaquia Hidalgo. a <?php echo $diaDeIngreso . " de " . $mesDeIngreso . " de " . $anioDeIngreso; ?></p>
            </div>
            <div class="negritas" >
                <b><br></b><pre>          LA EMPRESA                     EL CONFIDENTE            </pre>
                <br><br><br>
                <pre>_____________________________    _______________________________</pre>
                <pre>CONSTRUCTORA ATZCO SA DE CV      <?php echo $apellidoPaterno . " " .$apellidoMaterno . " " . $nombres; ?></pre>
                <pre>LIC.ELIZABETH BARRIENTOS RUIZ</pre>

                <b><br></b><pre>           TESTIGO                          TESTIGO            </pre>
                <br><br><br>
                <pre>_____________________________    _______________________________</pre>
                <pre>LIC.FABIOLA ESQUIVEL MEZA        ING.CARLOS ROMERO GUERRERO</pre>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <p class="pieDePagina">9</p>
        </div>
    </div>
</body>
</html>
