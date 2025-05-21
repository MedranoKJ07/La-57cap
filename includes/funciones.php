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

function esUltimo(string $actual, string $proximo): bool
{

    if ($actual !== $proximo) {
        return true;
    }
    return false;
}

// Función que revisa que el usuario este autenticado
function isAuth(): void
{
    if (!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function isAdmin(): void
{
    if (!isset($_SESSION['admin'])) {
        header('Location: /');
    }
}
function FilterValidateInt($id, $cadena)
{
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
        header('Location: /' . $cadena);
    }

}
function verificarId($id, $cadena)
{
    if (!$id) {
        header('Location: /' . $cadena);
    }
}
function obtenerCantidadCarrito(): int
{
    return array_sum($_SESSION['carrito'] ?? []);
}