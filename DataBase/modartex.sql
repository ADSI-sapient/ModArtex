-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2016 a las 07:27:21
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `modartex`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_listarColores` ()  NO SQL
SELECT 	Id_Color, Codigo_Color, Nombre FROM tbl_colores ORDER BY id DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_solicitarPermisos` (IN `_id_rol` INT(11))  NO SQL
SELECT p.Id_Permiso, p.Nombre, p.Url, (SELECT m.Nombre FROM tbl_modulos m WHERE p.id_modulo = m.id_Modulo) NombreM, (SELECT m.Icon FROM tbl_modulos m WHERE p.id_modulo = m.id_Modulo) Icon FROM tbl_roles r JOIN tbl_rol_permisos rp ON r.Id_Rol = rp.Id_Rol JOIN tbl_permisos p ON rp.Id_Permiso = p.Id_Permiso WHERE r.Id_Rol = _id_rol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_userLogin` (IN `_user` VARCHAR(15))  NO SQL
SELECT p.Nombre, p.Apellido, u.Usuario, u.Clave, p.Email, u.Tbl_Roles_Id_Rol, (SELECT r.Nombre FROM tbl_roles r WHERE u.Tbl_Roles_Id_Rol = r.Id_Rol) nombreR FROM tbl_persona p JOIN tbl_usuarios u ON u.Num_Documento = p.Num_Documento WHERE u.Usuario = _user$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_colores`
--

