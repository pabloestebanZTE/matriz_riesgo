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
DROP DATABASE IF EXISTS `matriz_riesgo`;
CREATE DATABASE IF NOT EXISTS `matriz_riesgo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `matriz_riesgo`;

-- Volcando estructura para tabla matriz_riesgo.actividad
DROP TABLE IF EXISTS `actividad`;
CREATE TABLE IF NOT EXISTS `actividad` (
  `k_id_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `n_nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_actividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.actividad: ~0 rows (aproximadamente)
DELETE FROM `actividad`;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.calificacion
DROP TABLE IF EXISTS `calificacion`;
CREATE TABLE IF NOT EXISTS `calificacion` (
  `k_id_calificacion` int(11) NOT NULL AUTO_INCREMENT,
  `n_pd1` int(11) DEFAULT NULL,
  `n_pd2` int(11) DEFAULT NULL,
  `n_pd3` int(11) DEFAULT NULL,
  `n_pd4` int(11) DEFAULT NULL,
  `n_pd5` int(11) DEFAULT NULL,
  `n_pe1` int(11) DEFAULT NULL,
  `n_pe2` int(11) DEFAULT NULL,
  `n_pe3` int(11) DEFAULT NULL,
  `n_pe4` int(11) DEFAULT NULL,
  `total_disenio` int(11) DEFAULT NULL,
  `total_ejecucion` int(11) DEFAULT NULL,
  `total_calificacion` int(11) DEFAULT NULL,
  `niveles_disminuye` int(11) DEFAULT NULL,
  PRIMARY KEY (`k_id_calificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.calificacion: ~0 rows (aproximadamente)
DELETE FROM `calificacion`;
/*!40000 ALTER TABLE `calificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `calificacion` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.causa
DROP TABLE IF EXISTS `causa`;
CREATE TABLE IF NOT EXISTS `causa` (
  `k_id_causa` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_riesgo_especifico` int(11) DEFAULT NULL,
  `n_nombre` varchar(50) DEFAULT NULL,
  `n_state` varchar(50) NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`k_id_causa`),
  KEY `k_id_riesgo_especifico` (`k_id_riesgo_especifico`),
  CONSTRAINT `FK_causa_riesgo_especifico` FOREIGN KEY (`k_id_riesgo_especifico`) REFERENCES `riesgo_especifico` (`k_id_riesgo_especifico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.causa: ~0 rows (aproximadamente)
DELETE FROM `causa`;
/*!40000 ALTER TABLE `causa` DISABLE KEYS */;
/*!40000 ALTER TABLE `causa` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.control
DROP TABLE IF EXISTS `control`;
CREATE TABLE IF NOT EXISTS `control` (
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

-- Volcando datos para la tabla matriz_riesgo.control: ~0 rows (aproximadamente)
DELETE FROM `control`;
/*!40000 ALTER TABLE `control` DISABLE KEYS */;
/*!40000 ALTER TABLE `control` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.control_especifico
DROP TABLE IF EXISTS `control_especifico`;
CREATE TABLE IF NOT EXISTS `control_especifico` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.control_especifico: ~0 rows (aproximadamente)
DELETE FROM `control_especifico`;
/*!40000 ALTER TABLE `control_especifico` DISABLE KEYS */;
/*!40000 ALTER TABLE `control_especifico` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.factor_riesgo
DROP TABLE IF EXISTS `factor_riesgo`;
CREATE TABLE IF NOT EXISTS `factor_riesgo` (
  `k_id_factor_riesgo` int(11) NOT NULL AUTO_INCREMENT,
  `n_descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`k_id_factor_riesgo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.factor_riesgo: ~7 rows (aproximadamente)
DELETE FROM `factor_riesgo`;
/*!40000 ALTER TABLE `factor_riesgo` DISABLE KEYS */;
INSERT INTO `factor_riesgo` (`k_id_factor_riesgo`, `n_descripcion`) VALUES
	(1, 'Recurso Humano'),
	(2, 'Tecnológico'),
	(3, 'Infraestructura Física'),
	(4, 'Procesos'),
	(5, 'Información'),
	(6, 'Evento Externo - Condiciones Natural '),
	(7, 'Evento Externo - Terceros');
