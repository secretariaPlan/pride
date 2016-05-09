-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-05-2016 a las 21:03:33
-- Versión del servidor: 5.6.28-0ubuntu0.15.10.1
-- Versión de PHP: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbpride`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `id` int(11) NOT NULL,
  `rfc` varchar(14) NOT NULL,
  `password` varchar(400) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apaterno` varchar(45) NOT NULL,
  `amaterno` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `rfc`, `password`, `nombre`, `apaterno`, `amaterno`) VALUES
(1, 'RFCADMIN', '1a1dc91c907325c69271ddf0c944bc72', 'Admin', 'Admin', 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE IF NOT EXISTS `archivo` (
  `id` int(6) NOT NULL,
  `id_evaluado` int(5) NOT NULL,
  `id_seccion` int(4) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `nombre_original` varchar(200) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id` int(5) NOT NULL,
  `id_usuario` int(6) NOT NULL COMMENT 'Autor del comentario',
  `id_evaluado` int(6) NOT NULL,
  `id_seccion` int(2) NOT NULL,
  `texto` varchar(500) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `id_usuario`, `id_evaluado`, `id_seccion`, `texto`, `fecha`) VALUES
(1, 11, 1, 1, 'sdfsdfsdf', '2016-03-08 07:24:58'),
(2, 11, 1, 1, 'Prueba 2', '2016-03-08 18:49:50'),
(3, 11, 1, 1, 'Prueba', '2016-03-09 01:40:32'),
(4, 11, 1, 1, 'Otro', '2016-03-09 01:41:36'),
(5, 11, 1, 1, 'Otro', '2016-03-09 01:44:12'),
(6, 11, 1, 1, 'Prueba', '2016-03-09 02:47:33'),
(7, 11, 1, 1, 'Prueba', '2016-03-09 02:57:29'),
(8, 11, 1, 1, 'Otra cosa', '2016-03-09 02:57:40'),
(9, 11, 1, 1, 'Otro', '2016-03-09 03:10:52'),
(10, 11, 1, 4, 'Prueba', '2016-03-09 05:25:27'),
(11, 11, 1, 3, 'Pruebas', '2016-03-09 05:36:33'),
(12, 11, 1, 7, 'Otra Prueba', '2016-03-09 05:38:20'),
(13, 11, 1, 2, 'Algo', '2016-03-09 05:42:25'),
(14, 11, 1, 6, 'kjashdfjkhasdf', '2016-03-09 05:44:11'),
(15, 11, 1, 5, 'fsfsdfgsdf', '2016-03-09 05:45:33'),
(16, 1, 1, 1, 'Desde el evaluador', '2016-03-10 04:16:25'),
(18, 1, 1, 2, 'Desde el evaluador', '2016-03-10 04:30:12'),
(19, 1, 1, 4, 'Desde el evaluador', '2016-03-10 04:34:16'),
(20, 1, 1, 5, 'Desde el evaluador', '2016-03-10 04:35:24'),
(21, 1, 1, 6, 'Desde el evaluador', '2016-03-10 04:36:38'),
(22, 1, 1, 7, 'Desde el evaluador', '2016-03-10 04:38:09'),
(23, 1, 1, 3, 'Desde el evaluador', '2016-03-10 04:39:05'),
(24, 1, 2, 1, 'Algo', '2016-03-10 04:42:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comision`
--

CREATE TABLE IF NOT EXISTS `comision` (
  `id` int(11) NOT NULL,
  `comision` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

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
(10, 20, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluador`
--

CREATE TABLE IF NOT EXISTS `evaluador` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

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
(10, 10, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluador_evaluado`
--

CREATE TABLE IF NOT EXISTS `evaluador_evaluado` (
  `id` int(11) NOT NULL,
  `id_evaluador` int(11) NOT NULL,
  `id_evaluado` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evaluador_evaluado`
--

INSERT INTO `evaluador_evaluado` (`id`, `id_evaluador`, `id_evaluado`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE IF NOT EXISTS `periodo` (
  `id` int(11) NOT NULL,
  `year` varchar(4) NOT NULL,
  `numero` enum('1','2') NOT NULL,
  `inicioper` date NOT NULL,
  `finper` date NOT NULL,
  `inicioeval` date NOT NULL,
  `fineval` date NOT NULL,
  `inicioentrega` date NOT NULL,
  `finentrega` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id`, `year`, `numero`, `inicioper`, `finper`, `inicioeval`, `fineval`, `inicioentrega`, `finentrega`) VALUES
(1, '2016', '1', '2016-03-01', '2016-05-31', '2016-04-03', '2016-04-27', '2016-05-01', '2016-05-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE IF NOT EXISTS `seccion` (
  `id` int(2) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id`, `nombre`) VALUES
(1, 'Formacion y Trayectoria Academica'),
(2, 'Productividad Academica'),
(3, 'Material Docente'),
(4, 'Formacion de Recursos Humanos'),
(5, 'Docencia'),
(6, 'Difusion'),
(7, 'Particicipacion Institucional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id` int(2) NOT NULL,
  `tipo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `tipo`) VALUES
(1, 'Evaluador'),
(2, 'Evaluado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `rfc` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apaterno` varchar(45) NOT NULL,
  `amaterno` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `rfc`, `nombre`, `apaterno`, `amaterno`, `password`, `correo`) VALUES
(1, 'AABC600614PP5', 'NOMBRE1', 'APATERNO1', 'AMATERNO1', '1a1dc91c907325c69271ddf0c944bc72', 'correo1@correo.com'),
(2, 'AABK810313S31', 'NOMBRE2', 'APATERNO2', 'AMATERNO2', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(3, 'AACJ521125S58', 'NOMBRE3', 'APATERNO3', 'AMATERNO3', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(4, 'AACM331122BE3', 'NOMBRE4', 'APATERNO4', 'AMATERNO4', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(5, 'AACN651007D79', 'NOMBRE5', 'APATERNO5', 'AMATERNO5', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(6, 'AACR4204067V0', 'NOMBRE6', 'APATERNO6', 'AMATERNO6', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(7, 'AADA490319HM4', 'NOMBRE7', 'APATERNO7', 'AMATERNO7', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(8, 'AADI3807107R4', 'NOMBRE8', 'APATERNO8', 'AMATERNO8', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(9, 'AAEA6308249F2', 'NOMBRE9', 'APATERNO9', 'AMATERNO9', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(10, 'AAEC7309179T7', 'NOMBRE10', 'APATERNO10', 'AMATERNO10', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(11, 'GORJ510210KX6', 'NOMBRE11', 'APATERNO11', 'AMATERNO11', '1a1dc91c907325c69271ddf0c944bc72', 'correo1@correo.com'),
(12, 'GORL620111PT5', 'NOMBRE12', 'APATERNO12', 'AMATERNO12', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(13, 'GORX830712DA9', 'NOMBRE13', 'APATERNO13', 'AMATERNO13', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(14, 'GOSC800621M33', 'NOMBRE14', 'APATERNO14', 'AMATERNO14', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(15, 'GOSE720302PF8', 'NOMBRE15', 'APATERNO15', 'AMATERNO15', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(16, 'GOSL7106084B0', 'NOMBRE16', 'APATERNO16', 'AMATERNO16', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(17, 'GOTE681027K25', 'NOMBRE17', 'APATERNO17', 'AMATERNO17', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(18, 'GOVH290203UZ0', 'NOMBRE18', 'APATERNO18', 'AMATERNO18', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(19, 'GUAA680821386', 'NOMBRE19', 'APATERNO19', 'AMATERNO19', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com'),
(20, 'GUAC7607197P1', 'NOMBRE20', 'APATERNO20', 'AMATERNO20', '35f504164d5a963d6a820e71614a4009', 'correo1@correo.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`,`rfc`);

--
-- Indices de la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evaluado` (`id_evaluado`,`id_seccion`),
  ADD KEY `archivo_seccion` (`id_seccion`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`,`id_evaluado`,`id_seccion`),
  ADD KEY `comentario_evaluado` (`id_evaluado`),
  ADD KEY `comentario_seccion` (`id_seccion`);

--
-- Indices de la tabla `comision`
--
ALTER TABLE `comision`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluado`
--
ALTER TABLE `evaluado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_periodo` (`id_periodo`),
  ADD KEY `id_comision` (`id_comision`);

--
-- Indices de la tabla `evaluador`
--
ALTER TABLE `evaluador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_periodo` (`id_periodo`),
  ADD KEY `id_comision` (`id_comision`);

--
-- Indices de la tabla `evaluador_evaluado`
--
ALTER TABLE `evaluador_evaluado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evaluador` (`id_evaluador`),
  ADD KEY `id_evaluado` (`id_evaluado`),
  ADD KEY `id_evaluador_2` (`id_evaluador`),
  ADD KEY `id_evaluado_2` (`id_evaluado`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`,`rfc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `archivo`
--
ALTER TABLE `archivo`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `comision`
--
ALTER TABLE `comision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `evaluado`
--
ALTER TABLE `evaluado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `evaluador`
--
ALTER TABLE `evaluador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `evaluador_evaluado`
--
ALTER TABLE `evaluador_evaluado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD CONSTRAINT `archivo_evaluado` FOREIGN KEY (`id_evaluado`) REFERENCES `evaluado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `archivo_seccion` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_evaluado` FOREIGN KEY (`id_evaluado`) REFERENCES `evaluado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `comentario_seccion` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `comentario_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `evaluado_eval_fk` FOREIGN KEY (`id_evaluado`) REFERENCES `evaluado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `evaluador_eval_fk` FOREIGN KEY (`id_evaluador`) REFERENCES `evaluador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
