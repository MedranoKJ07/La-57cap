<?php
namespace Model;

class Repartidor extends ActiveRecord
{
    protected static $tabla = 'repartidor';
    protected static $columnasDB = [
        'id_usuario',
        'p_nombre',
        's_nombre',
        'p_apellido',
        's_apellido',
        'n_telefono'
    ];
    protected static $columnaID = 'idrepartidor';
    protected static $id = 'idrepartidor';
    public $idrepartidor;
    public $id_usuario;
    public $p_nombre;
    public $s_nombre;
    public $p_apellido;
    public $s_apellido;
    public $n_telefono;

    // Atributos del usuario relacionado
    public $userName;
    public $email;
    public $confirmado;

    public function __construct($args = [])
    {
        $this->idrepartidor = $args['idrepartidor'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? null;
        $this->p_nombre = $args['p_nombre'] ?? '';
        $this->s_nombre = $args['s_nombre'] ?? '';
        $this->p_apellido = $args['p_apellido'] ?? '';
        $this->s_apellido = $args['s_apellido'] ?? '';
        $this->n_telefono = $args['n_telefono'] ?? '';
    }

    public function validar()
    {
        self::$alertas = [];

        if (!$this->p_nombre) {
            self::$alertas['error'][] = 'El primer nombre es obligatorio';
        }

        if (!$this->p_apellido) {
            self::$alertas['error'][] = 'El primer apellido es obligatorio';
        }

        if (!$this->n_telefono) {
            self::$alertas['error'][] = 'El número de teléfono es obligatorio';
        } elseif (!preg_match('/^[0-9]{8,15}$/', $this->n_telefono)) {
            self::$alertas['error'][] = 'El número de teléfono no es válido';
        }

        if (!$this->id_usuario) {
            self::$alertas['error'][] = 'Falta el ID de usuario relacionado';
        }

        return self::$alertas;
    }

    public static function obtenerTodosConUsuario($busqueda = '')
    {
        $busqueda = self::$db->real_escape_string($busqueda);

        $where = '';
        if (!empty($busqueda)) {
            $where = "WHERE 
            repartidor.p_nombre LIKE '%$busqueda%' OR
            repartidor.p_apellido LIKE '%$busqueda%' OR
            IFNULL(usuario.email, '') LIKE '%$busqueda%' OR
            IFNULL(usuario.userName, '') LIKE '%$busqueda%'";
        }

        $query = "SELECT 
                repartidor.*,
                usuario.userName AS userName,
                usuario.email AS email,
                usuario.confirmado AS confirmado
              FROM repartidor
              LEFT JOIN usuario ON repartidor.id_usuario = usuario.idusuario
              $where";

        $resultado = self::$db->query($query);

        $objetos = [];
        while ($registro = $resultado->fetch_object()) {
            $objetos[] = $registro; // objeto stdClass con los datos combinados
        }

        return $objetos;
    }


    public static function existeRepartidorPorUsuario($id_usuario)
    {
        $id_usuario = self::$db->escape_string($id_usuario);
        $query = "SELECT * FROM " . static::$tabla . " WHERE id_usuario = '$id_usuario' LIMIT 1";
        $resultado = self::consultarSQL($query);
        return !empty($resultado);
    }

}
