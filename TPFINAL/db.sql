-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2017 a las 15:02:17
-- Versión del servidor: 5.7.9
-- Versión de PHP: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `idCategorias` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL COMMENT 'Nombre',
  PRIMARY KEY (`idCategorias`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategorias`, `Nombre`) VALUES
(7, 'ZAPATILLAS'),
(8, 'MEDIAS'),
(4, 'CAMPERAS'),
(9, 'POLLERAS'),
(13, 'BOTAS'),
(14, 'TRAJES DE BAÃ‘O'),
(15, 'TOALLONES'),
(16, 'SWEATERS'),
(17, 'ZAPATOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `idProductos` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idCategorias` int(11) NOT NULL COMMENT 'Categoría',
  `Codigo` varchar(11) NOT NULL COMMENT 'Código',
  `Nombre` text NOT NULL COMMENT 'Nombre',
  `Precio` float NOT NULL COMMENT 'Precio',
  `Destacado` tinyint(4) NOT NULL COMMENT 'Destacado',
  `Descripcion` text NOT NULL COMMENT 'Descripción',
  `Imagen` text NOT NULL COMMENT 'Imagen',
  PRIMARY KEY (`idProductos`),
  KEY `idCategorias` (`idCategorias`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProductos`, `idCategorias`, `Codigo`, `Nombre`, `Precio`, `Destacado`, `Descripcion`, `Imagen`) VALUES
(4, 4, 'AA1234', 'Campera HYM', 345, 2, 'Colores: Bordo, Amarillo', ''),
(5, 14, 'AF1D2', 'Bikini 34DW', 965, 1, '2 piezas', ''),
(7, 7, 'AB2Q14', 'Adidas Superstar', 2399, 2, 'Color: Blanco y negro', ''),
(9, 15, '5FW2', 'Ultra Slime', 265, 1, '100% algodÃ³n', ''),
(10, 13, 'AA123', 'Timberland', 120, 1, 'sdfngmh', ''),
(11, 17, 'w35', 'sgdv', 725, 1, 'gjnmtg', ''),
(12, 4, 'ry54', 'dgbvdeb', 24235, 1, 'ehrs', ''),
(13, 14, '646', 'dbhb', 43242, 2, 'gnjmt', ''),
(14, 14, '57657y', 'fdhbfr', 4324, 1, 'fjtg', ''),
(15, 14, '6874gf', 'fnfjh', 424, 1, 'hfnhj', ''),
(16, 15, '57egbf', 'ruhjtrj', 6, 1, 'jgm', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(50) NOT NULL,
  `Contrasena` varchar(50) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`idUsuarios`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `Usuario`, `Contrasena`, `Nombre`) VALUES
(1, 'ilanitjamilis', 'hola', 'Ilanit Jamilis'),
(2, 'shirlypesoa', 'shirly', 'Shirly Pesoa'),
(4, 'martinesses', 'felicesvacaciones', 'Martin Esses');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
