<?php

namespace Controllers;

use MVC\Router;
use Model\CategoriaProducto;

class CategoriaProductoController
{
    public static function GestionarCategorias(Router $router)
    {
        $busqueda = $_POST['busqueda'] ?? '';
        $categorias = CategoriaProducto::obtenerTodas($busqueda);

        $router->renderAdmin('Admin/categorias_producto/GestionCategoriasProducto', [
            'categorias' => $categorias,
            'busqueda' => $busqueda,
            'titulo' => 'Gestión de Categorías de Producto'
        ]);
    }

    public static function CrearCategoria(Router $router)
    {
        $categoria = new CategoriaProducto;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoria->sincronizar($_POST['categoria']);
            $alertas = $categoria->validar();

            if (empty($alertas)) {
                $categoria->crear();
                header('Location: /admin/GestionarCategoriaProducto');
                return;
            }
        }

        $router->renderAdmin('Admin/categorias_producto/CrearCategoriaProducto', [
            'categoria' => $categoria,
            'alertas' => $alertas,
            'titulo' => 'Crear Categoría de Producto'
        ]);
    }

    public static function ActualizarCategoria(Router $router)
    {
        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {
                header('Location: /admin/GestionarCategoriaProducto');
            return;
        }

        $categoria = CategoriaProducto::find($id, 'idcategoria_producto');
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoria->sincronizar($_POST['categoria']);
            $alertas = $categoria->validar();

            if (empty($alertas)) {
                $categoria->actualizar($id);
                header('Location: /admin/GestionarCategoriaProducto');
                return;
            }
        }

        $router->renderAdmin('Admin/categorias_producto/ActualizarCategoriaProducto', [
            'categoria' => $categoria,
            'alertas' => $alertas,
            'titulo' => 'Actualizar Categoría de Producto'
        ]);
    }

    public static function EliminarCategoria()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if ($id && is_numeric($id)) {
                $categoria = CategoriaProducto::find($id, 'idcategoria_producto');
                if ($categoria) {
                    $categoria->eliminarLogico($id);
                }
            }

            header('Location: /admin/categorias_producto/GestionarCategorias');
        }
    }
}
