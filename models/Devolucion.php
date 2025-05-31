<?php

namespace Model;

class Devolucion extends ActiveRecord
{
    protected static $tabla = 'devoluciones';
    protected static $columnasDB = [
        'idDevoluciones',
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
    public $cliente_nombre;

    public function __construct($args = [])
    {
        $this->idDevoluciones = $args['idDevoluciones'] ?? null;
        $this->fecha_solicitud = $args['fecha_solicitud'] ?? date('Y-m-d H:i:s');
        $this->motivo = $args['motivo'] ?? '';
        $this->Aprobado = $args['Aprobado'] ?? 0;
        $this->tipo_reembolso = $args['tipo_reembolso'] ?? 'dinero';
        $this->observaciones = $args['observaciones'] ?? '';
        $this->ventas_idventas = $args['ventas_idventas'] ?? null;
        $this->cliente_idcliente = $args['cliente_idcliente'] ?? null;
        $this->eliminado = $args['eliminado'] ?? 0;
        $this->Estado = $args['Estado'] ?? 'Pendiente';
    }

    public static function obtenerTodasConCliente()
    {
        $query = "
            SELECT d.*, CONCAT(c.p_nombre, ' ', c.p_apellido) AS cliente_nombre
            FROM devoluciones d
            JOIN cliente c ON d.cliente_idcliente = c.idcliente
            WHERE d.eliminado = 0
            ORDER BY d.fecha_solicitud DESC
        ";
        return self::consultarSQL($query);
    }
    public static function obtenerConCliente($idDevolucion)
    {
        $idDevolucion = self::$db->real_escape_string($idDevolucion);

        $query = "
        SELECT d.*, CONCAT(c.p_nombre, ' ', c.p_apellido) AS cliente_nombre
        FROM devoluciones d
        JOIN cliente c ON d.cliente_idcliente = c.idcliente
        WHERE d.idDevoluciones = $idDevolucion
        LIMIT 1
    ";

        $resultado = self::consultarSQL($query);
        return $resultado[0] ?? null;
    }
    public static function totalDevoluciones()
    {
        $sql = "SELECT COUNT(*) as total FROM devoluciones WHERE eliminado = 0";
        $res = self::fetchAssoc($sql);
        return $res['total'] ?? 0;
    }


}
