-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2024 at 01:51 PM
-- Server version: 5.7.42-0ubuntu0.18.04.1
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prestamos`
--

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(10) NOT NULL,
  `cliente_dni` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_apellido` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_email` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cliente_direccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `cliente_dni`, `cliente_nombre`, `cliente_apellido`, `cliente_telefono`, `cliente_email`, `cliente_direccion`) VALUES
(1, '17806560-Y', 'Manuel', 'Parra Moncayo', '616350954', 'manuelparra@live.com.ar', 'Córdoba Capital, Andalucía'),
(2, '11884269-P', 'Marla', 'Parra Moncayo', '619724317', 'marla_parra@hotmail.com', 'Calle Escritor Conde de Zamora # 10 7 3-3'),
(3, '45744962-D', 'Alberto', 'Moreno Molina', '628252728', 'alberto.moreno@ofg.es', 'Calle Austriada 18 Córdoba Capital'),
(5, '17806562-Y', 'Miguel', 'Parra Marcano', '616350953', 'miguelparra@hotmail.com', 'Calle Miguel Benzo #16, Córdoba Capital');

-- --------------------------------------------------------

--
-- Table structure for table `detalle`
--

CREATE TABLE `detalle` (
  `detalle_id` int(100) NOT NULL,
  `detalle_cantidad` int(10) NOT NULL,
  `detalle_formato` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `detalle_tiempo` int(7) NOT NULL,
  `detalle_costo_tiempo` decimal(30,2) NOT NULL,
  `detalle_descripcion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `prestamo_codigo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `item_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
--

CREATE TABLE `empresa` (
  `empresa_id` int(2) NOT NULL,
  `empresa_nombre` varchar(90) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_email` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_direccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(10) NOT NULL,
  `item_codigo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `item_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `item_stock` int(10) NOT NULL,
  `item_estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `item_detalle` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pago`
--

CREATE TABLE `pago` (
  `pago_id` int(20) NOT NULL,
  `pago_total` decimal(30,2) NOT NULL,
  `pago_fecha` date NOT NULL,
  `prestamo_codigo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perfil`
--

CREATE TABLE `perfil` (
  `perfil_id` int(11) NOT NULL,
  `perfil_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `perfil`
--

INSERT INTO `perfil` (`perfil_id`, `perfil_nombre`) VALUES
(1, 'Web Developer'),
(2, 'Administración');

-- --------------------------------------------------------

--
-- Table structure for table `prestamo`
--

CREATE TABLE `prestamo` (
  `prestamo_id` int(50) NOT NULL,
  `prestamo_codigo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `prestamo_fecha_inicio` date NOT NULL,
  `prestamo_hora_inicio` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `prestamo_fecha_final` date NOT NULL,
  `prestamo_hora_final` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `prestamo_cantidad` int(10) NOT NULL,
  `prestamo_total` decimal(30,2) NOT NULL,
  `prestamo_pagado` decimal(30,2) NOT NULL,
  `prestamo_estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `prestamo_observacion` varchar(535) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_id` int(10) NOT NULL,
  `cliente_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL,
  `usuario_dni` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_direccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_email` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_clave` varchar(535) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_estado` varchar(17) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_privilegio` int(11) NOT NULL,
  `usuario_perfil_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_dni`, `usuario_nombre`, `usuario_apellido`, `usuario_telefono`, `usuario_direccion`, `usuario_email`, `usuario_usuario`, `usuario_clave`, `usuario_estado`, `usuario_privilegio`, `usuario_perfil_id`) VALUES
(1, '17806560-Y', 'Manuel', 'Parra Moncayo', '616350954', 'Córdoba Capital', 'manuelparra@live.com.ar', 'manuelparra', 'WkcvVHZrUWVONDY0MXZxLzh4TU0wQT09', 'Activa', 1, 1),
(2, '11884269-P', 'Marla', 'Parra Moncayo', '619724317', 'Córdoba Capital, Andalucía', 'marlaparra@hotmail.com', 'marlaparra', 'd3ozNGZlcmRzb2NERFJQM01wczNHZz09', 'Activa', 2, 2),
(3, '17806561-Y', 'Jose', 'Gutierrez Moncayo', '616350954', 'Cabimas, Zulia', 'josegutierez@hotmail.com', 'josegutierrez', 'WkcvVHZrUWVONDY0MXZxLzh4TU0wQT09', 'Activa', 2, 2),
(4, '47222842-R', 'Roberto', 'Villas Molina', '690361124', 'Madrid', 'rvg.works@gmail.com', 'robertovillas', 'WjZqOTFUa3FBMGN3L3duMGM1bE9JQT09', 'Activa', 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indexes for table `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`detalle_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `prestamo_codigo` (`prestamo_codigo`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`empresa_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`pago_id`),
  ADD KEY `prestamo_codigo` (`prestamo_codigo`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`perfil_id`);

--
-- Indexes for table `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`prestamo_id`),
  ADD UNIQUE KEY `prestamo_codigo` (`prestamo_codigo`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `detalle`
--
ALTER TABLE `detalle`
  MODIFY `detalle_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `empresa_id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pago`
--
ALTER TABLE `pago`
  MODIFY `pago_id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
  MODIFY `perfil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `prestamo_id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`),
  ADD CONSTRAINT `detalle_ibfk_2` FOREIGN KEY (`prestamo_codigo`) REFERENCES `prestamo` (`prestamo_codigo`);

--
-- Constraints for table `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`prestamo_codigo`) REFERENCES `prestamo` (`prestamo_codigo`);

--
-- Constraints for table `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`),
  ADD CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
