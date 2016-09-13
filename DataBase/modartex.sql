-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-09-2016 a las 16:01:59
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_actualiarFechaEntPedi` (IN `_fechaEntreP` DATE, IN `_idSolt` INT)  NO SQL
UPDATE tbl_solicitudes_ordenesproduccion sop JOIN tbl_solicitudes_producto sp ON sop.Id_Solicitud_Producto=sp.Id_Solicitudes_Producto JOIN tbl_solicitudes_tipo st ON sp.Id_Solicitudes_Tipo=st.Id_Solicitudes_Tipo SET st.Fecha_Entrega = _fechaEntreP WHERE st.Id_Solicitud = _idSolt$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_actualizarCantidadProd` (IN `_idSolPr` INT, IN `_cantFab` INT, IN `_cantSat` INT)  NO SQL
UPDATE tbl_solicitudes_producto SET Cantidad_Producir = _cantFab, Cantidad_Satelite = _cantSat WHERE Id_Solicitudes_Producto = _idSolPr$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_actualizarEstadoPed` (IN `_idSolt` INT)  NO SQL
UPDATE tbl_solicitudes SET Id_Estado = 6 WHERE Id_Solicitud = _idSolt$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ActualizarExis` (IN `id` INT(11), IN `cant` INT(11), IN `prom` DOUBLE)  NO SQL
UPDATE tbl_colores_insumos SET Cantidad_Insumo = cant, Valor_Promedio = prom WHERE Id_Existencias_InsCol = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AsociarF` ()  NO SQL
SELECT Referencia, Id_Ficha_Tecnica FROM tbl_fichas_tecnicas$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AsociarPermisos` ()  NO SQL
SELECT a.Id_Permiso, b.Nombre as modulos, a.Nombre
FROM tbl_permisos a JOIN tbl_modulos b
ON a.id_Modulo= b.id_Modulo$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AumentarExisIns` (IN `id` INT(11), IN `cant` INT(11), IN `prom` DOUBLE)  NO SQL
UPDATE tbl_colores_insumos SET Cantidad_Insumo = cant, Valor_Promedio = prom WHERE Id_Existencias_InsCol = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BorrarColIns` (IN `colIns` INT)  NO SQL
DELETE FROM tbl_colores_insumos WHERE Id_Existencias_InsCol = colIns$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CambiarEstadoFicha` (IN `_id_fichat` INT, IN `_estado` INT)  NO SQL
UPDATE tbl_fichas_tecnicas SET Estado = _estado WHERE Id_Ficha_Tecnica = _id_fichat$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_cambiarEstadoIns` (IN `_id` INT(11), IN `_est` INT(1))  NO SQL
UPDATE tbl_insumos SET Estado = _est WHERE Id_Insumo =_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CambiarEstadoOrden` (IN `ord` INT, IN `est` INT)  NO SQL
UPDATE tbl_ordenesproduccion SET Id_Estado = est
WHERE Num_Orden = ord$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CambiarEstadoOrdenSol` (IN `ordSol` INT, IN `est` INT)  NO SQL
UPDATE tbl_solicitudes_ordenesproduccion so SET so.Id_Estado = est
WHERE so.Codigo = ordSol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CambiarEstadoP` (IN `_estado` INT, IN `_documento` VARCHAR(20))  NO SQL
UPDATE tbl_persona SET Estado = _estado WHERE Num_Documento = _documento$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CambiarEstadoR` (IN `_estado` INT, IN `_id_rol` INT)  NO SQL
UPDATE tbl_roles SET Estado = _estado WHERE Id_Rol = _id_rol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CancelarObjetivo` (IN `estado` INT, IN `objetivo` INT)  NO SQL
UPDATE tbl_objetivos set Id_Estado= estado where Id_objetivo= objetivo$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_cancelarOdenPr` (IN `_id_ordenp` INT)  NO SQL
UPDATE tbl_ordenesproduccion SET Id_Estado = 4 WHERE Num_Orden = _id_ordenp$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_cancelarPedido` (IN `_id_estado` INT, IN `_id_pedido` INT)  NO SQL
UPDATE tbl_solicitudes SET Id_Estado = _id_estado WHERE Id_Solicitud = _id_pedido$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CantidadColIns` (IN `ColIns` INT)  NO SQL
SELECT Cantidad_Insumo cantidad FROM tbl_colores_insumos WHERE Id_Existencias_InsCol = ColIns$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CargarProduAsoPed` (IN `_idPedido` INT)  NO SQL
SELECT sp.Id_Solicitudes_Producto, ft.Id_Ficha_Tecnica, ft.Referencia, c.Codigo_Color, c.Nombre nomColor, ft.Valor_Producto, sp.Cantidad_Producir, sp.Subtotal FROM tbl_solicitudes s JOIN tbl_solicitudes_tipo st ON s.Id_Solicitud = st.Id_Solicitud JOIN tbl_solicitudes_producto sp ON st.Id_Solicitudes_Tipo = sp.Id_Solicitudes_Tipo JOIN tbl_fichas_tecnicas ft ON sp.Id_Ficha_Tecnica=ft.Id_Ficha_Tecnica JOIN tbl_colores c ON ft.Id_Color=c.Id_Color WHERE s.Id_Solicitud = _idPedido$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsCantExis` (IN `idExt` INT(11))  NO SQL
SELECT Cantidad_Insumo Cantidad, Valor_Promedio Valor FROM tbl_colores_insumos$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consClientesHab` ()  NO SQL
SELECT Num_Documento, Nombre, Telefono, Email FROM tbl_persona WHERE Id_Tipo = 2 and Estado = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsFichasAsocColIns` (IN `ColIns` INT)  NO SQL
SELECT * FROM tbl_insumos_fichastecnicas 
WHERE Id_Existencias_InsCol = ColIns$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consInsumosRegFicha` ()  NO SQL
SELECT ci.Id_Existencias_InsCol Id_Insumo, um.Abreviatura, i.Estado, i.Nombre, ci.Valor_Promedio, c.Codigo_Color FROM tbl_insumos i JOIN tbl_unidades_medida um ON i.Id_Medida = um.Id_Medida JOIN tbl_colores_insumos ci ON i.Id_Insumo = ci.Id_Insumo JOIN tbl_colores c ON c.Id_Color = ci.Id_Color WHERE i.Estado = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consOrdenes` ()  NO SQL
SELECT op.Num_Orden, op.Fecha_Registro, e.Nombre_Estado, op.Id_Estado, st.Fecha_Entrega, st.Id_Solicitud, s.Num_Documento, p.Nombre, op.LugarProduccion FROM tbl_ordenesproduccion op JOIN tbl_solicitudes_ordenesproduccion sop ON op.Num_Orden=sop.Num_Orden JOIN tbl_solicitudes_producto sp ON sop.Id_Solicitud_Producto=sp.Id_Solicitudes_Producto JOIN tbl_solicitudes_tipo st ON sp.Id_Solicitudes_Tipo=st.Id_Solicitudes_Tipo JOIN tbl_estado e ON op.Id_Estado=e.Id_Estado JOIN tbl_solicitudes s ON st.Id_Solicitud=s.Id_Solicitud JOIN tbl_persona p ON s.Num_Documento=p.Num_Documento group by op.Num_Orden$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consPedidoCliente` (IN `id_solict` INT)  NO SQL
SELECT s.Id_Solicitud, s.Fecha_Registro, s.Num_Documento, st.Fecha_Entrega, s.Valor_Total, e.Id_Estado , p.Nombre, e.Nombre_Estado FROM tbl_solicitudes s JOIN tbl_solicitudes_tipo st ON s.Id_Solicitud = st.Id_Solicitud JOIN tbl_persona p ON s.Num_Documento = p.Num_Documento JOIN tbl_estado e ON e.Id_Estado=s.Id_Estado WHERE s.Id_Solicitud = id_solict and st.Id_Tipo = 2 and s.Id_Estado = 5$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsPedidos` ()  NO SQL
SELECT s.Id_Solicitud, s.Fecha_Registro, s.Num_Documento, st.Fecha_Entrega, s.Valor_Total, e.Id_Estado , p.Nombre, e.Nombre_Estado FROM tbl_solicitudes s JOIN tbl_solicitudes_tipo st ON s.Id_Solicitud = st.Id_Solicitud JOIN tbl_persona p ON s.Num_Documento = p.Num_Documento JOIN tbl_estado e ON e.Id_Estado=s.Id_Estado WHERE st.Id_Tipo = 2 ORDER BY s.Id_Solicitud DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consPedidosCliente` ()  NO SQL
SELECT s.Id_Solicitud, s.Num_Documento, p.Nombre FROM tbl_solicitudes s JOIN tbl_persona p ON s.Num_Documento=p.Num_Documento$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consPedidosProduccion` ()  NO SQL
SELECT s.Id_Solicitud, s.Fecha_Registro, s.Num_Documento, st.Fecha_Entrega, s.Valor_Total, e.Id_Estado , p.Nombre, e.Nombre_Estado FROM tbl_solicitudes s JOIN tbl_solicitudes_tipo st ON s.Id_Solicitud = st.Id_Solicitud JOIN tbl_persona p ON s.Num_Documento = p.Num_Documento JOIN tbl_estado e ON e.Id_Estado=s.Id_Estado WHERE st.Id_Tipo = 2 and s.Id_Estado = 5$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consProductosHab` ()  NO SQL
SELECT f.Id_Ficha_Tecnica, f.Referencia, f.Estado, c.Codigo_Color, f.Fecha_Registro, f.Stock_Minimo, f.Valor_Produccion, f.Valor_Producto, f.Cantidad FROM tbl_fichas_tecnicas f JOIN tbl_colores c ON f.Id_Color = c.Id_Color WHERE f.Estado = 1 ORDER BY f.Fecha_Registro DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consProductosOrden` (IN `_numOrd` INT)  NO SQL
SELECT sp.Id_Ficha_Tecnica, ft.Referencia, c.Codigo_Color, c.Nombre Nombre_Color, sp.Cantidad_Producir, sop.Cantidad_Fabrica, sop.Id_Estado, e.Nombre_Estado, sop.Cantidad_Satelite, sop.Id_Solicitud_Producto, sop.Codigo FROM tbl_solicitudes_ordenesproduccion sop JOIN tbl_solicitudes_producto sp ON sop.Id_Solicitud_Producto=sp.Id_Solicitudes_Producto JOIN tbl_fichas_tecnicas ft ON sp.Id_Ficha_Tecnica=ft.Id_Ficha_Tecnica JOIN tbl_colores c ON ft.Id_Color=c.Id_Color JOIN tbl_estado e ON sop.Id_Estado=e.Id_Estado WHERE sop.Num_Orden = _numOrd$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsTallasAsoFicha` (IN `_id_fichat` INT)  NO SQL
SELECT t.Id_Talla, t.Nombre FROM tbl_fichastecnicas_tallas df JOIN tbl_tallas t ON df.Id_Talla = t.Id_Talla WHERE df.Id_Ficha_Tecnica = _id_fichat$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsultarRoles` ()  NO SQL
SELECT Id_Rol, Nombre FROM tbl_roles WHERE Estado= 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consUltimaOrden` ()  NO SQL
SELECT MAX(Num_Orden) as ultOrden FROM tbl_ordenesproduccion$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteInsumosAso` (IN `_id_fichat` INT)  NO SQL
DELETE FROM tbl_insumos_fichastecnicas WHERE Id_Ficha_Tecnica = _id_fichat$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteTallasAso` (IN `_id_fichat` INT)  NO SQL
DELETE FROM tbl_fichastecnicas_tallas WHERE Id_Ficha_Tecnica = _id_fichat$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_descExistenciasInsumos` (IN `_id_ficha` INT, IN `_id_extcol` INT, IN `_cant_descontar` INT)  NO SQL
UPDATE tbl_colores_insumos cli JOIN tbl_insumos_fichastecnicas ift ON cli.Id_Existencias_InsCol=ift.Id_Existencias_InsCol SET cli.Cantidad_Insumo = cli.Cantidad_Insumo - _cant_descontar WHERE ift.Id_Ficha_Tecnica = _id_ficha and cli.Id_Existencias_InsCol = _id_extcol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DescontarP` (IN `_Cantidad` INT, IN `_id` INT, IN `salida` INT)  NO SQL
UPDATE tbl_fichas_tecnicas SET Cantidad = _Cantidad - salida WHERE  Id_Ficha_Tecnica = _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DisminuirExsIns` (IN `idExt` INT(11), IN `cant` INT(11))  NO SQL
UPDATE tbl_colores_insumos SET Cantidad_Insumo = cant WHERE Id_Existencias_InsCol = idExt$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_editarOrdenProduccion` (IN `idOr` INT, IN `lugar` VARCHAR(30))  NO SQL
UPDATE tbl_ordenesproduccion o SET o.LugarProduccion = lugar
WHERE o.Num_Orden = idOr$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_EditarPedido` (IN `_fechaentreg` DATE, IN `_vlrtotal` DOUBLE, IN `_doccliente` VARCHAR(20), IN `_idpedido` INT)  NO SQL
UPDATE tbl_solicitudes s JOIN tbl_solicitudes_tipo st ON s.Id_Solicitud = st.Id_Solicitud SET st.Fecha_Entrega = _fechaentreg, s.Valor_Total = _vlrtotal, s.Num_Documento = _doccliente WHERE st.Id_Solicitud = _idpedido$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_eliminarColor` (IN `_id` INT(10))  NO SQL
DELETE FROM tbl_colores WHERE Id_Color = _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_eliminarFichasAsoPed` (IN `_id_solicitudes_tipo` INT)  NO SQL
DELETE FROM tbl_solicitudes_producto WHERE Id_Solicitudes_Tipo = _id_solicitudes_tipo$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_eliminarMedida` (IN `_id` INT(11))  NO SQL
DELETE FROM tbl_unidades_medida WHERE Id_Medida = _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_eliminarSolicOrdenes` (IN `_numOrd` INT)  NO SQL
DELETE FROM tbl_solicitudes_ordenesproduccion WHERE Num_Orden = _numOrd$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsumosAsoFicha` (IN `_id_fichat` INT)  NO SQL
SELECT ift.Id_Existencias_InsCol Id_Insumo, c.Codigo_Color, i.Nombre, um.Abreviatura, ift.Cant_Necesaria, ift.Valor_Insumo, ci.Valor_Promedio FROM tbl_insumos_fichastecnicas ift JOIN tbl_colores_insumos ci ON ift.Id_Existencias_InsCol=ci.Id_Existencias_InsCol JOIN tbl_insumos i ON 
ci.Id_Insumo=i.Id_Insumo JOIN tbl_unidades_medida um ON i.Id_Medida=um.Id_Medida JOIN tbl_colores c ON c.Id_Color = ci.Id_Color WHERE ift.Id_Ficha_Tecnica = _id_fichat$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ListarClientes` ()  NO SQL
SELECT Tipo_Documento, Num_Documento, Nombre, Apellido, Telefono, Direccion, Email, Estado FROM tbl_persona WHERE Id_Tipo= 2$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_listarColores` ()  NO SQL
SELECT  Id_Color, Codigo_Color, Nombre FROM tbl_colores ORDER BY Id_Color DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_listarColorInsumo` (IN `_idIns` INT(11))  NO SQL
SELECT c.Codigo_Color codigo, c.Nombre nombre, c.Id_Color, ci.Id_Existencias_InsCol Id_ColIns, ci.Valor_Promedio valor, ci.Cantidad_Insumo cantidad FROM tbl_colores c JOIN tbl_colores_insumos ci ON c.Id_Color = ci.Id_Color WHERE ci.Id_Insumo = _idIns$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ListarExistencias` ()  NO SQL
SELECT ci.Id_Existencias_InsCol, c.Nombre, c.Codigo_Color, i.Nombre NomIns, um.Abreviatura medida, ci.Cantidad_Insumo, ci.Valor_Promedio, ci.Stock_Minimo FROM tbl_colores c JOIN tbl_colores_insumos ci ON c.Id_Color =  ci.Id_Color JOIN tbl_insumos i ON ci.Id_Insumo = i.Id_Insumo JOIN tbl_unidades_medida um ON i.Id_Medida = um.Id_Medida$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ListarFichasParaAsociar` ()  NO SQL
SELECT f.Referencia, f.Fecha_Registro, f.Estado, f.Color, p.Stock_Minimo, f.Valor_Produccion, p.Valor_Producto FROM tbl_fichas_tecnicas f JOIN tbl_productos p ON f.Referencia = p.Referencia WHERE f.Estado = 1 ORDER BY f.Fecha_Registro DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ListarFichasTecnicas` ()  NO SQL
SELECT f.Id_Ficha_Tecnica, f.Referencia, f.Fecha_Registro, f.Estado, c.Codigo_Color, c.Id_Color, f.Stock_Minimo, f.Valor_Produccion, f.Valor_Producto FROM tbl_fichas_tecnicas f JOIN tbl_colores c ON f.Id_Color=c.Id_Color ORDER BY f.Fecha_Registro DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_listarInsumos` ()  NO SQL
SELECT DISTINCT i.Id_Insumo, i.Estado, i.Nombre, m.Id_Medida, m.Nombre NombreMed,  ci.Stock_Minimo FROM tbl_insumos i JOIN tbl_unidades_medida m ON i.Id_Medida = m.Id_Medida JOIN tbl_colores_insumos ci ON ci.Id_Insumo = i.Id_Insumo$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_listarMedidas` ()  NO SQL
SELECT  Id_Medida, Abreviatura, Nombre FROM tbl_unidades_medida ORDER BY Id_Medida DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ListarPermisos` (IN `_Id_Rol` INT(11))  NO SQL
SELECT rp.Id_Permiso, m.Nombre NombreMod, p.Nombre FROM tbl_rol_permisos rp JOIN tbl_permisos p ON rp.Id_Permiso = p.Id_Permiso JOIN tbl_modulos m ON p.id_Modulo = m.id_Modulo WHERE rp.Id_Rol = _Id_Rol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ListarProductoT` ()  NO SQL
SELECT ft.Referencia, c.Nombre, ft.Cantidad, ft.Valor_Produccion, ft.Stock_Minimo, c.Codigo_Color, ft.Id_Ficha_Tecnica, c.Id_Color FROM tbl_fichas_tecnicas ft JOIN tbl_colores c ON ft.Id_Color = c.Id_Color$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ListarRoles` ()  NO SQL
Select Id_Rol, Nombre, Estado FROM tbl_roles$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ListarUsuarios` ()  NO SQL
SELECT p.Tipo_Documento, p.Num_Documento, p.Estado, p.Nombre, p.Apellido, p.Email, u.Id_Usuario, u.Usuario, r.Nombre AS rol, r.Id_Rol AS idRol
FROM tbl_persona p
JOIN tbl_usuarios u 
ON p.Num_Documento= u.Num_Documento
JOIN tbl_roles r
ON  u.Tbl_Roles_Id_Rol = r.Id_Rol
ORDER BY Id_Usuario DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ModExisIns` (IN `ColIns` INT, IN `cantidad` INT, IN `val` DOUBLE, IN `stock` INT)  NO SQL
UPDATE tbl_colores_insumos ci SET ci.Cantidad_Insumo = cantidad, ci.Valor_Promedio =  val, ci.Stock_Minimo = stock
WHERE ci.Id_Existencias_InsCol = ColIns$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ModificarClientes` (IN `_nombre` VARCHAR(45), IN `_apellido` VARCHAR(45), IN `_telefono` VARCHAR(15), IN `_direccion` VARCHAR(30), IN `_email` VARCHAR(45), IN `_documento` VARCHAR(20))  NO SQL
UPDATE tbl_persona SET Nombre= _nombre, Apellido= _apellido, Telefono= _telefono, Direccion= _direccion, Email= _email WHERE Num_Documento= _documento$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_modificarColor` (IN `_id` INT(10), IN `_nom` VARCHAR(45), IN `_cod` VARCHAR(7))  NO SQL
UPDATE tbl_colores SET Nombre = _nom, Codigo_Color = _cod WHERE   Id_Color = _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ModificarEstadoCoti` (IN `idSol` INT(11), IN `est` INT(11))  NO SQL
UPDATE tbl_solicitudes SET  Id_Estado = est WHERE Id_PedidosCotizaciones = idSol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ModificarInsumo` (IN `_ins` INT(11), IN `_med` INT(11), IN `_nom` VARCHAR(45))  NO SQL
UPDATE tbl_insumos SET Id_Medida = _med, Nombre = _nom WHERE Id_Insumo = _ins$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_modificarMedida` (IN `_id` INT(11), IN `_abr` VARCHAR(45), IN `_nom` VARCHAR(45))  NO SQL
UPDATE tbl_unidades_medida SET Abreviatura = _abr, Nombre = _nom WHERE  Id_Medida = _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ModificarNombreR` (IN `_nombre` VARCHAR(45), IN `_id` INT)  NO SQL
UPDATE tbl_roles SET Nombre= _nombre WHERE Id_Rol= _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ModificarP` (IN `_nombre` VARCHAR(45), IN `_apellido` VARCHAR(45), IN `_email` VARCHAR(45), IN `_documento` VARCHAR(20))  NO SQL
UPDATE tbl_persona SET Nombre= _nombre, Apellido= _apellido, Email= _email WHERE Num_Documento= _documento$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ModificarRoles` (IN `_rol` INT(11))  NO SQL
DELETE FROM tbl_rol_permisos WHERE Id_Rol = _rol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ModificarUsuario` (IN `_usuario` VARCHAR(15), IN `_id_rol` INT, IN `_documento` VARCHAR(20))  NO SQL
UPDATE tbl_usuarios SET Usuario = _usuario, Tbl_Roles_Id_Rol = _id_rol WHERE Num_Documento = _documento$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_obtenerIdInsumo` ()  NO SQL
SELECT max(Id_Insumo) Id FROM tbl_insumos$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ObtIdEntrada` ()  NO SQL
SELECT max(Id_Entrada) idEnt FROM tbl_entradas$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_regColorInsumo` (IN `_col` INT(10), IN `_ins` INT(11), IN `_cant` INT(11), IN `_val_pro` DOUBLE, IN `_stock` INT(11))  NO SQL
INSERT INTO tbl_colores_insumos VALUES(null, _col, _ins, _cant, _val_pro, _stock)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegEntExis` (IN `ent` INT(11), IN `exis` INT(11), IN `cant` INT(11), IN `valU` DOUBLE, IN `valT` DOUBLE)  NO SQL
INSERT INTO tbl_entradas_exitencias VALUES(Null, ent, exis, cant, valU, valT)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegEntrada` (IN `fecha` DATE, IN `valEnt` DOUBLE)  NO SQL
INSERT INTO tbl_entradas VALUES (NULL, fecha, valEnt)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_regInsumo` (IN `Id_med` INT(11), IN `_est` INT(1), IN `_nom` VARCHAR(45))  NO SQL
INSERT INTO tbl_insumos VALUES(null, Id_med, _est, _nom)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_registrarColores` (IN `_nom` VARCHAR(45), IN `_cod` VARCHAR(7))  NO SQL
INSERT INTO tbl_colores VALUES(null, _nom, _cod)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_registrarFichasAsoPed` (IN `_id_solicitudes_tipo` INT, IN `_cant_existencias` INT, IN `_estado` INT, IN `_cant_producir` INT, IN `_subtotal` DOUBLE, IN `_id_ficha` INT)  NO SQL
INSERT INTO tbl_solicitudes_producto VALUES (NULL, _id_solicitudes_tipo, _cant_existencias, _estado, _cant_producir, _subtotal, _id_ficha)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_registrarMedidas` (IN `_abr` VARCHAR(45), IN `_nom` VARCHAR(45))  NO SQL
INSERT INTO tbl_unidades_medida VALUES(null, _abr, _nom)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegistrarObjetivos` (IN `Nombre` VARCHAR(45), IN `FechaR` DATE, IN `FechaI` DATE, IN `FechaF` DATE, IN `Estado` INT(11))  NO SQL
INSERT into tbl_objetivos (Nombre, FechaRegistro, FechaInicio, FechaFin, Id_Estado) VALUES (Nombre, FechaR, FechaI, FechaF, Estado)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_registrarPedido` (IN `_id_cliente` VARCHAR(20), IN `_id_estado` INT, IN `_fecha_registro` DATE, IN `_vlr_total` DOUBLE)  NO SQL
INSERT INTO tbl_solicitudes VALUES (NULL, _id_cliente, _id_estado, _fecha_registro, _vlr_total)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegistrarS` (IN `_descripcion` VARCHAR(200), IN `_fecha` DATE)  NO SQL
INSERT into tbl_salidas_productos (Descripcion, Fecha_Salida) VALUES (_descripcion, _fecha)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegistrarSPro` (IN `_salida` INT, IN `_ficha` INT, IN `_cantidad` INT)  NO SQL
INSERT INTO tbl_salida_ficha (Id_Salida, Id_Ficha_Tecnica, Cantidad) VALUES (_salida, _ficha, _cantidad)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_registrarTipoSolicitud` (IN `_id_pedido` INT, IN `_id_tipoSolicitud` INT, IN `_fecha_entrega` DATE)  NO SQL
INSERT INTO tbl_solicitudes_tipo VALUES (NULL, _id_pedido, _id_tipoSolicitud, _fecha_entrega, NULL)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_regOrdenProduccion` (IN `_estado` VARCHAR(45), IN `_fechaReg` DATE, IN `lugar` VARCHAR(30))  NO SQL
INSERT INTO tbl_ordenesproduccion VALUES (NULL, _estado, _fechaReg, lugar)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegPermisos` (IN `_Id_Rol` INT, IN `_Id_Permiso` INT)  NO SQL
INSERT INTO tbl_rol_permisos (Id_Rol, Id_Permiso) VALUES (_Id_Rol, _Id_Permiso)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegPersona` (IN `_id_tipo` INT, IN `_tipo_documento` VARCHAR(45), IN `_nombre` VARCHAR(45), IN `_apellido` VARCHAR(45), IN `_estado` INT, IN `_telefono` VARCHAR(15), IN `_direccion` VARCHAR(30), IN `_email` VARCHAR(45), IN `_documento` VARCHAR(20))  NO SQL
INSERT INTO tbl_persona (Num_Documento, Id_Tipo, Tipo_Documento, Nombre,Apellido, Estado, Telefono, Direccion, Email) VALUES (_documento, _id_tipo, _tipo_documento, _nombre, _apellido, _estado, _telefono, _direccion, _email)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegProductosObje` (IN `Id_Objetivo` INT, IN `Cantidad` INT, IN `IdFicha_Tecnica` INT)  NO SQL
INSERT INTO tbl_productos_objetivos(Id_Objetivo, Cantidad, 	Id_Ficha_Tecnica) VALUES (Id_Objetivo, Cantidad, IdFicha_Tecnica)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegRoles` (IN `_nombre` VARCHAR(45), IN `_estado` INT)  NO SQL
INSERT INTO tbl_roles (Nombre, Estado) VALUES (_nombre, _estado)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegSalExsIns` (IN `idSal` INT(11), IN `idExs` INT(11), IN `cant` INT(11))  NO SQL
INSERT INTO tbl_existencias_salidas VALUES(NULL, idSal, idExs, cant)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegSalidaIns` (IN `fecha` DATE, IN `descr` VARCHAR(100))  NO SQL
INSERT INTO tbl_salidas VALUES (NULL, fecha, descr)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_regSolcOrdenProd` (IN `_id_solProd` INT, IN `_numOrden` INT, IN `_estadof` INT, IN `_cantF` INT, IN `_cantS` INT)  NO SQL
INSERT INTO tbl_solicitudes_ordenesproduccion VALUES (NULL, _id_solProd, _numOrden, _estadof, _cantF, _cantS)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_regSolicitud` (IN `Num` VARCHAR(20), IN `Estado` INT(11), IN `Fecha` DATE, IN `Total` INT(11))  NO SQL
INSERT INTO tbl_solicitudes VALUES (NULL, Num,Estado,Fecha,Total)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegTallasAsociadas` (IN `_referencia` INT, IN `_id_talla` INT)  NO SQL
INSERT INTO tbl_fichastecnicas_tallas VALUES (null, _referencia, _id_talla)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegUsuario` (IN `_Tbl_Roles_Id_Rol` INT, IN `_usuario` VARCHAR(15), IN `_clave` VARCHAR(45), IN `_num_documento` VARCHAR(20))  NO SQL
INSERT INTO tbl_usuarios(Num_Documento, Tbl_Roles_Id_Rol, Usuario, Clave) VALUES(_num_documento,_Tbl_Roles_Id_Rol, _usuario, _clave )$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Reg_Id` (IN `_id_tipo` INT)  NO SQL
INSERT INTO tbl_tipopersona (Id_Tipo) VALUES (_id_tipo)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_solicitarPermisos` (IN `_id_rol` INT(11))  NO SQL
SELECT p.Id_Permiso, p.Nombre, p.Url, (SELECT m.Nombre FROM tbl_modulos m WHERE p.id_modulo = m.id_Modulo) NombreM, (SELECT m.Icon FROM tbl_modulos m WHERE p.id_modulo = m.id_Modulo) Icon FROM tbl_roles r JOIN tbl_rol_permisos rp ON r.Id_Rol = rp.Id_Rol JOIN tbl_permisos p ON rp.Id_Permiso = p.Id_Permiso WHERE r.Id_Rol = _id_rol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UltimaFicha` ()  NO SQL
SELECT MAX(Id_Ficha_Tecnica) AS id_ficha FROM tbl_fichas_tecnicas$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_UltimaSalida` ()  NO SQL
SELECT MAX( Id_Salida) AS  id FROM tbl_salidas_productos$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UltimaSalidaIns` ()  NO SQL
SELECT max(Id_Salida) idSalida FROM tbl_salidas$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ultimoIdSolicitudTipo` (IN `_id_pedido` INT)  NO SQL
SELECT Id_Solicitudes_Tipo FROM tbl_solicitudes_tipo WHERE Id_Solicitud = _id_pedido$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UltimoIdTipoSolicitud` ()  NO SQL
SELECT MAX(Id_Solicitudes_Tipo) AS ult_id_soltipo FROM tbl_solicitudes_tipo$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UltimoObjetivo` ()  NO SQL
SELECT MAX(Id_Objetivo)  FROM tbl_objetivos$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UltimoPedidoRegistrado` ()  NO SQL
SELECT MAX(s.Id_Solicitud) AS id_solicitud FROM tbl_solicitudes s$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UltimoRol` ()  NO SQL
SELECT MAX(Id_Rol) AS rol FROM tbl_roles$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_userLogin` (IN `_user` VARCHAR(15))  NO SQL
SELECT p.Nombre, p.Apellido, u.Usuario, u.Clave, p.Email, u.Tbl_Roles_Id_Rol, (SELECT r.Nombre FROM tbl_roles r WHERE u.Tbl_Roles_Id_Rol = r.Id_Rol) nombreR FROM tbl_persona p JOIN tbl_usuarios u ON u.Num_Documento = p.Num_Documento WHERE u.Usuario = _user$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ValidarColor` (IN `nom` VARCHAR(45))  NO SQL
SELECT * FROM tbl_colores
WHERE Nombre = nom$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ValidarD` (IN `_documento` VARCHAR(20))  NO SQL
SELECT Num_Documento from tbl_persona where Num_Documento = _documento$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ValidarE` (IN `_email` VARCHAR(45))  NO SQL
SELECT Email from tbl_persona where Email = _email$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_validarExistenciasInsu` (IN `_idfichatec` INT)  BEGIN
DECLARE idFicha int;
SET idFicha = _idfichatec;
SELECT i.Nombre, c.Nombre AS Nombre_Color, cin.Id_Existencias_InsCol, cin.Cantidad_Insumo, inf.Cant_Necesaria FROM tbl_insumos_fichastecnicas inf JOIN tbl_colores_insumos cin ON cin.Id_Existencias_InsCol=inf.Id_Existencias_InsCol JOIN tbl_insumos i ON cin.Id_Insumo=i.Id_Insumo JOIN tbl_colores c ON cin.Id_Color=c.Id_Color WHERE inf.Id_Ficha_Tecnica = idFicha;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ValidarMedida` (IN `nom` VARCHAR(45), IN `abr` VARCHAR(45))  NO SQL
SELECT * FROM tbl_unidades_medida
WHERE Nombre = nom or Abreviatura = abr$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ValidarR` (IN `_nombre` VARCHAR(45))  NO SQL
SELECT Nombre from tbl_roles where Nombre= _nombre$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_validarReferencia` (IN `_referencia` INT)  NO SQL
SELECT Referencia FROM tbl_fichas_tecnicas WHERE Referencia = _referencia$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ValidarU` (IN `_usuario` VARCHAR(15))  NO SQL
SELECT Usuario from tbl_usuarios where Usuario = _usuario$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_colores`
--

