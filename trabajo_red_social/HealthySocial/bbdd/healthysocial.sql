-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-01-2018 a las 11:14:52
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `healthysocial`
--
CREATE DATABASE IF NOT EXISTS `healthysocial` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `healthysocial`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentacion`
--

CREATE TABLE `alimentacion` (
  `id_contenido` int(11) NOT NULL,
  `dieta_estudio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `duracion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alimentacion`
--

INSERT INTO `alimentacion` (`id_contenido`, `dieta_estudio`, `tipo`, `duracion`) VALUES
(88, 'dieta', 'omnivora', '1semana'),
(89, 'cientifico', 'omnivora', '1semana'),
(95, 'dieta', 'omnivora', '1semana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigo`
--

CREATE TABLE `amigo` (
  `id_usuario_amigo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `amigo`
--

INSERT INTO `amigo` (`id_usuario_amigo`, `id_usuario`) VALUES
(1, 22),
(21, 1),
(21, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_contenido` int(11) NOT NULL,
  `texto` varchar(500) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `id_usuario`, `id_contenido`, `texto`) VALUES
(1, 1, 83, 'fdgsdg'),
(10, 1, 90, 'Hola esto es una prueba'),
(11, 1, 95, 'aqgadsd'),
(12, 1, 90, ''),
(13, 1, 90, 'Hola que tal'),
(14, 1, 90, 'Buenas tardes'),
(15, 1, 91, 'Hola que tal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE `contenido` (
  `id_contenido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `contenido`
--

INSERT INTO `contenido` (`id_contenido`, `id_usuario`, `descripcion`) VALUES
(82, 21, 'prueba'),
(83, 21, 'prueba'),
(84, 21, 'prueba'),
(85, 21, 'prueba'),
(86, 21, 'prueba'),
(87, 21, 'prueba'),
(88, 21, 'prueba'),
(89, 21, 'prueba'),
(90, 1, 'wfasf'),
(91, 1, 'fdg'),
(95, 1, 'ewqtqwetqwetwetweqtwet'),
(96, 21, 'Ultima publicacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportes`
--

CREATE TABLE `deportes` (
  `id_contenido` int(11) NOT NULL,
  `nivel` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `localizacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `duracion` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `deportes`
--

INSERT INTO `deportes` (`id_contenido`, `nivel`, `localizacion`, `tipo`, `duracion`) VALUES
(90, 'bajo', 'A CoruÃ±a', 'futbol', '23:57:00'),
(91, 'bajo', 'A CoruÃ±a', 'futbol', '01:57:00'),
(96, 'medio', 'Sevilla', 'Pádel', '00:56:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_contenido` int(11) NOT NULL,
  `url` text COLLATE utf8_spanish_ci NOT NULL,
  `formato` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tamano` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `foto`
--

INSERT INTO `foto` (`id_foto`, `id_usuario`, `id_contenido`, `url`, `formato`, `tamano`) VALUES
(1, 21, 89, 'data:image/jpeg;base64,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', '', 0),
(2, 1, 90, 'http://vidadehombre.com/wp-content/uploads/2017/02/hombre-corriendo.jpg', '', 0),
(3, 1, 91, 'https://run.guiafitness.com/wp-content/uploads/sites/17/2016/04/empezar-a-correr.jpg', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suplemento`
--

CREATE TABLE `suplemento` (
  `id_contenido` int(11) NOT NULL,
  `dosis` int(11) NOT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `duracion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ultimo_acceso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `localidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `password`, `tipo`, `nombre`, `email`, `sexo`, `ultimo_acceso`, `apellidos`, `localidad`, `fecha_alta`) VALUES
(1, 'gon', '$2y$10$5oj94q6tkxZfoIBuooWefuvgY2CuMCBk6e7rT2sqlYe1EKvM5zBxu', 'usuario', 'Gonzalo', 'gonzq@gmail.com', 'hombre', '2018-01-19 09:46:01', '', '', '0000-00-00 00:00:00'),
(19, 'admin', '$2y$10$oRrW/oOARFsdHdwBUMB5H.nyZp10kVK8gweABol/CR.DGNSFMHzja', 'administrador', 'Admin', 'admin@admin.com', 'hombre', '2018-01-15 19:39:18', 'admin', 'Sevilla', '0000-00-00 00:00:00'),
(21, 'susana', '$2y$10$K.ej5pkEMbn7NZzVtfGCpODC9a4AHWlNQ8ljZTULNpyIuHDYfDMJW', 'usuario', 'Susana', 'susana@gmail.com', 'mujer', '2018-01-17 21:05:30', 'iglesias', 'A CoruÃ±a', '2018-01-16 17:52:32'),
(22, 'maria', '$2y$10$IheRh8vjcGc9qeVFVWB/i.AP3DdiP/eXRlwtxWv0dlt3TDK2K9qWe', 'usuario', 'Maria', 'maria@maria.com', 'mujer', '2018-01-19 09:54:23', 'ladron', 'Sevilla', '2018-01-19 09:54:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voto`
--

CREATE TABLE `voto` (
  `id_voto` int(11) NOT NULL,
  `id_contenido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `voto`
--

INSERT INTO `voto` (`id_voto`, `id_contenido`, `id_usuario`) VALUES
(37, 90, 1),
(41, 91, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alimentacion`
--
ALTER TABLE `alimentacion`
  ADD KEY `FK_alimentacion_contenido` (`id_contenido`);

--
-- Indices de la tabla `amigo`
--
ALTER TABLE `amigo`
  ADD KEY `FK_usuario_amigo` (`id_usuario`),
  ADD KEY `FK_id_usuario_amigo` (`id_usuario_amigo`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `FK_comentario_usuario` (`id_usuario`),
  ADD KEY `FK_comentario_contenido` (`id_contenido`);

--
-- Indices de la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id_contenido`),
  ADD KEY `FK_usuario_contenido` (`id_usuario`);

--
-- Indices de la tabla `deportes`
--
ALTER TABLE `deportes`
  ADD KEY `FK_deportes_contenido` (`id_contenido`);

--
-- Indices de la tabla `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `FK_foto_usuario` (`id_usuario`),
  ADD KEY `FK_foto_contenido` (`id_contenido`);

--
-- Indices de la tabla `suplemento`
--
ALTER TABLE `suplemento`
  ADD KEY `FK_suplemento_contenido` (`id_contenido`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `voto`
--
ALTER TABLE `voto`
  ADD PRIMARY KEY (`id_voto`),
  ADD KEY `FK_voto_usuario` (`id_usuario`),
  ADD KEY `FK_voto_contenido` (`id_contenido`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id_contenido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `voto`
--
ALTER TABLE `voto`
  MODIFY `id_voto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alimentacion`
--
ALTER TABLE `alimentacion`
  ADD CONSTRAINT `FK_alimentacion_contenido` FOREIGN KEY (`id_contenido`) REFERENCES `contenido` (`id_contenido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `amigo`
--
ALTER TABLE `amigo`
  ADD CONSTRAINT `FK_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_usuario_amigo` FOREIGN KEY (`id_usuario_amigo`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `FK_comentario_contenido` FOREIGN KEY (`id_contenido`) REFERENCES `contenido` (`id_contenido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_comentario_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD CONSTRAINT `FK_usuario_contenido` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `deportes`
--
ALTER TABLE `deportes`
  ADD CONSTRAINT `FK_deportes_contenido` FOREIGN KEY (`id_contenido`) REFERENCES `contenido` (`id_contenido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `FK_foto_contenido` FOREIGN KEY (`id_contenido`) REFERENCES `contenido` (`id_contenido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_foto_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `suplemento`
--
ALTER TABLE `suplemento`
  ADD CONSTRAINT `FK_suplemento_contenido` FOREIGN KEY (`id_contenido`) REFERENCES `contenido` (`id_contenido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `voto`
--
ALTER TABLE `voto`
  ADD CONSTRAINT `FK_voto_contenido` FOREIGN KEY (`id_contenido`) REFERENCES `contenido` (`id_contenido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_voto_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
