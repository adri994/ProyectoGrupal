-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-12-2020 a las 17:40:15
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `covid_usuario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Apellido_1` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Apellido_2` varchar(30) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Email` varchar(60) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Contrasena` varchar(8) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Roll` varchar(13) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`ID`, `Nombre`, `Apellido_1`, `Apellido_2`, `Email`, `Contrasena`, `Roll`) VALUES
(2, 'Adrian', 'Duran', 'Gomez', 'duranadria99@gmail.com', '12345678', 'Administrador'),
(3, 'adrian', 'gomez', 'jose', 'asajsnaj@gmail.com', '87654321', 'Rastreador'),
(4, 'Enrique', 'Montalvo', 'Lahera', 'enrique.montalvo@scs.es', 'enmo.123', 'Médico');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
