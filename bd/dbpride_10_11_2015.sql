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

--
-- Volcado de datos para la tabla `evaluado`
--

INSERT INTO `evaluado` (`id`, `id_usuario`, `id_periodo`, `id_comision`) VALUES
(1, 11, 1, 1),
(2, 12, 1, 1),
(3, 13, 1, 1),
(4, 14, 1, 1),
(5, 15, 1, 1),
(6, 16, 1, 1),
(7, 17, 1, 1),
(8, 18, 1, 1),
(9, 19, 1, 1),
(10, 20, 1, 1),
(11, 51, 2, 1),
(12, 52, 2, 1),
(13, 53, 2, 1),
(14, 54, 2, 1),
(15, 55, 2, 1),
(16, 56, 2, 1),
(17, 57, 2, 1),
(18, 58, 2, 1),
(19, 59, 2, 1),
(20, 60, 2, 1);

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

--
-- Volcado de datos para la tabla `evaluador`
--

INSERT INTO `evaluador` (`id`, `id_usuario`, `id_periodo`, `id_comision`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 1, 1),
(5, 5, 1, 1),
(6, 6, 1, 1),
(7, 7, 1, 1),
(8, 8, 1, 1),
(9, 9, 1, 1),
(10, 10, 1, 1),
(11, 41, 2, 1),
(12, 42, 2, 1),
(13, 43, 2, 1),
(14, 44, 2, 1),
(15, 45, 2, 1),
(16, 46, 2, 1),
(17, 47, 2, 1),
(18, 48, 2, 1),
(19, 49, 2, 1),
(20, 50, 2, 1);

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

