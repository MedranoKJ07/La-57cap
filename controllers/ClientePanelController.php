<?php

namespace Controllers;

use MVC\Router;
use Model\Pedido;
use Model\CategoriaProducto;
use Model\Cliente;
use Model\Calificaciones;
use Model\Notificacion;

class ClientePanelController
{
    public static function pedidos(Router $router)
    {
        if (empty($_SESSION['autenticado_Cliente'])) {
            header('Location: /login');
            exit;
        }

        $categorias = CategoriaProducto::obtener7Categorias();
        $idUsuario = $_SESSION['id'] ?? null;

        $cliente = Cliente::where('id_usuario', $idUsuario);
        if (!$cliente) {
            header('Location: /');
            exit;
        }

        $pedidos = Pedido::obtenerPorCliente($cliente->idcliente);
        $calificados = [];

        foreach ($pedidos as $pedido) {
            $calificados[$pedido->idpedidos] = Calificaciones::existeParaPedidoYCliente($pedido->idpedidos, $cliente->idcliente);
        }

        // 🔔 Obtener notificaciones del cliente
        $notificaciones = Notificacion::obtenerPorUsuario($idUsuario);

        $router->renderLanding('Cliente/MisPedidos', [
            'titulo' => 'Mis Pedidos',
            'pedidos' => $pedidos,
            'categorias' => $categorias,
            'calificados' => $calificados,
            'notificaciones' => $notificaciones
        ]);
    }

    public static function calificarPedido(Router $router)
    {
        if (empty($_SESSION['autenticado_Cliente'])) {
            header('Location: /login');
            exit;
        }

        $idPedido = $_GET['id'] ?? null;
        if (!$idPedido) {
            header('Location: /cliente/pedidos');
            exit;
        }

        $pedido = Pedido::find($idPedido, 'idpedidos');
        if (!$pedido) {
            header('Location: /cliente/pedidos');
            exit;
        }

        $cliente = Cliente::where('id_usuario', $_SESSION['id']);
        if (!$cliente || $cliente->idcliente != $pedido->id_cliente) {
            header('Location: /cliente/pedidos');
            exit;
        }

        // Verificar si ya fue calificado
        if (Calificaciones::existeParaPedidoYCliente($pedido->idpedidos, $cliente->idcliente)) {
            header('Location: /cliente/pedidos');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $puntuacion = $_POST['puntuacion'] ?? null;
            $comentario = trim($_POST['comentario'] ?? '');
            $idRepartidor = $pedido->id_repartidor;

            if (!$puntuacion || !$comentario || !$idRepartidor || !is_numeric($puntuacion)) {
                header('Location: /cliente/pedidos');
                exit;
            }

            $calificacion = new Calificaciones([
                'puntuacion' => (int) $puntuacion,
                'comentario' => $comentario,
                'fecha_clasificacion' => date('Y-m-d H:i:s'),
                'pedidos_idpedidos' => $pedido->idpedidos,
                'cliente_idcliente' => $cliente->idcliente,
                'repartidor_idrepartidor' => $idRepartidor
            ]);

            $calificacion->crear();
            header('Location: /cliente/pedidos');
            exit;
        }

        // 🔔 Notificaciones también aquí si usás el mismo layout
        $notificaciones = Notificacion::obtenerPorUsuario($_SESSION['id']);

        $router->renderLanding('Cliente/calificar', [
            'titulo' => 'Calificar Pedido',
            'pedido' => $pedido,
            'cliente' => $cliente,
            'notificaciones' => $notificaciones
        ]);
    }
}
