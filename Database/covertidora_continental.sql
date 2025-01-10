-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 22:11:53
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `covertidora_continental`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cc_admin_acciones`
--

CREATE TABLE `cc_admin_acciones` (
  `id` int(11) NOT NULL,
  `nombre_accion` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cc_admin_tipo_unidad`
--

CREATE TABLE `cc_admin_tipo_unidad` (
  `id` int(11) NOT NULL,
  `nombre_tipo_unidad` varchar(255) NOT NULL,
  `userId_creado` int(11) NOT NULL,
  `fecha_creacion` datetime(6) NOT NULL,
  `userId_updated` int(11) NOT NULL,
  `fecha_updated` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cc_almacen_materia_prima`
--

CREATE TABLE `cc_almacen_materia_prima` (
  `id` int(11) NOT NULL,
  `materia_prima_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cc_historial_materia_prima`
--

CREATE TABLE `cc_historial_materia_prima` (
  `id` int(11) NOT NULL,
  `materia_prima_id` int(11) NOT NULL,
  `num_pedido` varchar(255) NOT NULL,
  `num_vl` varchar(255) NOT NULL,
  `proveedorId` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `accionId` int(11) NOT NULL,
  `user_register` int(11) NOT NULL,
  `fecha_register` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cc_materia_prima`
--

CREATE TABLE `cc_materia_prima` (
  `id` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo_unidad_Id` int(11) NOT NULL,
  `status_materia_prima` int(11) NOT NULL,
  `fecha_creacion` datetime(6) NOT NULL,
  `userId_creado` int(11) NOT NULL,
  `fecha_actualizacion` datetime(6) NOT NULL,
  `userId_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cc_productos`
--

CREATE TABLE `cc_productos` (
  `id` int(11) NOT NULL,
  `nombre_prod` varchar(255) NOT NULL,
  `codigo_prod` varchar(255) NOT NULL,
  `id_empaque` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `costo` float NOT NULL,
  `precio_u` float NOT NULL,
  `precio_m` float NOT NULL,
  `precio_c` float NOT NULL,
  `precio_e` float NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `status_prod` int(11) NOT NULL,
  `userId_create` int(11) NOT NULL,
  `fecha_created` datetime(6) NOT NULL,
  `userId_updated` int(11) NOT NULL,
  `fecha_updated` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cc_traslados_materia_prima`
--

CREATE TABLE `cc_traslados_materia_prima` (
  `id` int(11) NOT NULL,
  `materia_prima_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `user_created` int(11) NOT NULL,
  `fecha_created` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cc_admin_acciones`
--
ALTER TABLE `cc_admin_acciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cc_admin_tipo_unidad`
--
ALTER TABLE `cc_admin_tipo_unidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cc_almacen_materia_prima`
--
ALTER TABLE `cc_almacen_materia_prima`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materia_prima_id` (`materia_prima_id`);

--
-- Indices de la tabla `cc_historial_materia_prima`
--
ALTER TABLE `cc_historial_materia_prima`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materia_prima_id` (`materia_prima_id`);

--
-- Indices de la tabla `cc_materia_prima`
--
ALTER TABLE `cc_materia_prima`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_unidad_Id` (`tipo_unidad_Id`);

--
-- Indices de la tabla `cc_productos`
--
ALTER TABLE `cc_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cc_traslados_materia_prima`
--
ALTER TABLE `cc_traslados_materia_prima`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materia_prima_id` (`materia_prima_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cc_admin_acciones`
--
ALTER TABLE `cc_admin_acciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cc_admin_tipo_unidad`
--
ALTER TABLE `cc_admin_tipo_unidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cc_almacen_materia_prima`
--
ALTER TABLE `cc_almacen_materia_prima`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cc_historial_materia_prima`
--
ALTER TABLE `cc_historial_materia_prima`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cc_materia_prima`
--
ALTER TABLE `cc_materia_prima`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cc_productos`
--
ALTER TABLE `cc_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cc_traslados_materia_prima`
--
ALTER TABLE `cc_traslados_materia_prima`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cc_almacen_materia_prima`
--
ALTER TABLE `cc_almacen_materia_prima`
  ADD CONSTRAINT `cc_almacen_materia_prima_ibfk_1` FOREIGN KEY (`materia_prima_id`) REFERENCES `cc_materia_prima` (`id`);

--
-- Filtros para la tabla `cc_historial_materia_prima`
--
ALTER TABLE `cc_historial_materia_prima`
  ADD CONSTRAINT `cc_historial_materia_prima_ibfk_1` FOREIGN KEY (`materia_prima_id`) REFERENCES `cc_materia_prima` (`id`);

--
-- Filtros para la tabla `cc_materia_prima`
--
ALTER TABLE `cc_materia_prima`
  ADD CONSTRAINT `cc_materia_prima_ibfk_1` FOREIGN KEY (`tipo_unidad_Id`) REFERENCES `cc_admin_tipo_unidad` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cc_traslados_materia_prima`
--
ALTER TABLE `cc_traslados_materia_prima`
  ADD CONSTRAINT `cc_traslados_materia_prima_ibfk_1` FOREIGN KEY (`materia_prima_id`) REFERENCES `cc_materia_prima` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
