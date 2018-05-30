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
-- Table structure for table `tipo_evento_2`
--

DROP TABLE IF EXISTS `tipo_evento_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_evento_2` (
  `k_id_tipo_evento_2` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_tipo_evento_1` int(11) DEFAULT NULL,
  `n_descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_tipo_evento_2`),
  KEY `fk_fk_te2_tipo_evento` (`k_id_tipo_evento_1`),
  CONSTRAINT `fk_fk_te2_tipo_evento` FOREIGN KEY (`k_id_tipo_evento_1`) REFERENCES `tipo_evento_1` (`k_id_tipo_evento_1`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_evento_2`
--

LOCK TABLES `tipo_evento_2` WRITE;
/*!40000 ALTER TABLE `tipo_evento_2` DISABLE KEYS */;
INSERT INTO `tipo_evento_2` VALUES (1,1,'1.1. Actividades no autorizadas'),(2,1,'1.2. Hurto y Fraude'),(3,2,'2.1. Hurto y Fraude'),(4,2,'2.2. Vulnerabilidad  de los sistemas'),(5,3,'3.1. Fallas en las Relaciones laborales'),(6,3,'3.2. Fallas en la seguridad del entorno laboral'),(7,3,'3.3. Discriminación'),(8,4,'4.1. Administración indebida  de activos y revelac'),(9,4,'4.2. Prácticas inapropiadas de negocios o de merca'),(10,4,'4.3. Fallas en los productos'),(11,4,'4.4. Fallas en la selección y gerenciamiento de lo'),(12,4,'4.5. Fallas en la asesoría a los clientes'),(13,5,'5.1. Desastres y otros eventos'),(14,6,'6.1. Fallas en los Sistemas'),(15,7,'7.1.1 Fallas en el diseño de los procesos. '),(16,7,'7.1.2 Fallas en la ejecución de los procesos.   '),(17,7,'7.1.3 Fallas en el mantenimiento de los procesos.'),(18,7,'7.2. Inoportunidad o inexactitud en la generación '),(19,7,'7.3. Ausencia de  documentación o documentación in'),(20,7,'7.4. Inadecuada administración de las cuentas de c'),(21,7,'7.5. Fallas de contrapartes comerciales'),(22,7,'7.6. Fallas de Proveedores o Outsourcing');
/*!40000 ALTER TABLE `tipo_evento_2` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-28 10:11:41
