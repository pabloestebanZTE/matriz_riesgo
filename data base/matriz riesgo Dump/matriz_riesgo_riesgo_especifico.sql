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
-- Table structure for table `riesgo_especifico`
--

DROP TABLE IF EXISTS `riesgo_especifico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `riesgo_especifico` (
  `k_id_riesgo_especifico` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_plataforma` int(11) DEFAULT NULL,
  `k_id_riesgo` varchar(50) DEFAULT NULL,
  `k_id_zona_geografica` int(11) DEFAULT NULL,
  `k_id_tipo_evento_2` int(11) DEFAULT NULL,
  `n_macro_proceso` varchar(50) DEFAULT NULL,
  `n_proceso` varchar(50) DEFAULT NULL,
  `n_servicio` varchar(50) DEFAULT NULL,
  `n_responsable` varchar(50) DEFAULT NULL,
  `k_id_probabilidad` int(11) DEFAULT NULL,
  `k_id_impacto` int(11) DEFAULT NULL,
  `n_objetivo` varchar(50) DEFAULT NULL,
  `n_tipo_activad` varchar(50) DEFAULT NULL,
  `n_severidad_riesgo_inherente` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`k_id_riesgo_especifico`),
  KEY `fk_fk_re_plataforma` (`k_id_plataforma`),
  KEY `fk_fk_re_riesgo` (`k_id_riesgo`),
  KEY `fk_fk_re_tipo_evento` (`k_id_tipo_evento_2`),
  KEY `fk_fk_re_zona_geografica` (`k_id_zona_geografica`),
  CONSTRAINT `fk_fk_re_plataforma` FOREIGN KEY (`k_id_plataforma`) REFERENCES `plataforma` (`k_id_plataforma`),
  CONSTRAINT `fk_fk_re_riesgo` FOREIGN KEY (`k_id_riesgo`) REFERENCES `riesgo` (`k_id_riesgo`),
  CONSTRAINT `fk_fk_re_tipo_evento` FOREIGN KEY (`k_id_tipo_evento_2`) REFERENCES `tipo_evento_2` (`k_id_tipo_evento_2`),
  CONSTRAINT `fk_fk_re_zona_geografica` FOREIGN KEY (`k_id_zona_geografica`) REFERENCES `zona_geografica` (`k_id_zona_geografica`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riesgo_especifico`
--

LOCK TABLES `riesgo_especifico` WRITE;
/*!40000 ALTER TABLE `riesgo_especifico` DISABLE KEYS */;
INSERT INTO `riesgo_especifico` VALUES (1,1,'R5',1,18,'Gestion Empresarial','Gestión de soporte y procesos','Voz, servicios de valor agregado, Datos.','',3,3,'Definir la metodología a ser empleada por todos lo','OT','Moderado');
/*!40000 ALTER TABLE `riesgo_especifico` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-28 10:11:42
