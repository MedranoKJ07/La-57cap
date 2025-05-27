<?php

namespace Controllers;

use MVC\Router;
use Model\Inventario;
use Model\Producto;

class InventarioController
{
    public static function GestionarInventario(Router $router)
    {
        $registros = Inventario::obtenerTodoConProducto();

        $router->renderAdmin('Admin/inventario/GestionarInventario', [
            'titulo' => 'Inventario General',
            'registros' => $registros
        ]);
    }
    public static function Inventario(Router $router)
    {
        $registros = Inventario::obtenerTodoConProducto();

        $router->renderVendedor('Vendedor/inventario/inventario', [
            'titulo' => 'Inventario General',
            'registros' => $registros
        ]);
    }
    

    public static function AjustarInventario(Router $router)
    {
        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            header('Location: /admin/GestionarInventario');
            return;
        }

        $inventario = Inventario::find($id);
        if (!$inventario) {
            header('Location: /admin/GestionarInventario');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inventario->cantidad_actual = $_POST['cantidad_actual'];
            $inventario->fecha_actualizacion = date('Y-m-d H:i:s');
            $inventario->guardar();

            header('Location: /admin/GestionarInventario');
            return;
        }

        $producto = Producto::find($inventario->producto_idproducto);

        $router->renderAdmin('Admin/inventario/AjustarInventario', [
            'titulo' => 'Ajustar Inventario',
            'inventario' => $inventario,
            'producto' => $producto
        ]);
    }
}
