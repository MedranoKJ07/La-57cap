<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Model\Cliente;
use Model\Rol;
use Model\Pedido;
use Model\CategoriaProducto;
class ClienteController
{
    public static function GestionarCliente(Router $router)
    {
        $busqueda = $_POST['busqueda'] ?? '';

        $clientes = Cliente::obtenerTodosConUsuario($busqueda);


        $router->renderAdmin('Admin/clients/GestionCliente', [
            'clientes' => $clientes,
            'busqueda' => $busqueda,
            'titulo' => 'Gestionar Clientes'
        ]);
    }
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
    public static function pedido(Router $router)
    {
        isAuth(); // Asegúrate que solo accede si está autenticado

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /cliente/pedidos');
            return;
        }
        $categorias = CategoriaProducto::obtener7Categorias();

        $categorias = CategoriaProducto::obtener7Categorias();
        $pedido = Pedido::find($id, 'idpedidos'); // Busca pedido
        $productos = Pedido::obtenerProductosConDetalles($id); // Productos del pedido

        $router->renderLanding('cliente/DetallePedido', [
            'pedido' => $pedido,
            'carritoCantidad' => obtenerCantidadCarrito(),
            'categorias' => $categorias,
            'productos' => $productos,
            'titulo' => 'Detalle del Pedido'
        ]);
    }


}