-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-12-2016 a las 11:22:27
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--
CREATE DATABASE IF NOT EXISTS `proyecto` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `proyecto`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `id_cal` int(11) NOT NULL,
  `id_pub` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_cat` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `id_pub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `titulo` varchar(20) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `tipo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_pub` int(11) NOT NULL,
  `id_mensaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `titulo`, `descripcion`, `tipo`, `id_usuario`, `id_pub`, `id_mensaje`) VALUES
(1, 'Animales: Perros', 'Grupo para contactac con cuidadores de perros en le zona de Sevilla Este', 0, 17, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id_mensaje` int(11) NOT NULL,
  `contenido` varchar(500) NOT NULL,
  `fecha` date NOT NULL,
  `id_usuario_origen` int(11) NOT NULL,
  `id_pub` int(11) NOT NULL,
  `id_usuario_destino` int(11) NOT NULL,
  `nombre_usuario` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `id_pub` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `ciudad` varchar(20) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `hora` varchar(5) NOT NULL,
  `estado` int(1) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `fecha_evento` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(10) NOT NULL,
  `tipo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`id_pub`, `fecha_creacion`, `descripcion`, `ciudad`, `direccion`, `hora`, `estado`, `titulo`, `fecha_evento`, `id_usuario`, `nombre_usuario`, `tipo`) VALUES
(1, '0000-00-00', 'Busco a alguien que me pueda ayudar con las matema', 'Sevilla', 'Pasaje Honorio', '18:0', 0, '0', '0000-00-00', 0, '', 0),
(2, '2016-12-27', 'Se busca niÃ±era para cuidar de dos niÃ±as de 4 y 5 aÃ±os durante todo el dia', 'Madrid', 'Avenida de Andalucia Bloque 2', '11:45', 0, '0', '2016-12-27', 1, '', 0),
(3, '2016-12-27', '                ', '', '', '11:45', 0, '0', '2016-12-27', 1, '', 0),
(4, '2016-12-27', '                ', '', '', '11:45', 0, '0', '2016-12-27', 1, '', 0),
(5, '2016-12-27', 'Necesito un profesor particular para que me de clases de matematicas para un examen urgente que tengo en el colegio.', 'Sevilla', 'Pasaje Honorio', '11:45', 0, 'Profesor', '0000-00-00', 1, '', 0),
(6, '2016-12-27', 'Necesito un profesor particular para que me de clases de matematicas para un examen urgente que tengo en el colegio.', 'Sevilla', 'Pasaje Honorio', '11:45', 0, 'Profesor', '0000-00-00', 1, '', 0),
(7, '2016-12-27', 'Se necesita jugador para que ayude a L10NEL a meter goles para su club.     ', 'Barcelona', 'Camp Nou', '11:45', 0, 'Futbolista', '2017-02-12', 1, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido1` varchar(20) NOT NULL,
  `apellido2` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(150) NOT NULL,
  `nombre_usuario` varchar(10) NOT NULL,
  `telefono` int(9) NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido1`, `apellido2`, `email`, `pwd`, `nombre_usuario`, `telefono`, `imagen`) VALUES
(1, 'Antonio', 'Flores', 'Romero', 'antoniofloresrom@gmail.com', 'upo', 'afloro', 660042718, ''),
(2, 'Jose', 'Resu', 'Galan', 'resu@gmail.com', 'upo', 'jaresg', 4343434, ''),
(7, 'Josen', 'Resu', 'Galan', 'resu@gmail.comn', '', 'jjjjjj', 43434348, ''),
(8, 'David', 'Ernesto', 'Dominguez', 'david@gmail.com', '47c1d89b', 'david', 6668889, ''),
(9, 'Juan', 'Pepito ', 'Perez', 'juanito@gmail.com', '47c1d89b', 'upo', 4652456, ''),
(12, 'Pepe', 'Perez', 'MuÃ±oz', 'hola@gmail.com', '47c1d89b', '1', 45221212, ''),
(13, 'donfojd', 'ofngfgj', 'fojbnfj', 'fdsd@gmail.com', '47c1d89b', 'biblio', 52189676, ''),
(14, 'fff', 'fff', 'fff', 'fff@hoy', '47c1d89b', 'pepito', 0, ''),
(15, 'nbh', 'ih', 'bp', 'bb@gmail.com', '47c1d89b', 'biblioteca', 0, ''),
(16, 'antonio', 'sidfmndsnfjn', 'osfngfsjgndf', 'oifngj@gma', '47c1d89b', 'grillo', 194516, ''),
(17, 'sdsdsd', 'sdsd', 'sds', 'sdsd@gmail', '47c1d89bcfcb567ea8ecd7eff477bddd', 'hola', 0, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`id_cal`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_mensaje`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`id_pub`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id_cal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `id_pub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
