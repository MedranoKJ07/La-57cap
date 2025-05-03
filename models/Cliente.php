<?php

namespace Model;

class Cliente extends ActiveRecord
{
    protected static $tabla = 'usuario';
    protected static $columnasDB = [
        'idcliente',
        'id_usuario',
        'p_nombre',
        's_nombre',
        'p_apellido',
        's_apellido',
        'n_telefono',
        'direccion',
        'Municipio'
    ];
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
}