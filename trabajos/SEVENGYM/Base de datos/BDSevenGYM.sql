-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Servidor: db560146253.db.1and1.com
-- Tiempo de generación: 19-01-2015 a las 14:52:09
-- Versión del servidor: 5.1.73-log
-- Versión de PHP: 5.4.35-0+deb7u2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db560146253`
--
CREATE DATABASE IF NOT EXISTS `db560146253` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `db560146253`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

CREATE TABLE IF NOT EXISTS `ejercicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_muscular` varchar(50) NOT NULL,
  `observacion` text NOT NULL,
  `repeticiones` int(11) NOT NULL,
  `nombre_ejercicio` varchar(50) NOT NULL,
  `peso` int(11) NOT NULL,
  `series` int(11) NOT NULL,
  `imagen1` varchar(200) NOT NULL,
  `imagen2` varchar(200) NOT NULL,
  `video` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `ejercicio`
--

INSERT INTO `ejercicio` (`id`, `grupo_muscular`, `observacion`, `repeticiones`, `nombre_ejercicio`, `peso`, `series`, `imagen1`, `imagen2`, `video`) VALUES
(1, 'piernas', 'Ponte de pie y sujeta una mancuerna con ambas manos, enfrente de tus muslos.\r\n\r\nBaja tu cuerpo flexionando tus rodillas hasta que formen un Ã¡ngulo de 90 grados, y elÃ©vate a ti mismo hacia arriba luego de una breve pausa.\r\n\r\nMantÃ©n tu tronco firme durante todo el movimiento.', 30, 'sentadillas', 10, 4, 'ejercicios/img114215855101.gif', 'ejercicios/img214215855101.gif', 'https://www.youtube.com/watch?v=0rgiePufo0A'),
(2, 'piernas', 'Sujeta una mancuerna con ambas manos entre tus piernas y agÃ¡chate hasta que tus rodillas se encuentren formando Ã¡ngulos de 90 grados.\r\n\r\nLevÃ¡ntate a ti mismo hacia la posiciÃ³n de pie mientras llevas la mancuerna por encima de tu cabeza y lentamente retorna a la posiciÃ³n inicial luego de una breve pausa.\r\n\r\nMantÃ©n tu espalda recta durante todo el movimiento.', 20, 'Balanceo Integral con Mancuernas', 20, 5, 'ejercicios/img114215856865.gif', 'ejercicios/img214215856865.gif', 'https://www.youtube.com/watch?v=0bLhZwydDuk'),
(3, 'piernas', 'Ponte de pie y sujeta una mancuerna en cada mano contra los lados de tu cuerpo, con las palmas apuntando una hacia la otra.\r\n\r\nDa un amplio paso hacia el costado, de manera que tu rodilla muestre un Ã¡ngulo de 90 grados y lentamente vuelve a la posiciÃ³n inicial luego de una breve pausa.\r\n\r\nMantÃ©n tu espalda recta durante todo el movimiento.', 50, 'Estocadas Laterales', 20, 5, 'ejercicios/img114215859414.gif', 'ejercicios/img214215859414.gif', 'https://www.youtube.com/watch?v=b7HDUKNSe4Y'),
(4, 'piernas', 'Ponte de pie y sujeta una mancuerna en cada mano contra los costados de tu cuerpo, con las palmas apuntando una hacia la otra.\r\n\r\nBaja las mancuernas mediante la flexiÃ³n de tus caderas hacia adelante y elÃ©vate nuevamente hacia arriba luego de una breve pausa.\r\n\r\nMantÃ©n tu espalda recta durante todo el movimiento.', 30, 'Peso Muerto â€“ Piernas Rectas', 25, 10, 'ejercicios/img114215860666.gif', 'ejercicios/img214215860666.gif', 'https://www.youtube.com/watch?v=B1UobuHgj64');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenamiento`
--

