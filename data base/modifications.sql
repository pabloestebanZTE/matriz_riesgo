-- 18 de diciembre 2017
ALTER TABLE `matriz_riesgo`.`control` 
CHANGE COLUMN `k_id_control` `k_id_control` INT(11) NOT NULL AUTO_INCREMENT ,
DROP INDEX `k_id_control_UNIQUE` ;

ALTER TABLE `matriz_riesgo`.`riesgo` 
ADD COLUMN `n_responsable` VARCHAR(50) NULL AFTER `n_riesgo_descripcion`;

