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

 Date: 30/05/2025 16:36:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for calificaciones
-- ----------------------------
DROP TABLE IF EXISTS `calificaciones`;
CREATE TABLE `calificaciones`  (
  `idcalificaciones` int(0) NOT NULL AUTO_INCREMENT,
  `puntuacion` int(0) NULL DEFAULT NULL,
  `comentario` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `fecha_clasificacion` datetime(0) NULL DEFAULT NULL,
  `pedidos_idpedidos` int(0) NOT NULL,
  `cliente_idcliente` int(0) NOT NULL,
  `repartidor_idrepartidor` int(0) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idcalificaciones`) USING BTREE,
  INDEX `fk_Clasificaciones_pedidos1_idx`(`pedidos_idpedidos`) USING BTREE,
  INDEX `fk_Clasificaciones_cliente1_idx`(`cliente_idcliente`) USING BTREE,
  INDEX `fk_Clasificaciones_repartidor1_idx`(`repartidor_idrepartidor`) USING BTREE,
  CONSTRAINT `fk_Clasificaciones_cliente1` FOREIGN KEY (`cliente_idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_Clasificaciones_pedidos1` FOREIGN KEY (`pedidos_idpedidos`) REFERENCES `pedidos` (`idpedidos`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_Clasificaciones_repartidor1` FOREIGN KEY (`repartidor_idrepartidor`) REFERENCES `repartidor` (`idrepartidor`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of calificaciones
-- ----------------------------
INSERT INTO `calificaciones` VALUES (1, 5, 'asdasdsadsda', '2025-05-28 03:25:33', 9, 3, 12, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categoria_producto
-- ----------------------------
INSERT INTO `categoria_producto` VALUES (2, NULL, 2, 'dasdd cfddf', 'dasdasdasdsd', 1, 1, '0');
INSERT INTO `categoria_producto` VALUES (3, NULL, 0, 'Gorra', 'si lo jodes no hay garantia', 1, 0, '1');
INSERT INTO `categoria_producto` VALUES (4, NULL, 2, 'dasdd', 'dasds', 1, 1, '1');
INSERT INTO `categoria_producto` VALUES (5, '62ae8cd8c307e395563c2cb43bae53de.jpg', 1, 'Gorras', 'naaa', 1, 0, '1');
INSERT INTO `categoria_producto` VALUES (6, '32f024b626e9d02fc41b13a0471406f1.jpg', 2, 'Gorras', 's', 1, 0, '1');

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
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES (1, NULL, ' .', '.', '.', '.', '.', '.', '.', 0);
INSERT INTO `cliente` VALUES (2, 84, ' Kerlint', 'Josue', 'Medrano', 'Murillo', '85741341', 'a la par de mi vecino', 'Managua ', 0);
INSERT INTO `cliente` VALUES (3, 83, ' Kerlint', 'Josue', 'Medrano', 'Murillo', '85741341', 'a la par de mi vecino', 'Managua ', 0);
INSERT INTO `cliente` VALUES (5, NULL, ' Kerlint', 'Josue', 'Medrano', 'Murillo', '85741341', 'a la par de mi vecino', 'Managua ', 0);
INSERT INTO `cliente` VALUES (6, NULL, 'dasdasd', 'dasdasd', 'dasdasd', 'asdasd', '85741341', 'dasdasd', 'dad ', 0);
INSERT INTO `cliente` VALUES (7, NULL, 'dasdas', 'dasdas', 'dasdas', 'dasd', 'dasd', 'asdas', 'dasd ', 0);
INSERT INTO `cliente` VALUES (12, NULL, 'prueba', 'prueba', 'prueba', 'prueba', '1234567890', 'prueba', 'prueba ', 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of compra_detalles
-- ----------------------------
INSERT INTO `compra_detalles` VALUES (13, 1, 0.01, 0.01, 73, 7);
INSERT INTO `compra_detalles` VALUES (14, 2, 0.01, 0.02, 74, 7);
INSERT INTO `compra_detalles` VALUES (15, 6, 0.01, 0.06, 76, 7);
INSERT INTO `compra_detalles` VALUES (16, 1, 0.01, 0.01, 77, 7);
INSERT INTO `compra_detalles` VALUES (17, 2, 0.01, 0.02, 78, 7);
INSERT INTO `compra_detalles` VALUES (18, 4, 0.10, 0.40, 79, 7);
INSERT INTO `compra_detalles` VALUES (19, 6, 0.44, 2.64, 80, 7);
INSERT INTO `compra_detalles` VALUES (20, 5, 0.04, 0.20, 81, 8);

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
) ENGINE = InnoDB AUTO_INCREMENT = 82 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `compras` VALUES (80, '2025-05-20 22:51:21', 2.64, 'todo bien', 1, 0);
INSERT INTO `compras` VALUES (81, '2025-05-20 22:51:51', 0.20, 'todo bien', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalles_ventas
-- ----------------------------
INSERT INTO `detalles_ventas` VALUES (1, 4, 8, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (2, 5, 8, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (3, 6, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (4, 14, 8, 2, 58.00);
INSERT INTO `detalles_ventas` VALUES (5, 15, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (6, 16, 8, 2, 116.00);
INSERT INTO `detalles_ventas` VALUES (7, 17, 7, 5, 290.00);
INSERT INTO `detalles_ventas` VALUES (8, 18, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (9, 19, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (10, 20, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (11, 21, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (12, 22, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (13, 23, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (14, 24, 7, 2, 116.00);
INSERT INTO `detalles_ventas` VALUES (15, 24, 8, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (16, 25, 8, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (17, 26, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (18, 27, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (19, 28, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (20, 29, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (21, 30, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (22, 31, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (23, 32, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (24, 33, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (25, 35, 8, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (26, 36, 8, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (27, 37, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (28, 38, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (29, 39, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (30, 40, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (31, 41, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (32, 42, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (33, 43, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (34, 44, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (35, 45, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (36, 46, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (37, 47, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (38, 48, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (39, 49, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (40, 50, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (41, 51, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (42, 52, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (43, 56, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (44, 57, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (45, 58, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (46, 59, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (47, 60, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (48, 61, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (49, 62, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (50, 63, 7, 3, 174.00);
INSERT INTO `detalles_ventas` VALUES (51, 64, 8, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (52, 64, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (53, 65, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (54, 65, 8, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (55, 66, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (56, 67, 7, 1, 58.00);
INSERT INTO `detalles_ventas` VALUES (57, 68, 7, 1, 58.00);

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
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of devolucion_detalles
-- ----------------------------
INSERT INTO `devolucion_detalles` VALUES (5, 1, 'sucia', 7, 15);
INSERT INTO `devolucion_detalles` VALUES (6, 1, 'a', 7, 16);
INSERT INTO `devolucion_detalles` VALUES (7, 1, 'dsdd', 7, 17);
INSERT INTO `devolucion_detalles` VALUES (8, 1, 'a', 8, 18);
INSERT INTO `devolucion_detalles` VALUES (9, 1, 'sucia', 7, 19);
INSERT INTO `devolucion_detalles` VALUES (10, 1, 'asdsad', 7, 20);
INSERT INTO `devolucion_detalles` VALUES (11, 1, 'gfgdg', 7, 21);
INSERT INTO `devolucion_detalles` VALUES (12, 1, '1234', 8, 22);

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
  `eliminado` tinyint(0) NULL DEFAULT 0,
  `Estado` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idDevoluciones`) USING BTREE,
  INDEX `fk_Devoluciones_ventas1_idx`(`ventas_idventas`) USING BTREE,
  INDEX `fk_Devoluciones_cliente1_idx`(`cliente_idcliente`) USING BTREE,
  CONSTRAINT `fk_Devoluciones_cliente1` FOREIGN KEY (`cliente_idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_Devoluciones_ventas1` FOREIGN KEY (`ventas_idventas`) REFERENCES `ventas` (`idventas`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of devoluciones
-- ----------------------------
INSERT INTO `devoluciones` VALUES (15, '2025-05-22 22:34:19', 'Múltiples productos', 0, 'mixto', 'no cubre la garantia', 15, 3, 0, 'Rechazado');
INSERT INTO `devoluciones` VALUES (16, '2025-05-22 23:26:12', 'Múltiples productos', 1, 'mixto', '', 15, 3, 0, 'Aprobado');
INSERT INTO `devoluciones` VALUES (17, '2025-05-22 23:29:46', 'Múltiples productos', 1, 'mixto', '', 15, 3, 0, 'Aprobado');
INSERT INTO `devoluciones` VALUES (18, '2025-05-23 02:14:48', 'Múltiples productos', 0, 'mixto', 'tu madre', 14, 3, 0, 'Rechazado');
INSERT INTO `devoluciones` VALUES (19, '2025-05-27 21:31:08', 'Múltiples productos', 1, 'mixto', '', 6, 3, 0, 'Aprobado');
INSERT INTO `devoluciones` VALUES (20, '2025-05-28 02:14:11', 'Múltiples productos', 1, 'mixto', '', 21, 2, 0, 'Aprobado');
INSERT INTO `devoluciones` VALUES (21, '2025-05-29 05:04:53', 'Múltiples productos', 1, 'mixto', '', 28, 3, 0, 'Aprobado');
INSERT INTO `devoluciones` VALUES (22, '2025-05-29 22:45:23', 'Múltiples productos', 0, 'mixto', 'tu madre', 25, 3, 0, 'Rechazado');

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of inventario
-- ----------------------------
INSERT INTO `inventario` VALUES (2, 14, 5, '2025-05-30 16:01:53', 7);
INSERT INTO `inventario` VALUES (3, 19, 5, '2025-05-30 15:59:09', 8);

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
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notificacion
-- ----------------------------
INSERT INTO `notificacion` VALUES (1, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta para el cliente  Kerlint Medrano', '2025-05-29 03:48:10', 59, 1);
INSERT INTO `notificacion` VALUES (2, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano', '2025-05-29 04:09:19', 59, 1);
INSERT INTO `notificacion` VALUES (3, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano. Por favor, revisar y atender la venta', '2025-05-29 04:09:19', 73, 0);
INSERT INTO `notificacion` VALUES (10, 'Nuevo pedido asignado', 'Se le ha asignado un nuevo pedido con dirección de entrega. Pedido #: 12', '2025-05-29 04:31:34', 74, 0);
INSERT INTO `notificacion` VALUES (11, 'Confirmación de pago entrega completada', 'Se ha recibido pago y la entrega ha sido completada para el pedido #10', '2025-05-29 04:40:08', 73, 0);
INSERT INTO `notificacion` VALUES (12, 'Confirmación de pago entrega completada', 'Se ha recibido pago y la entrega ha sido completada para el pedido #10', '2025-05-29 04:40:08', 59, 1);
INSERT INTO `notificacion` VALUES (13, 'Nuevo pedido asignado', 'Se le ha asignado un nuevo pedido con dirección de entrega. Pedido #: 13', '2025-05-29 04:49:16', 74, 0);
INSERT INTO `notificacion` VALUES (14, 'Nuevo pedido asignado', 'Se le ha asignado un nuevo pedido con dirección de entrega. Pedido #: 13', '2025-05-29 04:49:38', 74, 0);
INSERT INTO `notificacion` VALUES (15, 'Nuevo pedido asignado', 'Se le ha asignado un nuevo pedido con dirección de entrega. Pedido #: 13', '2025-05-29 04:50:07', 74, 0);
INSERT INTO `notificacion` VALUES (16, 'Nuevo pedido asignado', 'Se le ha asignado un nuevo pedido con dirección de entrega. Pedido #: 13', '2025-05-29 04:50:49', 74, 0);
INSERT INTO `notificacion` VALUES (17, 'Nuevo pedido asignado', 'Se le ha asignado un nuevo pedido con dirección de entrega. Pedido #: 13', '2025-05-29 04:52:36', 74, 0);
INSERT INTO `notificacion` VALUES (18, 'Pedido en camino', 'Tu pedido ha sido asignado a un repartidor y pronto será entregado.', '2025-05-29 04:52:36', 83, 1);
INSERT INTO `notificacion` VALUES (19, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-29 04:55:00', 83, 1);
INSERT INTO `notificacion` VALUES (20, 'Nueva solicitud de devolución', 'Un cliente ha solicitado la devolución de un pedido. Pedido #10', '2025-05-29 05:04:53', 59, 1);
INSERT INTO `notificacion` VALUES (21, 'Nueva solicitud de devolución', 'Un cliente ha solicitado la devolución de un pedido. Pedido #9', '2025-05-29 22:45:23', 59, 1);
INSERT INTO `notificacion` VALUES (22, 'Visitar tienda', 'Por favor, visita la tienda para resolver tu solicitud de devolución. Por favor, lleva el producto. y el comprobantes de compra.', '2025-05-29 22:58:12', 83, 1);
INSERT INTO `notificacion` VALUES (23, 'Respuesta a solicitud de devolución', 'Se ha rechazado tu solicitud de devolución. Motivo: tu madre', '2025-05-29 23:05:48', 83, 1);
INSERT INTO `notificacion` VALUES (24, '⚠️ Stock Crítico', 'El producto \"Gorra amarillas\" está en stock crítico con solo 2 unidades.', '2025-05-30 01:56:24', 59, 1);
INSERT INTO `notificacion` VALUES (25, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano', '2025-05-30 01:56:24', 59, 1);
INSERT INTO `notificacion` VALUES (26, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano. Por favor, revisar y atender la venta', '2025-05-30 01:56:24', 73, 0);
INSERT INTO `notificacion` VALUES (27, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano', '2025-05-30 02:02:28', 59, 1);
INSERT INTO `notificacion` VALUES (28, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano. Por favor, revisar y atender la venta', '2025-05-30 02:02:28', 73, 0);
INSERT INTO `notificacion` VALUES (29, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano', '2025-05-30 02:02:57', 59, 1);
INSERT INTO `notificacion` VALUES (30, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano. Por favor, revisar y atender la venta', '2025-05-30 02:02:57', 73, 0);
INSERT INTO `notificacion` VALUES (31, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano', '2025-05-30 02:03:53', 59, 1);
INSERT INTO `notificacion` VALUES (32, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano. Por favor, revisar y atender la venta', '2025-05-30 02:03:53', 73, 0);
INSERT INTO `notificacion` VALUES (33, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano', '2025-05-30 02:11:44', 59, 1);
INSERT INTO `notificacion` VALUES (34, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano. Por favor, revisar y atender la venta', '2025-05-30 02:11:44', 73, 0);
INSERT INTO `notificacion` VALUES (35, 'Stock Crítico', 'El producto \"Gorra amarillas\" está en stock crítico con solo 2 unidades.', '2025-05-30 02:12:43', 59, 1);
INSERT INTO `notificacion` VALUES (36, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano', '2025-05-30 02:12:43', 59, 1);
INSERT INTO `notificacion` VALUES (37, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano. Por favor, revisar y atender la venta', '2025-05-30 02:12:43', 73, 0);
INSERT INTO `notificacion` VALUES (38, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 17:29:22', 83, 0);
INSERT INTO `notificacion` VALUES (39, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 17:34:15', 83, 0);
INSERT INTO `notificacion` VALUES (40, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 17:35:39', 83, 0);
INSERT INTO `notificacion` VALUES (41, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 17:40:11', 83, 0);
INSERT INTO `notificacion` VALUES (42, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 17:40:43', 83, 0);
INSERT INTO `notificacion` VALUES (43, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 17:41:15', 83, 0);
INSERT INTO `notificacion` VALUES (44, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 17:43:20', 83, 0);
INSERT INTO `notificacion` VALUES (45, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 17:45:50', 83, 0);
INSERT INTO `notificacion` VALUES (46, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 17:47:35', 83, 0);
INSERT INTO `notificacion` VALUES (47, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 17:48:47', 83, 0);
INSERT INTO `notificacion` VALUES (48, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 17:49:20', 83, 0);
INSERT INTO `notificacion` VALUES (49, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 17:50:20', 83, 0);
INSERT INTO `notificacion` VALUES (50, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 17:51:12', 83, 0);
INSERT INTO `notificacion` VALUES (51, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:07:14', 83, 0);
INSERT INTO `notificacion` VALUES (52, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:08:05', 83, 0);
INSERT INTO `notificacion` VALUES (53, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:09:05', 83, 0);
INSERT INTO `notificacion` VALUES (54, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:13:41', 83, 0);
INSERT INTO `notificacion` VALUES (55, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:14:12', 83, 0);
INSERT INTO `notificacion` VALUES (56, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:14:32', 83, 0);
INSERT INTO `notificacion` VALUES (57, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:14:44', 83, 0);
INSERT INTO `notificacion` VALUES (58, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:15:40', 83, 0);
INSERT INTO `notificacion` VALUES (59, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:15:43', 83, 0);
INSERT INTO `notificacion` VALUES (60, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:15:54', 83, 0);
INSERT INTO `notificacion` VALUES (61, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:16:55', 83, 0);
INSERT INTO `notificacion` VALUES (62, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:17:07', 83, 0);
INSERT INTO `notificacion` VALUES (63, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:17:57', 83, 0);
INSERT INTO `notificacion` VALUES (64, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:18:00', 83, 0);
INSERT INTO `notificacion` VALUES (65, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:18:59', 83, 0);
INSERT INTO `notificacion` VALUES (66, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:19:38', 83, 0);
INSERT INTO `notificacion` VALUES (67, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:21:12', 83, 0);
INSERT INTO `notificacion` VALUES (68, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:21:39', 83, 0);
INSERT INTO `notificacion` VALUES (69, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:22:11', 83, 0);
INSERT INTO `notificacion` VALUES (70, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:22:41', 83, 0);
INSERT INTO `notificacion` VALUES (71, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:23:32', 83, 0);
INSERT INTO `notificacion` VALUES (72, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:23:55', 83, 0);
INSERT INTO `notificacion` VALUES (73, 'Stock Crítico', 'El producto \"Gorra amarillas\" está en stock crítico con solo 2 unidades.', '2025-05-30 18:26:11', 59, 0);
INSERT INTO `notificacion` VALUES (74, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano', '2025-05-30 18:26:11', 59, 0);
INSERT INTO `notificacion` VALUES (75, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano. Por favor, revisar y atender la venta', '2025-05-30 18:26:11', 73, 0);
INSERT INTO `notificacion` VALUES (76, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:37:14', 83, 0);
INSERT INTO `notificacion` VALUES (77, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano', '2025-05-30 18:46:23', 59, 0);
INSERT INTO `notificacion` VALUES (78, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente  Kerlint Medrano. Por favor, revisar y atender la venta', '2025-05-30 18:46:23', 73, 0);
INSERT INTO `notificacion` VALUES (79, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:46:30', 83, 0);
INSERT INTO `notificacion` VALUES (80, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:55:52', 83, 0);
INSERT INTO `notificacion` VALUES (81, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 18:57:10', 83, 0);
INSERT INTO `notificacion` VALUES (82, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 19:00:09', 83, 0);
INSERT INTO `notificacion` VALUES (83, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 19:41:11', 83, 0);
INSERT INTO `notificacion` VALUES (84, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 19:41:31', 83, 0);
INSERT INTO `notificacion` VALUES (85, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 19:43:06', 83, 0);
INSERT INTO `notificacion` VALUES (86, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 19:45:04', 83, 0);
INSERT INTO `notificacion` VALUES (87, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 19:46:42', 83, 0);
INSERT INTO `notificacion` VALUES (88, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 19:47:02', 83, 0);
INSERT INTO `notificacion` VALUES (89, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 19:49:44', 83, 0);
INSERT INTO `notificacion` VALUES (90, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 19:51:29', 83, 0);
INSERT INTO `notificacion` VALUES (91, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 19:52:14', 83, 0);
INSERT INTO `notificacion` VALUES (92, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 19:52:34', 83, 0);
INSERT INTO `notificacion` VALUES (93, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 19:52:50', 83, 0);
INSERT INTO `notificacion` VALUES (94, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 19:53:24', 83, 0);
INSERT INTO `notificacion` VALUES (95, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:02:47', 83, 0);
INSERT INTO `notificacion` VALUES (96, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:06:58', 83, 0);
INSERT INTO `notificacion` VALUES (97, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:07:14', 83, 0);
INSERT INTO `notificacion` VALUES (98, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:10:23', 83, 0);
INSERT INTO `notificacion` VALUES (99, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:10:57', 83, 0);
INSERT INTO `notificacion` VALUES (100, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:11:33', 83, 0);
INSERT INTO `notificacion` VALUES (101, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:12:25', 83, 0);
INSERT INTO `notificacion` VALUES (102, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:12:58', 83, 0);
INSERT INTO `notificacion` VALUES (103, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:15:29', 83, 0);
INSERT INTO `notificacion` VALUES (104, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:15:36', 83, 0);
INSERT INTO `notificacion` VALUES (105, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:16:01', 83, 0);
INSERT INTO `notificacion` VALUES (106, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:16:01', 83, 0);
INSERT INTO `notificacion` VALUES (107, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:16:01', 83, 0);
INSERT INTO `notificacion` VALUES (108, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:16:02', 83, 0);
INSERT INTO `notificacion` VALUES (109, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:16:02', 83, 0);
INSERT INTO `notificacion` VALUES (110, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:16:02', 83, 0);
INSERT INTO `notificacion` VALUES (111, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:16:03', 83, 0);
INSERT INTO `notificacion` VALUES (112, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:16:03', 83, 0);
INSERT INTO `notificacion` VALUES (113, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:16:37', 83, 0);
INSERT INTO `notificacion` VALUES (114, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:16:37', 83, 0);
INSERT INTO `notificacion` VALUES (115, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:16:37', 83, 0);
INSERT INTO `notificacion` VALUES (116, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:16:38', 83, 0);
INSERT INTO `notificacion` VALUES (117, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:17:11', 83, 0);
INSERT INTO `notificacion` VALUES (118, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:17:26', 83, 0);
INSERT INTO `notificacion` VALUES (119, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:18:04', 83, 0);
INSERT INTO `notificacion` VALUES (120, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:18:06', 83, 0);
INSERT INTO `notificacion` VALUES (121, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:18:26', 83, 0);
INSERT INTO `notificacion` VALUES (122, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:18:45', 83, 0);
INSERT INTO `notificacion` VALUES (123, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:18:45', 83, 0);
INSERT INTO `notificacion` VALUES (124, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:10', 83, 0);
INSERT INTO `notificacion` VALUES (125, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:28', 83, 0);
INSERT INTO `notificacion` VALUES (126, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:28', 83, 0);
INSERT INTO `notificacion` VALUES (127, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:28', 83, 0);
INSERT INTO `notificacion` VALUES (128, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:29', 83, 0);
INSERT INTO `notificacion` VALUES (129, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:29', 83, 0);
INSERT INTO `notificacion` VALUES (130, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:29', 83, 0);
INSERT INTO `notificacion` VALUES (131, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:29', 83, 0);
INSERT INTO `notificacion` VALUES (132, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:30', 83, 0);
INSERT INTO `notificacion` VALUES (133, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:30', 83, 0);
INSERT INTO `notificacion` VALUES (134, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:30', 83, 0);
INSERT INTO `notificacion` VALUES (135, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:30', 83, 0);
INSERT INTO `notificacion` VALUES (136, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:30', 83, 0);
INSERT INTO `notificacion` VALUES (137, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:30', 83, 0);
INSERT INTO `notificacion` VALUES (138, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:31', 83, 0);
INSERT INTO `notificacion` VALUES (139, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:31', 83, 0);
INSERT INTO `notificacion` VALUES (140, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:46', 83, 0);
INSERT INTO `notificacion` VALUES (141, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:47', 83, 0);
INSERT INTO `notificacion` VALUES (142, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:19:47', 83, 0);
INSERT INTO `notificacion` VALUES (143, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:20:07', 83, 0);
INSERT INTO `notificacion` VALUES (144, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:20:08', 83, 0);
INSERT INTO `notificacion` VALUES (145, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:20:09', 83, 0);
INSERT INTO `notificacion` VALUES (146, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:20:09', 83, 0);
INSERT INTO `notificacion` VALUES (147, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:20:09', 83, 0);
INSERT INTO `notificacion` VALUES (148, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:20:09', 83, 0);
INSERT INTO `notificacion` VALUES (149, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:20:09', 83, 0);
INSERT INTO `notificacion` VALUES (150, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:20:10', 83, 0);
INSERT INTO `notificacion` VALUES (151, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:21:54', 83, 0);
INSERT INTO `notificacion` VALUES (152, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:21:54', 83, 0);
INSERT INTO `notificacion` VALUES (153, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:21:54', 83, 0);
INSERT INTO `notificacion` VALUES (154, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:21:56', 83, 0);
INSERT INTO `notificacion` VALUES (155, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:23:25', 83, 0);
INSERT INTO `notificacion` VALUES (156, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:23:27', 83, 0);
INSERT INTO `notificacion` VALUES (157, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:23:45', 83, 0);
INSERT INTO `notificacion` VALUES (158, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:04', 83, 0);
INSERT INTO `notificacion` VALUES (159, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:06', 83, 0);
INSERT INTO `notificacion` VALUES (160, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:06', 83, 0);
INSERT INTO `notificacion` VALUES (161, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:06', 83, 0);
INSERT INTO `notificacion` VALUES (162, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:22', 83, 0);
INSERT INTO `notificacion` VALUES (163, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:23', 83, 0);
INSERT INTO `notificacion` VALUES (164, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:23', 83, 0);
INSERT INTO `notificacion` VALUES (165, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:24', 83, 0);
INSERT INTO `notificacion` VALUES (166, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:24', 83, 0);
INSERT INTO `notificacion` VALUES (167, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:24', 83, 0);
INSERT INTO `notificacion` VALUES (168, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:24', 83, 0);
INSERT INTO `notificacion` VALUES (169, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:25', 83, 0);
INSERT INTO `notificacion` VALUES (170, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:25', 83, 0);
INSERT INTO `notificacion` VALUES (171, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:25', 83, 0);
INSERT INTO `notificacion` VALUES (172, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:25', 83, 0);
INSERT INTO `notificacion` VALUES (173, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:26', 83, 0);
INSERT INTO `notificacion` VALUES (174, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:27', 83, 0);
INSERT INTO `notificacion` VALUES (175, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:24:27', 83, 0);
INSERT INTO `notificacion` VALUES (176, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:25:21', 83, 0);
INSERT INTO `notificacion` VALUES (177, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:26:20', 83, 0);
INSERT INTO `notificacion` VALUES (178, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:26:22', 83, 0);
INSERT INTO `notificacion` VALUES (179, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:26:23', 83, 0);
INSERT INTO `notificacion` VALUES (180, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:26:33', 83, 0);
INSERT INTO `notificacion` VALUES (181, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:26:54', 83, 0);
INSERT INTO `notificacion` VALUES (182, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:19', 83, 0);
INSERT INTO `notificacion` VALUES (183, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:19', 83, 0);
INSERT INTO `notificacion` VALUES (184, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:19', 83, 0);
INSERT INTO `notificacion` VALUES (185, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:20', 83, 0);
INSERT INTO `notificacion` VALUES (186, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:20', 83, 0);
INSERT INTO `notificacion` VALUES (187, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:20', 83, 0);
INSERT INTO `notificacion` VALUES (188, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:20', 83, 0);
INSERT INTO `notificacion` VALUES (189, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:21', 83, 0);
INSERT INTO `notificacion` VALUES (190, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:21', 83, 0);
INSERT INTO `notificacion` VALUES (191, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:21', 83, 0);
INSERT INTO `notificacion` VALUES (192, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:21', 83, 0);
INSERT INTO `notificacion` VALUES (193, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:55', 83, 0);
INSERT INTO `notificacion` VALUES (194, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:55', 83, 0);
INSERT INTO `notificacion` VALUES (195, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:55', 83, 0);
INSERT INTO `notificacion` VALUES (196, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:55', 83, 0);
INSERT INTO `notificacion` VALUES (197, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:56', 83, 0);
INSERT INTO `notificacion` VALUES (198, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:56', 83, 0);
INSERT INTO `notificacion` VALUES (199, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:56', 83, 0);
INSERT INTO `notificacion` VALUES (200, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:27:56', 83, 0);
INSERT INTO `notificacion` VALUES (201, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:28:27', 83, 0);
INSERT INTO `notificacion` VALUES (202, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:28:27', 83, 0);
INSERT INTO `notificacion` VALUES (203, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:28:27', 83, 0);
INSERT INTO `notificacion` VALUES (204, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:28:37', 83, 0);
INSERT INTO `notificacion` VALUES (205, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:28:38', 83, 0);
INSERT INTO `notificacion` VALUES (206, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:28:38', 83, 0);
INSERT INTO `notificacion` VALUES (207, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:28:38', 83, 0);
INSERT INTO `notificacion` VALUES (208, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:28:39', 83, 0);
INSERT INTO `notificacion` VALUES (209, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:28:39', 83, 0);
INSERT INTO `notificacion` VALUES (210, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:28:50', 83, 0);
INSERT INTO `notificacion` VALUES (211, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:28:51', 83, 0);
INSERT INTO `notificacion` VALUES (212, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:28:51', 83, 0);
INSERT INTO `notificacion` VALUES (213, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:31:42', 83, 0);
INSERT INTO `notificacion` VALUES (214, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:32:14', 83, 0);
INSERT INTO `notificacion` VALUES (215, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:32:15', 83, 0);
INSERT INTO `notificacion` VALUES (216, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:32:15', 83, 0);
INSERT INTO `notificacion` VALUES (217, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:32:17', 83, 0);
INSERT INTO `notificacion` VALUES (218, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 20:32:46', 83, 0);
INSERT INTO `notificacion` VALUES (219, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 21:15:51', 83, 0);
INSERT INTO `notificacion` VALUES (220, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 21:15:57', 83, 0);
INSERT INTO `notificacion` VALUES (221, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 21:32:02', 83, 0);
INSERT INTO `notificacion` VALUES (222, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 21:32:05', 83, 0);
INSERT INTO `notificacion` VALUES (223, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 21:38:25', 83, 0);
INSERT INTO `notificacion` VALUES (224, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-05-30 21:43:16', 83, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pedidos
-- ----------------------------
INSERT INTO `pedidos` VALUES (1, 6, 3, NULL, '2025-05-21 02:13:28', '2025-05-23', '12:00:00', 'a la par de mi vecino', 'dsad', 0, 0);
INSERT INTO `pedidos` VALUES (2, 14, 3, NULL, '2025-05-21 04:50:21', '2025-05-23', '12:00:00', 'a la par de mi vecino', 'asdsadsad', 0, 0);
INSERT INTO `pedidos` VALUES (3, 15, 3, NULL, '2025-05-21 04:51:35', '2025-06-06', '13:54:00', 'a la par de mi vecino', '', 0, 0);
INSERT INTO `pedidos` VALUES (4, 16, 3, NULL, '2025-05-23 04:16:51', '2025-05-30', '16:16:00', 'a la par de mi vecino', '', 0, 0);
INSERT INTO `pedidos` VALUES (5, 17, 3, 12, '2025-05-26 19:17:28', '2025-05-29', '15:19:00', 'a la par de mi vecino', 'a', 0, 0);
INSERT INTO `pedidos` VALUES (6, 18, 3, 13, '2025-05-26 19:19:07', '2025-05-28', '14:20:00', 'a', 'a', 0, 0);
INSERT INTO `pedidos` VALUES (7, 21, 2, 12, '2025-05-27 04:35:59', '2025-06-06', '22:40:00', 'a', 'Persona a Recibir : KERLINT MEDRANO', 1, 1);
INSERT INTO `pedidos` VALUES (8, 24, 1, 12, '2025-05-27 21:07:05', '2025-05-30', '18:09:00', 'a la par de mi vecino', 'Persona a Recibir : KERLINT MEDRANO', 1, 1);
INSERT INTO `pedidos` VALUES (9, 25, 3, 12, '2025-05-28 02:36:12', '2025-05-28', '10:35:00', 'sa', 'a', 1, 1);
INSERT INTO `pedidos` VALUES (10, 28, 3, 12, '2025-05-28 05:09:35', '2025-05-28', '14:10:00', 'dasd', 'asdasd', 1, 1);
INSERT INTO `pedidos` VALUES (11, 33, 2, 12, '2025-05-28 19:42:30', '2025-05-29', '13:42:00', 'a la par de mi vecino', 'Persona a Recibir : KERLINT MEDRANO', 0, 1);
INSERT INTO `pedidos` VALUES (12, 36, 3, 12, '2025-05-28 19:47:15', '2025-05-30', '14:46:00', 'a la par de mi vecino', 'a', 0, 0);
INSERT INTO `pedidos` VALUES (13, 51, 3, 12, '2025-05-29 03:48:10', '2025-05-29', '12:40:00', 'asdsad', 'asdsad', 0, 0);
INSERT INTO `pedidos` VALUES (14, 52, 3, 12, '2025-05-29 04:09:19', '2025-05-29', '13:59:00', 'asdasdsa', '', 0, 0);
INSERT INTO `pedidos` VALUES (15, 56, 3, NULL, '2025-05-30 01:56:24', '2025-05-30', '08:01:00', 'd', 'sdsa', 0, 0);
INSERT INTO `pedidos` VALUES (16, 58, 3, NULL, '2025-05-30 02:02:28', '2025-05-30', '08:06:00', 'sas', 'g', 0, 0);
INSERT INTO `pedidos` VALUES (17, 59, 3, NULL, '2025-05-30 02:02:57', '2025-06-06', '08:09:00', 'sadasd', 'h', 0, 0);
INSERT INTO `pedidos` VALUES (18, 60, 3, NULL, '2025-05-30 02:03:53', '2025-06-07', '08:08:00', 'ioio', '', 0, 0);
INSERT INTO `pedidos` VALUES (19, 61, 3, NULL, '2025-05-30 02:11:44', '2025-05-30', '08:08:00', 'sad', '', 0, 0);
INSERT INTO `pedidos` VALUES (20, 62, 3, NULL, '2025-05-30 02:12:43', '2025-05-30', '08:08:00', 'asdsad', 'kkjll', 0, 0);
INSERT INTO `pedidos` VALUES (21, 63, 3, NULL, '2025-05-30 18:26:11', '2025-05-31', '08:08:00', 'ioio', '8888', 0, 0);
INSERT INTO `pedidos` VALUES (22, 64, 3, NULL, '2025-05-30 18:46:23', '2025-05-31', '09:09:00', 'd', 'dsd', 0, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of producto
-- ----------------------------
INSERT INTO `producto` VALUES (1, 3, 'GOR-03-0001', 'Gorra Azul', 'Muy Linda', 580.00, 1, NULL);
INSERT INTO `producto` VALUES (2, 3, 'GOR-03-0002', 'Gorra Azul', 'fdsfdsfdsf', 850.00, 1, ' ');
INSERT INTO `producto` VALUES (3, 3, 'GOR-03-0002', 'Gorra Azul cambio', 'fdsfdsfdsf', 850.00, 1, '  ');
INSERT INTO `producto` VALUES (4, 3, 'GOR-03-0004', 'Gorra Azul', 'DASDASD', 0.00, 1, ' ');
INSERT INTO `producto` VALUES (5, 3, 'GOR-03-0005', 'Gorra Azul', 'fdsff', 20.00, 1, ' ');
INSERT INTO `producto` VALUES (6, 3, 'GOR-03-0006', 'Gorra Azul', 'gfsfsdfdf', 0.00, 1, 'e7b284a7d548485b2bbbd0770813af2c.jpg');
INSERT INTO `producto` VALUES (7, 5, 'GOR-03-0007', 'Gorra Azul', 'dasdsad', 58.00, 0, 'a6e708969dffabe60f0d5c2cffbd1560.jpg');
INSERT INTO `producto` VALUES (8, 3, 'GOR-03-0008', 'Gorra amarillas', 'a', 58.00, 0, '8794caf45fda4a7ed2b805dc2736de30.jpg ');

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
INSERT INTO `repartidor` VALUES (13, NULL, 'adasds', 'asdasd', 'asdasdds', 'asdadas', '54654654654654 ', 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 106 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (59, 1, '4fab6662fe79843fdffa9013be93884a.jpg', 'KJ', '$2y$10$5C2QP0paeEA8n4ZCgJkn3eWRj7GoUbo5JoQuYcTeK5PA19r9D2M22', 'kmurillojosue75@gmail.com', 1, '68362efc9b058', '2025-05-13 05:56:18', '2025-05-13 05:56:18', 0, 0);
INSERT INTO `usuario` VALUES (73, 2, '6282b1484ede608da413179304d52e0c.jpg', 'KJ Vendedor', '$2y$10$35yBRFnfpu74u4IRAKMtOekuRgWSPG4YGLv/Q/ks6wkFVplyf/SKO', 'kmurillojosue75@gmail.com', 1, '', '2025-05-15 07:21:57', '2025-05-15 07:21:57', 0, 0);
INSERT INTO `usuario` VALUES (74, 3, '0f08b57b3bd1c4fed42781937a60a12d.jpg', 'KJ Repartidor', '$2y$10$n4OwveYjZ/2fpvq5POXtOOF25pXq.TNU1OhyfrcXbJyqKHfMcDnOu', 'kmurillojosue275@gmail.com', 1, '682a3f0471d13', '2025-05-15 07:22:22', '2025-05-15 07:22:22', 0, 0);
INSERT INTO `usuario` VALUES (83, 4, '635b66db24c3358b354c5d85b5352015.jpg', 'KJ Cliente', '$2y$10$h2wmzDqQgCRJ/jhzWtsy5OOnUEOWF9EGqSacgCAMoWl8rZbGR1GmG', 'kj@gmail.com', 1, '', '2025-05-17 21:58:51', '2025-05-17 21:58:51', 0, 0);
INSERT INTO `usuario` VALUES (84, 4, '4592aa6404f6bcebf2521e98c6e22071.jpg', 'a', '$2y$10$h2wmzDqQgCRJ/jhzWtsy5OOnUEOWF9EGqSacgCAMoWl8rZbGR1GmG', 'a@gmail.com', 1, '', '2025-05-18 04:09:49', '2025-05-18 04:09:49', 0, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vendedor
-- ----------------------------
INSERT INTO `vendedor` VALUES (1, NULL, 'Vendedor', 'Online', 'Tienda', 'Online', '00000000', 0);
INSERT INTO `vendedor` VALUES (22, 73, 'Kerlint ', 'Josue', 'Medrano', 'Murillo', '85741341 ', 0);
INSERT INTO `vendedor` VALUES (23, NULL, 'Kerlint  dad', 'Josue', 'dasdas', 'gdfgdfgf', '85741341  ', 1);
INSERT INTO `vendedor` VALUES (24, NULL, 'Prueba vendedor', 'Prueba vendedor', 'Prueba vendedor', 'Prueba vendedor', '1234567689 ', 0);

-- ----------------------------
-- Table structure for ventas
-- ----------------------------
DROP TABLE IF EXISTS `ventas`;
CREATE TABLE `ventas`  (
  `idventas` int(0) NOT NULL AUTO_INCREMENT,
  `id_vendedor` int(0) NOT NULL,
  `id_cliente` int(0) NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NOT NULL,
  `descuento` decimal(10, 2) NOT NULL,
  `iva` decimal(10, 2) NOT NULL,
  `total` decimal(10, 2) NOT NULL,
  `estado` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `creado` datetime(0) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idventas`) USING BTREE,
  INDEX `ventas_vendedor_idx`(`id_vendedor`) USING BTREE,
  INDEX `ventas_cliente`(`id_cliente`) USING BTREE,
  CONSTRAINT `ventas_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`idcliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `ventas_vendedor` FOREIGN KEY (`id_vendedor`) REFERENCES `vendedor` (`idvendedor`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ventas
-- ----------------------------
INSERT INTO `ventas` VALUES (3, 1, NULL, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-21 02:05:21', 0);
INSERT INTO `ventas` VALUES (4, 1, NULL, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-21 02:10:23', 0);
INSERT INTO `ventas` VALUES (5, 1, NULL, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-21 02:13:06', 0);
INSERT INTO `ventas` VALUES (6, 1, NULL, 58.00, 0.00, 8.70, 66.70, 'Devolución aprobada', '2025-05-21 02:13:28', 0);
INSERT INTO `ventas` VALUES (7, 1, NULL, 58.00, 0.00, 0.00, 58.00, 'Pendiente', '2025-05-21 04:41:37', 0);
INSERT INTO `ventas` VALUES (8, 1, NULL, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-21 04:44:01', 0);
INSERT INTO `ventas` VALUES (9, 1, NULL, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-21 04:44:15', 0);
INSERT INTO `ventas` VALUES (10, 1, NULL, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-21 04:45:00', 0);
INSERT INTO `ventas` VALUES (11, 1, NULL, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-21 04:46:09', 0);
INSERT INTO `ventas` VALUES (12, 1, NULL, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-21 04:46:09', 0);
INSERT INTO `ventas` VALUES (13, 1, NULL, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-21 04:46:23', 0);
INSERT INTO `ventas` VALUES (14, 1, NULL, 58.00, 0.00, 8.70, 66.70, 'Devolución rechazada', '2025-05-21 04:50:21', 0);
INSERT INTO `ventas` VALUES (15, 1, NULL, 58.00, 0.00, 8.70, 66.70, 'Devolución aprobada', '2025-05-21 04:51:35', 0);
INSERT INTO `ventas` VALUES (16, 1, NULL, 116.00, 0.00, 17.40, 133.40, 'En Proceso', '2025-05-23 04:16:51', 0);
INSERT INTO `ventas` VALUES (17, 1, NULL, 290.00, 0.00, 43.50, 333.50, 'En Camino', '2025-05-26 19:17:28', 0);
INSERT INTO `ventas` VALUES (18, 1, 3, 58.00, 0.00, 8.70, 66.70, 'En Camino', '2025-05-26 19:19:07', 0);
INSERT INTO `ventas` VALUES (19, 22, NULL, 58.00, 0.00, 8.70, 66.70, 'Completado', '2025-05-27 01:49:42', 0);
INSERT INTO `ventas` VALUES (20, 22, NULL, 58.00, 0.00, 8.70, 66.70, 'Completado', '2025-05-27 03:42:09', 0);
INSERT INTO `ventas` VALUES (21, 22, 2, 58.00, 0.00, 8.70, 66.70, 'Devolución aprobada', '2025-05-27 04:35:59', 0);
INSERT INTO `ventas` VALUES (22, 22, NULL, 58.00, 0.00, 8.70, 66.70, 'Completado', '2025-05-27 04:47:41', 0);
INSERT INTO `ventas` VALUES (23, 22, 2, 58.00, 0.00, 8.70, 66.70, 'Completado', '2025-05-27 04:48:01', 0);
INSERT INTO `ventas` VALUES (24, 22, NULL, 174.00, 0.00, 26.10, 200.10, 'Entregado', '2025-05-27 21:07:05', 0);
INSERT INTO `ventas` VALUES (25, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Devolución rechazada', '2025-05-28 02:36:12', 0);
INSERT INTO `ventas` VALUES (26, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-28 05:08:32', 0);
INSERT INTO `ventas` VALUES (27, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-28 05:09:10', 0);
INSERT INTO `ventas` VALUES (28, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Devolución aprobada', '2025-05-28 05:09:35', 0);
INSERT INTO `ventas` VALUES (29, 22, NULL, 58.00, 0.00, 8.70, 66.70, 'Completado', '2025-05-28 05:10:44', 0);
INSERT INTO `ventas` VALUES (30, 22, NULL, 58.00, 0.00, 8.70, 66.70, 'Completado', '2025-05-28 05:11:56', 0);
INSERT INTO `ventas` VALUES (31, 22, NULL, 58.00, 0.00, 8.70, 66.70, 'Completado', '2025-05-28 05:12:25', 0);
INSERT INTO `ventas` VALUES (32, 22, NULL, 58.00, 0.00, 8.70, 66.70, 'Completado', '2025-05-28 05:13:33', 0);
INSERT INTO `ventas` VALUES (33, 22, 2, 58.00, 0.00, 8.70, 66.70, 'En Camino', '2025-05-28 19:42:30', 0);
INSERT INTO `ventas` VALUES (34, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-28 19:45:35', 0);
INSERT INTO `ventas` VALUES (35, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-28 19:46:32', 0);
INSERT INTO `ventas` VALUES (36, 1, 3, 58.00, 0.00, 8.70, 66.70, 'En Camino', '2025-05-28 19:47:15', 0);
INSERT INTO `ventas` VALUES (37, 22, 2, 58.00, 0.00, 8.70, 66.70, 'Completado', '2025-05-28 19:55:24', 0);
INSERT INTO `ventas` VALUES (38, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-29 03:44:16', 0);
INSERT INTO `ventas` VALUES (39, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-29 03:44:29', 0);
INSERT INTO `ventas` VALUES (40, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-29 03:45:10', 0);
INSERT INTO `ventas` VALUES (41, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-29 03:45:13', 0);
INSERT INTO `ventas` VALUES (42, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-29 03:45:13', 0);
INSERT INTO `ventas` VALUES (43, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-29 03:45:13', 0);
INSERT INTO `ventas` VALUES (44, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-29 03:45:14', 0);
INSERT INTO `ventas` VALUES (45, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-29 03:45:14', 0);
INSERT INTO `ventas` VALUES (46, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-29 03:45:14', 0);
INSERT INTO `ventas` VALUES (47, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-29 03:45:17', 0);
INSERT INTO `ventas` VALUES (48, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-29 03:45:42', 0);
INSERT INTO `ventas` VALUES (49, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-29 03:46:44', 0);
INSERT INTO `ventas` VALUES (50, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-29 03:47:59', 0);
INSERT INTO `ventas` VALUES (51, 1, 3, 58.00, 0.00, 8.70, 66.70, 'En Camino', '2025-05-29 03:48:10', 0);
INSERT INTO `ventas` VALUES (52, 1, 3, 58.00, 0.00, 8.70, 66.70, 'En Camino', '2025-05-29 04:09:19', 0);
INSERT INTO `ventas` VALUES (53, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-30 01:54:33', 0);
INSERT INTO `ventas` VALUES (54, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-30 01:55:18', 0);
INSERT INTO `ventas` VALUES (55, 1, 3, 58.00, 0.00, 8.70, 66.70, 'Pendiente', '2025-05-30 01:56:11', 0);
INSERT INTO `ventas` VALUES (56, 1, 3, 58.00, 0.00, 8.70, 66.70, 'En Proceso', '2025-05-30 01:56:24', 0);
INSERT INTO `ventas` VALUES (57, 22, NULL, 58.00, 0.00, 8.70, 66.70, 'Completado', '2025-05-30 02:02:00', 0);
INSERT INTO `ventas` VALUES (58, 1, 3, 58.00, 0.00, 8.70, 66.70, 'En Proceso', '2025-05-30 02:02:28', 0);
INSERT INTO `ventas` VALUES (59, 1, 3, 58.00, 0.00, 8.70, 66.70, 'En Proceso', '2025-05-30 02:02:57', 0);
INSERT INTO `ventas` VALUES (60, 1, 3, 58.00, 0.00, 8.70, 66.70, 'En Proceso', '2025-05-30 02:03:53', 0);
INSERT INTO `ventas` VALUES (61, 1, 3, 58.00, 0.00, 8.70, 66.70, 'En Proceso', '2025-05-30 02:11:44', 0);
INSERT INTO `ventas` VALUES (62, 1, 3, 58.00, 0.00, 8.70, 66.70, 'En Proceso', '2025-05-30 02:12:43', 0);
INSERT INTO `ventas` VALUES (63, 1, 3, 174.00, 0.00, 26.10, 200.10, 'En Proceso', '2025-05-30 18:26:11', 0);
INSERT INTO `ventas` VALUES (64, 1, 3, 116.00, 0.00, 17.40, 133.40, 'En Proceso', '2025-05-30 18:46:23', 0);
INSERT INTO `ventas` VALUES (65, 22, NULL, 116.00, 0.00, 17.40, 133.40, 'Completado', '2025-05-30 21:59:09', 0);
INSERT INTO `ventas` VALUES (66, 22, NULL, 58.00, 0.00, 8.70, 66.70, 'Completado', '2025-05-30 21:59:49', 0);
INSERT INTO `ventas` VALUES (67, 22, NULL, 58.00, 0.00, 8.70, 66.70, 'Completado', '2025-05-30 22:00:23', 0);
INSERT INTO `ventas` VALUES (68, 22, NULL, 58.00, 0.00, 8.70, 66.70, 'Completado', '2025-05-30 22:01:53', 0);

SET FOREIGN_KEY_CHECKS = 1;
