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
        $this->idcliente = $args['idcliente'] ?? null;
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

        $where = "WHERE cliente.eliminado = 0 AND usuario.eliminado = 0";

        if (!empty($busqueda)) {
            $where .= " AND (
            cliente.p_nombre LIKE '%$busqueda%' OR
            cliente.s_nombre LIKE '%$busqueda%' OR
            cliente.p_apellido LIKE '%$busqueda%' OR
            cliente.s_apellido LIKE '%$busqueda%' OR
            IFNULL(usuario.email, '') LIKE '%$busqueda%' OR
            IFNULL(usuario.userName, '') LIKE '%$busqueda%'
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
            $objetos[] = $registro;
        }

        return $objetos;
    }
    public static function buscarPorNombreCompleto($nombre)
    {
        // Conexión directa usando ActiveRecord::consultarSQL para mayor control
        $query = "SELECT * FROM cliente 
              WHERE eliminado = 0 AND 
              CONCAT(p_nombre, ' ', s_nombre, ' ', p_apellido, ' ', s_apellido) LIKE '%" . self::$db->escape_string($nombre) . "%' 
              LIMIT 1";

        $resultado = self::consultarSQL($query);
        return array_shift($resultado); // Devuelve el primer cliente encontrado o null
    }
    public static function obtenerUsuarioId($id)
    {
        $id = self::$db->real_escape_string($id);
        $query = "SELECT id_usuario FROM cliente WHERE idcliente = '$id' LIMIT 1";
        $res = self::$db->query($query);
        $data = $res->fetch_assoc();
        return $data ? $data['id_usuario'] : null;
    }


    public static function totalClientes()
    {
        $sql = "SELECT COUNT(*) as total FROM cliente WHERE eliminado = 0";
        $res = self::fetchAssoc($sql);
        return $res['total'] ?? 0;
    }
}