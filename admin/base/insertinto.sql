CREATE DATABASE  IF NOT EXISTS `boletines` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `boletines`;
-- MySQL dump 10.13  Distrib 5.6.19, for linux-glibc2.5 (x86_64)
--
-- Host: 127.0.0.1    Database: boletines
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.12.04.1

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
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
/*!40000 ALTER TABLE `area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `area_curso`
--

LOCK TABLES `area_curso` WRITE;
/*!40000 ALTER TABLE `area_curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `area_curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `barrio`
--

LOCK TABLES `barrio` WRITE;
/*!40000 ALTER TABLE `barrio` DISABLE KEYS */;
INSERT INTO `barrio` VALUES (1,'Patio Bonito','Patio','Kennedy','P',1);
/*!40000 ALTER TABLE `barrio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `calificacion`
--

LOCK TABLES `calificacion` WRITE;
/*!40000 ALTER TABLE `calificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `calificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `ciudad`
--

LOCK TABLES `ciudad` WRITE;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
INSERT INTO `ciudad` VALUES (1,'Fomeque',1,1);
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,'Cundinamarca',1,1);
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `director_curso`
--

LOCK TABLES `director_curso` WRITE;
/*!40000 ALTER TABLE `director_curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `director_curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `documento`
--

LOCK TABLES `documento` WRITE;
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
INSERT INTO `documento` VALUES (3,'Foto','41d598_aa1.png',1,1,NULL),(4,NULL,NULL,NULL,NULL,NULL),(6,NULL,NULL,NULL,NULL,NULL),(7,'Contrato','d4e184_aa1.png',1,1,NULL),(8,'Hoja de Vida','2ef7c8_HojaDeVida2016.pdf',1,1,NULL);
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `evaluacion`
--

LOCK TABLES `evaluacion` WRITE;
/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `inasistencia`
--

LOCK TABLES `inasistencia` WRITE;
/*!40000 ALTER TABLE `inasistencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `inasistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `matricula`
--

LOCK TABLES `matricula` WRITE;
/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
/*!40000 ALTER TABLE `matricula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `meta`
--

LOCK TABLES `meta` WRITE;
/*!40000 ALTER TABLE `meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `modulo`
--

LOCK TABLES `modulo` WRITE;
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `modulo_perfil_modulo`
--

LOCK TABLES `modulo_perfil_modulo` WRITE;
/*!40000 ALTER TABLE `modulo_perfil_modulo` DISABLE KEYS */;
/*!40000 ALTER TABLE `modulo_perfil_modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `observatorio`
--

LOCK TABLES `observatorio` WRITE;
/*!40000 ALTER TABLE `observatorio` DISABLE KEYS */;
/*!40000 ALTER TABLE `observatorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` VALUES (1,'Colombia',1);
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `pension`
--

LOCK TABLES `pension` WRITE;
/*!40000 ALTER TABLE `pension` DISABLE KEYS */;
/*!40000 ALTER TABLE `pension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'Administrador del Sistema',1,'2016-06-10 16:41:28','2016-06-10 16:44:46',1,1),(2,'Directivos',1,'2016-06-10 16:41:56','2016-06-10 16:45:05',1,1),(3,'Coordinadores',1,'2016-06-10 16:45:44',NULL,1,NULL),(4,'Docentes',1,'2016-06-10 16:46:10',NULL,1,NULL),(5,'Estudiantes',1,'2016-06-10 16:46:18',NULL,1,NULL);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `permiso`
--

LOCK TABLES `permiso` WRITE;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` VALUES (1,'Control Total',1,'2016-06-10 16:51:14','2016-06-10 16:51:40',1,1),(2,'Lectura y Escritura',1,'2016-06-10 16:52:02',NULL,1,NULL),(3,'Lectura',1,'2016-06-10 16:52:13',NULL,1,NULL);
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `reconocimiento`
--

LOCK TABLES `reconocimiento` WRITE;
/*!40000 ALTER TABLE `reconocimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `reconocimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `regla_calificacion`
--

LOCK TABLES `regla_calificacion` WRITE;
/*!40000 ALTER TABLE `regla_calificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `regla_calificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tipo_discapacidad`
--

LOCK TABLES `tipo_discapacidad` WRITE;
/*!40000 ALTER TABLE `tipo_discapacidad` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_discapacidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tipo_documento`
--

LOCK TABLES `tipo_documento` WRITE;
/*!40000 ALTER TABLE `tipo_documento` DISABLE KEYS */;
INSERT INTO `tipo_documento` VALUES (1,'Cedula Ciudadania','CC',1);
/*!40000 ALTER TABLE `tipo_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tipo_evaluacion`
--

LOCK TABLES `tipo_evaluacion` WRITE;
/*!40000 ALTER TABLE `tipo_evaluacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'William','Alexander','Barbosa','Fuentes','80882565','ingeniero.wb@gmail.com','',0,'kjhkjh','2016-06-15','M','231231','1231231','23123','hkjh',1,1,1,NULL,NULL,NULL,'2016-06-10 15:45:34',1),(2,'JHGJHG','JHGJHG','JHGJHG','JHG','8088256555','administrador@gmail.com','123',0,'kjhkjh','2016-06-24','M','231231','1231231','23123','hkjh',1,1,1,NULL,NULL,NULL,NULL,NULL),(3,'JHGJHG','JHGJHG','JHGJHG','JHG','8088256523123123','administraaador@gmail.com','',0,'kjhkjh','2016-06-24','M','231231','1231231','23123','hkjh',1,1,1,NULL,'2016-06-10 14:49:05',1,NULL,NULL),(4,'JHGJHG','JHGJHG','JHGJHG','JHG','8088256555aa','administssrador@gmail.com','356a192b7913b04c54574d18c28d46e6395428ab',0,'kjhkjh','2016-07-08','F','231231','1231231','23123','hkjh',1,1,1,NULL,'2016-06-10 14:50:12',1,'2016-06-10 15:08:32',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuario_perfil`
--

LOCK TABLES `usuario_perfil` WRITE;
/*!40000 ALTER TABLE `usuario_perfil` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'boletines'
--

--
-- Dumping routines for database 'boletines'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-10 17:03:05
