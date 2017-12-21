-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: matriz_riesgo
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.28-MariaDB

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
-- Table structure for table `control`
--

DROP TABLE IF EXISTS `control`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `control` (
  `k_id_control` varchar(50) NOT NULL,
  `n_descripcion` varchar(250) DEFAULT NULL,
  `n_asignacion` varchar(50) DEFAULT NULL,
  `n_cargo` varchar(50) DEFAULT NULL,
  `n_tipo` varchar(50) DEFAULT NULL,
  `n_funcionalidad_tipo` varchar(50) DEFAULT NULL,
  `n_naturaleza_control` varchar(50) DEFAULT NULL,
  `n_periodicidad` varchar(50) DEFAULT NULL,
  `n_funcionalidad_frecuencia` varchar(50) DEFAULT NULL,
  `n_documentacion` varchar(50) DEFAULT NULL,
  `n_actividades` varchar(50) DEFAULT NULL,
  `n_ejecucion` varchar(50) DEFAULT NULL,
  `n_importancia` varchar(50) DEFAULT NULL,
  `n_disminuye_probabilidad` varchar(50) DEFAULT NULL,
  `n_disminuye_impacto` varchar(50) DEFAULT NULL,
  `n_riesgo_residual` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_control`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `control`
--

LOCK TABLES `control` WRITE;
/*!40000 ALTER TABLE `control` DISABLE KEYS */;
INSERT INTO `control` VALUES ('C1','Autorización en el siteaccess','Asignado','Jefe de central','Detectivo','Adecuado','Dependiente de T.I.','Cuando se requiera','Adecuado','Documentado','Adecuadas','Fuerte','Muy Importante','Sí','No',NULL);
/*!40000 ALTER TABLE `control` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-21  9:06:12
