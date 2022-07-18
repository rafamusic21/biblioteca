-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2022 a las 21:12:01
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
-- Base de datos: `bd_biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `idcarrera` int(11) NOT NULL,
  `nom_carrera` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`idcarrera`, `nom_carrera`) VALUES
(1, 'PNF INFORMATICA'),
(2, 'PNF CONSTRUCCION CIVIL'),
(3, 'PNF MECANICA'),
(4, 'PNF PROSESAMIENTO DE ALIMENTOS'),
(5, 'PNF ELECTRONICA'),
(6, 'PNF ELECTRICIDAD'),
(7, 'PNF AGROALIMENTACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega_libro`
--

CREATE TABLE `entrega_libro` (
  `id` int(4) NOT NULL,
  `cota` varchar(15) NOT NULL,
  `fecha_entrega` varchar(10) NOT NULL,
  `hora_entrega` varchar(10) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `id_userCreador` int(11) NOT NULL,
  `id_userDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inf_estudiante`
--

CREATE TABLE `inf_estudiante` (
  `id` int(4) NOT NULL,
  `cedula` int(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `numero` varchar(15) NOT NULL,
  `carrera` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `id_userCreador` int(11) NOT NULL,
  `id_userDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `cota` varchar(20) NOT NULL,
  `nombre_libro` varchar(30) NOT NULL,
  `autor` varchar(20) NOT NULL,
  `año_libro` varchar(5) NOT NULL,
  `n_ejemplar` varchar(20) NOT NULL,
  `carrera` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `id_userCreador` int(11) NOT NULL,
  `id_userDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respaldo_entrega_libro`
--

CREATE TABLE `respaldo_entrega_libro` (
  `id` int(10) NOT NULL,
  `cota` varchar(30) NOT NULL,
  `fecha_entrega` varchar(20) NOT NULL,
  `hora_entrega` varchar(20) NOT NULL,
  `cedula` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respaldo_libros`
--

CREATE TABLE `respaldo_libros` (
  `id` int(10) NOT NULL,
  `cota` varchar(10) NOT NULL,
  `nombre_libro` varchar(30) NOT NULL,
  `autor` varchar(30) NOT NULL,
  `año_libro` varchar(12) NOT NULL,
  `n_ejemplar` varchar(10) NOT NULL,
  `carrera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retiro_libros`
--

CREATE TABLE `retiro_libros` (
  `id` int(4) NOT NULL,
  `cota` varchar(15) NOT NULL,
  `fecha_retiro` varchar(10) NOT NULL,
  `hora_retiro` varchar(10) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `id_userCreador` int(11) NOT NULL,
  `id_userDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'administrador'),
(2, 'colavorador'),
(3, 'lector');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `correo` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `usuario` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `clave` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`, `rol`, `status`) VALUES
(1, 'nakary vivas', 'nakariv.iut@gmail.com', 'nakariv12', '428be1b45584dd57c800db7b6ed5dd56', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`idcarrera`);

--
-- Indices de la tabla `entrega_libro`
--
ALTER TABLE `entrega_libro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cota` (`cota`),
  ADD KEY `id_userCreador` (`id_userCreador`,`id_userDeleted`),
  ADD KEY `id_userDeleted` (`id_userDeleted`);

--
-- Indices de la tabla `inf_estudiante`
--
ALTER TABLE `inf_estudiante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrera` (`carrera`),
  ADD KEY `id_userCreador` (`id_userCreador`,`id_userDeleted`),
  ADD KEY `id_userDeleted` (`id_userDeleted`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`cota`),
  ADD KEY `carrera` (`carrera`),
  ADD KEY `id_userCreador` (`id_userCreador`,`id_userDeleted`),
  ADD KEY `id_userDeleted` (`id_userDeleted`);

--
-- Indices de la tabla `respaldo_entrega_libro`
--
ALTER TABLE `respaldo_entrega_libro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respaldo_libros`
--
ALTER TABLE `respaldo_libros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `retiro_libros`
--
ALTER TABLE `retiro_libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cota` (`cota`),
  ADD KEY `id_userCreador` (`id_userCreador`,`id_userDeleted`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `idcarrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `entrega_libro`
--
ALTER TABLE `entrega_libro`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inf_estudiante`
--
ALTER TABLE `inf_estudiante`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respaldo_entrega_libro`
--
ALTER TABLE `respaldo_entrega_libro`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respaldo_libros`
--
ALTER TABLE `respaldo_libros`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `retiro_libros`
--
ALTER TABLE `retiro_libros`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entrega_libro`
--
ALTER TABLE `entrega_libro`
  ADD CONSTRAINT `entrega_libro_ibfk_1` FOREIGN KEY (`cota`) REFERENCES `libros` (`cota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entrega_libro_ibfk_2` FOREIGN KEY (`id_userCreador`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entrega_libro_ibfk_3` FOREIGN KEY (`id_userDeleted`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inf_estudiante`
--
ALTER TABLE `inf_estudiante`
  ADD CONSTRAINT `inf_estudiante_ibfk_1` FOREIGN KEY (`carrera`) REFERENCES `carrera` (`idcarrera`),
  ADD CONSTRAINT `inf_estudiante_ibfk_2` FOREIGN KEY (`id_userCreador`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inf_estudiante_ibfk_3` FOREIGN KEY (`id_userDeleted`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`carrera`) REFERENCES `carrera` (`idcarrera`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`id_userCreador`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `libros_ibfk_3` FOREIGN KEY (`id_userDeleted`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `retiro_libros`
--
ALTER TABLE `retiro_libros`
  ADD CONSTRAINT `retiro_libros_ibfk_1` FOREIGN KEY (`cota`) REFERENCES `libros` (`cota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
