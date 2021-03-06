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
-- Table structure for table `control_especifico`
--

DROP TABLE IF EXISTS `control_especifico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `control_especifico` (
  `k_id_control_especifico` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_control` varchar(50) DEFAULT NULL,
  `k_id_causa` int(11) DEFAULT NULL,
  `k_id_factor_riesgo` int(11) DEFAULT NULL,
  `k_id_calificacion` int(11) DEFAULT NULL,
  `n_state` varchar(50) NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`k_id_control_especifico`),
  KEY `fk_fk_ce_calificacion` (`k_id_calificacion`),
  KEY `fk_fk_ce_causa` (`k_id_causa`),
  KEY `fk_fk_ce_control` (`k_id_control`),
  KEY `fk_fk_ce_factor_riesgo` (`k_id_factor_riesgo`),
  CONSTRAINT `fk_fk_ce_calificacion` FOREIGN KEY (`k_id_calificacion`) REFERENCES `calificacion` (`k_id_calificacion`),
  CONSTRAINT `fk_fk_ce_causa` FOREIGN KEY (`k_id_causa`) REFERENCES `causa` (`k_id_causa`),
  CONSTRAINT `fk_fk_ce_control` FOREIGN KEY (`k_id_control`) REFERENCES `control` (`k_id_control`),
  CONSTRAINT `fk_fk_ce_factor_riesgo` FOREIGN KEY (`k_id_factor_riesgo`) REFERENCES `factor_riesgo` (`k_id_factor_riesgo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `control_especifico`
--

LOCK TABLES `control_especifico` WRITE;
/*!40000 ALTER TABLE `control_especifico` DISABLE KEYS */;
INSERT INTO `control_especifico` VALUES (1,'C1',1,1,1,'ACTIVE'),(2,'C2',2,1,NULL,'ACTIVE');
/*!40000 ALTER TABLE `control_especifico` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-28 10:11:44
