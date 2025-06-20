<?php
require_once __DIR__ . '/../includes/app.php';

use Controllers\InventarioController;
use Controllers\LoginController;
use Controllers\AdminController;
use Controllers\UsuarioController;
use Controllers\DashBoardController;
use Controllers\ClienteController;
use Controllers\VendedorController;
use Controllers\RepartidorControllers;
use Controllers\ProveedorController;
use Controllers\CategoriaProductoController;
use Controllers\ProductoController;
use Controllers\CompraController;
use Controllers\RegistroController;
use Controllers\LandingController;
use Controllers\TiendaController;
use Controllers\CarritoController;
use Controllers\CheckoutController;
use Controllers\ClientePanelController;
use Controllers\DevolucionController;
use Controllers\ApiVentaController;
use Controllers\NotificacionController;
use Controllers\ReporteController;


use MVC\Router;
$router = new Router();

// Iniciar Sesión
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
// Recuperar Password
$router->get('/olvide-cuenta', [UsuarioController::class, 'olvide']);
$router->post('/olvide-cuenta', [UsuarioController::class, 'olvide']);
$router->get('/recuperar-cuenta', [UsuarioController::class, 'recuperar']);
$router->post('/recuperar-cuenta', [UsuarioController::class, 'recuperar']);
// Confirmar cuenta
$router->get('/confirmar-cuenta', [UsuarioController::class, 'confirmarCuenta']);
$router->post('/confirmar-cuenta', [UsuarioController::class, 'confirmarCuenta']);
//crear tu cuenta
$router->get('/crear-cuenta', [RegistroController::class, 'crearCuenta']);
$router->post('/crear-cuenta', [RegistroController::class, 'crearCuenta']);
//mensaje de ver correo
$router->get('/mensaje-confirmacion', [RegistroController::class, 'mensajeConfirmacion']);
//ReenviarConfirmación
$router->get('/reenviar-confirmacion', [RegistroController::class, 'reenviarConfirmacion']);
$router->post('/reenviar-confirmacion', [RegistroController::class, 'reenviarConfirmacion']);
//Landing page
$router->get('/', [LandingController::class, 'index']);


$router->get('/cliente/pedidos', [ClientePanelController::class, 'pedidos']);

$router->get('/cliente/devolucion', [ClienteController::class, 'solicitarDevolucion']);
$router->post('/cliente/devolucion', [ClienteController::class, 'registrarDevolucion']);
$router->post('/cliente/devolucion/guardar', [ClienteController::class, 'guardarDevolucion']);

$router->get('/tienda', [TiendaController::class, 'shop']);
$router->post('/tienda', fn: [TiendaController::class, 'shop']);
$router->get('/producto', [ProductoController::class, 'ver']);

$router->get('/carrito', [CarritoController::class, 'mostrar']);
$router->get('/carrito/agregar', [CarritoController::class, 'agregar']);
$router->get('/carrito/eliminar', [CarritoController::class, 'eliminar']);
$router->post('/carrito/actualizar', [CarritoController::class, 'actualizar']);

$router->get('/checkout', [CheckoutController::class, 'mostrar']);
$router->post('/checkout/confirmar', [CheckoutController::class, 'confirmar']);
$router->get('/checkout/exito', [CheckoutController::class, 'exito']);

$router->get('/cliente/pedido', [ClienteController::class, 'pedido']);

$router->post('/cliente/calificar', [ClientePanelController::class, 'calificarPedido']);
$router->get('/cliente/calificar', [ClientePanelController::class, 'calificarPedido']);


$router->get('/SobreNosotros', [LandingController::class, 'about']);
$router->get('/visit_us', [LandingController::class, 'visit_us']);




