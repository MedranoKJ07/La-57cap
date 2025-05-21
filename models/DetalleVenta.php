<?php

namespace Model;

class DetalleVenta extends ActiveRecord {
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

    public function __construct($args = []) {
        $this->iddetalles_ventas = $args['iddetalles_ventas'] ?? null;
        $this->ventas_idventas = $args['ventas_idventas'] ?? null;
        $this->id_producto = $args['id_producto'] ?? null;
        $this->cantidad = $args['cantidad'] ?? 0;
        $this->subtotal = $args['subtotal'] ?? 0.00;
    }

    public function guardar() {
        $this->crear(); // No necesitas el ID aquí
    }
}
