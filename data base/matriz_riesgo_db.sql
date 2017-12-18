create database matriz_riesgo;
use matriz_riesgo;


/*==============================================================*/
/* dbms name:      mysql 5.0                                    */
/* created on:     12/12/2017 8:47:40 a. m.                     */
/*==============================================================*/


drop table if exists actividad;

drop table if exists calificacion;

drop table if exists causa;

drop table if exists control;

drop table if exists control_especifico;

drop table if exists factor_riesgo;

drop table if exists impacto;

drop table if exists plataforma;

drop table if exists probabilidad;

drop table if exists riesgo;

drop table if exists riesgo_actividad;

drop table if exists riesgo_especifico;

drop table if exists soporte;

drop table if exists tipo_evento_1;

drop table if exists tipo_evento_2;

drop table if exists usuarios;

drop table if exists zona_geografica;

/*==============================================================*/
/* table: actividad                                             */
/*==============================================================*/
create table actividad
(
   k_id_actividad       int(11) not null auto_increment,
   n_nombre             varchar(50) default null,
   primary key (k_id_actividad)
);

/*==============================================================*/
/* table: calificacion                                          */
/*==============================================================*/
create table calificacion
(
   k_id_calificacion    int(11) not null auto_increment,
   n_pd1                int(11) default null,
   n_pd2                int(11) default null,
   n_pd3                int(11) default null,
   n_pd4                int(11) default null,
   n_pd5                int(11) default null,
   n_pe1                int(11) default null,
   n_pe2                int(11) default null,
   n_pe3                int(11) default null,
   n_pe4                int(11) default null,
   total_disenio        int(11) default null,
   total_ejecucion      int(11) default null,
   total_calificacion   int(11) default null,
   niveles_disminuye    int(11) default null,
   primary key (k_id_calificacion)
);

/*==============================================================*/
/* table: causa                                                 */
/*==============================================================*/
create table causa
(
   k_id_causa           int(11) not null auto_increment,
   n_nombre             varchar(50) default null,
   primary key (k_id_causa)
);

/*==============================================================*/
/* table: control                                               */
/*==============================================================*/
create table control
(
   k_id_control         int(11) not null,
   n_descripcion        varchar(250) default null,
   n_asignacion         varchar(50) default null,
   n_cargo              varchar(50) default null,
   n_tipo               varchar(50) default null,
   n_funcionalidad_tipo varchar(50) default null,
   n_naturaleza_control varchar(50) default null,
   n_periodicidad       varchar(50) default null,
   n_funcionalidad_frecuencia varchar(50) default null,
   n_documentacion      varchar(50) default null,
   n_actividades        varchar(50) default null,
   n_ejecucion          varchar(50) default null,
   n_importancia        varchar(50) default null,
   n_disminuye_probabilidad varchar(50) default null,
   n_disminuye_impacto  varchar(50) default null,
   n_riesgo_residual    varchar(50) default null,
   primary key (k_id_control)
);

/*==============================================================*/
/* table: control_especifico                                    */
/*==============================================================*/
create table control_especifico
(
   k_id_control_especifico int(11) not null auto_increment,
   k_id_riesgo_especifico int(11) default null,
   k_id_control         int(11) default null,
   k_id_causa           int(11) default null,
   k_id_factor_riesgo   int(11) default null,
   k_id_calificacion    int(11) default null,
   primary key (k_id_control_especifico)
);

/*==============================================================*/
/* table: factor_riesgo                                         */
/*==============================================================*/
create table factor_riesgo
(
   k_id_factor_riesgo   int(11) not null auto_increment,
   n_descripcion        varchar(100) default null,
   primary key (k_id_factor_riesgo)
);

/*==============================================================*/
/* table: impacto                                               */
/*==============================================================*/
create table impacto
(
   k_id_impacto         int(11) not null auto_increment,
   n_descripcion        varchar(50) default null,
   primary key (k_id_impacto)
);

/*==============================================================*/
/* table: plataforma                                            */
/*==============================================================*/
create table plataforma
(
   k_id_plataforma      int(11) not null auto_increment,
   n_nombre             varchar(50) default null,
   primary key (k_id_plataforma)
);

/*==============================================================*/
/* table: probabilidad                                          */
/*==============================================================*/
create table probabilidad
(
   k_id_probabilidad    int(11) not null auto_increment,
   n_descripcion        varchar(50) default null,
   primary key (k_id_probabilidad)
);

/*==============================================================*/
/* table: riesgo                                                */
/*==============================================================*/
create table riesgo
(
   k_id_riesgo          int(11) not null,
   n_riesgo             varchar(100) default null,
   n_riesgo_descripcion varchar(250) default null,
   primary key (k_id_riesgo)
);

/*==============================================================*/
/* table: riesgo_actividad                                      */
/*==============================================================*/
create table riesgo_actividad
(
   k_id_riesgo_actividad int(11) not null auto_increment,
   k_id_riesgo          int(11) default null,
   k_id_actividad       int(11) default null,
   primary key (k_id_riesgo_actividad)
);

