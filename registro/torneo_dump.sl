-- MySQL dump 10.19  Distrib 10.3.32-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: torneo
-- ------------------------------------------------------
-- Server version	10.3.32-MariaDB-1:10.3.32+maria~bionic

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `audittrail`
--

DROP TABLE IF EXISTS `audittrail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audittrail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `script` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `keyvalue` longtext DEFAULT NULL,
  `oldvalue` longtext DEFAULT NULL,
  `newvalue` longtext DEFAULT NULL,
  `PRUE` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audittrail`
--

LOCK TABLES `audittrail` WRITE;
/*!40000 ALTER TABLE `audittrail` DISABLE KEYS */;
/*!40000 ALTER TABLE `audittrail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipo`
--

DROP TABLE IF EXISTS `equipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipo` (
  `ID_EQUIPO` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_EQUIPO_CORTO` varchar(256) DEFAULT NULL,
  `NOM_EQUIPO_LARGO` varchar(256) DEFAULT NULL,
  `PAIS_EQUIPO` varchar(256) DEFAULT NULL,
  `REGION_EQUIPO` varchar(256) DEFAULT NULL,
  `DETALLE_EQUIPO` text DEFAULT NULL,
  `ESCUDO_EQUIPO` varchar(1024) DEFAULT NULL,
  `NOM_ESTADIO` int(11) DEFAULT NULL,
  `crea_dato` datetime NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_dato` varchar(256) NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`ID_EQUIPO`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipo`
--

LOCK TABLES `equipo` WRITE;
/*!40000 ALTER TABLE `equipo` DISABLE KEYS */;
INSERT INTO `equipo` VALUES (48,'CAT','CATAR','QATAR','ASIA',NULL,'CAT.png',NULL,'2022-08-01 19:59:48','2022-08-04 13:59:22','admin'),(49,'ECU','ECUADOR','ECUADOR','SUDAMERICA',NULL,'ECU.png',NULL,'2022-08-01 20:00:15','2022-08-01 20:00:15','admin'),(50,'SEN','SENEGAL','SENEGAL','AFRICA',NULL,'SEN.png',NULL,'2022-08-01 20:00:37','2022-08-01 20:00:37','admin'),(51,'HOL','HOLANDA','HOLANDA','EUROPA',NULL,'HOL.png',NULL,'2022-08-01 20:01:00','2022-08-01 20:01:38','admin'),(52,'ING','INGLATERRA','INGLATERRA','EUROPA',NULL,'ING.png',NULL,'2022-08-01 20:01:27','2022-08-01 20:01:27','admin'),(53,'IRN','IRÁN','IRÁN','ASIA',NULL,'IRN.png',NULL,'2022-08-01 20:02:04','2022-08-01 20:02:04','admin'),(54,'USA','EE.UU','EE.UU','NORTEAMERICA',NULL,'USA.png',NULL,'2022-08-01 20:02:27','2022-08-01 20:02:27','admin'),(55,'GAL','GALES','GALES','EUROPA',NULL,'GAL.png',NULL,'2022-08-01 20:02:48','2022-08-01 20:02:48','admin'),(56,'ARG','ARGENTINA','ARGENTINA','SUDAMERICA',NULL,'ARG.png',NULL,'2022-08-01 20:03:09','2022-08-01 20:03:09','admin'),(57,'ARA','A. SAUDITA','A. SAUDITA','ASIA',NULL,'ARA.png',NULL,'2022-08-01 20:03:27','2022-08-01 20:03:27','admin'),(58,'MEX','MÉXICO','MÉXICO','NORTEAMERICA',NULL,'MEX.png',NULL,'2022-08-01 20:03:53','2022-08-01 20:03:53','admin'),(59,'POL','POLONIA','POLONIA','EUROPA',NULL,'POL.png',NULL,'2022-08-01 20:04:13','2022-08-01 20:04:13','admin'),(60,'FRA','FRANCIA','FRANCIA','EUROPA',NULL,'FRA.png',NULL,'2022-08-01 20:04:33','2022-08-01 20:04:33','admin'),(61,'AUS','AUSTRALIA','AUSTRALIA','OCEANIA',NULL,'AUS.png',NULL,'2022-08-01 20:04:54','2022-08-01 20:04:54','admin'),(62,'DIN','DINAMARCA','DINAMARCA','EUROPA',NULL,'DIN.png',NULL,'2022-08-01 20:05:16','2022-08-01 20:05:16','admin'),(63,'TUN','TÚNEZ','TÚNEZ','EUROPA',NULL,'TUN.png',NULL,'2022-08-01 20:05:40','2022-08-01 20:05:40','admin'),(64,'ESP','ESPAÑA','ESPAÑA','EUROPA',NULL,'ESP.png',NULL,'2022-08-01 20:06:01','2022-08-01 20:06:01','admin'),(65,'CRI','COSTA RICA','COSTA RICA','NORTEAMERICA',NULL,'CRI.png',NULL,'2022-08-01 20:06:26','2022-08-01 20:06:26','admin'),(66,'ALE','ALEMANIA','ALEMANIA','EUROPA',NULL,'ALE.png',NULL,'2022-08-01 20:06:46','2022-08-01 20:06:46','admin'),(67,'JPN','JAPÓN','JAPÓN','ASIA',NULL,'JPN.png',NULL,'2022-08-01 20:07:20','2022-08-01 20:07:20','admin'),(68,'BEL','BÉLGICA','BÉLGICA','NORTEAMERICA',NULL,'BEL.png',NULL,'2022-08-01 20:07:42','2022-08-01 20:07:42','admin'),(69,'CAN','CANADÁ','CANADÁ','NORTEAMERICA',NULL,'CAN.png',NULL,'2022-08-01 20:08:07','2022-08-01 20:08:07','admin'),(70,'MAR','MARRUECOS','MARRUECOS','ASIA',NULL,'MAR.png',NULL,'2022-08-01 20:08:29','2022-08-01 20:08:29','admin'),(71,'CRO','CROACIA','CROACIA','EUROPA',NULL,'CRO.png',NULL,'2022-08-01 20:08:51','2022-08-01 20:08:51','admin'),(72,'BRA','BRASIL','BRASIL','SUDAMERICA',NULL,'BRA.png',NULL,'2022-08-01 20:09:12','2022-08-01 20:09:12','admin'),(73,'SER','SERBIA','SERBIA','NORTEAMERICA',NULL,'SER.png',NULL,'2022-08-01 20:09:34','2022-08-01 20:09:34','admin'),(74,'SUI','SUIZA','SUIZA','EUROPA',NULL,'SUI.png',NULL,'2022-08-01 20:09:56','2022-08-01 20:09:56','admin'),(75,'CAM','CAMERÚN','CAMERÚN','AFRICA',NULL,'CAM.png',NULL,'2022-08-01 20:10:13','2022-08-01 20:10:13','admin'),(76,'POR','PORTUGAL','PORTUGAL','EUROPA',NULL,'POR.png',NULL,'2022-08-01 20:10:33','2022-08-01 20:10:33','admin'),(77,'GHN','GHANA','GHANA','AFRICA',NULL,'GHN.png',NULL,'2022-08-01 20:10:54','2022-08-01 20:10:54','admin'),(78,'URU','URUGUAY','URUGUAY','SUDAMERICA',NULL,'URU.png',NULL,'2022-08-01 20:11:14','2022-08-01 20:11:14','admin'),(79,'COR','R. DE COREA','R. DE COREA','ASIA',NULL,'COR.png',NULL,'2022-08-01 20:11:40','2022-08-01 20:11:40','admin');
/*!40000 ALTER TABLE `equipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipotorneo`
--

DROP TABLE IF EXISTS `equipotorneo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipotorneo` (
  `ID_EQUIPO_TORNEO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TORNEO` int(11) DEFAULT NULL,
  `ID_EQUIPO` int(11) DEFAULT NULL,
  `PARTIDOS_JUGADOS` int(11) DEFAULT NULL,
  `PARTIDOS_GANADOS` int(11) DEFAULT NULL,
  `PARTIDOS_EMPATADOS` int(11) DEFAULT NULL,
  `PARTIDOS_PERDIDOS` int(11) DEFAULT NULL,
  `GF` int(11) DEFAULT NULL,
  `GC` int(11) DEFAULT NULL,
  `GD` int(11) DEFAULT NULL,
  `GRUPO` varchar(256) DEFAULT NULL,
  `POSICION_EQUIPO_TORENO` varchar(256) DEFAULT NULL,
  `crea_dato` datetime NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_dato` varchar(256) NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`ID_EQUIPO_TORNEO`),
  KEY `FK_RELATIONSHIP_1` (`ID_TORNEO`),
  KEY `ID_EQUIPO` (`ID_EQUIPO`),
  CONSTRAINT `FK_RELATIONSHIP_1` FOREIGN KEY (`ID_TORNEO`) REFERENCES `torneo` (`ID_TORNEO`),
  CONSTRAINT `equipotorneo_ibfk_1` FOREIGN KEY (`ID_EQUIPO`) REFERENCES `equipo` (`ID_EQUIPO`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipotorneo`
--

LOCK TABLES `equipotorneo` WRITE;
/*!40000 ALTER TABLE `equipotorneo` DISABLE KEYS */;
INSERT INTO `equipotorneo` VALUES (45,4,48,0,0,0,0,0,0,0,'A',NULL,'2022-08-01 20:15:49','2022-08-08 15:47:46','admin'),(46,4,49,0,0,0,0,0,0,0,'A',NULL,'2022-08-01 20:15:58','2022-08-08 15:48:01','admin'),(47,4,50,0,0,0,0,0,0,0,'A',NULL,'2022-08-01 20:16:09','2022-08-01 20:30:56','admin'),(48,4,51,0,0,0,0,0,0,0,'A',NULL,'2022-08-01 20:16:23','2022-08-01 20:31:04','admin'),(49,4,52,0,0,0,0,0,0,0,'B',NULL,'2022-08-01 20:16:34','2022-08-01 20:31:12','admin'),(50,4,53,0,0,0,0,0,0,0,'B',NULL,'2022-08-01 20:16:43','2022-08-01 20:31:21','admin'),(51,4,54,0,0,0,0,0,0,0,'B',NULL,'2022-08-01 20:16:52','2022-08-01 20:31:25','admin'),(52,4,55,0,0,0,0,0,0,0,'B',NULL,'2022-08-01 20:17:01','2022-08-01 20:31:32','admin'),(53,4,56,0,0,0,0,0,0,0,'C',NULL,'2022-08-01 20:17:13','2022-08-01 20:31:39','admin'),(54,4,57,0,0,0,0,0,0,0,'C',NULL,'2022-08-01 20:17:26','2022-08-01 20:31:44','admin'),(55,4,58,0,0,0,0,0,0,0,'C',NULL,'2022-08-01 20:17:40','2022-08-01 20:31:49','admin'),(56,4,59,0,0,0,0,0,0,0,'C',NULL,'2022-08-01 20:17:53','2022-08-01 20:32:06','admin'),(57,4,60,0,0,0,0,0,0,0,'D',NULL,'2022-08-01 20:18:22','2022-08-01 20:32:13','admin'),(58,4,61,0,0,0,0,0,0,0,'D',NULL,'2022-08-01 20:18:34','2022-08-01 20:32:33','admin'),(59,4,62,NULL,NULL,NULL,NULL,0,0,0,'D',NULL,'2022-08-01 20:18:50','2022-08-01 20:18:50','admin'),(60,4,63,NULL,NULL,NULL,NULL,0,0,0,'D',NULL,'2022-08-01 20:19:02','2022-08-01 20:19:02','admin'),(61,4,64,0,0,0,0,0,0,0,'E',NULL,'2022-08-01 20:19:25','2022-08-01 20:30:11','admin'),(62,4,65,0,0,0,0,0,0,0,'E',NULL,'2022-08-01 20:20:23','2022-08-01 20:29:53','admin'),(63,4,66,0,0,0,0,0,0,0,'E',NULL,'2022-08-01 20:22:55','2022-08-01 20:22:55','admin'),(64,4,67,0,0,0,0,0,0,0,'E',NULL,'2022-08-01 20:23:16','2022-08-01 20:23:16','admin'),(65,4,68,0,0,0,0,0,0,0,'F',NULL,'2022-08-01 20:24:53','2022-08-01 20:24:53','admin'),(66,4,69,0,0,0,0,0,0,0,'F',NULL,'2022-08-01 20:25:21','2022-08-01 20:25:21','admin'),(67,4,70,0,0,0,0,0,0,0,'F',NULL,'2022-08-01 20:26:02','2022-08-01 20:26:02','admin'),(68,4,71,0,0,0,0,0,0,0,'F',NULL,'2022-08-01 20:26:25','2022-08-01 20:26:25','admin'),(69,4,72,0,0,0,0,0,0,0,'G',NULL,'2022-08-01 20:26:53','2022-08-01 20:27:06','admin'),(70,4,73,0,0,0,0,0,0,0,'G',NULL,'2022-08-01 20:27:26','2022-08-01 20:27:26','admin'),(71,4,74,0,0,0,0,0,0,0,'G',NULL,'2022-08-01 20:27:44','2022-08-01 20:27:44','admin'),(72,4,75,0,0,0,0,0,0,0,'G',NULL,'2022-08-01 20:28:05','2022-08-01 20:28:05','admin'),(73,4,76,0,0,0,0,0,0,0,'H',NULL,'2022-08-01 20:28:31','2022-08-01 20:28:31','admin'),(74,4,77,0,0,0,0,0,0,0,'H',NULL,'2022-08-01 20:28:49','2022-08-01 20:28:49','admin'),(75,4,78,0,0,0,0,0,0,0,'H',NULL,'2022-08-01 20:29:07','2022-08-01 20:29:07','admin'),(76,4,79,0,0,0,0,0,0,0,'H',NULL,'2022-08-01 20:29:18','2022-08-01 20:29:38','admin');
/*!40000 ALTER TABLE `equipotorneo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estadio`
--

DROP TABLE IF EXISTS `estadio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estadio` (
  `id_estadio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_estadio` varchar(256) DEFAULT NULL,
  `foto_estadio` varchar(1024) DEFAULT NULL,
  `crea_dato` datetime DEFAULT current_timestamp(),
  `modifica_dato` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_dato` varchar(256) DEFAULT 'admin',
  `id_torneo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_estadio`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estadio`
--

LOCK TABLES `estadio` WRITE;
/*!40000 ALTER TABLE `estadio` DISABLE KEYS */;
INSERT INTO `estadio` VALUES (14,'Estadio Al Janoub','16445858426149.jpg','2022-08-01 20:33:19','2022-08-01 20:33:19','admin',4);
/*!40000 ALTER TABLE `estadio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participante`
--

DROP TABLE IF EXISTS `participante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participante` (
  `ID_PARTICIPANTE` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(256) DEFAULT NULL,
  `APELLIDO` varchar(256) DEFAULT NULL,
  `FECHA_NACIMIENTO` varchar(256) DEFAULT NULL,
  `CEDULA` varchar(10) DEFAULT NULL,
  `EMAIL` varchar(256) DEFAULT NULL,
  `TELEFONO` varchar(10) DEFAULT NULL,
  `crea_dato` datetime NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_dato` varchar(256) NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`ID_PARTICIPANTE`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participante`
--

LOCK TABLES `participante` WRITE;
/*!40000 ALTER TABLE `participante` DISABLE KEYS */;
INSERT INTO `participante` VALUES (5,NULL,NULL,NULL,NULL,NULL,'n','2022-08-02 14:03:33','2022-08-02 14:03:33','admin'),(6,NULL,NULL,NULL,NULL,NULL,'n','2022-08-02 14:16:03','2022-08-02 14:16:03','admin');
/*!40000 ALTER TABLE `participante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partidos`
--

DROP TABLE IF EXISTS `partidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partidos` (
  `equipo_local` int(11) DEFAULT NULL,
  `equipo_visitante` int(11) DEFAULT NULL,
  `ID_PARTIDO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TORNEO` int(11) DEFAULT NULL,
  `FECHA_PARTIDO` date DEFAULT NULL,
  `HORA_PARTIDO` time DEFAULT NULL,
  `ESTADIO` int(11) DEFAULT NULL,
  `CIUDAD_PARTIDO` varchar(256) DEFAULT NULL,
  `PAIS_PARTIDO` varchar(256) DEFAULT NULL,
  `GOLES_LOCAL` int(11) DEFAULT 0,
  `GOLES_VISITANTE` int(11) DEFAULT 0,
  `GOLES_EXTRA_EQUIPO1` int(11) DEFAULT 0,
  `GOLES_EXTRA_EQUIPO2` int(11) DEFAULT 0,
  `NOTA_PARTIDO` text DEFAULT NULL,
  `RESUMEN_PARTIDO` text DEFAULT NULL,
  `ESTADO_PARTIDO` varchar(256) DEFAULT NULL,
  `crea_dato` datetime NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_dato` varchar(256) NOT NULL DEFAULT 'admin',
  `automatico` tinyint(1) NOT NULL,
  `actualizado` varchar(256) NOT NULL,
  PRIMARY KEY (`ID_PARTIDO`),
  KEY `FK_RELATIONSHIP_3` (`ID_TORNEO`),
  KEY `equipo_local` (`equipo_local`),
  KEY `equipo_visitante` (`equipo_visitante`),
  CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`ID_TORNEO`) REFERENCES `torneo` (`ID_TORNEO`),
  CONSTRAINT `partidos_ibfk_1` FOREIGN KEY (`equipo_local`) REFERENCES `equipotorneo` (`ID_EQUIPO`) ON UPDATE CASCADE,
  CONSTRAINT `partidos_ibfk_2` FOREIGN KEY (`equipo_visitante`) REFERENCES `equipotorneo` (`ID_EQUIPO`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partidos`
--

LOCK TABLES `partidos` WRITE;
/*!40000 ALTER TABLE `partidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `partidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pronosticador`
--

DROP TABLE IF EXISTS `pronosticador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pronosticador` (
  `ID_ENCUESTA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PARTICIPANTE` int(11) DEFAULT NULL,
  `GRUPO` varchar(1) DEFAULT NULL,
  `EQUIPO` varchar(256) DEFAULT NULL,
  `POSICION` varchar(256) DEFAULT NULL,
  `NUMERACION` varchar(4) DEFAULT NULL,
  `crea_dato` datetime NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_dato` varchar(256) NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`ID_ENCUESTA`),
  KEY `FK_RELATIONSHIP_4` (`ID_PARTICIPANTE`),
  CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`ID_PARTICIPANTE`) REFERENCES `participante` (`ID_PARTICIPANTE`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pronosticador`
--

LOCK TABLES `pronosticador` WRITE;
/*!40000 ALTER TABLE `pronosticador` DISABLE KEYS */;
INSERT INTO `pronosticador` VALUES (23,NULL,NULL,NULL,'Cuartos',NULL,'2022-08-02 14:03:39','2022-08-02 14:03:39','admin'),(24,NULL,NULL,NULL,'Cuartos',NULL,'2022-08-02 14:03:44','2022-08-02 14:03:44','admin'),(25,NULL,NULL,NULL,'Semifinal',NULL,'2022-08-02 14:16:08','2022-08-02 14:16:08','admin'),(26,NULL,'B',NULL,NULL,NULL,'2022-08-02 14:20:22','2022-08-02 14:20:22','admin');
/*!40000 ALTER TABLE `pronosticador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `torneo`
--

DROP TABLE IF EXISTS `torneo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `torneo` (
  `ID_TORNEO` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_TORNEO_CORTO` varchar(256) DEFAULT NULL,
  `NOM_TORNEO_LARGO` varchar(256) DEFAULT NULL,
  `PAIS_TORNEO` varchar(256) DEFAULT NULL,
  `REGION_TORNEO` varchar(256) DEFAULT NULL,
  `DETALLE_TORNEO` text DEFAULT NULL,
  `LOGO_TORNEO` varchar(1024) DEFAULT NULL,
  `crea_dato` datetime NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_dato` varchar(256) NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`ID_TORNEO`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `torneo`
--

LOCK TABLES `torneo` WRITE;
/*!40000 ALTER TABLE `torneo` DISABLE KEYS */;
INSERT INTO `torneo` VALUES (4,'CATAR','CATAR 2022','CATAR','ASIA',NULL,'QATAR2022.jpg','2022-08-01 20:13:32','2022-08-01 20:13:32','admin');
/*!40000 ALTER TABLE `torneo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT,
  `USER` varchar(256) DEFAULT NULL,
  `CONTRASENA` varchar(1024) DEFAULT NULL,
  `nombre` varchar(256) NOT NULL,
  `crea_dato` int(11) NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID_USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'admin','2c0bb62696efcc11172bca9cb17138db','a:2:{s:15:\"LoginRetryCount\";i:0;s:20:\"LastBadLoginDateTime\";s:19:\"2022/07/13 17:12:09\";}',2147483647,'2022-07-15 14:39:42');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-09 11:40:25
