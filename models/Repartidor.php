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
        // Nombres y apellidos solo letras y espacios
        $regexNombre = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,50}$/u';

        if (!preg_match($regexNombre, $this->p_nombre)) {
            self::$alertas['error'][] = "Primer nombre inválido. Solo letras y sin caracteres especiales.";
        }

        if (!preg_match($regexNombre, $this->s_nombre)) {
            self::$alertas['error'][] = "Segundo nombre inválido. Solo letras y sin caracteres especiales.";
        }

        if (!preg_match($regexNombre, $this->p_apellido)) {
            self::$alertas['error'][] = "Primer apellido inválido. Solo letras y sin caracteres especiales.";
        }

        if (!preg_match($regexNombre, $this->s_apellido)) {
            self::$alertas['error'][] = "Segundo apellido inválido. Solo letras y sin caracteres especiales.";
        }

        // Teléfono: solo números, entre 7 y 10 dígitos
        if (!preg_match('/^\d{7,10}$/', $this->n_telefono)) {
            self::$alertas['error'][] = "Número de teléfono inválido. Solo se permiten entre 7 y 10 dígitos.";
        }
        return self::$alertas;
    }

    public static function obtenerTodosConUsuario($busqueda = '')
    {
        $busqueda = self::$db->real_escape_string($busqueda);

        $where = "WHERE repartidor.eliminado = 0"; // Mostrar solo los no eliminados

        if (!empty($busqueda)) {
            $where .= " AND (
            repartidor.p_nombre LIKE '%$busqueda%' OR
            repartidor.p_apellido LIKE '%$busqueda%' OR
            IFNULL(usuario.email, '') LIKE '%$busqueda%' OR
            IFNULL(usuario.userName, '') LIKE '%$busqueda%'
        )";
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
            $objetos[] = $registro;
        }

        return $objetos;
    }
    public static function obtenerUsuarioId($idRepartidor)
    {
        $idRepartidor = self::$db->real_escape_string($idRepartidor);
        $query = "SELECT id_usuario FROM repartidor WHERE idrepartidor = '$idRepartidor' LIMIT 1";
        $res = self::$db->query($query);
        $data = $res->fetch_assoc();
        return $data ? $data['id_usuario'] : null;
    }


}
