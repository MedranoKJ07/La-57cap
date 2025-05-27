<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Model\Vendedor;
use Model\Rol;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Classes\Email;
use Model\Venta;
use Model\DetalleVenta;
use Model\Pedido;
use Model\Cliente;
use Dompdf\Dompdf;
use Dompdf\Options;


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
        FilterValidateInt($id_usuario, 'admin');

        $usuario = Usuario::find($id_usuario, 'idusuario');
        verificarId($usuario, 'admin');

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
            header('Location: /vendedor/ticket?id=' . $idVenta);
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

        // Obtener cliente (si existe)
        $cliente = null;
        if ($venta->id_cliente) {
            $cliente = Cliente::find($venta->id_cliente, 'idcliente');
        }

        $detalles = DetalleVenta::obtenerDetalleConProductoPorVenta($venta->idventas);

        $router->renderVendedor('Vendedor/TicketVenta', [
            'titulo' => 'Ticket de Venta',
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
}
