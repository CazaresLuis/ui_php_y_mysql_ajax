-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-01-2013 a las 02:13:05
-- Versión del servidor: 5.5.25
-- Versión de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tutosWeb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_users`
--

CREATE TABLE `tbl_users` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `usr_nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `usr_apellidos` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usr_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `usr_pass` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `usr_activo` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 Inhabilitado, 1 Habilitado',
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbl_users`
--

INSERT INTO `tbl_users` (`idUsuario`, `usr_nombre`, `usr_apellidos`, `usr_email`, `usr_pass`, `usr_activo`) VALUES
(1, 'Luis Fernando', 'Cázares Bulbarela', 'luis.f.cazares@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
