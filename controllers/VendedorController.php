<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Model\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Classes\Email;
use Model\Venta;
use Model\DetalleVenta;
use Model\Pedido;
use Model\Cliente;
use Dompdf\Dompdf;
use Dompdf\Options;
use Model\Producto;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorSVG;
use Model\Repartidor;
use Model\Inventario;
use Controllers\NotificacionController;
use Model\CategoriaProducto;


class VendedorController
{
    public static function Vendedor(Router $router)
    {


        $router->renderVendedor('Vendedor/VendedorPages', [

            'titulo' => 'Vendedor',
        ]);
    }
    public static function GestionarVendedores(Router $router)
    {
        $busqueda = $_POST['busqueda'] ?? '';

        $vendedores = Vendedor::obtenerTodosConUsuario($busqueda);

        $router->renderAdmin('Admin/vendedores/GestionVendedores', [
            'vendedores' => $vendedores,
            'busqueda' => $busqueda,
            'titulo' => 'Gestionar Vendedores'
        ]);
    }

    public static function crearvendedor(Router $router)
    {
        $usuario = new Usuario;
        $vendedor = new Vendedor;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST['usuario']);
            $vendedor->sincronizar($_POST['vendedor']);
            $usuario->id_roles = 2; // Rol vendedor
            $alertas = $usuario->validarUsuario();
            $usuario->existeUsuario();
            $usuario->existeEmail();
            $alertas = $usuario->getalertas();
            if ($_FILES['usuario']['tmp_name']['f_perfil']) {
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['usuario']['tmp_name']['f_perfil'])->cover(800, 600);
                $usuario->setImagen($nombreImagen);

                if (!is_dir(CARPETAS_IMAGENES_PERFILES)) {
                    mkdir(CARPETAS_IMAGENES_PERFILES);
                }

