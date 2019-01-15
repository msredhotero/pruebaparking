-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-09-2018 a las 05:25:26
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `lavadero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbclientes`
--

CREATE TABLE IF NOT EXISTS `dbclientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `apellido` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `nrodocumento` bigint(20) NOT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `direccion` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `dbclientes`
--

INSERT INTO `dbclientes` (`idcliente`, `apellido`, `nombre`, `nrodocumento`, `fechanacimiento`, `direccion`, `telefono`, `email`) VALUES
(1, 'Test1 ', 'Test1', 31552466, '1985-05-20', '76', '4830000', 'tst1@123.com'),
(2, 'Moglie', 'Gustavo', 31454089, '2013-02-14', 'Test 1 ', '132132 46546', '123@test.com'),
(3, 'Delio', 'Diego', 311111111, '0000-00-00', '123 ne', '12312', '123@test.com'),
(4, 'Juan', ' 11', 3123, '0000-00-00', '', '', ''),
(5, 'safar', 'marcos', 31552466, '1985-05-20', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbclientevehiculos`
--

CREATE TABLE IF NOT EXISTS `dbclientevehiculos` (
  `idclientevehiculo` int(11) NOT NULL AUTO_INCREMENT,
  `refclientes` int(11) NOT NULL,
  `refvehiculos` int(11) NOT NULL,
  `activo` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idclientevehiculo`),
  KEY `fk_dbclientevehiculos_dbvehiculos1_idx` (`refvehiculos`),
  KEY `fk_dbclientevehiculos_dbclientes1_idx` (`refclientes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `dbclientevehiculos`
--

INSERT INTO `dbclientevehiculos` (`idclientevehiculo`, `refclientes`, `refvehiculos`, `activo`) VALUES
(1, 1, 1, b'1'),
(2, 2, 2, b'1'),
(3, 3, 3, b'1'),
(4, 4, 4, b'1'),
(5, 5, 5, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbempleados`
--

CREATE TABLE IF NOT EXISTS `dbempleados` (
  `idempleado` int(11) NOT NULL AUTO_INCREMENT,
  `apellido` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nrodocumento` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `cuil` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefonofijo` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idempleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbordenes`
--

CREATE TABLE IF NOT EXISTS `dbordenes` (
  `idorden` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `refclientevehiculos` int(11) NOT NULL,
  `fechacrea` datetime DEFAULT NULL,
  `fechamodi` datetime DEFAULT NULL,
  `usuacrea` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuamodi` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `detallereparacion` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `refestados` int(11) NOT NULL,
  `precio` decimal(18,2) DEFAULT NULL,
  `anticipo` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`idorden`),
  KEY `fk_dbordenes_tbestados1_idx` (`refestados`),
  KEY `fk_dbordenes_dbclientevehiculos1_idx` (`refclientevehiculos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `dbordenes`
--

INSERT INTO `dbordenes` (`idorden`, `numero`, `refclientevehiculos`, `fechacrea`, `fechamodi`, `usuacrea`, `usuamodi`, `detallereparacion`, `refestados`, `precio`, `anticipo`) VALUES
(2, 'ORD000001', 2, '2016-09-01 00:00:00', '2016-09-01 00:00:00', 'Administrador', 'Administrador', 'Cambio de filtro de aire', 1, '1000.00', '150.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbordenesresponsables`
--

CREATE TABLE IF NOT EXISTS `dbordenesresponsables` (
  `idordenresponsables` int(11) NOT NULL AUTO_INCREMENT,
  `refordenes` int(11) NOT NULL,
  `refempleados` int(11) NOT NULL,
  PRIMARY KEY (`idordenresponsables`),
  KEY `fk_dbordenesresponsables_dbordenes1_idx` (`refordenes`),
  KEY `fk_dbordenesresponsables_dbempleados_idx` (`refempleados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbotrosingresosegresos`
--

CREATE TABLE IF NOT EXISTS `dbotrosingresosegresos` (
  `idotrosingresosegresos` int(11) NOT NULL AUTO_INCREMENT,
  `reftipomovimientos` int(11) NOT NULL,
  `monto` decimal(18,2) NOT NULL,
  `fechacrea` datetime NOT NULL,
  `usuacrea` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idotrosingresosegresos`),
  KEY `fk_ie_movimientos_idx` (`reftipomovimientos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbpagos`
--

CREATE TABLE IF NOT EXISTS `dbpagos` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `refordenes` int(11) NOT NULL,
  `pago` decimal(18,2) NOT NULL,
  `fechapago` datetime NOT NULL,
  PRIMARY KEY (`idpago`),
  KEY `fk_dbpagos_dbordenes_idx` (`refordenes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `dbpagos`
--

INSERT INTO `dbpagos` (`idpago`, `refordenes`, `pago`, `fechapago`) VALUES
(1, 2, '400.00', '2016-09-01 17:10:00'),
(2, 2, '200.00', '2016-09-01 23:00:00'),
(3, 2, '400.00', '2016-09-01 22:40:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbproveedores`
--

CREATE TABLE IF NOT EXISTS `dbproveedores` (
  `idproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `razonsocial` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cuit` varchar(11) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `observaciones` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idproveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbproveedores`
--

INSERT INTO `dbproveedores` (`idproveedor`, `razonsocial`, `nombre`, `apellido`, `cuit`, `direccion`, `telefono`, `celular`, `email`, `observaciones`) VALUES
(1, 'asdasd', 'asdasd', 'asdasd', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbsocios`
--

CREATE TABLE IF NOT EXISTS `dbsocios` (
  `idsocio` int(11) NOT NULL AUTO_INCREMENT,
  `apellido` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nrodocumento` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `cuit` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `domicilio` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idsocio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbturnos`
--

CREATE TABLE IF NOT EXISTS `dbturnos` (
  `idturno` int(11) NOT NULL AUTO_INCREMENT,
  `fechaingreso` datetime NOT NULL,
  `refclientes` int(11) NOT NULL,
  `refvehiculos` int(11) NOT NULL,
  `horaentrada` datetime DEFAULT NULL,
  `horasalida` datetime DEFAULT NULL,
  `usuacrea` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `refestados` int(11) NOT NULL,
  `descuento` decimal(18,2) NOT NULL DEFAULT '0.00',
  `reftipomovimientos` int(11) NOT NULL,
  PRIMARY KEY (`idturno`),
  KEY `fk_t_clientes_idx` (`refclientes`),
  KEY `fk_t_estados_idx` (`refestados`),
  KEY `fk_t_vehiculos_idx` (`refvehiculos`),
  KEY `fk_t_movimientos_idx` (`reftipomovimientos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbturnosdetalles`
--

CREATE TABLE IF NOT EXISTS `dbturnosdetalles` (
  `idturnodetalle` int(11) NOT NULL AUTO_INCREMENT,
  `refturnos` int(11) NOT NULL,
  `refservicios` int(11) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `costo` decimal(18,2) NOT NULL,
  `tiempo` int(11) NOT NULL,
  PRIMARY KEY (`idturnodetalle`),
  KEY `fk_td_turnos_idx` (`refturnos`),
  KEY `fk_td_servicios_idx` (`refservicios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbusuarios`
--

CREATE TABLE IF NOT EXISTS `dbusuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `refroles` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombrecompleto` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `fk_dbusuarios_tbroles1_idx` (`refroles`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `dbusuarios`
--

INSERT INTO `dbusuarios` (`idusuario`, `usuario`, `password`, `refroles`, `email`, `nombrecompleto`) VALUES
(2, 'admin', 'admin', 1, 'admin@msn.com', 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbvehiculos`
--

CREATE TABLE IF NOT EXISTS `dbvehiculos` (
  `idvehiculo` int(11) NOT NULL AUTO_INCREMENT,
  `patente` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `refmodelo` int(11) NOT NULL,
  `reftipovehiculo` int(11) NOT NULL,
  `anio` smallint(6) NOT NULL,
  `observaciones` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idvehiculo`),
  KEY `fk_dbvehiculos_tbmodelo1_idx` (`refmodelo`),
  KEY `fk_dbvehiculos_tbtipovehiculo1_idx` (`reftipovehiculo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `dbvehiculos`
--

INSERT INTO `dbvehiculos` (`idvehiculo`, `patente`, `refmodelo`, `reftipovehiculo`, `anio`, `observaciones`) VALUES
(1, 'AAA111', 8, 1, 2010, NULL),
(2, 'GHQ592', 6, 1, 2007, NULL),
(3, 'GGG111', 8, 1, 2011, NULL),
(4, 'GHQ0000', 2, 1, 2007, NULL),
(5, 'NAT681', 10, 1, 2013, 'asdasdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `predio_menu`
--

CREATE TABLE IF NOT EXISTS `predio_menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Orden` smallint(6) DEFAULT NULL,
  `hover` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permiso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(12, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Administrador'),
(13, '../index.php', 'icodashboard', 'Dashboard', 1, NULL, 'Administrador'),
(16, '../clientes/', 'icojugadores', 'Clientes', 2, NULL, 'Administrador'),
(17, '../vehiculos/', 'icovehiculos', 'Vehiculos', 3, NULL, 'Administrador'),
(19, '../marcas/', 'icomarca', 'Marcas', 5, NULL, 'Administrador'),
(20, '../modelos/', 'icomodelo', 'Modelos', 6, NULL, 'Administrador'),
(21, '../reportes/', 'icoreportes', 'Reportes', 29, NULL, 'Administrador'),
(22, '../usuarios/', 'icousuarios', 'Usuarios', 7, NULL, 'Administrador'),
(24, '../proveedores/', 'icojugadores', 'Proveedores', 11, NULL, 'Administrador'),
(25, '../empleados/', 'icousuarios', 'Empleados', 12, NULL, 'Administrador'),
(26, '../socios/', 'icousuarios', 'Socios', 13, NULL, 'Administrador'),
(27, '../ingresosingresos/', 'icopagos', 'Ingresos - Egresos', 8, NULL, 'Administrador'),
(28, '../servicios/', 'icopagos', 'Servicios', 15, NULL, 'Administrador'),
(29, '../movimientos/', 'icopagos', 'Tipo de Movimientos', 16, NULL, 'Administrador'),
(30, '../turnos/', 'icopagos', 'Turnos', 4, NULL, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbestados`
--

CREATE TABLE IF NOT EXISTS `tbestados` (
  `idestado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idestado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tbestados`
--

INSERT INTO `tbestados` (`idestado`, `estado`) VALUES
(1, 'Finalizado'),
(2, 'Cancelado'),
(3, 'En Curso'),
(4, 'En Cola'),
(5, 'Cargado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmarca`
--

CREATE TABLE IF NOT EXISTS `tbmarca` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `activo` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tbmarca`
--

INSERT INTO `tbmarca` (`idmarca`, `marca`, `activo`) VALUES
(2, 'Chevrolet', b'1'),
(3, 'Ford', b'1'),
(4, 'Fiat', b'1'),
(5, 'Renault', b'1'),
(6, 'VW', b'1'),
(7, 'Honda', b'1'),
(8, 'Peugeot', b'1'),
(9, 'Seat', b'1'),
(10, 'Citroen', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmodelo`
--

CREATE TABLE IF NOT EXISTS `tbmodelo` (
  `idmodelo` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `refmarca` int(11) NOT NULL,
  `activo` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idmodelo`),
  KEY `fk_tbmodelo_tbmarca_idx` (`refmarca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tbmodelo`
--

INSERT INTO `tbmodelo` (`idmodelo`, `modelo`, `refmarca`, `activo`) VALUES
(1, 'Corsa', 2, b'1'),
(2, 'Onix', 2, b'1'),
(3, 'Ka', 3, b'1'),
(4, 'Punto', 4, b'1'),
(5, 'Duster', 5, b'1'),
(6, 'Civic ', 7, b'1'),
(7, '308', 2, b'1'),
(8, 'Clio', 5, b'1'),
(9, 'ibiza', 9, b'1'),
(10, 'C3', 10, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbroles`
--

CREATE TABLE IF NOT EXISTS `tbroles` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `activo` bit(1) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbroles`
--

INSERT INTO `tbroles` (`idrol`, `descripcion`, `activo`) VALUES
(1, 'Administrador', b'1'),
(2, 'Empleado', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbservicios`
--

CREATE TABLE IF NOT EXISTS `tbservicios` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `costo` decimal(18,2) NOT NULL,
  `tiempo` int(11) NOT NULL,
  `observaciones` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idservicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipomovimientos`
--

CREATE TABLE IF NOT EXISTS `tbtipomovimientos` (
  `idtipomovimiento` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipomovimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipovehiculo`
--

CREATE TABLE IF NOT EXISTS `tbtipovehiculo` (
  `idtipovehiculo` int(11) NOT NULL AUTO_INCREMENT,
  `tipovehiculo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activo` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idtipovehiculo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tbtipovehiculo`
--

INSERT INTO `tbtipovehiculo` (`idtipovehiculo`, `tipovehiculo`, `activo`) VALUES
(1, 'Auto', b'1'),
(2, 'Moto', b'1'),
(3, 'Camion', b'1'),
(4, 'Utilitario', b'1'),
(5, 'Pick-up', b'1');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dbclientevehiculos`
--
ALTER TABLE `dbclientevehiculos`
  ADD CONSTRAINT `fk_dbclientevehiculos_dbclientes1` FOREIGN KEY (`refclientes`) REFERENCES `dbclientes` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dbclientevehiculos_dbvehiculos1` FOREIGN KEY (`refvehiculos`) REFERENCES `dbvehiculos` (`idvehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbordenes`
--
ALTER TABLE `dbordenes`
  ADD CONSTRAINT `fk_dbordenes_dbclientevehiculos1` FOREIGN KEY (`refclientevehiculos`) REFERENCES `dbclientevehiculos` (`idclientevehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dbordenes_tbestados1` FOREIGN KEY (`refestados`) REFERENCES `tbestados` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbordenesresponsables`
--
ALTER TABLE `dbordenesresponsables`
  ADD CONSTRAINT `fk_dbordenesresponsables_dbempleados` FOREIGN KEY (`refempleados`) REFERENCES `dbempleados` (`idempleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dbordenesresponsables_dbordenes1` FOREIGN KEY (`refordenes`) REFERENCES `dbordenes` (`idorden`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbotrosingresosegresos`
--
ALTER TABLE `dbotrosingresosegresos`
  ADD CONSTRAINT `fk_ie_movimientos` FOREIGN KEY (`reftipomovimientos`) REFERENCES `tbtipomovimientos` (`idtipomovimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbpagos`
--
ALTER TABLE `dbpagos`
  ADD CONSTRAINT `fk_dbpagos_dbordenes` FOREIGN KEY (`refordenes`) REFERENCES `dbordenes` (`idorden`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbturnos`
--
ALTER TABLE `dbturnos`
  ADD CONSTRAINT `fk_t_clientes` FOREIGN KEY (`refclientes`) REFERENCES `dbclientes` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_t_estados` FOREIGN KEY (`refestados`) REFERENCES `tbestados` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_t_vehiculos` FOREIGN KEY (`refvehiculos`) REFERENCES `dbvehiculos` (`idvehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_t_movimientos` FOREIGN KEY (`reftipomovimientos`) REFERENCES `tbtipomovimientos` (`idtipomovimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbturnosdetalles`
--
ALTER TABLE `dbturnosdetalles`
  ADD CONSTRAINT `fk_td_turnos` FOREIGN KEY (`refturnos`) REFERENCES `dbturnos` (`idturno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_td_servicios` FOREIGN KEY (`refservicios`) REFERENCES `tbservicios` (`idservicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbusuarios`
--
ALTER TABLE `dbusuarios`
  ADD CONSTRAINT `fk_dbusuarios_tbroles1` FOREIGN KEY (`refroles`) REFERENCES `tbroles` (`idrol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbvehiculos`
--
ALTER TABLE `dbvehiculos`
  ADD CONSTRAINT `fk_dbvehiculos_tbmodelo1` FOREIGN KEY (`refmodelo`) REFERENCES `tbmodelo` (`idmodelo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dbvehiculos_tbtipovehiculo1` FOREIGN KEY (`reftipovehiculo`) REFERENCES `tbtipovehiculo` (`idtipovehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbmodelo`
--
ALTER TABLE `tbmodelo`
  ADD CONSTRAINT `fk_tbmodelo_tbmarca` FOREIGN KEY (`refmarca`) REFERENCES `tbmarca` (`idmarca`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