/*!40000 ALTER TABLE `factor_riesgo` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.impacto
DROP TABLE IF EXISTS `impacto`;
CREATE TABLE IF NOT EXISTS `impacto` (
  `k_id_impacto` int(11) NOT NULL AUTO_INCREMENT,
  `n_descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_impacto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.impacto: ~5 rows (aproximadamente)
DELETE FROM `impacto`;
/*!40000 ALTER TABLE `impacto` DISABLE KEYS */;
INSERT INTO `impacto` (`k_id_impacto`, `n_descripcion`) VALUES
	(1, 'Extremo'),
	(2, 'Alto'),
	(3, 'Significativo'),
	(4, 'Bajo'),
	(5, 'Insignificante');
/*!40000 ALTER TABLE `impacto` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.plataforma
DROP TABLE IF EXISTS `plataforma`;
CREATE TABLE IF NOT EXISTS `plataforma` (
  `k_id_plataforma` int(11) NOT NULL AUTO_INCREMENT,
  `n_nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_plataforma`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.plataforma: ~5 rows (aproximadamente)
DELETE FROM `plataforma`;
/*!40000 ALTER TABLE `plataforma` DISABLE KEYS */;
INSERT INTO `plataforma` (`k_id_plataforma`, `n_nombre`) VALUES
	(1, 'a'),
	(2, 'b'),
	(3, 'c'),
	(4, 'd'),
	(5, 'e');
/*!40000 ALTER TABLE `plataforma` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.probabilidad
DROP TABLE IF EXISTS `probabilidad`;
CREATE TABLE IF NOT EXISTS `probabilidad` (
  `k_id_probabilidad` int(11) NOT NULL AUTO_INCREMENT,
  `n_descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_probabilidad`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.probabilidad: ~5 rows (aproximadamente)
DELETE FROM `probabilidad`;
/*!40000 ALTER TABLE `probabilidad` DISABLE KEYS */;
INSERT INTO `probabilidad` (`k_id_probabilidad`, `n_descripcion`) VALUES
	(1, 'Alta'),
	(2, 'Frecuente'),
	(3, 'Probable'),
	(4, 'Ocasional'),
	(5, 'Inferior');
/*!40000 ALTER TABLE `probabilidad` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.ref_combox
DROP TABLE IF EXISTS `ref_combox`;
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
DELETE FROM `ref_combox`;
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

-- Volcando estructura para tabla matriz_riesgo.ref_probabilidad_impacto
DROP TABLE IF EXISTS `ref_probabilidad_impacto`;
CREATE TABLE IF NOT EXISTS `ref_probabilidad_impacto` (
  `k_⁯id_ref` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_probabilidad` int(11) DEFAULT '0',
  `k_id_impacto` int(11) DEFAULT '0',
  `n_calificacion` varchar(15) DEFAULT NULL,
  `n_color` varchar(7) NOT NULL DEFAULT '#FFFFFF',
  PRIMARY KEY (`k_⁯id_ref`),
  KEY `k_id_probabilidad` (`k_id_probabilidad`),
  KEY `k_id_impacto` (`k_id_impacto`),
  CONSTRAINT `FK__impacto` FOREIGN KEY (`k_id_impacto`) REFERENCES `impacto` (`k_id_impacto`),
  CONSTRAINT `FK__probabilidad` FOREIGN KEY (`k_id_probabilidad`) REFERENCES `probabilidad` (`k_id_probabilidad`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.ref_probabilidad_impacto: ~25 rows (aproximadamente)
DELETE FROM `ref_probabilidad_impacto`;
/*!40000 ALTER TABLE `ref_probabilidad_impacto` DISABLE KEYS */;
INSERT INTO `ref_probabilidad_impacto` (`k_⁯id_ref`, `k_id_probabilidad`, `k_id_impacto`, `n_calificacion`, `n_color`) VALUES
	(1, 5, 5, 'Bajo', '#FFFFFF'),
	(2, 5, 4, 'Bajo', '#FFFFFF'),
	(3, 5, 3, 'Moderado', '#FFFFFF'),
	(4, 5, 2, 'Alto', '#FFFFFF'),
	(5, 5, 1, 'Extremo', '#FFFFFF'),
	(6, 4, 5, 'Bajo', '#FFFFFF'),
	(7, 4, 4, 'Bajo', '#FFFFFF'),
	(8, 4, 3, 'Moderado', '#FFFFFF'),
	(9, 4, 2, 'Alto', '#FFFFFF'),
	(10, 4, 1, 'Extremo', '#FFFFFF'),
	(11, 3, 5, 'Bajo', '#FFFFFF'),
	(12, 3, 4, 'Moderado', '#FFFFFF'),
	(13, 3, 3, 'Moderado', '#FFFFFF'),
	(14, 3, 2, 'Alto', '#FFFFFF'),
	(15, 3, 1, 'Extremo', '#FFFFFF'),
	(16, 2, 5, 'Bajo', '#FFFFFF'),
	(17, 2, 4, 'Moderado', '#FFFFFF'),
	(18, 2, 3, 'Alto', '#FFFFFF'),
	(19, 2, 2, 'Alto', '#FFFFFF'),
	(20, 2, 1, 'Extremo', '#FFFFFF'),
	(21, 1, 5, 'Bajo', '#FFFFFF'),
	(22, 1, 4, 'Moderado', '#FFFFFF'),
	(23, 1, 3, 'Alto', '#FFFFFF'),
	(24, 1, 2, 'Extremo', '#FFFFFF'),
	(25, 1, 1, 'Extremo', '#FFFFFF');
