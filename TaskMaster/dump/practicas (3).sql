-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-05-2024 a las 15:36:41
-- Versión del servidor: 8.0.36-2ubuntu3
-- Versión de PHP: 8.3.6

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
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id_archivo` int NOT NULL,
  `nombre_archivo` blob NOT NULL,
  `id_evento` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id_archivo`, `nombre_archivo`, `id_evento`) VALUES
(1, 0x2e2e2f6669636865726f732f466564657269636f2044656c2070696e6f2073616e6368657a2e706466, 1),
(2, 0x2e2e2f6669636865726f732f41335f416c62615f44656c5f50696e6f5f416c756d6e6f202831292e706466, 1),
(3, 0x2e2e2f6669636865726f732f41335f416c62615f44656c5f50696e6f5f416c756d6e6f202831292e706466, 4),
(4, 0x2e2e2f6669636865726f732f466564657269636f2044656c2070696e6f2073616e6368657a2e706466, 4),
(5, 0x2e2e2f6669636865726f732f466564657269636f2044656c2070696e6f2073616e6368657a2e706466, 6),
(6, 0x2e2e2f6669636865726f732f41335f416c62615f44656c5f50696e6f5f416c756d6e6f202831292e706466, 7),
(7, 0x2e2e2f6669636865726f732f696d616765732e706e67, 12),
(8, 0x2e2e2f6669636865726f732f4d616e6966696573746f5f32303234353230313533382e706466, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `id_chat` int NOT NULL,
  `id_evento` int NOT NULL,
  `id_usuario` int NOT NULL,
  `mensaje` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `fecha_envio` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`id_chat`, `id_evento`, `id_usuario`, `mensaje`, `fecha_envio`) VALUES
(1, 6, 1, 'tyry', '2024-05-18 15:39:21'),
(2, 6, 2, 'try', '2024-05-18 15:39:25'),
(3, 6, 1, 'ytr', '2024-05-18 15:39:29'),
(4, 6, 2, 'gfdgd', '2024-05-18 15:43:51'),
(5, 6, 1, 'kjhkhj', '2024-05-18 15:43:55'),
(6, 6, 1, 'kjhkhj', '2024-05-18 15:43:58'),
(7, 6, 1, 'kjhkhj', '2024-05-18 15:44:00'),
(8, 6, 2, 'gfdgd', '2024-05-18 15:44:02'),
(9, 6, 2, 'hkhj', '2024-05-18 15:46:00'),
(10, 6, 1, 'khjk', '2024-05-18 15:46:02'),
(11, 6, 1, 'wrwe', '2024-05-21 11:05:48'),
(12, 6, 1, 'rwer', '2024-05-21 11:05:50'),
(13, 6, 1, 'rtyrty', '2024-05-21 11:08:20'),
(14, 6, 1, 'yrty', '2024-05-21 11:08:22'),
(15, 6, 1, 'yrt', '2024-05-21 11:08:25'),
(16, 6, 1, 'yrt', '2024-05-21 11:08:26'),
(17, 6, 1, 'yrt', '2024-05-21 11:08:28'),
(18, 6, 1, 'yrt', '2024-05-21 11:08:30'),
(19, 6, 1, 'fsdf\r\npp+\r\n', '2024-05-21 11:12:36'),
(20, 7, 1, 'tertert', '2024-05-21 11:29:44'),
(21, 6, 2, 'tert', '2024-05-21 14:33:59'),
(22, 6, 1, 'hfgh\r\n', '2024-05-21 14:34:08'),
(23, 6, 1, 'hfghfghfhgfghfghfghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', '2024-05-21 14:34:19'),
(24, 6, 1, 'gfdg xgdf dfgdf dfgfdgdf fgdgfd', '2024-05-21 14:47:50'),
(25, 6, 1, 'gdfgdfg gdfgfd gdfg gfdg gdgffd gdgdf gfdfgdf gdfgfd gdfgdf gfdgdfg gfdgdf gfdgdf gfdgfd ', '2024-05-21 14:48:06'),
(26, 6, 1, 'Hola', '2024-05-27 07:41:47'),
(31, 12, 2, 'hola', '2024-05-27 12:55:51'),
(33, 12, 2, 'No he estado ocupado esta semana', '2024-05-27 12:56:26'),
(35, 12, 1, 'Hola', '2024-05-27 14:27:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id_ciudad` int NOT NULL,
  `nombre_ciudad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id_ciudad`, `nombre_ciudad`) VALUES
