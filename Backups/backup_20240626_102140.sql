-- MariaDB dump 10.19  Distrib 10.11.7-MariaDB, for Linux (x86_64)
--
-- Host: srv1288.hstgr.io    Database: u496700722_hr_basededatos
-- ------------------------------------------------------
-- Server version	10.11.7-MariaDB-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES
(5,'bengipenam@gmail.com');
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion_temporal`
--

DROP TABLE IF EXISTS `configuracion_temporal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion_temporal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `fecha_solicitud` timestamp NULL DEFAULT current_timestamp(),
  `fecha_expiracion` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion_temporal`
--

LOCK TABLES `configuracion_temporal` WRITE;
/*!40000 ALTER TABLE `configuracion_temporal` DISABLE KEYS */;
INSERT INTO `configuracion_temporal` VALUES
(15,'nose@gmail.com','f5bd544ce9ef330e6da946b22f21d58a','2024-06-17 21:54:40','2024-06-17 21:59:40');
/*!40000 ALTER TABLE `configuracion_temporal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contrato`
--

DROP TABLE IF EXISTS `contrato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contrato` (
  `contrato_id` int(11) NOT NULL AUTO_INCREMENT,
  `contrato_tipo_contrato` varchar(100) DEFAULT NULL,
  `contrato_descripcion` text DEFAULT NULL,
  `fecha_de_creacion` date DEFAULT NULL,
  `contrato_nombre_de_imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`contrato_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrato`
--

