-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2017 a las 12:06:08
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tutoriales_carrito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE IF NOT EXISTS `tbl_productos` (
  `producto_id` int(11) NOT NULL,
  `producto_codigo` varchar(20) NOT NULL,
  `producto_nombre` varchar(100) NOT NULL,
  `producto_descripcion` varchar(200) NOT NULL,
  `producto_precio` decimal(9,2) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_productos`
--

INSERT INTO `tbl_productos` (`producto_id`, `producto_codigo`, `producto_nombre`, `producto_descripcion`, `producto_precio`) VALUES
(1, 'PRO1', 'Monitor led 23 pulgadas', 'Descripcion completa y detallada de Monitor led 23 pulgadas', '450.00'),
(2, 'PRO2', 'Mouse Optico', 'Descripcion completa y detallada de Mouse Optico', '20.00'),
(3, 'PRO3', 'Impresora matricial', 'Descripcion completa y detallada de Impresora matricial', '450.00'),
(4, 'PRO4', 'Impresora termica', 'Descripcion completa y detallada de Impresora termica', '680.00'),
(5, 'PRO5', 'Impresora multifuncional', 'Descripcion completa y detallada de Impresora multifuncional', '430.00'),
(6, 'PRO6', 'Fotocopiadora multiple', 'Descripcion completa y detallada de Fotocopiadora multiple', '1120.00'),
(7, 'PRO7', 'Disco duro externo', 'Descripcion completa y detallada de Disco duro externo', '220.00'),
(8, 'PRO8', 'Microfono de computadora', 'Descripcion completa y detallada de Microfono de computadora', '15.00'),
(9, 'PRO9', 'Rollo de cable UTP 250mt cat6.', 'Descripcion completa y detallada de Rollo de cable UTP 250mt cat6.', '180.00'),
(10, 'PRO10', 'Escritorio de computadora', 'Descripcion completa y detallada de Escritorio de computadora', '320.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD PRIMARY KEY (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
