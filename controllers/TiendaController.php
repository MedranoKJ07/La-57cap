<?php

namespace Controllers;

use MVC\Router;
use Model\CategoriaProducto;
use Model\Producto;
use Model\Notificacion;
class TiendaController
{
    public static function shop(Router $router)
    {
        $notificaciones = [];
        if (isset($_SESSION['autenticado_Cliente']) && isset($_SESSION['id'])) {
            $notificaciones = Notificacion::obtenerPorUsuario($_SESSION['id']);
        }

        // Obtener parámetros desde la URL
        $categoriaId = $_GET['categoria'] ?? '';
        $buscar = $_GET['buscar'] ?? '';
        $orden = $_GET['orden'] ?? '';
        $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
        $porPagina = 9;
        $categoriaNombre = '';
        if ($categoriaId !== '') {
            $categoria = CategoriaProducto::find($categoriaId, 'idcategoria_producto');
            $categoriaNombre = $categoria->titulo ?? '';
        }


        // Sanitizar
        $categoriaId = trim($categoriaId);
        $buscar = trim($buscar);
        $orden = trim($orden);

        if ($pagina < 1)
            $pagina = 1;

        // Filtrar productos
        $productos = Producto::filtrar2($categoriaId, $buscar, $orden);

        // Obtener el total para paginación
        $totalProductos = Producto::contarFiltrados($categoriaId, $buscar);
        $totalPaginas = max(1, ceil($totalProductos / $porPagina));

        // Cargar categorías
        $categorias = CategoriaProducto::obtener7Categorias();

        // Renderizar vista
        $router->renderLanding('/Main/shop', [
            'notificaciones' => $notificaciones,
            'productos' => $productos,
            'categorias' => $categorias,
            'titulo' => 'Tienda',
            'paginaActual' => $pagina,
            'totalPaginas' => $totalPaginas,
            'categoriaSeleccionada' => $categoriaId,
            'categoriaNombre' => $categoriaNombre,
            'busqueda' => $buscar,
            'ordenSeleccionado' => $orden
        ]);
    }
}
