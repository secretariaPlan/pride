-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 28-05-2015 a las 19:53:11
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pride`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rfc` varchar(14) NOT NULL,
  `password` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apaterno` varchar(45) NOT NULL,
  `amaterno` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`,`rfc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `rfc`, `password`, `nombre`, `apaterno`, `amaterno`, `correo`) VALUES
(1, 'RFCADMIN', '7fc8fb429cd4411a7302b469234ac633', 'Admin', 'Admin', 'Admin', 'admin@admin.com'),
(2, 'GABG901004F95', 'dc3531e5578beaddff4c43a040b12f8a', 'Gabriel', 'Garcia', 'Barrera', 'gabrieldelabarrera@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comision`
--

CREATE TABLE IF NOT EXISTS `comision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comision` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `comision`
--

INSERT INTO `comision` (`id`, `comision`) VALUES
(1, 'medicas de la salud');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluado`
--

CREATE TABLE IF NOT EXISTS `evaluado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `evaluado`
--

INSERT INTO `evaluado` (`id`, `id_usuario`, `id_periodo`, `id_comision`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluador`
--

CREATE TABLE IF NOT EXISTS `evaluador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluador_evaluado`
--

CREATE TABLE IF NOT EXISTS `evaluador_evaluado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evaluador` int(11) NOT NULL,
  `id_evaluado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `evaluador_evaluado`
--

INSERT INTO `evaluador_evaluado` (`id`, `id_evaluador`, `id_evaluado`) VALUES
(9, 1, 1),
(10, 2, 2),
(16, 5, 10),
(17, 0, 0),
(18, 15, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id`, `year`, `numero`, `inicioper`, `finper`, `inicioeval`, `fineval`, `inicioentrega`, `finentrega`) VALUES
(1, '2015', '2', '2015-05-04', '2015-05-06', '2015-05-04', '2015-05-06', '2015-05-04', '2015-05-06'),
(2, '2015', '1', '2015-05-03', '2015-05-04', '2015-05-03', '2015-05-04', '2015-05-03', '2015-05-04');

-- --------------------------------------------------------

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `rfc`, `nombre`, `apaterno`, `amaterno`, `password`, `correo`) VALUES
(1, 'GAB619004F95', 'GABRIEL', 'GARCIA', 'BARRERA', '14e1b600b1fd579f47433b88e8d85291', 'correo@correo.com'),
(2, 'SUB619004F96', 'SUSANA', 'GACUA', 'BARRERA', '14e1b600b1fd579f47433b88e8d85291', 'correo@correo.com'),
(3, 'EZB619004F97', 'EZEQUIEL', 'GARCIA', 'CASTA?EDA', '14e1b600b1fd579f47433b88e8d85291', 'correo@correo.com'),
(4, 'EDY619004F98', 'EDUARDO', 'GARCIA', 'BARRERA', '14e1b600b1fd579f47433b88e8d85291', 'correo@correo.com'),
(5, 'JUA619004F99', 'JUAN', 'KANA', 'BARRERA', '14e1b600b1fd579f47433b88e8d85291', 'correo@correo.com'),
(6, 'MAR619004F100', 'MAURICIO', 'KANA', 'BARRERA', '14e1b600b1fd579f47433b88e8d85291', 'correo@correo.com'),
(7, 'MAU619004F101', 'MARCO', 'VERA', 'BARRERA', '14e1b600b1fd579f47433b88e8d85291', 'correo@correo.com'),
(8, 'BRU619004F102', 'BRUNO', 'VERA', 'BARRERA', '14e1b600b1fd579f47433b88e8d85291', '<div style='),
(9, 'BRE619004F103', 'BRENDA', 'VERA', 'BARRERA', '14e1b600b1fd579f47433b88e8d85291', 'correo@correo.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
