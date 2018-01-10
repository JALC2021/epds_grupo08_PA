-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2018 a las 21:58:38
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
  `dieta_estudio` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alimentacion`
--

INSERT INTO `alimentacion` (`id_contenido`, `dieta_estudio`) VALUES
(37, 'dfgdag'),
(38, 'dieta'),
(39, 'cientifico'),
(42, 'dieta'),
(47, 'dieta'),
(48, 'dieta'),
(49, 'dieta'),
(50, 'dieta'),
(51, 'cientifico');

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
(1, 4);

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
(1, 3, 39, 'dsgfsad'),
(2, 3, 39, 'dsgfsad'),
(3, 3, 38, 'dsgfsad'),
(4, 3, 38, 'dsgfsad'),
(5, 3, 39, 'dsgfsad'),
(6, 3, 38, 'dsgfsad'),
(7, 3, 39, 'dsgfsad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE `contenido` (
  `id_contenido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `duracion` time NOT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `contenido`
--

INSERT INTO `contenido` (`id_contenido`, `id_usuario`, `duracion`, `tipo`) VALUES
(25, 1, '01:59:00', 'sdaf'),
(26, 1, '00:58:00', 'sdAF'),
(27, 1, '23:01:00', 'sdaf'),
(28, 1, '01:58:00', 'sdAF'),
(29, 1, '23:01:00', 'sdaf'),
(30, 1, '00:59:00', 'fdg'),
(31, 1, '00:58:00', 'sdAF'),
(33, 1, '23:01:00', 'sdaf'),
(34, 1, '23:01:00', 'gdas'),
(35, 1, '00:58:00', 'gdsf'),
(36, 1, '01:58:00', 'sdfa'),
(37, 1, '00:59:00', 'sdaf'),
(38, 1, '22:01:00', 'dfga'),
(39, 1, '23:01:00', 'sadf'),
(40, 1, '00:59:00', 'FÃºtbol'),
(41, 1, '23:01:00', 'dsfa'),
(42, 1, '01:59:00', 'dsafdf'),
(43, 1, '22:02:00', 'sdaf'),
(44, 1, '01:03:00', 'sdfa'),
(45, 1, '01:58:00', 'sdf'),
(46, 1, '22:01:00', 'sadf'),
(47, 1, '01:58:00', 'dfg'),
(48, 1, '00:59:00', 'dsf'),
(49, 1, '23:00:00', 'ewf'),
(50, 1, '00:58:00', 'wer'),
(51, 1, '00:59:00', 'ewr');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportes`
--

CREATE TABLE `deportes` (
  `id_contenido` int(11) NOT NULL,
  `nivel` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `localizacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `deportes`
--

INSERT INTO `deportes` (`id_contenido`, `nivel`, `localizacion`) VALUES
(30, 'dfg', 'dsfg'),
(43, 'bajo', 'Sevilla');

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
(1, 8, 47, 'ewr', '', 0),
(2, 6, 42, 'ew', '', 0),
(3, 6, 42, 'ew', '', 0),
(4, 1, 48, 'sdf', '', 0),
(5, 1, 49, '', '', 0),
(6, 1, 50, 'wewer', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suplemento`
--

CREATE TABLE `suplemento` (
  `id_contenido` int(11) NOT NULL,
  `dosis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `suplemento`
--

INSERT INTO `suplemento` (`id_contenido`, `dosis`) VALUES
(38, 45),
(38, 43),
(44, 2);

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
(1, 'gon', '$2y$10$5oj94q6tkxZfoIBuooWefuvgY2CuMCBk6e7rT2sqlYe1EKvM5zBxu', 'cliente', 'Gonzalo', 'gonzq@gmail.com', 'hombre', '2018-01-08 20:50:02', '', ''),
(2, 'dgs', '$2y$10$neEG8OZbp5SFDq7zgg4.q.YNiFIfEHQI0HnahpzMbUpXoCeCVqbLW', 'cliente', 'Gon', 'dsf', 'hombre', '2018-01-07 11:39:06', '', ''),
(3, 'g', '$2y$10$dojXjSjB.RUk7xeuMyDddO1NKpQHijWkZjMb4vM8sKgUvj/E0ihFa', 'cliente', 'Gon', 'sdag', 'hombre', '2018-01-07 11:50:18', '', ''),
(4, 'gonzalito', '$2y$10$mNVH/27TJaqiG6EMXY0aAeJ75z2eN.3Bt3v2.IxLkjGtRLNw.l1iG', 'cliente', 'Gon', 'sadgsdg', 'hombre', '2018-01-07 11:52:19', '', ''),
(5, 'sdasdg', '$2y$10$03PJO9FRk3xaGSjWtveOLeE5vc5ZswHKoDBbidJbYBMdR1BGETR9e', 'cliente', 'Gadgsdg', 'sadgsdg', 'hombre', '2018-01-07 12:31:54', '', ''),
(6, '!fsdg', '$2y$10$XrHsYLV2LAE53ZW5zPRh7exeQOMtzKMFkf3PY4bYhX5nAFlstDBz2', 'cliente', 'Gon', 'sadg', 'hombre', '2018-01-07 12:32:46', '', ''),
(7, 'sagdsgdfg', '$2y$10$TsoY7eQ4IKnBjlb7Rn.4jeG2ryc0bwjoB83ImWEPAtt3VyA1Rys/u', 'cliente', 'Jon', 'fgdhh', 'hombre', '2018-01-07 12:42:41', '', ''),
(8, '!dfgfdh', '$2y$10$EUiTigFMpXCiQJeutP6IcuszbeKbKiH.xs7RindG1BA9lZtb6JVXO', 'cliente', 'Gonza', 'sdagdsg', 'hombre', '2018-01-07 12:45:08', '', ''),
(9, 'Â¿?Â¿?Â¿sdgsdg', '$2y$10$rYYyrcTOLAv47TGV3uOb/OCJSNAROhRdeOd7S6kAGOVUV08h3ZCEi', 'cliente', 'Gon', 'sdag', 'hombre', '2018-01-07 12:47:26', '', ''),
(10, 'sadgsdg', '$2y$10$/2F.RBgookdyyr.yaZiPZewEjEPHgvLqSxoM/7g2olYSMD1xjLzRK', 'cliente', 'Gdsgsdg', 'sdafsdf@dsasd.com', 'hombre', '2018-01-07 13:06:39', '', ''),
(11, 'sdaf', 'sdf', 'sdfa', 'sdf', 'fsda', 'dsaf', '2018-01-08 20:50:28', 'dsf', 'sadf'),
(12, 'dfhdafh', '$2y$10$tgp60o9MhVmC97qEJnr3/OpcGbpSk0I25RkTSyJsl/6o5O8T7Msqu', 'cliente', 'Gonsadgds', 'gonzq@gmail.com', 'hombre', '2018-01-08 20:54:15', 'dsagsdg', 'sdagsdg');

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
(3, 30, 1),
(4, 47, 2);

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
  MODIFY `id_contenido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
