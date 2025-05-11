<?php

namespace Model;

class Vendedor extends ActiveRecord
{
    protected static $tabla = 'vendedor';
    protected static $columnasDB = [
        'id_usuario',
        'p_nombre',
        's_nombre',
        'p_apellido',
        's_apellido',
        'n_telefono'
    ];
    protected static $id = 'idvendedor';
    public $idvendedor;
    public $id_usuario;
    public $p_nombre;
    public $s_nombre;
    public $p_apellido;
    public $s_apellido;
    public $n_telefono;
 

    public function __construct($args = [])
    {
        $this->idvendedor = $args['idvendedor'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? '';
        $this->p_nombre = $args['p_nombre'] ?? '';
        $this->s_nombre = $args['s_nombre'] ?? '';
        $this->p_apellido = $args['p_apellido'] ?? '';
        $this->s_apellido = $args['s_apellido'] ?? '';
        $this->n_telefono = $args['n_telefono'] ?? '';
    }
    public static function obtenerTodosConUsuario($busqueda = '')
    {
        $busqueda = self::$db->real_escape_string($busqueda);

        $where = '';
        if (!empty($busqueda)) {
            $where = "WHERE 
                vendedor.p_nombre LIKE '%$busqueda%' OR
                vendedor.p_apellido LIKE '%$busqueda%' OR
                usuario.email LIKE '%$busqueda%'";
        }

        $query = "SELECT 
                    vendedor.*,
                    usuario.userName AS userName,
                    usuario.email AS email,
                    usuario.confirmado AS confirmado
                  FROM vendedor
                  INNER JOIN usuario ON vendedor.id_usuario = usuario.idusuario
                  $where";

        $resultado = self::$db->query($query);

        $objetos = [];
        while ($registro = $resultado->fetch_object()) {
            $objetos[] = $registro; // stdClass con todos los campos combinados
        }

        return $objetos;
    }
    public function validar()
    {
        self::$alertas = [];

        if (!$this->p_nombre) {
            self::$alertas['error'][] = 'El primer nombre es obligatorio';
        }

        if (!$this->s_nombre) {
            self::$alertas['error'][] = 'El segundo nombre es obligatorio';
        }

        if (!$this->p_apellido) {
            self::$alertas['error'][] = 'El primer apellido es obligatorio';
        }

        if (!$this->s_apellido) {
            self::$alertas['error'][] = 'El segundo apellido es obligatorio';
        }

        if (!$this->n_telefono) {
            self::$alertas['error'][] = 'El número de teléfono es obligatorio';
        } elseif (!preg_match('/^[0-9]{8,15}$/', $this->n_telefono)) {
            self::$alertas['error'][] = 'El número de teléfono no es válido';
        }

        if (!$this->id_usuario) {
            self::$alertas['error'][] = 'El ID del usuario asociado es obligatorio';
        }

        return self::$alertas;
    }

}
