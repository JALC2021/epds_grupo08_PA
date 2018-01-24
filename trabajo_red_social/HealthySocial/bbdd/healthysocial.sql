-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-01-2018 a las 02:05:24
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
(3, 'dieta', 'vegetariana', '2semanas'),
(11, 'cientifico', 'vegana', '1semana'),
(15, 'dieta', 'omnivora', '4semanas'),
(16, 'cientifico', 'crudista', '2semanas');

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
(42, 43),
(42, 44),
(43, 44),
(43, 42),
(42, 45),
(43, 45),
(45, 42),
(45, 43),
(44, 42);

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
(1, 43, 2, 'Bien jugado Gonzalo! espero que luego la liÃ¡seis por mi ciudad jejeje.'),
(3, 43, 3, 'Esta dieta tiene buena pinta Gonzalo. La probarÃ©!'),
(4, 44, 13, 'El otro gol lo marcÃ³ Gonzalo! que no se mosque jajaja'),
(5, 44, 2, 'ya serÃ¡ para meno...aahaha'),
(7, 44, 10, 'Susana la prÃ³xima vez que vayas a jugar avisa!!'),
(8, 42, 15, 'Tio ten cuidado con esta dieta...es peligroso perder tanto peso de forma repentina.'),
(9, 42, 10, 'Yo tambiÃ©n me apunto!'),
(10, 45, 2, 'llÃ¡mame para el prÃ³ximo y llamo a otro colega'),
(11, 45, 12, 'Me han hablado bastante bien de este suplemento!'),
(12, 45, 14, 'Bastante sano! recomendable!'),
(13, 42, 18, 'Eso es tio!! a tope'),
(14, 42, 16, 'Eso es una locura tio!'),
(17, 42, 14, 'La verdad que es un suplemento bastante recomendable.'),
(18, 42, 11, 'Ole!!'),
(19, 42, 13, 'Buen partido!!'),
(21, 43, 2, 'Que buena!'),
(24, 43, 15, 'Que buena!'),
(27, 43, 16, 'Pienso igual que gonzalo...por mucho estudio cientÃ­fico que tenga...');

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
(2, 42, 'Hemos jugado una torneo 3 vs 3. Hemos ganado nosotros!!! Vamos seÃ±ores!! \r\n\r\nLuego hemos pasado un dÃ­a genial por Granada.'),
(3, 42, 'Dieta para adelgazar.'),
(10, 43, 'Partidazo jugado hoy! 6-2, 3-6 y 6-3 ganamos!!'),
(11, 43, 'En general, para llevar una dieta equilibrada, recomiendo hacer 5-6 comidas diarias, pero realmente lo que determina el nÃºmero de comidas al dÃ­a es el nÃºmero de horas que permanezcamos activos. Una persona que desayune a las 6:00 y cene a las 23:00 tendrÃ¡ que hacer un nÃºmero mayor de comidas que aquella que desayune a las 9:00 y cene a las 22:00. Lo realmente importante es no dejar grandes perÃ­odos de ayuno, ya que esto desencadena un desequilibrio de los niveles de glucosa lo que a su vez provoca descenso de la energÃ­a vital, incremento del apetito y tendencia a acumular grasa cuando ingiramos comida a modo de supercompensaciÃ³n.'),
(12, 43, 'CafeÃ­na para perder peso:\r\n\r\nEs un alcaloide del grupo de las xantinas y se encuentra en varios alimentos como el cafÃ©, tÃ© o matÃ© o guaranÃ¡ entre otros. La cafeÃ­na, tiene la capacidad de inhibir dos enzimas, la catel-O-metil-transferasa y la fosfodiesterasa dando lugar a la estimulaciÃ³n de la lipÃ³lisis (degradaciÃ³n de grasas). Incrementa la cantidad de Ã¡cidos grasos libres en sangre, los cuales son transportados a la cÃ©lula para la obtenciÃ³n de energÃ­a. La cafeÃ­na ademÃ¡s posee una propiedad diurÃ©tica, por lo tanto, ayuda a reducir la retenciÃ³n de lÃ­quidos.'),
(13, 44, 'Partidazo jugado hoy ganando 2-0 con un golito mio jejeje'),
(14, 44, 'Naranja amarga:\r\n\r\nLa naranja agria es un suplemento para bajar de peso muy controvertido. Hay alguna prueba cientÃ­fica de que los ingredientes encontrados en la naranja amarga pueden ayudar en la pÃ©rdida de peso, pero su seguridad es cuestionable. Es mÃ¡s, la naranja amarga contiene dos compuestos (sinefrina y octopamina) que son estructuralmente similares a los encontrados en la efedra.'),
(15, 44, 'Estoy haciendo la dieta dukan...ya os contarÃ©!'),
(16, 45, 'La dieta de un mÃ©dico de Harvard: come lo que quieras una vez al dÃ­a\r\nEl doctor Xand Van Tulleken basa su investigaciÃ³n en el ayuno y en cÃ³mo este provoca un estrÃ©s en el cuerpo que conduce a eliminar la grasa'),
(17, 45, 'Ãcido clorogÃ©nico (Extracto de CafÃ© Verde)\r\n\r\nEl Ã¡cido clorogÃ©nico es un fitoquÃ­mico encontrado en el cafÃ© y granos de cafÃ©. Entre sus beneficios se encuentra su propiedad para reducir la absorciÃ³n de hidratos de carbono que se consumen, lo que ayudarÃ­a a mitigar los picos de insulina. Los estudios clÃ­nicos han sugerido que el Ã¡cido clorogÃ©nico usado como parte de una dieta sana ayuda a mantener los niveles normales de azÃºcar en la sangre. Como apoyo para la reducciÃ³n de grasa, el Ã¡cido clorogÃ©nico puede mejorar la funciÃ³n de la adinopectina'),
(18, 45, 'Carrerita de 45 min a un ritmo bajo para ir cogiendo el ritmo nuevamente!');

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
(2, 'alto', 'Granada', 'baloncesto', '01:30:00'),
(10, 'medio', 'Sevilla', 'paddel', '02:00:00'),
(13, 'medio', 'CÃ¡diz', 'futbol', '01:45:00'),
(18, 'bajo', 'Sevilla', 'running', '00:45:00');

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
(29, 'Susana', 'iglesias', 'susana@hotmail.com', 'mujer', 7, 2, 8, '2018-01-24 01:04:33', '2018-01-24 01:04:33'),
(30, 'Susana', 'Iglesias', 'susana@hotmail.com', 'mujer', 8, 2, 9, '2018-01-24 01:04:00', '2018-01-24 01:04:00'),
(31, 'Susana', 'de la cale', 'susan@hotmail.com', 'mujer', 9, 2, 5, '2018-01-21 09:34:22', '2018-01-21 09:34:34'),
(32, 'Susana', 'iglesias', 'susana@hotmail.com', 'mujer', 10, 2, 6, '2017-12-21 10:12:41', '2018-01-21 12:46:00'),
(33, 'Juan', 'lopez', 'juan@hotmail.es', 'hombre', 11, 3, 8, '2017-01-21 10:13:38', '2018-01-21 12:46:34'),
(36, 'Gonzalo', 'del RÃ­o AlÃ¡ez', 'gonzq87@gmail.com', 'hombre', 12, 2, 10, '2018-01-21 17:19:13', '2018-01-21 17:20:03'),
(36, 'Gon', 'delrio', 'gonzq87@gmail.com', 'hombre', 13, 1, 8, '2018-01-24 01:04:43', '2018-01-24 01:04:43'),
(37, 'Gon', 'del rio', 'gonzq87@gmail.com', 'hombre', 14, 1, 5, '2018-01-21 18:32:16', '2018-01-21 18:33:37'),
(38, 'Gon', 'gongon', 'gonzq87@gmail.com', 'hombre', 15, 2, 8, '2018-01-24 01:03:49', '2018-01-24 01:03:49'),
(39, 'Gon', 'gon', 'gonzq87@gmail.com', 'hombre', 16, 1, 7, '2018-01-24 01:03:25', '2018-01-24 01:03:25'),
(1, 'Gon', 'del rio', 'sdasdf', 'hom', 17, 2, 7, '2018-01-24 01:03:39', '2018-01-24 01:03:39'),
(1, 'Gon', 'del rio', 'sdasdf', 'hom', 18, 2, 8, '2018-01-24 01:03:32', '2018-01-24 01:03:32'),
(48, 'Lulu', 'lulu', 'lulu@lulu.com', 'hombre', 20, 2, 9, '2018-01-24 01:03:20', '2018-01-24 01:03:20'),
(49, 'Lulu', 'lulu', 'lulu@lulu.com', 'hombre', 21, 2, 8, '2018-01-24 01:03:12', '2018-01-24 01:03:12'),
(46, 'Lulu', 'lulu', 'lulu@lulu.com', 'hombre', 22, 2, 9, '2018-01-24 01:03:05', '2018-01-24 01:03:05');

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

