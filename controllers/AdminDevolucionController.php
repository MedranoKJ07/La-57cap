<?php
namespace Controllers;

use MVC\Router;
use Model\Devolucion;
use Model\Cliente;
use Model\DevolucionDetalle;

class AdminDevolucionController
{
    public static function GestionarDevoluciones(Router $router)
    {
        $devoluciones = Devolucion::obtenerTodasConCliente();

        $router->renderAdmin('admin/devoluciones/GestionarDevoluciones', [
            'titulo' => 'Solicitudes de Devolución',
            'devoluciones' => $devoluciones
        ]);
    }

    public static function aprobar()
    {
        $id = $_POST['id'] ?? null;
        $devolucion = Devolucion::find($id, 'idDevoluciones');
        if ($devolucion) {
            $devolucion->aprobar();
        }
        header('Location: /admin/devoluciones');
    }

    public static function rechazar()
    {
        $id = $_POST['id'] ?? null;
        $motivo = $_POST['motivo'] ?? 'Sin motivo';
        $devolucion = Devolucion::find($id, 'idDevoluciones');
        if ($devolucion) {
            $devolucion->rechazar($motivo);
        }
        header('Location: /admin/devoluciones');
    }

    public static function detalle(Router $router)
    {
        $id = $_GET['id'] ?? null;
        if (!$id)
            header('Location: /admin/devoluciones');

        $devolucion = Devolucion::find($id, 'idDevoluciones');
        if (!$devolucion)
            header('Location: /admin/devoluciones');

        // Obtener nombre del cliente
        $cliente = Cliente::find($devolucion->cliente_idcliente, 'idcliente');
        $devolucion->cliente_nombre = $cliente ? $cliente->p_nombre . ' ' . $cliente->p_apellido : 'Desconocido';

        // Productos devueltos
        $detalles = DevolucionDetalle::obtenerPorDevolucion($id);

        $router->renderAdmin('admin/devoluciones/Detalle', [
            'titulo' => 'Detalle de Devolución',
            'devolucion' => $devolucion,
            'detalles' => $detalles
        ]);
    }


}
