-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2024 a las 18:45:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

-- Base de datos: `pfiv2remoto321`
-- usuario remoto: rootpfiuser321
-- contraseña remota: pfipasskey22
-- correo: al066208@uacam.mx

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pfiv2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book`
--

CREATE TABLE `book` (
  `id_Book` varchar(255) NOT NULL,
  `id_borrowing` varchar(255) NOT NULL,
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
('20', 'Salamandra', 'Narrative', 'The play of light', 'Umbral', 'busy', 'Louise Penny'),
('5', 'Bubok', 'Didactic', 'Encoded Sacred Geometry', 'Elefante', 'busy', 'Angels Membrive'),
('50', 'Anagrama', 'Didactic', 'Shamans and robots', 'Gedisa', 'busy', 'Shamans and robots');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `borrowing`
--

CREATE TABLE `borrowing` (
  `id_borrowing` varchar(255) NOT NULL,
  `registration` int(11) NOT NULL,
  `type_borrowing` varchar(255) NOT NULL,
  `borrowing_date` datetime(6) NOT NULL,
  `return_date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `borrowing`
--

INSERT INTO `borrowing` (`id_borrowing`, `registration`, `type_borrowing`, `borrowing_date`, `return_date`) VALUES
('1', 68322, '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2', 69951, '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3', 68627, '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('Anagrama', 66208, '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('Bubok', 66132, '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('Salamandra', 62231, '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `computer`
--

CREATE TABLE `computer` (
  `id_computer` varchar(255) NOT NULL,
  `id_borrowing` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `loan_time` time NOT NULL,
  `time_of_devolution` time NOT NULL,
  `date` date NOT NULL,
  `registration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `computer`
--

INSERT INTO `computer` (`id_computer`, `id_borrowing`, `model`, `loan_time`, `time_of_devolution`, `date`, `registration`) VALUES
('2', '1', 'HP', '10:00:00', '14:00:00', '2024-03-01', 62231),
('5', '2', 'HP', '10:30:00', '13:00:00', '2024-03-01', 69951);

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
(12, 66208, 18, '2024-02-16'),
(21, 68322, 25, '2024-03-01'),
(23, 68355, 26, '2024-01-17'),
(36, 68627, 30, '0000-00-00'),
(47, 69951, 38, '2024-02-20'),
(51, 62231, 40, '2024-03-01'),
(62, 66915, 40, '2024-02-14'),
(68, 66132, 50, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lap`
--

CREATE TABLE `lap` (
  `no_series` int(11) NOT NULL,
  `id_borrowing` varchar(255) NOT NULL,
  `loan_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `registration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lap`
--

INSERT INTO `lap` (`no_series`, `id_borrowing`, `loan_date`, `delivery_date`, `registration`) VALUES
(6194728, '1', '2024-02-27', '0000-00-00', 68355),
(6810274, '2', '2024-02-20', '2024-03-01', 68627);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locker`
--

CREATE TABLE `locker` (
  `id_locker` varchar(255) NOT NULL,
  `id_borrowing` varchar(255) NOT NULL,
  `f_loan` date NOT NULL,
  `f_devolution` date NOT NULL,
  `registration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `locker`
--

INSERT INTO `locker` (`id_locker`, `id_borrowing`, `f_loan`, `f_devolution`, `registration`) VALUES
('1', '1', '2024-02-27', '2024-02-29', 68322),
('2', '2', '2024-02-07', '2024-02-09', 69951),
('3', '3', '2024-01-16', '2024-01-22', 68627);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registration_visit (registered)`
--

CREATE TABLE `registered_visits` (
  `no_Visit` int(11) NOT NULL,
  `registration` int(11) NOT NULL,
  `entry_time` time(6) NOT NULL,
  `exit_time` time(6) NOT NULL,
  `visit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registration_visit (registered)`
--

INSERT INTO `registered_visits` (`no_Visit`, `registration`, `entry_time`, `exit_time`, `visit_date`) VALUES
(12, 66208, '12:00:00.000000', '14:34:00.000000', '2024-03-02'),
(24, 68322, '09:00:00.000000', '12:24:00.000000', '2024-03-04'),
(34, 66915, '12:00:00.000000', '14:00:00.000000', '2024-03-03'),
(43, 62231, '10:00:00.000000', '15:00:00.000000', '2024-02-29'),
(51, 66132, '08:00:00.000000', '12:00:00.000000', '2024-03-01'),
(61, 68355, '10:40:00.000000', '13:00:00.000000', '2024-03-05'),
(63, 68627, '09:29:00.000000', '14:00:00.000000', '2024-03-06'),
(64, 69951, '10:32:00.000000', '12:00:00.000000', '2024-03-07');

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
(62231, 'Ricardo Arian', 'Puc', 'Duran', 'Hombre', '2003-05-14', 'Otro', 'ISC', 'Activo', 'Campeche', '2023-06-09'),
(66132, 'Angel Gabriel', 'Manrero', 'Hidalgo', 'Hombre', '2002-04-16', 'Otro', 'ISC', 'Activo', 'Campeche', '2021-02-03'),
(66208, 'Ricardo de jesus', 'Moo', 'Vargas', 'Hombre', '2001-10-29', 'Otro', 'ISC', 'Activo', 'Campeche', '2021-03-03'),
(66915, 'Jorge Francisco', 'Dzul', 'Cobos', 'Hombre', '2002-10-28', 'Otro', 'ISC', 'Activo', 'Campeche', '2021-07-02'),
(68322, 'Gael Alexander', 'Carrillo', 'Chan', 'Hombre', '2003-12-28', 'Otro', 'ISC', 'Activo', 'Campeche', '2022-11-15'),
(68355, 'Axel Alessandro', 'Chávez', 'Moreno', 'Hombre', '2003-10-18', 'Otro', 'ISC', 'Activo', 'Campeche', '2023-03-31'),
(68627, 'Arturo Alberto', 'Zavala', 'Morales', 'Hombre', '2002-12-06', 'Otro', 'ISC', 'Activo', 'Carmen', '2023-07-06'),
(69951, 'Uriel Isai', 'Landeros', 'Mijangos', 'Hombre', '2003-09-30', 'Otro', 'ISC', 'Activo', 'Campeche', '2023-04-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visit_registration (not registered)`
--

CREATE TABLE `unregistered_visits` (
  `no_Visit` int(11) NOT NULL,
  `registration` int(11) NOT NULL,
  `entry_time` time(6) NOT NULL,
  `exit_time` time(6) NOT NULL,
  `visit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_Book`),
  ADD UNIQUE KEY `Id_borrowing` (`id_borrowing`) USING BTREE;

--
-- Indices de la tabla `borrowing`
--
ALTER TABLE `borrowing`
  ADD PRIMARY KEY (`id_borrowing`),
  ADD UNIQUE KEY `Registration` (`registration`),
  ADD UNIQUE KEY `Id_borrowing` (`id_borrowing`);

--
-- Indices de la tabla `computer`
--
ALTER TABLE `computer`
  ADD PRIMARY KEY (`id_computer`),
  ADD UNIQUE KEY `Id_borrowing` (`id_borrowing`);

--
-- Indices de la tabla `copies`
--
ALTER TABLE `copies`
  ADD PRIMARY KEY (`registration_number`),
  ADD UNIQUE KEY `Registration` (`registration`);

--
-- Indices de la tabla `lap`
--
ALTER TABLE `lap`
  ADD PRIMARY KEY (`no_series`),
  ADD UNIQUE KEY `id_borrowing` (`id_borrowing`) USING BTREE;

--
-- Indices de la tabla `locker`
--
ALTER TABLE `locker`
  ADD PRIMARY KEY (`id_locker`),
  ADD UNIQUE KEY `Id_borrowing` (`id_borrowing`);

--
-- Indices de la tabla `registration_visit (registered)`
--
ALTER TABLE `registered_visits`
  ADD PRIMARY KEY (`no_Visit`),
  ADD UNIQUE KEY `registration` (`registration`) USING BTREE;

--
-- Indices de la tabla `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`registration`),
  ADD UNIQUE KEY `Registration` (`registration`);

--
-- Indices de la tabla `visit_registration (not registered)`
--
ALTER TABLE `unregistered_visits`
  ADD PRIMARY KEY (`no_Visit`),
  ADD UNIQUE KEY `registration` (`registration`) USING BTREE;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`Id_borrowing`) REFERENCES `borrowing` (`Id_borrowing`);

--
-- Filtros para la tabla `borrowing`
--
ALTER TABLE `borrowing`
  ADD CONSTRAINT `borrowing_ibfk_1` FOREIGN KEY (`Registration`) REFERENCES `students` (`Registration`);

--
-- Filtros para la tabla `computer`
--
ALTER TABLE `computer`
  ADD CONSTRAINT `computer_ibfk_1` FOREIGN KEY (`Id_borrowing`) REFERENCES `borrowing` (`Id_borrowing`);

--
-- Filtros para la tabla `copies`
--
ALTER TABLE `copies`
  ADD CONSTRAINT `copies_ibfk_1` FOREIGN KEY (`Registration`) REFERENCES `students` (`Registration`);

--
-- Filtros para la tabla `lap`
--
ALTER TABLE `lap`
  ADD CONSTRAINT `lap_ibfk_1` FOREIGN KEY (`Id_borrowing`) REFERENCES `borrowing` (`Id_borrowing`);

--
-- Filtros para la tabla `locker`
--
ALTER TABLE `locker`
  ADD CONSTRAINT `locker_ibfk_1` FOREIGN KEY (`Id_borrowing`) REFERENCES `borrowing` (`Id_borrowing`);

--
-- Filtros para la tabla `registration_visit (registered)`
--
ALTER TABLE `registered_visits`
  ADD CONSTRAINT `registration_visit (registered)_ibfk_1` FOREIGN KEY (`Registration`) REFERENCES `students` (`Registration`);

--
-- Filtros para la tabla `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`Registration`) REFERENCES `students` (`Registration`);

--
-- Filtros para la tabla `visit_registration (not registered)`
--
ALTER TABLE `unregistered_visits`
  ADD CONSTRAINT `visit_registration (not registered)_ibfk_1` FOREIGN KEY (`Registration`) REFERENCES `students` (`Registration`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
