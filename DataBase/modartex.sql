-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2016 a las 21:42:04
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.5.38

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
-- Estructura de tabla para la tabla `tbl_productos_objetivos`
--

CREATE TABLE `tbl_productos_objetivos` (
  `Codigo` int(11) NOT NULL,
  `Id_Objetivo` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Id_Fichas_Tallas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_productos_objetivos`
--

INSERT INTO `tbl_productos_objetivos` (`Codigo`, `Id_Objetivo`, `Cantidad`, `Id_Fichas_Tallas`) VALUES
(3, 1, 10, 23),
(4, 1, 20, 25),
(5, 1, 15, 28);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_productos_objetivos`
--
ALTER TABLE `tbl_productos_objetivos`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_Tbl_Productos_Objetivos_Tbl_Objetivos1_idx` (`Id_Objetivo`),
  ADD KEY `fk_tbl_productos_objetivos_tbl_fichastecnicas_tallas1_idx` (`Id_Fichas_Tallas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_productos_objetivos`
--
ALTER TABLE `tbl_productos_objetivos`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_productos_objetivos`
--
ALTER TABLE `tbl_productos_objetivos`
  ADD CONSTRAINT `fk_Tbl_Productos_Objetivos_Tbl_Objetivos1` FOREIGN KEY (`Id_Objetivo`) REFERENCES `tbl_objetivos` (`Id_Objetivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_productos_objetivos_tbl_fichastecnicas_tallas1` FOREIGN KEY (`Id_Fichas_Tallas`) REFERENCES `tbl_fichastecnicas_tallas` (`Id_Fichas_Tallas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
