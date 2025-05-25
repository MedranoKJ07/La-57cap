<?php
namespace Controllers;

use Model\Producto;
use Model\Venta;
use Model\DetalleVenta;
use Model\Pedido;
class ApiVentaController
{
    public static function buscar()
    {
        // Solo aceptar método GET
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
            return;
        }

        $codigo = $_GET['codigo'] ?? '';

        if (!$codigo) {
            http_response_code(400);
            echo json_encode(['error' => 'Código no proporcionado']);
            return;
        }

        $producto = Producto::whereAll('codigo_producto', $codigo);


        if (!$producto) {
            http_response_code(404);
            echo json_encode(['error' => 'Producto no encontrado']);
            return;
        }

        // Devolver datos JSON del producto
        echo json_encode([
            'idproducto' => $producto->idproducto,
            'codigo_producto' => $producto->codigo_producto,
            'nombre_producto' => $producto->nombre_producto,
            'precio' => $producto->precio,
            'Foto' => trim($producto->Foto)

        ]);
    }
    public static function registrarVenta()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'mensaje' => 'Método no permitido']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input || !isset($input['productos']) || count($input['productos']) === 0) {
            echo json_encode(['success' => false, 'mensaje' => 'Datos incompletos']);
            return;
        }

        // DATOS BÁSICOS
        $productos = $input['productos'];
        $entregaDomicilio = $input['entregaDomicilio'] ?? false;
        $direccion = $input['direccion'] ?? '';

        // CÁLCULOS
        $subtotal = 0;
        foreach ($productos as $producto) {
            $subtotal += $producto['precio'] * $producto['cantidad'];
        }

        $iva = $subtotal * 0.15;
        $total = $subtotal + $iva;

        // ID del vendedor desde la sesión
        $idVendedor = $_SESSION['id'] ?? null;
        if (!$idVendedor) {
            echo json_encode(['success' => false, 'mensaje' => 'No autenticado']);
            return;
        }

        // 1. Guardar la venta
        $venta = new Venta([
            'id_vendedor' => $idVendedor,
            'subtotal' => $subtotal,
            'descuento' => 0,
            'iva' => $iva,
            'total' => $total,
            'estado' => $entregaDomicilio ? 'En devolución' : 'Completado',
            'creado' => date('Y-m-d H:i:s'),
            'eliminado' => 0
        ]);

        $resVenta = $venta->crear();
        if (!$resVenta['resultado']) {
            echo json_encode(['success' => false, 'mensaje' => 'Error al guardar venta']);
            return;
        }

        $idVenta = $resVenta['id'];

        // 2. Guardar detalles de venta
        foreach ($productos as $producto) {
            $detalle = new DetalleVenta([
                'ventas_idventas' => $idVenta,
                'id_producto' => $producto['id'],
                'cantidad' => $producto['cantidad'],
                'subtotal' => $producto['cantidad'] * $producto['precio']
            ]);
            $detalle->guardar();
        }

        // 3. Si es con entrega a domicilio
        if ($entregaDomicilio) {
            // Buscar cliente asociado al vendedor (aquí podrías usar uno genérico o preguntar)
            $cliente = Cliente::where('id_usuario', $_SESSION['id']); // O define una lógica fija
            $pedido = new Pedido([
                'id_ventas' => $idVenta,
                'id_cliente' => $cliente->idcliente ?? 1, // Asegura un ID válido
                'id_repartidor' => null,
                'creado' => date('Y-m-d H:i:s'),
                'fecha_entregar' => date('Y-m-d', strtotime('+1 day')),
                'hora_entregar' => '12:00:00',
                'direccion_entregar' => $direccion,
                'comentarios' => '',
                'estado' => 0,
                'pago_confirmado' => 1
            ]);
            $pedido->crear();
        }

        echo json_encode(['success' => true, 'id' => $idVenta]);
    }

}
