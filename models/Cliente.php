<?php

namespace Model;

class Cliente extends ActiveRecord
{
    protected static $tabla = 'cliente';
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
    protected static $id = 'idcliente';

    public $idcliente;

    public $idusuario;
    public $p_nombre;
    public $s_nombre;
    public $p_apellido;
    public $s_apellido;
    public $n_telefono;
    public $direccion;
    public $Municipio;

    public function __construct($args = [])
    {
        $this->idcliente = $args['idcliente'] ?? null;
        $this->idusuario = $args['idusuario'] ?? '';
        $this->p_nombre = $args['p_nombre'] ?? '';
        $this->s_nombre = $args['s_nombre'] ?? '';
        $this->p_apellido = $args['p_apellido'] ?? '';
        $this->s_apellido = $args['s_apellido'] ?? '';
        $this->n_telefono = $args['n_telefono'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->Municipio = $args['Municipio'] ?? '';
    }
    public static function filtrarClientes($busqueda = '')
    {
        $condiciones = [];

        if ($busqueda !== '') {
            $busqueda = self::$db->real_escape_string($busqueda);
            $condiciones[] = "(p_nombre LIKE '%$busqueda%' 
                        OR s_nombre LIKE '%$busqueda%' 
                        OR p_apellido LIKE '%$busqueda%' 
                        OR s_apellido LIKE '%$busqueda%')";
        }

        $where = count($condiciones) ? 'WHERE ' . implode(' AND ', $condiciones) : '';
        $query = "SELECT * FROM cliente $where";

        return self::consultarSQL($query);
    }

    public static function obtenerTodosConUsuario($busqueda = '')
    {
        $busqueda = self::$db->real_escape_string($busqueda);

        $where = "WHERE cliente.eliminado = 0 AND usuario.eliminado = 0";

        if (!empty($busqueda)) {
            $where .= " AND (
            cliente.p_nombre LIKE '%$busqueda%' OR
            cliente.p_apellido LIKE '%$busqueda%' OR
            usuario.email LIKE '%$busqueda%'
        )";
        }

        $query = "SELECT 
                cliente.*, 
                usuario.userName AS userName, 
                usuario.email AS email, 
                usuario.confirmado AS confirmado
              FROM cliente
              INNER JOIN usuario ON cliente.id_usuario = usuario.idusuario
              $where";

        $resultado = self::$db->query($query);

        $objetos = [];
        while ($registro = $resultado->fetch_object()) {
            $objetos[] = $registro; // objeto stdClass con TODAS las propiedades
        }

        return $objetos;
    }



}