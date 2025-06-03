<?php

namespace Controllers;

use MVC\Router;
use Model\Notificacion;
use Model\CategoriaProducto;
use Model\Producto;


class NotificacionController
{
    // Mostrar todas las notificaciones de un usuario
    public static function index(Router $router)
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /login');
            return;
        }

        $idUsuario = $_SESSION['id'];
        $rol = $_SESSION['rol'] ?? 'cliente'; // por defecto


        $notificaciones = [];
        if (isset($_SESSION['autenticado_Cliente']) && isset($_SESSION['id'])) {
            $notificaciones = Notificacion::obtenerPorUsuario($_SESSION['id']);
        }

        // Detectar el layout a renderizar según el rol
        switch ($rol) {
            case '1':
                $router->renderAdmin('notificaciones/index', [
                    'titulo' => 'Notificaciones',
                    'notificaciones' => $notificaciones
                ]);
                break;
            case '2':
                $router->renderVendedor('notificaciones/index', [
                    'titulo' => 'Notificaciones',
                    'notificaciones' => $notificaciones
                ]);
                break;
            case '3':
                $router->renderRepartidor('notificaciones/index', [
                    'titulo' => 'Notificaciones',
                    'notificaciones' => $notificaciones
                ]);
                break;
            case '4':
                $categorias = CategoriaProducto::obtener7Categorias();
                $categoriasMes = CategoriaProducto::obtener3CategoriasDestacadas();
                $productosDestacados = Producto::obtenerDestacados();
                $router->renderLanding('notificaciones/index', [
                    'categoriasMes' => $categoriasMes,
                    'productosDestacados' => $productosDestacados,
                    'categorias' => $categorias,
                    'carritoCantidad' => obtenerCantidadCarrito(),
                    'titulo' => 'Notificaciones',
                    'notificaciones' => $notificaciones
                ]);
                break;
        }
    }

    // Marcar notificación como eliminada (lógica)
    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if ($id) {
                Notificacion::eliminarLogicamente($id);
            }

            header('Location: /notificaciones');
            exit;
        }
    }

    // Crear una notificación desde otra acción (puede llamarse internamente)
    public static function crear($titulo, $descripcion, $idUsuario)
    {
        return Notificacion::crearNotificacion($titulo, $descripcion, $idUsuario);
    }
}
