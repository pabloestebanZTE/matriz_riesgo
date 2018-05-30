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
-- Table structure for table `ref_probabilidad_impacto`
--

DROP TABLE IF EXISTS `ref_probabilidad_impacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_probabilidad_impacto` (
  `k_⁯id_ref` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_probabilidad` int(11) DEFAULT '0',
  `k_id_impacto` int(11) DEFAULT '0',
  `n_calificacion` varchar(15) DEFAULT NULL,
  `n_color` varchar(7) NOT NULL DEFAULT '#FFFFFF',
  `n_text_color` varchar(7) NOT NULL DEFAULT '#000000',
  PRIMARY KEY (`k_⁯id_ref`),
  KEY `k_id_probabilidad` (`k_id_probabilidad`),
  KEY `k_id_impacto` (`k_id_impacto`),
  CONSTRAINT `FK__impacto` FOREIGN KEY (`k_id_impacto`) REFERENCES `impacto` (`k_id_impacto`),
  CONSTRAINT `FK__probabilidad` FOREIGN KEY (`k_id_probabilidad`) REFERENCES `probabilidad` (`k_id_probabilidad`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_probabilidad_impacto`
--

LOCK TABLES `ref_probabilidad_impacto` WRITE;
/*!40000 ALTER TABLE `ref_probabilidad_impacto` DISABLE KEYS */;
INSERT INTO `ref_probabilidad_impacto` VALUES (1,5,5,'Bajo','#ADFF2F','#000000'),(2,5,4,'Bajo','#ADFF2F','#000000'),(3,5,3,'Moderado','#0000FF','#FFFFFF'),(4,5,2,'Alto','#FFFF00','#000000'),(5,5,1,'Extremo','#FF0000','#FFFFFF'),(6,4,5,'Bajo','#ADFF2F','#000000'),(7,4,4,'Bajo','#ADFF2F','#000000'),(8,4,3,'Moderado','#0000FF','#FFFFFF'),(9,4,2,'Alto','#FFFF00','#000000'),(10,4,1,'Extremo','#FF0000','#FFFFFF'),(11,3,5,'Bajo','#ADFF2F','#000000'),(12,3,4,'Moderado','#0000FF','#FFFFFF'),(13,3,3,'Moderado','#0000FF','#FFFFFF'),(14,3,2,'Alto','#FFFF00','#000000'),(15,3,1,'Extremo','#FF0000','#FFFFFF'),(16,2,5,'Bajo','#ADFF2F','#000000'),(17,2,4,'Moderado','#0000FF','#FFFFFF'),(18,2,3,'Alto','#FFFF00','#000000'),(19,2,2,'Alto','#FFFF00','#000000'),(20,2,1,'Extremo','#FF0000','#FFFFFF'),(21,1,5,'Bajo','#ADFF2F','#000000'),(22,1,4,'Moderado','#0000FF','#FFFFFF'),(23,1,3,'Alto','#FFFF00','#000000'),(24,1,2,'Extremo','#FF0000','#FFFFFF'),(25,1,1,'Extremo','#FF0000','#FFFFFF');
/*!40000 ALTER TABLE `ref_probabilidad_impacto` ENABLE KEYS */;
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
