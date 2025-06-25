-- ===============================================
-- CREACION DEL ROLES
-- ===============================================

CREATE ROLE 'sysadmin','webapp','admin','cliente' ,'repartidor','vendedor';

-- ===============================================
-- ASIGNACION DEL PRIVELEGIOS
-- Rol: sysadmin
-- ===============================================

GRANT ALL PRIVILEGES ON *.* TO 'sysadmin' WITH GRANT OPTION;

-- ===============================================
-- ASIGNACION DEL PRIVELEGIOS
-- Rol:admin
-- ===============================================

GRANT SELECT, INSERT, UPDATE ON db_la57cap.* TO 'admin';
GRANT CREATE USER ON *.* TO 'admin';
GRANT SELECT ON mysql.user TO 'admin';
GRANT CREATE USER ON *.* TO 'admin';
GRANT USAGE ON db_la57cap.* TO 'admin';
GRANT GRANT OPTION ON db_la57cap.* TO 'admin';

-- ===============================================
-- CREACION DEL ROL Y ASIGNACION DEL PRIVELEGIOS
-- Rol: webapp
-- ===============================================

GRANT SELECT ON db_la57cap.* TO `webapp` WITH GRANT OPTION;
GRANT GRANT OPTION ON db_la57cap.* TO 'webapp';
GRANT CREATE USER ON *.* TO 'webapp';
GRANT SELECT, UPDATE, INSERT ON db_la57cap.usuario TO 'webapp';
GRANT SELECT, UPDATE, INSERT ON db_la57cap.cliente TO 'webapp';
GRANT SELECT ON mysql.user TO 'webapp';
GRANT SELECT ON db_la57cap.categoria_producto TO 'webapp';
GRANT SELECT ON db_la57cap.producto TO 'webapp';
GRANT SELECT ON db_la57cap.roles TO 'webapp';
GRANT SELECT ON db_la57cap.inventario TO 'webapp';
GRANT UPDATE ON db_la57cap.ventas TO 'webapp';

-- ===============================================
-- ASIGNACION DEL PRIVELEGIOS
-- Rol: cliente
-- ===============================================

GRANT SELECT, INSERT , UPDATE ON db_la57cap.usuario TO 'cliente';
GRANT SELECT, INSERT , UPDATE ON db_la57cap.cliente TO 'cliente';
GRANT SELECT ON db_la57cap.producto TO 'cliente';
GRANT SELECT ON db_la57cap.categoria_producto TO 'cliente';
GRANT SELECT, INSERT ON db_la57cap.pedidos TO 'cliente';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.ventas TO 'cliente';
GRANT SELECT ON db_la57cap.vendedor TO 'cliente';
GRANT SELECT ON db_la57cap.repartidor TO 'cliente';
GRANT SELECT, INSERT ON db_la57cap.devoluciones TO 'cliente';
GRANT SELECT ON db_la57cap.devolucion_detalles TO 'cliente';
GRANT SELECT, INSERT ON db_la57cap.detalles_ventas TO 'cliente';
GRANT SELECT ON db_la57cap.notificacion TO 'cliente';
GRANT SELECT, INSERT ON db_la57cap.calificaciones TO 'cliente';
GRANT SELECT, UPDATE ON db_la57cap.inventario TO 'cliente';
GRANT INSERT ON db_la57cap.detalles_ventas TO 'cliente';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.notificacion TO 'cliente';
GRANT SELECT ON db_la57cap.detalles_ventas TO 'cliente';

-- ===============================================
-- ASIGNACION DEL PRIVELEGIOS
-- Rol: repartidor
-- ===============================================

GRANT SELECT ON db_la57cap.repartidor TO 'repartidor';
GRANT SELECT ON db_la57cap.usuario TO 'repartidor';
GRANT SELECT, UPDATE ON db_la57cap.pedidos TO 'repartidor';
GRANT SELECT ON db_la57cap.cliente TO 'repartidor';
GRANT SELECT ON db_la57cap.ventas TO 'repartidor';
GRANT SELECT ON db_la57cap.vendedor TO 'repartidor';
GRANT SELECT ON db_la57cap.producto TO 'repartidor';
GRANT SELECT ON db_la57cap.categoria_producto TO 'repartidor';
GRANT SELECT ON db_la57cap.notificacion TO 'repartidor';
GRANT UPDATE ON db_la57cap.ventas TO 'repartidor';
GRANT SELECT ON db_la57cap.detalles_ventas TO 'repartidor';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.notificacion TO 'repartidor';

-- ===============================================
-- ASIGNACION DEL PRIVELEGIOS
-- Rol: vendedor
-- ===============================================

GRANT SELECT, INSERT, UPDATE ON db_la57cap.ventas TO 'vendedor';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.detalles_ventas TO 'vendedor';
GRANT SELECT, INSERT ON db_la57cap.pedidos TO 'vendedor';
GRANT SELECT ON db_la57cap.cliente TO 'vendedor';
GRANT SELECT ON db_la57cap.repartidor TO 'vendedor';
GRANT SELECT ON db_la57cap.producto TO 'vendedor';
GRANT SELECT ON db_la57cap.inventario TO 'vendedor';
GRANT SELECT ON db_la57cap.categoria_producto TO 'vendedor';
GRANT SELECT ON db_la57cap.devoluciones TO 'vendedor';
GRANT SELECT ON db_la57cap.devolucion_detalles TO 'vendedor';
GRANT SELECT ON db_la57cap.notificacion TO 'vendedor';
GRANT SELECT ON db_la57cap.vendedor TO 'vendedor';
GRANT SELECT ON db_la57cap.usuario TO 'vendedor';
GRANT SELECT, UPDATE ON db_la57cap.pedidos TO 'vendedor';
GRANT INSERT ON db_la57cap.notificacion TO 'vendedor';
GRANT UPDATE ON db_la57cap.pedidos TO 'vendedor';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.notificacion TO 'vendedor';
GRANT SELECT, UPDATE ON db_la57cap.inventario TO 'vendedor';

-- ===============================================
-- CREACION DE USUARIO
-- Rol: webApp57
-- ===============================================

CREATE USER `webApp57`@`localhost` IDENTIFIED BY 'webApp123';
GRANT SELECT ON db_la57cap.* TO 'webApp57'@'localhost' WITH GRANT OPTION;
GRANT 'webapp' TO 'webApp57'@'localhost';
GRANT 'cliente' TO 'webApp57'@'localhost' WITH ADMIN OPTION;



-- ===============================================
-- CREACION DE USUARIO
-- Rol: ADMIN
-- ===============================================

CREATE USER `ADMIN`@`localhost` IDENTIFIED BY '$2y$10$5C2QP0paeEA8n4ZCgJkn3eWRj7GoUbo5JoQuYcTeK5PA19r9D2M22';
GRANT Select ON `db\_la57cap`.* TO `ADMIN`@`localhost`;
GRANT 'vendedor' TO 'ADMIN'@'localhost' WITH ADMIN OPTION;
GRANT 'repartidor' TO 'ADMIN'@'localhost' WITH ADMIN OPTION;
GRANT 'admin' TO 'ADMIN'@'localhost' WITH ADMIN OPTION;
