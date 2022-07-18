-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2022 a las 19:22:54
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `torneo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audittrail`
--

CREATE TABLE `audittrail` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `script` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `keyvalue` longtext DEFAULT NULL,
  `oldvalue` longtext DEFAULT NULL,
  `newvalue` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `audittrail`
--

INSERT INTO `audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(1, '2022-07-15 20:39:14', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'ID_PARTICIPANTE', '3', '', NULL),
(2, '2022-07-15 20:39:14', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'GRUPO', '3', '', NULL),
(3, '2022-07-15 20:39:14', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'EQUIPO', '3', '', NULL),
(4, '2022-07-15 20:39:14', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'POSICION', '3', '', NULL),
(5, '2022-07-15 20:39:14', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'NUMERACION', '3', '', 'k'),
(6, '2022-07-15 20:39:14', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'ID_ENCUESTA', '3', '', '3'),
(7, '2022-07-15 21:06:14', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'ID_PARTICIPANTE', '4', '', '1'),
(8, '2022-07-15 21:06:14', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'GRUPO', '4', '', 'B'),
(9, '2022-07-15 21:06:14', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'EQUIPO', '4', '', 'ECU'),
(10, '2022-07-15 21:06:14', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'POSICION', '4', '', 'Cuartos'),
(11, '2022-07-15 21:06:14', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'NUMERACION', '4', '', 'r'),
(12, '2022-07-15 21:06:14', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'ID_ENCUESTA', '4', '', '4'),
(13, '2022-07-15 21:06:29', '/torneo/EncuestaEdit/4', 'admin', 'U', 'encuesta', 'POSICION', '4', 'Cuartos', 'Final'),
(14, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', '*** Batch delete begin ***', 'encuesta', '', '', '', ''),
(15, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'ID_ENCUESTA', '2', '2', ''),
(16, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'ID_PARTICIPANTE', '2', '1', ''),
(17, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'GRUPO', '2', 'B', ''),
(18, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'EQUIPO', '2', 'ECU', ''),
(19, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'POSICION', '2', 'Semifinal', ''),
(20, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'NUMERACION', '2', 'k', ''),
(21, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'crea_dato', '2', '2022-07-15 14:33:47', ''),
(22, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'modifica_dato', '2', '2022-07-15 14:33:59', ''),
(23, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'ID_ENCUESTA', '3', '3', ''),
(24, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'ID_PARTICIPANTE', '3', NULL, ''),
(25, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'GRUPO', '3', NULL, ''),
(26, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'EQUIPO', '3', NULL, ''),
(27, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'POSICION', '3', NULL, ''),
(28, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'NUMERACION', '3', 'k', ''),
(29, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'crea_dato', '3', '2022-07-15 15:39:14', ''),
(30, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'modifica_dato', '3', '2022-07-15 15:39:14', ''),
(31, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'ID_ENCUESTA', '4', '4', ''),
(32, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'ID_PARTICIPANTE', '4', '1', ''),
(33, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'GRUPO', '4', 'B', ''),
(34, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'EQUIPO', '4', 'ECU', ''),
(35, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'POSICION', '4', 'Final', ''),
(36, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'NUMERACION', '4', 'r', ''),
(37, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'crea_dato', '4', '2022-07-15 16:06:14', ''),
(38, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'modifica_dato', '4', '2022-07-15 16:06:29', ''),
(39, '2022-07-15 21:07:33', '/torneo/EncuestaDelete', 'admin', '*** Batch delete successful ***', 'encuesta', '', '', '', ''),
(40, '2022-07-18 15:50:03', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'ID_PARTICIPANTE', '5', '', '1'),
(41, '2022-07-18 15:50:03', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'GRUPO', '5', '', 'B'),
(42, '2022-07-18 15:50:03', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'EQUIPO', '5', '', NULL),
(43, '2022-07-18 15:50:03', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'POSICION', '5', '', NULL),
(44, '2022-07-18 15:50:03', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'NUMERACION', '5', '', NULL),
(45, '2022-07-18 15:50:03', '/torneo/EncuestaAdd', 'admin', 'A', 'encuesta', 'ID_ENCUESTA', '5', '', '5'),
(46, '2022-07-18 15:51:11', '/torneo/EncuestaDelete', 'admin', '*** Batch delete begin ***', 'encuesta', '', '', '', ''),
(47, '2022-07-18 15:51:11', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'ID_ENCUESTA', '5', '5', ''),
(48, '2022-07-18 15:51:11', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'ID_PARTICIPANTE', '5', '1', ''),
(49, '2022-07-18 15:51:11', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'GRUPO', '5', 'B', ''),
(50, '2022-07-18 15:51:11', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'EQUIPO', '5', NULL, ''),
(51, '2022-07-18 15:51:11', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'POSICION', '5', NULL, ''),
(52, '2022-07-18 15:51:11', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'NUMERACION', '5', NULL, ''),
(53, '2022-07-18 15:51:11', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'crea_dato', '5', '2022-07-18 10:50:03', ''),
(54, '2022-07-18 15:51:11', '/torneo/EncuestaDelete', 'admin', 'D', 'encuesta', 'modifica_dato', '5', '2022-07-18 10:50:03', ''),
(55, '2022-07-18 15:51:11', '/torneo/EncuestaDelete', 'admin', '*** Batch delete successful ***', 'encuesta', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `ID_ENCUESTA` int(11) NOT NULL,
  `ID_PARTICIPANTE` int(11) DEFAULT NULL,
  `GRUPO` varchar(1) DEFAULT NULL,
  `EQUIPO` varchar(256) DEFAULT NULL,
  `POSICION` varchar(256) DEFAULT NULL,
  `NUMERACION` varchar(4) DEFAULT NULL,
  `crea_dato` datetime NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `ID_EQUIPO` int(11) NOT NULL,
  `NOM_EQUIPO_CORTO` varchar(256) DEFAULT NULL,
  `NOM_EQUIPO_LARGO` varchar(256) DEFAULT NULL,
  `PAIS_EQUIPO` varchar(256) DEFAULT NULL,
  `REGION_EQUIPO` varchar(256) DEFAULT NULL,
  `DETALLE_EQUIPO` text DEFAULT NULL,
  `ESCUDO_EQUIPO` longblob DEFAULT NULL,
  `NOM_ESTADIO` int(11) DEFAULT NULL,
  `crea_dato` datetime NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipotorneo`
