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
-- Table structure for table `soporte`
--

DROP TABLE IF EXISTS `soporte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `soporte` (
  `k_id_soporte` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_riesgo_especifico` int(11) DEFAULT NULL,
  `k_id_probabilidad` int(11) DEFAULT NULL,
  `k_id_impacto` int(11) DEFAULT NULL,
  `k_tipo` int(11) DEFAULT NULL,
  `n_nombre` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`k_id_soporte`),
  KEY `fk_fk_so_impacto` (`k_id_impacto`),
  KEY `fk_fk_so_probabilidad` (`k_id_probabilidad`),
  KEY `k_id_riesgo_especifico` (`k_id_riesgo_especifico`),
  CONSTRAINT `FK_soporte_riesgo_especifico` FOREIGN KEY (`k_id_riesgo_especifico`) REFERENCES `riesgo_especifico` (`k_id_riesgo_especifico`),
  CONSTRAINT `fk_fk_so_impacto` FOREIGN KEY (`k_id_impacto`) REFERENCES `impacto` (`k_id_impacto`),
  CONSTRAINT `fk_fk_so_probabilidad` FOREIGN KEY (`k_id_probabilidad`) REFERENCES `probabilidad` (`k_id_probabilidad`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `soporte`
--

LOCK TABLES `soporte` WRITE;
/*!40000 ALTER TABLE `soporte` DISABLE KEYS */;
INSERT INTO `soporte` VALUES (1,1,3,NULL,1,'3. Puede ocurrir en algún momento. Eventualidad con frecuencia moderada. (doce veces al año)'),(2,1,NULL,3,2,'3.1 CONTROL: Existen algunos controles pero no son los suficientes.'),(3,1,NULL,3,2,'3.2 OPERACIONAL: Interrupción de las operaciones de 2 a 4 horas');
/*!40000 ALTER TABLE `soporte` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-28 10:11:45