INSERT INTO `evaluador_evaluado` (`id`, `id_evaluador`, `id_evaluado`) VALUES
(1, 11, 11),
(2, 11, 12),
(3, 12, 13);

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
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id`, `year`, `numero`, `inicioper`, `finper`, `inicioeval`, `fineval`, `inicioentrega`, `finentrega`) VALUES
(1, '2015', '1', '2015-09-01', '2015-09-30', '2015-09-02', '2015-09-09', '2015-09-15', '2015-09-28'),
(2, '2015', '2', '2015-10-01', '2015-10-30', '2015-10-05', '2015-10-09', '2015-10-19', '2015-10-27');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `rfc`, `nombre`, `apaterno`, `amaterno`, `password`, `correo`) VALUES
(1, 'RFC1', 'NOMBRE1', 'APATERNO1', 'AMATERNO1', '1a1dc91c907325c69271ddf0c944bc72', 'correo1@correo.com'),
(2, 'RFC2', 'NOMBRE2', 'APATERNO2', 'AMATERNO2', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(3, 'RFC3', 'NOMBRE3', 'APATERNO3', 'AMATERNO3', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(4, 'RFC4', 'NOMBRE4', 'APATERNO4', 'AMATERNO4', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(5, 'RFC5', 'NOMBRE5', 'APATERNO5', 'AMATERNO5', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(6, 'RFC6', 'NOMBRE6', 'APATERNO6', 'AMATERNO6', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(7, 'RFC7', 'NOMBRE7', 'APATERNO7', 'AMATERNO7', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(8, 'RFC8', 'NOMBRE8', 'APATERNO8', 'AMATERNO8', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(9, 'RFC9', 'NOMBRE9', 'APATERNO9', 'AMATERNO9', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(10, 'RFC10', 'NOMBRE10', 'APATERNO10', 'AMATERNO10', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(11, 'RFC11', 'NOMBRE11', 'APATERNO11', 'AMATERNO11', '1a1dc91c907325c69271ddf0c944bc72', 'correo1@correo.com'),
(12, 'RFC12', 'NOMBRE12', 'APATERNO12', 'AMATERNO12', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(13, 'RFC13', 'NOMBRE13', 'APATERNO13', 'AMATERNO13', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(14, 'RFC14', 'NOMBRE14', 'APATERNO14', 'AMATERNO14', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(15, 'RFC15', 'NOMBRE15', 'APATERNO15', 'AMATERNO15', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(16, 'RFC16', 'NOMBRE16', 'APATERNO16', 'AMATERNO16', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(17, 'RFC17', 'NOMBRE17', 'APATERNO17', 'AMATERNO17', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(18, 'RFC18', 'NOMBRE18', 'APATERNO18', 'AMATERNO18', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(19, 'RFC19', 'NOMBRE19', 'APATERNO19', 'AMATERNO19', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(20, 'RFC20', 'NOMBRE20', 'APATERNO20', 'AMATERNO20', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(21, 'RFC11', 'NOMBRE11', 'APATERNO11', 'AMATERNO11', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(22, 'RFC12', 'NOMBRE12', 'APATERNO12', 'AMATERNO12', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(23, 'RFC13', 'NOMBRE13', 'APATERNO13', 'AMATERNO13', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(24, 'RFC14', 'NOMBRE14', 'APATERNO14', 'AMATERNO14', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(25, 'RFC15', 'NOMBRE15', 'APATERNO15', 'AMATERNO15', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(26, 'RFC16', 'NOMBRE16', 'APATERNO16', 'AMATERNO16', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(27, 'RFC17', 'NOMBRE17', 'APATERNO17', 'AMATERNO17', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(28, 'RFC18', 'NOMBRE18', 'APATERNO18', 'AMATERNO18', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(29, 'RFC19', 'NOMBRE19', 'APATERNO19', 'AMATERNO19', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(30, 'RFC20', 'NOMBRE20', 'APATERNO20', 'AMATERNO20', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(31, 'RFC1', 'NOMBRE1', 'APATERNO1', 'AMATERNO1', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(32, 'RFC2', 'NOMBRE2', 'APATERNO2', 'AMATERNO2', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(33, 'RFC3', 'NOMBRE3', 'APATERNO3', 'AMATERNO3', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(34, 'RFC4', 'NOMBRE4', 'APATERNO4', 'AMATERNO4', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(35, 'RFC5', 'NOMBRE5', 'APATERNO5', 'AMATERNO5', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(36, 'RFC6', 'NOMBRE6', 'APATERNO6', 'AMATERNO6', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(37, 'RFC7', 'NOMBRE7', 'APATERNO7', 'AMATERNO7', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(38, 'RFC8', 'NOMBRE8', 'APATERNO8', 'AMATERNO8', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(39, 'RFC9', 'NOMBRE9', 'APATERNO9', 'AMATERNO9', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(40, 'RFC10', 'NOMBRE10', 'APATERNO10', 'AMATERNO10', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(41, 'RFC1', 'NOMBRE1', 'APATERNO1', 'AMATERNO1', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(42, 'RFC2', 'NOMBRE2', 'APATERNO2', 'AMATERNO2', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(43, 'RFC3', 'NOMBRE3', 'APATERNO3', 'AMATERNO3', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(44, 'RFC4', 'NOMBRE4', 'APATERNO4', 'AMATERNO4', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(45, 'RFC5', 'NOMBRE5', 'APATERNO5', 'AMATERNO5', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(46, 'RFC6', 'NOMBRE6', 'APATERNO6', 'AMATERNO6', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(47, 'RFC7', 'NOMBRE7', 'APATERNO7', 'AMATERNO7', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(48, 'RFC8', 'NOMBRE8', 'APATERNO8', 'AMATERNO8', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(49, 'RFC9', 'NOMBRE9', 'APATERNO9', 'AMATERNO9', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(50, 'RFC10', 'NOMBRE10', 'APATERNO10', 'AMATERNO10', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(51, 'RFC11', 'NOMBRE11', 'APATERNO11', 'AMATERNO11', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(52, 'RFC12', 'NOMBRE12', 'APATERNO12', 'AMATERNO12', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(53, 'RFC13', 'NOMBRE13', 'APATERNO13', 'AMATERNO13', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(54, 'RFC14', 'NOMBRE14', 'APATERNO14', 'AMATERNO14', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(55, 'RFC15', 'NOMBRE15', 'APATERNO15', 'AMATERNO15', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(56, 'RFC16', 'NOMBRE16', 'APATERNO16', 'AMATERNO16', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(57, 'RFC17', 'NOMBRE17', 'APATERNO17', 'AMATERNO17', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(58, 'RFC18', 'NOMBRE18', 'APATERNO18', 'AMATERNO18', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(59, 'RFC19', 'NOMBRE19', 'APATERNO19', 'AMATERNO19', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(60, 'RFC20', 'NOMBRE20', 'APATERNO20', 'AMATERNO20', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com');

--
-- Restricciones para tablas volcadas
--

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
