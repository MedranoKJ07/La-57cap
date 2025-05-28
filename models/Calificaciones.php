<?php

namespace Model;

class Calificaciones extends ActiveRecord
{
    protected static $tabla = 'calificaciones';
    protected static $columnasDB = [
        'idcalificaciones',
        'puntuacion',
        'comentario',
        'fecha_clasificacion',
        'pedidos_idpedidos',
        'cliente_idcliente',
        'repartidor_idrepartidor',
        'eliminado'
    ];

    protected static $id = 'idcalificaciones';

    public $idcalificaciones;
    public $puntuacion;
    public $comentario;
    public $fecha_clasificacion;
    public $pedidos_idpedidos;
    public $cliente_idcliente;
    public $repartidor_idrepartidor;
    public $eliminado;

    public function __construct($args = [])
    {
        $this->idcalificaciones = $args['idcalificaciones'] ?? null;
        $this->puntuacion = $args['puntuacion'] ?? null;
        $this->comentario = $args['comentario'] ?? '';
        $this->fecha_clasificacion = $args['fecha_clasificacion'] ?? date('Y-m-d H:i:s');
        $this->pedidos_idpedidos = $args['pedidos_idpedidos'] ?? null;
        $this->cliente_idcliente = $args['cliente_idcliente'] ?? null;
        $this->repartidor_idrepartidor = $args['repartidor_idrepartidor'] ?? null;
        $this->eliminado = $args['eliminado'] ?? 0;
    }
    public static function existeParaPedidoYCliente($pedidoId, $clienteId): bool
    {


        $sql = "SELECT 1 FROM " . static::$tabla . " 
            WHERE pedidos_idpedidos = '$pedidoId' 
            AND cliente_idcliente = '$clienteId'
            AND eliminado = 0 
            LIMIT 1";

        $resultado = self::$db->query($sql);

        return $resultado && $resultado->num_rows > 0;
    }
    public static function obtenerTodasConDetalles()
    {
        $sql = "SELECT 
                c.idcalificaciones,
                c.puntuacion,
                c.comentario,
                c.fecha_clasificacion,
                p.idpedidos,
                cli.p_nombre AS cliente_nombre,
                cli.p_apellido AS cliente_apellido,
                r.p_nombre AS repartidor_nombre,
                r.p_apellido AS repartidor_apellido
            FROM calificaciones c
            INNER JOIN pedidos p ON c.pedidos_idpedidos = p.idpedidos
            INNER JOIN cliente cli ON c.cliente_idcliente = cli.idcliente
            INNER JOIN repartidor r ON c.repartidor_idrepartidor = r.idrepartidor
            WHERE c.eliminado = 0
            ORDER BY c.fecha_clasificacion DESC";

        $resultado = self::$db->query($sql);
        $calificaciones = [];

        while ($fila = $resultado->fetch_assoc()) {
            $calificaciones[] = $fila;
        }

        return $calificaciones;
    }

}
