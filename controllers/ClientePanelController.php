<?php

namespace Controllers;

use MVC\Router;
use Model\Pedido;
use Model\CategoriaProducto;
use Model\Cliente;

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

        // Buscar el cliente
        $cliente = Cliente::where('id_usuario', $idUsuario);
        if (!$cliente) {
            header('Location: /');
            exit;
        }

        // Obtener pedidos del cliente
        $pedidos = Pedido::obtenerPorCliente($cliente->idcliente);

        $router->renderLanding('Cliente/MisPedidos', [
            'titulo' => 'Mis Pedidos',
            'pedidos' => $pedidos,
            'categorias' => $categorias
        ]);
    }
}
