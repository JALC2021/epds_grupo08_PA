-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-02-2014 a las 15:36:46
-- Versión del servidor: 5.6.14
-- Versión de PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gamerstation`
--
CREATE DATABASE IF NOT EXISTS `gamerstation` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `gamerstation`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `analisisconsola`
--
-- Creación: 06-02-2014 a las 10:57:39
--

DROP TABLE IF EXISTS `analisisconsola`;
CREATE TABLE IF NOT EXISTS `analisisconsola` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `titulo` varchar(400) CHARACTER SET utf8 DEFAULT NULL,
  `texto` longtext CHARACTER SET utf8,
  `nota` int(11) NOT NULL,
  `video` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `consola_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `consola_analisis_id_FK_idx` (`consola_id`),
  KEY `usuario_analisisConsola_id_FK_idx` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Analisis de consolas	' AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `analisisconsola`
--

INSERT INTO `analisisconsola` (`id`, `fecha`, `titulo`, `texto`, `nota`, `video`, `consola_id`, `usuario_id`) VALUES
(9, '2014-02-06', 'AnÃ¡lisis WII', 'Wii es una videoconsola producida por Nintendo y estrenada el 19 de noviembre de 2006 en NorteamÃ©rica y el 8 de diciembre del mismo aÃ±o en Europa. \r<br>Perteneciente a la sÃ©ptima generaciÃ³n de consolas, es la sucesora directa de Nintendo GameCube y actualmente sigue compitiendo con la Xbox 360 de Microsoft y la PlayStation 3 de Sony. Nintendo afirmÃ³ que Wii estÃ¡ destinada a una audiencia mÃ¡s amplia a diferencia de las otras dos consolas mencionadas previamente. Desde su debut, la consola las ha superado en cuanto a ventas, y, en diciembre de 2009, rompiÃ³ el rÃ©cord como la consola mÃ¡s vendida en un solo mes en Estados Unidos.', 8, 'ZsjaKg3hoFE', 3, 1),
(10, '2014-02-06', 'AnÃ¡lisis Xbox One', 'Xbox One es la tercera videoconsola de sobremesa producida por Microsoft. Forma parte de las videoconsolas de octava generaciÃ³n, fue presentada por Microsoft el 21 de mayo de 2013. \r<br>Es la sucesora de la Xbox 360 y actualmente compite con la PlayStation 4 de Sony y la Wii U de Nintendo. Su salida a la venta fue el 22 de noviembre de 20136 a un precio de 499 dÃ³lares.', 10, 'AqDJRqNoWIE', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `analisisjuego`
--
-- Creación: 06-02-2014 a las 10:57:39
--

DROP TABLE IF EXISTS `analisisjuego`;
CREATE TABLE IF NOT EXISTS `analisisjuego` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `titulo` varchar(400) CHARACTER SET utf8 DEFAULT NULL,
  `texto` text CHARACTER SET utf8,
  `nota` int(11) NOT NULL,
  `video` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `juego_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `juego_analisis_id_FK_idx` (`juego_id`),
  KEY `usuario_analisis_id_FK_idx` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Analisis de juegos' AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `analisisjuego`
--

INSERT INTO `analisisjuego` (`id`, `fecha`, `titulo`, `texto`, `nota`, `video`, `juego_id`, `usuario_id`) VALUES
(6, '2014-02-06', 'AnÃ¡lisis Final Fantasy IX', 'Final Fantasy IX es un videojuego de rol realizado por la empresa japonesa Squaresoft en 2000. Esta es la novena entrega del juego y el Ãºltimo capÃ­tulo de la saga realizado para la consola Playstation. En esta ocasiÃ³n, Squaresoft preparÃ³ un capÃ­tulo con el que pretendÃ­a volver a los orÃ­genes de la saga, mostrÃ¡ndonos un mundo clÃ¡sico entre lo medieval y lo fantÃ¡stico.', 10, '', 1, 1),
(7, '2014-02-06', 'Análisis Metal Gear Solid', 'Metal Gear Solid es un videojuego de acción-aventura y sigilo de 1998 desarrollado por Konami Computer Entertainment Japan y publicado por Konami para la consola PlayStation. Fue lanzado el 3 de septiembre de 1998 en Japón , el 21 de octubre de 1998 en Norteamérica y el 24 de junio de 1999 en Europa.\r<br>Inicialmente se había previsto su lanzamiento para 1994 en la consola 3DO Interactive Multiplayer, con el título «Metal Gear 3».', 5, 'Rge3bUyKWRA', 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consola`
--
-- Creación: 06-02-2014 a las 10:57:39
--

DROP TABLE IF EXISTS `consola`;
CREATE TABLE IF NOT EXISTS `consola` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8 NOT NULL,
  `descripcion` text CHARACTER SET utf8 NOT NULL,
  `especificaciones` text CHARACTER SET utf8 NOT NULL,
  `empresa` varchar(100) CHARACTER SET utf8 NOT NULL,
  `anyo` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `consola`
--

INSERT INTO `consola` (`id`, `nombre`, `descripcion`, `especificaciones`, `empresa`, `anyo`) VALUES
(1, 'Play Station 4', 'Consola de 8 GeneraciÃ³n de Sony', 'La videoconsola PS4, dispone de un microprocesador tipo APU de ocho nÃºcleos x86-64 fabricado por AMD bajo el nombre en clave Liverpool, basado en la arquitectura Jaguar. Una GPU de Ãºltima generaciÃ³n de la misma compaÃ±Ã­a, con una potencia de procesamiento de 1,84 Teraflops, que podrÃ¡ dedicarse a diferentes tareas que no sean exclusivamente grÃ¡ficas.', 'Sony', '2013-11-29'),
(2, 'Xbox One', 'Xbox One es la tercera videoconsola de sobremesa producida por Microsoft. Forma parte de las videoconsolas de octava generaciÃ³n, fue presentada por Microsoft el 21 de mayo de 2013.5 Es la sucesora de la Xbox 360 y actualmente compite con la PlayStation 4 de Sony y la Wii U de Nintendo. Su salida a la venta fue el 22 de noviembre de 20136 a un precio de 499 dÃ³lares.', 'CPU: AMD Custom x86-64 a 1,75 GHz por nÃºcleo (8 nÃºcleos en total)1\r\nGPU	AMD Radeon personalizada 768 shaders @ 853 MHz (1,21 TFLOP/s)1\r\nSoporte: Blu-Ray2\r\nAlmacenamiento: Disco duro SATA 2,5&#34; de\r\n(500 GB)\r\nFormato de imagen: 1080p', 'Microsoft', '2013-11-22'),
(3, 'Wii', 'Wii es una videoconsola producida por Nintendo y estrenada el 19 de noviembre de 2006 en NorteamÃ©rica y el 8 de diciembre del mismo aÃ±o en Europa. Perteneciente a la sÃ©ptima generaciÃ³n de consolas,9 es la sucesora directa de Nintendo GameCube y actualmente sigue compitiendo con la Xbox 360 de Microsoft y la PlayStation 3 de Sony. Nintendo afirmÃ³ que Wii estÃ¡ destinada a una audiencia mÃ¡s amplia a diferencia de las otras dos consolas mencionadas previamente.10 Desde su debut, la consola las ha superado en cuanto a ventas,11 y, en diciembre de 2009, rompiÃ³ el rÃ©cord como la consola mÃ¡s vendida en un solo mes en Estados Unidos.', 'CPU	IBM Broadway 729 MHz.\r\nGPU	ATI Hollywood 243 MHz.\r\nSoporte	Wii Optical Disc de 12 cm\r\nNintendo GameCube Game Disc de 8 cm\r\nAlmacenamiento	Memoria Flash de 512 MB, tarjetas SD y SDHC y tarjetas de memoria de Nintendo GameCube', 'Nintendo', '2006-12-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consola_juego`
--
-- Creación: 06-02-2014 a las 10:57:39
--

DROP TABLE IF EXISTS `consola_juego`;
CREATE TABLE IF NOT EXISTS `consola_juego` (
  `consola_id` int(11) NOT NULL,
  `juego_id` int(11) NOT NULL,
  KEY `consola_id_FK_idx` (`consola_id`),
  KEY `juego_id_FK_idx` (`juego_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego`
--
-- Creación: 06-02-2014 a las 10:57:39
--

DROP TABLE IF EXISTS `juego`;
CREATE TABLE IF NOT EXISTS `juego` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8 NOT NULL,
  `descripcion` text CHARACTER SET utf8 NOT NULL,
  `edad` int(11) NOT NULL,
  `empresa` varchar(100) CHARACTER SET utf8 NOT NULL,
  `anyo` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `juego`
--

INSERT INTO `juego` (`id`, `nombre`, `descripcion`, `edad`, `empresa`, `anyo`) VALUES
(1, 'Final Fantasy IX', 'Novena entrega de la mejor serie de juegos RPG de la historia', 12, 'Square Enix', '2000-01-01'),
(10, 'Metal Gear Solid', 'Metal Gear Solid es un videojuego de acciÃ³n-aventura y sigilo de 1998 desarrollado por Konami Computer Entertainment Japan y publicado por Konami para la consola PlayStation.\r<br>Fue lanzado el 3 de septiembre de 1998 en JapÃ³n, el 21 de octubre de 1998 en NorteamÃ©rica y el 24 de junio de 1999 en Europa.2 3 Inicialmente se habÃ­a previsto su lanzamiento para 1994 en la consola.', 12, 'Konami', '1998-09-03'),
(11, 'Parasite Eve', 'Parasite Eve es un videojuego de estrategia, terror y acciÃ³n, con algunos toques RPG (juego de rol) de la compaÃ±Ã­a Squaresoft, basado en el libro homÃ³nimo de Hideaki Sena. Su banda sonora estÃ¡ compuesta por Yiko Shimomura.\r<br>\r<br>El juego fue lanzado el 29 de marzo de 1998 para la consola PlayStation de Sony en JapÃ³n, y tres meses mÃ¡s tarde se lanzÃ³ en los Estados Unidos. \r<br>\r<br>Por desgracia, el juego no llegÃ¡ a salir en EspaÃ±a. Aparte de ser una completa novedad, el juego incluÃ­a un modo de juego adicional que se desbloqueaba al acabarlo por primera vez, llamado EX Mode. Este modo destacaba, aparte de su dificultad, por aÃ±adir un nivel adicional en el juego, que ocurrÃ­a en el edificio Chrysler, ademÃ¡s del verdadero final del juego, ya que el &#34;final normal&#34; no se considera canÃ³nico.', 16, 'SquareSoft', '1998-09-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticiaconsola`
--
-- Creación: 06-02-2014 a las 10:57:39
--

DROP TABLE IF EXISTS `noticiaconsola`;
CREATE TABLE IF NOT EXISTS `noticiaconsola` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `titulo` varchar(400) CHARACTER SET utf8 DEFAULT NULL,
  `texto` longtext CHARACTER SET utf8,
  `video` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `consola_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `consola_noticia_id_FK_idx` (`consola_id`),
  KEY `usuario_noticiaconsola_id_FK_idx` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Noticias de consolas' AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `noticiaconsola`
--

INSERT INTO `noticiaconsola` (`id`, `fecha`, `titulo`, `texto`, `video`, `usuario_id`, `consola_id`) VALUES
(2, '2013-12-28', 'Play Station 4', 'Ya estÃ¡ con nosotros la octava generaciÃ³n de consolas', 'x7QhUL8NUK4', 1, 1),
(3, '2014-02-05', 'Nueva Xbox One', 'Por fin ha llegado la nueva consola de Microsoft, la Xbox One!', '4l5jGrcqQME', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticiajuego`
--
-- Creación: 06-02-2014 a las 10:57:40
--

DROP TABLE IF EXISTS `noticiajuego`;
CREATE TABLE IF NOT EXISTS `noticiajuego` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `titulo` varchar(400) CHARACTER SET utf8 DEFAULT NULL,
  `texto` longtext CHARACTER SET utf8,
  `video` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `juego_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `juego_noticia_id_FK_idx` (`juego_id`),
  KEY `usuario_noticiajuego_id_FK_idx` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Noticias sobre juegos' AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `noticiajuego`
--

INSERT INTO `noticiajuego` (`id`, `fecha`, `titulo`, `texto`, `video`, `juego_id`, `usuario_id`) VALUES
(5, '2013-12-27', 'Noticia Metal Gear Solid', 'Una de las noticias de la semana ha sido el rumor del remake de Metal Gear Solid por parte de un estudio externo. Su creador Hideo Kojima ya dejÃ³ caer esa idea durante el E3, pero ha sido en estos dÃ­as cuando se ha hecho mÃ¡s grande la posibilidad.\r<br>\r<br>En su cuenta personal en la red social, el creador de MGS deja claro que todo ha sido un error de entendimiento y de traducciÃ³n, y pide perdÃ³n por la malinterpretaciÃ³n originada por su parte.', 'woSWaYsZruI', 10, 1),
(6, '2014-02-02', 'Noticia Parasite Eve', 'Square Enix ha hablado con el portal norteamericano 1UP por boca de su productor, Yoshinori Kitase, sobre Parasite Eve 1 y 2 y la posibilidad de llevar un remake en PlayStation 3 como ya adelantamos hace unos dÃ­as.', '09svl5cZAMs', 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--
-- Creación: 06-02-2014 a las 10:57:40
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `correo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Usuarios del sistema	' AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `password`, `correo`) VALUES
(1, 'root', 'root', 'root@root.com'),
(2, 'Sergio', '1234', 'sergio@gmail.com'),
(7, 'fran', '1234', 'fran@gmail.com'),
(8, 'laura', '1234', 'laura@gmail.com');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `analisisconsola`
--
ALTER TABLE `analisisconsola`
  ADD CONSTRAINT `consola_analisisConsola_id_FK` FOREIGN KEY (`consola_id`) REFERENCES `consola` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_analisisConsola_id_FK` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `analisisjuego`
--
ALTER TABLE `analisisjuego`
  ADD CONSTRAINT `juego_analisisjuego_id_FK` FOREIGN KEY (`juego_id`) REFERENCES `juego` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_analisisjuego_id_FK` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `consola_juego`
--
ALTER TABLE `consola_juego`
  ADD CONSTRAINT `consola_id_FK` FOREIGN KEY (`consola_id`) REFERENCES `consola` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `juego_id_FK` FOREIGN KEY (`juego_id`) REFERENCES `juego` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticiaconsola`
--
ALTER TABLE `noticiaconsola`
  ADD CONSTRAINT `consola_noticiaconsola_id_FK` FOREIGN KEY (`consola_id`) REFERENCES `consola` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_noticiaconsola_id_FK` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticiajuego`
--
ALTER TABLE `noticiajuego`
  ADD CONSTRAINT `juego_noticiajuego_id_FK` FOREIGN KEY (`juego_id`) REFERENCES `juego` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_noticiajuego_id_FK` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
