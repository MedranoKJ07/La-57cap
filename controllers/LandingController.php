<?php

namespace Controllers;

use MVC\Router;
use Model\CategoriaProducto;
use Model\Producto;

class LandingController
{
    public static function index(Router $router)
    {
        $categorias = CategoriaProducto::obtener7Categorias();
        $categoriasMes = CategoriaProducto::obtener3CategoriasDestacadas();
        $productosDestacados = Producto::obtenerDestacados();

        $router->renderLanding('landing', [
            'categoriasMes' => $categoriasMes,
            'productosDestacados' => $productosDestacados,
            'categorias' => $categorias,
            'carritoCantidad' => obtenerCantidadCarrito(),
            'titulo' => 'Bienvenido'
        ]);
    }
    public static function about(Router $router)
    {
        $categorias = CategoriaProducto::obtener7Categorias();
        $router->renderLanding('/Main/about', [
            'categorias' => $categorias,
            'carritoCantidad' => obtenerCantidadCarrito(),
            'titulo' => 'Bienvenido'
        ]);
    }
    public static function contact(Router $router)
    {
        $categorias = CategoriaProducto::obtener7Categorias();
        $router->renderLanding('/Main/contact', [
            'categorias' => $categorias,
            'carritoCantidad' => obtenerCantidadCarrito(),
            'titulo' => 'Bienvenido'
        ]);
    }
}
