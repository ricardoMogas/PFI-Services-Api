-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2024 a las 05:04:37
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pfiv3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book`
--

CREATE TABLE `book` (
  `id_Book` int(11) NOT NULL,
  `id_borrowing` int(11) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `publishers` varchar(255) NOT NULL,
  `status` char(255) NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `book`
--

INSERT INTO `book` (`id_Book`, `id_borrowing`, `gender`, `title`, `publishers`, `status`, `author`) VALUES
(5, 5, 'Didactic', 'Encoded Sacred Geometry', 'Elefante', 'busy', 'Angels Membrive'),
(20, 4, 'Narrative', 'The play of light', 'Umbral', 'busy', 'Louise Penny'),
(50, 6, 'Didactic', 'Shamans and robots', 'Gedisa', 'busy', 'Shamans and robots');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `borrowing`
--

CREATE TABLE `borrowing` (
  `id_borrowing` int(11) NOT NULL,
  `registration` int(11) NOT NULL,
  `type_borrowing` int(11) NOT NULL,
  `borrowing_date` datetime(6) NOT NULL,
  `return_date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `borrowing`
--

INSERT INTO `borrowing` (`id_borrowing`, `registration`, `type_borrowing`, `borrowing_date`, `return_date`) VALUES
(1, 68322, 1, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(2, 69951, 1, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(4, 66208, 2, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(5, 66132, 2, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(6, 62231, 2, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `computer`
--

CREATE TABLE `computer` (
  `id` int(11) NOT NULL,
  `no_series` int(11) NOT NULL,
  `id_borrowing` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `computer`
--

INSERT INTO `computer` (`id`, `no_series`, `id_borrowing`, `status`, `model`, `type`, `description`) VALUES
(1, 6194728, 1, 'Funcional', 'HP', 'Laptop', 'description generica con carateristicas, marca, etc.'),
(2, 6810274, 2, 'Funcional', 'HP', 'Escritorio', 'description generica con carateristicas, marca, etc.'),
(3, 123456, 1, 'Available', 'Test Model', 'Desktop', 'Test Computer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `copies`
--

CREATE TABLE `copies` (
  `registration_number` int(11) NOT NULL,
  `registration` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `copies`
--

INSERT INTO `copies` (`registration_number`, `registration`, `total`, `date`) VALUES
(1, 66208, 18, '2024-02-16'),
(2, 68322, 25, '2024-03-01'),
(3, 68355, 26, '2024-01-17'),
(4, 68627, 30, '0000-00-00'),
(5, 69951, 38, '2024-02-20'),
(6, 62231, 40, '2024-03-01'),
(7, 66915, 40, '2024-02-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locker`
--

CREATE TABLE `locker` (
  `id_locker` varchar(255) NOT NULL,
  `id_borrowing` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `locker`
--

INSERT INTO `locker` (`id_locker`, `id_borrowing`, `status`, `description`) VALUES
('1', NULL, 'Libre', 'DESCRIPCIÓN GENERICA 1234'),
('2', NULL, 'Libre', 'DESCRIPCIÓN GENERICA 1234'),
('3', NULL, 'Libre', 'DESCRIPCIÓN GENERICA 1234'),
('test1id', NULL, 'Libre', 'Locker 1'),
('test2id', NULL, 'Libre', 'Locker 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registered_visits`
--

CREATE TABLE `registered_visits` (
  `no_Visit` int(11) NOT NULL,
  `registration` int(11) NOT NULL,
  `entry_time` time(6) DEFAULT NULL,
  `exit_time` time(6) DEFAULT NULL,
  `visit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registered_visits`
--

INSERT INTO `registered_visits` (`no_Visit`, `registration`, `entry_time`, `exit_time`, `visit_date`) VALUES
(2, 68322, '09:00:00.000000', '12:24:00.000000', '2024-03-04'),
(3, 66915, '12:00:00.000000', '14:00:00.000000', '2024-03-03'),
(4, 62231, '10:00:00.000000', '15:00:00.000000', '2024-02-29'),
(5, 66132, '08:00:00.000000', '12:00:00.000000', '2024-03-01'),
(6, 68355, '10:40:00.000000', '13:00:00.000000', '2024-03-05'),
(7, 68627, '09:29:00.000000', '14:00:00.000000', '2024-03-06'),
(8, 69951, '10:32:00.000000', '12:00:00.000000', '2024-03-07'),
(12, 66208, '21:27:49.000000', '04:26:27.000000', '2024-03-26'),
(13, 66208, '06:21:08.000000', '06:23:20.000000', '2024-03-28'),
(14, 66208, '06:21:25.000000', '06:23:20.000000', '2024-03-28'),
(15, 66208, '06:21:27.000000', '06:23:20.000000', '2024-03-28'),
(16, 66208, '06:21:28.000000', '06:23:20.000000', '2024-03-28'),
(19, 66208, '00:12:43.000000', '01:26:41.000000', '2024-04-11'),
(20, 66208, '00:13:05.000000', '00:21:30.000000', '2024-04-10'),
(21, 66208, '01:10:42.000000', '01:26:41.000000', '2024-04-11'),
(22, 66208, '01:10:45.000000', '01:26:41.000000', '2024-04-11'),
(23, 66208, '01:10:46.000000', '01:26:41.000000', '2024-04-11'),
(24, 66208, '03:19:42.000000', '03:24:50.000000', '2024-04-16'),
(25, 66208, '22:23:18.000000', '22:24:00.000000', '2024-04-17'),
(26, 66208, '16:41:42.000000', '16:45:58.000000', '2024-05-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students`
--

CREATE TABLE `students` (
  `registration` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `p_last_name` varchar(255) NOT NULL,
  `m_last_name` varchar(255) NOT NULL,
  `gender` char(255) NOT NULL,
  `birthday_date` date NOT NULL,
  `ethnicity` varchar(255) NOT NULL,
  `career` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `origin_place` varchar(255) NOT NULL,
  `date_of_registration` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `students`
--

INSERT INTO `students` (`registration`, `name`, `p_last_name`, `m_last_name`, `gender`, `birthday_date`, `ethnicity`, `career`, `status`, `origin_place`, `date_of_registration`) VALUES
(1231, 'TEST', 'N/A', 'N/A', 'Hombre', '2024-05-09', 'Otomi', 'ISC', 'Baja temporal', 'asdf', '2024-05-10'),
(12312, 'TEST1', 'N/A', 'N/A', 'Hombre', '2024-05-09', 'Otomi', 'ISC', 'Baja temporal', 'asdf', '2024-05-10'),
(62231, 'Ricardo Arian', 'Puc', 'Duran', 'Hombre', '2003-05-14', 'Otro', 'ISC', 'Activo', 'Campeche', '2023-06-09'),
(66132, 'Angel Gabriel', 'Manrero', 'Hidalgo', 'Hombre', '2002-04-16', 'Otro', 'ISC', 'Activo', 'Campeche', '2021-02-03'),
(66208, 'Ricardo de jesus', 'Moo', 'Vargas', 'Hombre', '2001-10-29', 'Otro', 'ISC', 'Activo', 'Campeche', '2021-03-03'),
(66209, 'Alvira Jesus Hidalgo pech', '', '', 'Mujer', '2001-10-28', 'Otro', 'ISC', 'Activo', 'Campeche', '2024-04-29'),
(66915, 'Jorge Francisco', 'Dzul', 'Cobos', 'Hombre', '2002-10-28', 'Otro', 'ISC', 'Activo', 'Campeche', '2021-07-02'),
(68322, 'Gael Alexander', 'Carrillo', 'Chan', 'Hombre', '2003-12-28', 'Otro', 'ISC', 'Activo', 'Campeche', '2022-11-15'),
(68355, 'Axel Alessandro', 'Chávez', 'Moreno', 'Hombre', '2003-10-18', 'Otro', 'ISC', 'Activo', 'Campeche', '2023-03-31'),
(68627, 'Arturo Alberto', 'Zavala', 'Morales', 'Hombre', '2002-12-06', 'Otro', 'ISC', 'Activo', 'Carmen', '2023-07-06'),
(69951, 'Uriel Isai', 'Landeros', 'Mijangos', 'Hombre', '2003-09-30', 'Otro', 'ISC', 'Activo', 'Campeche', '2023-04-03'),
(69952, 'testawa', 'test2', 'test2', 'Hombre', '1990-01-01', 'Otro', 'ISC', 'Activo', 'Campeche', '2024-04-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_borrowing`
--

CREATE TABLE `type_borrowing` (
  `id_type` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `type_borrowing`
--

INSERT INTO `type_borrowing` (`id_type`, `name`) VALUES
(1, 'computer'),
(2, 'book'),
(3, 'locker');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unregistered_visits`
--

CREATE TABLE `unregistered_visits` (
  `no_Visit` int(11) NOT NULL,
  `registration` int(11) NOT NULL,
  `entry_time` time(6) DEFAULT NULL,
  `exit_time` time(6) DEFAULT NULL,
  `visit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unregistered_visits`
--

INSERT INTO `unregistered_visits` (`no_Visit`, `registration`, `entry_time`, `exit_time`, `visit_date`) VALUES
(1, 66208, '05:52:06.000000', '01:36:31.000000', '2024-03-27'),
(2, 66208, '06:05:11.000000', '01:36:31.000000', '2024-03-27'),
(3, 66208, '06:24:45.000000', '01:36:31.000000', '2024-03-27'),
(4, 66208, '06:26:22.000000', '01:36:31.000000', '2024-03-27'),
(5, 66208, '06:26:45.000000', '01:36:31.000000', '2024-03-27'),
(6, 66209, '01:31:20.000000', '01:45:15.000000', '2024-03-28'),
(7, 66205, '22:35:11.000000', '22:53:49.000000', '2024-04-17'),
(8, 66205, '22:39:06.000000', '22:53:49.000000', '2024-04-17'),
(9, 66209, '22:40:45.000000', '22:55:09.000000', '2024-04-17'),
(10, 66209, '22:40:55.000000', '22:55:09.000000', '2024-04-17'),
(11, 66209, '22:40:58.000000', '22:55:09.000000', '2024-04-17'),
(12, 66209, '22:41:02.000000', '22:55:09.000000', '2024-04-17'),
(13, 66205, '16:46:12.000000', NULL, '2024-05-08'),
(14, 66205, '16:34:02.000000', '16:35:37.000000', '2024-05-09'),
(15, 66205, '16:34:08.000000', '16:35:37.000000', '2024-05-09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_Book`),
  ADD KEY `id_borrowing` (`id_borrowing`);

--
-- Indices de la tabla `borrowing`
--
ALTER TABLE `borrowing`
  ADD PRIMARY KEY (`id_borrowing`) USING BTREE,
  ADD KEY `registration_fkey` (`registration`) USING BTREE,
  ADD KEY `type_borrowing` (`type_borrowing`);

--
-- Indices de la tabla `computer`
--
ALTER TABLE `computer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_borrowing` (`id_borrowing`);

--
-- Indices de la tabla `copies`
--
ALTER TABLE `copies`
  ADD PRIMARY KEY (`registration_number`) USING BTREE,
  ADD KEY `registration` (`registration`);

--
-- Indices de la tabla `locker`
--
ALTER TABLE `locker`
  ADD PRIMARY KEY (`id_locker`),
  ADD KEY `id_borrowing` (`id_borrowing`) USING BTREE;

--
-- Indices de la tabla `registered_visits`
--
ALTER TABLE `registered_visits`
  ADD PRIMARY KEY (`no_Visit`) USING BTREE,
  ADD KEY `registration_fk` (`registration`) USING BTREE;

--
-- Indices de la tabla `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`registration`);

--
-- Indices de la tabla `type_borrowing`
--
ALTER TABLE `type_borrowing`
  ADD PRIMARY KEY (`id_type`);

--
-- Indices de la tabla `unregistered_visits`
--
ALTER TABLE `unregistered_visits`
  ADD PRIMARY KEY (`no_Visit`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `book`
--
ALTER TABLE `book`
  MODIFY `id_Book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `borrowing`
--
ALTER TABLE `borrowing`
  MODIFY `id_borrowing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `computer`
--
ALTER TABLE `computer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `copies`
--
ALTER TABLE `copies`
  MODIFY `registration_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `registered_visits`
--
ALTER TABLE `registered_visits`
  MODIFY `no_Visit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `students`
--
ALTER TABLE `students`
  MODIFY `registration` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69953;

--
-- AUTO_INCREMENT de la tabla `type_borrowing`
--
ALTER TABLE `type_borrowing`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `unregistered_visits`
--
ALTER TABLE `unregistered_visits`
  MODIFY `no_Visit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`id_borrowing`) REFERENCES `borrowing` (`id_borrowing`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `borrowing`
--
ALTER TABLE `borrowing`
  ADD CONSTRAINT `borrowing_ibfk_1` FOREIGN KEY (`registration`) REFERENCES `students` (`registration`),
  ADD CONSTRAINT `borrowing_ibfk_2` FOREIGN KEY (`type_borrowing`) REFERENCES `type_borrowing` (`id_type`);

--
-- Filtros para la tabla `computer`
--
ALTER TABLE `computer`
  ADD CONSTRAINT `computer_ibfk_1` FOREIGN KEY (`id_borrowing`) REFERENCES `borrowing` (`id_borrowing`);

--
-- Filtros para la tabla `copies`
--
ALTER TABLE `copies`
  ADD CONSTRAINT `copies_ibfk_1` FOREIGN KEY (`registration`) REFERENCES `students` (`registration`);

--
-- Filtros para la tabla `locker`
--
ALTER TABLE `locker`
  ADD CONSTRAINT `locker_ibfk_1` FOREIGN KEY (`id_borrowing`) REFERENCES `borrowing` (`id_borrowing`);

--
-- Filtros para la tabla `registered_visits`
--
ALTER TABLE `registered_visits`
  ADD CONSTRAINT `registered_visits_ibfk_1` FOREIGN KEY (`registration`) REFERENCES `students` (`registration`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
