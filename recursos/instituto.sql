-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-03-2018 a las 20:25:02
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `instituto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `apellido` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `dni` int(11) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `tutor_dni` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnoxcurso`
--

CREATE TABLE `alumnoxcurso` (
  `alumno_dni` int(11) NOT NULL,
  `curso_idcurso` int(11) NOT NULL,
  `anio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `idasistencia` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipo` enum('clase','edFisica') NOT NULL,
  `valor` enum('1','1/2') NOT NULL,
  `alumnoxcurso_alumno_dni` int(11) NOT NULL,
  `alumnoxcurso_curso_idcurso` int(11) NOT NULL,
  `justificada` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `idcurso` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `anio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preceptor`
--

CREATE TABLE `preceptor` (
  `dni` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor`
--

CREATE TABLE `tutor` (
  `dni` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`dni`,`tutor_dni`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`),
  ADD KEY `fk_alumno_tutor1_idx` (`tutor_dni`);

--
-- Indices de la tabla `alumnoxcurso`
--
ALTER TABLE `alumnoxcurso`
  ADD PRIMARY KEY (`alumno_dni`,`curso_idcurso`),
  ADD KEY `fk_alumno_has_curso_curso1_idx` (`curso_idcurso`),
  ADD KEY `fk_alumno_has_curso_alumno_idx` (`alumno_dni`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`idasistencia`,`alumnoxcurso_alumno_dni`,`alumnoxcurso_curso_idcurso`),
  ADD UNIQUE KEY `idasistencia_UNIQUE` (`idasistencia`),
  ADD KEY `fk_asistencia_alumnoxcurso1_idx` (`alumnoxcurso_alumno_dni`,`alumnoxcurso_curso_idcurso`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idcurso`),
  ADD UNIQUE KEY `idcurso_UNIQUE` (`idcurso`);

--
-- Indices de la tabla `preceptor`
--
ALTER TABLE `preceptor`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`dni`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `fk_alumno_tutor1` FOREIGN KEY (`tutor_dni`) REFERENCES `tutor` (`dni`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alumnoxcurso`
--
ALTER TABLE `alumnoxcurso`
  ADD CONSTRAINT `fk_alumno_has_curso_alumno` FOREIGN KEY (`alumno_dni`) REFERENCES `alumno` (`dni`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumno_has_curso_curso1` FOREIGN KEY (`curso_idcurso`) REFERENCES `curso` (`idcurso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_asistencia_alumnoxcurso1` FOREIGN KEY (`alumnoxcurso_alumno_dni`,`alumnoxcurso_curso_idcurso`) REFERENCES `alumnoxcurso` (`alumno_dni`, `curso_idcurso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
