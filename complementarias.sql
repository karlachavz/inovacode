-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2025 a las 21:08:47
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
-- Base de datos: `complementarias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_admin` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_admin`, `usuario`, `correo`, `contrasena`) VALUES
(6, 'Donovan', 'donovan@gmail.com', '12345'),
(7, 'Jhonatan', 'jhon@gmail.com', '12345'),
(8, 'Sebastian', 'sebastian@gmail.com', '12345'),
(9, 'Jhonatanhjkhj', 'jhon@gmail.com', '123456'),
(10, 'Robertoooooo', 'DANIA@GMIAL.COM', '12345678'),
(16, 'dfgg', 'holla@gmail.com', 'jksdjkfuif'),
(19, 'Roberto', 'holla@gmail.com', 'dfjkkgvv'),
(20, 'rejlw', 'roberto@gmail.com', 'rjweklrjwkljrlwjrkl');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `control` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `carrera` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`control`, `nombre`, `apellido_paterno`, `apellido_materno`, `carrera`, `correo`, `contrasena`) VALUES
(29, 'Juana', 'Ortiz', 'Sanchez', 'TICS', 'holla@gmail.com', '12345'),
(290, 'fernandaaaa', 'Luna', 'Dominguez', 'TICS', 'fer@gmail.com', '12345'),
(223107300, 'Monserrat', 'Castañeda', 'Amador', 'Ingeniería en Administración', 'DANIA@GMIAL.COM', 'BNMBNMBM'),
(223107402, 'Karla', 'Alcon', 'Dominguez', 'ISC', 'holla@gmail.com', '12345678'),
(223107403, 'Karla', 'Alcon', 'Dominguez', 'TICS', 'DANIA@GMIAL.COM', '12345678'),
(223107450, 'Yoa', 'Alcon', 'Ochoa', 'TICS', 'holla@gmail.com', '123456'),
(223107500, 'Amanda', 'Luna', 'Dominguez', 'Contaduria', 'jhon@gmail.com', '12345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`control`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
