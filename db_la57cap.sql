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

 Date: 01/06/2025 12:22:50
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
  INDEX `fk_Clasificaciones_repartidor1_idx`(`repartidor_idrepartidor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categoria_producto
-- ----------------------------
INSERT INTO `categoria_producto` VALUES (1, ' ac99e5a11293ad23bf48e347a31d4f5f.jpg', 12, 'Celulares', 'No incluye daños por mal uso, caídas, humedad, modificaciones no autorizadas ni golpes. Para hacer válida la garantía, el equipo debe presentarse con su factura y sin alteraciones. El diagnóstico técnico determinará la validez del reclamo. No se realizan reembolsos, solo reparación o reemplazo según corresponda.', 1, 0, '1');
INSERT INTO `categoria_producto` VALUES (2, '4b28b4e37332f7bb7c5ed665cfc82f13.jpg', 0, 'Gorras', 'No aplica a daños por uso indebido, lavado incorrecto, exposición prolongada al sol, humedad, rasgaduras o alteraciones. Se requiere presentar la factura y el producto en buen estado. No se hacen devoluciones de dinero; se ofrece cambio por otro producto igual o similar si el reclamo es válido.', 0, 0, '1');
INSERT INTO `categoria_producto` VALUES (3, ' 7fa30da13c182f67ad229bc7caa8b66e.jpg', 1, 'Camisas Urbanas', 'La garantía cubre defectos de confección o costura por 30 días desde la fecha de compra. No aplica a daños por mal uso, lavados inadecuados, decoloración por exposición solar, planchado excesivo o alteraciones. Es obligatorio presentar la factura y el producto sin señales de uso indebido. No se hacen reembolsos, solo cambios por el mismo artículo o uno de igual valor si procede.', 1, 0, '1');

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES (1, NULL, ' .', '.', '.', '.', '.', '.', '.', 0);
INSERT INTO `cliente` VALUES (2, 4, 'Kerlint', 'Josue', 'Medrano', 'Murillo', '85741341', 'Ciudad Sandino', 'Managua ', 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of compra_detalles
-- ----------------------------
INSERT INTO `compra_detalles` VALUES (1, 20, 6400.00, 128000.00, 1, 1);
INSERT INTO `compra_detalles` VALUES (2, 20, 8746.00, 174920.00, 1, 2);
INSERT INTO `compra_detalles` VALUES (3, 20, 9849.00, 196980.00, 1, 3);
INSERT INTO `compra_detalles` VALUES (4, 20, 11872.00, 237440.00, 1, 4);
INSERT INTO `compra_detalles` VALUES (5, 20, 12607.00, 252140.00, 1, 5);
INSERT INTO `compra_detalles` VALUES (6, 20, 3045.51, 60910.20, 1, 7);
INSERT INTO `compra_detalles` VALUES (7, 20, 1800.00, 36000.00, 1, 8);
INSERT INTO `compra_detalles` VALUES (8, 20, 3581.06, 71621.20, 1, 9);
INSERT INTO `compra_detalles` VALUES (9, 30, 450.00, 13500.00, 2, 10);
INSERT INTO `compra_detalles` VALUES (10, 30, 650.00, 19500.00, 2, 11);
INSERT INTO `compra_detalles` VALUES (11, 30, 650.00, 19500.00, 2, 12);
INSERT INTO `compra_detalles` VALUES (12, 30, 650.00, 19500.00, 2, 13);
INSERT INTO `compra_detalles` VALUES (13, 30, 500.00, 15000.00, 2, 14);
INSERT INTO `compra_detalles` VALUES (14, 40, 700.00, 28000.00, 2, 15);
INSERT INTO `compra_detalles` VALUES (15, 40, 200.00, 8000.00, 3, 16);
INSERT INTO `compra_detalles` VALUES (16, 40, 200.00, 8000.00, 3, 17);
INSERT INTO `compra_detalles` VALUES (17, 40, 200.00, 8000.00, 3, 18);
INSERT INTO `compra_detalles` VALUES (18, 40, 200.00, 8000.00, 3, 19);
INSERT INTO `compra_detalles` VALUES (19, 40, 200.00, 8000.00, 3, 20);
INSERT INTO `compra_detalles` VALUES (20, 40, 200.00, 8000.00, 3, 21);
INSERT INTO `compra_detalles` VALUES (21, 40, 200.00, 8000.00, 3, 22);
INSERT INTO `compra_detalles` VALUES (22, 40, 200.00, 8000.00, 3, 23);
INSERT INTO `compra_detalles` VALUES (23, 40, 200.00, 8000.00, 3, 24);

-- ----------------------------
-- Table structure for compras
-- ----------------------------
DROP TABLE IF EXISTS `compras`;
CREATE TABLE `compras`  (
  `idCompras` int(0) NOT NULL AUTO_INCREMENT,
  `fecha_compra` datetime(0) NOT NULL,
  `total_compra` decimal(10, 2) NOT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `Proveedores_idProveedores` int(0) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idCompras`) USING BTREE,
  INDEX `fk_Compras_Proveedores1_idx`(`Proveedores_idProveedores`) USING BTREE,
  CONSTRAINT `fk_Compras_Proveedores1` FOREIGN KEY (`Proveedores_idProveedores`) REFERENCES `proveedores` (`idProveedores`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of compras
-- ----------------------------
INSERT INTO `compras` VALUES (1, '2025-06-01 17:01:51', 1158011.40, 'Todo en orden', 1, 0);
INSERT INTO `compras` VALUES (2, '2025-06-01 17:10:26', 115000.00, 'Todo en orden', 3, 0);
INSERT INTO `compras` VALUES (3, '2025-06-01 17:16:38', 72000.00, 'Todo en orden', 2, 0);

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
-- Records of detalles_ventas
-- ----------------------------
INSERT INTO `detalles_ventas` VALUES (1, 1, 1, 1, 7400.00);
INSERT INTO `detalles_ventas` VALUES (2, 1, 15, 1, 980.00);
INSERT INTO `detalles_ventas` VALUES (3, 2, 15, 1, 980.00);
INSERT INTO `detalles_ventas` VALUES (4, 3, 15, 1, 980.00);
INSERT INTO `detalles_ventas` VALUES (5, 4, 15, 1, 980.00);

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
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ventas_idventas` int(0) NOT NULL,
  `cliente_idcliente` int(0) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of inventario
-- ----------------------------
INSERT INTO `inventario` VALUES (1, 19, 5, '2025-06-01 11:38:28', 1);
INSERT INTO `inventario` VALUES (2, 20, 5, '2025-06-01 17:01:51', 2);
INSERT INTO `inventario` VALUES (3, 20, 5, '2025-06-01 17:01:51', 3);
INSERT INTO `inventario` VALUES (4, 20, 5, '2025-06-01 17:01:51', 4);
INSERT INTO `inventario` VALUES (5, 20, 5, '2025-06-01 17:01:51', 5);
INSERT INTO `inventario` VALUES (6, 20, 5, '2025-06-01 17:01:51', 7);
INSERT INTO `inventario` VALUES (7, 20, 5, '2025-06-01 17:01:51', 8);
INSERT INTO `inventario` VALUES (8, 20, 5, '2025-06-01 17:01:51', 9);
INSERT INTO `inventario` VALUES (9, 30, 5, '2025-06-01 17:10:26', 10);
INSERT INTO `inventario` VALUES (10, 30, 5, '2025-06-01 17:10:26', 11);
INSERT INTO `inventario` VALUES (11, 30, 5, '2025-06-01 17:10:26', 12);
INSERT INTO `inventario` VALUES (12, 30, 5, '2025-06-01 17:10:26', 13);
INSERT INTO `inventario` VALUES (13, 30, 5, '2025-06-01 17:10:26', 14);
INSERT INTO `inventario` VALUES (14, 36, 5, '2025-06-01 12:12:15', 15);
INSERT INTO `inventario` VALUES (15, 40, 5, '2025-06-01 17:16:38', 16);
INSERT INTO `inventario` VALUES (16, 40, 5, '2025-06-01 17:16:38', 17);
INSERT INTO `inventario` VALUES (17, 40, 5, '2025-06-01 17:16:38', 18);
INSERT INTO `inventario` VALUES (18, 40, 5, '2025-06-01 17:16:38', 19);
INSERT INTO `inventario` VALUES (19, 40, 5, '2025-06-01 17:16:38', 20);
INSERT INTO `inventario` VALUES (20, 40, 5, '2025-06-01 17:16:38', 21);
INSERT INTO `inventario` VALUES (21, 40, 5, '2025-06-01 17:16:38', 22);
INSERT INTO `inventario` VALUES (22, 40, 5, '2025-06-01 17:16:38', 23);
INSERT INTO `inventario` VALUES (23, 40, 5, '2025-06-01 17:16:38', 24);

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
-- Records of notificacion
-- ----------------------------
INSERT INTO `notificacion` VALUES (1, 'Nuevo pedido asignado', 'Se le ha asignado un nuevo pedido con dirección de entrega. Pedido #: 1', '2025-06-01 17:39:36', 3, 1);
INSERT INTO `notificacion` VALUES (2, 'Nuevo pedido asignado', 'Se le ha asignado un nuevo pedido con dirección de entrega. Pedido #: 2', '2025-06-01 17:51:09', 3, 1);
INSERT INTO `notificacion` VALUES (3, 'Nuevo pedido asignado', 'Se le ha asignado un nuevo pedido con dirección de entrega. Pedido #: 2', '2025-06-01 17:52:41', 3, 1);
INSERT INTO `notificacion` VALUES (4, 'Confirmación de pago entrega completada', 'Se ha recibido pago y la entrega ha sido completada para el pedido #2', '2025-06-01 17:52:59', 2, 0);
INSERT INTO `notificacion` VALUES (5, 'Confirmación de pago entrega completada', 'Se ha recibido pago y la entrega ha sido completada para el pedido #2', '2025-06-01 17:52:59', 1, 0);
INSERT INTO `notificacion` VALUES (6, 'Nuevo pedido asignado', 'Se le ha asignado un nuevo pedido con dirección de entrega. Pedido #: 3', '2025-06-01 17:54:44', 3, 1);
INSERT INTO `notificacion` VALUES (7, 'Confirmación de pago entrega completada', 'Se ha recibido pago y la entrega ha sido completada para el pedido #3', '2025-06-01 17:54:54', 2, 0);
INSERT INTO `notificacion` VALUES (8, 'Confirmación de pago entrega completada', 'Se ha recibido pago y la entrega ha sido completada para el pedido #3', '2025-06-01 17:54:54', 1, 0);
INSERT INTO `notificacion` VALUES (9, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente Kerlint Medrano', '2025-06-01 18:12:15', 1, 0);
INSERT INTO `notificacion` VALUES (10, 'Nueva Venta Registrada', 'Se ha registrado una nueva venta online para el cliente Kerlint Medrano. Por favor, revisar y atender la venta', '2025-06-01 18:12:15', 2, 0);
INSERT INTO `notificacion` VALUES (11, 'Pedido en proceso', 'Tu pedido ha sido atendido y pronto será asignado a un repartidor.', '2025-06-01 18:13:16', 4, 0);
INSERT INTO `notificacion` VALUES (12, 'Nuevo pedido asignado', 'Se le ha asignado un nuevo pedido con dirección de entrega. Pedido #: 4', '2025-06-01 18:13:25', 3, 0);
INSERT INTO `notificacion` VALUES (13, 'Confirmación de pago entrega completada', 'Se ha recibido pago y la entrega ha sido completada para el pedido #4', '2025-06-01 18:14:48', 2, 0);
INSERT INTO `notificacion` VALUES (14, 'Confirmación de pago entrega completada', 'Se ha recibido pago y la entrega ha sido completada para el pedido #4', '2025-06-01 18:14:48', 1, 0);

-- ----------------------------
-- Table structure for pedidos
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos`  (
  `idpedidos` int(0) NOT NULL AUTO_INCREMENT,
  `id_ventas` int(0) NOT NULL,
  `id_cliente` int(0) NULL DEFAULT NULL,
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
-- Records of pedidos
-- ----------------------------
INSERT INTO `pedidos` VALUES (1, 1, 1, 1, '2025-06-01 17:38:28', '2025-06-02', '13:15:00', 'Ciudad Sandino, Residencial San Eduviges Casa O-16 Primera Etapa', 'Persona a Recibir : KERLINT MEDRANO', 1, 1);
INSERT INTO `pedidos` VALUES (2, 2, 1, 1, '2025-06-01 17:50:50', '2025-06-02', '12:23:00', 'Ciudad Sandino, Residencial San Eduviges Casa O-16 Primera Etapa', 'Persona a Recibir : KERLINT MEDRANO', 1, 1);
INSERT INTO `pedidos` VALUES (3, 3, 1, 1, '2025-06-01 17:54:33', '2025-06-03', '02:23:00', 'Ciudad Sandino, Residencial San Eduviges Casa O-16 Primera Etapa', 'Persona a Recibir : KERLINT MEDRANO', 1, 1);
INSERT INTO `pedidos` VALUES (4, 4, 2, 1, '2025-06-01 18:12:15', '2025-06-01', '13:11:00', 'Ciudad Sandino', '', 1, 1);

-- ----------------------------
-- Table structure for producto
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto`  (
  `idproducto` int(0) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(0) NOT NULL,
  `codigo_producto` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombre_producto` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `precio` decimal(10, 2) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  `Foto` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idproducto`) USING BTREE,
  INDEX `producto_categoria_idx`(`id_categoria`) USING BTREE,
  CONSTRAINT `producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_producto` (`idcategoria_producto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of producto
-- ----------------------------
INSERT INTO `producto` VALUES (1, 1, 'SAM-01-0001', 'Samsung Galaxy A26 5G', 'Tecnología de pantalla: Super AMOLED.\r\nTamaño de pantalla: 6.7 pulgadas.\r\nResolución de pantalla: 1080 x 2340 píxeles.\r\nCámara principal: 50MP + 8MP + 2MP.\r\nCámara frontal: 13 MP.\r\nMemoria interna: 128 GB.\r\n', 7400.00, 0, '770219b2c742dd144cebe256cb8fc0e4.jpg ');
INSERT INTO `producto` VALUES (2, 1, 'SAM-01-0002', 'Samsung Galaxy A36 5G 6 RAM / 128GB', 'Octa-Core (2.4GHz-1.8GHz)\r\n256 GB | Disponible: 233.9 GB.\r\nFrontal 12 MP / Trasera 50+8+5 MP.\r\n6.7\\\" + FHD+ - Super AMOLED.', 9746.00, 0, 'fa9aed853d0c15bc6e7656925978f22e.jpg ');
INSERT INTO `producto` VALUES (3, 1, 'SAM-01-0003', 'Samsung Galaxy A36 5G 8 RAM / 256GB', 'Octa-Core (2.4GHz-1.8GHz) 256 GB | Disponible: 233.9 GB. Frontal 12 MP / Trasera 50+8+5 MP. 6.7\\\" + FHD+ - Super AMOLED.', 10849.32, 0, '24a38941d777c377f62be878bddddc38.jpg ');
INSERT INTO `producto` VALUES (4, 1, 'SAM-01-0004', 'Samsung Galaxy A56 5G 8 RAM / 128GB', 'Sistema operativo: Android. Cámara Principal: 50MP + 12MP + 5MP.Cámara Frontal: 12MP.Memoria Externa: Si. Memoria RAM: 8GB + 8GB RAM Plus. Almacenamiento interno: 256GB. Procesador: Exynos 1580. Velocidad: Octa Core 2.9Ghz, 2.6Ghz, 1.9Ghz.', 12872.07, 0, 'adb5b153af9c9211a1ffdabccba4a055.jpg ');
INSERT INTO `producto` VALUES (5, 1, 'SAM-01-0005', 'Samsung Galaxy A56 5G 8 RAM / 256GB', 'Sistema operativo: Android. Cámara Principal: 50MP + 12MP + 5MP.Cámara Frontal: 12MP.Memoria Externa: Si. Memoria RAM: 8GB + 8GB RAM Plus. Almacenamiento interno: 256GB. Procesador: Exynos 1580. Velocidad: Octa Core 2.9Ghz, 2.6Ghz, 1.9Ghz.', 13607.62, 0, '5c7093394bf6d7e7ae8786b0f6ee26e0.jpg ');
INSERT INTO `producto` VALUES (6, 1, 'SAM-01-0006', 'Samsung Galaxy M55 5G 8 RAM / 256GB', 'Cámara trasera - Resolución (múltiple) 50 MP + 8 MP + 2 MP.\r\nCámara trasera - Número F (múltiple) F1.8, F2.2, F2.4.\r\nCámara trasera - Autoenfoque. Sí\r\nCámara trasera - OIS. Sí\r\nZoom de cámara trasera. Zoom digital de hasta 10x.\r\nCámara frontal - Resolución. 50.0 MP.\r\nCámara frontal - Número F. F2.4.\r\nCámara frontal - Autoenfoque.', 10481.54, 0, '0f652364e648f9cf60302a832f4a8c1a.jpg ');
INSERT INTO `producto` VALUES (7, 1, 'INF-01-0007', 'Infinix Hot 50 Pro 16 GB / 256 GB', 'CPU: Helio G81.\r\nRAM: 4GB.\r\nAlmacenamiento: 256GB.\r\nPantalla Tamaño: 6,7″\r\nPantalla Resolución: 720 x 1600 px.\r\nBatería: 5000 mAh.\r\nCámara Trasera: 48MP.\r\nCámara Frontal: 8MP.', 4045.51, 0, 'abfe784899ef5ebeb9f709e3da583d40.jpg ');
INSERT INTO `producto` VALUES (8, 1, 'INF-01-0008', 'Infinix Smart 9 6GB / 128 GB', 'Pantalla: 6.7″, 720 x 1600 pixels.\r\nProcesador: Mediatek Helio G81.\r\nRAM: 3GB/6GB.\r\nAlmacenamiento: 128GB/64GB.\r\nExpansión: microSD.\r\nCámara: Dual, 13MP+8MP.\r\nBatería: 5000 mAh.\r\nOS: Android 14 Go.', 2800.00, 0, 'e759a0bcd6bf8b67d3238a35e821e5b1.jpg ');
INSERT INTO `producto` VALUES (9, 1, 'INF-01-0009', 'Infinix Hot 50 16 GB / 256 GB', 'DISPLAY: 6.78″ IPS LCD FHD+, 120Hz.\r\nCHIPSET: Mediatek Helio G100.\r\nMEMORY INTERNAL: 256GB 8GB RAM, (hasta 16GB Extra RAM)\r\nMAIN CAMERA: 50 MP, f/1.6, (wide) + Q with Quad Flash Light.\r\nSELFIE CAMERA: 8 MP, with Dual Flash Light.\r\nBATTERY: Li-Po 5000 mAh, 18W.\r\nFEATURES/SENSORS: Fingerprint (side-mounted)', 4781.06, 0, '127906249026c9582f811b8ff262d2b7.jpg');
INSERT INTO `producto` VALUES (10, 2, 'GOR-02-0010', 'Gorra White de Cincinnati', '59FIFTY es la gorra oficial en el campo de las Grandes Ligas de Béisbol y es usada por todos los jugadores de las Grandes Ligas. Con esta versión de moda del 59FIFTY puedes mostrar el orgullo de tu equipo con estilo. Diseñado con un logotipo oficial del equipo bordado (elevado) en la parte delantera y logotipo cosido de la Major League Baseball en la parte trasera. Ajustado, espalda cerrada.\r\n', 650.00, 0, '8164469f7ef2f260ff611314d88a87e3.jpg ');
INSERT INTO `producto` VALUES (11, 2, 'NEW-02-0011', 'New EraDe México 59 Fifty Blanco / Azul 7 3/8', 'La gorra New Era Ediciones México 59 Fifty es una pieza icónica que combina estilo y tradición. Esta gorra es perfecta para quienes buscan un accesorio que complemente su look urbano y moderno. Su diseño exclusivo rinde homenaje a la cultura mexicana, convirtiéndola en un elemento esencial para los amantes de la moda y el deporte.', 800.00, 0, 'aa387082ead32ad3a8c960d4a5b6bc3b.jpg ');
INSERT INTO `producto` VALUES (12, 2, 'GOR-02-0012', 'Gorra de Philadelphia Phillies Campeones', '¡Los Phillies se dirigen a la Serie Mundial! Celebra con esta gorra New Era 9FORTY de Philadelphia Phillies Campeones de la Liga Nacional la cual presenta un script de World Series 2022 a juego con el logo de los Phillies y un parche de MLB League Champs 2022 en la parte trasera. Cómprala ya.', 800.00, 0, '405574f5ca8b6bdfc2370bfb1a35b7d5.jpg ');
INSERT INTO `producto` VALUES (13, 2, 'GOR-02-0013', 'Gorra de Juego Toronto Blue Jays AC', 'Usa lo que usan los jugadores! La gorra ajustada Toronto Blue Jays Authentic Collection 59FIFTY cuenta con una fabricación de color del equipo con un logotipo bordado de Blue Jays en los paneles frontales y un MLB Batterman bordado en la parte trasera.', 800.00, 0, '32e6e6f2c67408a19cf37cebace2750a.jpg ');
INSERT INTO `producto` VALUES (14, 2, 'GOR-02-0014', 'Gorra de los angeles dodger Father', 'Complementa tu outfit con esta gorra 39Thirty Los Angeles Dodgers Fathers Day Azul la cual presenta el logotipo del equipo bordado en los paneles frontales que te hará lucir genial. Sus materiales y forma única hacen de esta colección la mejor elección. No te quedes sin la tuya. ', 750.00, 0, 'ad4680a3e5d3b4618a978cc016fbb029.jpg ');
INSERT INTO `producto` VALUES (15, 2, 'GOR-02-0015', 'Gorra de san miguel arcangel', 'Las gorras pueden tener diseños que incluyen la imagen de San Miguel Arcángel, su escudo con la inscripción \\\"Quis ut Deus?\\\" (¿Quién como Dios?), o símbolos que representan su poder y protección.', 980.00, 0, 'bb71f36b52c3bdb6befc5d6d2b73358d.jpg ');
INSERT INTO `producto` VALUES (16, 3, 'CAM-03-0016', 'Camisas Los Angeles 23 Roja/Blanca', 'Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.', 430.00, 0, '443e87c80024aeee58f9deef1dda8f19.jpg ');
INSERT INTO `producto` VALUES (17, 3, 'CAM-03-0017', 'Camisas Chicago Negra', 'Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.', 430.00, 0, 'a5852a762c62190f75dec948e8830faa.jpg ');
INSERT INTO `producto` VALUES (18, 3, 'CAM-03-0018', 'Camisas Los Angeles 23 Blanca', 'Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.', 430.00, 0, '6091a47f04c6652e07985bea58832b45.jpg ');
INSERT INTO `producto` VALUES (19, 3, 'CAM-03-0019', 'Camisas Los Angeles 23 Celeste', 'Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.', 430.00, 0, '36a66bc9a56af7205a9d00287a4413ac.jpg ');
INSERT INTO `producto` VALUES (20, 3, 'CAM-03-0020', 'Camisa PatoLucas Hip Roja', 'Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.', 430.00, 0, 'a9d709258efee06bd3e384f023331668.jpg ');
INSERT INTO `producto` VALUES (21, 3, 'CAM-03-0021', 'Camisa PatoLucas Hip Negra', 'Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.', 430.00, 0, 'e3a00e2f3413bd597f6c9060403a3d5d.jpg ');
INSERT INTO `producto` VALUES (22, 3, 'CAM-03-0022', 'Camisa PatoLucas Hip Blanca', 'Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.', 430.00, 0, '123b8271073765084428c10b00b18a79.jpg ');
INSERT INTO `producto` VALUES (23, 3, 'CAM-03-0023', 'Camisa Power Blanca', 'Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.', 430.00, 0, '372e0645e21f220724994f3f2e0e5096.jpg ');
INSERT INTO `producto` VALUES (24, 3, 'CAM-03-0024', 'Camisa Power Amarilla', 'Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.', 430.00, 0, '88241dce4784eafcf5012024b4b312d0.jpg ');

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proveedores
-- ----------------------------
INSERT INTO `proveedores` VALUES (1, ' TIENDA SOLIS', 'JUAN ALVARES', '1234567890', 'Managua', 'nacional ', 0);
INSERT INTO `proveedores` VALUES (2, ' Camisas', 'Roberto Rojas', '1234567890', 'Managua', 'nacional ', 0);
INSERT INTO `proveedores` VALUES (3, ' New Era Gorra', 'Javier Lopez', '1234567890', 'Mexico', 'extranjera ', 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of repartidor
-- ----------------------------
INSERT INTO `repartidor` VALUES (1, 3, 'repartidor1', 'repartidor1', 'repartidor1', 'repartidor1', '1234567890 ', 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 1, '4fab6662fe79843fdffa9013be93884a.jpg', 'ADMIN', '$2y$10$5C2QP0paeEA8n4ZCgJkn3eWRj7GoUbo5JoQuYcTeK5PA19r9D2M22', 'kmurillojosue75@gmail.com', 1, '68362efc9b058', '2025-05-13 05:56:18', '2025-05-13 05:56:18', 0, 0);
INSERT INTO `usuario` VALUES (2, 2, '192f83ce8edf21366091276d27fced44.jpg', 'USERVendedor', '$2y$10$ro2hUkTbfirARtyKEBT6HuuJgvYoIf2Gt8Y99zkk0DCZzWHW1vFZm', 'vendedor@gmail.com', 1, '683c833f09269', '2025-06-01 16:43:42', '2025-06-01 16:43:42', 0, 0);
INSERT INTO `usuario` VALUES (3, 3, '5be1f53a3378ea1654313de7db038499.jpg', 'USERRepartidor', '$2y$10$8L6c/ans81EMdHc7qmfIXudJT/wf537yuQ4R4NeIrDos140geA3/G', 'repartidor@gmail.com', 1, '683c91461229e', '2025-06-01 16:51:00', '2025-06-01 16:51:00', 0, 0);
INSERT INTO `usuario` VALUES (4, 4, '91a687274f27da8672fbab092ed2b36a.jpg', 'KJ', '$2y$10$dEbjmsggUyFtS9cI9XnWPen8EyLSzRAJw0iTfyCRklhQXFfG1mk8i', 'kj@gmail.com', 1, '683c979c4687c', '2025-06-01 18:10:36', '2025-06-01 18:10:36', 0, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vendedor
-- ----------------------------
INSERT INTO `vendedor` VALUES (1, 2, 'Vendedor1', 'Vendedor1', 'Vendedor1', 'Vendedor1', '1234567890 ', 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ventas
-- ----------------------------
INSERT INTO `ventas` VALUES (1, 1, NULL, 8380.00, 0.00, 1257.00, 9637.00, 'Entregado', '2025-06-01 17:38:28', 0);
INSERT INTO `ventas` VALUES (2, 1, NULL, 980.00, 0.00, 147.00, 1127.00, 'Entregado', '2025-06-01 17:50:50', 0);
INSERT INTO `ventas` VALUES (3, 1, NULL, 980.00, 0.00, 147.00, 1127.00, 'Entregado', '2025-06-01 17:54:33', 0);
INSERT INTO `ventas` VALUES (4, 1, 2, 980.00, 0.00, 147.00, 1127.00, 'Entregado', '2025-06-01 18:12:15', 0);

SET FOREIGN_KEY_CHECKS = 1;
