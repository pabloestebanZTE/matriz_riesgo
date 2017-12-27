use matriz_riesgo;

/*Table ref_combox */
INSERT INTO `ref_combox` (`k_id_combox`,`n_value`,`n_text`,`n_table`,`n_sql`,`d_created_at`) VALUES (1,'k_id_riesgo','n_riesgo','riesgo',NULL,'2017-12-19 11:09:40');
INSERT INTO `ref_combox` (`k_id_combox`,`n_value`,`n_text`,`n_table`,`n_sql`,`d_created_at`) VALUES (2,'k_id_factor_riesgo','n_descripcion','factor_riesgo',NULL,'2017-12-19 11:34:01');
INSERT INTO `ref_combox` (`k_id_combox`,`n_value`,`n_text`,`n_table`,`n_sql`,`d_created_at`) VALUES (3,'k_id_probabilidad','n_descripcion','probabilidad',NULL,'2017-12-19 11:42:14');
INSERT INTO `ref_combox` (`k_id_combox`,`n_value`,`n_text`,`n_table`,`n_sql`,`d_created_at`) VALUES (4,'k_id_impacto','n_descripcion','impacto',NULL,'2017-12-19 11:49:17');
INSERT INTO `ref_combox` (`k_id_combox`,`n_value`,`n_text`,`n_table`,`n_sql`,`d_created_at`) VALUES (5,'k_id_plataforma','n_nombre','plataforma',NULL,'2017-12-19 11:53:24');
INSERT INTO `ref_combox` (`k_id_combox`,`n_value`,`n_text`,`n_table`,`n_sql`,`d_created_at`) VALUES (6,'k_id_control','n_descripcion','control',NULL,'2017-12-19 12:07:00');
INSERT INTO `ref_combox` (`k_id_combox`,`n_value`,`n_text`,`n_table`,`n_sql`,`d_created_at`) VALUES (7,'k_id_tipo_evento_1','n_descripcion','tipo_evento_1',NULL,'2017-12-20 10:06:05');
INSERT INTO `ref_combox` (`k_id_combox`,`n_value`,`n_text`,`n_table`,`n_sql`,`d_created_at`) VALUES (8,'k_id_zona_geografica','n_nombre','zona_geografica',NULL,'2017-12-27 10:25:11');


/*Table tipo_evento_1 */
INSERT INTO `tipo_evento_1` (`k_id_tipo_evento_1`,`n_descripcion`) VALUES (1,'1. Fraude Interno');
INSERT INTO `tipo_evento_1` (`k_id_tipo_evento_1`,`n_descripcion`) VALUES (2,'2. Fraude Externo');
INSERT INTO `tipo_evento_1` (`k_id_tipo_evento_1`,`n_descripcion`) VALUES (3,'3. Relaciones Laborales');
INSERT INTO `tipo_evento_1` (`k_id_tipo_evento_1`,`n_descripcion`) VALUES (4,'4. Clientes');
INSERT INTO `tipo_evento_1` (`k_id_tipo_evento_1`,`n_descripcion`) VALUES (5,'5. Daños a activos físicos');
INSERT INTO `tipo_evento_1` (`k_id_tipo_evento_1`,`n_descripcion`) VALUES (6,'6. Fallas tecnológicas');
INSERT INTO `tipo_evento_1` (`k_id_tipo_evento_1`,`n_descripcion`) VALUES (7,'7. Ejecución y administración de procesos');
INSERT INTO `tipo_evento_1` (`k_id_tipo_evento_1`,`n_descripcion`) VALUES (8,'8. Lavado de Activos');
INSERT INTO `tipo_evento_1` (`k_id_tipo_evento_1`,`n_descripcion`) VALUES (9,'9. Reputacional');
INSERT INTO `tipo_evento_1` (`k_id_tipo_evento_1`,`n_descripcion`) VALUES (10,'10. Legal');


/*Table tipo_evento_2 */
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (1,1,'1.1. Actividades no autorizadas');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (2,1,'1.2. Hurto y Fraude');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (3,2,'2.1. Hurto y Fraude');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (4,2,'2.2. Vulnerabilidad  de los sistemas');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (5,3,'3.1. Fallas en las Relaciones laborales');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (6,3,'3.2. Fallas en la seguridad del entorno laboral');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (7,3,'3.3. Discriminación');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (8,4,'4.1. Administración indebida  de activos y revelac');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (9,4,'4.2. Prácticas inapropiadas de negocios o de merca');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (10,4,'4.3. Fallas en los productos');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (11,4,'4.4. Fallas en la selección y gerenciamiento de lo');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (12,4,'4.5. Fallas en la asesoría a los clientes');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (13,5,'5.1. Desastres y otros eventos');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (14,6,'6.1. Fallas en los Sistemas');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (15,7,'7.1.1 Fallas en el diseño de los procesos. ');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (16,7,'7.1.2 Fallas en la ejecución de los procesos.   ');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (17,7,'7.1.3 Fallas en el mantenimiento de los procesos.');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (18,7,'7.2. Inoportunidad o inexactitud en la generación ');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (19,7,'7.3. Ausencia de  documentación o documentación in');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (20,7,'7.4. Inadecuada administración de las cuentas de c');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (21,7,'7.5. Fallas de contrapartes comerciales');
INSERT INTO `tipo_evento_2` (`k_id_tipo_evento_2`,`k_id_tipo_evento_1`,`n_descripcion`) VALUES (22,7,'7.6. Fallas de Proveedores o Outsourcing');