(1, 'Madrid'),
(2, 'Barcelona'),
(3, 'Valencia'),
(4, 'Sevilla'),
(5, 'Málaga'),
(6, 'Zaragoza'),
(7, 'Bilbao'),
(8, 'Alicante'),
(9, 'Granada'),
(10, 'Romero'),
(11, 'Hernández'),
(12, 'Navarro'),
(13, 'Silva'),
(14, 'López'),
(15, 'García'),
(16, 'Fuentes'),
(17, 'Sánchez'),
(18, 'Martínez'),
(19, 'Torres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int NOT NULL,
  `nombre_estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre_estado`) VALUES
(1, 'Pendiente'),
(2, 'En proceso'),
(3, 'Completado'),
(4, 'Detenido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `id_etiqueta` int NOT NULL,
  `nombre_etiqueta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descripcion_etiqueta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `etiquetas`
--

INSERT INTO `etiquetas` (`id_etiqueta`, `nombre_etiqueta`, `descripcion_etiqueta`) VALUES
(1, 'deporte', 'futpol'),
(2, 'Arte', 'Esta etiqueta se refiere a temas relacionados con el arte.'),
(3, 'Estudios', 'Esta etiqueta se refiere a temas relacionados con los estudios.'),
(4, 'Trabajo', 'Esta etiqueta se refiere a temas relacionados con el trabajo.'),
(5, 'Salud', 'Esta etiqueta se refiere a temas relacionados con la salud.'),
(6, 'Tecnología', 'Esta etiqueta se refiere a temas relacionados con la tecnología.'),
(7, 'Música', 'Esta etiqueta se refiere a temas relacionados con la música.'),
(8, 'Cocina', 'Esta etiqueta se refiere a temas relacionados con la cocina.'),
(9, 'Moda', 'Esta etiqueta se refiere a temas relacionados con la moda.'),
(10, 'Viajes', 'Esta etiqueta se refiere a temas relacionados con los viajes.');

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
(12, 'Investigación sobre IA', '#000000', '2024-06-01 00:00:00', '2024-06-07 00:00:00', 'Investigar sobre la historia de la inteligencia artificial y su impacto en la sociedad moderna.', NULL, 4, 1),
(13, 'Ensayo de Educación Ambiental', '#ec1818', '2024-05-08 00:00:00', '2024-05-14 00:00:00', ' Redactar un ensayo de 1500 palabras sobre la importancia de la educación ambiental en las escuelas.', NULL, 3, 3),
(14, ' Aprender a Tocar Guitarra', '#14d8ff', '2024-06-01 00:00:00', '2024-06-30 00:00:00', 'Inscribirse en un curso online para aprender a tocar la guitarra y practicar diariamente.', NULL, 7, 1),
(15, 'Presentación sobre Cambio Climático', '#46b96e', '2024-07-01 00:00:00', '2024-07-07 00:00:00', 'Preparar una presentación en PowerPoint sobre los efectos del cambio climático en los océanos.', NULL, 3, 1),
(16, 'Práctica de Idioma', '#ecb622', '2024-05-22 00:00:00', '2024-05-28 00:00:00', 'Dedicar 30 minutos diarios a practicar un nuevo idioma en una aplicación como Duolingo.', NULL, 3, 2),
(17, 'Organización del Escritorio', '#0326d3', '2024-05-16 00:00:00', '2024-05-17 00:00:00', 'Limpiar y organizar tu escritorio de trabajo o estudio.', NULL, 8, 3),
(18, 'Voluntariado', '#e60588', '2024-05-18 00:00:00', '2024-05-20 00:00:00', ' Dedicar una tarde a la semana para hacer trabajo voluntario en una organización local.', NULL, 4, 1),
(19, 'Cocinar una Nueva Receta', '#ca471c', '2024-05-14 00:00:00', '2024-05-15 00:00:00', 'Encontrar una receta que nunca hayas probado y cocinarla.', NULL, 8, 4),
(20, 'Proyecto de Bricolaje', '#97f298', '2024-05-28 00:00:00', '2024-06-01 00:00:00', 'Realizar un proyecto de bricolaje, como construir una estantería o decorar una habitación.', NULL, 3, 1),
(21, 'Planificación de un Viaje', '#f09e9e', '2024-05-02 00:00:00', '2024-05-03 00:00:00', 'Investigar y planificar un viaje a una ciudad que siempre has querido visitar.', NULL, 10, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `contraseña` varchar(8) NOT NULL,
  `ciudad` int NOT NULL,
  `correo_electronico` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `imagen` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `contraseña`, `ciudad`, `correo_electronico`, `imagen`) VALUES
(1, 'Alba', 'Ciges', '1234', 3, 'albadelpino1@gmail.com', 0x696d6167656e65732f757365725f6465666563746f2e706e67),
(2, 'Juan', 'Perez', '1234', 1, 'juan@gmail.com', 0x2e2e2f6669636865726f732f70657266696c2e6a7067),
(3, 'María', 'González', '1234', 2, 'maria@hotmail.com', NULL),
(4, 'Carlos', 'Sánchez', '1234', 3, 'carlos@gmail.com', NULL),
(5, 'Iker', 'Lopez', '1234', 9, 'ikerlopez@gmail.com', 0x696d6167656e65732f757365725f6465666563746f2e706e67),
(6, 'Pepe', 'Gomez', '1234', 6, 'pepe@gmail.com', 0x2e2e2f696d6167656e65732f757365725f6465666563746f2e706e67);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_evento`
--

CREATE TABLE `usuario_evento` (
  `id_usuario_evento` int NOT NULL,
  `id_evento` int NOT NULL,
  `id_usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario_evento`
--

INSERT INTO `usuario_evento` (`id_usuario_evento`, `id_evento`, `id_usuario`) VALUES
(13, 12, 1),
(14, 13, 1),
(15, 14, 1),
(16, 15, 1),
(17, 16, 1),
(18, 17, 1),
(19, 18, 1),
(20, 19, 1),
(21, 20, 1),
(22, 21, 1),
(23, 12, 2),
(24, 14, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `fk_archivo` (`id_archivo`);

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `fk_evento_chat` (`id_evento`),
  ADD KEY `fk_usuario_chat` (`id_usuario`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id_ciudad`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`id_etiqueta`);

--
-- Indices de la tabla `eventoscalendar`
--
ALTER TABLE `eventoscalendar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fk_id_evento` (`id`) USING BTREE,
  ADD KEY `fk_etiqueta` (`id_etiquetas`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `fk_evento` (`id`) USING BTREE,
  ADD KEY `fk_evento_chat` (`id`),
  ADD KEY `fk_archivo2` (`id`),
  ADD KEY `fk_evento_archivo` (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_ciudad` (`ciudad`),
  ADD KEY `fk_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario_evento`
--
ALTER TABLE `usuario_evento`
  ADD PRIMARY KEY (`id_usuario_evento`),
  ADD KEY `fk_evento` (`id_evento`) USING BTREE,
  ADD KEY `fk_usuario` (`id_usuario`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id_archivo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `eventoscalendar`
--
ALTER TABLE `eventoscalendar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario_evento`
--
ALTER TABLE `usuario_evento`
  MODIFY `id_usuario_evento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_usuario_chat` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_ciudad` FOREIGN KEY (`ciudad`) REFERENCES `ciudad` (`id_ciudad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
