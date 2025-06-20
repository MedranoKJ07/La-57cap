/*
 Navicat Premium Data Transfer

 Source Server         : MySqlLocal
 Source Server Type    : MySQL
 Source Server Version : 80040
 Source Host           : localhost:3306
 Source Schema         : db_la57cap

 Target Server Type    : MySQL
 Target Server Version : 80040
 File Encoding         : 65001
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 Date: 18/06/2025 09:39:40
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for calificaciones
-- ----------------------------
DROP TABLE IF EXISTS `calificaciones`;
CREATE TABLE `calificaciones`  (
  `idcalificaciones` int(0) NOT NULL AUTO_INCREMENT,
  `puntuacion` int(0) NULL DEFAULT NULL,
  `comentario` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fecha_clasificacion` datetime(0) NULL DEFAULT NULL,
  `pedidos_idpedidos` int(0) NOT NULL,
  `cliente_idcliente` int(0) NOT NULL,
  `repartidor_idrepartidor` int(0) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idcalificaciones`) USING BTREE,
  INDEX `fk_Clasificaciones_pedidos1_idx`(`pedidos_idpedidos`) USING BTREE,
  INDEX `fk_Clasificaciones_cliente1_idx`(`cliente_idcliente`) USING BTREE,
  INDEX `fk_Clasificaciones_repartidor1_idx`(`repartidor_idrepartidor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for categoria_producto
-- ----------------------------
DROP TABLE IF EXISTS `categoria_producto`;
CREATE TABLE `categoria_producto`  (
  `idcategoria_producto` int(0) NOT NULL AUTO_INCREMENT,
  `foto` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `garantias_meses` int(0) NOT NULL,
  `titulo` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `politica_garantia` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tiene_garantia` tinyint(0) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  `estado` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idcategoria_producto`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente`  (
  `idcliente` int(0) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(0) NULL DEFAULT NULL,
  `p_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `s_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `p_apellido` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `s_apellido` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `n_telefono` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `direccion` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Municipio` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idcliente`) USING BTREE,
  INDEX `cliente_usuario_idx`(`id_usuario`) USING BTREE,
  CONSTRAINT `cliente_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES (1, NULL, 'Cliente', 'Generico', '.', '.', '.', '.', '.', 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for compras
-- ----------------------------
DROP TABLE IF EXISTS `compras`;
CREATE TABLE `compras`  (
  `idCompras` int(0) NOT NULL AUTO_INCREMENT,
  `fecha_compra` datetime(0) NOT NULL,
  `total_compra` decimal(10, 2) NOT NULL,
  `observaciones` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `Proveedores_idProveedores` int(0) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idCompras`) USING BTREE,
  INDEX `fk_Compras_Proveedores1_idx`(`Proveedores_idProveedores`) USING BTREE,
  CONSTRAINT `fk_Compras_Proveedores1` FOREIGN KEY (`Proveedores_idProveedores`) REFERENCES `proveedores` (`idProveedores`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for devolucion_detalles
-- ----------------------------
DROP TABLE IF EXISTS `devolucion_detalles`;
CREATE TABLE `devolucion_detalles`  (
  `idDevolucion_Detalles` int(0) NOT NULL AUTO_INCREMENT,
  `cantidad` int(0) NOT NULL,
  `Estado_Producto` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `producto_idproducto` int(0) NOT NULL,
  `Devoluciones_idDevoluciones` int(0) NOT NULL,
  PRIMARY KEY (`idDevolucion_Detalles`) USING BTREE,
  INDEX `fk_Devolucion_Detalles_producto1_idx`(`producto_idproducto`) USING BTREE,
  INDEX `fk_Devolucion_Detalles_Devoluciones1_idx`(`Devoluciones_idDevoluciones`) USING BTREE,
  CONSTRAINT `fk_Devolucion_Detalles_Devoluciones1` FOREIGN KEY (`Devoluciones_idDevoluciones`) REFERENCES `devoluciones` (`idDevoluciones`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_Devolucion_Detalles_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for devoluciones
-- ----------------------------
DROP TABLE IF EXISTS `devoluciones`;
CREATE TABLE `devoluciones`  (
  `idDevoluciones` int(0) NOT NULL AUTO_INCREMENT,
  `fecha_solicitud` datetime(0) NOT NULL,
  `motivo` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Aprobado` tinyint(0) NOT NULL,
  `tipo_reembolso` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `observaciones` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ventas_idventas` int(0) NOT NULL,
  `cliente_idcliente` int(0) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  `Estado` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`idDevoluciones`) USING BTREE,
  INDEX `fk_Devoluciones_ventas1_idx`(`ventas_idventas`) USING BTREE,
  INDEX `fk_Devoluciones_cliente1_idx`(`cliente_idcliente`) USING BTREE,
  CONSTRAINT `fk_Devoluciones_cliente1` FOREIGN KEY (`cliente_idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_Devoluciones_ventas1` FOREIGN KEY (`ventas_idventas`) REFERENCES `ventas` (`idventas`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for notificacion
-- ----------------------------
DROP TABLE IF EXISTS `notificacion`;
CREATE TABLE `notificacion`  (
  `idnotificacion` int(0) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `creada_fecha` datetime(0) NOT NULL,
  `usuario_idusuario` int(0) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idnotificacion`) USING BTREE,
  INDEX `fk_notificacion_usuario1_idx`(`usuario_idusuario`) USING BTREE,
  CONSTRAINT `fk_notificacion_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

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
  `direccion_entregar` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `comentarios` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estado` tinyint(0) NULL DEFAULT NULL,
  `pago_confirmado` tinyint(0) NULL DEFAULT NULL,
  PRIMARY KEY (`idpedidos`) USING BTREE,
  INDEX `pedido_cliente_idx`(`id_cliente`) USING BTREE,
  INDEX `pedido_repartidor_idx`(`id_repartidor`) USING BTREE,
  INDEX `pedido_ventas_idx`(`id_ventas`) USING BTREE,
  CONSTRAINT `pedido_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`idcliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pedido_repartidor` FOREIGN KEY (`id_repartidor`) REFERENCES `repartidor` (`idrepartidor`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pedido_ventas` FOREIGN KEY (`id_ventas`) REFERENCES `ventas` (`idventas`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for producto
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto`  (
  `idproducto` int(0) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(0) NOT NULL,
  `codigo_producto` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombre_producto` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `precio` decimal(10, 2) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  `Foto` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idproducto`) USING BTREE,
  INDEX `producto_categoria_idx`(`id_categoria`) USING BTREE,
  CONSTRAINT `producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_producto` (`idcategoria_producto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for proveedores
-- ----------------------------
DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE `proveedores`  (
  `idProveedores` int(0) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contacto` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `direccion` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nacionalidad` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idProveedores`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for repartidor
-- ----------------------------
DROP TABLE IF EXISTS `repartidor`;
CREATE TABLE `repartidor`  (
  `idrepartidor` int(0) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(0) NULL DEFAULT NULL,
  `p_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `s_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `p_apellido` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `s_apellido` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `n_telefono` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idrepartidor`) USING BTREE,
  INDEX `repartidor_usuario_idx`(`id_usuario`) USING BTREE,
  CONSTRAINT `vendedor_usuario00` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `idroles` int(0) NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`idroles`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;


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
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_roles` int(11) NOT NULL,
  `f_perfil` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `userName` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `confirmado` tinyint(1) NULL DEFAULT NULL,
  `token` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Creado_Fecha` datetime(0) NOT NULL,
  `Cambiado_Fecha` datetime(0) NOT NULL,
  `db_rol` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `eliminado` tinyint(4) NULL DEFAULT 0,
  `intentos_fallidos` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`idusuario`) USING BTREE,
  INDEX `usuario_roles_idx`(`id_roles`) USING BTREE,
  CONSTRAINT `usuario_roles` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`idroles`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 1, '4fab6662fe79843fdffa9013be93884a.jpg', 'ADMIN', '$2y$10$5C2QP0paeEA8n4ZCgJkn3eWRj7GoUbo5JoQuYcTeK5PA19r9D2M22', 'kmurillojosue75@gmail.com', 1, '68362efc9b058', '2025-05-13 05:56:18', '2025-05-13 05:56:18','admin', 0, 0);

-- ----------------------------
-- Table structure for vendedor
-- ----------------------------
DROP TABLE IF EXISTS `vendedor`;
CREATE TABLE `vendedor`  (
  `idvendedor` int(0) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(0) NULL DEFAULT NULL,
  `p_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `s_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `p_apellido` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `s_apellido` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `n_telefono` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idvendedor`) USING BTREE,
  INDEX `vendedor_usuario_idx`(`id_usuario`) USING BTREE,
  CONSTRAINT `vendedor_usuario0` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

INSERT INTO `vendedor` VALUES (1, NULL, 'Vendedor', 'Online', '.', '.', '.', 0);

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
  `estado` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `creado` datetime(0) NOT NULL,
  `eliminado` tinyint(0) NULL DEFAULT 0,
  PRIMARY KEY (`idventas`) USING BTREE,
  INDEX `ventas_vendedor_idx`(`id_vendedor`) USING BTREE,
  INDEX `ventas_cliente`(`id_cliente`) USING BTREE,
  CONSTRAINT `ventas_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`idcliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `ventas_vendedor` FOREIGN KEY (`id_vendedor`) REFERENCES `vendedor` (`idvendedor`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

INSERT INTO `categoria_producto` VALUES (1,' ac99e5a11293ad23bf48e347a31d4f5f.jpg',12,'Celulares','No incluye daños por mal uso, caídas, humedad, modificaciones no autorizadas ni golpes. Para hacer válida la garantía, el equipo debe presentarse con su factura y sin alteraciones. El diagnóstico técnico determinará la validez del reclamo. No se realizan reembolsos, solo reparación o reemplazo según corresponda.',1,0,'1'),(2,'4b28b4e37332f7bb7c5ed665cfc82f13.jpg',0,'Gorras','No aplica a daños por uso indebido, lavado incorrecto, exposición prolongada al sol, humedad, rasgaduras o alteraciones. Se requiere presentar la factura y el producto en buen estado. No se hacen devoluciones de dinero; se ofrece cambio por otro producto igual o similar si el reclamo es válido.',0,0,'1'),(3,' 7fa30da13c182f67ad229bc7caa8b66e.jpg',1,'Camisas Urbanas','La garantía cubre defectos de confección o costura por 30 días desde la fecha de compra. No aplica a daños por mal uso, lavados inadecuados, decoloración por exposición solar, planchado excesivo o alteraciones. Es obligatorio presentar la factura y el producto sin señales de uso indebido. No se hacen reembolsos, solo cambios por el mismo artículo o uno de igual valor si procede.',1,0,'1');

INSERT INTO `compra_detalles` VALUES (1,20,6400.00,128000.00,1,1),(2,20,8746.00,174920.00,1,2),(3,20,9849.00,196980.00,1,3),(4,20,11872.00,237440.00,1,4),(5,20,12607.00,252140.00,1,5),(6,20,3045.51,60910.20,1,7),(7,20,1800.00,36000.00,1,8),(8,20,3581.06,71621.20,1,9),(9,30,450.00,13500.00,2,10),(10,30,650.00,19500.00,2,11),(11,30,650.00,19500.00,2,12),(12,30,650.00,19500.00,2,13),(13,30,500.00,15000.00,2,14),(14,40,700.00,28000.00,2,15),(15,40,200.00,8000.00,3,16),(16,40,200.00,8000.00,3,17),(17,40,200.00,8000.00,3,18),(18,40,200.00,8000.00,3,19),(19,40,200.00,8000.00,3,20),(20,40,200.00,8000.00,3,21),(21,40,200.00,8000.00,3,22),(22,40,200.00,8000.00,3,23),(23,40,200.00,8000.00,3,24),(24,10,600.00,6000.00,4,24);
INSERT INTO `inventario` VALUES (1,18,5,'2025-06-05 14:55:21',1),(2,20,5,'2025-06-01 17:01:51',2),(3,20,5,'2025-06-01 17:01:51',3),(4,20,5,'2025-06-01 17:01:51',4),(5,20,5,'2025-06-01 17:01:51',5),(6,20,5,'2025-06-01 17:01:51',7),(7,20,5,'2025-06-01 17:01:51',8),(8,20,5,'2025-06-01 17:01:51',9),(9,30,5,'2025-06-01 17:10:26',10),(10,30,5,'2025-06-01 17:10:26',11),(11,30,5,'2025-06-01 17:10:26',12),(12,30,5,'2025-06-01 17:10:26',13),(13,29,5,'2025-06-05 14:58:21',14),(14,36,5,'2025-06-01 12:12:15',15),(15,40,5,'2025-06-01 17:16:38',16),(16,40,5,'2025-06-01 17:16:38',17),(17,40,5,'2025-06-01 17:16:38',18),(18,40,5,'2025-06-01 17:16:38',19),(19,40,5,'2025-06-01 17:16:38',20),(20,40,5,'2025-06-01 17:16:38',21),(21,40,5,'2025-06-01 17:16:38',22),(22,40,5,'2025-06-01 17:16:38',23),(23,15,5,'2025-06-05 21:12:19',24);
INSERT INTO `compras` VALUES (1,'2025-06-01 17:01:51',1158011.40,'Todo en orden',1,0),(2,'2025-06-01 17:10:26',115000.00,'Todo en orden',3,0),(3,'2025-06-01 17:16:38',72000.00,'Todo en orden',2,0),(4,'2025-06-05 21:12:19',6000.00,'Todo bien',2,0);
INSERT INTO `producto` VALUES (1,1,'SAM-01-0001','Samsung Galaxy A26 5G','Tecnología de pantalla: Super AMOLED.\r\nTamaño de pantalla: 6.7 pulgadas.\r\nResolución de pantalla: 1080 x 2340 píxeles.\r\nCámara principal: 50MP + 8MP + 2MP.\r\nCámara frontal: 13 MP.\r\nMemoria interna: 128 GB.\r\n',7400.00,0,'770219b2c742dd144cebe256cb8fc0e4.jpg '),(2,1,'SAM-01-0002','Samsung Galaxy A36 5G 6 RAM / 128GB','Octa-Core (2.4GHz-1.8GHz)\r\n256 GB | Disponible: 233.9 GB.\r\nFrontal 12 MP / Trasera 50+8+5 MP.\r\n6.7\\\" + FHD+ - Super AMOLED.',9746.00,0,'fa9aed853d0c15bc6e7656925978f22e.jpg '),(3,1,'SAM-01-0003','Samsung Galaxy A36 5G 8 RAM / 256GB','Octa-Core (2.4GHz-1.8GHz) 256 GB | Disponible: 233.9 GB. Frontal 12 MP / Trasera 50+8+5 MP. 6.7\\\" + FHD+ - Super AMOLED.',10849.32,0,'24a38941d777c377f62be878bddddc38.jpg '),(4,1,'SAM-01-0004','Samsung Galaxy A56 5G 8 RAM / 128GB','Sistema operativo: Android. Cámara Principal: 50MP + 12MP + 5MP.Cámara Frontal: 12MP.Memoria Externa: Si. Memoria RAM: 8GB + 8GB RAM Plus. Almacenamiento interno: 256GB. Procesador: Exynos 1580. Velocidad: Octa Core 2.9Ghz, 2.6Ghz, 1.9Ghz.',12872.07,0,'adb5b153af9c9211a1ffdabccba4a055.jpg '),(5,1,'SAM-01-0005','Samsung Galaxy A56 5G 8 RAM / 256GB','Sistema operativo: Android. Cámara Principal: 50MP + 12MP + 5MP.Cámara Frontal: 12MP.Memoria Externa: Si. Memoria RAM: 8GB + 8GB RAM Plus. Almacenamiento interno: 256GB. Procesador: Exynos 1580. Velocidad: Octa Core 2.9Ghz, 2.6Ghz, 1.9Ghz.',13607.62,0,'5c7093394bf6d7e7ae8786b0f6ee26e0.jpg '),(6,1,'SAM-01-0006','Samsung Galaxy M55 5G 8 RAM / 256GB','Cámara trasera - Resolución (múltiple) 50 MP + 8 MP + 2 MP.\r\nCámara trasera - Número F (múltiple) F1.8, F2.2, F2.4.\r\nCámara trasera - Autoenfoque. Sí\r\nCámara trasera - OIS. Sí\r\nZoom de cámara trasera. Zoom digital de hasta 10x.\r\nCámara frontal - Resolución. 50.0 MP.\r\nCámara frontal - Número F. F2.4.\r\nCámara frontal - Autoenfoque.',10481.54,0,'0f652364e648f9cf60302a832f4a8c1a.jpg '),(7,1,'INF-01-0007','Infinix Hot 50 Pro 16 GB / 256 GB','CPU: Helio G81.\r\nRAM: 4GB.\r\nAlmacenamiento: 256GB.\r\nPantalla Tamaño: 6,7″\r\nPantalla Resolución: 720 x 1600 px.\r\nBatería: 5000 mAh.\r\nCámara Trasera: 48MP.\r\nCámara Frontal: 8MP.',4045.51,0,'abfe784899ef5ebeb9f709e3da583d40.jpg '),(8,1,'INF-01-0008','Infinix Smart 9 6GB / 128 GB','Pantalla: 6.7″, 720 x 1600 pixels.\r\nProcesador: Mediatek Helio G81.\r\nRAM: 3GB/6GB.\r\nAlmacenamiento: 128GB/64GB.\r\nExpansión: microSD.\r\nCámara: Dual, 13MP+8MP.\r\nBatería: 5000 mAh.\r\nOS: Android 14 Go.',2800.00,0,'e759a0bcd6bf8b67d3238a35e821e5b1.jpg '),(9,1,'INF-01-0009','Infinix Hot 50 16 GB / 256 GB','DISPLAY: 6.78″ IPS LCD FHD+, 120Hz.\r\nCHIPSET: Mediatek Helio G100.\r\nMEMORY INTERNAL: 256GB 8GB RAM, (hasta 16GB Extra RAM)\r\nMAIN CAMERA: 50 MP, f/1.6, (wide) + Q with Quad Flash Light.\r\nSELFIE CAMERA: 8 MP, with Dual Flash Light.\r\nBATTERY: Li-Po 5000 mAh, 18W.\r\nFEATURES/SENSORS: Fingerprint (side-mounted)',4781.06,0,'127906249026c9582f811b8ff262d2b7.jpg'),(10,2,'GOR-02-0010','Gorra White de Cincinnati','59FIFTY es la gorra oficial en el campo de las Grandes Ligas de Béisbol y es usada por todos los jugadores de las Grandes Ligas. Con esta versión de moda del 59FIFTY puedes mostrar el orgullo de tu equipo con estilo. Diseñado con un logotipo oficial del equipo bordado (elevado) en la parte delantera y logotipo cosido de la Major League Baseball en la parte trasera. Ajustado, espalda cerrada.\r\n',650.00,0,'8164469f7ef2f260ff611314d88a87e3.jpg '),(11,2,'NEW-02-0011','New EraDe México 59 Fifty Blanco / Azul 7 3/8','La gorra New Era Ediciones México 59 Fifty es una pieza icónica que combina estilo y tradición. Esta gorra es perfecta para quienes buscan un accesorio que complemente su look urbano y moderno. Su diseño exclusivo rinde homenaje a la cultura mexicana, convirtiéndola en un elemento esencial para los amantes de la moda y el deporte.',800.00,0,'aa387082ead32ad3a8c960d4a5b6bc3b.jpg '),(12,2,'GOR-02-0012','Gorra de Philadelphia Phillies Campeones','¡Los Phillies se dirigen a la Serie Mundial! Celebra con esta gorra New Era 9FORTY de Philadelphia Phillies Campeones de la Liga Nacional la cual presenta un script de World Series 2022 a juego con el logo de los Phillies y un parche de MLB League Champs 2022 en la parte trasera. Cómprala ya.',800.00,0,'405574f5ca8b6bdfc2370bfb1a35b7d5.jpg '),(13,2,'GOR-02-0013','Gorra de Juego Toronto Blue Jays AC','Usa lo que usan los jugadores! La gorra ajustada Toronto Blue Jays Authentic Collection 59FIFTY cuenta con una fabricación de color del equipo con un logotipo bordado de Blue Jays en los paneles frontales y un MLB Batterman bordado en la parte trasera.',800.00,0,'32e6e6f2c67408a19cf37cebace2750a.jpg '),(14,2,'GOR-02-0014','Gorra de los angeles dodger Father','Complementa tu outfit con esta gorra 39Thirty Los Angeles Dodgers Fathers Day Azul la cual presenta el logotipo del equipo bordado en los paneles frontales que te hará lucir genial. Sus materiales y forma única hacen de esta colección la mejor elección. No te quedes sin la tuya. ',750.00,0,'ad4680a3e5d3b4618a978cc016fbb029.jpg '),(15,2,'GOR-02-0015','Gorra de san miguel arcangel','Las gorras pueden tener diseños que incluyen la imagen de San Miguel Arcángel, su escudo con la inscripción \\\"Quis ut Deus?\\\" (¿Quién como Dios?), o símbolos que representan su poder y protección.',980.00,0,'bb71f36b52c3bdb6befc5d6d2b73358d.jpg '),(16,3,'CAM-03-0016','Camisas Los Angeles 23 Roja/Blanca','Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.',430.00,0,'443e87c80024aeee58f9deef1dda8f19.jpg '),(17,3,'CAM-03-0017','Camisas Chicago Negra','Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.',430.00,0,'a5852a762c62190f75dec948e8830faa.jpg '),(18,3,'CAM-03-0018','Camisas Los Angeles 23 Blanca','Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.',430.00,0,'6091a47f04c6652e07985bea58832b45.jpg '),(19,3,'CAM-03-0019','Camisas Los Angeles 23 Celeste','Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.',430.00,0,'36a66bc9a56af7205a9d00287a4413ac.jpg '),(20,3,'CAM-03-0020','Camisa PatoLucas Hip Roja','Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.',430.00,0,'a9d709258efee06bd3e384f023331668.jpg '),(21,3,'CAM-03-0021','Camisa PatoLucas Hip Negra','Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.',430.00,0,'e3a00e2f3413bd597f6c9060403a3d5d.jpg '),(22,3,'CAM-03-0022','Camisa PatoLucas Hip Blanca','Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.',430.00,0,'123b8271073765084428c10b00b18a79.jpg '),(23,3,'CAM-03-0023','Camisa Power Blanca','Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.',430.00,0,'372e0645e21f220724994f3f2e0e5096.jpg '),(24,3,'CAM-03-0024','Camisa Power Amarilla','Camisas urbanas de estilo moderno y versátil, diseñadas para destacar en cualquier ocasión. Confeccionadas en telas frescas y cómodas, combinan cortes relajados con detalles únicos que reflejan actitud y personalidad. Ideales para un look casual, streetwear o para salir con estilo, se adaptan fácilmente a distintos outfits y gustos. Disponibles en variedad de colores, estampados y tallas.',800.00,0,'88241dce4784eafcf5012024b4b312d0.jpg ');
INSERT INTO `proveedores` VALUES (1,' TIENDA SOLIS','JUAN ALVARES','1234567890','Managua','nacional ',0),(2,' Camisas','Roberto Rojas','1234567890','Managua','nacional ',0),(3,' New Era Gorra','Javier Lopez','1234567890','Mexico','extranjera ',0);



SET FOREIGN_KEY_CHECKS = 1;