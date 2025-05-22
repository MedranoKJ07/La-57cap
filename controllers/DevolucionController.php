<?php

namespace Controllers;

use MVC\Router;
use Model\Devolucion;
use Model\DevolucionDetalle;
use Model\Venta;

class DevolucionController
{
    // Mostrar todas las solicitudes de devolución
    public static function gestionar(Router $router)
    {
        $devoluciones = Devolucion::obtenerTodasConCliente();

        $router->renderAdmin('admin/devoluciones/GestionarDevoluciones', [
            'titulo' => 'Gestión de Devoluciones',
            'devoluciones' => $devoluciones
        ]);
    }


    public static function aprobar(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if (!$id) {
                header('Location: /admin/devoluciones');
                return;
            }

            $devolucion = Devolucion::find($id, 'idDevoluciones');
            if ($devolucion) {
                $devolucion->Estado = 'Aprobado';
                $devolucion->Aprobado = 1;
                $devolucion->actualizar($devolucion->idDevoluciones);

                $venta = Venta::find($devolucion->ventas_idventas, 'idventas');
                if ($venta) {
                    $venta->estado = 'Devolución aprobada';
                    $venta->actualizar($venta->idventas);
                }
            }

            header('Location: /admin/devoluciones');
        }
    }

    public static function rechazar(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $motivo = $_POST['motivo'] ?? 'Rechazado sin motivo';

            if (!$id) {
                header('Location: /admin/devoluciones');
                return;
            }

            $devolucion = Devolucion::find($id, 'idDevoluciones');
            if ($devolucion) {
                $devolucion->Estado = 'Rechazado';
                $devolucion->observaciones = $motivo;
                $devolucion->Aprobado = 0;
                $devolucion->actualizar($devolucion->idDevoluciones);

                $venta = Venta::find($devolucion->ventas_idventas, 'idventas');
                if ($venta) {
                    $venta->estado = 'Devolución rechazada';
                    $venta->actualizar($venta->idventas);
                }
            }

            header('Location: /admin/devoluciones');
        }
    }
    public static function detalle(Router $router)
{
    if (!isset($_GET['id'])) {
        header('Location: /admin/devoluciones');
        exit;
    }

    $id = $_GET['id'];
    $devolucion = Devolucion::find($id, 'idDevoluciones');

    if (!$devolucion) {
        header('Location: /admin/devoluciones');
        exit;
    }

    $detalles = DevolucionDetalle::obtenerDetallesConProducto($id);

    $router->renderAdmin('admin/devoluciones/detalle', [
        'titulo' => 'Detalle de Devolución',
        'devolucion' => $devolucion,
        'detalles' => $detalles
    ]);
}

}
