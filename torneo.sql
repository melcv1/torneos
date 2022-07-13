/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     12/7/2022 11:30:15                           */
/*==============================================================*/


drop table if exists ENCUESTA;

drop table if exists EQUIPO;

drop table if exists EQUIPOTORNEO;

drop table if exists PARTICIPANTE;

drop table if exists PARTIDOS;

drop table if exists TORNEO;

drop table if exists USUARIO;

/*==============================================================*/
/* Table: ENCUESTA                                              */
/*==============================================================*/
create table ENCUESTA
(
   ID_ENCUESTA          int not null auto_increment,
   ID_PARTICIPANTE      int,
   GRUPO                varchar(1),
   EQUIPO               varchar(256),
   POSICION             varchar(256),
   NUMERACION           varchar(4),
   primary key (ID_ENCUESTA)
);

/*==============================================================*/
/* Table: EQUIPO                                                */
/*==============================================================*/
create table EQUIPO
(
   ID_EQUIPO            int not null auto_increment,
   NOM_EQUIPO_CORTO     varchar(256),
   NOM_EQUIPO_LARGO     varchar(256),
   PAIS_EQUIPO          varchar(256),
   REGION_EQUIPO        varchar(256),
   DETALLE_EQUIPO       text,
   ESCUDO_EQUIPO        longblob,
   NOM_ESTADIO          varchar(256),
   primary key (ID_EQUIPO)
);

/*==============================================================*/
/* Table: EQUIPOTORNEO                                          */
/*==============================================================*/
create table EQUIPOTORNEO
(
   ID_EQUIPO_TORNEO     int not null auto_increment,
   ID_TORNEO            int,
   ID_EQUIPO            int,
   PARTIDOS_JUGADOS     int,
   PARTIDOS_GANADOS     int,
   PARTIDOS_EMPATADOS   int,
   PARTIDOS_PERDIDOS    int,
   GF                   int,
   GC                   int,
   GD                   int,
   GRUPO                varchar(256),
   POSICION_EQUIPO_TORENO varchar(256),
   primary key (ID_EQUIPO_TORNEO)
);

/*==============================================================*/
/* Table: PARTICIPANTE                                          */
/*==============================================================*/
create table PARTICIPANTE
(
   ID_PARTICIPANTE      int not null auto_increment,
   NOMBRE               varchar(256),
   APELLIDO             varchar(256),
   FECHA_NACIMIENTO     varchar(256),
   CEDULA               varchar(10),
   EMAIL                varchar(256),
   TELEFONO             varchar(10),
   CREACION             varchar(256),
   ACTUALIZACION        varchar(256),
   primary key (ID_PARTICIPANTE)
);

/*==============================================================*/
/* Table: PARTIDOS                                              */
/*==============================================================*/
create table PARTIDOS
(
   ID_EQUIPO2           int,
   ID_EQUIPO1           int,
   ID_PARTIDO           int not null auto_increment,
   ID_TORNEO            int,
   FECHA_PARTIDO        varchar(256),
   HORA_PARTIDO         varchar(256),
   DIA_PARTIDO          varchar(256),
   ESTADIO              varchar(256),
   CIUDAD_PARTIDO       varchar(256),
   PAIS_PARTIDO         varchar(256),
   GOLES_EQUIPO1        int,
   GOLES_EQUIPO2        int,
   GOLES_EXTRA_EQUIPO1  int,
   GOLES_EXTRA_EQUIPO2  int,
   NOTA_PARTIDO         text,
   RESUMEN_PARTIDO      text,
   ESTADO_PARTIDO       varchar(256),
   primary key (ID_PARTIDO)
);

/*==============================================================*/
/* Table: TORNEO                                                */
/*==============================================================*/
create table TORNEO
(
   ID_TORNEO            int not null auto_increment,
   NOM_TORNEO_CORTO     varchar(256),
   NOM_TORNEO_LARGO     varchar(256),
   PAIS_TORNEO          varchar(256),
   REGION_TORNEO        varchar(256),
   DETALLE_TORNEO       text,
   LOGO_TORNEO          longblob,
   primary key (ID_TORNEO)
);

/*==============================================================*/
/* Table: USUARIO                                               */
/*==============================================================*/
create table USUARIO
(
   ID_USUARIO           int not null auto_increment,
   USER                 varchar(256),
   CONTRASENA           varchar(1024),
   primary key (ID_USUARIO)
);

alter table ENCUESTA add constraint FK_RELATIONSHIP_4 foreign key (ID_PARTICIPANTE)
      references PARTICIPANTE (ID_PARTICIPANTE) on delete restrict on update restrict;

alter table EQUIPOTORNEO add constraint FK_RELATIONSHIP_1 foreign key (ID_TORNEO)
      references TORNEO (ID_TORNEO) on delete restrict on update restrict;

alter table EQUIPOTORNEO add constraint FK_RELATIONSHIP_2 foreign key (ID_EQUIPO)
      references EQUIPO (ID_EQUIPO) on delete restrict on update restrict;

alter table PARTIDOS add constraint FK_RELATIONSHIP_3 foreign key (ID_TORNEO)
      references TORNEO (ID_TORNEO) on delete restrict on update restrict;

