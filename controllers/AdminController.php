<?php

namespace Controllers;

use MVC\Router;
use Model\Rol;
use Model\Calificaciones;
use Model\Pedido;
use Model\DetalleVenta;
use Model\Notificacion;

class AdminController
{
    public static function Admin(Router $router)
    {
        $roles = Rol::get(3);
        $notificaciones = Notificacion::obtenerPorUsuario($_SESSION['id']);

        $router->renderAdmin('Admin/AdminPages', [
            'roles' => $roles,
            'titulo' => 'Administración',
            'notificaciones' => $notificaciones
        ]);
    }

    public static function verCalificaciones(Router $router)
    {
        $calificaciones = Calificaciones::obtenerTodasConDetalles();
        $notificaciones = Notificacion::obtenerPorUsuario($_SESSION['id']);

        $router->renderAdmin('Admin/calificaciones/calificaciones', [
            'titulo' => 'Calificaciones de Pedidos',
            'calificaciones' => $calificaciones,
            'notificaciones' => $notificaciones
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
        $notificaciones = Notificacion::obtenerPorUsuario($_SESSION['id']);

        $router->renderAdmin('Admin/calificaciones/DetalleCalificacion', [
            'titulo' => 'Detalle de Pedido Calificado',
            'pedido' => $pedido,
            'detalles' => $detalles,
            'notificaciones' => $notificaciones
        ]);
    }

    public static function verPedidos(Router $router)
    {
        $pedidos = Pedido::obtenerTodosConDetalles();
        $notificaciones = Notificacion::obtenerPorUsuario($_SESSION['id']);

        $router->renderAdmin('Admin/pedidos/verPedidos', [
            'titulo' => 'Ver Pedidos',
            'pedidos' => $pedidos,
            'notificaciones' => $notificaciones
        ]);
    }

    public static function detallePedido(Router $router)
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: /admin/pedidos');
            exit;
        }

        $pedido = Pedido::obtenerDetalleConCalificacion($id);
        if (!$pedido) {
            $_SESSION['error'] = 'Pedido no encontrado.';
            header('Location: /admin/pedidos');
            exit;
        }

        $productos = DetalleVenta::obtenerPorVenta($pedido['id_ventas']);
        $notificaciones = Notificacion::obtenerPorUsuario($_SESSION['id']);

        $router->renderAdmin('Admin/pedidos/detalle', [
            'titulo' => 'Detalle del Pedido',
            'pedido' => $pedido,
            'productos' => $productos,
            'notificaciones' => $notificaciones
        ]);
    }
}
