-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2022 a las 16:03:12
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
-- Estructura de tabla para la tabla `eliminar_inf_estudiante`
--

CREATE TABLE `eliminar_inf_estudiante` (
  `idestudiante` int(11) DEFAULT NULL,
  `cedula` int(10) DEFAULT NULL,
  `nombre` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `carrera` int(11) DEFAULT NULL,
  `id_userdeleted` int(11) DEFAULT NULL,
  `fecha_eliminar` date DEFAULT NULL,
  `hora_eliminar` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `eliminar_inf_estudiante`
--

INSERT INTO `eliminar_inf_estudiante` (`idestudiante`, `cedula`, `nombre`, `apellido`, `numero`, `carrera`, `id_userdeleted`, `fecha_eliminar`, `hora_eliminar`) VALUES
(3, 23511075, 'marga', 'burgos', '04269733099', 7, 1, '2022-07-17', '17:01:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eliminar_libro`
--

CREATE TABLE `eliminar_libro` (
  `id_eliminar` int(11) DEFAULT NULL,
  `cota` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_libro` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auto` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `año_libro` date DEFAULT NULL,
  `n_ejemplar` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `carrera` int(11) DEFAULT NULL,
  `id_userdeleted` int(11) DEFAULT NULL,
  `stock` int(100) DEFAULT NULL,
  `fecha_eliminar` date DEFAULT NULL,
  `hora_eliminar` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `eliminar_libro`
--

INSERT INTO `eliminar_libro` (`id_eliminar`, `cota`, `nombre_libro`, `auto`, `año_libro`, `n_ejemplar`, `carrera`, `id_userdeleted`, `stock`, `fecha_eliminar`, `hora_eliminar`) VALUES
(NULL, 'c123', 'java', 'mario', '2022-06-25', '1', 1, 1, NULL, '2022-07-15', '20:12:58'),
(NULL, 'c123', 'java', 'mario', '2022-06-25', '1', 1, 1, NULL, '2022-07-15', '20:13:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eliminar_usuario`
--

CREATE TABLE `eliminar_usuario` (
  `id` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuario` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clave` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT 1,
  `id_userdeleted` int(11) DEFAULT NULL,
  `fecha_eliminar` date DEFAULT NULL,
  `hora_eliminar` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `eliminar_usuario`
--

INSERT INTO `eliminar_usuario` (`id`, `nombre`, `correo`, `usuario`, `clave`, `rol`, `status`, `id_userdeleted`, `fecha_eliminar`, `hora_eliminar`) VALUES
(2, 'mario Dalessandro', 'mario.123@gmail.com', 'mario', '1eb6cd273513', 2, 1, 1, '2022-07-15', '17:19:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega_libro`
--

CREATE TABLE `entrega_libro` (
  `id` int(4) NOT NULL,
  `cota` varchar(15) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `hora_entrega` time DEFAULT NULL,
  `id_estudiante_el` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cedula` int(11) NOT NULL,
  `id_userCreador` int(11) DEFAULT NULL,
  `id_userDeleted` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `entrega_libro`
--

INSERT INTO `entrega_libro` (`id`, `cota`, `fecha_entrega`, `hora_entrega`, `id_estudiante_el`, `nombre`, `cedula`, `id_userCreador`, `id_userDeleted`, `status`) VALUES
(1, 'c123', '2022-06-26', NULL, 1, 'Rafael Antonio', 28457797, 1, NULL, 1),
(2, 'c123', '2022-06-26', NULL, 1, 'Rafael Antonio', 28457797, 1, NULL, 1),
(10, 'c123', '2022-07-17', '18:12:13', 1, 'Rafael Antonio', 28457797, 1, NULL, 1),
(11, 'c123', '2022-07-17', '18:26:34', 1, 'Rafael Antonio', 28457797, 1, NULL, 1),
(12, 'c123', '2022-07-17', '18:26:41', 1, 'Rafael Antonio', 28457797, 1, NULL, 1);

--
-- Disparadores `entrega_libro`
--
DELIMITER $$
CREATE TRIGGER `A_entrega_libro` AFTER INSERT ON `entrega_libro` FOR EACH ROW BEGIN
INSERT INTO respaldo_entraga_libro(cota, fecha_entrega, hora_entrega, id_estudiante, nom_est, cedula, id_usercreador) VALUES(new.cota, CURRENT_DATE(), CURRENT_TIME(), new.id_estudiante_el, new.nombre, new.cedula, new.id_userCreador);
END
$$
DELIMITER ;

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
  `id_userCreador` int(11) DEFAULT NULL,
  `id_userDeleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inf_estudiante`
--

INSERT INTO `inf_estudiante` (`id`, `cedula`, `nombre`, `apellido`, `numero`, `carrera`, `status`, `id_userCreador`, `id_userDeleted`) VALUES
(1, 28457797, 'Rafael Antonio', 'Maldonado Burgos', '4247190072', 1, 1, 1, NULL),
(2, 26934846, 'bertha', 'maldonado', '04164771198', 1, 1, 1, NULL),
(3, 23511075, 'marga', 'burgos', '04269733099', 7, 1, 1, 1);

--
-- Disparadores `inf_estudiante`
--
DELIMITER $$
CREATE TRIGGER `A_inf_estudiante` AFTER INSERT ON `inf_estudiante` FOR EACH ROW BEGIN
INSERT INTO respaldo_inf_estudiante(idestudiante, cedula, nombre,  apellido, numero, carrera, id_userCreador, fecha_respaldo, hora_respaldo) VALUES(new.id, new.cedula, new.nombre, new.apellido, new.numero, new.carrera, new. id_userCreador, CURRENT_DATE(), CURRENT_TIME() );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `b_eliminar_estudiante` BEFORE UPDATE ON `inf_estudiante` FOR EACH ROW BEGIN
IF NEW.status = 0 THEN
INSERT INTO eliminar_inf_estudiante(idestudiante, cedula, nombre, apellido, numero, carrera, id_userdeleted, fecha_eliminar, hora_eliminar) VALUES(old.id, old.cedula, old.nombre, old.apellido, old.numero, old.carrera, new.id_userDeleted, CURRENT_DATE(), CURRENT_TIME());
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `cota` varchar(20) NOT NULL,
  `nombre_libro` varchar(30) NOT NULL,
  `autor` varchar(20) NOT NULL,
  `año_libro` date NOT NULL,
  `n_ejemplar` varchar(20) NOT NULL,
  `carrera` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `id_userCreador` int(11) DEFAULT NULL,
  `id_userDeleted` int(11) DEFAULT NULL,
  `stock` int(100) DEFAULT NULL,
  `disponible` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`cota`, `nombre_libro`, `autor`, `año_libro`, `n_ejemplar`, `carrera`, `status`, `id_userCreador`, `id_userDeleted`, `stock`, `disponible`) VALUES
('c001', 'c++', 'mariana suares', '2005-07-24', '0', 1, 1, 1, NULL, NULL, NULL),
('c002', 'html 5', 'maria mendez', '2017-05-05', '0', 1, 1, 1, NULL, NULL, NULL),
('c123', 'java', 'mario', '2022-06-25', '1', 1, 1, 1, 1, NULL, NULL);

--
-- Disparadores `libros`
--
DELIMITER $$
CREATE TRIGGER `A_respaldo_libro` AFTER INSERT ON `libros` FOR EACH ROW BEGIN
INSERT INTO respaldo_libros(cota, nombre_libro, autor, año_libro, n_ejemplar, carrera, stock, fecha_respaldo, id_usercreador) VALUES(new.cota, new.nombre_libro, new.autor, new.año_libro, new.n_ejemplar, new.carrera, new.stock, NOW(), new.id_userCreador);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `B_eliminar_libro` BEFORE UPDATE ON `libros` FOR EACH ROW BEGIN
IF NEW.status = 0 THEN
INSERT INTO eliminar_libro(cota, nombre_libro, auto, año_libro, n_ejemplar, carrera, id_userdeleted, stock, fecha_eliminar, hora_eliminar) VALUES(OLD.cota, OLD.nombre_libro, OLD.autor, OLD.año_libro, OLD.n_ejemplar, OLD.carrera, NEW.id_userDeleted, OLD.stock, CURRENT_DATE(), CURRENT_TIME());
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respaldo_entraga_libro`
--

CREATE TABLE `respaldo_entraga_libro` (
  `cota` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL,
  `id_estudiante` int(11) DEFAULT NULL,
  `nom_est` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cedula` int(11) DEFAULT NULL,
  `id_usercreador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `respaldo_entraga_libro`
--

INSERT INTO `respaldo_entraga_libro` (`cota`, `fecha_entrega`, `hora_entrega`, `id_estudiante`, `nom_est`, `cedula`, `id_usercreador`) VALUES
('c123', '2022-07-17', '18:12:13', 1, 'Rafael Antonio', 28457797, 1),
('c123', '2022-07-17', '18:26:34', 1, 'Rafael Antonio', 28457797, 1),
('c123', '2022-07-17', '18:26:41', 1, 'Rafael Antonio', 28457797, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respaldo_inf_estudiante`
--

CREATE TABLE `respaldo_inf_estudiante` (
  `idestudiante` int(11) DEFAULT NULL,
  `cedula` int(10) DEFAULT NULL,
  `nombre` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `carrera` int(11) DEFAULT NULL,
  `id_userCreador` int(11) DEFAULT NULL,
  `fehca_respaldo` date DEFAULT NULL,
  `hora_respaldo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respaldo_libros`
--

CREATE TABLE `respaldo_libros` (
  `cota` varchar(10) NOT NULL,
  `nombre_libro` varchar(30) NOT NULL,
  `autor` varchar(30) NOT NULL,
  `año_libro` varchar(12) NOT NULL,
  `n_ejemplar` varchar(10) NOT NULL,
  `carrera` int(11) NOT NULL,
  `stock` int(100) DEFAULT NULL,
  `fecha_respaldo` time DEFAULT NULL,
  `id_usercreador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `respaldo_libros`
--

INSERT INTO `respaldo_libros` (`cota`, `nombre_libro`, `autor`, `año_libro`, `n_ejemplar`, `carrera`, `stock`, `fecha_respaldo`, `id_usercreador`) VALUES
('c001', 'c++', 'mariana suares', '2005-07-24', '3', 1, NULL, '17:24:15', 1),
('c002', 'html 5', 'maria mendez', '2017-05-05', '2', 1, NULL, '18:35:48', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respaldo_retiro_libro`
--

CREATE TABLE `respaldo_retiro_libro` (
  `id_libro` int(11) DEFAULT NULL,
  `cota` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_retiro` date DEFAULT NULL,
  `hora_retiro` time DEFAULT NULL,
  `id_estudiante` int(11) DEFAULT NULL,
  `nom_est` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cedula` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_usercreador` int(11) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `respaldo_retiro_libro`
--

INSERT INTO `respaldo_retiro_libro` (`id_libro`, `cota`, `fecha_retiro`, `hora_retiro`, `id_estudiante`, `nom_est`, `cedula`, `id_usercreador`, `fecha_entrega`) VALUES
(NULL, 'c123', '2022-07-13', '09:47:23', 2, 'bertha', '26934846', 1, '2022-07-16'),
(NULL, 'c123', '2022-07-17', '17:39:49', 1, 'Rafael Antonio', '28457797', 1, '2022-07-20'),
(NULL, 'c001', '2022-07-17', '17:40:01', 1, 'Rafael Antonio', '28457797', 1, '2022-07-20'),
(NULL, 'c123', '2022-07-17', '18:26:16', 1, 'Rafael Antonio', '28457797', 1, '2022-07-20'),
(NULL, 'c001', '2022-07-17', '18:42:38', 1, 'Rafael Antonio', '28457797', 1, '2022-07-20'),
(NULL, 'c001', '2022-07-17', '18:43:46', 1, 'Rafael Antonio', '28457797', 1, '2022-07-20'),
(NULL, 'c002', '2022-07-17', '18:43:59', 1, 'Rafael Antonio', '28457797', 1, '2022-07-20'),
(NULL, 'c002', '2022-07-17', '18:44:23', 3, 'marga', '23511075', 1, '2022-07-20'),
(NULL, 'c123', '2022-07-17', '18:44:31', 3, 'marga', '23511075', 1, '2022-07-20'),
(NULL, 'c123', '2022-07-17', '18:44:57', 2, 'bertha', '26934846', 1, '2022-07-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respaldo_usuario`
--

CREATE TABLE `respaldo_usuario` (
  `idusuario` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuario` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clave` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `id_usercreador` int(11) DEFAULT NULL,
  `fecha_respaldo` date DEFAULT NULL,
  `hora_respaldo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retiro_libros`
--

CREATE TABLE `retiro_libros` (
  `id` int(4) NOT NULL,
  `cota` varchar(15) NOT NULL,
  `fecha_retiro` date NOT NULL,
  `hora_retiro` time NOT NULL,
  `id_estudiante_rl` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cedula` int(10) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `id_userCreador` int(11) DEFAULT NULL,
  `id_userDeleted` int(11) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `retiro_libros`
--

INSERT INTO `retiro_libros` (`id`, `cota`, `fecha_retiro`, `hora_retiro`, `id_estudiante_rl`, `nombre`, `cedula`, `status`, `id_userCreador`, `id_userDeleted`, `fecha_entrega`) VALUES
(1, 'c123', '2022-07-17', '18:26:16', 1, 'Rafael Antonio', 28457797, 0, 1, 1, '2022-07-20'),
(2, 'c001', '2022-07-17', '18:42:38', 1, 'Rafael Antonio', 28457797, 1, 1, NULL, '2022-07-20'),
(3, 'c001', '2022-07-17', '18:43:46', 1, 'Rafael Antonio', 28457797, 1, 1, NULL, '2022-07-20'),
(4, 'c002', '2022-07-17', '18:43:59', 1, 'Rafael Antonio', 28457797, 1, 1, NULL, '2022-07-20'),
(5, 'c002', '2022-07-17', '18:44:23', 3, 'marga', 23511075, 1, 1, NULL, '2022-07-20'),
(6, 'c123', '2022-07-17', '18:44:31', 3, 'marga', 23511075, 1, 1, NULL, '2022-07-20'),
(7, 'c123', '2022-07-17', '18:44:57', 2, 'bertha', 26934846, 1, 1, NULL, '2022-07-20');

--
-- Disparadores `retiro_libros`
--
DELIMITER $$
CREATE TRIGGER `A_retiro_libro` AFTER INSERT ON `retiro_libros` FOR EACH ROW BEGIN
INSERT INTO respaldo_retiro_libro(cota, fecha_retiro, hora_retiro, id_estudiante, nom_est, cedula, id_usercreador, fecha_entrega) VALUES(new.cota, new.fecha_retiro, new.hora_retiro, new.id_estudiante_rl, new.nombre, new.cedula, new.id_userCreador, new.fecha_entrega);
END
$$
DELIMITER ;

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
  `nombre_u` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `correo` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `usuario` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `clave` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `id_userCreador` int(11) DEFAULT NULL,
  `id_userDeleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre_u`, `correo`, `usuario`, `clave`, `rol`, `status`, `id_userCreador`, `id_userDeleted`) VALUES
(1, 'nakary vivas', 'nakariv.iut@gmail.com', 'nakariv12', '428be1b45584dd57c800db7b6ed5dd56', 1, 1, NULL, NULL),
(2, 'mario Dalessandro', 'mario.123@gmail.com', 'mario', '1eb6cd2735139fc05c74f495da59374e', 2, 0, 1, 1),
(3, 'shayer bonilla', 'shayer_nohacenada@gmail.com', 'shayer', '8274215cae5130c2bb0276d32333a586', 1, 1, 1, NULL);

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `eliminar_usuario` BEFORE UPDATE ON `usuarios` FOR EACH ROW BEGIN
IF NEW.status = 0 THEN
INSERT INTO eliminar_usuario(id, nombre, correo,  usuario, clave, rol, id_userDeleted, fecha_eliminar, hora_eliminar) VALUES(OLD.idusuario, OLD.nombre_u, old.correo, OLD.usuario, old.clave, OLD.rol, NEW.id_userDeleted, CURRENT_DATE(), CURRENT_TIME());
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `respaldo_usuario` AFTER INSERT ON `usuarios` FOR EACH ROW INSERT INTO respaldo_usuario(idusuario, nombre_u, correo, usuario, clave, rol, id_usercreador, fecha_respaldo, hora_respaldo)
VALUES (new.idusuario, new.nombre_u, new.correo, new.usuario, new.rol, new.id_userCreador, CURRENT_DATE(), CURRENT_TIME())
$$
DELIMITER ;

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
  ADD KEY `id_userDeleted` (`id_userDeleted`),
  ADD KEY `id_estudiante_el` (`id_estudiante_el`);

--
-- Indices de la tabla `inf_estudiante`
--
ALTER TABLE `inf_estudiante`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`),
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
-- Indices de la tabla `retiro_libros`
--
ALTER TABLE `retiro_libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cota` (`cota`),
  ADD KEY `id_userCreador` (`id_userCreador`,`id_userDeleted`),
  ADD KEY `id_estudiante_rl` (`id_estudiante_rl`);

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
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `id_userCreador` (`id_userCreador`,`id_userDeleted`),
  ADD KEY `id_userDeleted` (`id_userDeleted`),
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
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `inf_estudiante`
--
ALTER TABLE `inf_estudiante`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `retiro_libros`
--
ALTER TABLE `retiro_libros`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entrega_libro`
--
ALTER TABLE `entrega_libro`
  ADD CONSTRAINT `entrega_libro_ibfk_1` FOREIGN KEY (`cota`) REFERENCES `libros` (`cota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entrega_libro_ibfk_2` FOREIGN KEY (`id_userCreador`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entrega_libro_ibfk_3` FOREIGN KEY (`id_userDeleted`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entrega_libro_ibfk_4` FOREIGN KEY (`id_estudiante_el`) REFERENCES `inf_estudiante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `retiro_libros_ibfk_1` FOREIGN KEY (`cota`) REFERENCES `libros` (`cota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retiro_libros_ibfk_2` FOREIGN KEY (`id_estudiante_rl`) REFERENCES `inf_estudiante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_userCreador`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`id_userDeleted`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
