CREATE DATABASE  IF NOT EXISTS `boletines` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `boletines`;
-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: boletines
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `disciplina` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
/*!40000 ALTER TABLE `area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `area_curso`
--

DROP TABLE IF EXISTS `area_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area_curso` (
  `area` int(11) NOT NULL,
  `curso` int(11) NOT NULL,
  PRIMARY KEY (`area`,`curso`),
  KEY `fk_area_curso_curso1_idx` (`curso`),
  CONSTRAINT `fk_area_curso_area1` FOREIGN KEY (`area`) REFERENCES `area` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_area_curso_curso1` FOREIGN KEY (`curso`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area_curso`
--

LOCK TABLES `area_curso` WRITE;
/*!40000 ALTER TABLE `area_curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `area_curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barrio`
--

DROP TABLE IF EXISTS `barrio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barrio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `upz` varchar(45) DEFAULT NULL,
  `localidad` varchar(45) DEFAULT NULL,
  `sigla` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barrio`
--

LOCK TABLES `barrio` WRITE;
/*!40000 ALTER TABLE `barrio` DISABLE KEYS */;
INSERT INTO `barrio` (`id`, `nombre`, `upz`, `localidad`, `sigla`, `activo`) VALUES (1,'Patio Bonito','Patio','Kennedy','P',1);
/*!40000 ALTER TABLE `barrio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calificacion`
--

DROP TABLE IF EXISTS `calificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` varchar(45) DEFAULT NULL,
  `fecha_planeacion` date DEFAULT NULL,
  `tipo_evaluacion` int(11) NOT NULL,
  `meta` int(11) NOT NULL,
  `matricula` int(11) NOT NULL,
  PRIMARY KEY (`id`,`tipo_evaluacion`,`meta`,`matricula`),
  KEY `fk_calificacion_tipo_evaluacion1_idx` (`tipo_evaluacion`),
  KEY `fk_calificacion_meta1_idx` (`meta`),
  KEY `fk_calificacion_matricula1_idx` (`matricula`),
  CONSTRAINT `fk_calificacion_matricula1` FOREIGN KEY (`matricula`) REFERENCES `matricula` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_calificacion_meta1` FOREIGN KEY (`meta`) REFERENCES `meta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_calificacion_tipo_evaluacion1` FOREIGN KEY (`tipo_evaluacion`) REFERENCES `tipo_evaluacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calificacion`
--

LOCK TABLES `calificacion` WRITE;
/*!40000 ALTER TABLE `calificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `calificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `departamento` int(11) NOT NULL,
  PRIMARY KEY (`id`,`departamento`),
  KEY `fk_ciudad_departamento1_idx` (`departamento`),
  CONSTRAINT `fk_ciudad_departamento1` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudad`
--

LOCK TABLES `ciudad` WRITE;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
INSERT INTO `ciudad` (`id`, `nombre`, `activo`, `departamento`) VALUES (1,'Fomeque',1,1);
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `pais` int(11) NOT NULL,
  PRIMARY KEY (`id`,`pais`),
  KEY `fk_departamento_pais1_idx` (`pais`),
  CONSTRAINT `fk_departamento_pais1` FOREIGN KEY (`pais`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` (`id`, `nombre`, `activo`, `pais`) VALUES (1,'Cundinamarca',1,1);
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `director_curso`
--

DROP TABLE IF EXISTS `director_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `director_curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anio` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `curso` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`,`curso`,`usuario`),
  KEY `fk_director_curso_curso1_idx` (`curso`),
  KEY `fk_director_curso_usuario1_idx` (`usuario`),
  CONSTRAINT `fk_director_curso_curso1` FOREIGN KEY (`curso`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_director_curso_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `director_curso`
--

LOCK TABLES `director_curso` WRITE;
/*!40000 ALTER TABLE `director_curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `director_curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento`
--

DROP TABLE IF EXISTS `documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) DEFAULT NULL COMMENT 'CONTRATOS DEL DOCENTE\nDOCUMENTO DE IDENTIDAD\nCERTIFICADO MEDICO\nBOLETIN\nFOTO\nFIRMA',
  `archivo` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `matricula` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_documento_usuario1_idx` (`usuario`),
  KEY `fk_documento_matricula1_idx` (`matricula`),
  CONSTRAINT `fk_documento_matricula1` FOREIGN KEY (`matricula`) REFERENCES `matricula` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_documento_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento`
--

LOCK TABLES `documento` WRITE;
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
INSERT INTO `documento` (`id`, `tipo`, `archivo`, `activo`, `usuario`, `matricula`) VALUES (3,'Foto','41d598_aa1.png',0,1,NULL),(4,NULL,NULL,NULL,NULL,NULL),(6,NULL,NULL,NULL,NULL,NULL),(7,'Contrato','d4e184_aa1.png',0,1,NULL),(8,'Hoja de Vida','2ef7c8_HojaDeVida2016.pdf',1,1,NULL),(9,'Contrato','720596_aa1.png',1,1,NULL),(10,'Contrato','6008f4_aa1.png',1,1,NULL),(11,'Contrato','326684_aa1.png',0,1,NULL),(12,'Foto','df3c0e_98c5e6_7f06c46299194924a2822af51dd846a',1,1,NULL),(13,'Foto','808094_98c5e6_7f06c46299194924a2822af51dd846a',1,1,NULL),(14,'Contrato','422679_aa1.png',0,8,NULL),(15,'Contrato','efb801_aa1.png',0,8,NULL),(16,'Foto','d900d7_diana.png',1,8,NULL);
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluacion`
--

DROP TABLE IF EXISTS `evaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `procentaje` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluacion`
--

LOCK TABLES `evaluacion` WRITE;
/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inasistencia`
--

DROP TABLE IF EXISTS `inasistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inasistencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `observaciones` varchar(45) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `matricula` int(11) NOT NULL,
  PRIMARY KEY (`id`,`matricula`),
  KEY `fk_inasistencia_matricula1_idx` (`matricula`),
  CONSTRAINT `fk_inasistencia_matricula1` FOREIGN KEY (`matricula`) REFERENCES `matricula` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inasistencia`
--

LOCK TABLES `inasistencia` WRITE;
/*!40000 ALTER TABLE `inasistencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `inasistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matricula`
--

DROP TABLE IF EXISTS `matricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matricula` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_registro` date DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `numero_documento` varchar(45) DEFAULT NULL,
  `ubicacion` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `eps` varchar(45) DEFAULT NULL,
  `ips` varchar(45) DEFAULT NULL,
  `ars` varchar(45) DEFAULT NULL,
  `sisben` varchar(45) DEFAULT NULL,
  `estrato` varchar(45) DEFAULT NULL,
  `valor_matricula` int(11) DEFAULT NULL,
  `valor_pension` int(11) DEFAULT NULL,
  `curso` int(11) NOT NULL,
  `tipo_documento` int(11) NOT NULL,
  `ciudad_expedicion` int(11) DEFAULT NULL,
  `tipo_discapacidad` int(11) DEFAULT NULL,
  `barrio` int(11) NOT NULL,
  `estudiante` int(11) NOT NULL,
  PRIMARY KEY (`id`,`curso`,`tipo_documento`,`barrio`,`estudiante`),
  KEY `fk_matricula_curso1_idx` (`curso`),
  KEY `fk_matricula_tipo_documento1_idx` (`tipo_documento`),
  KEY `fk_matricula_ciudad1_idx` (`ciudad_expedicion`),
  KEY `fk_matricula_tipo_discapacidad1_idx` (`tipo_discapacidad`),
  KEY `fk_matricula_barrio1_idx` (`barrio`),
  KEY `fk_matricula_usuario1_idx` (`estudiante`),
  CONSTRAINT `fk_matricula_barrio1` FOREIGN KEY (`barrio`) REFERENCES `barrio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_ciudad1` FOREIGN KEY (`ciudad_expedicion`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_curso1` FOREIGN KEY (`curso`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_tipo_discapacidad1` FOREIGN KEY (`tipo_discapacidad`) REFERENCES `tipo_discapacidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_tipo_documento1` FOREIGN KEY (`tipo_documento`) REFERENCES `tipo_documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_usuario1` FOREIGN KEY (`estudiante`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matricula`
--

LOCK TABLES `matricula` WRITE;
/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
/*!40000 ALTER TABLE `matricula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta`
--

DROP TABLE IF EXISTS `meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `area` int(11) NOT NULL,
  PRIMARY KEY (`id`,`area`),
  KEY `fk_meta_area1_idx` (`area`),
  CONSTRAINT `fk_meta_area1` FOREIGN KEY (`area`) REFERENCES `area` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta`
--

LOCK TABLES `meta` WRITE;
/*!40000 ALTER TABLE `meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo`
--

DROP TABLE IF EXISTS `modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `pagina` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `fecha_crear` datetime DEFAULT NULL,
  `fecha_editar` datetime DEFAULT NULL,
  `usuario_crear` int(11) DEFAULT NULL,
  `usuario_editar` int(11) DEFAULT NULL,
  `padre` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_modulo_usuario1_idx` (`usuario_crear`),
  KEY `fk_modulo_usuario2_idx` (`usuario_editar`),
  KEY `fk_modulo_modulo1_idx` (`padre`),
  CONSTRAINT `fk_modulo_modulo1` FOREIGN KEY (`padre`) REFERENCES `modulo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_modulo_usuario1` FOREIGN KEY (`usuario_crear`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_modulo_usuario2` FOREIGN KEY (`usuario_editar`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo`
--

LOCK TABLES `modulo` WRITE;
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
INSERT INTO `modulo` (`id`, `nombre`, `pagina`, `activo`, `fecha_crear`, `fecha_editar`, `usuario_crear`, `usuario_editar`, `padre`, `orden`) VALUES (10,'Index',NULL,1,'2016-06-14 16:25:52','2016-06-15 16:01:59',1,1,NULL,1),(11,'Seguridad','seguridad',1,'2016-06-14 16:26:10','2016-06-16 15:16:03',1,1,NULL,2),(12,'Perfil',NULL,1,'2016-06-15 16:02:38','2016-06-15 16:21:07',1,1,11,2),(13,'Permiso',NULL,1,'2016-06-15 16:02:49','2016-06-15 16:21:04',1,1,11,3),(14,'Modulo',NULL,1,'2016-06-15 16:03:01','2016-06-15 16:21:01',1,1,11,4),(15,'Usuario',NULL,1,'2016-06-15 16:20:48',NULL,1,NULL,11,1),(16,'Matriculas','matriculas',1,'2016-06-29 15:54:19','2016-06-29 17:07:08',1,1,10,3);
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo_perfil_permiso`
--

DROP TABLE IF EXISTS `modulo_perfil_permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulo_perfil_permiso` (
  `perfil` int(11) NOT NULL,
  `permiso` int(11) NOT NULL,
  `modulo` int(11) NOT NULL,
  PRIMARY KEY (`perfil`,`permiso`,`modulo`),
  KEY `fk_modulo_perfil_modulo_permiso1_idx` (`permiso`),
  KEY `fk_modulo_perfil_modulo_modulo1_idx` (`modulo`),
  CONSTRAINT `fk_modulo_perfil_modulo_modulo1` FOREIGN KEY (`modulo`) REFERENCES `modulo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_modulo_perfil_modulo_perfil1` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_modulo_perfil_modulo_permiso1` FOREIGN KEY (`permiso`) REFERENCES `permiso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo_perfil_permiso`
--

LOCK TABLES `modulo_perfil_permiso` WRITE;
/*!40000 ALTER TABLE `modulo_perfil_permiso` DISABLE KEYS */;
INSERT INTO `modulo_perfil_permiso` (`perfil`, `permiso`, `modulo`) VALUES (1,1,10),(1,1,11),(1,1,12),(1,1,13),(1,1,14),(1,1,15),(1,1,16),(4,1,11),(2,2,11),(5,2,11),(2,3,15),(3,3,11),(3,3,14),(3,3,15),(4,3,12),(4,3,13),(4,3,15),(5,3,15);
/*!40000 ALTER TABLE `modulo_perfil_permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `observatorio`
--

DROP TABLE IF EXISTS `observatorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `observatorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `observaciones` varchar(45) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `matricula` int(11) NOT NULL,
  PRIMARY KEY (`id`,`matricula`),
  KEY `fk_inasistencia_matricula1_idx` (`matricula`),
  CONSTRAINT `fk_inasistencia_matricula11` FOREIGN KEY (`matricula`) REFERENCES `matricula` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `observatorio`
--

LOCK TABLES `observatorio` WRITE;
/*!40000 ALTER TABLE `observatorio` DISABLE KEYS */;
/*!40000 ALTER TABLE `observatorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` (`id`, `nombre`, `activo`) VALUES (1,'Colombia',1);
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pension`
--

DROP TABLE IF EXISTS `pension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pension` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `observaciones` varchar(45) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `matricula` int(11) NOT NULL,
  PRIMARY KEY (`id`,`matricula`),
  KEY `fk_inasistencia_matricula1_idx` (`matricula`),
  CONSTRAINT `fk_inasistencia_matricula10` FOREIGN KEY (`matricula`) REFERENCES `matricula` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pension`
--

LOCK TABLES `pension` WRITE;
/*!40000 ALTER TABLE `pension` DISABLE KEYS */;
/*!40000 ALTER TABLE `pension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `fecha_crear` datetime DEFAULT NULL,
  `fecha_editar` datetime DEFAULT NULL,
  `usuario_crear` int(11) DEFAULT NULL,
  `usuario_editar` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_perfil_usuario1_idx` (`usuario_crear`),
  KEY `fk_perfil_usuario2_idx` (`usuario_editar`),
  CONSTRAINT `fk_perfil_usuario1` FOREIGN KEY (`usuario_crear`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfil_usuario2` FOREIGN KEY (`usuario_editar`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`id`, `nombre`, `activo`, `fecha_crear`, `fecha_editar`, `usuario_crear`, `usuario_editar`) VALUES (1,'Administrador del Sistema..',1,'2016-06-10 16:41:28','2016-06-29 14:33:13',1,1),(2,'Directivos',1,'2016-06-10 16:41:56','2016-06-10 16:45:05',1,1),(3,'Coordinadores',1,'2016-06-10 16:45:44',NULL,1,NULL),(4,'Docentes',1,'2016-06-10 16:46:10',NULL,1,NULL),(5,'Estudiantes',1,'2016-06-10 16:46:18',NULL,1,NULL);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permiso`
--

DROP TABLE IF EXISTS `permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permiso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `fecha_crear` datetime DEFAULT NULL,
  `fecha_editar` datetime DEFAULT NULL,
  `usuario_crear` int(11) DEFAULT NULL,
  `usuario_editar` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_permiso_usuario1_idx` (`usuario_crear`),
  KEY `fk_permiso_usuario2_idx` (`usuario_editar`),
  CONSTRAINT `fk_permiso_usuario1` FOREIGN KEY (`usuario_crear`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_permiso_usuario2` FOREIGN KEY (`usuario_editar`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permiso`
--

LOCK TABLES `permiso` WRITE;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` (`id`, `nombre`, `activo`, `fecha_crear`, `fecha_editar`, `usuario_crear`, `usuario_editar`) VALUES (1,'Control Total',1,'2016-06-10 16:51:14','2016-06-10 16:51:40',1,1),(2,'Lectura y Escritura',1,'2016-06-10 16:52:02',NULL,1,NULL),(3,'Lectura',1,'2016-06-10 16:52:13',NULL,1,NULL);
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reconocimiento`
--

DROP TABLE IF EXISTS `reconocimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reconocimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo` int(11) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `estilo` varchar(45) DEFAULT NULL,
  `matricula` int(11) NOT NULL,
  PRIMARY KEY (`id`,`matricula`),
  KEY `fk_inasistencia_matricula1_idx` (`matricula`),
  CONSTRAINT `fk_inasistencia_matricula12` FOREIGN KEY (`matricula`) REFERENCES `matricula` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reconocimiento`
--

LOCK TABLES `reconocimiento` WRITE;
/*!40000 ALTER TABLE `reconocimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `reconocimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regla_calificacion`
--

DROP TABLE IF EXISTS `regla_calificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regla_calificacion` (
  `id` int(11) NOT NULL,
  `conceptual` varchar(45) DEFAULT NULL,
  `min` varchar(45) DEFAULT NULL,
  `max` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regla_calificacion`
--

LOCK TABLES `regla_calificacion` WRITE;
/*!40000 ALTER TABLE `regla_calificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `regla_calificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_discapacidad`
--

DROP TABLE IF EXISTS `tipo_discapacidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_discapacidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `sigla` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_discapacidad`
--

LOCK TABLES `tipo_discapacidad` WRITE;
/*!40000 ALTER TABLE `tipo_discapacidad` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_discapacidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `sigla` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_documento`
--

LOCK TABLES `tipo_documento` WRITE;
/*!40000 ALTER TABLE `tipo_documento` DISABLE KEYS */;
INSERT INTO `tipo_documento` (`id`, `nombre`, `sigla`, `activo`) VALUES (1,'Cedula Ciudadania','CC',1);
/*!40000 ALTER TABLE `tipo_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_evaluacion`
--

DROP TABLE IF EXISTS `tipo_evaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_evaluacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL COMMENT 'Meta,Examen Final,PM,Observaciones',
  `activo` tinyint(1) DEFAULT NULL,
  `evaluacion` int(11) NOT NULL,
  PRIMARY KEY (`id`,`evaluacion`),
  KEY `fk_tipo_evaluacion_evaluacion1_idx` (`evaluacion`),
  CONSTRAINT `fk_tipo_evaluacion_evaluacion1` FOREIGN KEY (`evaluacion`) REFERENCES `evaluacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_evaluacion`
--

LOCK TABLES `tipo_evaluacion` WRITE;
/*!40000 ALTER TABLE `tipo_evaluacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `primer_nombre` varchar(45) DEFAULT NULL,
  `segundo_nombre` varchar(45) DEFAULT NULL,
  `primer_apellido` varchar(45) DEFAULT NULL,
  `segundo_apellido` varchar(45) DEFAULT NULL,
  `numero_documento` varchar(45) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `rh` varchar(45) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` varchar(45) DEFAULT NULL,
  `ubicacion` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `profesion` varchar(45) DEFAULT NULL,
  `ciudad_nacimiento` int(11) DEFAULT NULL,
  `tipo_documento` int(11) NOT NULL,
  `barrio` int(11) NOT NULL,
  `acudiente` int(11) DEFAULT NULL,
  `fecha_crear` datetime DEFAULT NULL,
  `usuario_crear` int(11) DEFAULT NULL,
  `fecha_editar` datetime DEFAULT NULL,
  `usuario_editar` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`tipo_documento`,`barrio`),
  KEY `fk_usuario_ciudad1_idx` (`ciudad_nacimiento`),
  KEY `fk_usuario_tipo_documento1_idx` (`tipo_documento`),
  KEY `fk_usuario_barrio1_idx` (`barrio`),
  KEY `fk_usuario_usuario1_idx` (`acudiente`),
  KEY `fk_usuario_usuario2_idx` (`usuario_crear`),
  KEY `fk_usuario_usuario3_idx` (`usuario_editar`),
  CONSTRAINT `fk_usuario_barrio1` FOREIGN KEY (`barrio`) REFERENCES `barrio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_ciudad1` FOREIGN KEY (`ciudad_nacimiento`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_tipo_documento1` FOREIGN KEY (`tipo_documento`) REFERENCES `tipo_documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_usuario1` FOREIGN KEY (`acudiente`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_usuario2` FOREIGN KEY (`usuario_crear`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_usuario3` FOREIGN KEY (`usuario_editar`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `numero_documento`, `usuario`, `clave`, `activo`, `rh`, `fecha_nacimiento`, `genero`, `ubicacion`, `telefono`, `celular`, `profesion`, `ciudad_nacimiento`, `tipo_documento`, `barrio`, `acudiente`, `fecha_crear`, `usuario_crear`, `fecha_editar`, `usuario_editar`) VALUES (1,'William','Alexander','Barbosa','Fuentes','80882565','ingeniero.wb@gmail.com','356a192b7913b04c54574d18c28d46e6395428ab',1,'kjhkjh','2016-06-15','M','231231','1231231','23123','hkjh',1,1,1,NULL,NULL,NULL,'2016-06-24 14:02:15',1),(2,'JHGJHG','JHGJHG','JHGJHG','JHG','8088256555','administrador@gmail.com','123',0,'kjhkjh','2016-06-24','M','231231','1231231','23123','hkjh',1,1,1,NULL,NULL,NULL,NULL,NULL),(3,'JHGJHG','JHGJHG','JHGJHG','JHG','8088256523123123','administraaador@gmail.com','',0,'kjhkjh','2016-06-24','M','231231','1231231','23123','hkjh',1,1,1,NULL,'2016-06-10 14:49:05',1,NULL,NULL),(4,'JHGJHG','JHGJHG','JHGJHG','JHG','8088256555aa','administssrador@gmail.com','356a192b7913b04c54574d18c28d46e6395428ab',0,'kjhkjh','2016-07-08','F','231231','1231231','23123','hkjh',1,1,1,NULL,'2016-06-10 14:50:12',1,'2016-06-10 15:08:32',1),(5,'897897897','89789789','7897897','89789789','897','wbarbosa@hghj.com','8292f3d14ac781d0f177d75f4d6cd9302b0f8694',0,'89789','2016-06-27','F','7897897','89789','87','7897987',1,1,1,NULL,'2016-06-27 15:14:05',1,NULL,NULL),(6,'6786876','7687687','687687','687687687','77788887768','wbarbosaaaa7777@hghj.com','da39a3ee5e6b4b0d3255bfef95601890afd80709',1,'87687687','2016-07-27','M','876876','7687687','78687687687','87676',1,1,1,NULL,'2016-06-27 15:24:12',1,NULL,NULL),(7,'6786876','7687687','687687','89789789','76876iu687687','wbarbosa@hgaaahj.com','6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2',1,'87687687','2016-06-28','M','7897897','876876','78687687687','7897987',1,1,1,NULL,'2016-06-27 15:25:21',1,NULL,NULL),(8,'EL MEJOR','98789789','7897987','89789789','878789798','wbarbosa@hghj798789789.com','',1,'897897897','2016-06-14','F','8789789','897987','7897897','798789',1,1,1,NULL,'2016-06-27 15:34:44',1,'2016-06-27 16:22:54',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_perfil`
--

DROP TABLE IF EXISTS `usuario_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_perfil` (
  `usuario` int(11) NOT NULL,
  `perfil` int(11) NOT NULL,
  PRIMARY KEY (`usuario`,`perfil`),
  KEY `fk_usuario_perfil_perfil1_idx` (`perfil`),
  CONSTRAINT `fk_usuario_perfil_perfil1` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_perfil_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_perfil`
--

LOCK TABLES `usuario_perfil` WRITE;
/*!40000 ALTER TABLE `usuario_perfil` DISABLE KEYS */;
INSERT INTO `usuario_perfil` (`usuario`, `perfil`) VALUES (1,1),(8,1),(1,2),(8,2),(1,3),(1,4),(1,5);
/*!40000 ALTER TABLE `usuario_perfil` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-30  7:40:26