/*!40000 ALTER TABLE `ref_probabilidad_impacto` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.riesgo
DROP TABLE IF EXISTS `riesgo`;
CREATE TABLE IF NOT EXISTS `riesgo` (
  `k_id_riesgo` varchar(50) NOT NULL,
  `n_riesgo` varchar(100) DEFAULT NULL,
  `n_riesgo_descripcion` varchar(250) DEFAULT NULL,
  `n_responsable` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_riesgo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.riesgo: ~5 rows (aproximadamente)
DELETE FROM `riesgo`;
/*!40000 ALTER TABLE `riesgo` DISABLE KEYS */;
INSERT INTO `riesgo` (`k_id_riesgo`, `n_riesgo`, `n_riesgo_descripcion`, `n_responsable`) VALUES
	('a', 'a', NULL, NULL),
	('b', 'b', NULL, NULL),
	('c', 'c', NULL, NULL),
	('d', 'd', NULL, NULL),
	('e', 'e', NULL, NULL);
/*!40000 ALTER TABLE `riesgo` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.riesgo_actividad
DROP TABLE IF EXISTS `riesgo_actividad`;
CREATE TABLE IF NOT EXISTS `riesgo_actividad` (
  `k_id_riesgo_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_riesgo` varchar(50) DEFAULT NULL,
  `k_id_actividad` int(11) DEFAULT NULL,
  PRIMARY KEY (`k_id_riesgo_actividad`),
  KEY `fk_fk_ra_actividad` (`k_id_actividad`),
  KEY `fk_fk_ra_riesgo` (`k_id_riesgo`),
  CONSTRAINT `fk_fk_ra_actividad` FOREIGN KEY (`k_id_actividad`) REFERENCES `actividad` (`k_id_actividad`),
  CONSTRAINT `fk_fk_ra_riesgo` FOREIGN KEY (`k_id_riesgo`) REFERENCES `riesgo` (`k_id_riesgo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.riesgo_actividad: ~0 rows (aproximadamente)
DELETE FROM `riesgo_actividad`;
/*!40000 ALTER TABLE `riesgo_actividad` DISABLE KEYS */;
/*!40000 ALTER TABLE `riesgo_actividad` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.riesgo_especifico
DROP TABLE IF EXISTS `riesgo_especifico`;
CREATE TABLE IF NOT EXISTS `riesgo_especifico` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.riesgo_especifico: ~0 rows (aproximadamente)
DELETE FROM `riesgo_especifico`;
/*!40000 ALTER TABLE `riesgo_especifico` DISABLE KEYS */;
/*!40000 ALTER TABLE `riesgo_especifico` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.soporte
DROP TABLE IF EXISTS `soporte`;
CREATE TABLE IF NOT EXISTS `soporte` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.soporte: ~0 rows (aproximadamente)
DELETE FROM `soporte`;
/*!40000 ALTER TABLE `soporte` DISABLE KEYS */;
/*!40000 ALTER TABLE `soporte` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.tipo_evento_1
DROP TABLE IF EXISTS `tipo_evento_1`;
CREATE TABLE IF NOT EXISTS `tipo_evento_1` (
  `k_id_tipo_evento_1` int(11) NOT NULL AUTO_INCREMENT,
  `n_descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_tipo_evento_1`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.tipo_evento_1: ~9 rows (aproximadamente)
DELETE FROM `tipo_evento_1`;
/*!40000 ALTER TABLE `tipo_evento_1` DISABLE KEYS */;
INSERT INTO `tipo_evento_1` (`k_id_tipo_evento_1`, `n_descripcion`) VALUES
	(1, '1. Fraude Interno'),
	(2, '2. Fraude Externo'),
	(3, '3. Relaciones Laborales'),
	(4, '5. Daños a activos físicos'),
	(5, '6. Fallas tecnológicas'),
	(6, '7. Ejecución y administración de procesos'),
	(7, '8. Lavado de Activos'),
	(8, '9. Reputacional'),
	(9, '10. Legal');
