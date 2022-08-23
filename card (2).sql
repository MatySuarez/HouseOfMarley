-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-07-2022 a las 07:28:49
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
-- Base de datos: `card`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_usuarios`
--

CREATE TABLE `carrito_usuarios` (
  `id_sesion` varchar(255) NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito_usuarios`
--

INSERT INTO `carrito_usuarios` (`id_sesion`, `id_producto`, `cantidad`) VALUES
('pg0s3ht4cpniptmgq27dl6od9s', 31, 4),
('e0oj9rp0db2js23s7msskukcqh', 32, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(10, 'Auriculares'),
(11, 'Parlantes'),
(12, 'Bandejas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio_normal` decimal(10,2) NOT NULL,
  `precio_rebajado` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio_normal`, `precio_rebajado`, `cantidad`, `imagen`, `id_categoria`) VALUES
(2, 'Bufalo Soldier','10600.00', '7600.00', 10, 'Buffalo_Soldier.jpg', 10),
(30, 'Exodus ANC','32999.00', '29999.00', 10, 'EXODUS-ANC.jpg', 10),
(31, 'Exodus','32999.00', '00.00', 22, 'Exodus.jpg', 10),
(32, 'Liberate AIR','23199.00', '0.00', 11, 'LiberateAir_Case.jpg', 10),
(33, 'Positive Vibration 2',  '6999.00', '5000.00', 10, 'Positive_Vibration_2.jpg', 10),
(34, 'Positive Vibration 2 BT', '8999.00', '00.00', 23, 'Positive_Vibration_2_BT.jpg', 10),
(35, 'Positive Vibration XL', '23999.00', '20999.00', 35, 'PositiveVibrationXL.jpg', 10),
(36, 'Redemption ANC', '2899.00', '26000.00', 18, 'RedemptionANC.jpg', 10),
(5,'Smile Jamaica BT','5899.00','00.00',15,'Smile Jamaica BT.jpg',10),
(40,'Smile Jamaica Wiresles 2','5299.00','00.00',8,'Smile Jamaica Wiresles.jpg',10),
(7,'Little Bird Wiresles 2','9299.00','7999.00',20,'Little_Bird.jpg',10),
(41,'Bag Of Riddim', '45999.00', '40999.00', 10, 'bag.jpg', 11),
(42,'No Bounds Sport', '14599.00', '12999.00', 10, 'bounds sport.jpg', 11),
(43,'No Bounds','9699.00', '00.00', 22, 'bounds.jpg', 11),
(44,'Chant Mini','7799.00', '0.00', 11, 'chant mini.jpg', 11),
(45,'Chant Sport',  '12799.00', '10999.00', 10, 'chant sports.jpg', 11),
(46,'Get Together Mini', '25799.00', '00.00', 23, 'get mini.jpg', 11),
(47,'Get Together', '30799.00', '28999.00', 35, 'get.jpg', 11),
(48,'No Bounds XL', '23299.00', '00.00', 18, 'no bounds.png', 11),
(51,'Stir It Up', '38299.00', '34299.00', 35, 'stir it up.jpg', 12),
(52,'Stir It Up Wiresles','44299.00', '00.00', 18, 'stir it up wiresles.png', 12);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(15) NOT NULL,
  `descripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `descripcion`) VALUES
(0, 'Administrador'),
(1, 'Editor');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `clave`, `rol`) VALUES
(1, 'admin', 'administrador', '$2y$10$zrTvS/O4X6r7J7gjPw6.vOyYC6.dtktGQGq0QYLU3Py20kkKPUnSO', 0),
(51, 'editor2', 'editor2', '$2y$10$DWojwpmyO0m1SXSTudtOgOwIoJszfF3Rslm.PfHEF3q8MOYH260p2', 1),
(58, 'editor3', 'editor2', '$2y$10$wzb3rawMK5S2wwBH272ONO4X2bNGsqg9TSA7/xrQikCgkreUEmybq', 1),
(59, 'editor4', 'editor2', '$2y$10$ydoh7zoRGkVKKvcdtJl1rOzfOrIXyspNwoPq.N2ezsXFgLtLXhjdS', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito_usuarios`
--
ALTER TABLE `carrito_usuarios`
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
