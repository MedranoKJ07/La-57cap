<?php

namespace Controllers;

use MVC\Router;
use Model\CategoriaProducto;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Dompdf\Dompdf;
use Dompdf\Options;
use Model\Venta;
use Model\Cliente;
use Model\DetalleVenta;
use Model\Producto;
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

    public static function generarPDFGarantia(Router $router)
    {
        $ventaId = $_GET['id'] ?? null;
        if (!$ventaId) {
            echo "ID de venta no proporcionado.";
            return;
        }
        $nombreCliente = $_GET['nombreCliente'] ?? 'Cliente Genérico';
        // 1. Obtener venta
        $venta = Venta::find($ventaId, 'idventas');
        if (!$venta) {
            echo "Venta no encontrada";
            exit;
        }

        // 2. Obtener cliente y detalles de la venta
        $cliente = $venta->id_cliente ? Cliente::find($venta->id_cliente, 'idcliente') : null;
        $detalles = DetalleVenta::obtenerDetalleConProductoPorVenta($venta->idventas);

        $productosConGarantia = [];

        // 3. Revisar productos con garantía
        foreach ($detalles as $detalle) {
            if (!isset($detalle['id_producto']))
                continue;

            $producto = Producto::whereAll('idproducto', $detalle['id_producto']);
            if (!$producto)
                continue;

            $categoria = CategoriaProducto::whereAll('idcategoria_producto', $producto->id_categoria);
            if (!$categoria || $categoria->tiene_garantia != '1')
                continue;

            $productosConGarantia[] = [
                'producto' => $producto,
                'categoria' => $categoria,
                'cantidad' => $detalle['cantidad']
            ];
        }

        if (empty($productosConGarantia)) {
            echo "No hay productos con garantía en esta venta.";

        }

        // 6. Logo Base64
        $logoPath = __DIR__ . '/../public/img/logo.png';
        $logoBase64 = base64_encode(file_get_contents($logoPath));

        // 6. Renderizar HTML
        ob_start();
        include __DIR__ . '/../views/Vendedor/PDFGarantia.php';
        $html = ob_get_clean();

        // 6. Generar PDF
        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // 7. Stream: mostrar en el navegador
        $nombrePDF = "certificado_garantia_venta_{$venta->idventas}.pdf";
        $dompdf->stream($nombrePDF, ['Attachment' => false]);
    }


}