//AREAS PROTEGIDAS
// Area de administración
$router->get('/admin', [AdminController::class, 'Admin']);
$router->post('/admin', [AdminController::class, 'Admin']);
//Gestionar usuario
$router->get('/admin/GestionarUsuario', [UsuarioController::class, 'GestionarUsuario']);
$router->post('/admin/GestionarUsuario', [UsuarioController::class, 'GestionarUsuario']);
$router->get('/admin/CrearUsuario', [UsuarioController::class, 'crearUsuario']);
$router->post('/admin/CrearUsuario', [UsuarioController::class, 'crearUsuario']);
$router->get('/admin/ActualizarUsuario', [UsuarioController::class, 'ActualizarUsuario']);
$router->post('/admin/ActualizarUsuario', [UsuarioController::class, 'ActualizarUsuario']);
$router->get('/admin/EliminarUsuario', [UsuarioController::class, 'EliminarUsuario']);
$router->post('/admin/EliminarUsuario', [UsuarioController::class, 'EliminarUsuario']);
//Dashboard
$router->get('/admin/Dashboard', [DashBoardController::class, 'Dashboard']);
$router->post('/admin/Dashboard', [DashBoardController::class, 'Dashboard']);
//Gestionar cliente
$router->get('/admin/GestionarCliente', [ClienteController::class, 'GestionarCliente']);
$router->post('/admin/GestionarCliente', [ClienteController::class, 'GestionarCliente']);
//Gestionar Vendedor
$router->get('/admin/GestionarVendedores', [VendedorController::class, 'GestionarVendedores']);
$router->post('/admin/GestionarVendedores', [VendedorController::class, 'GestionarVendedores']);
$router->get('/admin/CrearVendedor', [VendedorController::class, 'crearvendedor']);
$router->post('/admin/CrearVendedor', [VendedorController::class, 'crearvendedor']);
$router->get('/admin/ActualizarVendedor', [VendedorController::class, 'ActualizarVendedor']);
$router->post('/admin/ActualizarVendedor', [VendedorController::class, 'ActualizarVendedor']);
$router->post('/admin/EliminarVendedor', [VendedorController::class, 'EliminarVendedor']);
//Gestionar Repartidor
$router->get('/admin/GestionarRepartidor', [RepartidorControllers::class, 'GestionarRepartidores']);
$router->post('/admin/GestionarRepartidor', [RepartidorControllers::class, 'GestionarRepartidores']);
$router->get('/admin/CrearRepartidor', [RepartidorControllers::class, 'CrearRepartidor']);
$router->post('/admin/CrearRepartidor', [RepartidorControllers::class, 'CrearRepartidor']);
$router->get('/admin/ActualizarRepartidor', [RepartidorControllers::class, 'ActualizarRepartidor']);
$router->post('/admin/ActualizarRepartidor', [RepartidorControllers::class, 'ActualizarRepartidor']);
$router->post('/admin/EliminarRepartidor', [RepartidorControllers::class, 'EliminarRepartidor']);
// Rutas para proveedores
$router->get('/admin/GestionarProveedores', [ProveedorController::class, 'GestionarProveedores']);
$router->post('/admin/GestionarProveedores', [ProveedorController::class, 'GestionarProveedores']);
$router->get('/admin/CrearProveedor', [ProveedorController::class, 'CrearProveedor']);
$router->post('/admin/CrearProveedor', [ProveedorController::class, 'CrearProveedor']);
$router->get('/admin/ActualizarProveedor', [ProveedorController::class, 'ActualizarProveedor']);
$router->post('/admin/ActualizarProveedor', [ProveedorController::class, 'ActualizarProveedor']);
$router->post('/admin/EliminarProveedor', [ProveedorController::class, 'EliminarProveedor']);
// Categoría de Producto
$router->get('/admin/GestionarCategoriaProducto', [CategoriaProductoController::class, 'GestionarCategorias']);
$router->post('/admin/GestionarCategoriaProducto', [CategoriaProductoController::class, 'GestionarCategorias']);
$router->get('/admin/CrearCategoriaProducto', [CategoriaProductoController::class, 'CrearCategoria']);
$router->post('/admin/CrearCategoriaProducto', [CategoriaProductoController::class, 'CrearCategoria']);
$router->get('/admin/ActualizarCategoriaProducto', [CategoriaProductoController::class, 'ActualizarCategoria']);
$router->post('/admin/ActualizarCategoriaProducto', [CategoriaProductoController::class, 'ActualizarCategoria']);
$router->post('/admin/EliminarCategoriaProducto', [CategoriaProductoController::class, 'EliminarCategoria']);
// Producto
$router->get('/admin/GestionarProducto', [ProductoController::class, 'GestionarProductos']);
$router->post('/admin/GestionarProducto', [ProductoController::class, 'GestionarProductos']);
$router->get('/admin/CrearProducto', [ProductoController::class, 'CrearProducto']);
$router->post('/admin/CrearProducto', [ProductoController::class, 'CrearProducto']);
$router->get('/admin/ActualizarProducto', [ProductoController::class, 'ActualizarProducto']);
$router->post('/admin/ActualizarProducto', [ProductoController::class, 'ActualizarProducto']);
$router->post('/admin/EliminarProducto', [ProductoController::class, 'EliminarProducto']);
$router->get('/admin/GenerarCodigoBarras', [ProductoController::class, 'VerCodigoBarras']);
$router->get('/admin/DescargarCodigoBarras', [ProductoController::class, 'DescargarCodigoBarras']);
$router->get('/admin/VerProducto', [ProductoController::class, 'VerProducto']);
//Inventario 
$router->get('/admin/InventarioGeneral', [InventarioController::class, 'GestionarInventario']);
//Compras
$router->get('/admin/GestionarCompras', [CompraController::class, 'GestionarCompras']);
$router->get('/admin/CrearCompra', [CompraController::class, 'CrearCompra']);
$router->post('/admin/CrearCompra', [CompraController::class, 'CrearCompra']);
$router->get('/admin/DetalleCompra', [CompraController::class, 'VerDetalleCompra']);

