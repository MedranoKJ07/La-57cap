<?php

namespace Controllers;

use MVC\Router;
use Model\CategoriaProducto;
use Model\Producto;
use Model\Notificacion;

class LandingController
{
    public static function index(Router $router)
    {
        $categorias = CategoriaProducto::obtener7Categorias();
        $categoriasMes = CategoriaProducto::obtener3CategoriasDestacadas();
        $productosDestacados = Producto::obtenerDestacados();

        $notificaciones = [];
        if (isset($_SESSION['autenticado_Cliente']) && isset($_SESSION['id'])) {
            $notificaciones = Notificacion::obtenerPorUsuario($_SESSION['id']);
        }

        $router->renderLanding('landing', [
            'categoriasMes' => $categoriasMes,
            'productosDestacados' => $productosDestacados,
            'categorias' => $categorias,
            'carritoCantidad' => obtenerCantidadCarrito(),
            'titulo' => 'Bienvenido',
            'notificaciones' => $notificaciones
        ]);
    }

    public static function about(Router $router)
    {
        $categorias = CategoriaProducto::obtener7Categorias();

        $notificaciones = [];
        if (isset($_SESSION['autenticado_Cliente']) && isset($_SESSION['id'])) {
            $notificaciones = Notificacion::obtenerPorUsuario($_SESSION['id']);
        }

        $router->renderLanding('/Main/about', [
            'categorias' => $categorias,
            'carritoCantidad' => obtenerCantidadCarrito(),
            'titulo' => 'Sobre Nosotros',
            'notificaciones' => $notificaciones
        ]);
    }

    public static function visit_us(Router $router)
    {
        $categorias = CategoriaProducto::obtener7Categorias();

        $notificaciones = [];
        if (isset($_SESSION['autenticado_Cliente']) && isset($_SESSION['id'])) {
            $notificaciones = Notificacion::obtenerPorUsuario($_SESSION['id']);
        }

        $router->renderLanding('/Main/visit_us', [
            'categorias' => $categorias,
            'carritoCantidad' => obtenerCantidadCarrito(),
            'titulo' => 'Contáctanos',
            'notificaciones' => $notificaciones
        ]);
    }
}
