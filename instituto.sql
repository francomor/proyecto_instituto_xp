-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-03-2018 a las 17:16:48
-- Versión del servidor: 5.7.17-log
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

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`apellido`, `nombre`, `dni`, `fechaNacimiento`, `direccion`, `email`, `tutor_dni`) VALUES
('apellido', 'nombre', 24987654, '1993-01-22', 'calle', 'email', 29654213),
('Galvez', 'Juan Ignacio', 37865412, '1996-03-13', 'calle 11', 'email', 29654213),
('morales', 'alexis', 39271623, '1995-03-15', 'calle 12', 'email', 29654213),
('Alvarez Scasic', 'Juan', 39282123, '1996-02-13', 'calle 11', 'email', 29654213),
('Hernandez Scasic', 'Agustin', 39764123, '1995-02-13', 'calle 11', 'email', 29654213);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnoxcurso`
--

CREATE TABLE `alumnoxcurso` (
  `alumno_dni` int(11) NOT NULL,
  `curso_idcurso` int(11) NOT NULL,
  `anio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumnoxcurso`
--

INSERT INTO `alumnoxcurso` (`alumno_dni`, `curso_idcurso`, `anio`) VALUES
(24987654, 1, 2018),
(37865412, 1, 2018),
(39271623, 1, 2018),
(39282123, 1, 2018),
(39764123, 5, 2018);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `idasistencia` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipo` enum('clase','edFisica','clase+edfisica') NOT NULL,
  `valor` enum('1','1/2') NOT NULL,
  `alumnoxcurso_alumno_dni` int(11) NOT NULL,
  `alumnoxcurso_curso_idcurso` int(11) NOT NULL,
  `justificada` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`idasistencia`, `fecha`, `tipo`, `valor`, `alumnoxcurso_alumno_dni`, `alumnoxcurso_curso_idcurso`, `justificada`) VALUES
(94, '2018-03-18', 'clase+edfisica', '1', 37865412, 1, 1),
(95, '2018-03-18', 'edFisica', '1/2', 39271623, 1, 1),
(96, '2018-03-18', 'clase', '1/2', 39282123, 1, 1),
(97, '2018-03-18', 'clase', '1', 24987654, 1, 1),
(98, '2018-03-18', 'clase', '1', 37865412, 1, 1),
(99, '2018-03-18', 'clase', '1', 39271623, 1, 1),
(100, '2018-03-18', 'clase', '1', 39282123, 1, 1),
(101, '2018-03-19', 'clase', '1', 24987654, 1, 1),
(102, '2018-03-19', 'clase', '1', 37865412, 1, 1),
(103, '2018-03-19', 'clase', '1', 39271623, 1, 1),
(104, '2018-03-19', 'clase', '1', 39282123, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `idcurso` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `anio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idcurso`, `nombre`, `anio`) VALUES
(0, 'A', 1),
(1, 'B', 1),
(2, 'A', 2),
(3, 'B', 2),
(4, 'A', 3),
(5, 'B', 3);

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
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`dni`, `nombre`, `apellido`, `telefono`, `email`) VALUES
(29654213, 'tutor1', 'apellidotutor', '15656565', 'email');

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `idasistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
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
