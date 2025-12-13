-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2025 a las 06:16:49
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
(22, 'Roberto', 'holla@gmail.com', '12345678'),
(23, 'Sebastian', 'holla@gmail.com', '12345678'),
(24, 'Donovan', 'holla@gmail.com', '12345678'),
(25, 'Ramon', 'fer@gmail.com', '12345678');

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
(223107402, 'fsfsf', 'dfa', 'fafdsf', 'Ingeniería en Semiconductores', 'holla@gmail.com', '12345678'),
(223107403, 'Karla', 'Licona', 'Dominguez', 'TICS', 'DANIA@GMIAL.COM', '12345678'),
(223107424, 'Dania', 'Contreras', 'Porfirio', 'Ingeniería en Sistemas Computacionales', 'DANIA@GMIAL.COM', '12345678'),
(223107494, 'Jaquelyn', 'Molina', 'Hernandez', 'Ingeniería Mecatrónica', 'DANIA@GMIAL.COM', '12345678'),
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
(11, 'Canto', 'Aprende a cantar', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUF5Xvc4NvkgqnrL9T2LWsNx_q0KbuJ-gq7Q&s'),
(12, 'Photoshop', 'Aprende editar fotografia y video ', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-hiOfcwr8nRt826cIK7pn8cFCf-NWaUPvVQ&s'),
(13, 'BANDA DE GUERRA', 'Desarrolla habilidades musicales y marciales formando parte de la Banda de Guerra. Aprende ritmo, coordinación y disciplina mientras participas en eventos cívicos y escolares.', '../img/imagenes-complementarias/banda-de-guerra.jpg'),
(14, 'FÚTBOL', 'Participa en entrenamientos y torneos intercolegiales de fútbol. Desarrolla trabajo en equipo, resistencia y disciplina deportiva.', '../img/imagenes-complementarias/futbol.jpg'),
(15, 'TEATRO', 'Explora tu creatividad escénica, expresión corporal y habilidades de comunicación mediante la actuación teatral', '../img/imagenes-complementarias/teatro.jpg'),
(16, 'VOLEIBOL', 'Fortalece tu coordinación, reflejos y espíritu competitivo participando en los entrenamientos de voleibol. Aprende sobre estrategia, trabajo en conjunto y respeto por tus compañeros.', '../img/imagenes-complementarias/voleibol.jpg'),
(17, 'Fotografía', 'Aprende a capturar momentos únicos con técnica y estilo. Este taller te enseña los fundamentos de la fotografía, desde el manejo de cámara hasta la edición básica de imágenes.', '../img/imagenes-complementarias/fotografia.jpg'),
(18, 'AJEDREZ', 'Desarrolla tu pensamiento lógico y tu capacidad de análisis mediante el ajedrez. Participa en torneos y aprende estrategias para mejorar tu concentración y toma de decisiones.', '../img/imagenes-complementarias/ajedrez.jpg'),
(19, 'ESCOLTA', 'Forma parte del grupo de escolta y representa con orgullo los valores institucionales en ceremonias cívicas. Mejora tu disciplina, porte y sentido de responsabilidad.', '../img/imagenes-complementarias/escolta.jpg'),
(20, 'Básquetbol', 'Aumenta tu resistencia, precisión y reflejos participando en el equipo de básquetbol. Vive la emoción de la competencia mientras fortaleces tu cuerpo y mente.', '../img/imagenes-complementarias/basquetbol.jpg'),
(22, 'Entrenamiento Fitness', 'Mejora tu salud y condición física mediante rutinas de fuerza, resistencia y flexibilidad. Este taller promueve un estilo de vida saludable y activo.', '../img/imagenes-complementarias/fitness.png'),
(23, 'TOCHO', 'Participa en este deporte lleno de energía y trabajo en equipo. Aprende técnicas de agilidad, velocidad y estrategia sin contacto físico.', '../img/imagenes-complementarias/tocho.jpg'),
(24, 'Lectura', 'Descubre el placer de la lectura compartiendo opiniones y reflexiones sobre obras literarias. Amplía tu vocabulario, comprensión y pensamiento crítico.', '../img/imagenes-complementarias/taller-de-lectura.jpg');

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
-- Indices de la tabla `complementarias`
--
ALTER TABLE `complementarias`
  ADD PRIMARY KEY (`id_complementaria`),
  ADD UNIQUE KEY `nombre` (`nombre`);

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
-- AUTO_INCREMENT de la tabla `complementarias`
--
ALTER TABLE `complementarias`
  MODIFY `id_complementaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  ADD CONSTRAINT `fk_Grupos_Complementarias` FOREIGN KEY (`id_complementaria`) REFERENCES `complementarias` (`id_complementaria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
