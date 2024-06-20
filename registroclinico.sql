-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2024 a las 06:30:49
-- Versión del servidor: 10.4.32-MariaDB-log
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registroclinico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apaterno` varchar(100) NOT NULL,
  `amaterno` varchar(100) DEFAULT NULL,
  `sexo` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `pregunta` varchar(255) NOT NULL,
  `respuesta` varchar(255) NOT NULL,
  `sucursal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `nombre`, `apaterno`, `amaterno`, `sexo`, `edad`, `tel`, `email`, `contrasena`, `pregunta`, `respuesta`, `sucursal_id`) VALUES
(1, 'Merari', 'González', 'Pavón', 'Femenino', 22, '7293683094', 'merari@gmail.com', '$2y$10$LhFpbTsT4w1PpF2u4//2/e1voLHgnWQBtXgKBr1AL/pV5cwz.F.nq', 'color', 'rojo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apaterno` varchar(100) NOT NULL,
  `amaterno` varchar(100) NOT NULL,
  `sexo` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `pregunta` varchar(50) NOT NULL,
  `respuesta` varchar(50) NOT NULL,
  `sucursal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `nombre`, `apaterno`, `amaterno`, `sexo`, `edad`, `tel`, `email`, `contrasena`, `pregunta`, `respuesta`, `sucursal_id`) VALUES
(1, 'Jessica', 'Escamilla', 'Velazquez', 'Femenino', 22, '7536987412', 'jessica@gmail.com', '$2y$10$QsFiwLaoFFL4EMeC2cK6UuaEmLDapnFWXbbR.m1GKZ8tKhEOyR.5G', 'color', 'rojo', 1),
(2, 'Fernando', 'Saldaña', 'hipolito', 'Masculino', 19, '7698632144', 'fernando@gmail.com', '$2y$10$sXdO3BkGiaanp4McmoLF5uJA6EOl1sXoy76TRm1Al76SeQxkuViZO', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apaterno` varchar(100) NOT NULL,
  `amaterno` varchar(100) NOT NULL,
  `sexo` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `pregunta` varchar(50) NOT NULL,
  `respuesta` varchar(50) NOT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `glucosa` float NOT NULL,
  `urea` float NOT NULL,
  `trigliceridos` float NOT NULL,
  `creatinina` float NOT NULL,
  `acido` float NOT NULL,
  `colesterol` float NOT NULL,
  `hdl` float NOT NULL,
  `ldl` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `apaterno`, `amaterno`, `sexo`, `edad`, `tel`, `email`, `contrasena`, `pregunta`, `respuesta`, `sucursal_id`, `glucosa`, `urea`, `trigliceridos`, `creatinina`, `acido`, `colesterol`, `hdl`, `ldl`) VALUES
(1, 'Oscar', 'Lopez', 'Juarez', 'Masculino', 24, '8563214789', 'oscar@gmail.com', '$2y$10$HGYvIcXhqFNd.qi8ZJSkSerbiSsYvqppWh9BmB3u7om2WNNTR2ZkS', '', '', 1, 50, 90, 30, 45, 30, 100, 20, 85),
(2, 'Lupita', 'Fernandez', 'Miranda', 'Masculino', 22, '2345698745', 'jimena@gmail.com', '$2y$10$kLrA7sY27YiQ1f2M7Wkp1uweUD5NPAp3Mt9LqO1oWgl88KOkzu2iK', 'animal', 'gato', 1, 20, 30, 50, 66, 48, 20, 15, 6),
(4, 'Susana', 'Martinez', 'Martinez', 'Femenino', 20, '5463698745', 'susana@gmail.com', '$2y$10$9zwxYGE4mqfftBPdwAdAr.JCuG6VDG30/WMyN67QEujS9EKIjBJea', '', '', 1, 20, 10, 20, 60, 10, 9, 9, 9),
(7, 'aaa', 'aaa', 'aaa', 'Masculino', 12, '7596326574', 'aaa@gmail.com', '$2y$10$1vMkaL95muaauKVEAtlYqOgt72B/CPXiLp.RuNIotXd5N/c1mpoH6', '', '', 1, 10, 30, 6, 9, 8, 8, 90, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rfc` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id`, `nombre`, `direccion`, `tel`, `email`, `rfc`) VALUES
(1, 'Clinica TV', 'Progreso sur altos #105', '12345678965', 'clinicatv@gmail.com', 'CTVM580812RH7'),
(2, 'Clinica Santiago', 'aaaa', '1232124569', 'clinicasantiago@gmail.com', 'CSAP580972EK'),
(4, 'Clinica Tenancingo', 'Morelos ', '1254769863', 'a@gmail.com', 'CTEP970961TM'),
(5, 'Clinica San Juan', 'Independencia', '9632547621', 'clinicasj@gmail.com', 'CSJo976961BR');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sucursal_id` (`sucursal_id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sucursal_id` (`sucursal_id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sucursal_id` (`sucursal_id`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
