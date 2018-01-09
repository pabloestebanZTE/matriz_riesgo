-- Martes, 9 de Enero 2018.
ALTER TABLE `riesgo_especifico`
	CHANGE COLUMN `n_tipo_activad` `n_tipo_activad` VARCHAR(500) NULL DEFAULT NULL AFTER `n_objetivo`;
