-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2018 a las 20:40:12
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
(37, 'dfgdag', '', ''),
(38, 'dieta', '', ''),
(39, 'cientifico', '', ''),
(42, 'dieta', '', ''),
(47, 'dieta', '', ''),
(48, 'dieta', '', ''),
(49, 'dieta', '', ''),
(50, 'dieta', '', ''),
(51, 'cientifico', '', ''),
(53, 'dieta', '', ''),
(55, 'dieta', '', ''),
(56, 'cientifico', '', ''),
(57, 'dieta', '', ''),
(60, 'dieta', '', ''),
(25, 'sdaf', 'sadf', 'asdfsdf'),
(66, 'cientifico', 'omnivora', '1semana'),
(67, 'dieta', 'omnivora', '1semana'),
(68, 'dieta', 'omnivora', '1semana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigo`
--

CREATE TABLE `amigo` (
  `id_usuario_amigo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(25, 1, ''),
(26, 1, ''),
(27, 1, ''),
(28, 1, ''),
(29, 1, ''),
(30, 1, ''),
(31, 1, ''),
(33, 1, ''),
(34, 1, ''),
(35, 1, ''),
(36, 1, ''),
(37, 1, ''),
(38, 1, ''),
(39, 1, ''),
(40, 1, ''),
(41, 1, ''),
(42, 1, ''),
(43, 1, ''),
(44, 1, ''),
(45, 1, ''),
(46, 1, ''),
(47, 1, ''),
(48, 1, ''),
(49, 1, ''),
(50, 1, ''),
(51, 1, ''),
(52, 1, ''),
(53, 1, ''),
(54, 1, ''),
(55, 1, ''),
(56, 1, ''),
(57, 1, ''),
(58, 1, ''),
(59, 1, ''),
(60, 1, 'gjfgjgfgj'),
(61, 1, 'fdshdfhf'),
(62, 1, 'sadfsdafdf'),
(63, 1, 'sdaf'),
(64, 1, 'sadf'),
(65, 1, 'sadfsdfs'),
(66, 1, 'sdafsdfsd'),
(67, 1, 'dsf'),
(68, 1, 'sdafdsf');

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
(30, 'dfg', 'dsfg', '', '00:00:00'),
(43, 'bajo', 'Sevilla', '', '00:00:00'),
(52, 'medio', 'Sevilla', '', '00:00:00'),
(54, 'medio', 'sevilla', '', '00:00:00'),
(58, 'bajo', 'sadfdf', '', '00:00:00'),
(59, 'bajo', 'sdfa', '', '00:00:00'),
(25, 'sdf', 'sdaf', 'sdaf', '06:09:00'),
(61, 'bajo', 'A CoruÃ±a', 'futbol', '21:14:00'),
(62, 'bajo', 'Cuenca', 'futbol', '21:15:00'),
(63, 'bajo', 'A CoruÃ±a', 'futbol', '21:20:00'),
(64, 'bajo', 'A CoruÃ±a', 'futbol', '21:22:00'),
(65, 'bajo', 'A CoruÃ±a', 'futbol', '00:59:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_contenido` int(11) NOT NULL,
  `url` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `formato` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tamano` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `foto`
--

INSERT INTO `foto` (`id_foto`, `id_usuario`, `id_contenido`, `url`, `formato`, `tamano`) VALUES
(4, 1, 48, 'sdf', '', 0),
(5, 1, 49, '', '', 0),
(6, 1, 50, 'wewer', '', 0);

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

--
-- Volcado de datos para la tabla `suplemento`
--

INSERT INTO `suplemento` (`id_contenido`, `dosis`, `tipo`, `duracion`) VALUES
(38, 45, '', ''),
(38, 43, '', ''),
(44, 2, '', '');

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
  `localidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `password`, `tipo`, `nombre`, `email`, `sexo`, `ultimo_acceso`, `apellidos`, `localidad`) VALUES
(1, 'gon', '$2y$10$5oj94q6tkxZfoIBuooWefuvgY2CuMCBk6e7rT2sqlYe1EKvM5zBxu', 'usuario', 'Gonzalo', 'gonzq@gmail.com', 'hombre', '2018-01-15 19:34:12', '', ''),
(19, 'admin', '$2y$10$oRrW/oOARFsdHdwBUMB5H.nyZp10kVK8gweABol/CR.DGNSFMHzja', 'administrador', 'Admin', 'admin@admin.com', 'hombre', '2018-01-15 19:39:18', 'admin', 'Sevilla');

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
(1, 47, 1),
(2, 37, 1),
(3, 30, 1);

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
  ADD PRIMARY KEY (`id_usuario_amigo`),
  ADD KEY `FK_usuario_amigo` (`id_usuario`);

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
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id_contenido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `voto`
--
ALTER TABLE `voto`
  MODIFY `id_voto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `FK_usuario_amigo` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

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
