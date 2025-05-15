<?php

namespace Controllers;

use MVC\Router;
use Model\Producto;
use Model\CategoriaProducto;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
class ProductoController
{

    public static function GestionarProductos(Router $router)
    {
        $busqueda = $_POST['busqueda'] ?? '';
        $categoriaSeleccionada = $_POST['categoria'] ?? '';

        $productos = Producto::filtrar($busqueda, $categoriaSeleccionada);
        $categorias = CategoriaProducto::obtenerTodas();

        $router->renderAdmin('Admin/producto/GestionarProducto', [
            'productos' => $productos,
            'categorias' => $categorias,
            'busqueda' => $busqueda,
            'categoriaSeleccionada' => $categoriaSeleccionada,
            'titulo' => 'Gestión de Productos'
        ]);
    }

    public static function CrearProducto(Router $router)
    {
        $producto = new Producto;
        $categorias = CategoriaProducto::obtenerTodas();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto->sincronizar($_POST['producto']);

            // Generar código de producto automáticamente
            if (empty($producto->codigo_producto)) {
                $producto->codigo_producto = Producto::generarCodigoProducto(
                    $producto->nombre_producto,
                    $producto->id_categoria
                );
            }

            $alertas = $producto->validar();

            if ($_FILES['producto']['tmp_name']['Foto']) {
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['producto']['tmp_name']['Foto'])->cover(800, 600);
                $producto->setImagen($nombreImagen);

                if (!is_dir(CARPETAS_IMAGENES_PRODUCTOS)) {
                    mkdir(CARPETAS_IMAGENES_PRODUCTOS);
                }

                $imagen->save(CARPETAS_IMAGENES_PRODUCTOS . "/" . $nombreImagen);
            }
            if (empty($alertas)) {

                $producto->crear();
                header('Location: /admin/GestionarProducto');
            }
        }

        $router->renderAdmin('Admin/producto/CrearProducto', [
            'producto' => $producto,
            'categorias' => $categorias,
            'alertas' => $alertas,
            'titulo' => 'Crear Producto'
        ]);
    }


    public static function ActualizarProducto(Router $router)
    {
        $id = s($_GET['id']);
        $producto = Producto::find($id, 'idproducto');
        $categorias = CategoriaProducto::obtenerTodas();
        $alertas = [];

        if (!$producto) {
            header('Location: /admin/GestionarProducto');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto->sincronizar($_POST['producto']);
            $alertas = $producto->validar();
            if ($_FILES['producto']['tmp_name']['Foto']) {
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['producto']['tmp_name']['Foto'])->cover(800, 600);
                $producto->setImagen($nombreImagen);

                if (!is_dir(CARPETAS_IMAGENES_PRODUCTOS)) {
                    mkdir(CARPETAS_IMAGENES_PRODUCTOS);
                }

                $imagen->save(CARPETAS_IMAGENES_PRODUCTOS . "/" . $nombreImagen);
            }

            if (empty($alertas)) {
                $producto->actualizar($id);
                header('Location: /admin/GestionarProducto');
            }
        }

        $router->renderAdmin('Admin/producto/ActualizarProducto', [
            'producto' => $producto,
            'categorias' => $categorias,
            'alertas' => $alertas,
            'titulo' => 'Actualizar Producto'
        ]);
    }

    public static function EliminarProducto()
    {
        $alertas = Producto::getAlertas();
        $id = $_POST['id'];
        FilterValidateInt($id, 'admin/GestionarProducto');
        verificarId(Producto::find($id, 'idproducto'), 'admin/GestionarProducto');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = s($_POST['id']);
            $producto = Producto::find($id, 'idproducto');
            Producto::eliminarLogico($id);
            $producto->delete_image();
            header('Location: /admin/GestionarProducto');
        }
    }
}
