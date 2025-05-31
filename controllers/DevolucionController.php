<?php

namespace Controllers;

use Model\Cliente;
use MVC\Router;
use Model\Devolucion;
use Model\DevolucionDetalle;
use Model\Venta;
use Controllers\NotificacionController;

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
    public static function detalle(Router $router)
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /admin/devoluciones');
            exit;
        }

        // Obtener devolución con datos del cliente
        $devolucion = Devolucion::obtenerConCliente($id);
        if (!$devolucion) {
            header('Location: /admin/devoluciones');
            exit;
        }

        // Obtener los productos solicitados en la devolución
        $detalles = DevolucionDetalle::obtenerDetallesConProducto($id);

        $router->renderAdmin('admin/devoluciones/detalle', [
            'devolucion' => $devolucion,
            'detalles' => $detalles
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
            NotificacionController::crear(
                'Respuesta a solicitud de devolución',
                'Se ha aprobado tu solicitud de devolución. Por favor, visitar la tienda para completar el proceso.',
                Cliente::obtenerUsuarioId($venta->id_cliente)// o quien debe recibirla
            );
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
            
            NotificacionController::crear(
                'Respuesta a solicitud de devolución',
                'Se ha rechazado tu solicitud de devolución. Motivo: ' . $motivo,
                Cliente::obtenerUsuarioId($venta->id_cliente)// o quien debe recibirla
            );
            header('Location: /admin/devoluciones');
        }
    }

    public static function visitarTienda(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if (!$id) {
                header('Location: /admin/devoluciones');
                return;
            }

            $devolucion = Devolucion::find($id, 'idDevoluciones');
            if ($devolucion) {
                $devolucion->Estado = 'Visitar tienda';
                $devolucion->actualizar($devolucion->idDevoluciones);
                $venta = Venta::find($devolucion->ventas_idventas, 'idventas');
                if ($venta) {
                    $venta->estado = 'Visitar tienda';
                    $venta->actualizar($venta->idventas);
                }
            }
             
            NotificacionController::crear(
                'Visitar tienda',
                'Por favor, visita la tienda para resolver tu solicitud de devolución. Llevar el producto. y los comprobantes de compra.',
                Cliente::obtenerUsuarioId($venta->id_cliente)// o quien debe recibirla
            );
            header('Location: /admin/devoluciones');
        }
    }


}
