<?php

namespace Controllers;

use MVC\Router;
use Model\CategoriaProducto;
use Model\Producto;

class TiendaController
{
    public static function shop(Router $router)
    {
        $categoriaId = $_GET['categoria'] ?? null;
        $buscar = $_GET['buscar'] ?? null;
        $orden = $_GET['orden'] ?? null;

        if ($categoriaId) {
            FilterValidateInt($categoriaId, 'tienda');
        }

        $paginaActual = isset($_GET['pagina']) ? max(1, (int) $_GET['pagina']) : 1;
        $productosPorPagina = 9;
        $offset = ($paginaActual - 1) * $productosPorPagina;

        $totalProductos = Producto::contarPorCategoria($categoriaId, $buscar);
        $totalPaginas = ceil($totalProductos / $productosPorPagina);

        $productos = Producto::obtenerPorCategoria($categoriaId, $buscar, $orden, $productosPorPagina, $offset);
        $categorias = CategoriaProducto::obtener7Categorias();

        $router->renderLanding('/Main/shop', [
            'categorias' => $categorias,
            'productos' => $productos,
            'totalPaginas' => $totalPaginas,
            'paginaActual' => $paginaActual,
            'titulo' => 'Tienda'
        ]);
    }



    public static function producto(Router $router)
    {
        $id = $_GET['id'] ?? null;
        FilterValidateInt($id, 'tienda');

        $producto = Producto::obtenerPorId($id);

        if (!$producto) {
            header('Location: /tienda');
            exit;
        }

        $router->renderLanding('/Main/producto', [
            'producto' => $producto,
            'titulo' => 'Detalle del Producto'
        ]);
    }
}
