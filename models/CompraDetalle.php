<?php

namespace Model;

class CompraDetalle extends ActiveRecord
{
    protected static $tabla = 'compra_detalles';
    protected static $columnasDB = [
        'cantidad',
        'precio_unitario',
        'subtotal',
        'Compras_idCompras',
        'producto_idproducto'
    ];
    protected static $id = 'idCompra_Detalles';

    public $idCompra_Detalles;
    public $cantidad;
    public $precio_unitario;
    public $subtotal;
    public $Compras_idCompras;
    public $producto_idproducto;

    public function __construct($args = [])
    {
        $this->idCompra_Detalles = $args['idCompra_Detalles'] ?? null;
        $this->cantidad = $args['cantidad'] ?? 0;
        $this->precio_unitario = $args['precio_unitario'] ?? 0;
        $this->subtotal = $args['subtotal'] ?? 0;
        $this->Compras_idCompras = $args['Compras_idCompras'] ?? null;
        $this->producto_idproducto = $args['producto_idproducto'] ?? null;
    }


    public static function obtenerDetallesPorCompra($idCompra)
    {
        $query = "SELECT 
                d.*,
                p.nombre_producto
              FROM compra_detalles d
              JOIN producto p ON d.producto_idproducto = p.idproducto
              WHERE d.Compras_idCompras = " . self::$db->escape_string($idCompra);

        $resultado = self::$db->query($query);
        $detalles = [];

        while ($registro = $resultado->fetch_object()) {
            $detalles[] = $registro;
        }

        return $detalles;
    }


}
