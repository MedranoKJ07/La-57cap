<?php 
namespace Model;

class Repartidor extends ActiveRecord {
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

    public function __construct($args = []) {
        $this->idrepartidor = $args['idrepartidor'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? null;
        $this->p_nombre = $args['p_nombre'] ?? '';
        $this->s_nombre = $args['s_nombre'] ?? '';
        $this->p_apellido = $args['p_apellido'] ?? '';
        $this->s_apellido = $args['s_apellido'] ?? '';
        $this->n_telefono = $args['n_telefono'] ?? '';
    }

    public function validar() {
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

    public static function obtenerTodosConUsuario($busqueda = '') {
        $query = "SELECT r.*, u.userName, u.email, u.confirmado 
                  FROM repartidor r 
                  INNER JOIN usuario u ON r.id_usuario = u.idusuario";

        if ($busqueda) {
            $busqueda = self::$db->escape_string($busqueda);
            $query .= " WHERE CONCAT(r.p_nombre, ' ', r.p_apellido, ' ', u.email) LIKE '%$busqueda%'";
        }

        return self::consultarSQL($query);
    }
}
