<?php

// Función base para conectar con cualquier usuario
function conectar($user, $pass) {
    $host = $_ENV['DB_HOST'];
    $name = $_ENV['DB_NAME'];

    $db = mysqli_connect($host, $user, $pass, $name);

    if (!$db) {
        echo "❌ Error al conectar con el usuario '$user': " . mysqli_connect_error();
        exit;
    }

    return $db;
}
// Conexión para login (lector solo de la tabla 'usuario')
function conexionLogin() {
    return conectar($_ENV['DB_WEBAPP_USER'], $_ENV['DB_WEBAPP_PASS']);
}
// Conexión según el rol
function conectarSegunRol($rol, &$conexionAnterior = null)
{
    // Desconectar si ya hay una conexión activa (opcional)
    if ($conexionAnterior && mysqli_ping($conexionAnterior)) {
        mysqli_close($conexionAnterior);
        $conexionAnterior = null;
    }

    switch ($rol) {
        case '1': // Administrador
            $user = $_ENV['DB_ADMIN_USER'];
            $pass = $_ENV['DB_ADMIN_PASS'];
            break;
        case '2': // Vendedor
            $user = $_ENV['DB_VENDEDOR_USER'];
            $pass = $_ENV['DB_VENDEDOR_PASS'];
            break;
        case '3': // Repartidor
            $user = $_ENV['DB_REPARTIDOR_USER'];
            $pass = $_ENV['DB_REPARTIDOR_PASS'];
            break;
        case '4': // Cliente
            $user = $_ENV['DB_CLIENTE_USER'];
            $pass = $_ENV['DB_CLIENTE_PASS'];
            break;
        default: // Fallback a login
            $user = $_ENV['DB_WEBAPP_USER'];
            $pass = $_ENV['DB_WEBAPP_PASS'];
            break;
    }

    return conectar($user, $pass);
}
