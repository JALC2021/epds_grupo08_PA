-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-01-2018 a las 17:11:19
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticasapp`
--

CREATE TABLE `estadisticasapp` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `id_baja` int(11) NOT NULL,
  `num_motivo` int(2) NOT NULL,
  `nota` int(2) NOT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecha_baja` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estadisticasapp`
--

INSERT INTO `estadisticasapp` (`id_usuario`, `nombre`, `apellidos`, `email`, `sexo`, `id_baja`, `num_motivo`, `nota`, `fecha_alta`, `fecha_baja`) VALUES
(21, 'Susana', 'iglesias', 'susana@gmail.com', 'mujer', 1, 3, 6, '2018-01-16 17:52:32', '2018-01-20 21:46:47'),
(25, 'Marcos', 'suarez', 'marcos@gmail.com', 'mujer', 2, 2, 5, '2018-01-20 21:49:59', '2018-01-20 21:51:25'),
(26, 'Daniel', 'iglesias', 'dani@gmail.com', 'hombre', 3, 1, 9, '2018-01-20 21:54:20', '2018-01-20 21:54:48'),
(27, 'Manuela', 'giraldez', 'manuela@hotmail.com', 'mujer', 4, 1, 6, '2018-01-20 21:55:52', '2018-01-20 21:56:12'),
(28, 'Simon', 'galdos', 'sim@gmail.com', 'hombre', 5, 1, 8, '2018-01-20 21:57:19', '2018-01-20 21:57:52'),
(24, 'Merche', 'suarez', 'merche@hotmail.com', 'mujer', 6, 2, 7, '2018-01-20 19:50:23', '2018-01-20 22:19:48'),
(29, 'Susana', 'iglesias', 'susana@hotmail.com', 'mujer', 7, 2, 5, '2018-01-21 09:19:41', '2018-01-21 09:29:03'),
(30, 'Susana', 'Iglesias', 'susana@hotmail.com', 'mujer', 8, 2, 3, '2018-01-21 09:30:56', '2018-01-21 09:31:43'),
(31, 'Susana', 'de la cale', 'susan@hotmail.com', 'mujer', 9, 2, 5, '2018-01-21 09:34:22', '2018-01-21 09:34:34'),
(32, 'Susana', 'iglesias', 'susana@hotmail.com', 'mujer', 10, 2, 6, '2017-12-21 10:12:41', '2018-01-21 12:46:00'),
(33, 'Juan', 'lopez', 'juan@hotmail.es', 'hombre', 11, 3, 8, '2017-01-21 10:13:38', '2018-01-21 12:46:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_contenido` int(11) NOT NULL,
  `url` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo`
--

CREATE TABLE `motivo` (
  `id_motivo` int(2) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `motivo`
--

INSERT INTO `motivo` (`id_motivo`, `descripcion`) VALUES
(1, 'La aplicación no es sencilla, intuitiva y/o no tiene un diseño atractivo'),
(2, 'La aplicación ha fallado en varias ocasiones'),
(3, 'Motivos personales ajenos a la aplicación');

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
(23, 'admin', 'admin', 'administrador', 'admin', 'admin@gmail.com', 'mujer', '2018-01-21 12:42:00', 'perez', 'sevilla', '2017-12-21 10:35:32'),
(34, 'susana', '$2y$10$Md36VUFyHEuQJEbqJ/vGCuDZus1x6JrkXsYZTiZMwXrHSo8dUTgBG', 'administrador', 'Susana', 'susana@gmail.com', 'mujer', '2018-01-21 16:09:50', 'iglesias', 'A CoruÃ±a', '2018-01-21 12:51:08'),
(35, 'juan', '$2y$10$wl4ZWCYB/dNzDBuP4dJCFuB1ZDGHY/BGWtzwlLHGXlMPysOC1s3M.', 'usuario', 'Juan', 'juan@hotmail.es', 'hombre', '2018-01-21 12:57:29', 'perez', 'A CoruÃ±a', '2018-01-21 12:57:02');

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
-- Indices de la tabla `estadisticasapp`
--
ALTER TABLE `estadisticasapp`
  ADD PRIMARY KEY (`id_baja`),
  ADD KEY `num_motivo` (`num_motivo`);

--
-- Indices de la tabla `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `FK_foto_usuario` (`id_usuario`),
  ADD KEY `FK_foto_contenido` (`id_contenido`);

--
-- Indices de la tabla `motivo`
--
ALTER TABLE `motivo`
  ADD PRIMARY KEY (`id_motivo`);

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
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id_contenido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estadisticasapp`
--
ALTER TABLE `estadisticasapp`
  MODIFY `id_baja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `voto`
--
ALTER TABLE `voto`
  MODIFY `id_voto` int(11) NOT NULL AUTO_INCREMENT;
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
-- Filtros para la tabla `estadisticasapp`
--
ALTER TABLE `estadisticasapp`
  ADD CONSTRAINT `estadisticasapp_ibfk_1` FOREIGN KEY (`num_motivo`) REFERENCES `motivo` (`id_motivo`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
