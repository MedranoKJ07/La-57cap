<?php 

require_once __DIR__ . '/../includes/app.php';
use Controllers\LoginController;
use Controllers\AdminController;
use Controllers\UsuarioController;
use Controllers\DashBoardController;    
use MVC\Router;
$router = new Router();

// Iniciar Sesión
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

// Crear Cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

// Confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

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







// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();