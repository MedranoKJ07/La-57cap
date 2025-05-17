<?php
// require_once __DIR__ . '/../includes/errores.php';
// set_exception_handler('manejadorGlobalExcepciones');
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Model\ActiveRecord;

$dotenv = Dotenv::createImmutable(__DIR__ . '');
$dotenv->safeLoad();

require 'funciones.php';
require 'database.php'; // asegúrate que tiene todas tus funciones de conexión

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Detectar si ya hay sesión con rol definido
if (isset($_SESSION['rol'])) {
    $conexion = conectarSegunRol($_SESSION['rol']);
} else {
    $conexion = conexionLogin(); // solo para login u operaciones públicas
}

ActiveRecord::setDB($conexion);
