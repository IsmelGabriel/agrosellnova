/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.22-MariaDB : Database - agrosellnova
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`agrosellnova` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `agrosellnova`;

/*Table structure for table `detalle_venta` */

DROP TABLE IF EXISTS `detalle_venta`;

CREATE TABLE `detalle_venta` (
  `ID_DETALLE_VENTA` int(11) NOT NULL AUTO_INCREMENT,
  `Ventas_idVentas` int(11) NOT NULL,
  `producto_idProducto` int(11) NOT NULL,
  `CANTIDAD` decimal(10,0) NOT NULL,
  `VALOR_UNITARIO` decimal(10,0) NOT NULL,
  `TOTAL_DETALLE` decimal(10,0) NOT NULL,
  PRIMARY KEY (`ID_DETALLE_VENTA`),
  KEY `Ventas_idVentas` (`Ventas_idVentas`),
  KEY `producto_idProducto` (`producto_idProducto`),
  CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`Ventas_idVentas`) REFERENCES `ventas` (`idVentas`),
  CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`producto_idProducto`) REFERENCES `producto` (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `detalle_venta` */

/*Table structure for table `ofertas_productos` */

DROP TABLE IF EXISTS `ofertas_productos`;

CREATE TABLE `ofertas_productos` (
  `ID_OFERTA_PRODUCTO` int(11) NOT NULL AUTO_INCREMENT,
  `USUARIO_CAMPESINO` int(11) NOT NULL,
  `FECHA__INICIO_OFERTA` date NOT NULL,
  `FECHA_FIN_OFERTA` date NOT NULL,
  `Producto_idProducto` int(11) NOT NULL,
  `precio_oferta` decimal(10,0) NOT NULL,
  `descripcion_oferta` text NOT NULL,
  PRIMARY KEY (`ID_OFERTA_PRODUCTO`),
  KEY `USUARIO_CAMPESINO` (`USUARIO_CAMPESINO`),
  KEY `Producto_idProducto` (`Producto_idProducto`),
  CONSTRAINT `ofertas_productos_ibfk_1` FOREIGN KEY (`USUARIO_CAMPESINO`) REFERENCES `usuarios` (`ID_USUARIO`),
  CONSTRAINT `ofertas_productos_ibfk_2` FOREIGN KEY (`Producto_idProducto`) REFERENCES `producto` (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ofertas_productos` */

/*Table structure for table `privilegio` */

DROP TABLE IF EXISTS `privilegio`;

CREATE TABLE `privilegio` (
  `ID_privilegio` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion_privilegio` varchar(45) NOT NULL,
  PRIMARY KEY (`ID_privilegio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `privilegio` */

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `Imagen` blob NOT NULL,
  `Nombre_producto` varchar(120) NOT NULL,
  `Nombre_productor` varchar(120) NOT NULL,
  `Precio` decimal(10,0) NOT NULL,
  `Fecha_cosecha` date NOT NULL,
  `Peso_kg` decimal(10,0) NOT NULL,
  `stock` int(11) NOT NULL,
  `Descripción` varchar(100) NOT NULL,
  `Numero_referencia` varchar(120) NOT NULL,
  `Cliente_idCliente` int(11) NOT NULL,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `producto` */

/*Table structure for table `reservas` */

DROP TABLE IF EXISTS `reservas`;

CREATE TABLE `reservas` (
  `idReservas` int(11) NOT NULL AUTO_INCREMENT,
  `FECHA_RESERVA` date NOT NULL,
  `Metodo_pago` enum('TARJETA','EFECTIVO') NOT NULL,
  `USUARIO_CLIENTE` int(11) NOT NULL,
  PRIMARY KEY (`idReservas`),
  KEY `USUARIO_CLIENTE` (`USUARIO_CLIENTE`),
  CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`USUARIO_CLIENTE`) REFERENCES `usuarios` (`ID_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `reservas` */

/*Table structure for table `reservas_productos` */

DROP TABLE IF EXISTS `reservas_productos`;

CREATE TABLE `reservas_productos` (
  `ID_RESERVA_PRODUCTO` int(11) NOT NULL AUTO_INCREMENT,
  `Reservas_idReservas` int(11) NOT NULL,
  `producto_idProducto` int(11) NOT NULL,
  `CANTIDAD` decimal(10,0) NOT NULL,
  `UNIDAD_MEDIDA` enum('Libras','Kilos','Bultos') NOT NULL,
  PRIMARY KEY (`ID_RESERVA_PRODUCTO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `reservas_productos` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `idRoles` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Rol` varchar(45) NOT NULL,
  PRIMARY KEY (`idRoles`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `roles` */

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT,
  `Numero_documento` varchar(20) NOT NULL,
  `Nombre_usuarios` varchar(45) NOT NULL,
  `Documento` varchar(45) NOT NULL,
  `Ubicacion` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Metodo_pago` varchar(45) NOT NULL,
  `Fecha_nacimiento` date NOT NULL,
  `Inventario_idInventario` int(11) NOT NULL,
  `Roles_idRoles` int(11) NOT NULL,
  PRIMARY KEY (`ID_USUARIO`),
  KEY `Roles_idRoles` (`Roles_idRoles`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Roles_idRoles`) REFERENCES `roles` (`idRoles`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `usuarios` */

/*Table structure for table `usuarios_has_privilegio` */

DROP TABLE IF EXISTS `usuarios_has_privilegio`;

CREATE TABLE `usuarios_has_privilegio` (
  `ID_USUARIO_PRIVILEGIO` int(11) NOT NULL AUTO_INCREMENT,
  `Privilegio_ID_privilegio` int(11) NOT NULL,
  `USUARIO_ID_USUARIO` int(11) NOT NULL,
  PRIMARY KEY (`ID_USUARIO_PRIVILEGIO`),
  KEY `USUARIO_ID_USUARIO` (`USUARIO_ID_USUARIO`),
  KEY `Privilegio_ID_privilegio` (`Privilegio_ID_privilegio`),
  CONSTRAINT `usuarios_has_privilegio_ibfk_1` FOREIGN KEY (`USUARIO_ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`),
  CONSTRAINT `usuarios_has_privilegio_ibfk_2` FOREIGN KEY (`Privilegio_ID_privilegio`) REFERENCES `privilegio` (`ID_privilegio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `usuarios_has_privilegio` */

/*Table structure for table `ventas` */

DROP TABLE IF EXISTS `ventas`;

CREATE TABLE `ventas` (
  `idVentas` int(11) NOT NULL AUTO_INCREMENT,
  `FECHA_VENTA` date NOT NULL,
  `USUARIO_CAMPESINO` int(11) NOT NULL,
  `TOTAL_VENTA` decimal(10,0) NOT NULL,
  PRIMARY KEY (`idVentas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ventas` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
