<?php

namespace Model;

class CategoriaProducto extends ActiveRecord
{
    protected static $tabla = 'categoria_producto';
    protected static $columnasDB = [
        'garantias_meses',
        'titulo',
        'politica_garantia',
        'estado',
        'tiene_garantia'
    ];

    protected static $id = 'idcategoria_producto';

    public $idcategoria_producto;
    public $garantias_meses;
    public $titulo;
    public $politica_garantia;
    public $estado;
    public $tiene_garantia;

    public function __construct($args = [])
    {
        $this->idcategoria_producto = $args['idcategoria_producto'] ?? null;
        $this->garantias_meses = $args['garantias_meses'] ?? 0;
        $this->titulo = $args['titulo'] ?? '';
        $this->politica_garantia = $args['politica_garantia'] ?? '';
        $this->estado = $args['estado'] ?? 1;
        $this->tiene_garantia = $args['tiene_garantia'] ?? 1;
    }

    public function validar()
    {
        if (!$this->titulo) {
            self::$alertas['error'][] = 'El título de la categoría es obligatorio';
        }
        if (!$this->garantias_meses && $this->tiene_garantia) {
            self::$alertas['error'][] = 'Debe indicar los meses de garantía si aplica garantía';
        }
        if (!$this->politica_garantia && $this->tiene_garantia) {
            self::$alertas['error'][] = 'Debe indicar la política de garantía si aplica garantía';
        }

        return self::$alertas;
    }
    public static function obtenerTodas()
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE eliminado = 0 ORDER BY idcategoria_producto DESC";
        return self::consultarSQL($query);
    }
    public static function filtrar($busqueda = '')
    {
        $condiciones = ["eliminado = 0"]; // Solo categorías activas

        if (!empty($busqueda)) {
            $busqueda = self::$db->real_escape_string($busqueda);
            $condiciones[] = "(titulo LIKE '%$busqueda%' OR politica_garantia LIKE '%$busqueda%')";
        }

        $where = 'WHERE ' . implode(' AND ', $condiciones);
        $query = "SELECT * FROM " . static::$tabla . " $where ORDER BY idcategoria_producto DESC";

        return self::consultarSQL($query);
    }

}
