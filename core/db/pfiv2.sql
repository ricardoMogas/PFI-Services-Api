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
-- Base de datos: `pfiv3`
--
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
(3, 68627, 1, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(4, 66208, 2, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(5, 66132, 2, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(6, 62231, 2, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `type_borrowing`
--
CREATE TABLE `type_borrowing` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- Volcado de datos para la tabla `type_borrowing`
--
INSERT INTO `type_borrowing` (`id_type`, `name`) VALUES
(1, 'Computadora'),
(2, 'Libro'),
(3, 'Locker');
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `book`
--
CREATE TABLE `book` (
  `id_Book` int(11) NOT NULL AUTO_INCREMENT,
  `id_borrowing` int(11) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `publishers` varchar(255) NOT NULL,
  `status` char(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  PRIMARY KEY (`id_Book`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- Volcado de datos para la tabla `book`
--
INSERT INTO `book` (`id_Book`, `id_borrowing`, `gender`, `title`, `publishers`, `status`, `author`) VALUES
(20, 4, 'Narrative', 'The play of light', 'Umbral', 'busy', 'Louise Penny'),
(5, 5, 'Didactic', 'Encoded Sacred Geometry', 'Elefante', 'busy', 'Angels Membrive'),
(50, 6, 'Didactic', 'Shamans and robots', 'Gedisa', 'busy', 'Shamans and robots');
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `computer`
--
CREATE TABLE `computer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_series` int(11) NOT NULL,
  `id_borrowing` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- Volcado de datos para la tabla `computer`
--
INSERT INTO `computer` (`no_series`, `id_borrowing`, `status`, `model`, `type`, `description`) VALUES
(6194728, 1, 'Funcional', 'HP', 'Laptop', 'description generica con carateristicas, marca, etc.'),
(6810274, 2, 'Funcional', 'HP', 'Escritorio', 'description generica con carateristicas, marca, etc.');
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `locker`
--

CREATE TABLE `locker` (
  `id_locker` varchar(255) NOT NULL,
  `id_borrowing` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id_locker`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `locker`
--

INSERT INTO `locker` (`id_locker`, `status`, `description`) VALUES
('1', 'Libre', 'DESCRIPCIÓN GENERICA 1234'),
('2', 'Libre', 'DESCRIPCIÓN GENERICA 1234'),
('3', 'Libre', 'DESCRIPCIÓN GENERICA 1234');
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `copies`
--

CREATE TABLE `copies` (
  `registration_number` int(11) NOT NULL AUTO_INCREMENT,
  `registration` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`registration_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- Volcado de datos para la tabla `copies`
--
INSERT INTO `copies` (`registration`, `total`, `date`) VALUES
(66208, 18, '2024-02-16'),
(68322, 25, '2024-03-01'),
(68355, 26, '2024-01-17'),
(68627, 30, '0000-00-00'),
(69951, 38, '2024-02-20'),
(62231, 40, '2024-03-01'),
(66915, 40, '2024-02-14'),
(66132, 50, '0000-00-00');
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `registered_visits`
--
CREATE TABLE `registered_visits` (
  `no_Visit` int(11) NOT NULL AUTO_INCREMENT,
  `registration` int(11) NOT NULL,
  `entry_time` time(6) DEFAULT NULL,
  `exit_time` time(6) DEFAULT NULL,
  `visit_date` date NOT NULL,
  PRIMARY KEY (`no_Visit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- Volcado de datos para la tabla `registered_visits`
--
INSERT INTO `registered_visits` (`registration`, `entry_time`, `exit_time`, `visit_date`) VALUES
(66208, '12:00:00.000000', '14:34:00.000000', '2024-03-02'),
(68322, '09:00:00.000000', '12:24:00.000000', '2024-03-04'),
(66915, '12:00:00.000000', '14:00:00.000000', '2024-03-03'),
(62231, '10:00:00.000000', '15:00:00.000000', '2024-02-29'),
(66132, '08:00:00.000000', '12:00:00.000000', '2024-03-01'),
(68355, '10:40:00.000000', '13:00:00.000000', '2024-03-05'),
(68627, '09:29:00.000000', '14:00:00.000000', '2024-03-06'),
(69951, '10:32:00.000000', '12:00:00.000000', '2024-03-07');
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `unregistered_visits`
--
CREATE TABLE `unregistered_visits` (
  `no_Visit` int(11) NOT NULL AUTO_INCREMENT,
  `registration` int(11) NOT NULL,
  `entry_time` time(6) NOT NULL,
  `exit_time` time(6) NOT NULL,
  `visit_date` date NOT NULL,
  PRIMARY KEY (`no_Visit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
