-- Martes, 9 de Enero 2018.
ALTER TABLE `riesgo_especifico`
	CHANGE COLUMN `n_tipo_activad` `n_tipo_activad` VARCHAR(500) NULL DEFAULT NULL AFTER `n_objetivo`;

ALTER TABLE `riesgo`
	ADD COLUMN `k_id_plataforma` INT NULL AFTER `k_id_riesgo`,
	ADD INDEX `k_id_plataforma` (`k_id_plataforma`),
	ADD CONSTRAINT `FK_riesgo_plataforma` FOREIGN KEY (`k_id_plataforma`) REFERENCES `plataforma` (`k_id_plataforma`);

ALTER TABLE `control`
	ADD COLUMN `k_id_plataforma` INT NULL AFTER `k_id_control`,
	ADD INDEX `k_id_plataforma` (`k_id_plataforma`),
	ADD CONSTRAINT `FK_control_plataforma` FOREIGN KEY (`k_id_plataforma`) REFERENCES `plataforma` (`k_id_plataforma`);

ALTER TABLE `riesgo`
	ADD COLUMN `nombre_riesgo` VARCHAR(50) NULL DEFAULT NULL AFTER `k_id_riesgo`;

ALTER TABLE `control`
	ADD COLUMN `nombre_control` VARCHAR(50) NULL DEFAULT NULL AFTER `k_id_control`;