CREATE TABLE IF NOT EXISTS `entrenamiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_entrenador` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `duracion` int(11) NOT NULL,
  `num_ejercicio` int(11) NOT NULL,
  `tipo_dieta` varchar(50) NOT NULL,
  `observacion` text NOT NULL,
  `intensidad` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `entrenamiento_ibfk_1` (`id_entrenador`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `entrenamiento`
--

INSERT INTO `entrenamiento` (`id`, `id_entrenador`, `tipo`, `nombre`, `duracion`, `num_ejercicio`, `tipo_dieta`, `observacion`, `intensidad`) VALUES
(6, 45, 'Cardio', 'StaticBike', 50, 1, 'Hipocalorica', 'Disminuye indice de grasa', '8'),
(7, 45, 'Tren Inferior', 'Army', 45, 4, 'Hipercalorica', 'Aumento de masa muscular', '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenamiento_ejercicio`
--

CREATE TABLE IF NOT EXISTS `entrenamiento_ejercicio` (
  `id_entrenamiento` int(11) NOT NULL,
  `id_ejercicio` int(11) NOT NULL,
  `id_monitor` int(11) NOT NULL,
  PRIMARY KEY (`id_entrenamiento`,`id_ejercicio`,`id_monitor`),
  KEY `entrenamiento_ejercicio_ibfk_2` (`id_ejercicio`),
  KEY `entrenamiento_ejercicio_ibfk_3` (`id_monitor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrenamiento_ejercicio`
--

INSERT INTO `entrenamiento_ejercicio` (`id_entrenamiento`, `id_ejercicio`, `id_monitor`) VALUES
(7, 1, 45),
(7, 3, 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE IF NOT EXISTS `medidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_socio` int(11) NOT NULL,
  `edad` int(3) NOT NULL,
  `altura` int(11) NOT NULL,
  `peso` int(11) NOT NULL,
  `antebrazo` int(11) NOT NULL,
  `hombro` int(11) NOT NULL,
  `pecho` int(11) NOT NULL,
  `cintura` int(11) NOT NULL,
  `espalda` int(11) NOT NULL,
  `cuadriceps` int(11) NOT NULL,
  `gemelos` int(11) NOT NULL,
  `porcentaje_grasa` int(11) NOT NULL,
  `fuerza` int(11) NOT NULL,
  `resistencia` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `medidas_ibfk_1` (`id_socio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`id`, `id_socio`, `edad`, `altura`, `peso`, `antebrazo`, `hombro`, `pecho`, `cintura`, `espalda`, `cuadriceps`, `gemelos`, `porcentaje_grasa`, `fuerza`, `resistencia`) VALUES
(10, 50, 20, 180, 80, 15, 20, 110, 160, 150, 60, 145, 10, 58, 10),
(11, 50, 21, 190, 87, 14, 39, 89, 30, 100, 70, 30, 30, 70, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitores`
--

CREATE TABLE IF NOT EXISTS `monitores` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `especialidad` varchar(50) NOT NULL,
  `popularidad` int(2) NOT NULL,
  `telefono` int(9) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `numero_votos` int(11) NOT NULL,
  KEY `monitores_ibfk_1` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `monitores`
--

INSERT INTO `monitores` (`id_usuario`, `nombre`, `apellidos`, `especialidad`, `popularidad`, `telefono`, `foto`, `numero_votos`) VALUES
(43, 'Manuel', 'Bejar', 'Spinning', 27, 661242495, 'fotoMonitor/1421623597UPOSevillaManuelBejar.png', 2),
(44, 'Pedro', 'Garcia', 'HIT', 7, 669585474, 'fotoMonitor/1421623642Foto carnet.JPG', 0),
(45, 'Carlos', 'Barranco', 'Musculacion', 20, 669658547, 'fotoMonitor/14216239950be343c.jpg', 1),
(47, 'Luis', 'Merino', 'Deportes de altura', 8, 669363252, 'fotoMonitor/1421624275BacterialCrowdingLuis.png', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_socio` int(11) NOT NULL,
  `pago_total` int(11) NOT NULL,
  `pago_realizado` int(11) NOT NULL,
  `pago_restante` int(11) NOT NULL,
  `fecha_pago` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `renovado` tinyint(1) NOT NULL,
  `tiempo_expiracion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pago_ibfk_1` (`id_socio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id`, `id_socio`, `pago_total`, `pago_realizado`, `pago_restante`, `fecha_pago`, `renovado`, `tiempo_expiracion`) VALUES
(21, 50, 35, 20, 15, '2015-01-18 23:43:47', 0, 50),
(22, 48, 15, 15, 0, '2015-01-18 23:44:06', 0, 50),
(23, 46, 35, 30, 5, '2015-01-18 23:44:19', 0, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE IF NOT EXISTS `socios` (
  `id_usuario` int(11) NOT NULL,
  `id_monitor` int(11) NOT NULL,
  `id_tarifa` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `fecha_nacimiento` varchar(15) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `telefono_movil` varchar(9) NOT NULL,
  `telefono_fijo` varchar(9) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `poblacion` varchar(25) NOT NULL,
  `provincia` varchar(25) NOT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `foto_usuario` varchar(100) NOT NULL,
  `descuento` varchar(10) NOT NULL,
  KEY `socios_ibfk_1` (`id_usuario`),
  KEY `socios_ibfk_2` (`id_monitor`),
  KEY `socios_ibfk_3` (`id_tarifa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`id_usuario`, `id_monitor`, `id_tarifa`, `nombre`, `apellidos`, `fecha_nacimiento`, `sexo`, `telefono_movil`, `telefono_fijo`, `direccion`, `poblacion`, `provincia`, `fecha_alta`, `foto_usuario`, `descuento`) VALUES
(46, 45, 8, 'Sergio', 'Bermudez', '02/21/1974', 'hombre', '669547424', '956514247', 'Calle Betis', 'Sevilla', 'sevilla', '2015-01-18 23:36:15', 'd7569a3ef36fadda353a104936483ba5.jpg', '40'),
(48, 43, 7, 'Alicia', 'Troncoso', '03/19/1970', 'mujer', '669325214', '956587485', 'Triana', 'Sevilla', 'Sevilla', '2015-01-18 23:39:51', '038c5e42c4515b18eb998fa37c17dfc1.jpg', '20'),
(50, 45, 8, 'Mejak', 'Margarian', '10/15/1990', 'hombre', '661242485', '956514243', 'Tejera', 'Sevilla', 'Sevilla', '2015-01-18 23:48:27', '6dea51c592f94e9acf82e43a215d5d11.jpg', '32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa`
--

CREATE TABLE IF NOT EXISTS `tarifa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `duracion` int(3) NOT NULL,
  `precio` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `tarifa`
--

INSERT INTO `tarifa` (`id`, `nombre`, `descripcion`, `duracion`, `precio`) VALUES
(7, 'Familiar', 'EnseÃ±ando tu carnet de familia numerosa obtÃ©n un descuento considerable', 50, 15),
(8, 'Premium', 'Todos los servicios vienen incluidos', 50, 35),
(9, 'Joven', 'Presentando DNI y el Carnet de Estudiante', 50, 25),
(10, 'Anual', 'Para todo el aÃ±o', 365, 115);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rol` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nick`, `password`, `email`, `rol`) VALUES
(20, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'mejakmargarian@gmail.com', 'admin'),
(43, 'bejar', '75838389ceeb0ef83c5a516810bd9205', 'bejar@gmail.com', 'monitor'),
(44, 'pedro', 'c6cc8094c2dc07b700ffcc36d64e2138', 'pedro@gmail.com', 'monitor'),
(45, 'barranco', '85268541422d5924e811929f6d9f605c', 'barranco@gmail.com', 'monitor'),
(46, 'sergio', '3bffa4ebdf4874e506c2b12405796aa5', 'sergio@gmail.com', 'socio'),
(47, 'merino', 'e1d7f219c95107d105070afe198b3098', 'merino@gmail.com', 'monitor'),
(48, 'alicia', 'e94ef563867e9c9df3fcc999bdb045f5', 'alicia@gmail.com', 'socio'),
(50, 'mejak', 'fe33314c4da8977e199b92754a258810', 'mejakmargarian@gmail.com', 'socio');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
  ADD CONSTRAINT `entrenamiento_ibfk_1` FOREIGN KEY (`id_entrenador`) REFERENCES `monitores` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entrenamiento_ejercicio`
--
ALTER TABLE `entrenamiento_ejercicio`
  ADD CONSTRAINT `entrenamiento_ejercicio_ibfk_1` FOREIGN KEY (`id_entrenamiento`) REFERENCES `entrenamiento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entrenamiento_ejercicio_ibfk_2` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entrenamiento_ejercicio_ibfk_3` FOREIGN KEY (`id_monitor`) REFERENCES `entrenamiento` (`id_entrenador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD CONSTRAINT `medidas_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `socios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `monitores`
--
ALTER TABLE `monitores`
  ADD CONSTRAINT `monitores_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `socios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `socios`
--
ALTER TABLE `socios`
  ADD CONSTRAINT `socios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
