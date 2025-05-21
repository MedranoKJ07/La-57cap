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

        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        $_SESSION['carrito'][$id] = ($_SESSION['carrito'][$id] ?? 0) + 1;

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
