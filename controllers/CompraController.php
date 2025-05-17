<?php

namespace Controllers;

use MVC\Router;
use Model\Compra;
use Model\CompraDetalle;
use Model\Proveedor;
use Model\Producto;
use Model\Inventario;

class CompraController
{
    public static function GestionarCompras(Router $router)
    {
        $compras = Compra::obtenerTodasConProveedor();

        $router->renderAdmin('Admin/compras/GestionarCompras', [
            'titulo' => 'Gestión de Compras',
            'compras' => $compras
        ]);
    }

    public static function CrearCompra(Router $router)
    {
        $proveedores = Proveedor::obtenerTodos();
        $productos = Producto::obtenerTodos();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $detalles = $_POST['detalle'] ?? [];

            // ❌ Validación: No hay productos
            if (empty($detalles)) {
                $alertas['error'][] = 'Debe agregar al menos un producto a la compra.';
            }

            if (empty($alertas)) {
                // Crear la compra
                $compra = new Compra($_POST['compra']);
                $compra->fecha_compra = date('Y-m-d H:i:s');
                $compra->total_compra = 0;

                // Guardar compra y obtener ID
                $resultado = $compra->crear();
                $idCompra = $resultado['id'];

                foreach ($detalles as $detalle) {
                    $producto = Producto::find($detalle['producto_idproducto'], 'idproducto');
                    $cantidad = (int) $detalle['cantidad'];
                    $precio = (float) $detalle['precio'];
                    $subtotal = $cantidad * $precio;

                    // Guardar detalle
                    $detalleCompra = new CompraDetalle([
                        'Compras_idCompras' => $idCompra,
                        'producto_idproducto' => $producto->idproducto,
                        'cantidad' => $cantidad,
                        'precio_unitario' => $precio,
                        'subtotal' => $subtotal
                    ]);
                    $detalleCompra->crear();

                    // Inventario
                    $inventario = Inventario::where('producto_idproducto', $producto->idproducto);
                    if ($inventario) {
                        $inventario->cantidad_actual += $cantidad;
                        $inventario->fecha_actualizacion = date('Y-m-d H:i:s');
                        $inventario->actualizar($inventario->idInventario);
                    } else {
                        $nuevoInventario = new Inventario([
                            'producto_idproducto' => $producto->idproducto,
                            'cantidad_actual' => $cantidad,
                            'cantidad_minima' => 5,
                            'fecha_actualizacion' => date('Y-m-d H:i:s')
                        ]);
                        $nuevoInventario->crear();
                    }
                }

                // Actualizar total
                $compra = Compra::find($idCompra, 'idCompras');
                $compra->actualizarTotal();

                header('Location: /admin/GestionarCompras');
                return;
            }
        }

        $router->renderAdmin('Admin/compras/CrearCompra', [
            'titulo' => 'Registrar Nueva Compra',
            'proveedores' => $proveedores,
            'productos' => $productos,
            'alertas' => $alertas
        ]);
    }




    public static function VerDetalleCompra(Router $router)
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /admin/GestionarCompras');
            return;
        }

        $compra = Compra::obtenerConProveedor($id);

        $detalles = CompraDetalle::obtenerDetallesPorCompra($id);

        $router->renderAdmin('Admin/compras/DetalleCompra', [
            'titulo' => 'Detalle de Compra',
            'compra' => $compra,
            'detalles' => $detalles
        ]);
    }
}
