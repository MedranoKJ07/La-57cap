<?php

// Función base para conectar con cualquier usuario
function conectar($user, $pass)
{
    try {

        $host = $_ENV['DB_HOST'];
        $name = $_ENV['DB_NAME'];
        $port = $_ENV['DB_PORT'];
        $db = mysqli_connect($host, $user, $pass, $name, $port);

        if (!$db) {
            echo "❌ Error al conectar con el usuario '$user': " . mysqli_connect_error();
            exit;
        }

        // Activar el rol para esta sesión
        // mysqli_query($db, "SET ROLE 'cliente'");

        return $db;
    } catch (\Throwable $e) {
        echo json_encode($e->getMessage());
    }
}

// Conexión para login (lector solo de la tabla 'usuario')
function conexionApp()
{
    return conectar($_ENV['DB_WEBAPP_USER'], $_ENV['DB_WEBAPP_PASS']);
}
// Conexión según el rol
function conectarSegunRol($rol, $userName, $pass, &$conexionAnterior = null)
{

    // Desconectar si ya hay una conexión activa (opcional)
    if ($conexionAnterior && mysqli_ping($conexionAnterior)) {
        mysqli_close($conexionAnterior);
        $conexionAnterior = null;
    }
    return conectar(trim($userName), trim($pass));
}


