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

-- La exportación de datos fue deseleccionada.
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

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla matriz_riesgo.causa
DROP TABLE IF EXISTS `causa`;
CREATE TABLE IF NOT EXISTS `causa` (
  `k_id_causa` int(11) NOT NULL AUTO_INCREMENT,
  `n_nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_causa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
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

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla matriz_riesgo.control_especifico
DROP TABLE IF EXISTS `control_especifico`;
CREATE TABLE IF NOT EXISTS `control_especifico` (
  `k_id_control_especifico` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_riesgo_especifico` int(11) DEFAULT NULL,
  `k_id_control` varchar(50) DEFAULT NULL,
  `k_id_causa` int(11) DEFAULT NULL,
  `k_id_factor_riesgo` int(11) DEFAULT NULL,
  `k_id_calificacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`k_id_control_especifico`),
  KEY `fk_fk_ce_calificacion` (`k_id_calificacion`),
  KEY `fk_fk_ce_causa` (`k_id_causa`),
  KEY `fk_fk_ce_control` (`k_id_control`),
  KEY `fk_fk_ce_factor_riesgo` (`k_id_factor_riesgo`),
  KEY `fk_fk_ce_riesgo_especifico` (`k_id_riesgo_especifico`),
  CONSTRAINT `fk_fk_ce_calificacion` FOREIGN KEY (`k_id_calificacion`) REFERENCES `calificacion` (`k_id_calificacion`),
  CONSTRAINT `fk_fk_ce_causa` FOREIGN KEY (`k_id_causa`) REFERENCES `causa` (`k_id_causa`),
  CONSTRAINT `fk_fk_ce_control` FOREIGN KEY (`k_id_control`) REFERENCES `control` (`k_id_control`),
  CONSTRAINT `fk_fk_ce_factor_riesgo` FOREIGN KEY (`k_id_factor_riesgo`) REFERENCES `factor_riesgo` (`k_id_factor_riesgo`),
  CONSTRAINT `fk_fk_ce_riesgo_especifico` FOREIGN KEY (`k_id_riesgo_especifico`) REFERENCES `riesgo_especifico` (`k_id_riesgo_especifico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla matriz_riesgo.factor_riesgo
DROP TABLE IF EXISTS `factor_riesgo`;
CREATE TABLE IF NOT EXISTS `factor_riesgo` (
  `k_id_factor_riesgo` int(11) NOT NULL AUTO_INCREMENT,
  `n_descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`k_id_factor_riesgo`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla matriz_riesgo.impacto
DROP TABLE IF EXISTS `impacto`;
CREATE TABLE IF NOT EXISTS `impacto` (
  `k_id_impacto` int(11) NOT NULL AUTO_INCREMENT,
  `n_descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_impacto`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla matriz_riesgo.plataforma
DROP TABLE IF EXISTS `plataforma`;
CREATE TABLE IF NOT EXISTS `plataforma` (
  `k_id_plataforma` int(11) NOT NULL AUTO_INCREMENT,
  `n_nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_plataforma`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla matriz_riesgo.probabilidad
DROP TABLE IF EXISTS `probabilidad`;
CREATE TABLE IF NOT EXISTS `probabilidad` (
  `k_id_probabilidad` int(11) NOT NULL AUTO_INCREMENT,
  `n_descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_probabilidad`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla matriz_riesgo.riesgo
DROP TABLE IF EXISTS `riesgo`;
CREATE TABLE IF NOT EXISTS `riesgo` (
  `k_id_riesgo` varchar(50) NOT NULL,
  `n_riesgo` varchar(100) DEFAULT NULL,
  `n_riesgo_descripcion` varchar(250) DEFAULT NULL,
  `n_responsable` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_riesgo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
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

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla matriz_riesgo.riesgo_especifico
DROP TABLE IF EXISTS `riesgo_especifico`;
CREATE TABLE IF NOT EXISTS `riesgo_especifico` (
  `k_id_riesgo_especifico` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_plataforma` int(11) DEFAULT NULL,
  `k_id_riesgo` varchar(50) DEFAULT NULL,
  `k_id_zona_geografica` int(11) DEFAULT NULL,
  `k_id_tipo_evento_2` int(11) DEFAULT NULL,
  `k_id_soporte` int(11) DEFAULT NULL,
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
  KEY `fk_re_re_soporte` (`k_id_soporte`),
  CONSTRAINT `fk_fk_re_plataforma` FOREIGN KEY (`k_id_plataforma`) REFERENCES `plataforma` (`k_id_plataforma`),
  CONSTRAINT `fk_fk_re_riesgo` FOREIGN KEY (`k_id_riesgo`) REFERENCES `riesgo` (`k_id_riesgo`),
  CONSTRAINT `fk_fk_re_tipo_evento` FOREIGN KEY (`k_id_tipo_evento_2`) REFERENCES `tipo_evento_2` (`k_id_tipo_evento_2`),
  CONSTRAINT `fk_fk_re_zona_geografica` FOREIGN KEY (`k_id_zona_geografica`) REFERENCES `zona_geografica` (`k_id_zona_geografica`),
  CONSTRAINT `fk_re_re_soporte` FOREIGN KEY (`k_id_soporte`) REFERENCES `soporte` (`k_id_soporte`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla matriz_riesgo.soporte
DROP TABLE IF EXISTS `soporte`;
CREATE TABLE IF NOT EXISTS `soporte` (
  `k_id_soporte` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_probabilidad` int(11) DEFAULT NULL,
  `k_id_impacto` int(11) DEFAULT NULL,
  `k_tipo` int(11) DEFAULT NULL,
  `n_nombre` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`k_id_soporte`),
  KEY `fk_fk_so_impacto` (`k_id_impacto`),
  KEY `fk_fk_so_probabilidad` (`k_id_probabilidad`),
  CONSTRAINT `fk_fk_so_impacto` FOREIGN KEY (`k_id_impacto`) REFERENCES `impacto` (`k_id_impacto`),
  CONSTRAINT `fk_fk_so_probabilidad` FOREIGN KEY (`k_id_probabilidad`) REFERENCES `probabilidad` (`k_id_probabilidad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla matriz_riesgo.tipo_evento_1
DROP TABLE IF EXISTS `tipo_evento_1`;
CREATE TABLE IF NOT EXISTS `tipo_evento_1` (
  `k_id_tipo_evento_1` int(11) NOT NULL AUTO_INCREMENT,
  `n_descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_tipo_evento_1`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla matriz_riesgo.tipo_evento_2
DROP TABLE IF EXISTS `tipo_evento_2`;
CREATE TABLE IF NOT EXISTS `tipo_evento_2` (
  `k_id_tipo_evento_2` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_tipo_evento_1` int(11) DEFAULT NULL,
  `n_descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_tipo_evento_2`),
  KEY `fk_fk_te2_tipo_evento` (`k_id_tipo_evento_1`),
  CONSTRAINT `fk_fk_te2_tipo_evento` FOREIGN KEY (`k_id_tipo_evento_1`) REFERENCES `tipo_evento_1` (`k_id_tipo_evento_1`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla matriz_riesgo.zona_geografica
DROP TABLE IF EXISTS `zona_geografica`;
CREATE TABLE IF NOT EXISTS `zona_geografica` (
  `k_id_zona_geografica` int(11) NOT NULL AUTO_INCREMENT,
  `n_nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`k_id_zona_geografica`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
