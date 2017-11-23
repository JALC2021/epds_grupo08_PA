-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-11-2017 a las 01:19:29
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
-- Base de datos: `epd6Aerolineas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aerolineas`
--

CREATE TABLE `aerolineas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `aerolineas`
--

INSERT INTO `aerolineas` (`id`, `nombre`) VALUES
(42, 'Vueling'),
(43, 'Ryan Air'),
(44, 'Iberia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`nombre`) VALUES
('Amsterdam'),
('Barcelona'),
('Dublin'),
('Londres'),
('Madrid'),
('Paris'),
('Roma'),
('Sevilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinos`
--

CREATE TABLE `destinos` (
  `idAerolinea` int(11) NOT NULL,
  `nombreCiudad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `destinos`
--

INSERT INTO `destinos` (`idAerolinea`, `nombreCiudad`) VALUES
(42, 'Madrid'),
(42, 'Roma'),
(43, 'Barcelona'),
(43, 'Paris'),
(43, 'Sevilla'),
(44, 'Amsterdam'),
(44, 'Dublin'),
(44, 'Londres'),
(44, 'Madrid');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelos`
--

CREATE TABLE `vuelos` (
  `idAerolinea` int(11) NOT NULL,
  `origen` varchar(50) NOT NULL,
  `destino` varchar(50) NOT NULL,
  `duracion` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vuelos`
--

INSERT INTO `vuelos` (`idAerolinea`, `origen`, `destino`, `duracion`) VALUES
(42, 'Madrid', 'Roma', '01:02:00'),
(43, 'Barcelona', 'Paris', '03:04:00'),
(43, 'Barcelona', 'Sevilla', '03:03:00'),
(43, 'Paris', 'Barcelona', '00:23:00'),
(43, 'Paris', 'Sevilla', '02:31:00'),
(43, 'Sevilla', 'Barcelona', '01:24:00'),
(43, 'Sevilla', 'Paris', '02:23:00'),
(44, 'Amsterdam', 'Madrid', '04:04:00'),
(44, 'Dublin', 'Amsterdam', '02:02:00'),
(44, 'Dublin', 'Londres', '02:04:00'),
(44, 'Dublin', 'Madrid', '23:03:00'),
(44, 'Londres', 'Amsterdam', '03:03:00'),
(44, 'Londres', 'Dublin', '03:03:00'),
(44, 'Londres', 'Madrid', '03:03:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aerolineas`
--
ALTER TABLE `aerolineas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `destinos`
--
ALTER TABLE `destinos`
  ADD PRIMARY KEY (`idAerolinea`,`nombreCiudad`),
  ADD KEY `nombreCiudad` (`nombreCiudad`);

--
-- Indices de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD PRIMARY KEY (`idAerolinea`,`origen`,`destino`),
  ADD KEY `origen` (`origen`),
  ADD KEY `destino` (`destino`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aerolineas`
--
ALTER TABLE `aerolineas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `destinos`
--
ALTER TABLE `destinos`
  ADD CONSTRAINT `destinos_ibfk_2` FOREIGN KEY (`nombreCiudad`) REFERENCES `ciudades` (`nombre`),
  ADD CONSTRAINT `destinos_ibfk_3` FOREIGN KEY (`idAerolinea`) REFERENCES `aerolineas` (`id`);

--
-- Filtros para la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD CONSTRAINT `vuelos_ibfk_2` FOREIGN KEY (`origen`) REFERENCES `ciudades` (`nombre`),
  ADD CONSTRAINT `vuelos_ibfk_3` FOREIGN KEY (`destino`) REFERENCES `ciudades` (`nombre`),
  ADD CONSTRAINT `vuelos_ibfk_4` FOREIGN KEY (`idAerolinea`) REFERENCES `aerolineas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