/*Table factor_riesgo */
INSERT INTO `factor_riesgo` (`k_id_factor_riesgo`,`n_descripcion`) VALUES (1,'Recurso Humano');
INSERT INTO `factor_riesgo` (`k_id_factor_riesgo`,`n_descripcion`) VALUES (2,'Tecnológico');
INSERT INTO `factor_riesgo` (`k_id_factor_riesgo`,`n_descripcion`) VALUES (3,'Infraestructura Física');
INSERT INTO `factor_riesgo` (`k_id_factor_riesgo`,`n_descripcion`) VALUES (4,'Procesos');
INSERT INTO `factor_riesgo` (`k_id_factor_riesgo`,`n_descripcion`) VALUES (5,'Información');
INSERT INTO `factor_riesgo` (`k_id_factor_riesgo`,`n_descripcion`) VALUES (6,'Evento Externo - Condiciones Natural ');
INSERT INTO `factor_riesgo` (`k_id_factor_riesgo`,`n_descripcion`) VALUES (7,'Evento Externo - Terceros');

/*Table probabilidad */
INSERT INTO `probabilidad` (`k_id_probabilidad`,`n_descripcion`) VALUES (1,'Alta');
INSERT INTO `probabilidad` (`k_id_probabilidad`,`n_descripcion`) VALUES (2,'Frecuente');
INSERT INTO `probabilidad` (`k_id_probabilidad`,`n_descripcion`) VALUES (3,'Probable');
INSERT INTO `probabilidad` (`k_id_probabilidad`,`n_descripcion`) VALUES (4,'Ocasional');
INSERT INTO `probabilidad` (`k_id_probabilidad`,`n_descripcion`) VALUES (5,'Inferior');

/*Table impacto */
INSERT INTO `impacto` (`k_id_impacto`,`n_descripcion`) VALUES (1,'Extremo');
INSERT INTO `impacto` (`k_id_impacto`,`n_descripcion`) VALUES (2,'Alto');
INSERT INTO `impacto` (`k_id_impacto`,`n_descripcion`) VALUES (3,'Significativo');
INSERT INTO `impacto` (`k_id_impacto`,`n_descripcion`) VALUES (4,'Bajo');
INSERT INTO `impacto` (`k_id_impacto`,`n_descripcion`) VALUES (5,'Insignificante');

/*Table ref_probabilidad_impacto */
INSERT INTO `ref_probabilidad_impacto` (`k_⁯id_ref`, `k_id_probabilidad`, `k_id_impacto`, `n_calificacion`, `n_color`, `n_text_color`) VALUES
	(1, 5, 5, 'Bajo', '#ADFF2F', '#000000'),
	(2, 5, 4, 'Bajo', '#ADFF2F', '#000000'),
	(3, 5, 3, 'Moderado', '#0000FF', '#FFFFFF'),
	(4, 5, 2, 'Alto', '#FFFF00', '#000000'),
	(5, 5, 1, 'Extremo', '#FF0000', '#FFFFFF'),
	(6, 4, 5, 'Bajo', '#ADFF2F', '#000000'),
	(7, 4, 4, 'Bajo', '#ADFF2F', '#000000'),
	(8, 4, 3, 'Moderado', '#0000FF', '#FFFFFF'),
	(9, 4, 2, 'Alto', '#FFFF00', '#000000'),
	(10, 4, 1, 'Extremo', '#FF0000', '#FFFFFF'),
	(11, 3, 5, 'Bajo', '#ADFF2F', '#000000'),
	(12, 3, 4, 'Moderado', '#0000FF', '#FFFFFF'),
	(13, 3, 3, 'Moderado', '#0000FF', '#FFFFFF'),
	(14, 3, 2, 'Alto', '#FFFF00', '#000000'),
	(15, 3, 1, 'Extremo', '#FF0000', '#FFFFFF'),
	(16, 2, 5, 'Bajo', '#ADFF2F', '#000000'),
	(17, 2, 4, 'Moderado', '#0000FF', '#FFFFFF'),
	(18, 2, 3, 'Alto', '#FFFF00', '#000000'),
	(19, 2, 2, 'Alto', '#FFFF00', '#000000'),
	(20, 2, 1, 'Extremo', '#FF0000', '#FFFFFF'),
	(21, 1, 5, 'Bajo', '#ADFF2F', '#000000'),
	(22, 1, 4, 'Moderado', '#0000FF', '#FFFFFF'),
	(23, 1, 3, 'Alto', '#FFFF00', '#000000'),
	(24, 1, 2, 'Extremo', '#FF0000', '#FFFFFF'),
	(25, 1, 1, 'Extremo', '#FF0000', '#FFFFFF');