--
-- Volcado de datos para la tabla `foto`
--

INSERT INTO `foto` (`id_foto`, `id_usuario`, `id_contenido`, `url`) VALUES
(2, 42, 2, 'https://btorrelodones.com/images/Contenido-Estatico/Campus/Torneo3vs3.jpg'),
(3, 42, 3, 'https://www.adelgazarysalud.com/wp-content/uploads/2017/10/Dieta2Semanas2.jpg'),
(5, 43, 10, 'http://www.alertadigital.com/wp-content/uploads/2017/09/padel.jpg'),
(6, 43, 11, 'https://quierocuidarme.dkvsalud.es/sites/default/files/imagen/2017-02/dieta-equilibrada.jpg'),
(7, 44, 13, 'http://www.estoesdxt.es/images/web/6019.jpg'),
(8, 44, 15, 'http://www.fullmusculo.com/home/wp-content/uploads/2016/07/dieta-dukan-fases.jpg'),
(9, 45, 18, 'http://www.abcdesevilla.es/Media/201307/19/paseo-juan-carlos--644x362.jpg');

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

--
-- Volcado de datos para la tabla `suplemento`
--

INSERT INTO `suplemento` (`id_contenido`, `dosis`, `tipo`, `duracion`) VALUES
(12, 30, 'alimentario', '2semanas'),
(14, 10, 'alimentario', '4semanas'),
(17, 50, 'alimentario', '1semana');

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
(41, 'admin', '$2y$10$t/Fk2WTYr4QceD9i1Y1ZreNHG/AfENtSsgkBMP6JdHvyengzz4f0G', 'administrador', 'Admin', 'admin@admin.com', 'hombre', '2018-01-24 01:04:49', 'Admin', 'Sevilla', '2018-01-21 20:02:49'),
(42, 'gon', '$2y$10$EQSRBL53oMHAXJDNyZbzLuiHCFKaWfK8hDhHAjAoWxk1ThNssMQdi', 'usuario', 'Gonzalo', 'gonzq87@gmail.com', 'hombre', '2018-01-24 01:01:36', 'del RÃ­o AlÃ¡ez', 'Sevilla', '2018-01-21 20:07:12'),
(43, 'susana', '$2y$10$KMr1I7n748kASsIGLpfycu/LPvmGXZUszvGIsFaYGhO/.o.KIxL4e', 'usuario', 'Susana', 'susana@gmail.com', 'hombre', '2018-01-22 20:12:37', 'de la Calle Iglesias', 'Granada', '2018-01-21 20:20:01'),
(44, 'juan', '$2y$10$ZhCO.kaux4TiqGz3TGlBfOABmIWhsmUxBKaSggeOguVMbPCUCu4D.', 'usuario', 'Juan Antonio', 'juan@gmail.com', 'hombre', '2018-01-22 20:10:37', 'Lopez', 'CÃ¡diz', '2018-01-21 20:45:51'),
(45, 'carlos', '$2y$10$yeS9s9JVJ2v.5brY5rQfGeIgrEFj96DBhbIeMnUfpO.CGa707Ld3.', 'usuario', 'Carlos', 'cbarranco@gmail.com', 'hombre', '2018-01-21 21:03:19', 'Barranco', 'Sevilla', '2018-01-21 21:02:39');

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
(1, 2, 43),
(2, 3, 43),
(4, 10, 44),
(5, 15, 42),
(6, 13, 42),
(7, 10, 42),
(8, 14, 42),
(9, 12, 42),
(10, 11, 42),
(11, 15, 45),
(12, 13, 45),
(13, 11, 45),
(15, 2, 45),
(16, 12, 45),
(17, 14, 45),
(19, 17, 42),
(20, 16, 42),
(21, 18, 42),
(22, 18, 43),
(23, 16, 43),
(24, 2, 42);

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
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id_contenido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `estadisticasapp`
--
ALTER TABLE `estadisticasapp`
  MODIFY `id_baja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `voto`
--
ALTER TABLE `voto`
  MODIFY `id_voto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