CREATE TABLE `tbl_colores` (
  `Id_Color` int(10) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Codigo_Color` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_entradas`
--

CREATE TABLE `tbl_entradas` (
  `Id_Entrada` int(11) NOT NULL,
  `FechaReg` date NOT NULL,
  `ValorEnt` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_entradas_exitencias`
--

CREATE TABLE `tbl_entradas_exitencias` (
  `Id_Entrada_Existencia` int(11) NOT NULL,
  `Id_Entrada` int(11) NOT NULL,
  `Id_Existencias` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Valor_Unitario` double NOT NULL,
  `Valor_Total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado`
--

CREATE TABLE `tbl_estado` (
  `Id_Estado` int(11) NOT NULL,
  `Nombre_Estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_estado`
--

INSERT INTO `tbl_estado` (`Id_Estado`, `Nombre_Estado`) VALUES
(1, 'Entregada'),
(2, 'No Entregada'),
(3, 'Vencida'),
(4, 'Cancelada'),
(5, 'Pendiente'),
(6, 'En Proceso'),
(7, 'Terminado'),
(8, 'Cancelado'),
(9, 'Calidad'),
(10, 'Produccion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_existencias_salidas`
--

CREATE TABLE `tbl_existencias_salidas` (
  `Codigo` int(11) NOT NULL,
  `Id_Salida` int(11) NOT NULL,
  `Id_Existencia` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_fichastecnicas_tallas`
--

CREATE TABLE `tbl_fichastecnicas_tallas` (
  `Id_Fichas_Tallas` int(11) NOT NULL,
  `Id_Talla` int(11) NOT NULL,
  `Id_Ficha_Tecnica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_fichas_tecnicas`
--

CREATE TABLE `tbl_fichas_tecnicas` (
  `Id_Ficha_Tecnica` int(11) NOT NULL,
  `Referencia` int(11) NOT NULL,
  `Id_Color` int(10) NOT NULL,
  `Fecha_Registro` date NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Valor_Produccion` double NOT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Stock_Minimo` int(11) NOT NULL,
  `Valor_Producto` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_insumos`
--

CREATE TABLE `tbl_insumos` (
  `Id_Insumo` int(11) NOT NULL,
  `Id_Medida` int(11) NOT NULL,
  `Estado` int(1) NOT NULL,
  `Nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_insumos_fichastecnicas`
--

CREATE TABLE `tbl_insumos_fichastecnicas` (
  `id_Insumos_Fichas` int(11) NOT NULL,
  `Id_Existencias_InsCol` int(11) NOT NULL,
  `Cant_Necesaria` decimal(10,2) NOT NULL,
  `Valor_Insumo` double NOT NULL,
  `Id_Ficha_Tecnica` int(11) NOT NULL
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
(9, 'Configuración', 'fa fa-cogs'),
(10, 'Objetivos', 'fa fa-signal');

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
  `Id_Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ordenesproduccion`
--

CREATE TABLE `tbl_ordenesproduccion` (
  `Num_Orden` int(11) NOT NULL,
  `Id_Estado` int(11) NOT NULL,
  `Fecha_Registro` date NOT NULL,
  `LugarProduccion` varchar(30) NOT NULL
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
(6, 3, 'Registrar Ficha', 'ctrFicha/regFicha'),
(7, 3, 'Listar Fichas', 'ctrFicha/consFicha'),
(8, 4, 'Registrar Cliente', 'ctrCliente/regCliente'),
(9, 4, 'Listar Clientes', 'ctrCliente/consCliente'),
(10, 5, 'Registrar Cotización', 'ctrCotizacion/regCotizacion'),
(11, 5, 'Listar Cotizaciones', 'ctrCotizacion/consCotizacion'),
(12, 6, 'Registrar Pedido', 'ctrPedido/regPedido'),
(13, 6, 'Listar Pedidos', 'ctrPedido/consPedido'),
(14, 7, 'Registrar Orden', 'ctrProduccion/regOrden'),
(15, 7, 'Listar Órdenes', 'ctrProduccion/consOrden'),
(16, 8, 'Existencias Producto T', 'ctrProductoT/existenciasProductoT'),
(17, 9, 'Medidas', 'ctrConfiguracion/listarMedidas'),
(18, 9, 'Colores', 'ctrConfiguracion/listarColores'),
(19, 9, 'Roles', 'ctrConfiguracion/RegistrarRoles'),
(20, 10, 'Registrar Objetivos', 'ctrObjetivos/registrarObjetivo'),
(21, 10, 'Listar Objetivos', 'ctrObjetivos/listarObjetivos');

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
('1017223026', 1, 'C.C', 'Manuela', 'Urrego', 1, '', '', 'amurrego6@gmail.com'),
('1234567890', 2, 'CC', 'Andres', 'Arteaga', 1, '3116440736', 'cll falsa 123', 'jaac219@gmail.com'),
('3987654321', 2, 'CC', 'johan', 'arteaga', 1, '32452354235', 'call71c #30-215', 'jaac219@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos_objetivos`
--

CREATE TABLE `tbl_productos_objetivos` (
  `Codigo` int(11) NOT NULL,
  `Id_Objetivo` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Id_Ficha_Tecnica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `Id_Rol` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_roles`
--

INSERT INTO `tbl_roles` (`Id_Rol`, `Nombre`, `Estado`) VALUES
(1, 'Administrador', 0);

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
(19, 1, 19),
(23, 1, 20),
(24, 1, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_salidas`
--

CREATE TABLE `tbl_salidas` (
  `Id_Salida` int(11) NOT NULL,
  `FechaSal` date NOT NULL,
  `Descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_salidas_productos`
--

CREATE TABLE `tbl_salidas_productos` (
  `Id_Salida` int(11) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Fecha_Salida` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_salida_ficha`
--

CREATE TABLE `tbl_salida_ficha` (
  `Codigo` int(11) NOT NULL,
  `Id_Salida` int(11) NOT NULL,
  `Id_Ficha_Tecnica` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitudes`
--

CREATE TABLE `tbl_solicitudes` (
  `Id_Solicitud` int(11) NOT NULL,
  `Num_Documento` varchar(20) NOT NULL,
  `Id_Estado` int(11) NOT NULL,
  `Fecha_Registro` date NOT NULL,
  `Valor_Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitudes_ordenesproduccion`
--

CREATE TABLE `tbl_solicitudes_ordenesproduccion` (
  `Codigo` int(11) NOT NULL,
  `Id_Solicitud_Producto` int(11) NOT NULL,
  `Num_Orden` int(11) NOT NULL,
  `Id_Estado` int(11) NOT NULL,
  `Cantidad_Fabrica` int(11) NOT NULL,
  `Cantidad_Satelite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitudes_producto`
--

CREATE TABLE `tbl_solicitudes_producto` (
  `Id_Solicitudes_Producto` int(11) NOT NULL,
  `Id_Solicitudes_Tipo` int(11) NOT NULL,
  `Cantidad_Existencias` int(11) NOT NULL,
  `Estado` varchar(30) NOT NULL,
  `Cantidad_Producir` int(11) NOT NULL,
  `Subtotal` int(11) NOT NULL,
  `Id_Ficha_Tecnica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitudes_tipo`
--

CREATE TABLE `tbl_solicitudes_tipo` (
  `Id_Solicitudes_Tipo` int(11) NOT NULL,
  `Id_Solicitud` int(11) NOT NULL,
  `Id_Tipo` int(11) NOT NULL,
  `Fecha_Entrega` date DEFAULT NULL,
  `Fecha_Vencimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tallas`
--

CREATE TABLE `tbl_tallas` (
  `Id_Talla` int(11) NOT NULL,
  `Nombre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_tallas`
--

INSERT INTO `tbl_tallas` (`Id_Talla`, `Nombre`) VALUES
(1, 'L'),
(2, 'M'),
(3, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo`
--

CREATE TABLE `tbl_tipo` (
  `Id_Tipo` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_tipo`
--

INSERT INTO `tbl_tipo` (`Id_Tipo`, `Nombre`) VALUES
(1, 'Cotizacion'),
(2, 'Pedido');

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

--
-- Volcado de datos para la tabla `tbl_unidades_medida`
--

INSERT INTO `tbl_unidades_medida` (`Id_Medida`, `Abreviatura`, `Nombre`) VALUES
(1, 'Cm', 'Centimetros'),
(2, 'Mt', 'Metros'),
(3, 'ud', 'Unidades');

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
(1, '1017223026', 1, 'Manu', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

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
  ADD PRIMARY KEY (`Id_Existencias_InsCol`),
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
  ADD PRIMARY KEY (`Id_Entrada_Existencia`),
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
  ADD KEY `fk_Tbl_Existencias_Salidas_Tbl_Colores_Insumos1_idx` (`Id_Existencia`);

--
-- Indices de la tabla `tbl_fichastecnicas_tallas`
--
ALTER TABLE `tbl_fichastecnicas_tallas`
  ADD PRIMARY KEY (`Id_Fichas_Tallas`),
  ADD KEY `Id_Talla` (`Id_Talla`),
  ADD KEY `fk_tbl_fichastecnicas_tallas_tbl_fichas_tecnicas1_idx` (`Id_Ficha_Tecnica`);

--
-- Indices de la tabla `tbl_fichas_tecnicas`
--
ALTER TABLE `tbl_fichas_tecnicas`
  ADD PRIMARY KEY (`Id_Ficha_Tecnica`),
  ADD KEY `Id_Color` (`Id_Color`);

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
  ADD KEY `fk_Tbl_Insumos_has_Tbl_Fichas_Tecnicas_Tbl_Insumos1_idx` (`Id_Existencias_InsCol`),
  ADD KEY `fk_tbl_insumos_fichastecnicas_tbl_fichas_tecnicas1_idx` (`Id_Ficha_Tecnica`);

--
-- Indices de la tabla `tbl_modulos`
--
ALTER TABLE `tbl_modulos`
  ADD PRIMARY KEY (`id_Modulo`);

--
-- Indices de la tabla `tbl_objetivos`
--
ALTER TABLE `tbl_objetivos`
  ADD PRIMARY KEY (`Id_Objetivo`),
  ADD KEY `estado` (`Id_Estado`);

--
-- Indices de la tabla `tbl_ordenesproduccion`
--
ALTER TABLE `tbl_ordenesproduccion`
  ADD PRIMARY KEY (`Num_Orden`),
  ADD KEY `Id_Estado` (`Id_Estado`);

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
-- Indices de la tabla `tbl_productos_objetivos`
--
ALTER TABLE `tbl_productos_objetivos`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_Tbl_Productos_Objetivos_Tbl_Objetivos1_idx` (`Id_Objetivo`),
  ADD KEY `fk_tbl_productos_objetivos_tbl_fichas_tecnicas1_idx` (`Id_Ficha_Tecnica`);

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
-- Indices de la tabla `tbl_salida_ficha`
--
ALTER TABLE `tbl_salida_ficha`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_salida_has_TblProducto_salida1_idx` (`Id_Salida`),
  ADD KEY `fk_tbl_salida_producto_tbl_fichas_tecnicas1_idx` (`Id_Ficha_Tecnica`);

--
-- Indices de la tabla `tbl_solicitudes`
--
ALTER TABLE `tbl_solicitudes`
  ADD PRIMARY KEY (`Id_Solicitud`),
  ADD KEY `fk_Tbl_Pedidos_Cotizaciones_Tbl_Estado1_idx` (`Id_Estado`),
  ADD KEY `fk_Tbl_PedidosCotizaciones_Tbl_Persona1_idx` (`Num_Documento`);

--
-- Indices de la tabla `tbl_solicitudes_ordenesproduccion`
--
ALTER TABLE `tbl_solicitudes_ordenesproduccion`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_has_TblProducto_ha_idx` (`Num_Orden`),
  ADD KEY `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_has_TblProducto_ha_idx1` (`Id_Solicitud_Producto`),
  ADD KEY `Id_Estado` (`Id_Estado`);

--
-- Indices de la tabla `tbl_solicitudes_producto`
--
ALTER TABLE `tbl_solicitudes_producto`
  ADD PRIMARY KEY (`Id_Solicitudes_Producto`),
  ADD KEY `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_has_TblProducto_Tb_idx1` (`Id_Solicitudes_Tipo`),
  ADD KEY `fk_tbl_solicitudes_producto_tbl_fichas_tecnicas1_idx` (`Id_Ficha_Tecnica`);

--
-- Indices de la tabla `tbl_solicitudes_tipo`
--
ALTER TABLE `tbl_solicitudes_tipo`
  ADD PRIMARY KEY (`Id_Solicitudes_Tipo`),
  ADD KEY `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_Tbl_Tipo1_idx` (`Id_Tipo`),
  ADD KEY `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_Tbl_Pedidos_Cotiza_idx` (`Id_Solicitud`);

--
-- Indices de la tabla `tbl_tallas`
--
ALTER TABLE `tbl_tallas`
  ADD PRIMARY KEY (`Id_Talla`);

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
  MODIFY `Id_Existencias_InsCol` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_entradas`
--
ALTER TABLE `tbl_entradas`
  MODIFY `Id_Entrada` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_entradas_exitencias`
--
ALTER TABLE `tbl_entradas_exitencias`
  MODIFY `Id_Entrada_Existencia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_estado`
--
ALTER TABLE `tbl_estado`
  MODIFY `Id_Estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `tbl_existencias_salidas`
--
ALTER TABLE `tbl_existencias_salidas`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_fichastecnicas_tallas`
--
ALTER TABLE `tbl_fichastecnicas_tallas`
  MODIFY `Id_Fichas_Tallas` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_fichas_tecnicas`
--
ALTER TABLE `tbl_fichas_tecnicas`
  MODIFY `Id_Ficha_Tecnica` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_insumos`
--
ALTER TABLE `tbl_insumos`
  MODIFY `Id_Insumo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_insumos_fichastecnicas`
--
ALTER TABLE `tbl_insumos_fichastecnicas`
  MODIFY `id_Insumos_Fichas` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_modulos`
--
ALTER TABLE `tbl_modulos`
  MODIFY `id_Modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
  MODIFY `Id_Permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `tbl_productos_objetivos`
--
ALTER TABLE `tbl_productos_objetivos`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `Id_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbl_rol_permisos`
--
ALTER TABLE `tbl_rol_permisos`
  MODIFY `Id_Rol_Permisos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `tbl_salidas`
--
ALTER TABLE `tbl_salidas`
  MODIFY `Id_Salida` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_salidas_productos`
--
ALTER TABLE `tbl_salidas_productos`
  MODIFY `Id_Salida` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_salida_ficha`
--
ALTER TABLE `tbl_salida_ficha`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_solicitudes`
--
ALTER TABLE `tbl_solicitudes`
  MODIFY `Id_Solicitud` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_solicitudes_ordenesproduccion`
--
ALTER TABLE `tbl_solicitudes_ordenesproduccion`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_solicitudes_producto`
--
ALTER TABLE `tbl_solicitudes_producto`
  MODIFY `Id_Solicitudes_Producto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_solicitudes_tipo`
--
ALTER TABLE `tbl_solicitudes_tipo`
  MODIFY `Id_Solicitudes_Tipo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_tallas`
--
ALTER TABLE `tbl_tallas`
  MODIFY `Id_Talla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbl_tipopersona`
--
ALTER TABLE `tbl_tipopersona`
  MODIFY `Id_Tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbl_unidades_medida`
--
ALTER TABLE `tbl_unidades_medida`
  MODIFY `Id_Medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  ADD CONSTRAINT `tbl_colores_insumos_ibfk_1` FOREIGN KEY (`Id_Insumo`) REFERENCES `tbl_insumos` (`Id_Insumo`);

--
-- Filtros para la tabla `tbl_entradas_exitencias`
--
ALTER TABLE `tbl_entradas_exitencias`
  ADD CONSTRAINT `tbl_entradas_exitencias_ibfk_1` FOREIGN KEY (`Id_Entrada`) REFERENCES `tbl_entradas` (`Id_Entrada`),
  ADD CONSTRAINT `tbl_entradas_exitencias_ibfk_2` FOREIGN KEY (`Id_Existencias`) REFERENCES `tbl_colores_insumos` (`Id_Existencias_InsCol`);

--
-- Filtros para la tabla `tbl_existencias_salidas`
--
ALTER TABLE `tbl_existencias_salidas`
  ADD CONSTRAINT `tbl_existencias_salidas_ibfk_1` FOREIGN KEY (`Id_Salida`) REFERENCES `tbl_salidas` (`Id_Salida`),
  ADD CONSTRAINT `tbl_existencias_salidas_ibfk_2` FOREIGN KEY (`Id_Existencia`) REFERENCES `tbl_colores_insumos` (`Id_Existencias_InsCol`);

--
-- Filtros para la tabla `tbl_fichastecnicas_tallas`
--
ALTER TABLE `tbl_fichastecnicas_tallas`
  ADD CONSTRAINT `fk_tbl_fichastecnicas_tallas_tbl_fichas_tecnicas1` FOREIGN KEY (`Id_Ficha_Tecnica`) REFERENCES `tbl_fichas_tecnicas` (`Id_Ficha_Tecnica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tallas_fk` FOREIGN KEY (`Id_Talla`) REFERENCES `tbl_tallas` (`Id_Talla`);

--
-- Filtros para la tabla `tbl_fichas_tecnicas`
--
ALTER TABLE `tbl_fichas_tecnicas`
  ADD CONSTRAINT `fk_fichas_colores` FOREIGN KEY (`Id_Color`) REFERENCES `tbl_colores` (`Id_Color`);

--
-- Filtros para la tabla `tbl_insumos`
--
ALTER TABLE `tbl_insumos`
  ADD CONSTRAINT `tbl_insumos_ibfk_1` FOREIGN KEY (`Id_Medida`) REFERENCES `tbl_unidades_medida` (`Id_Medida`);

--
-- Filtros para la tabla `tbl_insumos_fichastecnicas`
--
ALTER TABLE `tbl_insumos_fichastecnicas`
  ADD CONSTRAINT `fk_insumosFichas_insumos` FOREIGN KEY (`Id_Existencias_InsCol`) REFERENCES `tbl_colores_insumos` (`Id_Existencias_InsCol`),
  ADD CONSTRAINT `fk_tbl_insumos_fichastecnicas_tbl_fichas_tecnicas1` FOREIGN KEY (`Id_Ficha_Tecnica`) REFERENCES `tbl_fichas_tecnicas` (`Id_Ficha_Tecnica`);

--
-- Filtros para la tabla `tbl_objetivos`
--
ALTER TABLE `tbl_objetivos`
  ADD CONSTRAINT `tbl_objetivos_estado` FOREIGN KEY (`Id_Estado`) REFERENCES `tbl_estado` (`Id_Estado`);

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
-- Filtros para la tabla `tbl_productos_objetivos`
--
ALTER TABLE `tbl_productos_objetivos`
  ADD CONSTRAINT `fk_Tbl_Productos_Objetivos_Tbl_Objetivos1` FOREIGN KEY (`Id_Objetivo`) REFERENCES `tbl_objetivos` (`Id_Objetivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_productos_objetivos_tbl_fichas_tecnicas1` FOREIGN KEY (`Id_Ficha_Tecnica`) REFERENCES `tbl_fichas_tecnicas` (`Id_Ficha_Tecnica`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_rol_permisos`
--
ALTER TABLE `tbl_rol_permisos`
  ADD CONSTRAINT `fk_Tbl_Rol_has_Tbl_Permisos_Tbl_Permisos1` FOREIGN KEY (`Id_Permiso`) REFERENCES `tbl_permisos` (`Id_Permiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tbl_Rol_has_Tbl_Permisos_Tbl_Rol1` FOREIGN KEY (`Id_Rol`) REFERENCES `tbl_roles` (`Id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_salida_ficha`
--
ALTER TABLE `tbl_salida_ficha`
  ADD CONSTRAINT `fk_salida_has_TblProducto_salida1` FOREIGN KEY (`Id_Salida`) REFERENCES `tbl_salidas_productos` (`Id_Salida`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_salida_producto_tbl_fichas_tecnicas1` FOREIGN KEY (`Id_Ficha_Tecnica`) REFERENCES `tbl_fichas_tecnicas` (`Id_Ficha_Tecnica`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_solicitudes`
--
ALTER TABLE `tbl_solicitudes`
  ADD CONSTRAINT `fk_Tbl_PedidosCotizaciones_Tbl_Persona1` FOREIGN KEY (`Num_Documento`) REFERENCES `tbl_persona` (`Num_Documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_solicitudes_ibfk_1` FOREIGN KEY (`Id_Estado`) REFERENCES `tbl_estado` (`Id_Estado`);

--
-- Filtros para la tabla `tbl_solicitudes_ordenesproduccion`
--
ALTER TABLE `tbl_solicitudes_ordenesproduccion`
  ADD CONSTRAINT `fk_estado_fichasOrden` FOREIGN KEY (`Id_Estado`) REFERENCES `tbl_estado` (`Id_Estado`),
  ADD CONSTRAINT `fk_orden_solicitud` FOREIGN KEY (`Num_Orden`) REFERENCES `tbl_ordenesproduccion` (`Num_Orden`),
  ADD CONSTRAINT `fk_solicitud_producto` FOREIGN KEY (`Id_Solicitud_Producto`) REFERENCES `tbl_solicitudes_producto` (`Id_Solicitudes_Producto`);

--
-- Filtros para la tabla `tbl_solicitudes_producto`
--
ALTER TABLE `tbl_solicitudes_producto`
  ADD CONSTRAINT `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_has_TblProducto_Tbl_1` FOREIGN KEY (`Id_Solicitudes_Tipo`) REFERENCES `tbl_solicitudes_tipo` (`Id_Solicitudes_Tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_solicitudes_producto_tbl_fichas_tecnicas1` FOREIGN KEY (`Id_Ficha_Tecnica`) REFERENCES `tbl_fichas_tecnicas` (`Id_Ficha_Tecnica`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_solicitudes_tipo`
--
ALTER TABLE `tbl_solicitudes_tipo`
  ADD CONSTRAINT `fk_Tbl_Pedidos_Cotizaciones_has_Tbl_Tipo_Tbl_Pedidos_Cotizaci1` FOREIGN KEY (`Id_Solicitud`) REFERENCES `tbl_solicitudes` (`Id_Solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
