
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-11-2016 a las 13:31:28
-- Versión del servidor: 10.0.20-MariaDB
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `u132504162_vehic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_acceso` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`,`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `clave`, `tipo_acceso`) VALUES
(1, 'Usuario', 'Admin', 'admin@test.com', '123', 'ADMIN'),
(2, 'Usuario', 'Usuario', 'usuario@test.com', '123', 'USER'),
(3, 'Mauro', 'Aquino', 'MAquino@playa.com', '1234', 'ADMIN'),
(4, 'Jose', 'Flores', 'JFlores@playa.com', '1234', 'USER'),
(5, 'Marta', 'Iglesias', 'MIglesias@playa.com', '1234', 'USER'),
(6, 'Navidad', 'Gonzales', 'NGonzales@playa.com', '1234', 'USER'),
(7, 'Julio', 'Martinez', 'JMartinez@playa.com', '1234', 'ADMIN'),
(8, 'Agustina', 'Cabrera', 'ACabrera@playa.com', '1234', 'USER'),
(9, 'Ramon', 'Quesada', 'RQuesada@playa.com', '1234', 'ADMIN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE IF NOT EXISTS `vehiculo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `patente` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `ingreso` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `egreso` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `importe_abonado` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id`, `patente`, `ingreso`, `egreso`, `importe_abonado`) VALUES
(4, 'AAASSS', '02-11-16 15:11:11', '02-11-16 16:17:25', '8'),
(5, 'AAABBB', '02-11-16 15:11:45', '02-11-16 16:38:17', '115.38'),
(6, 'JAF334', '02-11-16 16:11:42', '02-11-16 16:40:45', '38.73'),
(7, 'YUN124', '02-11-16 16:11:49', '02-11-16 16:38:51', '36.04'),
(8, 'MIL172', '02-11-16 16:11:38', '02-11-16 16:40:43', '38.78'),
(9, 'JAF112', '02-11-16 16:40:50', '02-11-16 16:46:32', '7.6'),
(10, 'JAF334', '02-11-16 16:41:05', '02-11-16 16:41:15', '0.22'),
(11, 'YUH123', '02-11-16 16:47:09', '02-11-16 16:47:11', '0.04'),
(12, 'AAAVED', '03-11-16 11:09:39', '03-11-16 11:40:45', '41.47'),
(13, 'CVR567', '03-11-16 11:09:47', '03-11-16 11:09:58', '0.24'),
(14, 'ADF123', '03-11-16 11:41:18', '03-11-16 13:59:28', '184.22'),
(15, 'AA344', '03-11-16 11:41:55', '03-11-16 14:00:15', '184.44'),
(16, 'ASDXZX', '03-11-16 11:41:59', '03-11-16 14:00:36', '184.82'),
(17, '23456', '03-11-16 11:42:03', '03-11-16 14:18:25', '208.49'),
(19, 'THY234', '03-11-16 14:13:35', '03-11-16 16:56:34', '217.31'),
(20, 'FRT555', '03-11-16 14:17:19', '03-11-16 14:17:28', '0.2'),
(21, '456TYG', '03-11-16 14:17:38', '03-11-16 14:21:46', '5.51'),
(22, 'AAASSS', '03-11-16 14:20:24', '03-11-16 14:21:59', '2.11'),
(23, 'TYG345', '03-11-16 14:20:30', '03-11-16 14:21:05', '0.78'),
(24, 'AAABBB', '03-11-16 14:20:38', '03-11-16 14:26:58', '8.44'),
(25, 'DSF234', '03-11-16 14:26:26', '03-11-16 15:13:06', '62.22'),
(26, 'ASD344', '03-11-16 14:26:29', NULL, NULL),
(27, 'HFG667', '03-11-16 14:26:33', '03-11-16 15:12:18', '61'),
(28, 'XCC333', '03-11-16 14:26:37', '03-11-16 14:27:09', '0.71'),
(29, 'AAASSS', '03-11-16 14:26:40', NULL, NULL),
(30, 'BBEER23', '03-11-16 14:26:44', '03-11-16 15:15:45', '65.36'),
(31, '123SSX', '03-11-16 14:26:47', NULL, NULL),
(32, 'FAS567', '03-11-16 14:26:51', '03-11-16 15:31:00', '85.53'),
(33, 'DDD444', '03-11-16 15:13:14', NULL, NULL),
(34, '556TYH', '03-11-16 15:30:54', NULL, NULL),
(35, 'XJP909', '03-11-16 16:13:54', '03-11-16 16:14:03', '0.2'),
(36, 'AD45GG', '03-11-16 16:56:17', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
