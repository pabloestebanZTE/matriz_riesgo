-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.28-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para matriz_riesgo
CREATE DATABASE IF NOT EXISTS `matriz_riesgo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `matriz_riesgo`;

-- Volcando estructura para tabla matriz_riesgo.ref_combox
CREATE TABLE IF NOT EXISTS `ref_combox` (
  `k_id_combox` int(11) NOT NULL AUTO_INCREMENT,
  `n_value` varchar(50) DEFAULT NULL,
  `n_text` varchar(50) DEFAULT NULL,
  `n_table` varchar(50) DEFAULT NULL,
  `n_sql` varchar(300) DEFAULT NULL,
  `d_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`k_id_combox`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.ref_combox: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `ref_combox` DISABLE KEYS */;
INSERT INTO `ref_combox` (`k_id_combox`, `n_value`, `n_text`, `n_table`, `n_sql`, `d_created_at`) VALUES
	(1, 'k_id_riesgo', 'n_riesgo', 'riesgo', NULL, '2017-12-19 11:09:40'),
	(2, 'k_id_factor_riesgo', 'n_descripcion', 'factor_riesgo', NULL, '2017-12-19 11:34:01'),
	(3, 'k_id_probabilidad', 'n_descripcion', 'probabilidad', NULL, '2017-12-19 11:42:14'),
	(4, 'k_id_impacto', 'n_descripcion', 'impacto', NULL, '2017-12-19 11:49:17'),
	(5, 'k_id_plataforma', 'n_nombre', 'plataforma', NULL, '2017-12-19 11:53:24'),
	(6, 'k_id_control', 'n_descripcion', 'control', NULL, '2017-12-19 12:07:00'),
	(7, 'k_id_tipo_evento_1', 'n_descripcion', 'tipo_evento_1', NULL, '2017-12-20 10:06:05');
/*!40000 ALTER TABLE `ref_combox` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
