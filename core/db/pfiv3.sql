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
(5, NULL, 'Didactic', 'Encoded Sacred Geometry', 'Elefante', 'busy', 'Angels Membrive'),
(20, NULL, 'Narrative', 'The play of light', 'Umbral', 'busy', 'Louise Penny'),
(50, NULL, 'Didactic', 'Shamans and robots', 'Gedisa', 'busy', 'Shamans and robots');

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
(1, 6194728, NULL, 'Funcional', 'HP', 'Laptop', 'description generica con carateristicas, marca, etc.'),
(2, 6810274, NULL, 'Funcional', 'HP', 'Escritorio', 'description generica con carateristicas, marca, etc.'),
(3, 123456, NULL, 'Available', 'Test Model', 'Desktop', 'Test Computer');

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
(12312, 'TEST1', 'N/A', 'N/A', 'Hombre', '2024-05-09', 'Otomi', 'ISC', 'Baja temporal', 'asdf', '2024-05-10');
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
