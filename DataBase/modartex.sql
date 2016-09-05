-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-09-2016 a las 05:10:53
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `modartex`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_colores_insumos`
--

CREATE TABLE `tbl_colores_insumos` (
  `Id_Existencias_InsCol` int(11) NOT NULL,
  `Id_Color` int(10) NOT NULL,
  `Id_Insumo` int(11) NOT NULL,
  `Cantidad_Insumo` int(11) DEFAULT NULL,
  `Valor_Promedio` double DEFAULT NULL,
  `Stock_Minimo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_colores_insumos`
--
ALTER TABLE `tbl_colores_insumos`
  ADD PRIMARY KEY (`Id_Existencias_InsCol`),
  ADD KEY `Id_Color_idx` (`Id_Color`),
  ADD KEY `Id_Insumo_idx` (`Id_Insumo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_colores_insumos`
--
ALTER TABLE `tbl_colores_insumos`
  MODIFY `Id_Existencias_InsCol` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_colores_insumos`
--
ALTER TABLE `tbl_colores_insumos`
  ADD CONSTRAINT `Id_Color` FOREIGN KEY (`Id_Color`) REFERENCES `tbl_colores` (`Id_Color`),
  ADD CONSTRAINT `tbl_colores_insumos_ibfk_1` FOREIGN KEY (`Id_Insumo`) REFERENCES `tbl_insumos` (`Id_Insumo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
