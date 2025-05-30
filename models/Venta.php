<?php

namespace Model;

class Venta extends ActiveRecord {
    protected static $tabla = 'ventas';
    protected static $columnasDB = [
        'idventas',
        'id_vendedor',
        'id_cliente',
        'subtotal',
        'descuento',
        'iva',
        'total',
        'estado',
        'creado',
        'eliminado'
    ];
    protected static $id = 'idventas';

    public $idventas;
    public $id_cliente; 
    public $id_vendedor;
    public $subtotal;
    public $descuento;
    public $iva;
    public $total;
    public $estado;
    public $creado;
    public $eliminado;

    public function __construct($args = []) {
        $this->idventas = $args['idventas'] ?? null;
        $this->id_vendedor = $args['id_vendedor'] ?? null;
        $this->id_cliente = $args['id_cliente'] ?? null;
        $this->subtotal = $args['subtotal'] ?? 0.00;
        $this->descuento = $args['descuento'] ?? 0.00;
        $this->iva = $args['iva'] ?? 0.00;
        $this->total = $args['total'] ?? 0.00;
        $this->estado = $args['estado'] ?? 'Pendiente';
        $this->creado = $args['creado'] ?? date('Y-m-d H:i:s');
        $this->eliminado = $args['eliminado'] ?? 0;
    }

    public function guardar() {
        $resultado = $this->crear();
        $this->idventas = $resultado['id'];
        Inventario::verificarStockCriticoYNotificar();
    }
}