LOCK TABLES `contrato` WRITE;
/*!40000 ALTER TABLE `contrato` DISABLE KEYS */;
INSERT INTO `contrato` VALUES
(5,'Nueva prueva','hdf jhd f','2024-06-19','Carta_de_presentacion_recien_dada_por_la_escuela_1718807635.pdf'),
(6,'segunda prueba','perqueña descripcion del contrato','2024-06-19','Plan_de_trabajo_1718821639.docx');
/*!40000 ALTER TABLE `contrato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `empleado_id` int(11) NOT NULL AUTO_INCREMENT,
  `empleado_sexo` enum('Masculino','Femenino') DEFAULT NULL,
  `empleado_domicilio` varchar(255) DEFAULT NULL,
  `empleado_estado_civil` enum('Casado','Soltero','Viudo','Union libre') DEFAULT NULL,
  `empleado_curp` varchar(18) DEFAULT NULL,
  `empleado_rfc` varchar(13) DEFAULT NULL,
  `empleado_nss` varchar(20) DEFAULT NULL,
  `empleado_fecha_de_nacimiento` varchar(30) DEFAULT NULL,
  `empleado_lugar_de_nacimiento` varchar(255) DEFAULT NULL,
  `empleado_telefono` varchar(15) DEFAULT NULL,
  `empleado_tipo_de_sangre` varchar(3) DEFAULT NULL,
  `empleado_alergias` varchar(255) DEFAULT NULL,
  `empleado_enfermedades` varchar(255) DEFAULT NULL,
  `empleado_nombre_completo_de_la_madre` varchar(255) DEFAULT NULL,
  `empleado_nombre_completo_del_padre` varchar(255) DEFAULT NULL,
  `empleado_nombre_de_contacto_para_emergencia` varchar(255) DEFAULT NULL,
  `empleado_parentezco_con_el_contacto_de_emergencia` varchar(50) DEFAULT NULL,
  `empleado_telefono_de_contacto_para_emergencia` varchar(15) DEFAULT NULL,
  `empleado_estado` enum('Activo','Inactivo') DEFAULT NULL,
  `empleado_credito_infonavit` enum('Si','No') DEFAULT NULL,
  `empleado_salario_diario_integrado` decimal(10,2) DEFAULT NULL,
  `empleado_fecha_de_ingreso` varchar(30) DEFAULT NULL,
  `empleado_fecha_de_termino_de_contrato` varchar(50) DEFAULT NULL,
  `empleado_puesto_de_trabajo` varchar(100) DEFAULT NULL,
  `empleado_lugar_de_servicio_o_de_proyecto` text DEFAULT NULL,
  `empleado_numero_de_contrato` varchar(100) DEFAULT NULL,
  `empleado_inicio_de_contrato_pemex` varchar(50) DEFAULT NULL,
  `empleado_fin_de_contrato_pemex` varchar(50) DEFAULT NULL,
  `empleado_quien_lo_contrato` varchar(255) DEFAULT NULL,
  `empleado_nombres` varchar(100) DEFAULT NULL,
  `empleado_apellido_paterno` varchar(50) DEFAULT NULL,
  `empleado_apellido_materno` varchar(50) DEFAULT NULL,
  `empleado_dia_de_ingreso` int(11) DEFAULT NULL,
  `empleado_mes_de_ingreso` enum('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre') DEFAULT NULL,
  `empleado_año_de_ingreso` int(11) DEFAULT NULL,
  `empleado_salario_diario_integrado_escrito` varchar(255) DEFAULT NULL,
  `empleado_historial_lugares_de_servicio` text DEFAULT NULL,
  `empleado_foto` varchar(255) DEFAULT NULL,
  `empleado_domicilio_empresa` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`empleado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES
(1,'Masculino','ORIENTE 13 ENTRE ORIENTE 10 Y 12 COLONIA EMILIANO ZAPATA,ORIZABA VERACRUZ C.P 94320','Soltero','ROSV850301HBZMNC04','ROSV850301B39','67 07 85 15 82 1','12 de Junio de 2024','Salamanca','7731853563','A+','Ninguna','Ninguna','EDUARDO ROMERO MENDOZA','JOSE ROSARIO AGUILAR','ESPERANZA GONZALEZ CORRAL','PAPA','7737320431','Inactivo','No',171.00,'22 de Enero de 2021','24 de Mayo de 2021','DIBUJANTE','REFINERIA SALAMANCA','5200009607','11 de Junio de 2024','26 de Junio de 2024','Brian Emmanuel Flores Hernández','VICTOR EDUARDO','ROMERO','SANCHEZ',22,'Enero',2021,'CIENTO SETENTA Y UN PESOS 00/100 M.N','REFINERIA SALAMANCA','667b70c1c7896_logotipoUTTT.png','INT.REFINERIA MIGUEL HIDALGO'),
(2,'Masculino','C. CALIMEZ  S/N BOVEDAS ATOTONILCO DE TULA HGO','Soltero','FOHB041124HHGLRRA5','FOHB0411249G2','04 74 56 12 74 9','24 de Noviembre de 2004','TULA DE ALLENDE HIDALGO','7732017779','O+','Ninguna','Ninguna','BRIGETT ICELA HERNÁNDEZ SÁNCHEZ','EMMANUEL FLORES LÓPEZ','ALAN OSWALDO HERNÁNDEZ SANCHEZ','TÍO','7731057670','Activo','No',0.00,'29 de Abril de 2024','17 de Octubre de 2024','DESAROLLADOR DE SOFTWARE','ATITALAQUIA','5200009607','21 de Julio de 2021','25 de Octubre de 2021','pruebaitaasdl','BRIAN EMMANUEL','FLORES','HERNANDEZ',29,'Abril',2024,'Cero pesos M.N','Realizo este sistema junto a su compañero en una estadia de la Universidad','667b18de4127f_IMG_0579.jpeg','INT.REFINERIA MIGUEL HIDALGO'),
(4,'Masculino','ABRAHAM GONZALEZ NO 116 COL. NATIVITAS','Casado','MAGJ851202HGTRRN05','MAGJ851202428','12 01 85 30 77 9','02 de Diciembre de 1985','SALAMANCA, GTO','4641765094','RH+','NINGUNA','NINGUNA','ALICIA GARCIA GARCIA','JOSE MERCED MARTINEZ GARCIA','ADRIAN GARCIA','TIO','4646412525','Activo','No',248.56,'21 de Agosto de 2021','21 de Agosto de 2024','SUPERVISOR DE OBRA','SALAMANCA, GTO','50892365','21 de Agosto de 2021','21 de Agosto de 2024','Elizabeth Barrientos Ruiz','JUAN DANIEL','MARTINEZ','GARCIA',21,'Agosto',2021,'DOSCIENTOS CUARENTA Y OCHO PESOS 00/100 M.N','SALAMANCA, GTO','667b7099ef684_logotipoUTTT.png','INT.REFINERIA MIGUEL HIDALGO'),
(5,'Masculino','16 DE ENERO,TULA DE ALLENDE,HGO C.P 42808','Soltero','GAGL020205HOCLRSA1','GAGL020205687','04 13 02 51 49 1','05 de Febrero de 2002','OAXACA','773229940','O+','NINGUNA','NINGUNA','JUANA GUERRA MONTES','JOSE LUIS GALLEGOS DE LA ROSA','JUANA GALLEGOS MONTES','MAMAÁ','771256789','Activo','No',230.00,'29 de Abril de 2024','19 de Junio de 2024','ALMACENISTA','ATITALAQUIA','5200010453','30 de Mayo de 2023','12 de Junio de 2024','Benjamin Peña Marin','BENJAMIN','PEÑA','MARIN',29,'Abril',2024,'DOSCIENTOS TREINTA PESOS 00/100 M.N','Realizo este sistema junto a su compañero en una estadia de la universidad','6675055693cce_logotipoEmpresarialAtzco.jpeg','INT.REFINERIA MIGUEL HIDALGO'),
(6,'Femenino','GASPAR DE ZUÑIGA 115 LOS VIRREYES','Soltero','SORD860627MGTRMY00','SORD860627UX4','12 05 86 19 83 9','27 de Junio de 1986','SALAMANCA','4641396915','O+','NINGUNA','NINGUNA','GRACIELA RAMIREZ JARAMILLO','MACARIO SORIA PEREZ','GRACIELA SORIA RAMIREZ','MAMA','4642054035','Activo','No',248.93,'31 de Enero de 2022','20 de Septiembre de 2024','AUX CAPITAL HUMANO','ADMON SALAMANCA','5200011088','31 de Enero de 2020','12 de Septiembre de 2025','Deysi Soria Ramirez','DEYSI','SORIA','RAMIREZ',31,'Enero',2022,'DOSCIENTOS CUARENTA Y OCHO PESOS 00/100 M.N','ADMON SALAMANCA','66750539a03ef_logotipoEmpresarialAtzco.jpeg','INT.REFINERIA MIGUEL HIDALGO'),
(7,'Masculino','C TRIQUIS 75, COL TEZOZOMOC 02459 AZCAPOTZALCO, CDMX','Casado','ROAJ750624HDFDRN08','ROAJ750624RTY','23 12 34 56 12 1','12 de Abril de 1991','ESTADO DE MEXICO','7737564590','O+','NINGUNA','NINGUNA','MARIA RODRIGUEZ','FELIPE ARZATE','MARIBEL','ESPOSA','7754657890','Activo','No',125.53,'12 de Enero de 2020','12 de Febrero de 2024','JEFE DE ALMACEN','ATITALAQUIA, HGO.','234453334','12 de Marzo de 2024','12 de Diciembre de 2025','Ana Daniela','JUAN ANTONIO','RODRIGUEZ','ARZATE',12,'Enero',2020,'CIENTO VEINTICINCO PESOS 00/100 M.N','ATITALAQUIA, HGO.','66750564b96e1_logotipoEmpresarialAtzco.jpeg','INT.REFINERIA MIGUEL HIDALGO'),
(19,'Masculino','CALLE 16 DE SEPTIEMBRE COLONIA DENDHO,ATITALAQUIA,HGO C.P 42970','Soltero','GUVE931219HHGTRN01','GUVD951101HHG','05 18 01 59 59 1','11 de Diciembre de 2001','CALLE 16 DE SEPTIEMBRE COLONIA DENDHO,ATITALAQUIA,HGO C.P 42970','5578783521','O+','Ninguna','Ninguna','NORMA GAMEZ CERON','SERGIO SALGADO CRUZ','SERGIO SALGADO CRUZ','PADRE','7732548759','Activo','No',172.87,'05 de Mayo de 2022','','AYUDANTE GENERAL','TULA,HIDALGO','PO 1631906','','','Benjamin Peña Marin','OSMAN DANIEL','SALGADO','GAMEZ',5,'Mayo',2022,'CIENTO SETENTA Y DOS PESOS 87/100 M.N','TULA,HIDALGO','667b70afca742_logotipoEmpresarialAtzco.jpeg','INT.REFINERIA MIGUEL HIDALGO');
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expediente`
--

DROP TABLE IF EXISTS `expediente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expediente` (
  `expediente_nombre_de_archivo_comprimido` varchar(255) DEFAULT NULL,
  `empleado_id` int(11) DEFAULT NULL,
  KEY `empleado_id` (`empleado_id`),
  CONSTRAINT `expediente_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`empleado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expediente`
--

LOCK TABLES `expediente` WRITE;
/*!40000 ALTER TABLE `expediente` DISABLE KEYS */;
INSERT INTO `expediente` VALUES
('pruebaaaa_zip_88.zip',6);
/*!40000 ALTER TABLE `expediente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_nombre_completo` varchar(200) DEFAULT NULL,
  `usuario_email` varchar(80) DEFAULT NULL,
  `usuario_usuario` varchar(50) DEFAULT NULL,
  `usuario_clave` varchar(255) DEFAULT NULL,
  `usuario_rol` enum('Superadministrador','Jefe de Proceso','Auxiliar') DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `usuario_email` (`usuario_email`),
  UNIQUE KEY `usuario_usuario` (`usuario_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES
(1,'Benjamin Peña Marin','benja@gmail.com','Benjamin46','$2y$10$ZTBblj0tw7jxwKwUS.QAZ.Xh9wGHgzPMqaB7N8NPYTg4HgslQNPsG','Superadministrador'),
(3,'BRIAN EMMANUEL FLORES HERNANDEZ','brian@gmail.com','brianfloresh','$2y$10$0Y32I8URogIbwFkxq9r8GOji1u0kKd7uOaGt9hLd8wyONKl.zVeY2','Jefe de Proceso'),
(8,'Elizabeth Barrientos Ruiz','ebarrientos@atzco.com.mx','Elizabeth','$2y$10$IlmqEKm0JVJ2k6G.0pHZkO/5qDmUpfcvKmqPIqRsDYdkq2ZqOrCuy','Jefe de Proceso'),
(9,'Ana Daniela','rh.aux@atzco.com.mx','Daniela','$2y$10$XNojVn67NPGlxWlxMwm5MO4NGWggevwFHfKU1/UAuvC0aRAwMWDz6','Jefe de Proceso'),
(10,'Fabiola Esquivel Meza','rh.tula@atzco.com.mx','Fabiola','$2y$10$akD2dVMUXERquEXsYJBgXehRCxQ7Ydmg7nnAQV.Hm2R1eM10u7b56','Jefe de Proceso'),
(11,'Deysi Soria Ramirez','rh1.salamanca@atzco.com.mx','Deysi','$2y$10$uJiiJWEopRVzAJxo8k4yNe9Jr08vrEjqWyS1HI67do2UyTQZiiVDO','Auxiliar'),
(12,'Lucia Martinez Palacios','lucymtz_palacios@hotmail.com','Lucy','$2y$10$tmNqF9/cOVAYDQCywJPgd.WwAMJ6uT82h3w7Ay/d7QxxuVgVvAqrG','Auxiliar'),
(13,'auxiliar jfklaj jkfa','prueba@gmail.com','auxiliar','$2y$10$8TecOXRC6ToS.cUFg58mP.Y5MZsw9HitwPc2b6L1Gge.1tXIoYfky','Auxiliar'),
(14,'jefe de proceso prueba','jefe@gmail.com','jefe','$2y$10$eotJIKBmb.AoHPO.NV6PHe1OukuGEYwjhbvCEQ0q7/hITkwiSVWxO','Jefe de Proceso');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacaciones`
--

DROP TABLE IF EXISTS `vacaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vacaciones` (
  `vacaciones_id` int(11) NOT NULL AUTO_INCREMENT,
  `empleado_id` int(11) DEFAULT NULL,
  `vacaciones_dias_solicitados` int(11) DEFAULT NULL,
  `vacaciones_dia_solicitud` int(11) DEFAULT NULL,
  `vacaciones_mes_solicitud` enum('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre') DEFAULT NULL,
  `vacaciones_anio_solicitud` int(11) DEFAULT NULL,
  `vacaciones_periodo_inicio` int(11) DEFAULT NULL,
  `vacaciones_periodo_fin` int(11) DEFAULT NULL,
  `vacaciones_quien_las_registro` varchar(255) DEFAULT NULL,
  `empleado_nombres` varchar(100) DEFAULT NULL,
  `empleado_curp` varchar(18) DEFAULT NULL,
  `archivo_pdf` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`vacaciones_id`),
  KEY `empleado_id` (`empleado_id`),
  CONSTRAINT `vacaciones_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`empleado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacaciones`
--

LOCK TABLES `vacaciones` WRITE;
/*!40000 ALTER TABLE `vacaciones` DISABLE KEYS */;
INSERT INTO `vacaciones` VALUES
(5,2,2,19,'Junio',2024,2023,2024,'prueba','BRIAN EMMANUEL','FOHB041124HHGLRRA5','vacacion_5_1718809085.pdf');
/*!40000 ALTER TABLE `vacaciones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-26 16:21:40
