<?php
namespace Controllers;

use Model\Producto;
use Model\Venta;
use Model\DetalleVenta;
use Model\Pedido;
use Model\Cliente;


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
  

}
