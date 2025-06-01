<?php

namespace Model;

class Inventario extends ActiveRecord
{
    protected static $tabla = 'inventario';
    protected static $columnasDB = [
        'cantidad_actual',
        'cantidad_minima',
        'fecha_actualizacion',
        'producto_idproducto'
    ];
    protected static $id = 'idInventario';
    public $idInventario;
    public $cantidad_actual;
    public $cantidad_minima;
    public $fecha_actualizacion;
    public $producto_idproducto;

    public function __construct($args = [])
    {
        $this->idInventario = $args['idInventario'] ?? null;
        $this->cantidad_actual = $args['cantidad_actual'] ?? 0;
        $this->cantidad_minima = $args['cantidad_minima'] ?? 0;
        $this->fecha_actualizacion = $args['fecha_actualizacion'] ?? date('Y-m-d H:i:s');
        $this->producto_idproducto = $args['producto_idproducto'] ?? null;
    }

    public function agregarStock($cantidad)
    {
        $this->cantidad_actual += $cantidad;
        $this->fecha_actualizacion = date('Y-m-d H:i:s');
    }

    public function reducirStock($cantidad)
    {
        $this->cantidad_actual -= $cantidad;
        $this->fecha_actualizacion = date('Y-m-d H:i:s');
    }
    public static function obtenerTodoConProducto()
    {
        $query = "SELECT 
                inventario.*, 
                producto.codigo_producto, 
                producto.nombre_producto 
              FROM inventario
              LEFT JOIN producto ON inventario.producto_idproducto = producto.idproducto";

        $resultado = self::$db->query($query);

        $objetos = [];
        while ($registro = $resultado->fetch_object()) {
            $objetos[] = $registro;
        }

        return $objetos;
    }

    public static function restarStock($productoId, $cantidadVendida)
    {
        $productoId = self::$db->real_escape_string($productoId);
        $cantidadVendida = (int) $cantidadVendida;

        $query = "UPDATE inventario 
                  SET cantidad_actual = cantidad_actual - $cantidadVendida, 
                      fecha_actualizacion = NOW()
                  WHERE producto_idproducto = '$productoId' 
                  LIMIT 1";

        return self::$db->query($query);
    }
    public static function verificarStockCriticoYNotificar()
    {
        // Obtener todos los inventarios con stock crítico
        $sql = "
        SELECT 
            i.*, 
            p.nombre_producto 
        FROM inventario i
        INNER JOIN producto p ON i.producto_idproducto = p.idproducto
        WHERE i.cantidad_actual <= i.cantidad_minima
    ";

        $resultado = self::$db->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            require_once __DIR__ . '/Usuario.php'; // si no está cargado
            require_once __DIR__ . '/../controllers/NotificacionController.php';

            $admins = Usuario::obtenerPorRol(1); // Método que devuelve todos los admins

            while ($registro = $resultado->fetch_assoc()) {
                $nombre = $registro['nombre_producto'];
                $cantidad = $registro['cantidad_actual'];

                foreach ($admins as $admin) {
                    \Controllers\NotificacionController::crear(
                        'Stock Crítico',
                        "El producto \"$nombre\" está en stock crítico con solo $cantidad unidades.",
                        $admin->idusuario
                    );
                }
            }
        }
    }

    public static function valorizacionInventario()
    {
        $query = "SELECT 
                p.nombre_producto,
                p.precio,
                i.cantidad_actual,
                (p.precio * i.cantidad_actual) AS valor_total
              FROM inventario i
              INNER JOIN producto p ON i.producto_idproducto = p.idproducto
              WHERE i.cantidad_actual > 0";
        $resultado = self::$db->query($query);
        return $resultado;
    }
    public static function stockBajo()
    {
        $query = "SELECT COUNT(*) as stockBajo FROM inventario WHERE cantidad_actual <= cantidad_minima";
        $res = self::fetchAssoc($query);
        return $res['stockBajo'] ?? 0;
    }
}