$router->get('/admin/devoluciones', [DevolucionController::class, 'gestionar']);
$router->get('/admin/devoluciones/detalle', [DevolucionController::class, 'detalle']);
$router->post('/admin/devoluciones/aprobar', [DevolucionController::class, 'aprobar']);
$router->post('/admin/devoluciones/rechazar', [DevolucionController::class, 'rechazar']);
$router->post('/admin/devoluciones/visitar-tienda', [DevolucionController::class, 'visitarTienda']);

$router->get('/admin/historialPedidos', [AdminController::class, 'verPedidos']);
$router->get('/admin/detalle-pedido', [AdminController::class, 'detallePedido']);

$router->get('/admin/calificaciones', [AdminController::class, 'verCalificaciones']);           
$router->get('/admin/detalle-calificacion', [AdminController::class, 'detalleCalificacion']);


//Reportes\
$router->get('/admin/reportes', [ReporteController::class, 'index']);


$router->get('/admin/reporte/ventas-fecha', [ReporteController::class, 'ventasFecha']);
$router->get('/admin/reporte/ventas-fecha-excel', [ReporteController::class, 'ventasFechaExcel']);
$router->get('/admin/reporte/ventas-fecha-pdf', [ReporteController::class, 'ventasFechaPDF']);

$router->get('/admin/reportes/ventas-vendedor', [ReporteController::class, 'ventasPorVendedor']);
$router->get('/admin/reportes/ventas-vendedor-pdf', [ReporteController::class, 'exportarVentasVendedorPdf']);
$router->get('/admin/reportes/ventas-vendedor-excel', [ReporteController::class, 'exportarVentasVendedorExcel']);

$router->get('/admin/reportes/ventas-producto', [ReporteController::class, 'ventasProducto']);
$router->get('/admin/reportes/ventas-producto-pdf', [ReporteController::class, 'exportarVentasProductoPdf']);
$router->get('/admin/reportes/ventas-producto-excel', [ReporteController::class, 'exportarVentasProductoExcel']);

$router->get('/admin/reportes/ventas-categoria', [ReporteController::class, 'ventasCategoria']);
$router->get('/admin/reportes/ventas-categoria-pdf', [ReporteController::class, 'exportarVentasCategoriaPdf']);
$router->get('/admin/reportes/ventas-categoria-excel', [ReporteController::class, 'exportarVentasCategoriaExcel']);

