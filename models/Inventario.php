<?php

namespace Model;

class Inventario extends ActiveRecord
{
    protected static $tabla = 'inventario';
    protected static $columnasDB = [
        'cantidad_actual',
        'cantidad_minima',
        'fecha_actualizacion',
        'producto_idproducto'
    ];
    protected static $id = 'idInventario';
    public $idInventario;
    public $cantidad_actual;
    public $cantidad_minima;
    public $fecha_actualizacion;
    public $producto_idproducto;

    public function __construct($args = [])
    {
        $this->idInventario = $args['idInventario'] ?? null;
        $this->cantidad_actual = $args['cantidad_actual'] ?? 0;
        $this->cantidad_minima = $args['cantidad_minima'] ?? 0;
        $this->fecha_actualizacion = $args['fecha_actualizacion'] ?? date('Y-m-d H:i:s');
        $this->producto_idproducto = $args['producto_idproducto'] ?? null;
    }

    public function agregarStock($cantidad)
    {
        $this->cantidad_actual += $cantidad;
        $this->fecha_actualizacion = date('Y-m-d H:i:s');
    }

    public function reducirStock($cantidad)
    {
        $this->cantidad_actual -= $cantidad;
        $this->fecha_actualizacion = date('Y-m-d H:i:s');
    }
    public static function obtenerTodoConProducto()
    {
        $query = "SELECT 
                inventario.*, 
                producto.codigo_producto, 
                producto.nombre_producto 
              FROM inventario
              LEFT JOIN producto ON inventario.producto_idproducto = producto.idproducto";

        $resultado = self::$db->query($query);

        $objetos = [];
        while ($registro = $resultado->fetch_object()) {
            $objetos[] = $registro;
        }

        return $objetos;
    }

    public static function registrarOCrear($producto_id, $cantidad)
    {
        $db = self::$db;

        $query = "SELECT * FROM inventario WHERE producto_idproducto = $producto_id LIMIT 1";
        $resultado = $db->query($query);

        if ($resultado && $resultado->num_rows > 0) {
            // Ya existe, actualiza cantidad
            $inventario = $resultado->fetch_object();
            $nuevaCantidad = $inventario->cantidad_actual + $cantidad;

            $update = "UPDATE inventario SET cantidad_actual = $nuevaCantidad, fecha_actualizacion = NOW() 
                   WHERE idInventario = $inventario->idInventario";
            $db->query($update);
        } else {
            // No existe, crea nuevo inventario
            $insert = "INSERT INTO inventario (producto_idproducto, cantidad_actual, cantidad_minima, fecha_actualizacion) 
                   VALUES ($producto_id, $cantidad, 5, NOW())";
            $db->query($insert);
        }
    }
    public static function restarStock($productoId, $cantidadVendida)
    {
        $productoId = self::$db->real_escape_string($productoId);
        $cantidadVendida = (int) $cantidadVendida;

        $query = "UPDATE inventario 
                  SET cantidad_actual = cantidad_actual - $cantidadVendida, 
                      fecha_actualizacion = NOW()
                  WHERE producto_idproducto = '$productoId' 
                  LIMIT 1";

        return self::$db->query($query);
    }

}
