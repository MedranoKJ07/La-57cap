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
        if (!isset($_SESSION['autenticado_Cliente'])) {
            header('Location: /login');
            exit;
        }

        $categorias = CategoriaProducto::obtener7Categorias();

        // Obtener el cliente desde la sesión
        $id_usuario = $_SESSION['id'] ?? null;
        $cliente = Cliente::where('id_usuario', $id_usuario);
        if (!$cliente) {
            header('Location: /');
            exit;
        }

        // Obtener pedidos del cliente
        $pedidos = Pedido::obtenerPorCliente($cliente->idcliente);

        $router->renderLanding('/Cliente/pedidos', [
            'pedidos' => $pedidos,
            'categorias' => $categorias,
            'titulo' => 'Mis pedidos'
        ]);
    }
}
