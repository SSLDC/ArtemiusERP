-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2025 a las 13:51:40
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
-- Base de datos: `artemus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fruteria`
--

CREATE TABLE `fruteria` (
  `tipo_etnia` varchar(100) DEFAULT NULL,
  `concurrencia` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fruteria`
--

INSERT INTO `fruteria` (`tipo_etnia`, `concurrencia`, `usuario_id`) VALUES
('Mallorquines ', 1534, NULL),
('Británicos', 682, NULL),
('Alemanes', 683, NULL),
('Italianos', 428, NULL),
('Moros', 839, NULL),
('Latinoamericanos', 633, NULL),
('Africanos', 719, NULL),
('Rumanos', 482, NULL),
('Chinos', 769, NULL),
('Rusos', 680, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel`
--

CREATE TABLE `hotel` (
  `servicios` varchar(100) DEFAULT NULL,
  `solicitudes` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hotel`
--

INSERT INTO `hotel` (`servicios`, `solicitudes`, `usuario_id`) VALUES
('Spa', 900, NULL),
('Lavandería y Tintorería', 605, NULL),
('Internet', 1579, NULL),
('Tours Organizados', 933, NULL),
('Campos de golf', 850, NULL),
('Actividades acuáticas', 1164, NULL),
('Alquiler de bicicletas', 989, NULL),
('Transporte básico', 1179, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id_role`, `role_name`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `role_id` int(11) DEFAULT NULL,
  `Apellidos` text NOT NULL,
  `Telefono` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `email`, `contraseña`, `is_admin`, `role_id`, `Apellidos`, `Telefono`) VALUES
(1, 'Sergio', 'sergibibiloni@gmail.com', '12341234', 1, 1, 'Bibiloni', 678507964),
(3, 'Fruteria', 'laFruteria@gmail.com', '999999999', 0, 2, 'Fruteria', 123456789),
(4, 'Zapateria', 'laZapateria@gmail.com', '888888888', 0, 2, 'Zapateria', 123456789),
(5, 'Hotel', 'elHotel@gmail.com', '777777777', 0, 2, 'Hotel', 123456789);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zapateria`
--

CREATE TABLE `zapateria` (
  `marcas` varchar(100) DEFAULT NULL,
  `ventas` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `zapateria`
--

INSERT INTO `zapateria` (`marcas`, `ventas`, `usuario_id`) VALUES
('Nike', 361, NULL),
('Adidas', 267, NULL),
('Puma', 477, NULL),
('Reebok', 143, NULL),
('New Balance', 285, NULL),
('Converse', 472, NULL),
('Vans', 572, NULL),
('Under Armour', 174, NULL),
('Skechers', 492, NULL),
('Timberland', 264, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fruteria`
--
ALTER TABLE `fruteria`
  ADD KEY `fk_fruteria_usuarios` (`usuario_id`);

--
-- Indices de la tabla `hotel`
--
ALTER TABLE `hotel`
  ADD KEY `fk_hotel_usuarios` (`usuario_id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indices de la tabla `zapateria`
--
ALTER TABLE `zapateria`
  ADD KEY `fk_zapateria_usuarios` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fruteria`
--
ALTER TABLE `fruteria`
  ADD CONSTRAINT `fk_fruteria_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `fk_hotel_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`);

--
-- Filtros para la tabla `zapateria`
--
ALTER TABLE `zapateria`
  ADD CONSTRAINT `fk_zapateria_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
