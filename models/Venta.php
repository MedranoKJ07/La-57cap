<?php

namespace Model;
use DateTime;

class Venta extends ActiveRecord
{
    protected static $tabla = 'ventas';
    protected static $columnasDB = [
        'idventas',
        'id_vendedor',
        'id_cliente',
        'subtotal',
        'descuento',
        'iva',
        'total',
        'estado',
        'creado',
        'eliminado'
    ];
    protected static $id = 'idventas';

    public $idventas;
    public $id_cliente;
    public $id_vendedor;
    public $subtotal;
    public $descuento;
    public $iva;
    public $total;
    public $estado;
    public $creado;
    public $eliminado;

    public function __construct($args = [])
    {
        $this->idventas = $args['idventas'] ?? null;
        $this->id_vendedor = $args['id_vendedor'] ?? null;
        $this->id_cliente = $args['id_cliente'] ?? null;
        $this->subtotal = $args['subtotal'] ?? 0.00;
        $this->descuento = $args['descuento'] ?? 0.00;
        $this->iva = $args['iva'] ?? 0.00;
        $this->total = $args['total'] ?? 0.00;
        $this->estado = $args['estado'] ?? 'Pendiente';
        $this->creado = $args['creado'] ?? date('Y-m-d H:i:s');
        $this->eliminado = $args['eliminado'] ?? 0;
    }

    public function guardar()
    {
        $resultado = $this->crear();
        $this->idventas = $resultado['id'];
        Inventario::verificarStockCriticoYNotificar();
    }
    public static function ventasPorFecha($inicio, $fin)
    {
        $sql = "SELECT DATE(creado) AS fecha, COUNT(*) AS total_ventas, SUM(total) AS monto_total
            FROM ventas
            WHERE eliminado = 0 AND DATE(creado) BETWEEN '$inicio' AND '$fin'
            GROUP BY DATE(creado)
            ORDER BY fecha DESC";
        $resultado = self::$db->query($sql);
        return $resultado;
    }
    public static function ventasPorVendedor($inicio, $fin)
    {
        $sql = "SELECT 
                CONCAT(v.p_nombre, ' ', v.p_apellido) AS nombre_vendedor,
                COUNT(ve.idventas) AS total_ventas,
                SUM(ve.total) AS monto_total
            FROM ventas ve
            JOIN vendedor v ON ve.id_vendedor = v.idvendedor
            WHERE ve.eliminado = 0 AND DATE(ve.creado) BETWEEN '$inicio' AND '$fin'
            GROUP BY v.idvendedor
            ORDER BY monto_total DESC";
        $resultado = self::$db->query($sql);
        return $resultado;
    }
    public static function ventasPorProducto($inicio, $fin)
    {
        $sql = "SELECT 
    p.nombre_producto, 
    SUM(dv.cantidad) AS total_vendidos, 
    SUM(dv.subtotal) AS monto_total
FROM detalles_ventas dv
JOIN producto p ON p.idproducto = dv.id_producto
JOIN ventas v ON v.idventas = dv.ventas_idventas
WHERE v.eliminado = 0 
  AND v.creado BETWEEN '{$inicio} 00:00:00' AND '{$fin} 23:59:59'
GROUP BY p.idproducto
ORDER BY total_vendidos DESC;
";

        $resultado = self::$db->query($sql);
        return $resultado;
    }
    public static function ventasPorCategoria($inicio, $fin)
    {
        $sql = "SELECT 
    c.titulo AS categoria,
    SUM(dv.cantidad) AS total_vendidos,
    SUM(dv.subtotal) AS monto_total
FROM detalles_ventas dv
JOIN producto p ON p.idproducto = dv.id_producto
JOIN categoria_producto c ON c.idcategoria_producto = p.id_categoria
JOIN ventas v ON v.idventas = dv.ventas_idventas
WHERE v.eliminado = 0 
  AND v.creado BETWEEN '{$inicio} 00:00:00' AND '{$fin} 23:59:59'
GROUP BY c.idcategoria_producto
ORDER BY monto_total DESC;
";

        $resultado = self::$db->query($sql);
        return $resultado;
    }

    public static function totalVentas()
    {
        $query = "SELECT COUNT(*) as total FROM ventas";
        $res = self::fetchAssoc($query);
        return $res['total'] ?? 0;
    }

    public static function totalIngresos()
    {
        $query = "SELECT SUM(total) as ingresos FROM ventas";
        $res = self::fetchAssoc($query);
        return $res['ingresos'] ?? 0;
    }
    public static function tieneProductosConGarantia($idPedido)
    {
        $sql = "SELECT cp.garantias_meses, v.creado AS fecha_venta
            FROM pedidos p
            INNER JOIN ventas v ON p.id_ventas = v.idventas
            INNER JOIN detalles_ventas dv ON v.idventas = dv.ventas_idventas
            INNER JOIN producto pr ON dv.id_producto = pr.idproducto
            INNER JOIN categoria_producto cp ON pr.id_categoria = cp.idcategoria_producto
            WHERE p.idpedidos = $idPedido
              AND cp.tiene_garantia = 1";

        $productos = self::fetchAssoc($sql); // Este debe retornar un array de arrays

        // Validación robusta
        if (!is_array($productos) || empty($productos)) {
            return false;
        }

        $hoy = new DateTime();

        // Si solo devuelve un solo registro como un solo array, lo convertimos a array múltiple
        if (isset($productos['garantias_meses'])) {
            $productos = [$productos]; // lo convertimos en arreglo de arreglos
        }

        foreach ($productos as $producto) {
            if (!is_array($producto))
                continue;

            $meses = (int) $producto['garantias_meses'];
            if ($meses > 0) {
                $fechaVenta = new DateTime($producto['fecha_venta']);
                $fechaLimite = (clone $fechaVenta)->modify("+$meses months");

                if ($hoy <= $fechaLimite) {
                    return true;
                }
            }
        }

        return false;
    }





}
