<?php
namespace Model;

class Devolucion extends ActiveRecord
{
    protected static $tabla = 'devoluciones';
    protected static $columnasDB = [
        'fecha_solicitud',
        'motivo',
        'Aprobado',
        'tipo_reembolso',
        'observaciones',
        'ventas_idventas',
        'cliente_idcliente',
        'eliminado',
        'Estado'
    ];
    protected static $id = 'idDevoluciones';

    public $idDevoluciones;
    public $fecha_solicitud;
    public $motivo;
    public $Aprobado;
    public $tipo_reembolso;
    public $observaciones;
    public $ventas_idventas;
    public $cliente_idcliente;
    public $eliminado;
    public $Estado;

    public function __construct($args = [])
    {
        $this->idDevoluciones = $args['idDevoluciones'] ?? null;
        $this->fecha_solicitud = date('Y-m-d H:i:s');
        $this->motivo = $args['motivo'] ?? '';
        $this->Aprobado = 0;
        $this->tipo_reembolso = $args['tipo_reembolso'] ?? '';
        $this->observaciones = $args['observaciones'] ?? '';
        $this->ventas_idventas = $args['ventas_idventas'] ?? null;
        $this->cliente_idcliente = $args['cliente_idcliente'] ?? null;
        $this->eliminado = 0;
        $this->Estado = 'Pendiente';
    }
}
