<?php

namespace Model;

class Rol extends ActiveRecord
{

    protected static $tabla = 'roles';
        protected static $columnasDB = [
            'idroles',
            'descripcion'
        ];
    public $idroles;
    public $descripcion;
    public function __construct($args = [])
    {
        $this->idroles = $args['idroles'] ?? null;
        $this->descripcion = $args['descripcion'] ?? '';
    }
}