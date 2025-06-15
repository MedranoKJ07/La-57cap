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

        $where = "WHERE vendedor.eliminado = 0"; // Mostrar solo los no eliminados

        if (!empty($busqueda)) {
            $where .= " AND (
            vendedor.p_nombre LIKE '%$busqueda%' OR
            vendedor.p_apellido LIKE '%$busqueda%' OR
            IFNULL(usuario.email, '') LIKE '%$busqueda%' OR
            IFNULL(usuario.userName, '') LIKE '%$busqueda%'
        )";
        }

        $query = "SELECT 
                vendedor.*,
                usuario.userName AS userName,
                usuario.email AS email,
                usuario.confirmado AS confirmado
              FROM vendedor
              LEFT JOIN usuario ON vendedor.id_usuario = usuario.idusuario
              $where";

        $resultado = self::$db->query($query);

        $objetos = [];
        while ($registro = $resultado->fetch_object()) {
            $objetos[] = $registro;
        }

        return $objetos;
    }

}
