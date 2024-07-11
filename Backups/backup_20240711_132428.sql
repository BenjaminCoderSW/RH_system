/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.8-MariaDB, for Linux (x86_64)
--
-- Host: srv867.hstgr.io    Database: u954703204_hr_basededatos
-- ------------------------------------------------------
-- Server version	10.11.8-MariaDB-cll-lve

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES
(6,'bengipenam@gmail.com');
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion_temporal`
--

LOCK TABLES `configuracion_temporal` WRITE;
/*!40000 ALTER TABLE `configuracion_temporal` DISABLE KEYS */;
INSERT INTO `configuracion_temporal` VALUES
(15,'nose@gmail.com','f5bd544ce9ef330e6da946b22f21d58a','2024-06-17 21:54:40','2024-06-17 21:59:40'),
(20,'bengipenam@gmail.com','8e28c19ab66b22c251d442faad49ef30','2024-07-03 17:32:53','2024-07-03 11:37:53');
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
  `empleado_sexo` enum('MASCULINO','FEMENINO') DEFAULT NULL,
  `empleado_domicilio` varchar(255) DEFAULT NULL,
  `empleado_estado_civil` enum('SOLTERO','CASADO','VIUDO','SOLTERA','CASADA','VIUDA','UNION LIBRE') DEFAULT NULL,
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
  `empleado_estado` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  `empleado_credito_infonavit` enum('NO','SI') DEFAULT NULL,
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
  PRIMARY KEY (`empleado_id`),
  UNIQUE KEY `empleado_curp` (`empleado_curp`),
  UNIQUE KEY `empleado_rfc` (`empleado_rfc`),
  UNIQUE KEY `empleado_nss` (`empleado_nss`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES
(6,'FEMENINO','GASPAR DE ZUÑIGA 115 LOS VIRREYES','SOLTERA','SORD860627MGTRMY00','SORD860627UX4','12 05 86 19 83 9','27 de Junio de 1986','SALAMANCA','4641396915','O+','NINGUNA','NINGUNA','GRACIELA RAMIREZ JARAMILLO','MACARIO SORIA PEREZ','GRACIELA SORIA RAMIREZ','MAMÁ','4642054035','ACTIVO','NO',248.93,'31 de Enero de 2022','20 de Septiembre de 2024','AUX CAPITAL HUMANO','INT.REFINERIA SALAMANCA, GTO.','5200011088','31 de Enero de 2020','12 de Septiembre de 2025','DEYSI SORIA RAMIREZ','DEYSI','SORIA','RAMIREZ',31,'Enero',2022,'DOSCIENTOS CUARENTA Y OCHO PESOS 00/100 M.N','ADMON SALAMANCA','668d7affed23a_logotipoUTTT.png','INT.REFINERIA SALAMANCA, GTO.');
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
  KEY `expediente_ibfk_1` (`empleado_id`),
  CONSTRAINT `expediente_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`empleado_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expediente`
--

LOCK TABLES `expediente` WRITE;
/*!40000 ALTER TABLE `expediente` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES
(1,'BENJAMIN PEÑA MARIN','benja@gmail.com','Benjamin46','$2y$10$QnavcBrLjX9tIo.e9FPW7OtcK5erSPO/B/SsZuMrCEB1zolrTW4mq','Superadministrador'),
(3,'BRIAN EMMANUEL FLORES HERNANDEZ','bflores@atzcoweb.com','brianfloresh','$2y$10$0Y32I8URogIbwFkxq9r8GOji1u0kKd7uOaGt9hLd8wyONKl.zVeY2','Jefe de Proceso'),
(8,'Elizabeth Barrientos Ruiz','ebarrientos@atzco.com.mx','Elizabeth','$2y$10$IlmqEKm0JVJ2k6G.0pHZkO/5qDmUpfcvKmqPIqRsDYdkq2ZqOrCuy','Jefe de Proceso'),
(9,'Ana Daniela','rh.aux@atzco.com.mx','Daniela','$2y$10$XNojVn67NPGlxWlxMwm5MO4NGWggevwFHfKU1/UAuvC0aRAwMWDz6','Jefe de Proceso'),
(10,'Fabiola Esquivel Meza','rh.tula@atzco.com.mx','Fabiola','$2y$10$akD2dVMUXERquEXsYJBgXehRCxQ7Ydmg7nnAQV.Hm2R1eM10u7b56','Jefe de Proceso'),
(11,'Deysi Soria Ramirez','rh1.salamanca@atzco.com.mx','Deysi','$2y$10$uJiiJWEopRVzAJxo8k4yNe9Jr08vrEjqWyS1HI67do2UyTQZiiVDO','Auxiliar'),
(12,'Lucia Martinez Palacios','lucymtz_palacios@hotmail.com','Lucy','$2y$10$tmNqF9/cOVAYDQCywJPgd.WwAMJ6uT82h3w7Ay/d7QxxuVgVvAqrG','Auxiliar'),
(13,'auxiliar jfklaj jkfa','prueba@gmail.com','auxiliar','$2y$10$8TecOXRC6ToS.cUFg58mP.Y5MZsw9HitwPc2b6L1Gge.1tXIoYfky','Auxiliar'),
(14,'jefe de proceso prueba','jefe@gmail.com','jefe','$2y$10$eotJIKBmb.AoHPO.NV6PHe1OukuGEYwjhbvCEQ0q7/hITkwiSVWxO','Jefe de Proceso'),
(18,'ALAN GARCIA','alan.garcia@atzco.com.mx','alan09','$2y$10$ZRsChomblaizzSafQ1heYu0ygC4QCs/JmmqOqgxKq9FosUVStgynK','Superadministrador');
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
  KEY `vacaciones_ibfk_1` (`empleado_id`),
  CONSTRAINT `vacaciones_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`empleado_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacaciones`
--

LOCK TABLES `vacaciones` WRITE;
/*!40000 ALTER TABLE `vacaciones` DISABLE KEYS */;
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

-- Dump completed on 2024-07-11 19:24:28
