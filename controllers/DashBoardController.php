<?php

namespace Controllers;

use MVC\Router;
use Model\Venta;
use Model\Pedido;
use Model\Inventario;
use Model\Devolucion;
use Model\Cliente;
use Model\Producto;

class DashboardController
{
 
    public static function Dashboard(Router $router)
    {
        $datos = [
            'totalVentas' => Venta::totalVentas(),
            'ingresos' => Venta::totalIngresos(),
            'pedidosEntregados' => Pedido::totalEntregados(),
            'devoluciones' => Devolucion::totalDevoluciones(),
            'clientes' => Cliente::totalClientes()-1,
            'stockBajo' => Inventario::stockBajo(),
            'productos' => Producto::totalProductos()
        ];

        $router->renderAdmin('Admin/Dashboard/dashboard', [
            'titulo' => 'Panel Principal',
            'datos' => $datos
        ]);
    }

}
