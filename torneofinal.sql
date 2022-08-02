-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-08-2022 a las 02:11:02
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
  `newvalue` longtext DEFAULT NULL,
  `PRUE` int(11) NOT NULL
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
  `ESCUDO_EQUIPO` varchar(1024) DEFAULT NULL,
  `NOM_ESTADIO` int(11) DEFAULT NULL,
  `crea_dato` datetime NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_dato` varchar(256) NOT NULL DEFAULT 'admin'
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
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_dato` varchar(256) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadio`
--

CREATE TABLE `estadio` (
  `id_estadio` int(11) NOT NULL,
  `nombre_estadio` varchar(256) DEFAULT NULL,
  `foto_estadio` varchar(1024) DEFAULT NULL,
  `crea_dato` datetime DEFAULT current_timestamp(),
  `modifica_dato` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_dato` varchar(256) DEFAULT 'admin',
  `id_torneo` int(11) DEFAULT NULL
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
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_dato` varchar(256) NOT NULL DEFAULT 'admin'
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
  `actualizado` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pronosticador`
--

CREATE TABLE `pronosticador` (
  `ID_ENCUESTA` int(11) NOT NULL,
  `ID_PARTICIPANTE` int(11) DEFAULT NULL,
  `GRUPO` varchar(1) DEFAULT NULL,
  `EQUIPO` varchar(256) DEFAULT NULL,
  `POSICION` varchar(256) DEFAULT NULL,
  `NUMERACION` varchar(4) DEFAULT NULL,
  `crea_dato` datetime NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_dato` varchar(256) NOT NULL DEFAULT 'admin'
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
  `LOGO_TORNEO` varchar(1024) DEFAULT NULL,
  `crea_dato` datetime NOT NULL DEFAULT current_timestamp(),
  `modifica_dato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_dato` varchar(256) NOT NULL DEFAULT 'admin'
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
  ADD KEY `ID_EQUIPO` (`ID_EQUIPO`);

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
  ADD KEY `FK_RELATIONSHIP_3` (`ID_TORNEO`),
  ADD KEY `equipo_local` (`equipo_local`),
  ADD KEY `equipo_visitante` (`equipo_visitante`);

--
-- Indices de la tabla `pronosticador`
--
ALTER TABLE `pronosticador`
  ADD PRIMARY KEY (`ID_ENCUESTA`),
  ADD KEY `FK_RELATIONSHIP_4` (`ID_PARTICIPANTE`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `ID_EQUIPO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `equipotorneo`
--
ALTER TABLE `equipotorneo`
  MODIFY `ID_EQUIPO_TORNEO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `estadio`
--
ALTER TABLE `estadio`
  MODIFY `id_estadio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `participante`
--
ALTER TABLE `participante`
  MODIFY `ID_PARTICIPANTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `partidos`
--
ALTER TABLE `partidos`
  MODIFY `ID_PARTIDO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `pronosticador`
--
ALTER TABLE `pronosticador`
  MODIFY `ID_ENCUESTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `torneo`
--
ALTER TABLE `torneo`
  MODIFY `ID_TORNEO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipotorneo`
--
ALTER TABLE `equipotorneo`
  ADD CONSTRAINT `FK_RELATIONSHIP_1` FOREIGN KEY (`ID_TORNEO`) REFERENCES `torneo` (`ID_TORNEO`),
  ADD CONSTRAINT `equipotorneo_ibfk_1` FOREIGN KEY (`ID_EQUIPO`) REFERENCES `equipo` (`ID_EQUIPO`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`ID_TORNEO`) REFERENCES `torneo` (`ID_TORNEO`),
  ADD CONSTRAINT `partidos_ibfk_1` FOREIGN KEY (`equipo_local`) REFERENCES `equipotorneo` (`ID_EQUIPO`) ON UPDATE CASCADE,
  ADD CONSTRAINT `partidos_ibfk_2` FOREIGN KEY (`equipo_visitante`) REFERENCES `equipotorneo` (`ID_EQUIPO`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pronosticador`
--
ALTER TABLE `pronosticador`
  ADD CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`ID_PARTICIPANTE`) REFERENCES `participante` (`ID_PARTICIPANTE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
