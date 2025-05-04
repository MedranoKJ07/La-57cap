CREATE TABLE `categoria_producto` (
`idcategoria_producto` int NOT NULL AUTO_INCREMENT,
`garantias_meses` int NOT NULL,
`titulo` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`politica_garantia` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`estado` tinyint NULL DEFAULT NULL,
`tiene_garantia` tinyint NOT NULL,
PRIMARY KEY (`idcategoria_producto`) 
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `clasificaciones` (
`idClasificaciones` int NOT NULL AUTO_INCREMENT,
`puntuacion` int NULL DEFAULT NULL,
`comentario` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
`fecha_clasificacion` datetime NULL DEFAULT NULL,
`pedidos_idpedidos` int NOT NULL,
`cliente_idcliente` int NOT NULL,
`repartidor_idrepartidor` int NOT NULL,
PRIMARY KEY (`idClasificaciones`) ,
INDEX `fk_Clasificaciones_pedidos1_idx` (`pedidos_idpedidos` ASC) USING BTREE,
INDEX `fk_Clasificaciones_cliente1_idx` (`cliente_idcliente` ASC) USING BTREE,
INDEX `fk_Clasificaciones_repartidor1_idx` (`repartidor_idrepartidor` ASC) USING BTREE
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `cliente` (
`idcliente` int NOT NULL AUTO_INCREMENT,
`id_usuario` int NOT NULL,
`p_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`s_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`p_apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`s_apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`n_telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`direccion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
`Municipio` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
PRIMARY KEY (`idcliente`) ,
INDEX `cliente_usuario_idx` (`id_usuario` ASC) USING BTREE
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `compra_detalles` (
`idCompra_Detalles` int NOT NULL AUTO_INCREMENT,
`cantidad` int NULL DEFAULT NULL,
`precio_unitario` decimal(10,2) NULL DEFAULT NULL,
`subtotal` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
`Compra_Detallescol` decimal(10,2) NULL DEFAULT NULL,
`Compras_idCompras` int NOT NULL,
`producto_idproducto` int NOT NULL,
PRIMARY KEY (`idCompra_Detalles`) ,
INDEX `fk_Compra_Detalles_Compras1_idx` (`Compras_idCompras` ASC) USING BTREE,
INDEX `fk_Compra_Detalles_producto1_idx` (`producto_idproducto` ASC) USING BTREE
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `compras` (
`idCompras` int NOT NULL AUTO_INCREMENT,
`fecha_compra` datetime NOT NULL,
`total_compra` decimal(10,2) NOT NULL,
`estado` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`observaciones` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
`Proveedores_idProveedores` int NOT NULL,
PRIMARY KEY (`idCompras`) ,
INDEX `fk_Compras_Proveedores1_idx` (`Proveedores_idProveedores` ASC) USING BTREE
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `detalles_ventas` (
`iddetalles_ventas` int NOT NULL AUTO_INCREMENT,
`ventas_idventas` int NOT NULL,
`id_producto` int NOT NULL,
`cantidad` int NULL DEFAULT NULL,
`subtotal` decimal(10,2) NULL DEFAULT NULL,
PRIMARY KEY (`iddetalles_ventas`) ,
INDEX `detalles_ventas_productos_idx` (`id_producto` ASC) USING BTREE,
INDEX `fk_detalles_ventas_ventas1_idx` (`ventas_idventas` ASC) USING BTREE
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `devolucion_detalles` (
`idDevolucion_Detalles` int NOT NULL AUTO_INCREMENT,
`cantidad` int NOT NULL,
`Estado_Producto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`producto_idproducto` int NOT NULL,
`Devoluciones_idDevoluciones` int NOT NULL,
PRIMARY KEY (`idDevolucion_Detalles`) ,
INDEX `fk_Devolucion_Detalles_producto1_idx` (`producto_idproducto` ASC) USING BTREE,
INDEX `fk_Devolucion_Detalles_Devoluciones1_idx` (`Devoluciones_idDevoluciones` ASC) USING BTREE
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `devoluciones` (
`idDevoluciones` int NOT NULL AUTO_INCREMENT,
`fecha_solicitud` datetime NOT NULL,
`motivo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`Aprobado` tinyint NOT NULL,
`tipo_reembolso` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`observaciones` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`ventas_idventas` int NOT NULL,
`cliente_idcliente` int NOT NULL,
`Estado` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
PRIMARY KEY (`idDevoluciones`) ,
INDEX `fk_Devoluciones_ventas1_idx` (`ventas_idventas` ASC) USING BTREE,
INDEX `fk_Devoluciones_cliente1_idx` (`cliente_idcliente` ASC) USING BTREE
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `inventario` (
`idInventario` int NOT NULL AUTO_INCREMENT,
`cantidad_actual` int NOT NULL,
`cantidad_minima` int NOT NULL,
`fecha_actualizacion` datetime NULL DEFAULT NULL,
`producto_idproducto` int NOT NULL,
PRIMARY KEY (`idInventario`) ,
INDEX `fk_Inventario_producto1_idx` (`producto_idproducto` ASC) USING BTREE
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `notificacion` (
`idnotificacion` int NOT NULL AUTO_INCREMENT,
`titulo` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`descripcion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`creada_fecha` timestamp NOT NULL,
`panel_notificacion_idnotificacion` int NOT NULL,
`usuario_idusuario` int NOT NULL,
PRIMARY KEY (`idnotificacion`) ,
INDEX `fk_notificacion_usuario1_idx` (`usuario_idusuario` ASC) USING BTREE
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `pedidos` (
`idpedidos` int NOT NULL AUTO_INCREMENT,
`id_ventas` int NOT NULL,
`id_cliente` int NOT NULL,
`id_repartidor` int NULL DEFAULT NULL,
`creado` datetime NOT NULL,
`fecha_entregar` date NOT NULL,
`hora_entregar` time NOT NULL,
`direccion_entregar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`comentarios` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
`estado` tinyint NULL DEFAULT NULL,
`pago_confirmado` tinyint NULL DEFAULT NULL,
PRIMARY KEY (`idpedidos`) ,
INDEX `pedido_cliente_idx` (`id_cliente` ASC) USING BTREE,
INDEX `pedido_repartidor_idx` (`id_repartidor` ASC) USING BTREE,
INDEX `pedido_ventas_idx` (`id_ventas` ASC) USING BTREE
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `producto` (
`idproducto` int NOT NULL AUTO_INCREMENT,
`id_categoria` int NOT NULL,
`codigo_producto` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`nombre_producto` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`descripcion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`estado` tinyint NOT NULL,
`precio` decimal(10,2) NOT NULL,
PRIMARY KEY (`idproducto`) ,
INDEX `producto_categoria_idx` (`id_categoria` ASC) USING BTREE
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `proveedores` (
`idProveedores` int NOT NULL AUTO_INCREMENT,
`nombre_empresa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
`contacto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
`telefono` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
`direccion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
PRIMARY KEY (`idProveedores`) 
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `repartidor` (
`idrepartidor` int NOT NULL AUTO_INCREMENT,
`id_usuario` int NOT NULL,
`p_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`s_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`p_apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`s_apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`n_telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
PRIMARY KEY (`idrepartidor`) ,
INDEX `repartidor_usuario_idx` (`id_usuario` ASC) USING BTREE
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `roles` (
`idroles` int NOT NULL,
`descripcion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
PRIMARY KEY (`idroles`) 
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `usuario` (
`idusuario` int NOT NULL AUTO_INCREMENT,
`id_roles` int NOT NULL,
`f_perfil` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
`userName` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`password` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`confirmado` tinyint(1) NULL DEFAULT NULL,
`token` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
`Creado_Fecha` datetime NOT NULL,
`Cambiado_Fecha` datetime NOT NULL,
PRIMARY KEY (`idusuario`) ,
INDEX `usuario_roles_idx` (`id_roles` ASC) USING BTREE
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `vendedor` (
`idvendedor` int NOT NULL AUTO_INCREMENT,
`id_usuario` int NOT NULL,
`p_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`s_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`p_apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`s_apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`n_telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
PRIMARY KEY (`idvendedor`) ,
INDEX `vendedor_usuario_idx` (`id_usuario` ASC) USING BTREE
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;
CREATE TABLE `ventas` (
`idventas` int NOT NULL AUTO_INCREMENT,
`id_vendedor` int NOT NULL,
`subtotal` decimal(10,2) NOT NULL,
`descuento` decimal(10,2) NOT NULL,
`iva` decimal(10,2) NOT NULL,
`total` decimal(10,2) NOT NULL,
`estado` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`creado` datetime NOT NULL,
PRIMARY KEY (`idventas`) ,
INDEX `ventas_vendedor_idx` (`id_vendedor` ASC) USING BTREE
)
ENGINE = InnoDB
AUTO_INCREMENT = 0
AVG_ROW_LENGTH = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
KEY_BLOCK_SIZE = 0
MAX_ROWS = 0
MIN_ROWS = 0
ROW_FORMAT = Dynamic;

ALTER TABLE `clasificaciones` ADD CONSTRAINT `fk_Clasificaciones_cliente1` FOREIGN KEY (`cliente_idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `clasificaciones` ADD CONSTRAINT `fk_Clasificaciones_pedidos1` FOREIGN KEY (`pedidos_idpedidos`) REFERENCES `pedidos` (`idpedidos`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `clasificaciones` ADD CONSTRAINT `fk_Clasificaciones_repartidor1` FOREIGN KEY (`repartidor_idrepartidor`) REFERENCES `repartidor` (`idrepartidor`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `cliente` ADD CONSTRAINT `cliente_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `compra_detalles` ADD CONSTRAINT `fk_Compra_Detalles_Compras1` FOREIGN KEY (`Compras_idCompras`) REFERENCES `compras` (`idCompras`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `compra_detalles` ADD CONSTRAINT `fk_Compra_Detalles_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `compras` ADD CONSTRAINT `fk_Compras_Proveedores1` FOREIGN KEY (`Proveedores_idProveedores`) REFERENCES `proveedores` (`idProveedores`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `detalles_ventas` ADD CONSTRAINT `detalles_ventas_productos` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `detalles_ventas` ADD CONSTRAINT `fk_detalles_ventas_ventas1` FOREIGN KEY (`ventas_idventas`) REFERENCES `ventas` (`idventas`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `devolucion_detalles` ADD CONSTRAINT `fk_Devolucion_Detalles_Devoluciones1` FOREIGN KEY (`Devoluciones_idDevoluciones`) REFERENCES `devoluciones` (`idDevoluciones`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `devolucion_detalles` ADD CONSTRAINT `fk_Devolucion_Detalles_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `devoluciones` ADD CONSTRAINT `fk_Devoluciones_cliente1` FOREIGN KEY (`cliente_idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `devoluciones` ADD CONSTRAINT `fk_Devoluciones_ventas1` FOREIGN KEY (`ventas_idventas`) REFERENCES `ventas` (`idventas`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `inventario` ADD CONSTRAINT `fk_Inventario_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `notificacion` ADD CONSTRAINT `fk_notificacion_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `pedidos` ADD CONSTRAINT `pedido_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`idcliente`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `pedidos` ADD CONSTRAINT `pedido_repartidor` FOREIGN KEY (`id_repartidor`) REFERENCES `repartidor` (`idrepartidor`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `pedidos` ADD CONSTRAINT `pedido_ventas` FOREIGN KEY (`id_ventas`) REFERENCES `ventas` (`idventas`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `producto` ADD CONSTRAINT `producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_producto` (`idcategoria_producto`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `repartidor` ADD CONSTRAINT `vendedor_usuario00` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `usuario` ADD CONSTRAINT `usuario_roles` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`idroles`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `vendedor` ADD CONSTRAINT `vendedor_usuario0` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `ventas` ADD CONSTRAINT `ventas_vendedor` FOREIGN KEY (`id_vendedor`) REFERENCES `vendedor` (`idvendedor`) ON DELETE RESTRICT ON UPDATE RESTRICT;

