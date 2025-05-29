<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Model\Cliente;
use Model\Rol;
use Model\Calificaciones;
use Model\Pedido;
use Model\DetalleVenta;


class AdminController
{

    public static function Admin(Router $router)
    {
        $roles = Rol::get(3);

        $router->renderAdmin('Admin/AdminPages', [
            'roles' => $roles,
            'titulo' => 'Administración',
        ]);
    }
    public static function verCalificaciones(Router $router)
    {


        $calificaciones = Calificaciones::obtenerTodasConDetalles();

        $router->renderAdmin('Admin/calificaciones/calificaciones', [
            'titulo' => 'Calificaciones de Pedidos',
            'calificaciones' => $calificaciones
        ]);
    }
    public static function detalleCalificacion(Router $router)
    {


        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /admin/calificaciones');
            exit;
        }

        $pedido = Pedido::obtenerConCalificacionPorId($id);

        $detalles = DetalleVenta::obtenerPorVenta($pedido['id_ventas']);

        $router->renderAdmin('Admin/calificaciones/DetalleCalificacion', [
            'titulo' => 'Detalle de Pedido Calificado',
            'pedido' => $pedido,
            'detalles' => $detalles
        ]);
    }
    public static function verPedidos(Router $router)
    {


        $pedidos = Pedido::obtenerTodosConDetalles();

        $router->renderAdmin('Admin/pedidos/verPedidos', [
            'titulo' => 'Ver Pedidos',
            'pedidos' => $pedidos
        ]);
    }

    public static function detallePedido(Router $router)
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: /admin/pedidos');
            exit;
        }

        // Obtener datos del pedido, cliente, repartidor y calificación si existe
        $pedido = Pedido::obtenerDetalleConCalificacion($id);

        if (!$pedido) {
            $_SESSION['error'] = 'Pedido no encontrado.';
            header('Location: /admin/pedidos');
            exit;
        }

        // Obtener productos de la venta asociada
        $productos = DetalleVenta::obtenerPorVenta($pedido['id_ventas']);

        $router->renderAdmin('Admin/pedidos/detalle', [
            'titulo' => 'Detalle del Pedido',
            'pedido' => $pedido,
            'productos' => $productos
        ]);
    }

}