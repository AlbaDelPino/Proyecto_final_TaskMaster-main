-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 10-04-2024 a las 19:14:55
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practicas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventoscalendar`
--

CREATE TABLE `eventoscalendar` (
  `id` int NOT NULL,
  `evento` varchar(250) DEFAULT NULL,
  `color_evento` varchar(20) DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `archivos` blob,
  `id_etiquetas` int DEFAULT NULL,
  `id_estado` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `eventoscalendar`
--

INSERT INTO `eventoscalendar` (`id`, `evento`, `color_evento`, `fecha_inicio`, `fecha_fin`, `descripcion`, `archivos`, `id_etiquetas`, `id_estado`) VALUES
(1, 'das', '#e50b0b', '2024-04-03 00:00:00', '2024-04-04 00:00:00', 'dasd', 0x2e2e2f6669636865726f732f41335f416c62615f44656c5f50696e6f5f416c756d6e6f2e706466, 1, 1),
(2, 'das', '#e50b0b', '2024-04-03 00:00:00', '2024-04-04 00:00:00', 'dasd', 0x2e2e2f6669636865726f732f41335f416c62615f44656c5f50696e6f5f416c756d6e6f2e706466, 1, 1),
(3, 'das', '#e50b0b', '2024-04-03 00:00:00', '2024-04-04 00:00:00', 'dasd', 0x2e2e2f6669636865726f732f41335f416c62615f44656c5f50696e6f5f416c756d6e6f2e706466, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `eventoscalendar`
--
ALTER TABLE `eventoscalendar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_etiqueta` (`id_etiquetas`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `fk_evento` (`id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `eventoscalendar`
--
ALTER TABLE `eventoscalendar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
