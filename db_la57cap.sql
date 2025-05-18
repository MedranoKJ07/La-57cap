/*
 Navicat Premium Data Transfer

 Source Server         : MysqlLocal
 Source Server Type    : MySQL
 Source Server Version : 80041
 Source Host           : localhost:3306
 Source Schema         : db_la57cap

 Target Server Type    : MySQL
 Target Server Version : 80041
 File Encoding         : 65001

 Date: 18/05/2025 14:23:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categoria_producto
-- ----------------------------
DROP TABLE IF EXISTS `categoria_producto`;
CREATE TABLE `categoria_producto`  (
  `idcategoria_producto` int(0) NOT NULL AUTO_INCREMENT,
  `foto` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `garantias_meses` int(0) NOT NULL,
  `titulo` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `politica_garantia` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tiene_garantia` tinyint(0) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  `estado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idcategoria_producto`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categoria_producto
-- ----------------------------
INSERT INTO `categoria_producto` VALUES (2, NULL, 2, 'dasdd cfddf', 'dasdasdasdsd', 1, 1, '0');
INSERT INTO `categoria_producto` VALUES (3, NULL, 0, 'Gorra', 'No tiene Garantia', 0, 0, '1');
INSERT INTO `categoria_producto` VALUES (4, NULL, 2, 'dasdd', 'dasds', 1, 0, '1');
INSERT INTO `categoria_producto` VALUES (5, ' 68c183cfd8df4ba299f5d201a7262610.jpg', 1, 'Telefonos', 'naaa', 1, 0, '1');

-- ----------------------------
-- Table structure for clasificaciones
-- ----------------------------
DROP TABLE IF EXISTS `clasificaciones`;
CREATE TABLE `clasificaciones`  (
  `idClasificaciones` int(0) NOT NULL AUTO_INCREMENT,
  `puntuacion` int(0) NULL DEFAULT NULL,
  `comentario` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `fecha_clasificacion` datetime(0) NULL DEFAULT NULL,
  `pedidos_idpedidos` int(0) NOT NULL,
  `cliente_idcliente` int(0) NOT NULL,
  `repartidor_idrepartidor` int(0) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idClasificaciones`) USING BTREE,
  INDEX `fk_Clasificaciones_pedidos1_idx`(`pedidos_idpedidos`) USING BTREE,
  INDEX `fk_Clasificaciones_cliente1_idx`(`cliente_idcliente`) USING BTREE,
  INDEX `fk_Clasificaciones_repartidor1_idx`(`repartidor_idrepartidor`) USING BTREE,
  CONSTRAINT `fk_Clasificaciones_cliente1` FOREIGN KEY (`cliente_idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_Clasificaciones_pedidos1` FOREIGN KEY (`pedidos_idpedidos`) REFERENCES `pedidos` (`idpedidos`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_Clasificaciones_repartidor1` FOREIGN KEY (`repartidor_idrepartidor`) REFERENCES `repartidor` (`idrepartidor`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente`  (
  `idcliente` int(0) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(0) NULL DEFAULT NULL,
  `p_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `s_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `p_apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `s_apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `n_telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `direccion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `Municipio` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idcliente`) USING BTREE,
  INDEX `cliente_usuario_idx`(`id_usuario`) USING BTREE,
  CONSTRAINT `cliente_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES (1, NULL, ' .', '.', '.', '.', '.', '.', '.', 0);
INSERT INTO `cliente` VALUES (2, NULL, ' Kerlint', 'Josue', 'Medrano', 'Murillo', '85741341', 'a la par de mi vecino', 'Managua ', 0);
INSERT INTO `cliente` VALUES (3, 83, ' Kerlint', 'Josue', 'Medrano', 'Murillo', '85741341', 'a la par de mi vecino', 'Managua ', 0);
INSERT INTO `cliente` VALUES (5, NULL, ' Kerlint', 'Josue', 'Medrano', 'Murillo', '85741341', 'a la par de mi vecino', 'Managua ', 0);
INSERT INTO `cliente` VALUES (6, 98, 'dasdasd', 'dasdasd', 'dasdasd', 'asdasd', '85741341', 'dasdasd', 'dad ', 0);
INSERT INTO `cliente` VALUES (7, 99, 'dasdas', 'dasdas', 'dasdas', 'dasd', 'dasd', 'asdas', 'dasd ', 0);

-- ----------------------------
-- Table structure for compra_detalles
-- ----------------------------
DROP TABLE IF EXISTS `compra_detalles`;
CREATE TABLE `compra_detalles`  (
  `idCompra_Detalles` int(0) NOT NULL AUTO_INCREMENT,
  `cantidad` int(0) NULL DEFAULT NULL,
  `precio_unitario` decimal(10, 2) NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  `Compras_idCompras` int(0) NULL DEFAULT NULL,
  `producto_idproducto` int(0) NOT NULL,
  PRIMARY KEY (`idCompra_Detalles`) USING BTREE,
  INDEX `fk_Compra_Detalles_Compras1_idx`(`Compras_idCompras`) USING BTREE,
  INDEX `fk_Compra_Detalles_producto1_idx`(`producto_idproducto`) USING BTREE,
  CONSTRAINT `fk_Compra_Detalles_Compras1` FOREIGN KEY (`Compras_idCompras`) REFERENCES `compras` (`idCompras`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_Compra_Detalles_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of compra_detalles
-- ----------------------------
INSERT INTO `compra_detalles` VALUES (13, 1, 0.01, 0.01, 73, 7);
INSERT INTO `compra_detalles` VALUES (14, 2, 0.01, 0.02, 74, 7);
INSERT INTO `compra_detalles` VALUES (15, 6, 0.01, 0.06, 76, 7);
INSERT INTO `compra_detalles` VALUES (16, 1, 0.01, 0.01, 77, 7);
INSERT INTO `compra_detalles` VALUES (17, 2, 0.01, 0.02, 78, 7);
INSERT INTO `compra_detalles` VALUES (18, 4, 0.10, 0.40, 79, 7);

-- ----------------------------
-- Table structure for compras
-- ----------------------------
DROP TABLE IF EXISTS `compras`;
CREATE TABLE `compras`  (
  `idCompras` int(0) NOT NULL AUTO_INCREMENT,
  `fecha_compra` datetime(0) NOT NULL,
  `total_compra` decimal(10, 2) NOT NULL,
  `observaciones` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `Proveedores_idProveedores` int(0) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idCompras`) USING BTREE,
  INDEX `fk_Compras_Proveedores1_idx`(`Proveedores_idProveedores`) USING BTREE,
  CONSTRAINT `fk_Compras_Proveedores1` FOREIGN KEY (`Proveedores_idProveedores`) REFERENCES `proveedores` (`idProveedores`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 80 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of compras
-- ----------------------------
INSERT INTO `compras` VALUES (73, '2025-05-17 04:22:21', 0.01, '', 1, 0);
INSERT INTO `compras` VALUES (74, '2025-05-17 04:40:55', 0.02, '', 1, 0);
INSERT INTO `compras` VALUES (75, '2025-05-17 04:44:11', 0.00, '', 1, 0);
INSERT INTO `compras` VALUES (76, '2025-05-17 04:44:29', 0.06, '', 3, 0);
INSERT INTO `compras` VALUES (77, '2025-05-17 04:59:52', 0.01, '', 1, 0);
INSERT INTO `compras` VALUES (78, '2025-05-17 05:19:05', 0.02, 'Hola', 1, 0);
INSERT INTO `compras` VALUES (79, '2025-05-17 18:14:13', 0.40, 'sin comentario', 1, 0);

-- ----------------------------
-- Table structure for detalles_ventas
-- ----------------------------
DROP TABLE IF EXISTS `detalles_ventas`;
CREATE TABLE `detalles_ventas`  (
  `iddetalles_ventas` int(0) NOT NULL AUTO_INCREMENT,
  `ventas_idventas` int(0) NOT NULL,
  `id_producto` int(0) NOT NULL,
  `cantidad` int(0) NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`iddetalles_ventas`) USING BTREE,
  INDEX `detalles_ventas_productos_idx`(`id_producto`) USING BTREE,
  INDEX `fk_detalles_ventas_ventas1_idx`(`ventas_idventas`) USING BTREE,
  CONSTRAINT `detalles_ventas_productos` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_detalles_ventas_ventas1` FOREIGN KEY (`ventas_idventas`) REFERENCES `ventas` (`idventas`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for devolucion_detalles
-- ----------------------------
DROP TABLE IF EXISTS `devolucion_detalles`;
CREATE TABLE `devolucion_detalles`  (
  `idDevolucion_Detalles` int(0) NOT NULL AUTO_INCREMENT,
  `cantidad` int(0) NOT NULL,
  `Estado_Producto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `producto_idproducto` int(0) NOT NULL,
  `Devoluciones_idDevoluciones` int(0) NOT NULL,
  PRIMARY KEY (`idDevolucion_Detalles`) USING BTREE,
  INDEX `fk_Devolucion_Detalles_producto1_idx`(`producto_idproducto`) USING BTREE,
  INDEX `fk_Devolucion_Detalles_Devoluciones1_idx`(`Devoluciones_idDevoluciones`) USING BTREE,
  CONSTRAINT `fk_Devolucion_Detalles_Devoluciones1` FOREIGN KEY (`Devoluciones_idDevoluciones`) REFERENCES `devoluciones` (`idDevoluciones`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_Devolucion_Detalles_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for devoluciones
-- ----------------------------
DROP TABLE IF EXISTS `devoluciones`;
CREATE TABLE `devoluciones`  (
  `idDevoluciones` int(0) NOT NULL AUTO_INCREMENT,
  `fecha_solicitud` datetime(0) NOT NULL,
  `motivo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Aprobado` tinyint(0) NOT NULL,
  `tipo_reembolso` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `observaciones` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ventas_idventas` int(0) NOT NULL,
  `cliente_idcliente` int(0) NOT NULL,
  `Estado` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idDevoluciones`) USING BTREE,
  INDEX `fk_Devoluciones_ventas1_idx`(`ventas_idventas`) USING BTREE,
  INDEX `fk_Devoluciones_cliente1_idx`(`cliente_idcliente`) USING BTREE,
  CONSTRAINT `fk_Devoluciones_cliente1` FOREIGN KEY (`cliente_idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_Devoluciones_ventas1` FOREIGN KEY (`ventas_idventas`) REFERENCES `ventas` (`idventas`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for inventario
-- ----------------------------
DROP TABLE IF EXISTS `inventario`;
CREATE TABLE `inventario`  (
  `idInventario` int(0) NOT NULL AUTO_INCREMENT,
  `cantidad_actual` int(0) NOT NULL,
  `cantidad_minima` int(0) NOT NULL,
  `fecha_actualizacion` datetime(0) NULL DEFAULT NULL,
  `producto_idproducto` int(0) NOT NULL,
  PRIMARY KEY (`idInventario`) USING BTREE,
  INDEX `fk_Inventario_producto1_idx`(`producto_idproducto`) USING BTREE,
  CONSTRAINT `fk_Inventario_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of inventario
-- ----------------------------
INSERT INTO `inventario` VALUES (2, 16, 5, '2025-05-17 18:14:13', 7);

-- ----------------------------
-- Table structure for notificacion
-- ----------------------------
DROP TABLE IF EXISTS `notificacion`;
CREATE TABLE `notificacion`  (
  `idnotificacion` int(0) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `creada_fecha` datetime(0) NOT NULL,
  `usuario_idusuario` int(0) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idnotificacion`) USING BTREE,
  INDEX `fk_notificacion_usuario1_idx`(`usuario_idusuario`) USING BTREE,
  CONSTRAINT `fk_notificacion_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pedidos
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos`  (
  `idpedidos` int(0) NOT NULL AUTO_INCREMENT,
  `id_ventas` int(0) NOT NULL,
  `id_cliente` int(0) NOT NULL,
  `id_repartidor` int(0) NULL DEFAULT NULL,
  `creado` datetime(0) NOT NULL,
  `fecha_entregar` date NOT NULL,
  `hora_entregar` time(0) NOT NULL,
  `direccion_entregar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `comentarios` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `estado` tinyint(0) NULL DEFAULT NULL,
  `pago_confirmado` tinyint(0) NULL DEFAULT NULL,
  PRIMARY KEY (`idpedidos`) USING BTREE,
  INDEX `pedido_cliente_idx`(`id_cliente`) USING BTREE,
  INDEX `pedido_repartidor_idx`(`id_repartidor`) USING BTREE,
  INDEX `pedido_ventas_idx`(`id_ventas`) USING BTREE,
  CONSTRAINT `pedido_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`idcliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pedido_repartidor` FOREIGN KEY (`id_repartidor`) REFERENCES `repartidor` (`idrepartidor`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pedido_ventas` FOREIGN KEY (`id_ventas`) REFERENCES `ventas` (`idventas`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for producto
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto`  (
  `idproducto` int(0) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(0) NOT NULL,
  `codigo_producto` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombre_producto` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `precio` decimal(10, 2) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  `Foto` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idproducto`) USING BTREE,
  INDEX `producto_categoria_idx`(`id_categoria`) USING BTREE,
  CONSTRAINT `producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_producto` (`idcategoria_producto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of producto
-- ----------------------------
INSERT INTO `producto` VALUES (1, 3, 'GOR-03-0001', 'Gorra Azul', 'Muy Linda', 580.00, 1, NULL);
INSERT INTO `producto` VALUES (2, 3, 'GOR-03-0002', 'Gorra Azul', 'fdsfdsfdsf', 850.00, 1, ' ');
INSERT INTO `producto` VALUES (3, 3, 'GOR-03-0002', 'Gorra Azul cambio', 'fdsfdsfdsf', 850.00, 1, '  ');
INSERT INTO `producto` VALUES (4, 3, 'GOR-03-0004', 'Gorra Azul', 'DASDASD', 0.00, 1, ' ');
INSERT INTO `producto` VALUES (5, 3, 'GOR-03-0005', 'Gorra Azul', 'fdsff', 20.00, 1, ' ');
INSERT INTO `producto` VALUES (6, 3, 'GOR-03-0006', 'Gorra Azul', 'gfsfsdfdf', 0.00, 1, 'e7b284a7d548485b2bbbd0770813af2c.jpg');
INSERT INTO `producto` VALUES (7, 3, 'GOR-03-0007', 'Gorra Azul', 'dasdsad', 58.00, 0, 'a6e708969dffabe60f0d5c2cffbd1560.jpg');

-- ----------------------------
-- Table structure for proveedores
-- ----------------------------
DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE `proveedores`  (
  `idProveedores` int(0) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `contacto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `direccion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nacionalidad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idProveedores`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proveedores
-- ----------------------------
INSERT INTO `proveedores` VALUES (1, ' Compania', 'Kj', '8479849844', 'a la par de mi casa', 'nacional', 0);
INSERT INTO `proveedores` VALUES (3, ' Compania', 'Kj', '8479849844', 'a la par de mi casa', 'extranjera ', 0);
INSERT INTO `proveedores` VALUES (4, ' Compania', 'Kj', '8479849844', 'a la par de mi casa', 'extranjera ', 0);

-- ----------------------------
-- Table structure for repartidor
-- ----------------------------
DROP TABLE IF EXISTS `repartidor`;
CREATE TABLE `repartidor`  (
  `idrepartidor` int(0) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(0) NULL DEFAULT NULL,
  `p_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `s_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `p_apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `s_apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `n_telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idrepartidor`) USING BTREE,
  INDEX `repartidor_usuario_idx`(`id_usuario`) USING BTREE,
  CONSTRAINT `vendedor_usuario00` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of repartidor
-- ----------------------------
INSERT INTO `repartidor` VALUES (12, 74, 'Kerlint', 'Josue', 'Medrano', 'Murillo', '85741341', 0);
INSERT INTO `repartidor` VALUES (13, 88, 'adasds', 'asdasd', 'asdasdds', 'asdadas', '54654654654654 ', 1);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `idroles` int(0) NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idroles`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Administrador');
INSERT INTO `roles` VALUES (2, 'Vendedor');
INSERT INTO `roles` VALUES (3, 'Repartidor');
INSERT INTO `roles` VALUES (4, 'Cliente');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `idusuario` int(0) NOT NULL AUTO_INCREMENT,
  `id_roles` int(0) NOT NULL,
  `f_perfil` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `userName` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `confirmado` tinyint(1) NULL DEFAULT NULL,
  `token` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `Creado_Fecha` datetime(0) NOT NULL,
  `Cambiado_Fecha` datetime(0) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  `intentos_fallidos` int(0) NULL DEFAULT 0,
  PRIMARY KEY (`idusuario`) USING BTREE,
  INDEX `usuario_roles_idx`(`id_roles`) USING BTREE,
  CONSTRAINT `usuario_roles` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`idroles`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 91 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (59, 1, '4fab6662fe79843fdffa9013be93884a.jpg', 'KJ', '$2y$10$5C2QP0paeEA8n4ZCgJkn3eWRj7GoUbo5JoQuYcTeK5PA19r9D2M22', 'kmurillojosue75@gmail.com', 1, NULL, '2025-05-13 05:56:18', '2025-05-13 05:56:18', 0, 0);
INSERT INTO `usuario` VALUES (72, 1, '4d288312d85b9591c952f7a14ea1155f.jpg', 'a', '$2y$10$NW/1HEQ0tqvRApqoM3c6CenZKLzyhmkwR2TJEsVYImmohRzg9pt5C', 'a@gmail.com', 1, '', '2025-05-15 03:38:45', '2025-05-15 03:38:45', 1, 1);
INSERT INTO `usuario` VALUES (73, 2, '6282b1484ede608da413179304d52e0c.jpg', 'KJ Vendedor', '$2y$10$35yBRFnfpu74u4IRAKMtOekuRgWSPG4YGLv/Q/ks6wkFVplyf/SKO', 'kmurillojosue75@gmail.com', 1, '', '2025-05-15 07:21:57', '2025-05-15 07:21:57', 0, 0);
INSERT INTO `usuario` VALUES (74, 3, '0f08b57b3bd1c4fed42781937a60a12d.jpg', 'KJ Repartidor', '$2y$10$n4OwveYjZ/2fpvq5POXtOOF25pXq.TNU1OhyfrcXbJyqKHfMcDnOu', 'kmurillojosue275@gmail.com', 1, '682a3f0471d13', '2025-05-15 07:22:22', '2025-05-15 07:22:22', 0, 0);
INSERT INTO `usuario` VALUES (83, 4, 'f_perfil_deaulft.png', 'KJ Cliente', '$2y$10$h2wmzDqQgCRJ/jhzWtsy5OOnUEOWF9EGqSacgCAMoWl8rZbGR1GmG', 'kj@gmail.com', 1, '', '2025-05-17 21:58:51', '2025-05-17 21:58:51', 0, 0);
INSERT INTO `usuario` VALUES (84, 1, '4592aa6404f6bcebf2521e98c6e22071.jpg', 'a', '$2y$10$o39QgKi0DuyvrrW3hzVuj.k7pTI5m5d9j.Zd8GXXrOKBN8Mi77S1u', 'a@gmail.com', 0, '', '2025-05-18 04:09:49', '2025-05-18 04:09:49', 1, 0);
INSERT INTO `usuario` VALUES (88, 3, '', 'a', '$2y$10$khTtLSYVMd42l7ldmN0Ga.X.wPRNIq2T9RfK/aW1iCQmsNQjPFDI2', 'a@gmail.com', 1, '', '2025-05-18 04:38:43', '2025-05-18 04:38:43', 1, 0);
INSERT INTO `usuario` VALUES (89, 2, 'fondo.jpg', 'cambio', 'dfdsfdf', 'a@gmail.com', 1, '', '2025-05-18 04:59:48', '2025-05-18 04:59:48', 1, 0);
INSERT INTO `usuario` VALUES (98, 4, '', 'dasdasd', '$2y$10$v8JUSJznr/AytDj3sUwuNeup2DkIQK26IiO4sXjhGO4/TZyuoq3Ma', 'dadasd@gmail.com', 0, '', '2025-05-18 05:31:34', '2025-05-18 05:31:34', 0, 0);
INSERT INTO `usuario` VALUES (99, 4, '', 'KJ', '$2y$10$CGHIteHNWr3g3jL4a77.X..kGlg./1ztFXoTL3KnrI1htdCekmez2', 'ksadsj@gmail.com', 0, '', '2025-05-18 17:08:55', '2025-05-18 17:08:55', 0, 0);

-- ----------------------------
-- Table structure for vendedor
-- ----------------------------
DROP TABLE IF EXISTS `vendedor`;
CREATE TABLE `vendedor`  (
  `idvendedor` int(0) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(0) NULL DEFAULT NULL,
  `p_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `s_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `p_apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `s_apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `n_telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idvendedor`) USING BTREE,
  INDEX `vendedor_usuario_idx`(`id_usuario`) USING BTREE,
  CONSTRAINT `vendedor_usuario0` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vendedor
-- ----------------------------
INSERT INTO `vendedor` VALUES (22, 73, 'Kerlint ', 'Josue', 'Medrano', 'Murillo', '85741341 ', 0);
INSERT INTO `vendedor` VALUES (23, 89, 'Kerlint  dad', 'Josue', 'dasdas', 'gdfgdfgf', '85741341  ', 1);

-- ----------------------------
-- Table structure for ventas
-- ----------------------------
DROP TABLE IF EXISTS `ventas`;
CREATE TABLE `ventas`  (
  `idventas` int(0) NOT NULL AUTO_INCREMENT,
  `id_vendedor` int(0) NOT NULL,
  `subtotal` decimal(10, 2) NOT NULL,
  `descuento` decimal(10, 2) NOT NULL,
  `iva` decimal(10, 2) NOT NULL,
  `total` decimal(10, 2) NOT NULL,
  `estado` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `creado` datetime(0) NOT NULL,
  PRIMARY KEY (`idventas`) USING BTREE,
  INDEX `ventas_vendedor_idx`(`id_vendedor`) USING BTREE,
  CONSTRAINT `ventas_vendedor` FOREIGN KEY (`id_vendedor`) REFERENCES `vendedor` (`idvendedor`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
