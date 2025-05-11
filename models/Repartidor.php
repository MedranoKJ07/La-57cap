<?php

namespace Model;

class Repartidor extends ActiveRecord
{
    protected static $tabla = 'usuario';
    protected static $columnasDB = [
        'id_usuario',
        'p_nombre',
        's_nombre',
        'p_apellido',
        's_apellido',
        'n_telefono',
        'direccion',
        'Municipio'
    ];
    protected static $id = 'idrepartidor';

    public $idrepartidor;

    public $id_usuario;
    public $p_nombre;
    public $s_nombre;
    public $p_apellido;
    public $s_apellido;
    public $n_telefono;
    public $direccion;
    public $Municipio;

    public function __construct($args = [])
    {
        $this->idrepartidor = $args['idrepartidor'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? '';
        $this->p_nombre = $args['p_nombre'] ?? '';
        $this->s_nombre = $args['s_nombre'] ?? '';
        $this->p_apellido = $args['p_apellido'] ?? '';
        $this->s_apellido = $args['s_apellido'] ?? '';
        $this->n_telefono = $args['n_telefono'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->Municipio = $args['Municipio'] ?? '';
    }
    public static function obtenerTodosConUsuario($busqueda = '')
    {
        $busqueda = self::$db->real_escape_string($busqueda);

        $where = '';
        if (!empty($busqueda)) {
            $where = "WHERE 
                repartidor.p_nombre LIKE '%$busqueda%' OR
                repartidor.p_apellido LIKE '%$busqueda%' OR
                usuario.email LIKE '%$busqueda%'";
        }

        $query = "SELECT 
                    repartidor.*,
                    usuario.userName AS userName,
                    usuario.email AS email,
                    usuario.confirmado AS confirmado
                  FROM repartidor
                  INNER JOIN usuario ON repartidor.id_usuario = usuario.idusuario
                  $where";

        $resultado = self::$db->query($query);

        $objetos = [];
        while ($registro = $resultado->fetch_object()) {
            $objetos[] = $registro;
        }

        return $objetos;
    }
}