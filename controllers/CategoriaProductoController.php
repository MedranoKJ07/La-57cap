<?php

namespace Controllers;

use MVC\Router;
use Model\CategoriaProducto;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class CategoriaProductoController
{
    public static function GestionarCategorias(Router $router)
    {
        $busqueda = $_POST['busqueda'] ?? '';
        $categorias = CategoriaProducto::filtrar($busqueda);

      
        

        $router->renderAdmin('Admin/categorias_producto/GestionCategoriasProducto', [
            'categorias' => $categorias,
            'busqueda' => $busqueda,
            'titulo' => 'Gestión de Categorías de Productos'
        ]);
    }


    public static function CrearCategoria(Router $router)
    {
        $categoria = new CategoriaProducto;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoria->sincronizar($_POST['categoria']);
            $alertas = $categoria->validar();
            //generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if ($_FILES['categoria']['tmp_name']['foto']) {
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['categoria']['tmp_name']['foto'])->cover(800, 600);
                $categoria->setImagen($nombreImagen);
                if (!is_dir(CARPETAS_IMAGENES_CATEGORIAS)) {
                    mkdir(CARPETAS_IMAGENES_CATEGORIAS);
                }
                $imagen->save(CARPETAS_IMAGENES_CATEGORIAS . "/" . $nombreImagen);
            }
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
          

            if ($_FILES['categoria']['tmp_name']['foto']) {
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['categoria']['tmp_name']['foto'])->cover(800, 600);
                $categoria->setImagen($nombreImagen);
                $categoria->delete_image();

                if (!is_dir(CARPETAS_IMAGENES_CATEGORIAS)) {
                    mkdir(CARPETAS_IMAGENES_CATEGORIAS);
                }

                $imagen->save(CARPETAS_IMAGENES_CATEGORIAS . "/" . $nombreImagen);
            }

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
        $alertas = CategoriaProducto::getAlertas();
        $id = $_POST['id'] ?? null;

        FilterValidateInt($id, 'admin/GestionarCategoriaProducto');
        verificarId(CategoriaProducto::find($id, 'idcategoria_producto'), 'admin/GestionarCategoriaProducto');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if ($id && is_numeric($id)) {
                $categoria = CategoriaProducto::find($id, 'idcategoria_producto');
                if ($categoria) {
                    $categoria->eliminarLogico($id);
                }
            }

            header('Location: /admin/GestionarCategoriaProducto');
        }
    }
}
