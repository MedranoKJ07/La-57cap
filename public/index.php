<?php

require_once __DIR__ . '/../includes/app.php';
use Controllers\LoginController;
use Controllers\AdminController;
use Controllers\UsuarioController;
use Controllers\DashBoardController;
use Controllers\ClienteController;
use Controllers\VendedorController;
use Controllers\RepartidorControllers;
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



//Landing page



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
$router->get('/admin/CrearVendedor', [VendedorController::class, 'crearVendedor']);
$router->post('/admin/CrearVendedor', [VendedorController::class, 'crearVendedor']);
//Actualizar Vendedor
$router->get('/admin/ActualizarVendedor', [VendedorController::class, 'ActualizarVendedor']);
$router->post('/admin/ActualizarVendedor', [VendedorController::class, 'ActualizarVendedor']);
//Eliminar Vendedor
$router->post('/admin/EliminarVendedor', [VendedorController::class, 'EliminarVendedor']);

//Gestionar Repartidor
$router->get('/admin/GestionarRepartidor', [RepartidorControllers::class, 'GestionarRepartidores']);
$router->post('/admin/GestionarRepartidor', [RepartidorControllers::class, 'GestionarRepartidores']);

// Crear usuario y repartidor (flujo similar a vendedor)
$router->get('/admin/CrearUsuarioRepartidor', [RepartidorControllers::class, 'crearUsuarioRepartidor']);
$router->post('/admin/CrearUsuarioRepartidor', [RepartidorControllers::class, 'crearUsuarioRepartidor']);

$router->get('/admin/CrearRepartidor', [RepartidorControllers::class, 'CrearRepartidor']);
$router->post('/admin/CrearRepartidor', [RepartidorControllers::class, 'CrearRepartidor']);

// Actualizar repartidor
$router->get('/admin/ActualizarRepartidor', [RepartidorControllers::class, 'ActualizarRepartidor']);
$router->post('/admin/ActualizarRepartidor', [RepartidorControllers::class, 'ActualizarRepartidor']);

// Eliminar repartidor
$router->post('/admin/EliminarRepartidor', [RepartidorControllers::class, 'EliminarRepartidor']);


//PANEL DE VENDEDORES
$router->get('/Vendedor', [VendedorController::class, 'Vendedor']); 

//PANEL DE REPARTIDORES
$router->get('/Repartidor', [RepartidorControllers::class, 'Repartidor']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();