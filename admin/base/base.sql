CREATE DATABASE  IF NOT EXISTS `boletines` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `boletines`;
-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: boletines
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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
INSERT INTO `barrio` VALUES (1,'Patio Bonito','Tablado','Kennedy','PB',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudad`
--

LOCK TABLES `ciudad` WRITE;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
INSERT INTO `ciudad` VALUES (2,'Fomeque',1,1);
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
INSERT INTO `departamento` VALUES (1,'Cundinamarca',1,1);
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
  `usuario` int(11) NOT NULL,
  `matricula` int(11) NOT NULL,
  PRIMARY KEY (`id`,`usuario`,`matricula`),
  KEY `fk_documento_usuario1_idx` (`usuario`),
  KEY `fk_documento_matricula1_idx` (`matricula`),
  CONSTRAINT `fk_documento_matricula1` FOREIGN KEY (`matricula`) REFERENCES `matricula` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_documento_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento`
--

LOCK TABLES `documento` WRITE;
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
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
  `ciudad_expedicion` int(11) NOT NULL,
  `tipo_discapacidad` int(11) NOT NULL,
  `barrio` int(11) NOT NULL,
  `estudiante` int(11) NOT NULL,
  PRIMARY KEY (`id`,`curso`,`tipo_documento`,`ciudad_expedicion`,`tipo_discapacidad`,`barrio`,`estudiante`),
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
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo`
--

LOCK TABLES `modulo` WRITE;
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo_perfil_modulo`
--

DROP TABLE IF EXISTS `modulo_perfil_modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulo_perfil_modulo` (
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
-- Dumping data for table `modulo_perfil_modulo`
--

LOCK TABLES `modulo_perfil_modulo` WRITE;
/*!40000 ALTER TABLE `modulo_perfil_modulo` DISABLE KEYS */;
/*!40000 ALTER TABLE `modulo_perfil_modulo` ENABLE KEYS */;
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
INSERT INTO `pais` VALUES (1,'Colombia',1);
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permiso`
--

LOCK TABLES `permiso` WRITE;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
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
INSERT INTO `tipo_documento` VALUES (1,'Cedula Ciudadanía','CC',1);
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
  `tipo_documento` int(11) DEFAULT NULL,
  `barrio` int(11) DEFAULT NULL,
  `acudiente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_ciudad1_idx` (`ciudad_nacimiento`),
  KEY `fk_usuario_tipo_documento1_idx` (`tipo_documento`),
  KEY `fk_usuario_barrio1_idx` (`barrio`),
  KEY `fk_usuario_usuario1_idx` (`acudiente`),
  CONSTRAINT `fk_usuario_barrio1` FOREIGN KEY (`barrio`) REFERENCES `barrio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_ciudad1` FOREIGN KEY (`ciudad_nacimiento`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_tipo_documento1` FOREIGN KEY (`tipo_documento`) REFERENCES `tipo_documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_usuario1` FOREIGN KEY (`acudiente`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'William','Alexander','Barbosa','Fuentes','80882565','w','50e721e49c013f00c62cf59f2163542a9d8df02464efe',1,NULL,NULL,NULL,NULL,NULL,NULL,'Ingeniero Sistemas',NULL,1,NULL,NULL),(2,'William','Steven','Barbosa','Lozano','123456','w','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Jeimi','Constanza','Lozano','Marquez','654321','j',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'jeimi','contanza','lozano','maeque','12','jj@jj.com','1',1,'a+','0000-00-00','M','Calle 38 c sur n 86 g 20','4848600','3142089100',NULL,2,1,1,NULL);
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

-- Dump completed on 2016-06-01 22:13:37