                $imagen->save(CARPETAS_IMAGENES_PERFILES . "/" . $nombreImagen);
            }

            if (empty($alertas)) {
                $usuario->hashPassword();
                $usuario->crearToken();

                $usuario->confirmado = 1;

                $resultado = $usuario->crear();
                $idUsuario = $resultado['id'];

                if ($resultado['resultado']) {
                    $email = new Email($usuario->email, $usuario->userName, $usuario->token);
                    $email->enviarConfirmacion();

                    $vendedor->id_usuario = $idUsuario;
                    $res = $vendedor->crear();

                    if ($res['resultado']) {
                        header('Location: /admin/GestionarVendedores');
                        exit;
                    } else {
                        $usuario->eliminar($idUsuario);
                        Usuario::setAlerta('error', 'Error al crear vendedor. El usuario ha sido eliminado.');
                    }
                }
            }
        }

        $router->renderAdmin('Admin/vendedores/CrearVendedor', [
            'usuario' => $usuario,
            'vendedor' => $vendedor,
            'alertas' => Usuario::getAlertas(),
            'titulo' => 'Registrar Vendedor'
        ]);
    }

    public static function ActualizarVendedor(Router $router)
    {
        $id_usuario = s($_GET['id'] ?? null);
   

        $usuario = Usuario::find($id_usuario, 'idusuario');

        $vendedor = Vendedor::where('id_usuario', $id_usuario);
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST['usuario']);
            $vendedor->sincronizar($_POST['vendedor']);

            $alertas = $usuario->validar();

            if ($_FILES['usuario']['tmp_name']['f_perfil']) {
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['usuario']['tmp_name']['f_perfil'])->cover(800, 600);
                $usuario->setImagen($nombreImagen);
                $usuario->delete_image(); // 
                if (!is_dir(CARPETAS_IMAGENES_PERFILES)) {
                    mkdir(CARPETAS_IMAGENES_PERFILES);
                }

                $imagen->save(CARPETAS_IMAGENES_PERFILES . "/" . $nombreImagen);
            }

            if (empty($alertas)) {
                $usuario->actualizar($usuario->idusuario);
                $vendedor->actualizar($vendedor->idvendedor);

                header('Location: /admin/GestionarVendedores');
                exit;
            }
        }

        $router->renderAdmin('Admin/vendedores/ActualizarVendedor', [
            'usuario' => $usuario,
            'vendedor' => $vendedor,
            'alertas' => $alertas,
            'titulo' => 'Actualizar Vendedor'
        ]);
    }


    public static function EliminarVendedor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;


            // Buscar vendedor
            $vendedor = Vendedor::find($id, 'idvendedor');

            if (!$vendedor) {
                header('Location: /admin/GestionarVendedores');
                exit;
            }

            // Guardar id_usuario para eliminar el usuario también si se desea
            $id_usuario = $vendedor->id_usuario;

            // Eliminar el vendedor
            $vendedor->eliminarLogico($id);

            // (Opcional) Eliminar el usuario asociado si lo considerás necesario
            if ($vendedor->id_usuario) {
                $usuario = Usuario::find($id_usuario, 'idusuario');
                if ($usuario) {
                    $usuario->eliminarLogico($id_usuario);
                    $usuario->delete_image();
                }
            }



            // Redirigir
            header('Location: /admin/GestionarVendedores');
            exit;
        }
    }
    public static function listarPedidosPendientes(Router $router)
    {
        $pedidos = Pedido::pendientesConClienteYVenta();

        $router->renderVendedor('Vendedor/pedidosPendientes', [
            'titulo' => 'Pedidos pendientes',
            'pedidos' => $pedidos
        ]);
    }



    public static function realizarVenta(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar sesión
            $idUsuario = $_SESSION['id'] ?? null;
            if (!$idUsuario) {
                header('Location: /login');
                exit;
            }

            // Obtener vendedor asociado
            $vendedor = Vendedor::where('id_usuario', $idUsuario);
            if (!$vendedor) {
                $_SESSION['error'] = 'Vendedor no válido.';
                header('Location: /vendedor/realizar-venta');
                return;
            }

            // Obtener productos del formulario
            $productos = $_POST['productos'] ?? [];
            if (empty($productos)) {
                $_SESSION['error'] = 'No se agregaron productos a la venta.';
                header('Location: /vendedor/realizar-venta');
                return;
            }

            // Calcular totales
            $subtotal = 0;
            foreach ($productos as $producto) {
                $precio = floatval($producto['precio']);
                $cantidad = intval($producto['cantidad']);
                $subtotal += $precio * $cantidad;
            }
            $iva = $subtotal * 0.15;
            $total = $subtotal + $iva;

            // Determinar cliente
            $idCliente = $_POST['id_cliente_registrado'] ?? null;
            $sinRegistro = isset($_POST['cliente_sin_registro']);

            if ($sinRegistro || empty($idCliente)) {
                $idCliente = null; // se usará cliente genérico
            }

            // Determinar si hay datos de pedido
            $requierePedido = !empty($_POST['direccion']) && !empty($_POST['fechaEntrega']) && !empty($_POST['horaEntrega']);
            $direccion = $_POST['direccion'] ?? '';
            $fechaEntrega = $_POST['fechaEntrega'] ?? '';
            $horaEntrega = $_POST['horaEntrega'] ?? '';
            $comentario = $_POST['Comentario'] ?? '';

            // Crear venta
            $venta = new Venta([
                'id_vendedor' => $vendedor->idvendedor,
                'id_cliente' => $idCliente,
                'subtotal' => $subtotal,
                'descuento' => 0,
                'iva' => $iva,
                'total' => $total,
                'estado' => $requierePedido ? 'En Proceso' : 'Completado',
                'creado' => date('Y-m-d H:i:s'),
                'eliminado' => 0
            ]);

            $resVenta = $venta->crear();
            if (!$resVenta['resultado']) {
                $_SESSION['error'] = 'No se pudo registrar la venta.';
                header('Location: /vendedor/realizar-venta');
                return;
            }

            $idVenta = $resVenta['id'];
            // Guardar detalles de venta
            foreach ($productos as $producto) {
                $detalle = new DetalleVenta([
                    'ventas_idventas' => $idVenta,
                    'id_producto' => $producto['id'],
                    'cantidad' => $producto['cantidad'],
                    'subtotal' => $producto['cantidad'] * $producto['precio']
                ]);
                $detalle->guardar();
                // Restar del inventario usando el modelo Inventario
                Inventario::restarStock($producto['id'], $producto['cantidad']);

            }
            // Crear pedido si hay datos completos
            if ($requierePedido) {
                $pedido = new Pedido([
                    'id_ventas' => $idVenta,
                    'id_cliente' => $idCliente ?? 1, // cliente genérico si null
                    'id_repartidor' => null,
                    'creado' => date('Y-m-d H:i:s'),
                    'fecha_entregar' => $fechaEntrega,
                    'hora_entregar' => $horaEntrega,
                    'direccion_entregar' => $direccion,
                    'comentarios' => $comentario,
                    'estado' => 0,
                    'pago_confirmado' => 1
                ]);
                $pedido->crear();
            }

            // Redirigir al ticket
            header('Location: /ticket?id=' . $idVenta);
            exit;
        }

        // Renderizado en caso de GET
        $router->renderVendedor('vendedor/RealizarVenta', [
            'titulo' => 'Realizar Venta'
        ]);
    }

    public static function ticket(Router $router)
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /vendedor/realizar-venta');
            return;
        }

        $venta = Venta::find($id, 'idventas');
        if (!$venta) {
            header('Location: /vendedor/realizar-venta');
            return;
        }

        $cliente = $venta->id_cliente ? Cliente::find($venta->id_cliente, 'idcliente') : null;
        $detalles = DetalleVenta::obtenerDetalleConProductoPorVenta($venta->idventas);

        // Validar si alguno de los productos tiene garantía
        $tieneGarantia = false;

        foreach ($detalles as $detalle) {
            $producto = Producto::whereAll('idproducto', $detalle['id_producto']);
            if ($producto) {
                $categoria = CategoriaProducto::whereAll('idcategoria_producto', $producto->id_categoria);
                if ($categoria && $categoria->tiene_garantia === '1') {
                    $tieneGarantia = true;
                    break; // basta con encontrar uno
                }
            }
        }

      

        // De lo contrario, mostrar solo ticket normal
        $router->renderVendedor('Vendedor/TicketVenta', [
            'titulo' => 'Ticket de Venta',
            'tieneGarantia' => $tieneGarantia,
            'venta' => $venta,
            'cliente' => $cliente,
            'detalles' => $detalles
        ]);
    }

    public static function ticketPDF(Router $router)
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /vendedor/realizar-venta');
            return;
        }

        $venta = Venta::find($id, 'idventas');
        if (!$venta) {
            header('Location: /vendedor/realizar-venta');
            return;
        }

        $cliente = $venta->id_cliente ? Cliente::find($venta->id_cliente, 'idcliente') : null;
        $detalles = DetalleVenta::obtenerDetalleConProductoPorVenta($venta->idventas);

        // Renderizar HTML desde vista parcial
        ob_start();
        include __DIR__ . '/../views/Vendedor/PDFTicket.php';
        $html = ob_get_clean();

        // Opciones de Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Courier'); // monospace para ticket
        $dompdf = new Dompdf($options);
        $logoPath = __DIR__ . '/../public/img/logo.png';
        $logoBase64 = base64_encode(file_get_contents($logoPath));
        $logoMime = mime_content_type($logoPath);
        $logoDataUri = "data:$logoMime;base64,$logoBase64";

        $alto_por_linea = 20;
        $lineas_base = 180;
        $lineas_producto = count($detalles) * $alto_por_linea;

        $alto_final = $lineas_base + $lineas_producto;



        $dompdf->loadHtml($html);
        $dompdf->setPaper([0, 0, 226.77, $alto_final], 'portrait');
        $dompdf->render();

        $dompdf->stream("ticket_venta_{$venta->idventas}.pdf", ['Attachment' => false]);
    }
    public static function VerProducto(Router $router)
    {
        $id = $_GET['id'] ?? null;
        $producto = Producto::find($id, 'idproducto');

        if (!$producto) {
            header('Location: /vendedor/inventario');
            return;
        }

        $router->renderVendedor('Vendedor/inventario/verProducto', [
            'titulo' => 'Detalles del Producto',
            'producto' => $producto
        ]);
    }
    public static function VerCodigoBarras(Router $router)
    {
        $id = $_GET['id'];
        $producto = Producto::find($id, 'idproducto');

        if (!$producto) {
            header('Location: /admin/GestionarProducto');
            exit;
        }


        $generator = new BarcodeGeneratorPNG();
        $codigo = $producto->codigo_producto;
        $barcode = base64_encode($generator->getBarcode($codigo, $generator::TYPE_CODE_128));

        $router->renderVendedor('vendedor/inventario/GenerarCodigobarras', [
            'codigo' => $codigo,
            'barcode' => $barcode,
            'producto' => $producto,
            'titulo' => 'Código de Barras'
        ]);
    }
    public static function DescargarCodigoBarras(Router $router)
    {
        $id = $_GET['id'] ?? null;
        $formato = $_GET['formato'] ?? 'png';
        $producto = Producto::find($id, 'idproducto');

        if (!$producto) {
            header('Location: /vendedor/inventario');
            exit;
        }

        $codigo = $producto->codigo_producto;
        $nombreArchivo = $codigo . '_barcode';

        switch ($formato) {
            case 'pdf':
                $generator = new BarcodeGeneratorPNG();
                $barcode = base64_encode($generator->getBarcode($codigo, $generator::TYPE_CODE_128));

                // Configuración de DomPDF
                $options = new Options();
                $options->set('isRemoteEnabled', true);
                $dompdf = new Dompdf($options);

                // HTML para el PDF
                $html = "
        <h2 style='text-align: center;'>$producto->nombre_producto</h2>
        <div style='text-align: center; margin-top: 30px;'>
            <img src='data:image/png;base64,{$barcode}' style='width: 300px; height: auto;' />
            <p><strong>$codigo</strong></p>
        </div>
    ";

                $dompdf->loadHtml($html);
                $dompdf->setPaper('A6', 'portrait');
                $dompdf->render();
                $dompdf->stream($nombreArchivo . ".pdf", ["Attachment" => true]);
                break;


            case 'svg':
                $generator = new BarcodeGeneratorSVG();
                header('Content-Type: image/svg+xml');
                header("Content-Disposition: attachment; filename=$nombreArchivo.svg");
                echo $generator->getBarcode($codigo, $generator::TYPE_CODE_128);
                break;

            case 'png':
            default:
                $generator = new BarcodeGeneratorPNG();
                header('Content-Type: image/png');
                header("Content-Disposition: attachment; filename=$nombreArchivo.png");
                echo $generator->getBarcode($codigo, $generator::TYPE_CODE_128);
                break;
        }
    }
    public static function verDetallePedido(Router $router)
    {
        $pedidoId = $_GET['id'] ?? null;
        if (!$pedidoId)
            header('Location: /vendedor/pedidos');

        $pedido = Pedido::find($pedidoId, 'idpedidos');
        if (!$pedido) {
            header('Location: /vendedor/pedidos');
            return;
        }

        $venta = Venta::find($pedido->id_ventas, 'idventas');
        $cliente = Cliente::find($pedido->id_cliente, 'idcliente');
        $detalles = DetalleVenta::obtenerDetalleConProductoPorVenta($venta->idventas);

        // 🔍 Verificar si hay productos con garantía
        $tieneGarantia = false;
        foreach ($detalles as $detalle) {
            if (!isset($detalle['id_producto']))
                continue;
            $producto = Producto::whereAll('idproducto', $detalle['id_producto']);
            if (!$producto)
                continue;

            $categoria = CategoriaProducto::whereAll('idcategoria_producto', $producto->id_categoria);
            if ($categoria && $categoria->tiene_garantia === '1') {
                $tieneGarantia = true;
                break;
            }
        }

        $router->renderVendedor('Vendedor/detallePedido', [
            'titulo' => 'Detalle del Pedido',
            'pedido' => $pedido,
            'venta' => $venta,
            'cliente' => $cliente,
            'detalles' => $detalles,
            'tieneGarantia' => $tieneGarantia
        ]);
    }


    public static function atenderPedido(Router $router)
    {
        $idPedido = $_GET['id'] ?? null;

        if (!$idPedido) {
            header('Location: /vendedor/pedidos');
            return;
        }

        // Buscar pedido
        $pedido = Pedido::find($idPedido, 'idpedidos');
        if (!$pedido) {
            $_SESSION['error'] = 'Pedido no encontrado';
            header('Location: /vendedor/pedidos');
            return;
        }

        // Buscar venta asociada
        $venta = Venta::find($pedido->id_ventas, 'idventas');
        if (!$venta || $venta->estado !== 'Pendiente') {
            $_SESSION['error'] = 'La venta ya fue atendida o no es válida.';
            header('Location: /vendedor/pedidos');
            return;
        }

        // Cambiar estado de la venta
        $venta->estado = 'En Proceso';

        $venta->actualizar($venta->idventas);
        NotificacionController::crear(
            'Pedido en proceso',
            'Tu pedido ha sido atendido y pronto será asignado a un repartidor.',
            Cliente::obtenerUsuarioId($pedido->id_cliente) // o quien debe recibirla
        );
        $_SESSION['mensaje'] = 'Pedido marcado como "En Proceso".';
        header('Location: /vendedor/pedidos');
    }
    public static function asignarRepartidorVista(Router $router)
    {
        $pedidos = Pedido::pedidosEnProceso();
        $repartidores = Repartidor::all();

        $router->renderVendedor('Vendedor/pedidos/asignarRepartidor', [
            'titulo' => 'Asignar Repartidor',
            'pedidos' => $pedidos,
            'repartidores' => $repartidores
        ]);
    }
    public static function asignarRepartidor(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idPedido = $_POST['id_pedido'] ?? null;
            $idRepartidor = $_POST['id_repartidor'] ?? null;

            if (!$idPedido || !$idRepartidor) {
                $_SESSION['error'] = 'Datos incompletos para asignar repartidor.';
                header('Location: /vendedor/asignar-repartidor');
                return;
            }

            // Buscar pedido
            $pedido = Pedido::find($idPedido, 'idpedidos');
            if (!$pedido) {
                $_SESSION['error'] = 'Pedido no encontrado.';
                header('Location: /vendedor/asignar-repartidor');
                return;
            }

            // Asignar repartidor al pedido
            $pedido->id_repartidor = $idRepartidor;
            $pedido->actualizar($pedido->idpedidos);

            // Cambiar estado de la venta a "En Camino"
            $venta = Venta::find($pedido->id_ventas, 'idventas');
            if ($venta && $venta->estado === 'En Proceso') {
                $venta->estado = 'En Camino';
                $venta->actualizar($venta->idventas);
            }


            NotificacionController::crear(
                'Nuevo pedido asignado',
                'Se le ha asignado un nuevo pedido con dirección de entrega. Pedido #: ' . $pedido->idpedidos,
                Repartidor::obtenerUsuarioId($pedido->id_repartidor) // o quien debe recibirla
            );
            NotificacionController::crear(
                'Pedido en camino',
                'Tu pedido ha sido asignado a un repartidor y pronto será entregado.',
                Cliente::obtenerUsuarioId($pedido->id_cliente) // o quien debe recibirla
            );

            $_SESSION['mensaje'] = 'Repartidor asignado y pedido marcado como "En Camino".';
            header('Location: /vendedor/asignar-repartidor');
        }
    }
}
