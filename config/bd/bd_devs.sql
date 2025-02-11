-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-02-2025 a las 20:13:37
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_devs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_devs`
--

CREATE TABLE `tbl_devs` (
  `id_dev` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_devs`
--

INSERT INTO `tbl_devs` (`id_dev`, `name`) VALUES
(1, 'Urian'),
(2, 'Braudin'),
(3, 'Alberto'),
(4, 'camilo'),
(5, 'Felipe'),
(6, 'Brenda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_habilidades`
--

CREATE TABLE `tbl_habilidades` (
  `id_habilidad` int NOT NULL,
  `skill` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_habilidades`
--

INSERT INTO `tbl_habilidades` (`id_habilidad`, `skill`) VALUES
(1, 'HTML'),
(2, 'CSS'),
(3, 'BOOTSTRAP'),
(4, 'JAVASCRIPT'),
(5, 'NODE.JS'),
(6, 'TYPESCRIPT'),
(7, 'PHP PURO'),
(8, 'LARAVEL'),
(9, 'REACT JS'),
(10, 'NEXT.JS'),
(11, 'ASTRO'),
(12, 'SVELTE'),
(13, 'FRONT-END'),
(14, 'BACKEND'),
(15, 'FULL STACK'),
(16, 'PYTHON'),
(17, 'PYTHON + DJANGO'),
(18, 'PYTHON + FLASK'),
(19, 'MYSQL'),
(20, 'DART'),
(21, 'FLUTTER');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_habilidades_dev`
--

CREATE TABLE `tbl_habilidades_dev` (
  `id_skill_dev` int NOT NULL,
  `id_dev` int NOT NULL,
  `id_habilidad` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_habilidades_dev`
--

INSERT INTO `tbl_habilidades_dev` (`id_skill_dev`, `id_dev`, `id_habilidad`) VALUES
(1, 2, 14),
(2, 1, 5),
(3, 6, 14),
(4, 6, 4),
(5, 6, 19),
(6, 6, 10),
(7, 4, 3),
(8, 4, 2),
(9, 4, 20),
(10, 4, 1),
(11, 4, 15),
(12, 1, 4),
(13, 1, 8),
(14, 1, 9),
(15, 5, 14),
(16, 5, 11),
(17, 5, 8),
(18, 5, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_devs`
--
ALTER TABLE `tbl_devs`
  ADD PRIMARY KEY (`id_dev`);

--
-- Indices de la tabla `tbl_habilidades`
--
ALTER TABLE `tbl_habilidades`
  ADD PRIMARY KEY (`id_habilidad`);

--
-- Indices de la tabla `tbl_habilidades_dev`
--
ALTER TABLE `tbl_habilidades_dev`
  ADD PRIMARY KEY (`id_skill_dev`),
  ADD KEY `fk_dev` (`id_dev`),
  ADD KEY `fk_habilidad` (`id_habilidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_devs`
--
ALTER TABLE `tbl_devs`
  MODIFY `id_dev` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_habilidades`
--
ALTER TABLE `tbl_habilidades`
  MODIFY `id_habilidad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tbl_habilidades_dev`
--
ALTER TABLE `tbl_habilidades_dev`
  MODIFY `id_skill_dev` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_habilidades_dev`
--
ALTER TABLE `tbl_habilidades_dev`
  ADD CONSTRAINT `fk_dev` FOREIGN KEY (`id_dev`) REFERENCES `tbl_devs` (`id_dev`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_habilidad` FOREIGN KEY (`id_habilidad`) REFERENCES `tbl_habilidades` (`id_habilidad`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
