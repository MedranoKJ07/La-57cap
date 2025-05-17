<?php

function manejadorGlobalExcepciones(Throwable $excepcion)
{
    $codigo = 500;
    $mensaje = 'Ha ocurrido un error inesperado.';

    if ($excepcion instanceof mysqli_sql_exception) {
        // Detectar si es por falta de permisos (ya conectó pero no puede leer tabla)
        if (str_contains($excepcion->getMessage(), 'command denied')) {
            $codigo = 403;
            $mensaje = 'No tienes permisos suficientes para acceder a esta información.';
        }

        // Detectar si no se pudo conectar al servidor MySQL
        elseif (
            str_contains($excepcion->getMessage(), 'denegó expresamente') ||
            str_contains($excepcion->getMessage(), 'Connection refused') ||
            str_contains($excepcion->getMessage(), 'Can\'t connect')
        ) {
            $codigo = 503;
            $mensaje = 'No se puede conectar a la base de datos. El servicio podría estar temporalmente no disponible.';
        }
    }

    http_response_code($codigo);
    include __DIR__ . "/../views/errores/{$codigo}.php";
    exit;
}
