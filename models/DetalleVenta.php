<?php

namespace Model;

class DetalleVenta extends ActiveRecord
{
    protected static $tabla = 'detalles_ventas';
    protected static $columnasDB = [
        'iddetalles_ventas',
        'ventas_idventas',
        'id_producto',
        'cantidad',
        'subtotal'
    ];
    protected static $id = 'iddetalles_ventas';

    public $iddetalles_ventas;
    public $ventas_idventas;
    public $id_producto;
    public $cantidad;
    public $subtotal;

    public function __construct($args = [])
    {
        $this->iddetalles_ventas = $args['iddetalles_ventas'] ?? null;
        $this->ventas_idventas = $args['ventas_idventas'] ?? null;
        $this->id_producto = $args['id_producto'] ?? null;
        $this->cantidad = $args['cantidad'] ?? 0;
        $this->subtotal = $args['subtotal'] ?? 0.00;
    }

    public function guardar()
    {
        $this->crear(); // No necesitas el ID aquí
    }



public static function obtenerDetalleConProductoPorVenta($idVenta)
{
    $idVenta = self::$db->escape_string($idVenta);

    $query = "SELECT 
                dv.cantidad, 
                p.nombre_producto, 
                p.precio
              FROM detalles_ventas dv
              INNER JOIN producto p ON p.idproducto = dv.id_producto
              WHERE dv.ventas_idventas = '$idVenta'";

    $resultado = self::$db->query($query);
    $detalles = [];

    while ($fila = $resultado->fetch_assoc()) {
        $detalles[] = $fila;
    }

    return $detalles;
}


    public static function obtenerPorVenta($idVenta)
    {
        $idVenta = self::$db->real_escape_string($idVenta);

        $query = "
            SELECT 
                dv.*, 
                p.nombre_producto, 
                p.codigo_producto, 
                p.precio, 
                p.Foto
            FROM detalles_ventas dv
            JOIN producto p ON dv.id_producto = p.idproducto
            WHERE dv.ventas_idventas = '$idVenta'
        ";

        $resultado = self::$db->query($query);
        $array = [];

        while ($registro = $resultado->fetch_assoc()) {
            $array[] = (object) $registro;
        }

        return $array;
    }


}
