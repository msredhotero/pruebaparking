-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-10-2018 a las 01:27:14
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ssaif_desarrollo_2018`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbdelegados`
--

CREATE TABLE IF NOT EXISTS `dbdelegados` (
`iddelegado` int(11) NOT NULL,
  `refusuarios` int(11) NOT NULL,
  `apellidos` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `localidad` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cp` varchar(8) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(22) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular` varchar(22) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fax` varchar(22) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email1` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email2` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email3` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email4` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dbdelegados`
--
ALTER TABLE `dbdelegados`
 ADD PRIMARY KEY (`iddelegado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dbdelegados`
--
ALTER TABLE `dbdelegados`
MODIFY `iddelegado` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
