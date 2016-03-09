-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-03-2016 a las 15:43:39
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
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`,`rfc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
