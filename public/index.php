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

$router->get('/reenviar-confirmacion', [RegistroController::class, 'reenviarConfirmacion']);
$router->post('/reenviar-confirmacion', [RegistroController::class, 'reenviarConfirmacion']);

//Landing page
$router->get('/', [LandingController::class, 'index']);



//AREAS PROTEGIDAS
// Area de administración
$router->get('/admin', [AdminController::class, 'Admin']);
$router->post('/admin', [AdminController::class, 'Admin']);


//Gestionar usuario
$router->get('/admin/GestionarUsuario', [UsuarioController::class, 'GestionarUsuario']);
$router->post('/admin/GestionarUsuario', [UsuarioController::class, 'GestionarUsuario']);
//Crear usuario
$router->get('/admin/CrearUsuario', [UsuarioController::class, 'crearUsuario']);
$router->post('/admin/CrearUsuario', [UsuarioController::class, 'crearUsuario']);
//Actualizar usuario
$router->get('/admin/ActualizarUsuario', [UsuarioController::class, 'ActualizarUsuario']);
$router->post('/admin/ActualizarUsuario', [UsuarioController::class, 'ActualizarUsuario']);
//Eliminar usuario
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

//Crear Vendedor
$router->get('/admin/CrearUsuarioVendedor', [VendedorController::class, 'crearUsuarioVendedor']);
$router->post('/admin/CrearUsuarioVendedor', [VendedorController::class, 'crearUsuarioVendedor']);

$router->get('/admin/CancelarUsuarioVendedor', [VendedorController::class, 'CancelarUsuarioVendedor']);

$router->get('/admin/CrearVendedor', [VendedorController::class, 'crearvendedor']);
$router->post('/admin/CrearVendedor', [VendedorController::class, 'crearvendedor']);
//Actualizar Vendedor
$router->get('/admin/ActualizarVendedor', [VendedorController::class, 'ActualizarVendedor']);
$router->post('/admin/ActualizarVendedor', [VendedorController::class, 'ActualizarVendedor']);
//Eliminar Vendedor
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


//PANEL DE VENDEDORES
$router->get('/Vendedor', [VendedorController::class, 'Vendedor']);

//PANEL DE REPARTIDORES
$router->get('/Repartidor', [RepartidorControllers::class, 'Repartidor']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();