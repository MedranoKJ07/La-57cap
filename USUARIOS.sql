-- ===============================================
-- CREACION DEL USUARIO Y ASIGNACION DEL PRIVELEGIOS
-- USUARIO: sysadmin
-- ===============================================
CREATE USER 'sysadmin'@'localhost' IDENTIFIED BY 'SysAdmin57$2025';
GRANT ALL PRIVILEGES ON *.* TO 'sysadmin'@'localhost' WITH GRANT OPTION;
-- ===============================================
-- CREACION DEL USUARIO Y ASIGNACION DEL PRIVELEGIOS
-- USUARIO: admin
-- ===============================================
CREATE USER 'admin57'@'localhost' IDENTIFIED BY 'admin123';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.* TO 'admin57'@'localhost';
-- ===============================================
-- CREACION DEL USUARIO Y ASIGNACION DEL PRIVELEGIOS
-- USUARIO: webapp
-- ===============================================
CREATE USER 'webApp57'@'localhost' IDENTIFIED BY 'webApp123';
GRANT SELECT, UPDATE, INSERT ON db_la57cap.usuario TO 'webApp57'@'localhost';
GRANT SELECT, UPDATE, INSERT ON db_la57cap.cliente TO 'webApp57'@'localhost';
GRANT SELECT ON db_la57cap.categoria_producto TO 'webApp57'@'localhost';
GRANT SELECT ON db_la57cap.producto TO 'webApp57'@'localhost';
GRANT SELECT ON db_la57cap.roles TO 'webApp57'@'localhost';
GRANT SELECT ON db_la57cap.inventario TO 'webApp57'@'localhost';
GRANT UPDATE ON db_la57cap.ventas TO 'webApp57'@'localhost';
-- ===============================================
-- CREACION DEL USUARIO Y ASIGNACION DEL PRIVELEGIOS
-- USUARIO: cliente
-- ===============================================
CREATE USER 'cliente57'@'localhost' IDENTIFIED BY 'cliente123';
GRANT SELECT, INSERT , UPDATE ON db_la57cap.usuario TO 'cliente57'@'localhost';
GRANT SELECT, INSERT , UPDATE ON db_la57cap.cliente TO 'cliente57'@'localhost';
GRANT SELECT ON db_la57cap.producto TO 'cliente57'@'localhost';
GRANT SELECT ON db_la57cap.categoria_producto TO 'cliente57'@'localhost';
GRANT SELECT, INSERT ON db_la57cap.pedidos TO 'cliente57'@'localhost';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.ventas TO 'cliente57'@'localhost';
GRANT SELECT ON db_la57cap.vendedor TO 'cliente57'@'localhost';
GRANT SELECT ON db_la57cap.repartidor TO 'cliente57'@'localhost';
GRANT SELECT, INSERT ON db_la57cap.devoluciones TO 'cliente57'@'localhost';
GRANT SELECT ON db_la57cap.devolucion_detalles TO 'cliente57'@'localhost';
GRANT SELECT, INSERT ON db_la57cap.detalles_ventas TO 'cliente57'@'localhost';
GRANT SELECT ON db_la57cap.notificacion TO 'cliente57'@'localhost';
GRANT SELECT, INSERT ON db_la57cap.calificaciones TO 'cliente57'@'localhost';
GRANT SELECT, UPDATE ON db_la57cap.inventario TO 'cliente57'@'localhost';
GRANT INSERT ON db_la57cap.detalles_ventas TO 'cliente57'@'localhost';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.notificacion TO 'cliente57'@'localhost';
GRANT SELECT ON db_la57cap.detalles_ventas TO 'cliente57'@'localhost';
-- ===============================================
-- CREACION DEL USUARIO Y ASIGNACION DEL PRIVELEGIOS
-- USUARIO: repartidor
-- ===============================================
CREATE USER 'repartidor57'@'localhost' IDENTIFIED BY 'rep123';
GRANT SELECT ON db_la57cap.repartidor TO 'repartidor57'@'localhost';
GRANT SELECT ON db_la57cap.usuario TO 'repartidor57'@'localhost';
GRANT SELECT, UPDATE ON db_la57cap.pedidos TO 'repartidor57'@'localhost';
GRANT SELECT ON db_la57cap.cliente TO 'repartidor57'@'localhost';
GRANT SELECT ON db_la57cap.ventas TO 'repartidor57'@'localhost';
GRANT SELECT ON db_la57cap.vendedor TO 'repartidor57'@'localhost';
GRANT SELECT ON db_la57cap.producto TO 'repartidor57'@'localhost';
GRANT SELECT ON db_la57cap.categoria_producto TO 'repartidor57'@'localhost';
GRANT SELECT ON db_la57cap.notificacion TO 'repartidor57'@'localhost';
GRANT UPDATE ON db_la57cap.ventas TO 'repartidor57'@'localhost';
GRANT SELECT ON db_la57cap.detalles_ventas TO 'repartidor57'@'localhost';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.notificacion TO 'repartidor57'@'localhost';

-- ===============================================
-- CREACION DEL USUARIO Y ASIGNACION DEL PRIVELEGIOS
-- USUARIO: vendedor
-- ===============================================
CREATE USER 'vendedor57'@'localhost' IDENTIFIED BY 'vend123';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.ventas TO 'vendedor57'@'localhost';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.detalles_ventas TO 'vendedor57'@'localhost';
GRANT SELECT, INSERT ON db_la57cap.pedidos TO 'vendedor57'@'localhost';
GRANT SELECT ON db_la57cap.cliente TO 'vendedor57'@'localhost';
GRANT SELECT ON db_la57cap.repartidor TO 'vendedor57'@'localhost';
GRANT SELECT ON db_la57cap.producto TO 'vendedor57'@'localhost';
GRANT SELECT ON db_la57cap.inventario TO 'vendedor57'@'localhost';
GRANT SELECT ON db_la57cap.categoria_producto TO 'vendedor57'@'localhost';
GRANT SELECT ON db_la57cap.devoluciones TO 'vendedor57'@'localhost';
GRANT SELECT ON db_la57cap.devolucion_detalles TO 'vendedor57'@'localhost';
GRANT SELECT ON db_la57cap.notificacion TO 'vendedor57'@'localhost';
GRANT SELECT ON db_la57cap.vendedor TO 'vendedor57'@'localhost';
GRANT SELECT ON db_la57cap.usuario TO 'vendedor57'@'localhost';
GRANT SELECT, UPDATE ON db_la57cap.pedidos TO 'vendedor57'@'localhost';
GRANT INSERT ON db_la57cap.notificacion TO 'vendedor57'@'localhost';
GRANT UPDATE ON db_la57cap.pedidos TO 'vendedor57'@'localhost';
GRANT SELECT, INSERT, UPDATE ON db_la57cap.notificacion TO 'vendedor57'@'localhost';
GRANT SELECT, UPDATE ON db_la57cap.inventario TO 'vendedor57'@'localhost';


-- ========================================
-- Aplicar cambios
-- ========================================
FLUSH PRIVILEGES;
