<?php
namespace Model;
class ActiveRecord
{

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];
    protected static $id;

    // Alertas y Mensajes
    protected static $alertas = [];

    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public static function setAlerta($tipo, $mensaje)
    {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas()
    {
        return static::$alertas;
    }

    public function validar()
    {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria
    public static function consultarSQL($query)
    {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }
    public static function fetchAssoc($sql)
    {
        $resultado = self::$db->query($sql);
        return $resultado->fetch_assoc();
    }

    // Identificar y unir los atributos de la BD
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id')
                continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    protected function sanitizarAtributos()
    {
        $atributos = [];
        foreach ($this->atributos() as $key => $value) {
            if (is_scalar($value)) {
                $atributos[$key] = self::$db->escape_string($value);
            }
        }
        return $atributos;
    }


    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Registros - CRUD


    // Todos los registros
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id, $columna)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = {$id}";

        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
    public static function obtenerTodos()
    {
        $tabla = static::$tabla;
        $query = "SELECT * FROM $tabla WHERE eliminado = 0";
        return self::consultarSQL($query);
    }

    public static function get2($limite)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function getEntreIds($desde, $hasta)
    {
        $desde = self::$db->escape_string($desde);
        $hasta = self::$db->escape_string($hasta);

        $query = "SELECT * FROM roles WHERE idroles BETWEEN $desde AND $hasta";
        return self::consultarSQL($query);
    }

    // Obtener Registros con cierta cantidad
    public static function get($limite)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    // Busca un registro por su id
    public static function where($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function whereAll($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " 
              WHERE $columna = '" . self::$db->escape_string($valor) . "' 
              AND eliminado = 0";

        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
    public static function wherelogico($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " 
              WHERE $columna = '" . self::$db->escape_string($valor) . "' 
              AND eliminado = 0 
              LIMIT 1";

        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    // crea un nuevo registro
    public function crear()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        // debuguear($query);
        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
            'resultado' => $resultado,
            'id' => self::$db->insert_id
        ];
    }

    // Actualizar el registro
    public function actualizar($id_m)
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE " . static::$id . " = '" . self::$db->escape_string($id_m) . "' ";
        $query .= " LIMIT 1 ";

        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un Registro por su ID
    public function eliminar($id_m)
    {
        $id_m = self::$db->real_escape_string($id_m); // Seguridad ante inyecciones SQL
        $query = "DELETE FROM " . static::$tabla . " WHERE " . static::$id . " = " . self::$db->escape_string($id_m) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }
    public static function eliminarLogico($id)
    {
        $id = self::$db->real_escape_string($id); // Seguridad ante inyecciones SQL
        $query = "UPDATE " . static::$tabla . " SET eliminado = 1 WHERE " . static::$id . " = '$id' LIMIT 1";
        return self::$db->query($query);
    }


}