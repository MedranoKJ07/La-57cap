-- ===============================================
-- CREACION DEL ROL Y ASIGNACION DEL PRIVELEGIOS
-- Rol: sysadmin
-- ===============================================
CREATE ROLE 'sysadmin'@'localhost';
GRANT ALL PRIVILEGES ON *.* TO 'sysadmin'@'localhost' WITH GRANT OPTION;
-- ===============================================
-- CREACION DEL ROL Y ASIGNACION DEL PRIVELEGIOS
-- Rol: admin
-- ===============================================
CREATE ROLE 'admin'@'localhost';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.* TO 'admin'@'localhost';
-- ===============================================
-- CREACION DEL ROL Y ASIGNACION DEL PRIVELEGIOS
-- Rol: webapp
-- ===============================================
CREATE ROLE  'webapp'@'localhost';
GRANT SELECT, UPDATE, INSERT ON db_la57cap.usuario TO 'webapp'@'localhost';
GRANT SELECT, UPDATE, INSERT ON db_la57cap.cliente TO 'webapp'@'localhost';
GRANT SELECT ON db_la57cap.categoria_producto TO 'webapp'@'localhost';
GRANT SELECT ON db_la57cap.producto TO 'webapp'@'localhost';
GRANT SELECT ON db_la57cap.roles TO 'webapp'@'localhost';
GRANT SELECT ON db_la57cap.inventario TO 'webapp'@'localhost';
GRANT UPDATE ON db_la57cap.ventas TO 'webapp'@'localhost';
-- ===============================================
-- CREACION DEL ROL Y ASIGNACION DEL PRIVELEGIOS
-- Rol: cliente
-- ===============================================
CREATE ROLE 'cliente'@'localhost';
GRANT SELECT, INSERT , UPDATE ON db_la57cap.usuario TO 'cliente'@'localhost';
GRANT SELECT, INSERT , UPDATE ON db_la57cap.cliente TO 'cliente'@'localhost';
GRANT SELECT ON db_la57cap.producto TO 'cliente'@'localhost';
GRANT SELECT ON db_la57cap.categoria_producto TO 'cliente'@'localhost';
GRANT SELECT, INSERT ON db_la57cap.pedidos TO 'cliente'@'localhost';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.ventas TO 'cliente'@'localhost';
GRANT SELECT ON db_la57cap.vendedor TO 'cliente'@'localhost';
GRANT SELECT ON db_la57cap.repartidor TO 'cliente'@'localhost';
GRANT SELECT, INSERT ON db_la57cap.devoluciones TO 'cliente'@'localhost';
GRANT SELECT ON db_la57cap.devolucion_detalles TO 'cliente'@'localhost';
GRANT SELECT, INSERT ON db_la57cap.detalles_ventas TO 'cliente'@'localhost';
GRANT SELECT ON db_la57cap.notificacion TO 'cliente'@'localhost';
GRANT SELECT, INSERT ON db_la57cap.calificaciones TO 'cliente'@'localhost';
GRANT SELECT, UPDATE ON db_la57cap.inventario TO 'cliente'@'localhost';
GRANT INSERT ON db_la57cap.detalles_ventas TO 'cliente'@'localhost';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.notificacion TO 'cliente'@'localhost';
GRANT SELECT ON db_la57cap.detalles_ventas TO 'cliente'@'localhost';
-- ===============================================
-- CREACION DEL ROL Y ASIGNACION DEL PRIVELEGIOS
-- Rol: repartidor
-- ===============================================
CREATE ROLE 'repartidor'@'localhost';
GRANT SELECT ON db_la57cap.repartidor TO 'repartidor'@'localhost';
GRANT SELECT ON db_la57cap.usuario TO 'repartidor'@'localhost';
GRANT SELECT, UPDATE ON db_la57cap.pedidos TO 'repartidor'@'localhost';
GRANT SELECT ON db_la57cap.cliente TO 'repartidor'@'localhost';
GRANT SELECT ON db_la57cap.ventas TO 'repartidor'@'localhost';
GRANT SELECT ON db_la57cap.vendedor TO 'repartidor'@'localhost';
GRANT SELECT ON db_la57cap.producto TO 'repartidor'@'localhost';
GRANT SELECT ON db_la57cap.categoria_producto TO 'repartidor'@'localhost';
GRANT SELECT ON db_la57cap.notificacion TO 'repartidor'@'localhost';
GRANT UPDATE ON db_la57cap.ventas TO 'repartidor'@'localhost';
GRANT SELECT ON db_la57cap.detalles_ventas TO 'repartidor'@'localhost';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.notificacion TO 'repartidor'@'localhost';

