<?php

namespace Model;

class Pedido extends ActiveRecord
{
    protected static $tabla = 'pedidos';
    protected static $columnasDB = [
        'idpedidos',
        'id_ventas',
        'id_cliente',
        'id_repartidor',
        'creado',
        'fecha_entregar',
        'hora_entregar',
        'direccion_entregar',
        'comentarios',
        'estado',
        'pago_confirmado'
    ];
    protected static $id = 'idpedidos';

    public $idpedidos;
    public $id_ventas;
    public $id_cliente;
    public $id_repartidor;
    public $creado;
    public $fecha_entregar;
    public $hora_entregar;
    public $direccion_entregar;
    public $comentarios;
    public $estado;
    public $pago_confirmado;

    public $total_venta;
    public $total;
    public $estado_venta;
    public $tiene_devolucion;
    public $en_devolucion;
        // ✅ Agrega esta línea:
    public $no_disponible_para_devolver;


    public function __construct($args = [])
    {
        $this->idpedidos = $args['idpedidos'] ?? null;
        $this->id_ventas = $args['id_ventas'] ?? null;
        $this->id_cliente = $args['id_cliente'] ?? null;
        $this->id_repartidor = $args['id_repartidor'] ?? null;
        $this->creado = $args['creado'] ?? date('Y-m-d H:i:s');
        $this->fecha_entregar = $args['fecha_entregar'] ?? date('Y-m-d', strtotime('+2 days'));
        $this->hora_entregar = $args['hora_entregar'] ?? '12:00:00';
        $this->direccion_entregar = $args['direccion_entregar'] ?? '';
        $this->comentarios = $args['comentarios'] ?? '';
        $this->estado = $args['estado'] ?? 0;
        $this->pago_confirmado = $args['pago_confirmado'] ?? 0;
    }

    public function guardar()
    {
        $this->crear();
    }

    public static function obtenerPorCliente($idCliente)
    {
        $idCliente = self::$db->real_escape_string($idCliente);

        $query = "SELECT pedidos.*, 
                     ventas.total AS total_venta, 
                     ventas.estado AS estado_venta
              FROM pedidos
              INNER JOIN ventas ON pedidos.id_ventas = ventas.idventas
              WHERE pedidos.id_cliente = '$idCliente'
              ORDER BY pedidos.creado DESC";

        $resultados = self::consultarSQL($query);

        foreach ($resultados as $pedido) {
            $pedido->total = $pedido->total_venta;
            unset($pedido->total_venta);

            $pedido->estado_venta = trim($pedido->estado_venta ?? 'Pendiente');

            // ✅ Agrega esta línea:
            $pedido->no_disponible_para_devolver = self::ventaSinProductosDisponibles($pedido->id_ventas);
        }

        return $resultados;
    }



    public static function obtenerProductosConDetalles($idPedido)
    {
        $idPedido = self::$db->real_escape_string($idPedido);

        $query = "
            SELECT 
                p.idproducto,
                p.nombre_producto,
                p.Foto,
                p.precio,
                dv.cantidad,
                dv.subtotal
            FROM pedidos AS pe
            INNER JOIN ventas v ON pe.id_ventas = v.idventas
            INNER JOIN detalles_ventas dv ON dv.ventas_idventas = v.idventas
            INNER JOIN producto p ON p.idproducto = dv.id_producto
            WHERE pe.idpedidos = $idPedido
        ";

        $resultado = self::$db->query($query);

        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = (object) $registro;
        }

        $resultado->free();
        return $array;
    }
    public static function ventaEnProcesoDevolucion($idVenta)
    {
        $idVenta = self::$db->real_escape_string($idVenta);

        $query = "SELECT idDevoluciones FROM devoluciones 
              WHERE ventas_idventas = $idVenta 
              AND Estado = 'Pendiente' 
              AND eliminado = 0 
              LIMIT 1";

        $resultado = self::$db->query($query);

        return $resultado && $resultado->num_rows > 0;
    }

    public static function ventaSinProductosDisponibles($idVenta)
    {
        $idVenta = self::$db->real_escape_string($idVenta);

        // Total de productos vendidos en esa venta
        $queryVenta = "
        SELECT SUM(dv.cantidad) AS cantidad_vendida
        FROM detalles_ventas dv
        WHERE dv.ventas_idventas = $idVenta
    ";

        // Total de productos ya solicitados en devoluciones aprobadas o pendientes
        $queryDevoluciones = "
        SELECT SUM(dd.cantidad) AS cantidad_devuelta
        FROM devolucion_detalles dd
        INNER JOIN devoluciones d ON dd.Devoluciones_idDevoluciones = d.idDevoluciones
        WHERE d.ventas_idventas = $idVenta AND d.eliminado = 0
    ";

        $vendidos = self::$db->query($queryVenta)->fetch_assoc()['cantidad_vendida'] ?? 0;
        $devueltos = self::$db->query($queryDevoluciones)->fetch_assoc()['cantidad_devuelta'] ?? 0;

        return $devueltos >= $vendidos;
    }

}
