<?php

namespace Controllers;

use MVC\Router;
use Model\Producto;
use Model\CategoriaProducto;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorSVG;
use Dompdf\Dompdf;
use Dompdf\Options;




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


    public static function VerCodigoBarras(Router $router)
    {
        $id = $_GET['id'];
        $producto = Producto::find($id, 'idproducto');

        if (!$producto) {
            header('Location: /admin/GestionarProducto');
            exit;
        }


        $generator = new BarcodeGeneratorPNG();
        $codigo = $producto->codigo_producto;
        $barcode = base64_encode($generator->getBarcode($codigo, $generator::TYPE_CODE_128));

        $router->renderAdmin('Admin/producto/GenerarCodigoBarras', [
            'codigo' => $codigo,
            'barcode' => $barcode,
            'producto' => $producto,
            'titulo' => 'Código de Barras'
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

                $producto->delete_image();
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
    public static function DescargarCodigoBarras(Router $router)
    {
        $id = $_GET['id'] ?? null;
        $formato = $_GET['formato'] ?? 'png';
        $producto = Producto::find($id, 'idproducto');

        if (!$producto) {
            header('Location: /admin/GestionarProducto');
            exit;
        }

        $codigo = $producto->codigo_producto;
        $nombreArchivo = $codigo . '_barcode';

        switch ($formato) {
            case 'pdf':
                $generator = new BarcodeGeneratorPNG();
                $barcode = base64_encode($generator->getBarcode($codigo, $generator::TYPE_CODE_128));

                // Configuración de DomPDF
                $options = new Options();
                $options->set('isRemoteEnabled', true);
                $dompdf = new Dompdf($options);

                // HTML para el PDF
                $html = "
        <h2 style='text-align: center;'>$producto->nombre_producto</h2>
        <div style='text-align: center; margin-top: 30px;'>
            <img src='data:image/png;base64,{$barcode}' style='width: 300px; height: auto;' />
            <p><strong>$codigo</strong></p>
        </div>
    ";

                $dompdf->loadHtml($html);
                $dompdf->setPaper('A6', 'portrait');
                $dompdf->render();
                $dompdf->stream($nombreArchivo . ".pdf", ["Attachment" => true]);
                break;


            case 'svg':
                $generator = new BarcodeGeneratorSVG();
                header('Content-Type: image/svg+xml');
                header("Content-Disposition: attachment; filename=$nombreArchivo.svg");
                echo $generator->getBarcode($codigo, $generator::TYPE_CODE_128);
                break;

            case 'png':
            default:
                $generator = new BarcodeGeneratorPNG();
                header('Content-Type: image/png');
                header("Content-Disposition: attachment; filename=$nombreArchivo.png");
                echo $generator->getBarcode($codigo, $generator::TYPE_CODE_128);
                break;
        }
    }

}