$router->get('/admin/reportes/pedidos-repartidor', [ReporteController::class, 'pedidosRepartidor']);
$router->get('/admin/reportes/pedidos-repartidor-pdf', [ReporteController::class, 'exportarPedidosRepartidorPdf']);
$router->get('/admin/reportes/pedidos-repartidor-excel', [ReporteController::class, 'exportarPedidosRepartidorExcel']);

$router->get('/admin/reportes/movimiento-stock', [ReporteController::class, 'movimientoStock']);
$router->get('/admin/reportes/movimiento-stock-pdf', [ReporteController::class, 'exportarMovimientoStockPdf']);
$router->get('/admin/reportes/movimiento-stock-excel', [ReporteController::class, 'exportarMovimientoStockExcel']);

$router->get('/admin/reporte/valorizacion-inventario', [ReporteController::class, 'valorizacionInventario']);
$router->get('/admin/reporte/valorizacion-inventario-pdf', [ReporteController::class, 'valorizacionInventarioPdf']);
$router->get('/admin/reporte/valorizacion-inventario-excel', [ReporteController::class, 'valorizacionInventarioExcel']);

$router->get('/admin/reporte/productos-comprados', [ReporteController::class, 'productosComprados']);
$router->get('/admin/reporte/productos-comprados-pdf', [ReporteController::class, 'productosCompradosPDF']);
$router->get('/admin/reporte/productos-comprados-excel', [ReporteController::class, 'productosCompradosExcel']);

//PANEL DE VENDEDORES
$router->get('/Vendedor', [VendedorController::class, 'Vendedor']);


$router->get('/vendedor/realizar-venta', [VendedorController::class, 'realizarVenta']);
$router->post('/vendedor/realizar-venta', [VendedorController::class, 'realizarVenta']);
$router->get('/ticket', [VendedorController::class, 'ticket']);
$router->get('/ticket-pdf', [VendedorController::class, 'ticketPDF']);

$router->get('/api/producto', [ApiVentaController::class, 'buscar']);
$router->get('/api/cliente', [ApiVentaController::class, 'buscarCliente']);

$router->get('/vendedor/pedidos', [VendedorController::class, 'listarPedidosPendientes']);
$router->get('/vendedor/inventario', [InventarioController::class, 'Inventario']);

$router->get('/vendedor/VerProducto', [VendedorController::class, 'VerProducto']);
$router->get('/vendedor/GenerarCodigoBarras', [VendedorController::class, 'VerCodigoBarras']);
$router->get('/vendedor/DescargarCodigoBarras', [VendedorController::class, 'DescargarCodigoBarras']);

$router->get('/vendedor/atender-pedido', [VendedorController::class, 'atenderPedido']);
$router->get('/vendedor/detalle-pedido', [VendedorController::class, 'verDetallePedido']);
$router->get('/generar-garantia', [CategoriaProductoController::class, 'generarPDFGarantia']);


$router->get('/vendedor/asignar-repartidor', [VendedorController::class, 'asignarRepartidorVista']);
$router->post('/vendedor/asignar-repartidor', [VendedorController::class, 'asignarRepartidor']);


//PANEL DE REPARTIDORES
$router->get('/Repartidor', [RepartidorControllers::class, 'Repartidor']);
$router->get('/repartidor/pedidos-en-camino', [RepartidorControllers::class, 'pedidosEnCamino']);
$router->post('/repartidor/confirmar-entrega', [RepartidorControllers::class, 'confirmarEntrega']);
$router->get('/repartidor/pedido', [RepartidorControllers::class, 'verDetalle']);



$router->get('/notificaciones', [NotificacionController::class, 'index']);
$router->post('/notificaciones/eliminar', [NotificacionController::class, 'eliminar']);
$router->get('/api/notificaciones', [NotificacionController::class, 'obtenerPorUsuarioJson']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();