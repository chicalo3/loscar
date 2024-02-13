/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : tiendaonline

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2016-01-02 15:04:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tblcarrito`
-- ----------------------------
DROP TABLE IF EXISTS `tblcarrito`;
CREATE TABLE `tblcarrito` (
  `intContador` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `intCantidad` int(11) DEFAULT NULL,
  `strImagen` varchar(255) DEFAULT '1',
  `intTransaccionEfectuada` int(11) DEFAULT '0',
  PRIMARY KEY (`intContador`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblcarrito
-- ----------------------------
INSERT INTO `tblcarrito` VALUES ('1', '2', '1', '1', '1', '1');
INSERT INTO `tblcarrito` VALUES ('2', '2', '1', '1', '1', '2');
INSERT INTO `tblcarrito` VALUES ('3', '1', '2', '1', '1', '3');
INSERT INTO `tblcarrito` VALUES ('4', '1', '1', '1', '1', '3');
INSERT INTO `tblcarrito` VALUES ('5', '2', '2', '1', '1', '4');
INSERT INTO `tblcarrito` VALUES ('6', '2', '2', '1', '1', '5');
INSERT INTO `tblcarrito` VALUES ('7', '2', '1', '1', '1', '5');

-- ----------------------------
-- Table structure for `tblcategoria`
-- ----------------------------
DROP TABLE IF EXISTS `tblcategoria`;
CREATE TABLE `tblcategoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `strDescripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblcategoria
-- ----------------------------
INSERT INTO `tblcategoria` VALUES ('1', 'Tablet');
INSERT INTO `tblcategoria` VALUES ('2', 'Laptop');
INSERT INTO `tblcategoria` VALUES ('3', 'Accesorios');

-- ----------------------------
-- Table structure for `tblcompra`
-- ----------------------------
DROP TABLE IF EXISTS `tblcompra`;
CREATE TABLE `tblcompra` (
  `idCompra` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) DEFAULT NULL,
  `fchCompra` datetime DEFAULT NULL,
  `intTipoPago` int(11) DEFAULT NULL,
  `dblTotal` double DEFAULT NULL,
  `intEstado` int(11) DEFAULT '0',
  `strImagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idCompra`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblcompra
-- ----------------------------
INSERT INTO `tblcompra` VALUES ('1', '2', '2016-01-01 21:52:56', '1', '500', '1', null);
INSERT INTO `tblcompra` VALUES ('2', '2', '2016-01-01 22:03:36', '1', '500', '0', null);
INSERT INTO `tblcompra` VALUES ('3', '1', '2016-01-02 11:15:08', '1', '530', '0', null);
INSERT INTO `tblcompra` VALUES ('4', '2', '2016-01-02 14:23:26', '1', '30', '0', null);
INSERT INTO `tblcompra` VALUES ('5', '2', '2016-01-02 14:25:54', '1', '530', '0', null);

-- ----------------------------
-- Table structure for `tblproducto`
-- ----------------------------
DROP TABLE IF EXISTS `tblproducto`;
CREATE TABLE `tblproducto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `strDescripcion` varchar(255) DEFAULT NULL,
  `intCategoria` int(11) DEFAULT NULL,
  `strDescripcion2` varchar(255) DEFAULT NULL,
  `strSEO` varchar(255) DEFAULT NULL,
  `dbPrecio` double DEFAULT NULL,
  `intEstado` int(11) DEFAULT NULL,
  `intStock` int(11) DEFAULT NULL,
  `strImagen` varchar(255) DEFAULT NULL,
  `strNombre` varchar(255) DEFAULT NULL,
  `intOferta` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblproducto
-- ----------------------------
INSERT INTO `tblproducto` VALUES ('1', 'La mejor que te puedes llevar', '1', 'Te presentamos el primer smartphone de Samsung con cuerpo completamente metÃ¡lico: Samsung Galaxy A3, un telÃ©fono con diseÃ±o innovador disponible en 4 colores, y una impresionante pantalla qHD sAMOLED de 4,5â€, al que no podrÃ¡s resistirte en cuanto lo', 'samsung-a4', '500', '1', '3', 'samsung-galaxy-tab-4-10-1.jpg', 'Samsung A4', null);
INSERT INTO `tblproducto` VALUES ('2', 'Mas velocidad de transmision', '3', 'kdjfkljsdlkfjlksjdflkjslkdfjlksjflkjsdflkjslkjflksjdlkjslkfjslkfjlksjflksjfljslkfjlskjflksjflksjlfkjslkfjklsjflkajsflkjaslkfjlksjflkjsjflksjflkjsaflkajsfljsflkajflksjflksjflkasjflkajsflkasjflÃ±asjflkasjflaksjflakjflkajflkasjflÃ±ajsflkajflkajflkajflkajfk', 'pendrive_16', '30', '1', '5', 'flush memory de 16gb.JPG', 'Pendrive 16 gb', null);

-- ----------------------------
-- Table structure for `tblusuario`
-- ----------------------------
DROP TABLE IF EXISTS `tblusuario`;
CREATE TABLE `tblusuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `strNombre` varchar(255) DEFAULT NULL,
  `strApellido` varchar(255) DEFAULT NULL,
  `strDireccion` varchar(255) DEFAULT NULL,
  `strEmail` varchar(255) DEFAULT NULL,
  `intTelefono` int(11) DEFAULT NULL,
  `strPassword` varchar(255) DEFAULT NULL,
  `strUsuario` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblusuario
-- ----------------------------
INSERT INTO `tblusuario` VALUES ('1', 'Maria', 'Corts', 'Calle Jose Maria 33', 'maria@maria.com', '675843955', '1234', 'maria33');
INSERT INTO `tblusuario` VALUES ('2', 'Jose', 'Suarez', 'Calle Mestre Serrano 2', 'jose@jose.com', '36475869', '1234', 'chicalo3');
