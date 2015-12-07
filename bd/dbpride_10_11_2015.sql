-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-11-2015 a las 22:31:05
-- Versión del servidor: 5.5.46-0ubuntu0.14.04.2
-- Versión de PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dbpride`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rfc` varchar(14) NOT NULL,
  `password` varchar(400) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apaterno` varchar(45) NOT NULL,
  `amaterno` varchar(45) NOT NULL,
  PRIMARY KEY (`id`,`rfc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `rfc`, `password`, `nombre`, `apaterno`, `amaterno`) VALUES
(2, 'RFCADMIN', '1a1dc91c907325c69271ddf0c944bc72', 'ADMIN', 'ADMIN', 'ADMIN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comision`
--

CREATE TABLE IF NOT EXISTS `comision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comision` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `comision`
--

INSERT INTO `comision` (`id`, `comision`) VALUES
(1, 'Comision 1'),
(2, 'Comision 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluado`
--

CREATE TABLE IF NOT EXISTS `evaluado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_periodo` (`id_periodo`),
  KEY `id_comision` (`id_comision`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluador`
--

CREATE TABLE IF NOT EXISTS `evaluador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_periodo` (`id_periodo`),
  KEY `id_comision` (`id_comision`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluador_evaluado`
--

CREATE TABLE IF NOT EXISTS `evaluador_evaluado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evaluador` int(11) NOT NULL,
  `id_evaluado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_evaluador` (`id_evaluador`),
  KEY `id_evaluado` (`id_evaluado`),
  KEY `id_evaluador_2` (`id_evaluador`),
  KEY `id_evaluado_2` (`id_evaluado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `evaluador_evaluado`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE IF NOT EXISTS `periodo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(4) NOT NULL,
  `numero` enum('1','2') NOT NULL,
  `inicioper` date NOT NULL,
  `finper` date NOT NULL,
  `inicioeval` date NOT NULL,
  `fineval` date NOT NULL,
  `inicioentrega` date NOT NULL,
  `finentrega` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;



--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rfc` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apaterno` varchar(45) NOT NULL,
  `amaterno` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`,`rfc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;


--
-- Filtros para la tabla `evaluado`
--
ALTER TABLE `evaluado`
  ADD CONSTRAINT `comision_evaluado_fk` FOREIGN KEY (`id_comision`) REFERENCES `comision` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `periodo_evaluado_fk` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_evaluado_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evaluador`
--
ALTER TABLE `evaluador`
  ADD CONSTRAINT `comision_evaluador_fk` FOREIGN KEY (`id_comision`) REFERENCES `comision` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `periodo_evaluador_fk` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_evaluador_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evaluador_evaluado`
--
ALTER TABLE `evaluador_evaluado`
  ADD CONSTRAINT `evaluador_eval_fk` FOREIGN KEY (`id_evaluador`) REFERENCES `evaluador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `evaluado_eval_fk` FOREIGN KEY (`id_evaluado`) REFERENCES `evaluado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
