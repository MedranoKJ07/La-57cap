<?php

namespace Model;

class Compra extends ActiveRecord
{
    protected static $tabla = 'compras';
    protected static $columnasDB = [
        'fecha_compra',
        'total_compra',
        'observaciones',
        'Proveedores_idProveedores',
        'eliminado'
    ];
    protected static $id = 'idCompras';
    public $idCompras;
    public $fecha_compra;
    public $total_compra;
    public $observaciones;
    public $Proveedores_idProveedores;
    public $eliminado;

    public function __construct($args = [])
    {
        $this->idCompras = $args['idCompras'] ?? null;
        $this->fecha_compra = $args['fecha_compra'] ?? date('Y-m-d H:i:s');
        $this->total_compra = $args['total_compra'] ?? 0;
        $this->observaciones = $args['observaciones'] ?? '';
        $this->Proveedores_idProveedores = $args['Proveedores_idProveedores'] ?? null;
        $this->eliminado = $args['eliminado'] ?? 0;
    }
    public static function obtenerTodasConProveedor()
    {
        $query = "SELECT 
                c.*, 
                p.nombre_empresa 
              FROM compras c
              LEFT JOIN proveedores p ON c.Proveedores_idProveedores = p.idProveedores
              WHERE c.eliminado = 0
              ORDER BY c.idCompras DESC";

        $resultado = self::$db->query($query);
        $compras = [];

        while ($registro = $resultado->fetch_object()) {
            $compras[] = $registro;
        }

        return $compras;
    }
    public function actualizarTotal()
    {
        if (empty($this->idCompras)) {
            throw new \Exception("No se ha definido el ID de la compra para actualizar el total.");
        }

        $id = $this->idCompras;
        $query = "SELECT SUM(subtotal) as total FROM compra_detalles WHERE Compras_idCompras = $id";
        $resultado = self::$db->query($query);
        $fila = $resultado->fetch_assoc();

        $total = $fila['total'] ?? 0;

        $update = "UPDATE compras SET total_compra = {$total} WHERE idCompras = $id";
        return self::$db->query($update);
    }
    public static function obtenerConProveedor($id)
    {
        $query = "SELECT 
                c.*, 
                p.nombre_empresa 
              FROM compras c
              LEFT JOIN proveedores p ON c.Proveedores_idProveedores = p.idProveedores
              WHERE c.idCompras = {$id} 
              LIMIT 1";

        $resultado = self::$db->query($query);
        return $resultado->fetch_object();
    }
    public static function productosComprados()
    {
        $sql = "SELECT 
                p.nombre_producto,
                SUM(cd.cantidad) AS total_comprado,
                SUM(cd.subtotal) AS costo_total
            FROM compra_detalles cd
            JOIN producto p ON cd.producto_idproducto = p.idproducto
            GROUP BY cd.producto_idproducto
            ORDER BY total_comprado DESC";

        $resultado = self::$db->query($sql);
        return $resultado;
    }


}