--

CREATE TABLE `equipotorneo` (
  `ID_EQUIPO_TORNEO` int(11) NOT NULL,
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
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadio`
--

CREATE TABLE `estadio` (
  `id_estadio` int(11) NOT NULL,
  `nombre_estadio` varchar(256) DEFAULT NULL,
  `foto_estadio` longblob DEFAULT NULL,
  `crea_dato` datetime DEFAULT current_timestamp(),
  `modifica_dato` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante`
--

CREATE TABLE `participante` (
  `ID_PARTICIPANTE` int(11) NOT NULL,
  `NOMBRE` varchar(256) DEFAULT NULL,
  `APELLIDO` varchar(256) DEFAULT NULL,
  `FECHA_NACIMIENTO` varchar(256) DEFAULT NULL,
  `CEDULA` varchar(10) DEFAULT NULL,
  `EMAIL` varchar(256) DEFAULT NULL,
  `TELEFONO` varchar(10) DEFAULT NULL,
  `crea_dato` datetime NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE `partidos` (
  `equipo_local` int(11) DEFAULT NULL,
  `equipo_visitante` int(11) DEFAULT NULL,
  `ID_PARTIDO` int(11) NOT NULL,
  `ID_TORNEO` int(11) DEFAULT NULL,
  `FECHA_PARTIDO` date DEFAULT NULL,
  `HORA_PARTIDO` time DEFAULT NULL,
  `ESTADIO` int(11) DEFAULT NULL,
  `CIUDAD_PARTIDO` varchar(256) DEFAULT NULL,
  `PAIS_PARTIDO` varchar(256) DEFAULT NULL,
  `GOLES_EQUIPO1` int(11) DEFAULT 0,
  `GOLES_EQUIPO2` int(11) DEFAULT 0,
  `GOLES_EXTRA_EQUIPO1` int(11) DEFAULT 0,
  `GOLES_EXTRA_EQUIPO2` int(11) DEFAULT 0,
  `NOTA_PARTIDO` text DEFAULT NULL,
  `RESUMEN_PARTIDO` text DEFAULT NULL,
  `ESTADO_PARTIDO` varchar(256) DEFAULT NULL,
  `crea_dato` datetime NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneo`
--

CREATE TABLE `torneo` (
  `ID_TORNEO` int(11) NOT NULL,
  `NOM_TORNEO_CORTO` varchar(256) DEFAULT NULL,
  `NOM_TORNEO_LARGO` varchar(256) DEFAULT NULL,
  `PAIS_TORNEO` varchar(256) DEFAULT NULL,
  `REGION_TORNEO` varchar(256) DEFAULT NULL,
  `DETALLE_TORNEO` text DEFAULT NULL,
  `LOGO_TORNEO` longblob DEFAULT NULL,
  `crea_dato` datetime NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_USUARIO` int(11) NOT NULL,
  `USER` varchar(256) DEFAULT NULL,
  `CONTRASENA` varchar(1024) DEFAULT NULL,
  `nombre` varchar(256) NOT NULL,
  `crea_dato` int(11) NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_USUARIO`, `USER`, `CONTRASENA`, `nombre`, `crea_dato`, `modifica_dato`) VALUES
(1, 'admin', '2c0bb62696efcc11172bca9cb17138db', 'a:2:{s:15:\"LoginRetryCount\";i:0;s:20:\"LastBadLoginDateTime\";s:19:\"2022/07/13 17:12:09\";}', 2147483647, '2022-07-15 14:39:42');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `audittrail`
--
ALTER TABLE `audittrail`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`ID_ENCUESTA`),
  ADD KEY `FK_RELATIONSHIP_4` (`ID_PARTICIPANTE`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`ID_EQUIPO`);

--
-- Indices de la tabla `equipotorneo`
--
ALTER TABLE `equipotorneo`
  ADD PRIMARY KEY (`ID_EQUIPO_TORNEO`),
  ADD KEY `FK_RELATIONSHIP_1` (`ID_TORNEO`),
  ADD KEY `FK_RELATIONSHIP_2` (`ID_EQUIPO`);

--
-- Indices de la tabla `estadio`
--
ALTER TABLE `estadio`
  ADD PRIMARY KEY (`id_estadio`);

--
-- Indices de la tabla `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`ID_PARTICIPANTE`);

--
-- Indices de la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD PRIMARY KEY (`ID_PARTIDO`),
  ADD KEY `FK_RELATIONSHIP_3` (`ID_TORNEO`);

--
-- Indices de la tabla `torneo`
--
ALTER TABLE `torneo`
  ADD PRIMARY KEY (`ID_TORNEO`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_USUARIO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `audittrail`
--
ALTER TABLE `audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `ID_ENCUESTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `ID_EQUIPO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `equipotorneo`
--
ALTER TABLE `equipotorneo`
  MODIFY `ID_EQUIPO_TORNEO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `estadio`
--
ALTER TABLE `estadio`
  MODIFY `id_estadio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `participante`
--
ALTER TABLE `participante`
  MODIFY `ID_PARTICIPANTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `partidos`
--
ALTER TABLE `partidos`
  MODIFY `ID_PARTIDO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `torneo`
--
ALTER TABLE `torneo`
  MODIFY `ID_TORNEO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`ID_PARTICIPANTE`) REFERENCES `participante` (`ID_PARTICIPANTE`);

--
-- Filtros para la tabla `equipotorneo`
--
ALTER TABLE `equipotorneo`
  ADD CONSTRAINT `FK_RELATIONSHIP_1` FOREIGN KEY (`ID_TORNEO`) REFERENCES `torneo` (`ID_TORNEO`),
  ADD CONSTRAINT `FK_RELATIONSHIP_2` FOREIGN KEY (`ID_EQUIPO`) REFERENCES `equipo` (`ID_EQUIPO`);

--
-- Filtros para la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`ID_TORNEO`) REFERENCES `torneo` (`ID_TORNEO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
