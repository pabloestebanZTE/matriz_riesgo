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
-- Table structure for table `ref_combox`
--

DROP TABLE IF EXISTS `ref_combox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_combox` (
  `k_id_combox` int(11) NOT NULL AUTO_INCREMENT,
  `n_value` varchar(50) DEFAULT NULL,
  `n_text` varchar(50) DEFAULT NULL,
  `n_table` varchar(50) DEFAULT NULL,
  `n_sql` varchar(300) DEFAULT NULL,
  `d_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`k_id_combox`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_combox`
--

LOCK TABLES `ref_combox` WRITE;
/*!40000 ALTER TABLE `ref_combox` DISABLE KEYS */;
INSERT INTO `ref_combox` VALUES (1,'k_id_riesgo','n_riesgo','riesgo',NULL,'2017-12-19 16:09:40'),(2,'k_id_factor_riesgo','n_descripcion','factor_riesgo',NULL,'2017-12-19 16:34:01'),(3,'k_id_probabilidad','n_descripcion','probabilidad',NULL,'2017-12-19 16:42:14'),(4,'k_id_impacto','n_descripcion','impacto',NULL,'2017-12-19 16:49:17'),(5,'k_id_plataforma','n_nombre','plataforma',NULL,'2017-12-19 16:53:24'),(6,'k_id_control','n_descripcion','control',NULL,'2017-12-19 17:07:00'),(7,'k_id_tipo_evento_1','n_descripcion','tipo_evento_1',NULL,'2017-12-20 15:06:05');
/*!40000 ALTER TABLE `ref_combox` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-21  9:06:14