/*!40000 ALTER TABLE `tipo_evento_1` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.tipo_evento_2
DROP TABLE IF EXISTS `tipo_evento_2`;
CREATE TABLE IF NOT EXISTS `tipo_evento_2` (
  `k_id_tipo_evento_2` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_tipo_evento_1` int(11) DEFAULT NULL,
  `n_descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_tipo_evento_2`),
  KEY `fk_fk_te2_tipo_evento` (`k_id_tipo_evento_1`),
  CONSTRAINT `fk_fk_te2_tipo_evento` FOREIGN KEY (`k_id_tipo_evento_1`) REFERENCES `tipo_evento_1` (`k_id_tipo_evento_1`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.tipo_evento_2: ~22 rows (aproximadamente)
DELETE FROM `tipo_evento_2`;
/*!40000 ALTER TABLE `tipo_evento_2` DISABLE KEYS */;
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`, `k_id_tipo_evento_1`, `n_descripcion`) VALUES
	(1, 1, '1.1. Actividades no autorizadas'),
	(2, 1, '1.2. Hurto y Fraude'),
	(3, 2, '2.1. Hurto y Fraude'),
	(4, 2, '2.2. Vulnerabilidad  de los sistemas'),
	(5, 3, '3.1. Fallas en las Relaciones laborales'),
	(6, 3, '3.2. Fallas en la seguridad del entorno laboral'),
	(7, 3, '3.3. Discriminación'),
	(8, 4, '4.1. Administración indebida  de activos y revelac'),
	(9, 4, '4.2. Prácticas inapropiadas de negocios o de merca'),
	(10, 4, '4.3. Fallas en los productos'),
	(11, 4, '4.4. Fallas en la selección y gerenciamiento de lo'),
	(12, 4, '4.5. Fallas en la asesoría a los clientes'),
	(13, 5, '5.1. Desastres y otros eventos'),
	(14, 6, '6.1. Fallas en los Sistemas'),
	(15, 7, '7.1.1 Fallas en el diseño de los procesos. '),
	(16, 7, '7.1.2 Fallas en la ejecución de los procesos.   '),
	(17, 7, '7.1.3 Fallas en el mantenimiento de los procesos.'),
	(18, 7, '7.2. Inoportunidad o inexactitud en la generación '),
	(19, 7, '7.3. Ausencia de  documentación o documentación in'),
	(20, 7, '7.4. Inadecuada administración de las cuentas de c'),
	(21, 7, '7.5. Fallas de contrapartes comerciales'),
	(22, 7, '7.6. Fallas de Proveedores o Outsourcing');
/*!40000 ALTER TABLE `tipo_evento_2` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `k_id_usuarios` int(11) NOT NULL AUTO_INCREMENT,
  `n_nombre_usuario` varchar(150) DEFAULT NULL,
  `n_apellido_usuario` varchar(150) DEFAULT NULL,
  `n_username_usuario` varchar(100) DEFAULT NULL,
  `n_mail_usuario` varchar(100) DEFAULT NULL,
  `i_telefono_usuario` int(11) DEFAULT NULL,
  `i_celular_usuario` int(11) DEFAULT NULL,
  `n_password` varchar(30) DEFAULT NULL,
  `n_rol_ususario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`k_id_usuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.usuarios: ~0 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla matriz_riesgo.zona_geografica
DROP TABLE IF EXISTS `zona_geografica`;
CREATE TABLE IF NOT EXISTS `zona_geografica` (
  `k_id_zona_geografica` int(11) NOT NULL AUTO_INCREMENT,
  `n_nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_zona_geografica`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla matriz_riesgo.zona_geografica: ~0 rows (aproximadamente)
DELETE FROM `zona_geografica`;
/*!40000 ALTER TABLE `zona_geografica` DISABLE KEYS */;
/*!40000 ALTER TABLE `zona_geografica` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
