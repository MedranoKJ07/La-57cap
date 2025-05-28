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

            $producto = Producto::verificarDisponibilidadVenta($codigo);


        if (!$producto) {
            http_response_code(404);
            echo json_encode(['error' => 'Producto no encontrado']);
            return;
        }

        echo json_encode($producto);
    }
    public static function buscarCliente()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405); // Método no permitido
            echo json_encode(['error' => 'Método no permitido']);
            return;
        }

        $nombre = $_GET['nombre'] ?? '';
        if (empty($nombre)) {
            http_response_code(400); // Solicitud incorrecta
            echo json_encode(['error' => 'Nombre no proporcionado']);
            return;
        }

        // ✅ Usamos el nuevo método
        $cliente = Cliente::buscarPorNombreCompleto($nombre);
        if (!$cliente) {
            http_response_code(404); // No encontrado
            echo json_encode(['error' => 'Cliente no encontrado']);
            return;
        }

        // Enviar datos del cliente encontrados
        echo json_encode([
            'idcliente' => $cliente->idcliente,
            'nombre_completo' => trim($cliente->p_nombre . ' ' . $cliente->s_nombre . ' ' . $cliente->p_apellido . ' ' . $cliente->s_apellido),
            'telefono' => $cliente->n_telefono,
            'direccion' => $cliente->direccion,
            'municipio' => $cliente->Municipio
        ]);
    }

}
