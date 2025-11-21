-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2025 a las 05:57:28
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignar_grupo_profesor`
--

CREATE TABLE `asignar_grupo_profesor` (
  `id_asignar_grupo_profesor` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignar_horario_grupo`
--

CREATE TABLE `asignar_horario_grupo` (
  `id_asignar_horario_grupo` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `complemenetarias`
--

CREATE TABLE `complemenetarias` (
  `id_complementaria` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `imgen` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `id_complementaria` int(11) NOT NULL,
  `nombre_del_grupo` varchar(255) NOT NULL,
  `cupos_disponibles` int(11) NOT NULL,
  `cupos_ocupados` int(11) NOT NULL,
  `creditos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id_horario` int(11) NOT NULL,
  `hora` time NOT NULL,
  `dia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id_profesor` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(200) NOT NULL,
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indices de la tabla `asignar_grupo_profesor`
--
ALTER TABLE `asignar_grupo_profesor`
  ADD PRIMARY KEY (`id_asignar_grupo_profesor`),
  ADD KEY `fk_asignar_grupo_profesor_grupos` (`id_grupo`),
  ADD KEY `fk_Asignar_grupo_profesor_Profesor` (`id_profesor`);

--
-- Indices de la tabla `asignar_horario_grupo`
--
ALTER TABLE `asignar_horario_grupo`
  ADD PRIMARY KEY (`id_asignar_horario_grupo`),
  ADD KEY `fk_Asignar_grupo_horario_grupo_Grupo` (`id_grupo`),
  ADD KEY `fk_asignar_horario_grupo_Horario` (`id_horario`);

--
-- Indices de la tabla `complemenetarias`
--
ALTER TABLE `complemenetarias`
  ADD PRIMARY KEY (`id_complementaria`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `fk_Grupos_Complementarias` (`id_complementaria`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horario`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id_profesor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `asignar_grupo_profesor`
--
ALTER TABLE `asignar_grupo_profesor`
  MODIFY `id_asignar_grupo_profesor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asignar_horario_grupo`
--
ALTER TABLE `asignar_horario_grupo`
  MODIFY `id_asignar_horario_grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `complemenetarias`
--
ALTER TABLE `complemenetarias`
  MODIFY `id_complementaria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id_profesor` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignar_grupo_profesor`
--
ALTER TABLE `asignar_grupo_profesor`
  ADD CONSTRAINT `fk_Asignar_grupo_profesor_Profesor` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id_profesor`),
  ADD CONSTRAINT `fk_asignar_grupo_profesor_grupos` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`);

--
-- Filtros para la tabla `asignar_horario_grupo`
--
ALTER TABLE `asignar_horario_grupo`
  ADD CONSTRAINT `fk_Asignar_grupo_horario_grupo_Grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`),
  ADD CONSTRAINT `fk_asignar_horario_grupo_Horario` FOREIGN KEY (`id_horario`) REFERENCES `horarios` (`id_horario`);

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `fk_Grupos_Complementarias` FOREIGN KEY (`id_complementaria`) REFERENCES `complemenetarias` (`id_complementaria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
