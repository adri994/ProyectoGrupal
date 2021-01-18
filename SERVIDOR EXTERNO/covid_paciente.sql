-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-01-2021 a las 21:01:47
-- Versión del servidor: 10.3.27-MariaDB-0+deb10u1
-- Versión de PHP: 7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `covid_paciente`
--
CREATE DATABASE IF NOT EXISTS `covid_paciente` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `covid_paciente`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `id` int(11) NOT NULL,
  `dni_paciente` varchar(9) NOT NULL,
  `nota` varchar(2000) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`id`, `dni_paciente`, `nota`, `id_usuario`, `fecha`, `estado`) VALUES
(1, '12345678X', 'Chungo', 3, '2020-12-21 15:55:24', 'contagiado'),
(2, '45621188R', 'Este la palma seguro. Esta con la muerte pintada en la cara.', 3, '2020-12-21 21:28:35', 'contagiado'),
(3, '12456835S', 'Esta mujer igual escapa.', 3, '2020-12-21 21:44:04', 'contagiado'),
(4, '22511312J', 'El de la musiquita', 3, '2020-12-21 21:46:54', 'contagiado'),
(5, '84562325I', 'El de la musiquita', 4, '2020-12-21 21:47:52', 'contagiado'),
(6, '11222333O', 'Arreglame el motor, que se me sale el agua por el carburador!!!', 3, '2020-12-21 21:50:53', 'contagiado'),
(7, '41312199M', 'Godo profundo.', 3, '2020-12-21 21:52:50', 'contagiado'),
(8, '78543215D', '', 3, '2020-12-21 21:57:10', 'contagiado'),
(9, '45675312Y', 'Asintomática', 3, '2020-12-21 22:03:46', 'contagiado'),
(10, '10231815M', 'No lo vió venir...', 3, '2020-12-21 22:05:37', 'contagiado'),
(11, '45621188R', 'Pues al final va a ser que no la palma. Se ha maquillado y tiene mejor pinta. Igual escapa', 4, '2020-12-22 09:14:17', 'contagiado'),
(12, '45621188R', 'Y se curó el tío. Nada, a seguir cobrando la pensión!!!', 4, '2020-12-29 13:18:25', 'curado'),
(18, '78131131V', 'Se recuperará', 3, '2020-12-22 14:22:03', 'contagiado'),
(19, '78131131V', 'El paciente presenta bastante mejoría y da negativo en PCR.', 4, '2020-12-22 14:25:06', 'contagiado'),
(20, '78131131V', 'Al fin curado', 4, '2020-12-30 11:10:24', 'curado'),
(21, '10231815M', 'El estado del paciente ha empeorado en las últimas 24h. Ha sido enviado a UCI e intubado. En estos momentos necesita respiración asistida. Si su estado no mejora en las próximas 12h se procederá a su sedación.', 4, '2021-01-02 20:36:15', 'contagiado'),
(22, '84562325I', 'La paciente presenta desde hace días una notable mejoría. La prueba diagnóstica de <i>Reacción en Cadena de Polimerasa</i> ha dado como resultado negativo en presecia de virus, por lo que será dada de alta en las próximas horas.', 4, '2021-01-02 20:41:17', 'curado'),
(23, '11222333O', 'Paciente con un cuadro clínico crítico. Con ventilación asistida y sedación en los últimos 4 días. No presenta reacción a estímulos. Declarada la defuncióna a las 15:35 horas del día 21 de diciembre de 2020.', 4, '2021-01-02 20:43:42', 'fallecido'),
(24, '12456835S', 'El paciente mantiene su estado. Sigue intubado y con pirexia de 39.2 celsius.', 4, '2021-01-02 20:45:31', 'contagiado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `dni` varchar(9) NOT NULL,
  `codigo_acceso` varchar(8) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido_1` varchar(100) NOT NULL,
  `apellido_2` varchar(100) DEFAULT NULL,
  `telefono` varchar(12) NOT NULL,
  `estado` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`dni`, `codigo_acceso`, `email`, `nombre`, `apellido_1`, `apellido_2`, `telefono`, `estado`) VALUES
('10231815M', '1ee9b48b', 'ocdelfuturo@gmail.com', 'Octavio', 'Acebes', '', '456753159', 'contagiado'),
('11222333O', '84384847', 'adlc@gmail.com', 'Andrés', 'de la Cuadra', 'Carballo', '922333444', 'fallecido'),
('12345678X', '5e527874', 'x@x.com', 'Jose', 'Manuel', 'Luis', '123456789', 'contagiado'),
('12456835S', 'd222674b', '', 'Juana', 'Diaz', 'Luis', '928223222', 'contagiado'),
('22511312J', '2fbc32f4', 'serranin@outlook.com', 'Ismael', 'Serrano', '', '600600601', 'contagiado'),
('41312199M', '9f5d0c6d', 'pag@gmail.com', 'Pedro', 'Alarcón', 'Gutierrez', '919089093', 'contagiado'),
('45621188R', 'f7158e0a', 'anmar@gmail.com', 'Antonio', 'Martín', 'Martín', '661113225', 'curado'),
('45675312Y', 'a52af585', 'AaAlB@OUTLOOK.COM', 'Adriana', 'Alabarez', 'Albarado', '123456789', 'contagiado'),
('78131131V', '11c7edbe', 'fsguerra@yahoo.es', 'Fermín', 'Suarez', 'Guerra', '666777222', 'curado'),
('78543215D', 'e843c2c6', 'fcm@gmail.com', 'Fernando', 'de las Casas', 'Martínez', '456123852', 'contagiado'),
('84562325I', '5ec20dfc', 'LPP@gmail.com', 'Laura', 'Perez', 'Perez', '765432122', 'curado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nota_paciente_fk` (`dni_paciente`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`dni`),
  ADD UNIQUE KEY `cod_acceso` (`codigo_acceso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_paciente_fk` FOREIGN KEY (`dni_paciente`) REFERENCES `paciente` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
