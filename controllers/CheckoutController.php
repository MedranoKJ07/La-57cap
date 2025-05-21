<?php

namespace Controllers;

use MVC\Router;
use Model\Producto;
use Model\Venta;
use Model\DetalleVenta;
use Model\Pedido;
class CheckoutController
{
    public static function mostrar(Router $router)
    {
        if (empty($_SESSION['login']) && empty($_SESSION['autenticado_Cliente'])) {
            header('Location: /login');
            exit;
        }

        $productos = [];
        $total = 0;

        foreach ($_SESSION['carrito'] ?? [] as $id => $cantidad) {
            $producto = Producto::obtenerPorId($id);
            if ($producto) {
                $producto->cantidad = $cantidad;
                $producto->subtotal = $producto->precio * $cantidad;
                $productos[] = $producto;
                $total += $producto->subtotal;
            }
        }

        $router->renderLanding('/Main/checkout', [
            'productos' => $productos,
            'total' => $total,
            'titulo' => 'Finalizar Pedido'
        ]);
    }

    public static function confirmar()
    {
        if (empty($_SESSION['login']) && empty($_SESSION['autenticado_Cliente'])) {
            header('Location: /login');
            exit;
        }

        if (empty($_SESSION['carrito'])) {
            header('Location: /carrito');
            exit;
        }

        // Obtener datos del formulario
        $direccion = $_POST['direccion'] ?? '';
        $comentarios = $_POST['comentarios'] ?? '';

        // Validar datos mínimos
        if (!$direccion) {
            header('Location: /checkout');
            exit;
        }

        $idCliente = $_SESSION['id_cliente'] ?? null;
        $idVendedor = $_SESSION['id_vendedor'] ?? 1; // Temporal o automático

        // Calcular totales
        $subtotal = 0;
        $productos = [];

        foreach ($_SESSION['carrito'] as $id => $cantidad) {
            $producto = Producto::obtenerPorId($id);
            if ($producto) {
                $producto->cantidad = $cantidad;
                $producto->subtotal = $producto->precio * $cantidad;
                $productos[] = $producto;
                $subtotal += $producto->subtotal;
            }
        }

        $descuento = 0.00;
        $iva = $subtotal * 0.15;
        $total = $subtotal + $iva;

        // Guardar venta
        $venta = new Venta([
            'id_vendedor' => $idVendedor,
            'subtotal' => $subtotal,
            'descuento' => $descuento,
            'iva' => $iva,
            'total' => $total,
            'estado' => 'Pendiente',
            'creado' => date('Y-m-d H:i:s')
        ]);
        $venta->guardar();

        // Guardar detalles de venta
        foreach ($productos as $prod) {
            $detalle = new DetalleVenta([
                'ventas_idventas' => $venta->idventas,
                'id_producto' => $prod->idproducto,
                'cantidad' => $prod->cantidad,
                'subtotal' => $prod->subtotal
            ]);
            $detalle->guardar();
        }

        // Guardar pedido
        $pedido = new Pedido([
            'id_ventas' => $venta->idventas,
            'id_cliente' => $idCliente,
            'creado' => date('Y-m-d H:i:s'),
            'fecha_entregar' =>  $_POST['fecha_entrega'] ?? '',
            'hora_entregar' =>$_POST['hora_entrega'] ?? '',
            'direccion_entregar' => $direccion,
            'comentarios' => $comentarios,
            'estado' => 0,
            'pago_confirmado' => 0
        ]);
        $pedido->guardar();

        // Limpiar carrito
        unset($_SESSION['carrito']);

        // Redirigir a éxito
        header('Location: /checkout/exito');
        exit;
    }

    public static function exito(Router $router)
    {
        $router->renderLanding('/Main/checkout_exito', [
            'titulo' => 'Pedido realizado'
        ]);
    }
}
