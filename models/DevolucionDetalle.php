<?php

namespace Model;

class DevolucionDetalle extends ActiveRecord
{
    protected static $tabla = 'devolucion_detalles';
    protected static $columnasDB = [
        'idDevolucion_Detalles',
        'cantidad',
        'Estado_Producto',
        'producto_idproducto',
        'Devoluciones_idDevoluciones'
    ];
    protected static $id = 'idDevolucion_Detalles';

    public $idDevolucion_Detalles;
    public $cantidad;
    public $Estado_Producto;
    public $producto_idproducto;
    public $Devoluciones_idDevoluciones;

    public function __construct($args = [])
    {
        $this->idDevolucion_Detalles = $args['idDevolucion_Detalles'] ?? null;
        $this->cantidad = $args['cantidad'] ?? null;
        $this->Estado_Producto = $args['Estado_Producto'] ?? '';
        $this->producto_idproducto = $args['producto_idproducto'] ?? null;
        $this->Devoluciones_idDevoluciones = $args['Devoluciones_idDevoluciones'] ?? null;
    }
    public static function obtenerDetallesConProducto($idDevolucion)
    {
        $idDevolucion = self::$db->real_escape_string($idDevolucion);

        $query = "
            SELECT dd.*, p.nombre_producto, p.Foto
            FROM devolucion_detalles dd
            JOIN producto p ON p.idproducto = dd.producto_idproducto
            WHERE dd.Devoluciones_idDevoluciones = '$idDevolucion'
        ";

        $resultado = self::$db->query($query);
        $detalles = [];

        while ($row = $resultado->fetch_assoc()) {
            $detalles[] = (object) $row;
        }

        $resultado->free();
        return $detalles;
    }
}