-- ===============================================
-- CREACION DEL ROL Y ASIGNACION DEL PRIVELEGIOS
-- Rol: vendedor
-- ===============================================
CREATE ROLE 'vendedor'@'localhost';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.ventas TO 'vendedor'@'localhost';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.detalles_ventas TO 'vendedor'@'localhost';
GRANT SELECT, INSERT ON db_la57cap.pedidos TO 'vendedor'@'localhost';
GRANT SELECT ON db_la57cap.cliente TO 'vendedor'@'localhost';
GRANT SELECT ON db_la57cap.repartidor TO 'vendedor'@'localhost';
GRANT SELECT ON db_la57cap.producto TO 'vendedor'@'localhost';
GRANT SELECT ON db_la57cap.inventario TO 'vendedor'@'localhost';
GRANT SELECT ON db_la57cap.categoria_producto TO 'vendedor'@'localhost';
GRANT SELECT ON db_la57cap.devoluciones TO 'vendedor'@'localhost';
GRANT SELECT ON db_la57cap.devolucion_detalles TO 'vendedor'@'localhost';
GRANT SELECT ON db_la57cap.notificacion TO 'vendedor'@'localhost';
GRANT SELECT ON db_la57cap.vendedor TO 'vendedor'@'localhost';
GRANT SELECT ON db_la57cap.usuario TO 'vendedor'@'localhost';
GRANT SELECT, UPDATE ON db_la57cap.pedidos TO 'vendedor'@'localhost';
GRANT INSERT ON db_la57cap.notificacion TO 'vendedor'@'localhost';
GRANT UPDATE ON db_la57cap.pedidos TO 'vendedor'@'localhost';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.notificacion TO 'vendedor'@'localhost';
GRANT SELECT, UPDATE ON db_la57cap.inventario TO 'vendedor'@'localhost';

-- ===============================================
-- CREACION DE USUARIOS Y ASIGNACION DE ROLES
-- ===============================================
CREATE USER 'sysAdmin'@'localhost' IDENTIFIED BY 'SysAdmin57$2025';
GRANT 'sysadmin'@'localhost' TO 'sysAdmin'@'localhost';

CREATE USER 'admin57'@'localhost' IDENTIFIED BY 'admin123';
GRANT 'admin'@'localhost' TO 'admin57'@'localhost';

CREATE USER 'webApp57'@'localhost' IDENTIFIED BY 'webApp123';
GRANT 'webapp'@'localhost' TO 'webApp57'@'localhost';

CREATE USER 'cliente57'@'localhost' IDENTIFIED BY 'cliente123';
GRANT 'cliente'@'localhost' TO 'cliente57'@'localhost';

CREATE USER 'repartidor57'@'localhost' IDENTIFIED BY 'rep123';
GRANT 'repartidor'@'localhost' TO 'repartidor57'@'localhost';

CREATE USER 'vendedor57'@'localhost' IDENTIFIED BY 'vend123';
GRANT 'vendedor'@'localhost' TO 'vendedor57'@'localhost';

-- ========================================
-- Aplicar cambios
-- ========================================
FLUSH PRIVILEGES;
