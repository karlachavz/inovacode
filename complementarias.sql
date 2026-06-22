-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2026 a las 06:36:03
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
  `id_administrador` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `correo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_administrador`, `id_usuario`, `nombre`, `apellido_paterno`, `apellido_materno`, `correo`) VALUES
(29, 11, 'Karla', 'Chavez', 'Castillo', 'karla@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `numero_control` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `id_division` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `creditos` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`numero_control`, `nombre`, `apellido_paterno`, `apellido_materno`, `id_division`, `correo`, `id_usuario`, `creditos`) VALUES
(213107291, 'Sarahi', 'Ochoa', 'Cuellar', 1, 'jhon@gmail.com', 33, 0),
(223107252, 'Teresita', 'Arriagas', 'Sierra', 1, '223107252@cuautitlan.tecnm.mx', 6, 0),
(223107300, 'Carolina', 'Martinez', 'Castillo', 3, '223107300@cuautitlan.tecnm.mx', 31, 0),
(223107402, 'Karla', 'Chavez', 'Castillo', 1, '223107402@cuautitlan.tecnm.mx', 29, 0),
(223107405, 'Molly', 'Molina', 'Sanchez', 1, '223107405@cuautitlan.tecnm.mx', 18, 0),
(223107424, 'Dania', 'Contreras', 'Porfirio', 1, '223107424@cuautitlan.tecnm.mx', 32, 0),
(223107599, 'Jaquelyn', 'Montolla', 'Moya', 3, '223107599@cuautitlan.tecnm.mx', 25, 0),
(223107800, 'Carlos', 'Soto', 'Reyes', 7, 'jhon@gmail.com', 35, 0),
(223108222, 'Daria', 'Baltazar', 'Ruiz', 1, '22310822@cuautitlan.tecnm.mx', 13, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `id_grupo_alumno` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_estado_asistencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `complementarias`
--

CREATE TABLE `complementarias` (
  `id_complementaria` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `imagen` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `complementarias`
--

INSERT INTO `complementarias` (`id_complementaria`, `nombre`, `descripcion`, `imagen`) VALUES
(29, 'Escolta', 'Se parte de la escolta', '../img/imagenes-complementarias/escolta.jpg'),
(30, 'Fotografía ', 'La fotografía es el arte y la técnica de crear imágenes a partir de la luz que se proyecta sobre un material sensible.', '../img/imagenes-complementarias/foto.jpg'),
(31, 'Futbol', 'Juega en equipo y gana', '../img/imagenes-complementarias/futbol.jpg'),
(35, 'Tocho', 'Es una modalidad del fútbol americano que se juega sin contacto físico fuerte. ', '../img/imagenes-complementarias/tocho.jpg'),
(37, 'Teatro', 'El teatro es un arte escénico que consiste en representar historias, reales o ficticias, frente a una audiencia en vivo.', '../img/imagenes-complementarias/teatro.jpg'),
(38, 'Lectura', ' Dinámica grupal y participativa en la que los asistentes leen y trabajan con diversos textos', '../img/imagenes-complementarias/taller-de-lectura.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia`
--

CREATE TABLE `dia` (
  `id_dia` int(11) NOT NULL,
  `dia` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dia`
--

INSERT INTO `dia` (`id_dia`, `dia`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miércoles'),
(4, 'Jueves '),
(5, 'Viernes'),
(6, 'Sábado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divisiones`
--

CREATE TABLE `divisiones` (
  `id_division` int(11) NOT NULL,
  `division` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `divisiones`
--

INSERT INTO `divisiones` (`id_division`, `division`) VALUES
(1, 'Sistemas Computacionales'),
(2, 'Gestión Empresarial'),
(3, 'Ingeniería Química'),
(4, 'Contador Público'),
(5, 'Ingeniería Industrial'),
(6, 'Ingeniería en Logística'),
(7, 'Ingeniería Mecatrónica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `estado`) VALUES
(3, 'Visible'),
(4, 'Oculta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_asistencia`
--

CREATE TABLE `estado_asistencia` (
  `id_estado_asistencia` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_asistencia`
--

INSERT INTO `estado_asistencia` (`id_estado_asistencia`, `estado`) VALUES
(1, 'pendiente'),
(2, 'Asistio'),
(3, 'Falta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_grupo_alumno`
--

CREATE TABLE `estado_grupo_alumno` (
  `id_estado_grupo_alumno` tinyint(1) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_grupo_alumno`
--

INSERT INTO `estado_grupo_alumno` (`id_estado_grupo_alumno`, `estado`) VALUES
(1, 'inscrito'),
(2, 'aprobada'),
(3, 'Reprobada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `id_complementaria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cupos_disponibles` int(11) NOT NULL,
  `creditos` int(11) NOT NULL,
  `id_profesor` int(11) DEFAULT NULL,
  `id_periodo` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `id_complementaria`, `nombre`, `cupos_disponibles`, `creditos`, `id_profesor`, `id_periodo`, `id_estado`) VALUES
(60, 30, 'Fotografía 1', 28, 1, 9, 4, 3),
(61, 30, 'Fotografía 2', 40, 1, 9, 4, 3),
(62, 30, 'Fotografía 3', 40, 1, 7, 4, 3),
(63, 30, 'Fotografía 4', 39, 1, 8, 4, 3),
(64, 31, 'Futbol 1', 17, 1, 9, 4, 3),
(69, 31, 'Futbol', 19, 1, 9, 4, 3),
(71, 29, 'Escolta 1', 9, 1, 7, 2, 3),
(72, 35, 'Tocho 1', 0, 2, 9, 4, 3),
(73, 35, 'Tocho 2', 2, 1, 7, 4, 3),
(74, 37, 'Teatro 1', 1, 2, 10, 4, 3),
(76, 29, 'Escolta 2', 20, 3, 7, 4, 3),
(77, 30, 'Fotografia 5', 9, 3, 7, 2, 3),
(78, 38, 'Lectura 1', 10, 2, 8, 4, 3),
(80, 29, 'Escolta 3', 1, 4, 10, 2, 3),
(81, 29, 'Escolta 5', 3, 1, 7, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_alumno`
--

CREATE TABLE `grupo_alumno` (
  `id_grupo_alumno` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_estado_grupo_alumno` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupo_alumno`
--

INSERT INTO `grupo_alumno` (`id_grupo_alumno`, `id_grupo`, `id_alumno`, `id_estado_grupo_alumno`) VALUES
(6, 61, 223107300, 1),
(7, 63, 223107300, 1),
(15, 64, 213107291, 1),
(16, 64, 223107402, 1),
(23, 60, 223107402, 1),
(24, 63, 223107402, 1),
(25, 72, 223107402, 1),
(26, 74, 223107402, 1),
(27, 60, 223107800, 1),
(28, 71, 223107800, 1),
(29, 64, 223107800, 1),
(30, 74, 223107800, 1),
(31, 73, 223107800, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id_horario` int(11) NOT NULL,
  `id_dia` int(6) NOT NULL,
  `hora_inicio` varchar(11) NOT NULL,
  `hora_fin` varchar(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id_horario`, `id_dia`, `hora_inicio`, `hora_fin`, `id_grupo`) VALUES
(39, 6, '13:00', '14:00', 60),
(40, 3, '14:00', '15:00', 61),
(41, 3, '16:00', '17:00', 62),
(42, 4, '17:00', '18:00', 63),
(43, 3, '07:00', '08:00', 64),
(48, 2, '18:00', '19:00', 69),
(50, 3, '07:00', '08:00', 71),
(51, 1, '14:00', '15:00', 72),
(52, 4, '16:00', '17:00', 72),
(53, 2, '10:00', '11:00', 73),
(54, 3, '15:00', '16:00', 73),
(55, 2, '13:00', '14:00', 74),
(57, 3, '15:00', '16:00', 76),
(58, 3, '14:00', '15:00', 76),
(59, 3, '11:00', '12:00', 77),
(60, 3, '17:00', '18:00', 78),
(62, 3, '14:00', '15:00', 80),
(63, 3, '07:00', '08:00', 81);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `id_periodo` int(11) NOT NULL,
  `periodo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id_periodo`, `periodo`) VALUES
(2, '2025-2'),
(3, '2026-1'),
(4, '2026-2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id_profesor` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id_profesor`, `nombre`, `apellido_paterno`, `apellido_materno`, `correo`, `id_usuario`) VALUES
(7, 'Araceli', 'Villa', 'Sierra', 'holla@gmail.com', 27),
(8, 'Baltazar', 'Estrella', 'Sierra', 'profe01@cuautitlan.tecnm.mx', 28),
(9, 'Joel', 'Martinez', 'Melchor', 'joel@cuautitlan.tecnm.mx', 30),
(10, 'Juanita', 'Hernandez', 'Amador', 'juanita123@gmail.com', 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuarios`
--

CREATE TABLE `tipos_usuarios` (
  `id_tipo_usuario` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_usuarios`
--

INSERT INTO `tipos_usuarios` (`id_tipo_usuario`, `tipo`) VALUES
(1, 'Alumno '),
(2, 'Profesor'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_tipo_usuario`, `usuario`, `contrasena`) VALUES
(6, 1, '223107252', '$2y$10$G72QtwGNeghqYMwqLKmzl.wUP9mycUNaP/IOeKvS2SAiRxbTMIhiu'),
(11, 3, 'admin2', '$2y$10$wedf51c8QelOko65skoTVu0yMDaEINKhEsB2pHGDMELVGbUiPz.qe'),
(13, 1, '223108222', '$2y$10$4d9nuEOBmGUvjnwZlY8sRe0/9UoO1ultk6jM1b5962gextb2FWKCm'),
(18, 1, '223107405', '$2y$10$ZeOXuUlm2Zu5rF1DEcTzde259FDNh69w0AErttQV2RCo9WtK/Pkku'),
(25, 1, '223107599', '$2y$10$avSgnRQ.vAXvY.xlWvZhqOnhiQoXXuvOZ1WcQzISPrLu2Z8hzStKy'),
(27, 2, 'profesor2', '$2y$10$mEQoAcaoHNITTJGSYv6z5uJg.2mpffKI7QOI/GkFDkU8UsPZMPyhS'),
(28, 2, 'profesor1', '$2y$10$FD6irSCNwyHMNuZVsmY/7eV6tjwbIMKxrK6U9TUeDwE1iCRgCbgkK'),
(29, 1, '223107402', '$2y$10$CB7TqVCIoJaY/7M4zNaZN.EFOWSV18VDb66QFzzkMNf.IbJoFUN22'),
(30, 2, 'profesor3', '$2y$10$cuGwvw9MOId7K8bWzcJRAuhmGkD5kgR3DKqeX7xhpKcrsmq1e29cG'),
(31, 1, '223107300', '$2y$10$sZGtUGrNQkNqmNGP4zhcw.lc1KJVCCCKRyx4xo/U.950Tcxut6b2m'),
(32, 1, '223107424', '$2y$10$97wQevj65ZNdBBrqe.WlQOZARdhMWSzxTrE.oLgYmabBPtHZ12joC'),
(33, 1, '213107291', '$2y$10$KCwGRRJoOLOjPYiQLyYSTe2FI7/CgO9UfELSwj4iPgXHqfpU4.Ina'),
(35, 1, '223107800', '$2y$10$E0bQtQzdHnXV2rPK8x2Pz.rAmSm3nrZsmZxHcYQIp0xJnuKnRqHJC'),
(36, 2, 'Profesor3', '$2y$10$40RjMuJNCgUxCHWi8TczKeKIPkGtfOieeTvMP6htCvnGr/AIuM.Uq');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_administrador`),
  ADD KEY `fk_administrador_usuario` (`id_usuario`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`numero_control`),
  ADD KEY `fk_alumnos_usuarios` (`id_usuario`),
  ADD KEY `fk_alumnos_divisiones` (`id_division`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `fk_asistencia_grupo_alumno` (`id_grupo_alumno`),
  ADD KEY `fk_asistencia_estado` (`id_estado_asistencia`);

--
-- Indices de la tabla `complementarias`
--
ALTER TABLE `complementarias`
  ADD PRIMARY KEY (`id_complementaria`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `dia`
--
ALTER TABLE `dia`
  ADD PRIMARY KEY (`id_dia`);

--
-- Indices de la tabla `divisiones`
--
ALTER TABLE `divisiones`
  ADD PRIMARY KEY (`id_division`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `estado_asistencia`
--
ALTER TABLE `estado_asistencia`
  ADD PRIMARY KEY (`id_estado_asistencia`);

--
-- Indices de la tabla `estado_grupo_alumno`
--
ALTER TABLE `estado_grupo_alumno`
  ADD PRIMARY KEY (`id_estado_grupo_alumno`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `fk_grupos_periodo` (`id_periodo`),
  ADD KEY `fk_grupos_estado` (`id_estado`),
  ADD KEY `fk_grupos_profesor` (`id_profesor`),
  ADD KEY `fk_grupos_complementaria` (`id_complementaria`);

--
-- Indices de la tabla `grupo_alumno`
--
ALTER TABLE `grupo_alumno`
  ADD PRIMARY KEY (`id_grupo_alumno`),
  ADD KEY `fk_ga_grupo` (`id_grupo`),
  ADD KEY `fk_ga_alumno` (`id_alumno`),
  ADD KEY `fk_grupo_alumno_estado_grupo_alumno` (`id_estado_grupo_alumno`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `fk_horarios_grupo` (`id_grupo`),
  ADD KEY `fk_horarios_dia` (`id_dia`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id_profesor`),
  ADD KEY `fk_profesores_usuario` (`id_usuario`);

--
-- Indices de la tabla `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuarios_tipos_usuarios` (`id_tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `complementarias`
--
ALTER TABLE `complementarias`
  MODIFY `id_complementaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `dia`
--
ALTER TABLE `dia`
  MODIFY `id_dia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `divisiones`
--
ALTER TABLE `divisiones`
  MODIFY `id_division` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estado_asistencia`
--
ALTER TABLE `estado_asistencia`
  MODIFY `id_estado_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `grupo_alumno`
--
ALTER TABLE `grupo_alumno`
  MODIFY `id_grupo_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id_profesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `fk_administrador_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `fk_alumnos_divisiones` FOREIGN KEY (`id_division`) REFERENCES `divisiones` (`id_division`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_alumnos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_asistencia_estado` FOREIGN KEY (`id_estado_asistencia`) REFERENCES `estado_asistencia` (`id_estado_asistencia`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_asistencia_grupo_alumno` FOREIGN KEY (`id_grupo_alumno`) REFERENCES `grupo_alumno` (`id_grupo_alumno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `fk_grupos_complementaria` FOREIGN KEY (`id_complementaria`) REFERENCES `complementarias` (`id_complementaria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_grupos_estado` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_grupos_periodo` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_grupos_profesor` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id_profesor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupo_alumno`
--
ALTER TABLE `grupo_alumno`
  ADD CONSTRAINT `fk_ga_alumno` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`numero_control`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ga_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_grupo_alumno_estado_grupo_alumno` FOREIGN KEY (`id_estado_grupo_alumno`) REFERENCES `estado_grupo_alumno` (`id_estado_grupo_alumno`);

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `fk_horarios_dia` FOREIGN KEY (`id_dia`) REFERENCES `dia` (`id_dia`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_horarios_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD CONSTRAINT `fk_profesores_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_tipos_usuarios` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipos_usuarios` (`id_tipo_usuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
