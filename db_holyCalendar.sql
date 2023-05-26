-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-04-2023 a las 07:47:52
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_recordarme`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;



--
-- Volcado de datos para la tabla `users`
--

    INSERT INTO `users` (`id`, `nombre_usuario`, `email`, `password`, `rol`) VALUES ('1','usuario1','usuario1@example.com','$2y$10$CYY.0A2Jb0lYwTZs3BbNse7rEEzyIlwYfZszdEFtrJLOo7LjR2.BK','0'),
    ('2','usuario2','usuario2@example.com','$2y$10$Jlyz/3hz7yjA7vcymImb2uWOD0X5eFTGUG6LYxX.CIriuZu1umw0q','0'),
    ('3','usuario3','usuario3@example.com','$2y$10$ks0T6Sgy/NjF4F.j5CQ6HuU8DwoR3R2umknefR3gq2pNj81xLY1YO','1'),
    ('4','usuario4','usuario4@example.com','$2y$10$UnS2y.CvDPxE7i33Zhd9suSAG85.Vop1szeVou0HPjR5tY0.VhH9S','0'),
    ('5','usuario5','usuario5@example.com','$2y$10$hr2IDM/9ru/79qAxugBncO3tdLb4dTh0ASsWkGzOyziHAGmEbBgPC','0'),
    ('6','usuario6','usuario6@example.com','$2y$10$qQqYwcnUK0mbiVTtXrc1V.Mhpn5/TEpE6Y18KFf8rYQ1JXBRSSnou','0'),
    ('7','usuario7','usuario7@example.com','$2y$10$CFIJF8FXTMQUK67qAFZ2FOFYbNMQjixzEVrWjBu5YV8VX3.8QEWfq','1'),
    ('8','usuario8','usuario8@example.com','$2y$10$P.gqhy7Pzlb6MOfCbnd3ru6efjKF3mmVDhXMWmDgDk1wwYn6z8P2G','0'),
    ('9','usuario9','usuario9@example.com','$2y$10$WTXvEe.qO/t3YFsVW73e6.lR1duTZ9REgJKzInQGJO5M8GKwd4wC2','0'),
    ('10','usuario10','usuario10@example.com','$2y$10$2vnmB3Aplzg3EX96W1yf8eOwK43cA3OWGSaKSGq7.2HFsnzrdAVI6','1'),
    ('11','usuario11','usuario11@example.com','$2y$10$0wMf0j6QqSgMTcUHDGRqE.O68.yrBF5y41AVkHYGn3TBNX8RvDVo6','0'),
    ('12','usuario12','usuario12@example.com','$2y$10$y4M6Z5J/cUfL6ZIW.5dTOesdN7E0SRGe./Vz1SSZKJDD0MQKB8Xzi','0'),
    ('13','usuario13','usuario13@example.com','$2y$10$6sy3NL9qgA2vzkTm4uqySezx8DMKp96ToHPOyOGaXuDBZakATwF2K','0'),
    ('14','usuario14','usuario14@example.com','$2y$10$TL8C9JF.7Whiex3zNSe9UODRGmdy05yL8xiFD83Rv6t8TNZ/jx.d2','1'),
    ('15','usuario15','usuario15@example.com','$2y$10$qB.OYwnGO6cHqfnlaGQnCuqAI9ydNpxl07I0.wZrgL1X/06JmFhWW','0'),
    ('16','usuario16','usuario16@example.com','$2y$10$5wDG/DjBupOIB1l5ejKuO.wCKg2Ih8i8xhI58PHROA9R7.6Bjp9uy','0'),
    ('17','usuario17','usuario17@example.com','$2y$10$NTc31rMLkQ0X92EF80Mbc.lIH6xV9nV2IInJ.MzI/FBthW9Yg.qom','1'),
    ('18','usuario18','usuario18@example.com','$2y$10$RxEwXbLqjX.NwJp/u9mAGu8eA.nm1RLAxQqtWe0vGzQl4EGjEGYxu','0'),
    ('19','usuario19','usuario19@example.com','$2y$10$Qz53t1bGnWijgGHWwM7jsOYJsvbGw2vcfZiWyC2f1HHcQ8mHWIrM2','0'),
    ('20','usuario20','usuario20@example.com','$2y$10$N.0AJrtix0w4SzUqLZtqLO.Z1nBl0zDwFn1SfVqB9CzEMwTgXzDWq','0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text,
  `fecha_inicio` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `fecha_fin` date NOT NULL,
  `hora_fin` time NOT NULL,
  `color` varchar(255) DEFAULT '#3788d8',
  `ubicacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `titulo`, `descripcion`, `fecha_inicio`, `hora_inicio`, `fecha_fin`, `hora_fin`, `color`) VALUES
    (1, 'Procesión del Cristo de los Milagros', '<p>Procesión anual del <strong>Cristo de los Milagros</strong> por las calles de Málaga.</p>', '2023-06-15', '20:00', '2023-06-15', '23:00', '#D4AF37'),
    (2, 'Vía Crucis Penitencial', '<p>Vía Crucis penitencial en la <u>Iglesia de San Juan</u>.</p>', '2023-07-05', '19:30', '2023-07-05', '21:30', '#02cc24'),
    (3, 'Función Principal de Instituto', '<p>Función religiosa en honor al patrón de la cofradía.</p>', '2023-07-16', '11:00', '2023-07-16', '12:30', '#4903fc'),
    (4, 'Besapié al Santísimo Cristo', '<p>Jornada de veneración al <strong>Santísimo Cristo</strong>.</p>', '2023-08-02', '09:00', '2023-08-02', '19:00', '#f70505'),
    (5, 'Triduo Sacramental', '<p>Triduo sacramental en la <u>Capilla de los Dolores</u>.</p>', '2023-08-10', '19:00', '2023-08-12', '21:00', '#000000'),
    (6, 'Procesión de la Virgen de los Dolores', '<p>Procesión de la imagen de la <strong>Virgen de los Dolores</strong> por el centro histórico de la ciudad.</p>', '2023-08-15', '20:30', '2023-08-15', '23:30', '#0062e3'),
    (7, 'Festividad del Sagrado Corazón', '<p>Celebración de la festividad del <u>Sagrado Corazón de Jesús</u>.</p>', '2023-09-01', '18:00', '2023-09-01', '20:00', '#014a14'),
    (8, 'Besamanos a la Virgen del Carmen', '<p>Jornada de veneración a la <strong>Virgen del Carmen</strong>.</p>', '2023-09-08', '09:00', '2023-09-08', '21:00', '#D4AF37'),
    (9, 'Procesión del Santísimo Cristo', '<p>Procesión del <strong>Santísimo Cristo</strong> por las calles del barrio.</p>', '2023-09-15', '20:00', '2023-09-15', '23:00', '#02cc24'),
    (10, 'Función Solemne de la Cofradía', '<p>Función religiosa solemne en honor a la cofradía.</p>', '2023-10-05', '19:30', '2023-10-05', '21:30', '#4903fc'),
    (11, 'Besapié al Cristo de la Agonía', '<p>Jornada de veneración al <strong>Cristo de la Agonía</strong>.</p>', '2023-10-15', '09:00', '2023-10-15', '19:00', '#f70505'),
    (12, 'Triduo en Honor a la Virgen', '<p>Triduo en honor a la <strong>Virgen de la Cofradía</strong>.</p>', '2023-11-10', '19:00', '2023-11-12', '21:00', '#000000'),
    (13, 'Procesión de la Virgen del Rocío', '<p>Procesión de la imagen de la <strong>Virgen del Rocío</strong> por las calles de Málaga.</p>', '2023-11-15', '20:30', '2023-11-15', '23:30', '#0062e3'),
    (14, 'Festividad de la Inmaculada', '<p>Celebración de la festividad de la <u>Inmaculada Concepción</u>.</p>', '2023-12-01', '18:00', '2023-12-01', '20:00', '#014a14'),
    (15, 'Besamanos al Cristo de la Esperanza', '<p>Jornada de veneración al <strong>Cristo de la Esperanza</strong>.</p>', '2023-12-08', '09:00', '2023-12-08', '21:00', '#D4AF37'),
    (16, 'Procesión del Santísimo Cristo de la Redención', '<p>Procesión del <strong>Santísimo Cristo de la Redención</strong> por las calles del barrio.</p>', '2023-12-15', '20:00', '2023-12-15', '23:00', '#02cc24'),
    (17, 'Función Principal de la Cofradía', '<p>Función religiosa principal en honor a la cofradía.</p>', '2023-01-05', '19:30', '2023-01-05', '21:30', '#4903fc'),
    (18, 'Besapié al Santísimo Cristo de la Humildad', '<p>Jornada de veneración al <strong>Santísimo Cristo de la Humildad</strong>.</p>', '2023-01-15', '09:00', '2023-01-15', '19:00', '#f70505'),
    (19, 'Triduo de Cuaresma', '<p>Triduo de Cuaresma en la <u>Capilla de la Cofradía</u>.</p>', '2023-02-10', '19:00', '2023-02-12', '21:00', '#000000'),
    (20, 'Procesión de la Virgen de la Paz', '<p>Procesión de la imagen de la <strong>Virgen de la Paz</strong> por el centro histórico de la ciudad.</p>', '2023-02-15', '20:30', '2023-02-15', '23:30', '#0062e3'),
    (21, 'Procesión del Cristo de los Milagros', '<p>La Procesión del Cristo de los Milagros es uno de los eventos más esperados y emocionantes de nuestra cofradía. Cada año, miles de devotos se congregan para acompañar al Cristo en su recorrido por las calles de Málaga.</p><p>Esta solemne procesión es una muestra de fe y devoción, donde se mezclan el sonido de los tambores, las saetas y el aroma de los claveles. Es un momento de recogimiento y encuentro espiritual, donde cada paso del Cristo representa un milagro y una esperanza renovada.</p><p>Te invitamos a unirte a nosotros en esta jornada tan especial, para vivir una experiencia única llena de emociones y tradición.</p>', '2023-06-15', '20:00', '2023-06-15', '23:00', '#D4AF37'),
    (22, 'Vía Crucis Penitencial', '<p>El Vía Crucis Penitencial es una manifestación de fe que nos sumerge en la Pasión de Cristo. Durante este recorrido, en la emblemática Iglesia de San Juan, se representan las estaciones del camino de la Cruz, reviviendo los momentos de su sufrimiento y sacrificio.</p><p>Este acto penitencial nos invita a reflexionar sobre el amor y la redención que nos brinda Jesús. Cada estación nos lleva a contemplar los episodios más significativos de su camino hacia la crucifixión, recordándonos la importancia de la entrega y el perdón.</p><p>Únete a nosotros en esta profunda experiencia espiritual, donde la oración, la música y la veneración nos guiarán por los pasos de nuestro Salvador.</p>', '2023-07-05', '19:30', '2023-07-05', '21:30', '#02cc24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


--
-- Estructura de tabla para la tabla `users_events`
--

CREATE TABLE `users_events` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `evento_id` int(11) DEFAULT NULL,
  `asistencia` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users_events`
--

INSERT INTO users_events (id, usuario_id, evento_id, asistencia) VALUES
(1, 7, 9, 0),
(2, 3, 5, 1),
(3, 2, 3, 1),
(4, 1, 2, 0),
(5, 6, 7, 0),
(6, 10, 11, 1),
(7, 8, 9, 0),
(8, 5, 6, 1),
(9, 4, 5, 1),
(10, 9, 10, 0),
(11, 11, 12, 0),
(12, 13, 14, 1),
(13, 15, 16, 0),
(14, 12, 13, 1),
(15, 17, 18, 1),
(16, 14, 15, 0),
(17, 19, 20, 1),
(18, 16, 17, 0),
(19, 20, 1, 1),
(20, 18, 19, 0);

--
-- Indices de la tabla `users_events`
--
ALTER TABLE `users_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `evento_id` (`evento_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users_events`
--
ALTER TABLE `users_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;