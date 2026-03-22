-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-03-2026 a las 01:15:45
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
-- Base de datos: `proyecto_1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_admin`
--

CREATE TABLE `users_admin` (
  `id` int(11) NOT NULL,
  `admin_level` tinyint(4) NOT NULL,
  `creado_por` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_admin`
--

INSERT INTO `users_admin` (`id`, `admin_level`, `creado_por`, `fecha_creacion`) VALUES
(1, 1, 1, '2026-03-21 20:53:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_core`
--

CREATE TABLE `users_core` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_core`
--

INSERT INTO `users_core` (`id`, `email`, `phone`, `password`, `user_type`, `created_at`) VALUES
(1, 'admin1@correo.com', '04120000001', '$2y$10$R/2zmAr5JKvq/2FBqJpKIexR7gqeqlAEHBv9/ikAnUUWlwuFiGlPO', 'admin', '2026-03-21 20:51:53'),
(2, 'usuario@correo.com', '04120000000', '$2y$10$R/2zmAr5JKvq/2FBqJpKIexR7gqeqlAEHBv9/ikAnUUWlwuFiGlPO', 'user', '2026-03-21 20:40:05'),
(4, 'admin2@correo.com', '04120000002', '$2y$10$R/2zmAr5JKvq/2FBqJpKIexR7gqeqlAEHBv9/ikAnUUWlwuFiGlPO', 'admin', '2026-03-21 20:54:11'),
(5, 'franci@gmail.com', '04124056125', '$2y$10$7MO14O0Splhz4lWRTSGMo.QtgfyO.Pmf2sKbuSIyQkeVgLbbje4qi', 'user', '2026-03-21 21:19:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_profile`
--

CREATE TABLE `users_profile` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_profile`
--

INSERT INTO `users_profile` (`id`, `nombre`, `apellido`) VALUES
(1, 'Admin', 'Nivel1'),
(2, 'Juan', 'Pérez'),
(5, 'Francibel', 'Llenera');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users_admin`
--
ALTER TABLE `users_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creado_por` (`creado_por`);

--
-- Indices de la tabla `users_core`
--
ALTER TABLE `users_core`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `users_profile`
--
ALTER TABLE `users_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users_core`
--
ALTER TABLE `users_core`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users_admin`
--
ALTER TABLE `users_admin`
  ADD CONSTRAINT `users_admin_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users_core` (`id`),
  ADD CONSTRAINT `users_admin_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `users_core` (`id`);

--
-- Filtros para la tabla `users_profile`
--
ALTER TABLE `users_profile`
  ADD CONSTRAINT `users_profile_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users_core` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
