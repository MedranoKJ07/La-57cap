<?php
namespace Model;

class DevolucionDetalle extends ActiveRecord {
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

    public function __construct($args = []) {
        $this->idDevolucion_Detalles = $args['idDevolucion_Detalles'] ?? null;
        $this->cantidad = $args['cantidad'] ?? null;
        $this->Estado_Producto = $args['Estado_Producto'] ?? '';
        $this->producto_idproducto = $args['producto_idproducto'] ?? null;
        $this->Devoluciones_idDevoluciones = $args['Devoluciones_idDevoluciones'] ?? null;
    }

    public function guardar() {
        return $this->crear();
    }
}