CREATE TABLE `tbl_colores` (
  `Id_Color` int(10) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Codigo_Color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_colores_insumos`
--

CREATE TABLE `tbl_colores_insumos` (
  `Id_Detalle` int(11) NOT NULL,
  `Id_Color` int(10) NOT NULL,
  `Id_Insumo` int(11) NOT NULL,
  `Cantidad_Insumo` int(11) DEFAULT NULL,
  `Valor_Promedio` double DEFAULT NULL,
  `Stock_Minimo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_entradas`
--

CREATE TABLE `tbl_entradas` (
  `Id_Entrada` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_entradas_exitencias`
--

CREATE TABLE `tbl_entradas_exitencias` (
  `Id_Detalle` int(11) NOT NULL,
  `Id_Entrada` int(11) NOT NULL,
  `Id_Existencias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado`
--

CREATE TABLE `tbl_estado` (
  `Id_Estado` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_existencias_salidas`
--

CREATE TABLE `tbl_existencias_salidas` (
  `Codigo` int(11) NOT NULL,
  `Id_Salida` int(11) NOT NULL,
  `Id_Existencias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_fichas_tecnicas`
--

CREATE TABLE `tbl_fichas_tecnicas` (
  `Referencia` int(11) NOT NULL,
  `Color` varchar(45) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Talla` varchar(4) NOT NULL,
  `Valor_Produccion` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_insumos`
--

CREATE TABLE `tbl_insumos` (
  `Id_Insumo` int(11) NOT NULL,
  `Id_Medida` int(11) NOT NULL,
  `Estado` tinyint(1) NOT NULL,
  `Nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_insumos_fichastecnicas`
--

CREATE TABLE `tbl_insumos_fichastecnicas` (
  `id_Insumos_Fichas` int(11) NOT NULL,
  `Id_Insumo` int(11) NOT NULL,
  `Id_FichaTecnica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_modulos`
--

CREATE TABLE `tbl_modulos` (
  `id_Modulo` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Icon` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_modulos`
--

INSERT INTO `tbl_modulos` (`id_Modulo`, `Nombre`, `Icon`) VALUES
(1, 'Usuario', 'fa fa-user'),
(2, 'Bodega', 'fa fa-truck'),
(3, 'Ficha Técnica', 'fa fa-puzzle-piece'),
(4, 'Cliente', 'fa fa-users'),
(5, 'Cotización', 'fa fa-calculator'),
(6, 'Pedido', 'fa fa-calendar'),
(7, 'Producción', 'fa fa-calendar'),
(8, 'Producto Terminado', 'fa fa-dropbox'),
(9, 'Configuración', 'fa fa-cogs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_objetivos`
--

CREATE TABLE `tbl_objetivos` (
  `Id_Objetivo` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `FechaRegistro` date NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date NOT NULL,
  `Estado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ordenesproduccion`
--

CREATE TABLE `tbl_ordenesproduccion` (
  `Num_Orden` int(11) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Fecha_Registro` date NOT NULL,
  `Fecha_Fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_permisos`
--

CREATE TABLE `tbl_permisos` (
  `Id_Permiso` int(11) NOT NULL,
  `id_Modulo` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_permisos`
--

INSERT INTO `tbl_permisos` (`Id_Permiso`, `id_Modulo`, `Nombre`, `Url`) VALUES
(1, 1, 'Registrar Usuario', 'ctrUsuario/regUsuario'),
(2, 1, 'Listar Usuarios', 'ctrUsuario/consUsuario'),
(3, 2, 'Registrar Insumo', 'ctrBodega/registrarInsumo'),
(4, 2, 'Listar insumos', 'ctrBodega/listarInsumos'),
(5, 2, 'Existencias Insumos', 'ctrBodega/listExistencias'),
(6, 3, 'Registrar Ficha', 'ctrUsuario/consUsuario'),
(7, 3, 'Listar Fichas', ''),
(8, 4, 'Registrar Cliente', ''),
(9, 4, 'Listar Clientes', ''),
(10, 5, 'Registrar Cotización', ''),
(11, 5, 'Listar Cotizaciones', ''),
(12, 6, 'Registrar Pedido', ''),
(13, 6, 'Listar Pedidos', ''),
(14, 7, 'Registrar Orden', ''),
(15, 7, 'Listar Órdenes', ''),
(16, 8, 'Existencias Producto T', ''),
(17, 9, 'Medidas', 'ctrConfiguracion/listarMedidas'),
(18, 9, 'Colores', 'ctrConfiguracion/listarColores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona`
--

CREATE TABLE `tbl_persona` (
  `Num_Documento` varchar(20) NOT NULL,
  `Id_Tipo` int(11) NOT NULL,
  `Tipo_Documento` varchar(3) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Estado` int(1) NOT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Direccion` varchar(30) DEFAULT NULL,
  `Email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_persona`
--

INSERT INTO `tbl_persona` (`Num_Documento`, `Id_Tipo`, `Tipo_Documento`, `Nombre`, `Apellido`, `Estado`, `Telefono`, `Direccion`, `Email`) VALUES
('1017223026', 1, 'CC', 'Pepito', 'Perez', 1, '3116440736', 'Call 71c #30-215', 'jaac219@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `Referencia` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `StockMinimo` int(11) NOT NULL,
  `Valor_Producto` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos_objetivos`
--

CREATE TABLE `tbl_productos_objetivos` (
  `Codigo` int(11) NOT NULL,
  `Id_Objetivo` int(11) NOT NULL,
  `Producto_Referencia` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `Id_Rol` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_roles`
--

INSERT INTO `tbl_roles` (`Id_Rol`, `Nombre`) VALUES
(1, 'Administrador'),
(2, 'Supervisor'),
(3, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rol_permisos`
--

CREATE TABLE `tbl_rol_permisos` (
  `Id_Rol_Permisos` int(11) NOT NULL,
  `Id_Rol` int(11) NOT NULL,
  `Id_Permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_rol_permisos`
--

INSERT INTO `tbl_rol_permisos` (`Id_Rol_Permisos`, `Id_Rol`, `Id_Permiso`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 2, 3),
(20, 2, 4),
(21, 2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_salidas`
--

CREATE TABLE `tbl_salidas` (
  `Id_Salida` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_salidas_productos`
--

CREATE TABLE `tbl_salidas_productos` (
  `Id_Salida` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_salida_producto`
--

CREATE TABLE `tbl_salida_producto` (
  `Codigo` int(11) NOT NULL,
  `Id_Salida` int(11) NOT NULL,
  `Referencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitudes`
--

CREATE TABLE `tbl_solicitudes` (
  `Id_PedidosCotizaciones` int(11) NOT NULL,
  `Num_Documento` varchar(20) NOT NULL,
  `Id_Estado` int(11) NOT NULL,
  `Fecha_Vencimiento` date NOT NULL,
  `Valor_Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitudes_ordenesproduccion`
--

CREATE TABLE `tbl_solicitudes_ordenesproduccion` (
  `Codigo` int(11) NOT NULL,
  `Id_Pedidos_Cotizaciones_Tipo_Producto` int(11) NOT NULL,
  `Num_Orden` int(11) NOT NULL,
  `Estado` varchar(30) NOT NULL,
  `LugarProduccion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitudes_producto`
--

CREATE TABLE `tbl_solicitudes_producto` (
  `Id_PedidosCotizaciones_Producto` int(11) NOT NULL,
  `Id_PedidosCotizaciones_Tipo` int(11) NOT NULL,
  `Id_Producto` int(11) NOT NULL,
  `Cantidad_Existencias` int(11) NOT NULL,
  `Estado` varchar(30) NOT NULL,
  `Cantidad_Producir` int(11) NOT NULL,
  `Subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitudes_tipo`
--

CREATE TABLE `tbl_solicitudes_tipo` (
  `Id_PedidosCotizaciones_Tipo` int(11) NOT NULL,
  `Id_PedidosCotizaciones` int(11) NOT NULL,
  `Id_Tipo` int(11) NOT NULL,
  `Fecha_Registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo`
--

CREATE TABLE `tbl_tipo` (
  `Id_Tipo` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipopersona`
--

CREATE TABLE `tbl_tipopersona` (
  `Id_Tipo` int(11) NOT NULL,
  `Nombre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_tipopersona`
--

INSERT INTO `tbl_tipopersona` (`Id_Tipo`, `Nombre`) VALUES
(1, 'Usuario'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_unidades_medida`
--

CREATE TABLE `tbl_unidades_medida` (
  `Id_Medida` int(11) NOT NULL,
  `Abreviatura` varchar(45) NOT NULL,
  `Nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `Id_Usuario` int(11) NOT NULL,
  `Num_Documento` varchar(20) NOT NULL,
  `Tbl_Roles_Id_Rol` int(11) NOT NULL,
  `Usuario` varchar(15) NOT NULL,
  `Clave` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`Id_Usuario`, `Num_Documento`, `Tbl_Roles_Id_Rol`, `Usuario`, `Clave`) VALUES
(1, '1017223026', 1, 'pepito', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_colores`
--
ALTER TABLE `tbl_colores`
  ADD PRIMARY KEY (`Id_Color`);

--
-- Indices de la tabla `tbl_colores_insumos`
--
ALTER TABLE `tbl_colores_insumos`
  ADD PRIMARY KEY (`Id_Detalle`),
  ADD KEY `Id_Color_idx` (`Id_Color`),
  ADD KEY `Id_Insumo_idx` (`Id_Insumo`);

--
-- Indices de la tabla `tbl_entradas`
--
ALTER TABLE `tbl_entradas`
  ADD PRIMARY KEY (`Id_Entrada`);

--
-- Indices de la tabla `tbl_entradas_exitencias`
--
ALTER TABLE `tbl_entradas_exitencias`
  ADD PRIMARY KEY (`Id_Detalle`),
  ADD KEY `fk_Tbl_Entradas_has_Tbl_Exitencias_Tbl_Entradas1_idx` (`Id_Entrada`),
  ADD KEY `fk_Tbl_Entradas_Exitencias_Tbl_Colores_Insumos1_idx` (`Id_Existencias`);

--
-- Indices de la tabla `tbl_estado`
--
ALTER TABLE `tbl_estado`
  ADD PRIMARY KEY (`Id_Estado`);

--
-- Indices de la tabla `tbl_existencias_salidas`
--
ALTER TABLE `tbl_existencias_salidas`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_Tbl_ProductoT_Salida_Tbl_Salidas1_idx` (`Id_Salida`),
  ADD KEY `fk_Tbl_Existencias_Salidas_Tbl_Colores_Insumos1_idx` (`Id_Existencias`);

--
-- Indices de la tabla `tbl_fichas_tecnicas`
--
ALTER TABLE `tbl_fichas_tecnicas`
  ADD PRIMARY KEY (`Referencia`);

--
-- Indices de la tabla `tbl_insumos`
--
ALTER TABLE `tbl_insumos`
  ADD PRIMARY KEY (`Id_Insumo`),
  ADD KEY `Id_Medida_idx` (`Id_Medida`);

--
-- Indices de la tabla `tbl_insumos_fichastecnicas`
--
ALTER TABLE `tbl_insumos_fichastecnicas`
  ADD PRIMARY KEY (`id_Insumos_Fichas`),
  ADD KEY `fk_Tbl_Insumos_has_Tbl_Fichas_Tecnicas_Tbl_Fichas_Tecnicas1_idx` (`Id_FichaTecnica`),
  ADD KEY `fk_Tbl_Insumos_has_Tbl_Fichas_Tecnicas_Tbl_Insumos1_idx` (`Id_Insumo`);

--
-- Indices de la tabla `tbl_modulos`
--
ALTER TABLE `tbl_modulos`
  ADD PRIMARY KEY (`id_Modulo`);

--
-- Indices de la tabla `tbl_objetivos`
--
ALTER TABLE `tbl_objetivos`
  ADD PRIMARY KEY (`Id_Objetivo`);

--
-- Indices de la tabla `tbl_ordenesproduccion`
--
ALTER TABLE `tbl_ordenesproduccion`
  ADD PRIMARY KEY (`Num_Orden`);

--
-- Indices de la tabla `tbl_permisos`
--
ALTER TABLE `tbl_permisos`
  ADD PRIMARY KEY (`Id_Permiso`),
  ADD KEY `fk_Tbl_Permisos_Tbl_Modulos1_idx` (`id_Modulo`);

--
-- Indices de la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  ADD PRIMARY KEY (`Num_Documento`),
  ADD KEY `fk_Tbl_Persona_Tbl_TipoPersona1_idx` (`Id_Tipo`);

--
-- Indices de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD PRIMARY KEY (`Referencia`);

--
-- Indices de la tabla `tbl_productos_objetivos`
--
ALTER TABLE `tbl_productos_objetivos`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_Tbl_Productos_Objetivos_Tbl_Objetivos1_idx` (`Id_Objetivo`),
  ADD KEY `fk_Tbl_Fichas_Tecnicas_Objetivos_TblProducto1_idx` (`Producto_Referencia`);

--
-- Indices de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`Id_Rol`);

--
-- Indices de la tabla `tbl_rol_permisos`
--
ALTER TABLE `tbl_rol_permisos`
  ADD PRIMARY KEY (`Id_Rol_Permisos`),
  ADD KEY `fk_Tbl_Rol_has_Tbl_Permisos_Tbl_Permisos1_idx` (`Id_Permiso`),
  ADD KEY `fk_Tbl_Rol_has_Tbl_Permisos_Tbl_Rol1_idx` (`Id_Rol`);

--
-- Indices de la tabla `tbl_salidas`
--
ALTER TABLE `tbl_salidas`
  ADD PRIMARY KEY (`Id_Salida`);

--
-- Indices de la tabla `tbl_salidas_productos`
--
ALTER TABLE `tbl_salidas_productos`
  ADD PRIMARY KEY (`Id_Salida`);

--
-- Indices de la tabla `tbl_salida_producto`
--
ALTER TABLE `tbl_salida_producto`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_salida_has_TblProducto_TblProducto1_idx` (`Referencia`),
  ADD KEY `fk_salida_has_TblProducto_salida1_idx` (`Id_Salida`);

--
-- Indices de la tabla `tbl_solicitudes`
--
ALTER TABLE `tbl_solicitudes`
  ADD PRIMARY KEY (`Id_PedidosCotizaciones`),
  ADD KEY `fk_Tbl_Pedidos_Cotizaciones_Tbl_Estado1_idx` (`Id_Estado`),
  ADD KEY `fk_Tbl_PedidosCotizaciones_Tbl_Persona1_idx` (`Num_Documento`);

--
-- Indices de la tabla `tbl_solicitudes_ordenesproduccion`
--
ALTER TABLE `tbl_solicitudes_ordenesproduccion`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_has_TblProducto_ha_idx` (`Num_Orden`),
  ADD KEY `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_has_TblProducto_ha_idx1` (`Id_Pedidos_Cotizaciones_Tipo_Producto`);

--
-- Indices de la tabla `tbl_solicitudes_producto`
--
ALTER TABLE `tbl_solicitudes_producto`
  ADD PRIMARY KEY (`Id_PedidosCotizaciones_Producto`),
  ADD KEY `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_has_TblProducto_Tb_idx` (`Id_Producto`),
  ADD KEY `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_has_TblProducto_Tb_idx1` (`Id_PedidosCotizaciones_Tipo`);

--
-- Indices de la tabla `tbl_solicitudes_tipo`
--
ALTER TABLE `tbl_solicitudes_tipo`
  ADD PRIMARY KEY (`Id_PedidosCotizaciones_Tipo`),
  ADD KEY `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_Tbl_Tipo1_idx` (`Id_Tipo`),
  ADD KEY `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_Tbl_Pedidos_Cotiza_idx` (`Id_PedidosCotizaciones`);

--
-- Indices de la tabla `tbl_tipo`
--
ALTER TABLE `tbl_tipo`
  ADD PRIMARY KEY (`Id_Tipo`);

--
-- Indices de la tabla `tbl_tipopersona`
--
ALTER TABLE `tbl_tipopersona`
  ADD PRIMARY KEY (`Id_Tipo`);

--
-- Indices de la tabla `tbl_unidades_medida`
--
ALTER TABLE `tbl_unidades_medida`
  ADD PRIMARY KEY (`Id_Medida`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`Id_Usuario`),
  ADD KEY `fk_Tbl_Usuario_Tbl_Persona1_idx` (`Num_Documento`),
  ADD KEY `fk_Tbl_Usuarios_Tbl_Roles1_idx` (`Tbl_Roles_Id_Rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_colores`
--
ALTER TABLE `tbl_colores`
  MODIFY `Id_Color` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_colores_insumos`
--
ALTER TABLE `tbl_colores_insumos`
  MODIFY `Id_Detalle` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_entradas_exitencias`
--
ALTER TABLE `tbl_entradas_exitencias`
  MODIFY `Id_Detalle` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_insumos_fichastecnicas`
--
ALTER TABLE `tbl_insumos_fichastecnicas`
  MODIFY `id_Insumos_Fichas` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_modulos`
--
ALTER TABLE `tbl_modulos`
  MODIFY `id_Modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tbl_objetivos`
--
ALTER TABLE `tbl_objetivos`
  MODIFY `Id_Objetivo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_ordenesproduccion`
--
ALTER TABLE `tbl_ordenesproduccion`
  MODIFY `Num_Orden` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_permisos`
--
ALTER TABLE `tbl_permisos`
  MODIFY `Id_Permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `Referencia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `Id_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbl_rol_permisos`
--
ALTER TABLE `tbl_rol_permisos`
  MODIFY `Id_Rol_Permisos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `tbl_salidas_productos`
--
ALTER TABLE `tbl_salidas_productos`
  MODIFY `Id_Salida` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_salida_producto`
--
ALTER TABLE `tbl_salida_producto`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_solicitudes`
--
ALTER TABLE `tbl_solicitudes`
  MODIFY `Id_PedidosCotizaciones` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_solicitudes_ordenesproduccion`
--
ALTER TABLE `tbl_solicitudes_ordenesproduccion`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_solicitudes_producto`
--
ALTER TABLE `tbl_solicitudes_producto`
  MODIFY `Id_PedidosCotizaciones_Producto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_solicitudes_tipo`
--
ALTER TABLE `tbl_solicitudes_tipo`
  MODIFY `Id_PedidosCotizaciones_Tipo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_tipopersona`
--
ALTER TABLE `tbl_tipopersona`
  MODIFY `Id_Tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_colores_insumos`
--
ALTER TABLE `tbl_colores_insumos`
  ADD CONSTRAINT `Id_Color` FOREIGN KEY (`Id_Color`) REFERENCES `tbl_colores` (`Id_Color`),
  ADD CONSTRAINT `Id_Insumo` FOREIGN KEY (`Id_Insumo`) REFERENCES `tbl_insumos` (`Id_Insumo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_entradas_exitencias`
--
ALTER TABLE `tbl_entradas_exitencias`
  ADD CONSTRAINT `fk_Tbl_Entradas_has_Tbl_Exitencias_Tbl_Entradas1` FOREIGN KEY (`Id_Entrada`) REFERENCES `tbl_entradas` (`Id_Entrada`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_existencias_salidas`
--
ALTER TABLE `tbl_existencias_salidas`
  ADD CONSTRAINT `fk_Tbl_ProductoT_Salida_Tbl_Salidas1` FOREIGN KEY (`Id_Salida`) REFERENCES `tbl_salidas` (`Id_Salida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_insumos`
--
ALTER TABLE `tbl_insumos`
  ADD CONSTRAINT `Id_Medida` FOREIGN KEY (`Id_Medida`) REFERENCES `tbl_unidades_medida` (`Id_Medida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_insumos_fichastecnicas`
--
ALTER TABLE `tbl_insumos_fichastecnicas`
  ADD CONSTRAINT `fk_Tbl_Insumos_has_Tbl_Fichas_Tecnicas_Tbl_Fichas_Tecnicas1` FOREIGN KEY (`Id_FichaTecnica`) REFERENCES `tbl_fichas_tecnicas` (`Referencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tbl_Insumos_has_Tbl_Fichas_Tecnicas_Tbl_Insumos1` FOREIGN KEY (`Id_Insumo`) REFERENCES `tbl_insumos` (`Id_Insumo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_permisos`
--
ALTER TABLE `tbl_permisos`
  ADD CONSTRAINT `fk_Tbl_Permisos_Tbl_Modulos1` FOREIGN KEY (`id_Modulo`) REFERENCES `tbl_modulos` (`id_Modulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  ADD CONSTRAINT `fk_Tbl_Persona_Tbl_TipoPersona1` FOREIGN KEY (`Id_Tipo`) REFERENCES `tbl_tipopersona` (`Id_Tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD CONSTRAINT `fk_TblProducto_Tbl_Fichas_Tecnicas1` FOREIGN KEY (`Referencia`) REFERENCES `tbl_fichas_tecnicas` (`Referencia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_productos_objetivos`
--
ALTER TABLE `tbl_productos_objetivos`
  ADD CONSTRAINT `fk_Tbl_Fichas_Tecnicas_Objetivos_TblProducto1` FOREIGN KEY (`Producto_Referencia`) REFERENCES `tbl_productos` (`Referencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tbl_Productos_Objetivos_Tbl_Objetivos1` FOREIGN KEY (`Id_Objetivo`) REFERENCES `tbl_objetivos` (`Id_Objetivo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_rol_permisos`
--
ALTER TABLE `tbl_rol_permisos`
  ADD CONSTRAINT `fk_Tbl_Rol_has_Tbl_Permisos_Tbl_Permisos1` FOREIGN KEY (`Id_Permiso`) REFERENCES `tbl_permisos` (`Id_Permiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tbl_Rol_has_Tbl_Permisos_Tbl_Rol1` FOREIGN KEY (`Id_Rol`) REFERENCES `tbl_roles` (`Id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_salida_producto`
--
ALTER TABLE `tbl_salida_producto`
  ADD CONSTRAINT `fk_salida_has_TblProducto_TblProducto1` FOREIGN KEY (`Referencia`) REFERENCES `tbl_productos` (`Referencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_salida_has_TblProducto_salida1` FOREIGN KEY (`Id_Salida`) REFERENCES `tbl_salidas_productos` (`Id_Salida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_solicitudes`
--
ALTER TABLE `tbl_solicitudes`
  ADD CONSTRAINT `fk_Tbl_PedidosCotizaciones_Tbl_Persona1` FOREIGN KEY (`Num_Documento`) REFERENCES `tbl_persona` (`Num_Documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tbl_Pedidos_Cotizaciones_Tbl_Estado1` FOREIGN KEY (`Id_Estado`) REFERENCES `tbl_estado` (`Id_Estado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_solicitudes_ordenesproduccion`
--
ALTER TABLE `tbl_solicitudes_ordenesproduccion`
  ADD CONSTRAINT `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_has_TblProducto_has_1` FOREIGN KEY (`Id_Pedidos_Cotizaciones_Tipo_Producto`) REFERENCES `tbl_solicitudes_producto` (`Id_PedidosCotizaciones_Producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_has_TblProducto_has_2` FOREIGN KEY (`Num_Orden`) REFERENCES `tbl_ordenesproduccion` (`Num_Orden`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_solicitudes_producto`
--
ALTER TABLE `tbl_solicitudes_producto`
  ADD CONSTRAINT `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_has_TblProducto_TblP1` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Referencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_has_TblProducto_Tbl_1` FOREIGN KEY (`Id_PedidosCotizaciones_Tipo`) REFERENCES `tbl_solicitudes_tipo` (`Id_PedidosCotizaciones_Tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_solicitudes_tipo`
--
ALTER TABLE `tbl_solicitudes_tipo`
  ADD CONSTRAINT `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_Tbl_Pedidos_Cotizaci1` FOREIGN KEY (`Id_PedidosCotizaciones`) REFERENCES `tbl_solicitudes` (`Id_PedidosCotizaciones`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_Tbl_Tipo1` FOREIGN KEY (`Id_Tipo`) REFERENCES `tbl_tipo` (`Id_Tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD CONSTRAINT `fk_Tbl_Usuario_Tbl_Persona1` FOREIGN KEY (`Num_Documento`) REFERENCES `tbl_persona` (`Num_Documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tbl_Usuarios_Tbl_Roles1` FOREIGN KEY (`Tbl_Roles_Id_Rol`) REFERENCES `tbl_roles` (`Id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
