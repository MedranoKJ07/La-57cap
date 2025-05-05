<?php 
namespace Model;

class Notificacion extends ActiveRecord
{
    protected static $tabla = 'notificacion';
    protected static $columnasDB = [
        'id_usuario',
        'titulo',
        'descripcion',
        'creada_fecha'
    ];
    protected static $id = 'idnotificacion';
    public $idnotificacion;
    public $id_usuario;
    public $titulo;
    public $descripcion;
    public $creada_fecha;
    public function __construct($args = [])
    {
        $this->idnotificacion = $args['idnotificacion'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->creada_fecha = date('Y/m/d H:i:s');
    }
}