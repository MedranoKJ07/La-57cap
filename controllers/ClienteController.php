<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Model\Cliente;
use Model\Rol;
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
}