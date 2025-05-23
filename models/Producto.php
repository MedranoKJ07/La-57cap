<?php

namespace Model;

class Producto extends ActiveRecord
{
    protected static $tabla = 'producto';
    protected static $columnasDB = [
        'id_categoria',
        'codigo_producto',
        'nombre_producto',
        'descripcion',
        'precio',
        'eliminado',
        'Foto'
    ];
    protected static $id = 'idproducto';

    public $idproducto;
    public $id_categoria;
    public $codigo_producto;
    public $nombre_producto;
    public $descripcion;
    public $precio;
    public $eliminado;
    public $Foto;
    public $categoria_nombre;
    // 👇 propiedades virtuales para el carrito
    public $cantidad;
    public $subtotal;

    public function __construct($args = [])
    {
        $this->idproducto = $args['idproducto'] ?? null;
        $this->id_categoria = $args['id_categoria'] ?? '';
        $this->codigo_producto = $args['codigo_producto'] ?? '';
        $this->nombre_producto = $args['nombre_producto'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->precio = $args['precio'] ?? 0.00;
        $this->eliminado = $args['eliminado'] ?? 0;
        $this->Foto = $args['Foto'] ?? 'f_perfil_deaulft.png';
        $this->categoria_nombre = $args['categoria_nombre'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->subtotal = $args['subtotal'] ?? '';
    }

    public function validar()
    {
        if (!$this->id_categoria) {
            self::$alertas['error'][] = 'La categoría es obligatoria';
        }

        if (!$this->codigo_producto) {
            self::$alertas['error'][] = 'El código del producto es obligatorio';
        }

        if (!$this->nombre_producto) {
            self::$alertas['error'][] = 'El nombre del producto es obligatorio';
        }

        if (!$this->descripcion) {
            self::$alertas['error'][] = 'La descripción del producto es obligatoria';
        }

        if ($this->precio === null || $this->precio < 0) {
            self::$alertas['error'][] = 'El precio debe ser válido';
        }

        return self::$alertas;
    }

    public static function obtenerActivos()
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE eliminado = 0 ORDER BY idproducto DESC";
        return self::consultarSQL($query);
    }
    public static function generarCodigoProducto($nombre, $id_categoria)
    {
        // Tomamos las primeras 3 letras del nombre sin espacios y las convertimos en mayúsculas
        $nombreAbreviado = strtoupper(substr(str_replace(' ', '', $nombre), 0, 3));

        // Tomamos las 2 últimas cifras del ID de la categoría
        $categoriaCodigo = str_pad($id_categoria, 2, '0', STR_PAD_LEFT);

        // Contamos los productos actuales para usar un número incremental
        $query = "SELECT COUNT(*) as total FROM " . static::$tabla;
        $resultado = self::$db->query($query);
        $datos = $resultado->fetch_assoc();
        $contador = intval($datos['total']) + 1;

        // Le damos formato con ceros a la izquierda
        $numero = str_pad($contador, 4, '0', STR_PAD_LEFT);

        // Formato final: NOM-CT-0001
        return "{$nombreAbreviado}-{$categoriaCodigo}-{$numero}";
    }
    public function setImagen($imagen): void
    {
        if (!is_null($this->Foto)) {
            $this->delete_image();
        }
        if ($imagen) {
            $this->Foto = $imagen;
        }
    }
    //Eliminar archivos
    public function delete_image()
    {
        //comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETAS_IMAGENES_PRODUCTOS . "/" . $this->Foto);

        if ($existeArchivo) {
            //borrar el archivo
            chmod(CARPETAS_IMAGENES_PRODUCTOS, 0755);
            unlink(CARPETAS_IMAGENES_PRODUCTOS . "/" . $this->Foto);
        }
    }
    public static function filtrar($busqueda = '', $categoriaSeleccionada = '')
    {
        $condiciones = ["producto.eliminado = 0"];

        if (!empty($busqueda)) {
            $busqueda = self::$db->real_escape_string($busqueda);
            $condiciones[] = "(producto.nombre_producto LIKE '%$busqueda%' OR categoria_producto.titulo LIKE '%$busqueda%')";
        }

        if (!empty($categoriaSeleccionada)) {
            $categoriaSeleccionada = self::$db->real_escape_string($categoriaSeleccionada);
            $condiciones[] = "producto.id_categoria = $categoriaSeleccionada";
        }

        $where = !empty($condiciones) ? 'WHERE ' . implode(' AND ', $condiciones) : '';

        $query = "
        SELECT 
            producto.*, 
            categoria_producto.titulo AS categoria_nombre
        FROM producto
        INNER JOIN categoria_producto 
            ON producto.id_categoria = categoria_producto.idcategoria_producto
        $where
        ORDER BY producto.idproducto DESC
    ";

        return self::consultarSQL($query);
    }
    public static function filtrar2($categoria = '', $busqueda = '', $orden = '')
{
    $condiciones = ["producto.eliminado = 0"];

    if ($categoria !== '') {
        $categoria = self::$db->real_escape_string($categoria);
        $condiciones[] = "producto.id_categoria = '$categoria'";
    }

    if ($busqueda !== '') {
        $busqueda = self::$db->real_escape_string($busqueda);
        $condiciones[] = "(producto.nombre_producto LIKE '%$busqueda%' OR categoria_producto.titulo LIKE '%$busqueda%')";
    }

    $where = 'WHERE ' . implode(' AND ', $condiciones);

    // Validar y aplicar orden
    $ordenSQL = '';
    if (strtolower($orden) === 'asc') {
        $ordenSQL = "ORDER BY producto.precio ASC";
    } elseif (strtolower($orden) === 'desc') {
        $ordenSQL = "ORDER BY producto.precio DESC";
    } else {
        $ordenSQL = "ORDER BY producto.idproducto DESC"; // por defecto
    }

    $query = "
        SELECT producto.*, categoria_producto.titulo AS categoria_nombre
        FROM producto
        INNER JOIN categoria_producto ON producto.id_categoria = categoria_producto.idcategoria_producto
        $where
        $ordenSQL
    ";

    return self::consultarSQL($query);
}



    public static function obtenerDestacados($limite = 3)
    {
        $query = "SELECT * FROM producto 
              WHERE eliminado = 0 
              ORDER BY RAND() 
              LIMIT " . intval($limite);

        $resultado = self::$db->query($query);

        $productos = [];
        while ($row = $resultado->fetch_object()) {
            $productos[] = $row;
        }

        return $productos;
    }
    public static function obtenerProductos()
    {
        $query = "SELECT * FROM producto WHERE eliminado = 0 ORDER BY RAND()";
        $resultado = self::$db->query($query);

        $productos = [];
        while ($producto = $resultado->fetch_object()) {
            $productos[] = $producto;
        }

        return $productos;
    }

    public static function obtenerPorCategoria($categoriaId = null, $buscar = null, $orden = null, $limit = 9, $offset = 0)
    {
        $query = "SELECT * FROM producto WHERE eliminado = 0";

        if ($categoriaId) {
            $query .= " AND id_categoria = " . self::$db->quote($categoriaId);
        }

        if ($buscar) {
            $buscar = self::$db->real_escape_string($buscar);
            $query .= " AND nombre_producto LIKE '%$buscar%'";
        }

        if ($orden === 'asc') {
            $query .= " ORDER BY precio ASC";
        } elseif ($orden === 'desc') {
            $query .= " ORDER BY precio DESC";
        }

        $query .= " LIMIT $limit OFFSET $offset";

        return self::consultarSQL($query);
    }

    public static function contarPorCategoria($categoriaId = null, $buscar = null)
    {
        $query = "SELECT COUNT(*) as total FROM producto WHERE eliminado = 0";

        if ($categoriaId) {
            $query .= " AND id_categoria = " . self::$db->quote($categoriaId);
        }

        if ($buscar) {
            $buscar = self::$db->real_escape_string($buscar);
            $query .= " AND nombre_producto LIKE '%$buscar%'";
        }

        $resultado = self::$db->query($query);
        $fila = $resultado->fetch_assoc();
        return $fila['total'] ?? 0;
    }
    public static function obtenerPorId($id)
    {
        $id = self::$db->real_escape_string($id); // Usar correctamente mysqli
        $query = "SELECT * FROM producto WHERE idproducto = '$id' LIMIT 1";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
    public static function contarFiltrados($categoria = null, $buscar = null)
    {
        $where = "WHERE eliminado = 0";

        if ($categoria) {
            $categoria = self::$db->escape_string($categoria);
            $where .= " AND id_categoria = $categoria";
        }

        if ($buscar) {
            $buscar = self::$db->escape_string($buscar);
            $where .= " AND nombre_producto LIKE '%$buscar%'";
        }

        $query = "SELECT COUNT(*) as total FROM producto $where";
        $resultado = self::$db->query($query);

        if ($resultado) {
            $row = $resultado->fetch_assoc();
            return (int) $row['total'];
        }

        return 0;
    }




}
