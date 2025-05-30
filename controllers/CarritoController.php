<?php

namespace Controllers;

use Model\Producto;
use Model\CategoriaProducto;
use MVC\Router;

class CarritoController
{



    public static function agregar()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /tienda');
            exit;
        }

        // Obtener producto con stock actual
        $producto = Producto::obtenerPorId($id);

        // Si el producto no existe o está eliminado
        if (!$producto) {
            header('Location: /tienda');
            exit;
        }

        // Calcular stock disponible real
        $stockDisponible = (int) $producto->cantidad_actual - (int) $producto->cantidad_minima;

        if ($stockDisponible <= 0) {
            // Mostrar error o redirigir con mensaje
            $_SESSION['error'] = 'Este producto ya no está disponible.';
            header('Location: /tienda');
            exit;
        }

        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        $cantidadActual = $_SESSION['carrito'][$id] ?? 0;

        // Evitar que se agregue más del stock permitido
        if ($cantidadActual >= $stockDisponible) {
            $_SESSION['error'] = 'No se puede agregar más unidades de este producto.';
            header('Location: /tienda');
            exit;
        }

        $_SESSION['carrito'][$id] = $cantidadActual + 1;

        // ✅ Redirige directamente al carrito
        header('Location: /carrito');
        exit;
    }



    public static function eliminar()
    {
        $id = $_GET['id'] ?? null;
        if ($id && isset($_SESSION['carrito'][$id])) {
            unset($_SESSION['carrito'][$id]);
        }

        header('Location: /carrito');
        exit;
    }

    public static function mostrar(Router $router)
    {
        $categorias = CategoriaProducto::obtener7Categorias();
        $productos = [];

        $total = 0;
        $subtotal = $total / 1.15; // Asumiendo 15% de IVA
        $iva = $total - $subtotal;


        foreach ($_SESSION['carrito'] ?? [] as $id => $cantidad) {
            $producto = Producto::obtenerPorId($id);
            if ($producto) {
                $producto->cantidad = $cantidad;
                $producto->subtotal = $producto->precio * $cantidad;
                $productos[] = $producto;
                $total += $producto->subtotal;
            }
        }

        $router->renderLanding('/Main/carrito', [

            'productos' => $productos,
            'categorias' => $categorias,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
            'carritoCantidad' => obtenerCantidadCarrito(),
            'titulo' => 'Tu Carrito'
        ]);
    }
    public static function actualizar()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = (int) ($data['id'] ?? 0);
        $cantidad = max(1, (int) ($data['cantidad'] ?? 1));

        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id] = $cantidad;
        }

        echo json_encode(['ok' => true]);
        exit;
    }

}