/*==============================================================*/
/* table: riesgo_especifico                                     */
/*==============================================================*/
create table riesgo_especifico
(
   k_id_riesgo_especifico int(11) not null auto_increment,
   k_id_plataforma      int(11)  default null,
   k_id_riesgo          int(11) default null,
   k_id_zona_geografica int(11) default null,
   k_id_tipo_evento_2   int(11) default null,
   k_id_soporte         int(11) default null,
   n_macro_proceso      varchar(50) default null,
   n_proceso            varchar(50) default null,
   n_servicio           varchar(50) default null,
   n_responsable        varchar(50) default null,
   n_probabilidad       varchar(50) default null,
   n_impacto            varchar(50) default null,
   primary key (k_id_riesgo_especifico)
);

/*==============================================================*/
/* table: soporte                                               */
/*==============================================================*/
create table soporte
(
   k_id_soporte         int(11) not null auto_increment,
   k_id_probabilidad    int(11) default null,
   k_id_impacto         int(11) default null,
   k_tipo               int(11) default null,
   primary key (k_id_soporte)
);

/*==============================================================*/
/* table: tipo_evento_1                                         */
/*==============================================================*/
create table tipo_evento_1
(
   k_id_tipo_evento_1   int(11) not null auto_increment,
   n_descripcion        varchar(50) default null,
   primary key (k_id_tipo_evento_1)
);

/*==============================================================*/
/* table: tipo_evento_2                                         */
/*==============================================================*/
create table tipo_evento_2
(
   k_id_tipo_evento_2   int(11) not null auto_increment,
   k_id_tipo_evento_1   int(11) default null,
   n_descripcion        varchar(50) default null,
   primary key (k_id_tipo_evento_2)
);

/*==============================================================*/
/* table: usuarios                                              */
/*==============================================================*/
create table usuarios
(
   k_id_usuarios        int(11) not null auto_increment,
   n_nombre_usuario     varchar(150) default null,
   n_apellido_usuario   varchar(150) default null,
   n_username_usuario   varchar(100) default null,
   n_mail_usuario       varchar(100) default null,
   i_telefono_usuario   int(11) default null,
   i_celular_usuario    int(11) default null,
   n_password           varchar(30) default null,
   n_rol_ususario       varchar(100) default null,
   primary key (k_id_usuarios)
);

/*==============================================================*/
/* table: zona_geografica                                       */
/*==============================================================*/
create table zona_geografica
(
   k_id_zona_geografica int not null auto_increment,
   n_nombre             varchar(50) default null,
   primary key (k_id_zona_geografica)
);

alter table control_especifico add constraint fk_fk_ce_calificacion foreign key (k_id_calificacion)
      references calificacion (k_id_calificacion) on delete restrict on update restrict;

alter table control_especifico add constraint fk_fk_ce_causa foreign key (k_id_causa)
      references causa (k_id_causa) on delete restrict on update restrict;

alter table control_especifico add constraint fk_fk_ce_control foreign key (k_id_control)
      references control (k_id_control) on delete restrict on update restrict;

alter table control_especifico add constraint fk_fk_ce_factor_riesgo foreign key (k_id_factor_riesgo)
      references factor_riesgo (k_id_factor_riesgo) on delete restrict on update restrict;

alter table control_especifico add constraint fk_fk_ce_riesgo_especifico foreign key (k_id_riesgo_especifico)
      references riesgo_especifico (k_id_riesgo_especifico) on delete restrict on update restrict;

alter table riesgo_actividad add constraint fk_fk_ra_actividad foreign key (k_id_actividad)
      references actividad (k_id_actividad) on delete restrict on update restrict;

alter table riesgo_actividad add constraint fk_fk_ra_riesgo foreign key (k_id_riesgo)
      references riesgo (k_id_riesgo) on delete restrict on update restrict;

alter table riesgo_especifico add constraint fk_fk_re_plataforma foreign key (k_id_plataforma)
      references plataforma (k_id_plataforma) on delete restrict on update restrict;

alter table riesgo_especifico add constraint fk_fk_re_riesgo foreign key (k_id_riesgo)
      references riesgo (k_id_riesgo) on delete restrict on update restrict;

alter table riesgo_especifico add constraint fk_fk_re_tipo_evento foreign key (k_id_tipo_evento_2)
      references tipo_evento_2 (k_id_tipo_evento_2) on delete restrict on update restrict;

alter table riesgo_especifico add constraint fk_fk_re_zona_geografica foreign key (k_id_zona_geografica)
      references zona_geografica (k_id_zona_geografica) on delete restrict on update restrict;

alter table riesgo_especifico add constraint fk_re_re_soporte foreign key (k_id_soporte)
      references soporte (k_id_soporte) on delete restrict on update restrict;

alter table soporte add constraint fk_fk_so_impacto foreign key (k_id_impacto)
      references impacto (k_id_impacto) on delete restrict on update restrict;

alter table soporte add constraint fk_fk_so_probabilidad foreign key (k_id_probabilidad)
      references probabilidad (k_id_probabilidad) on delete restrict on update restrict;

alter table tipo_evento_2 add constraint fk_fk_te2_tipo_evento foreign key (k_id_tipo_evento_1)
      references tipo_evento_1 (k_id_tipo_evento_1) on delete restrict on update restrict;

