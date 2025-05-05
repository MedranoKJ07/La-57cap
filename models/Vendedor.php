<?php 

namespace Model;

class Vendedor extends ActiveRecord
{
    protected static $tabla = 'usuario';
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
    protected static $id = 'idvendedor';
    public $idvendedor;
    
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
        $this->idvendedor = $args['idvendedor'] ?? null;
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
