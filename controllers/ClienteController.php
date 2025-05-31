<?php

namespace Controllers;
use MVC\Router;

use Model\Cliente;

use Model\Pedido;
use Model\CategoriaProducto;
use Model\Devolucion;
use Model\DevolucionDetalle;
use Model\Venta;
use Model\Usuario;

class ClienteController
{
    public static function GestionarCliente(Router $router)
    {
        $busqueda = $_POST['busqueda'] ?? '';

        $clientes = Cliente::obtenerTodosConUsuario($busqueda);


        $router->renderAdmin('Admin/clients/GestionCliente', [
            'clientes' => $clientes,
            'busqueda' => $busqueda,
            'titulo' => 'Gestionar Clientes'
        ]);
    }

    public static function pedido(Router $router)
    {
        if (empty($_SESSION['autenticado_Cliente'])) {
            header('Location: /login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /cliente/pedidos');
            return;
        }

        $categorias = CategoriaProducto::obtener7Categorias();

        $pedido = Pedido::find($id, 'idpedidos'); // Buscar el pedido
        if (!$pedido) {
            header('Location: /cliente/pedidos');
            return;
        }

        $productos = Pedido::obtenerProductosConDetalles($id); // Productos del pedido

        // Verifica si tiene una devolución en proceso
        $enDevolucion = Pedido::ventaEnProcesoDevolucion($pedido->id_ventas);

        $router->renderLanding('cliente/DetallePedido', [
            'pedido' => $pedido,
            'carritoCantidad' => obtenerCantidadCarrito(),
            'categorias' => $categorias,
            'productos' => $productos,
            'titulo' => 'Detalle del Pedido',
            'enDevolucion' => $enDevolucion // Se pasa como parámetro separado
        ]);
    }
    public static function guardarDevolucion(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $pedidoId = $_POST['pedido_id'] ?? null;
            $productosSolicitados = $_POST['productos'] ?? [];

            if (!$pedidoId || empty($productosSolicitados)) {
                header('Location: /cliente/pedidos');
                exit;
            }

            $cliente = Cliente::where('id_usuario', $_SESSION['id']);
            if (!$cliente) {
                header('Location: /login');
                exit;
            }

            $pedido = Pedido::find($pedidoId, 'idpedidos');
            if (!$pedido) {
                header('Location: /cliente/pedidos');
                exit;
            }

            // Crear solicitud de devolución
            $devolucion = new Devolucion([
                'fecha_solicitud' => date('Y-m-d H:i:s'),
                'motivo' => 'Múltiples productos', // Mejora: podrías recoger los motivos individuales
                'Aprobado' => 0,
                'tipo_reembolso' => 'mixto',
                'observaciones' => '',
                'ventas_idventas' => $pedido->id_ventas,
                'cliente_idcliente' => $cliente->idcliente,
                'Estado' => 'En devolucion'
            ]);

            $resultado = $devolucion->crear();

            if (!$resultado['resultado']) {
                header('Location: /cliente/pedido?id=' . $pedidoId);
                exit;
            }

            $idDevolucion = $resultado['id'];

            // Guardar detalles de la devolución
            foreach ($productosSolicitados as $idProducto => $datos) {
                $cantidad = (int) $datos['cantidad'];
                $estado = trim($datos['motivo'] ?? 'No especificado');
                $tipo = trim($datos['tipo'] ?? 'dinero');

                if ($cantidad <= 0)
                    continue;

                $detalle = new DevolucionDetalle([
                    'cantidad' => $cantidad,
                    'Estado_Producto' => $estado,
                    'producto_idproducto' => $idProducto,
                    'Devoluciones_idDevoluciones' => $idDevolucion
                ]);

                $detalle->crear();
            }

            //  CAMBIAR ESTADO DE LA VENTA A "En devolución"
            $venta = Venta::find($pedido->id_ventas, 'idventas');
            if ($venta) {
                $venta->estado = 'En devolucion';
                $venta->actualizar($venta->idventas);
            }
            $idsAdmins = Usuario::obtenerIdsAdministradores();

            foreach ($idsAdmins as $adminId) {
                NotificacionController::crear(
                    'Nueva solicitud de devolución',
                    'Un cliente ha solicitado la devolución de un pedido. Pedido #' . $pedidoId,
                    $adminId// o quien debe recibirla
                );
            }
            header('Location: /cliente/pedidos?devolucion=ok');
            exit;
        }
    }

    public static function solicitarDevolucion(Router $router)
    {
        if (!isset($_SESSION['autenticado_Cliente'])) {
            header('Location: /login');
            exit;
        }

        $idPedido = $_GET['id'] ?? null;

        if (!$idPedido) {
            header('Location: /cliente/pedidos');
            exit;
        }

        // Verifica que el pedido pertenezca al cliente actual
        $cliente = Cliente::where('id_usuario', $_SESSION['id']);
        if (!$cliente) {
            header('Location: /cliente/pedidos');
            exit;
        }

        $pedido = Pedido::where('idpedidos', $idPedido);
        if (!$pedido || $pedido->id_cliente != $cliente->idcliente) {
            header('Location: /cliente/pedidos');
            exit;
        }

        // Obtener productos del pedido
        $productos = Pedido::obtenerProductosConDetalles($idPedido);

        $router->renderLanding('/cliente/formularioDevolucion', [
            'titulo' => 'Solicitar Devolución',
            'pedido' => $pedido,
            'productos' => $productos
        ]);
    }


}