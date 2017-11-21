-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2017 a las 18:58:38
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
-- Base de datos: `epd6ej3`
--
CREATE DATABASE IF NOT EXISTS `epd6ej3` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `epd6ej3`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `last_access` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `usuario`, `password`, `last_access`) VALUES
('Gonzalo', 'gon', '$2y$10$hg8ANa4jisox38uuPdUaJeXiWpBpc06PuCFG93ci4cAtyYWwomtaq', '2017-11-21 17:43:02'),
('Eva', 'eva', '$2y$10$YJZboT160h6kUSSYXZ.Ao.KrUtMgvocEznOjnfOduWFV0RJN5R.RO', '2017-11-21 17:57:19'),
('Administrador', 'admin', '$2y$10$P0E5q3G06Ql4KxtJr3YgBetadIXwRpviotY0sM3rJD50nSi6eD81a', '2017-11-21 17:57:37');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
