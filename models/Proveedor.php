<?php

namespace Model;

class Proveedor extends ActiveRecord
{
    protected static $tabla = 'proveedores';
    protected static $columnasDB = [
        'nombre_empresa',
        'contacto',
        'telefono',
        'direccion',
        'nacionalidad'
    ];
    protected static $id = 'idProveedores';

    public $idProveedores;
    public $nombre_empresa;
    public $contacto;
    public $telefono;
    public $direccion;
    public $nacionalidad;

    public function __construct($args = [])
    {
        $this->idProveedores = $args['idProveedores'] ?? null;
        $this->nombre_empresa = $args['nombre_empresa'] ?? '';
        $this->contacto = $args['contacto'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->nacionalidad = $args['nacionalidad'] ?? '';
    }

    public function validar()
    {
        if (!$this->nombre_empresa) {
            self::$alertas['error'][] = 'El nombre de la empresa es obligatorio';
        }
        if (!$this->contacto) {
            self::$alertas['error'][] = 'El nombre del contacto es obligatorio';
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = 'El teléfono es obligatorio';
        }
        if (!$this->direccion) {
            self::$alertas['error'][] = 'La dirección es obligatoria';
        }
        if (!$this->nacionalidad) {
            self::$alertas['error'][] = 'La nacionalidad es obligatoria';
        }

        return self::$alertas;
    }

    public static function filtrar($busqueda = '')
    {
        $query = "SELECT * FROM proveedores WHERE eliminado = 0";

        if ($busqueda) {
            $busqueda = self::$db->escape_string($busqueda);
            $query .= " AND (nombre_empresa LIKE '%$busqueda%' OR contacto LIKE '%$busqueda%')";
        }

        return self::consultarSQL($query);
    }


}
