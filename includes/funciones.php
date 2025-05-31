<?php
define('CARPETAS_IMAGENES_PERFILES', $_SERVER['DOCUMENT_ROOT'] . '/img/users');
define('CARPETAS_IMAGENES_PRODUCTOS', $_SERVER['DOCUMENT_ROOT'] . '/img/productos');
define('CARPETAS_IMAGENES_CATEGORIAS', $_SERVER['DOCUMENT_ROOT'] . '/img/categorias_productos');

function debuguear($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}


function obtenerCantidadCarrito(): int
{
    return array_sum($_SESSION['carrito'] ?? []);
}