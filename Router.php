<?php
namespace MVC;
use Middleware\ValidarRol;
class Router
{

    public function __construct()
    {
    }
    public $rutas = [
        'GET' => [],
        'POST' => []
    ];
    public function get($url, $fn)
    {
        $this->rutas['GET'][$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->rutas['POST'][$url] = $fn;
    }
    public function comprobarRutas()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // ✅ Rutas accesibles sin login
        $rutas_publicas = [
            '/',
            '/login',
            '/logout',
            '/olvide-cuenta',
            '/recuperar-cuenta',
            '/confirmar-cuenta',
            '/crear-cuenta',
            '/mensaje-confirmacion',
            '/reenviar-confirmacion',
            '/tienda',
            '/producto',
            '/carrito',
            '/carrito/agregar',
            '/carrito/eliminar',
            '/carrito/actualizar',
            '/checkout',
            '/checkout/confirmar',
            '/checkout/exito',
            '/SobreNosotros',
            '/visit_us'
        ];

        $rutas_por_rol = [
            1 => [ // Administrador
                '/admin',
                '/admin/Dashboard',
                '/admin/GestionarUsuario',
                '/admin/CrearUsuario',
                '/admin/ActualizarUsuario',
                '/admin/EliminarUsuario',
                '/admin/GestionarCliente',
                '/admin/GestionarVendedores',
                '/admin/CrearVendedor',
                '/admin/ActualizarVendedor',
                '/admin/EliminarVendedor',
                '/admin/GestionarRepartidor',
                '/admin/CrearRepartidor',
                '/admin/ActualizarRepartidor',
                '/admin/EliminarRepartidor',
                '/admin/GestionarProveedores',
                '/admin/CrearProveedor',
                '/admin/ActualizarProveedor',
                '/admin/EliminarProveedor',
                '/admin/GestionarCategoriaProducto',
                '/admin/CrearCategoriaProducto',
                '/admin/ActualizarCategoriaProducto',
                '/admin/EliminarCategoriaProducto',
                '/admin/GestionarProducto',
                '/admin/CrearProducto',
                '/admin/ActualizarProducto',
                '/admin/EliminarProducto',
                '/admin/VerProducto',
                '/admin/GenerarCodigoBarras',
                '/admin/DescargarCodigoBarras',
                '/admin/InventarioGeneral',
                '/admin/GestionarCompras',
                '/admin/CrearCompra',
                '/admin/DetalleCompra',
                '/admin/devoluciones',
                '/admin/devoluciones/detalle',
                '/admin/devoluciones/aprobar',
                '/admin/devoluciones/rechazar',
                '/admin/devoluciones/visitar-tienda',
                '/admin/historialPedidos',
                '/admin/detalle-pedido',
                '/admin/calificaciones',
                '/admin/detalle-calificacion',
                '/admin/reportes',
                '/admin/reporte/ventas-fecha',
                '/admin/reporte/ventas-fecha-excel',
                '/admin/reporte/ventas-fecha-pdf',
                '/admin/reportes/ventas-vendedor',
                '/admin/reportes/ventas-vendedor-excel',
                '/admin/reportes/ventas-vendedor-pdf',
                '/admin/reportes/ventas-producto',
                '/admin/reportes/ventas-producto-excel',
                '/admin/reportes/ventas-producto-pdf',
                '/admin/reportes/ventas-categoria',
                '/admin/reportes/ventas-categoria-excel',
                '/admin/reportes/ventas-categoria-pdf',
                '/admin/reportes/pedidos-repartidor',
                '/admin/reportes/pedidos-repartidor-excel',
                '/admin/reportes/pedidos-repartidor-pdf',
                '/admin/reportes/movimiento-stock',
                '/admin/reportes/movimiento-stock-excel',
                '/admin/reportes/movimiento-stock-pdf',
                '/admin/reporte/valorizacion-inventario',
                '/admin/reporte/valorizacion-inventario-excel',
                '/admin/reporte/valorizacion-inventario-pdf',
                '/admin/reporte/productos-comprados',
                '/admin/reporte/productos-comprados-excel',
                '/admin/reporte/productos-comprados-pdf'
            ],
            2 => [ // Vendedor
                '/Vendedor',
                '/vendedor/realizar-venta',
                '/ticket',
                '/ticket-pdf',
                '/vendedor/pedidos',
                '/vendedor/inventario',
                '/vendedor/VerProducto',
                '/vendedor/GenerarCodigoBarras',
                '/vendedor/DescargarCodigoBarras',
                '/vendedor/atender-pedido',
                '/vendedor/detalle-pedido',
                '/vendedor/asignar-repartidor',
                '/generar-garantia',
                '/api/producto',
                '/api/cliente'
            ],
            3 => [ // Repartidor
                '/Repartidor',
                '/repartidor/pedidos-en-camino',
                '/repartidor/confirmar-entrega',
                '/repartidor/pedido'
            ],
            4 => [ // Cliente
                '/cliente/pedidos',
                '/cliente/devolucion',
                '/cliente/devolucion/guardar',
                '/cliente/calificar',
                '/cliente/pedido'
            ]
        ];

        $URLActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];
        $fn = $this->rutas[$metodo][$URLActual] ?? null;

        // ✅ Si la ruta es pública, se permite el acceso
        if (in_array($URLActual, $rutas_publicas)) {
            if ($fn) {
                call_user_func($fn, $this);
            } else {
                http_response_code(404);
                include __DIR__ . "/views/errores/404.php";
            }
            return;
        }

        // 🛑 Si la sesión está vacía y no es ruta pública, se bloquea
        if (empty($_SESSION)) {
            http_response_code(403);
            include __DIR__ . "/views/errores/403.php";
            exit;
        }

        // ✅ Validar acceso según el rol
        $rol = $_SESSION['rol'] ?? null;

        if ($rol && isset($rutas_por_rol[$rol])) {
            $rutas_permitidas = $rutas_por_rol[$rol];
            $todas_rutas_protegidas = array_merge(...array_values($rutas_por_rol));

            if (in_array($URLActual, $todas_rutas_protegidas) && !in_array($URLActual, $rutas_permitidas)) {
                http_response_code(403);
                include __DIR__ . "/views/errores/403.php";
                exit;
            }
        } else {
            // 🛑 Si el rol no está definido o es inválido
            http_response_code(403);
            include __DIR__ . "/views/errores/403.php";
            exit;
        }

        // ✅ Si todo está bien, ejecutar la función
        if ($fn) {
            call_user_func($fn, $this);
        } else {
            http_response_code(404);
            include __DIR__ . "/views/errores/404.php";
        }
    }
    function renderLanding($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            //variable de variable $$key
            //para generar variables dinamicas
            // para mostrar el valor de la variable 
            $$key = $value;
        }

        ob_start();// inicia a guardar datos en memoria
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();// limpia los datos en la variable
        include __DIR__ . "/views/layout/layoutLanding.php";
    }
    function renderLogin($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            //variable de variable $$key
            //para generar variables dinamicas
            // para mostrar el valor de la variable 
            $$key = $value;
        }

        ob_start();// inicia a guardar datos en memoria
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();// limpia los datos en la variable
        include __DIR__ . "/views/layout/layoutLogin.php";
    }
    function renderAdmin($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            //variable de variable $$key
            //para generar variables dinamicas
            // para mostrar el valor de la variable 
            $$key = $value;
        }

        ob_start();// inicia a guardar datos en memoria
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();// limpia los datos en la variable
        include __DIR__ . "/views/layout/layoutAdmin.php";
    }
    function renderVendedor($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            //variable de variable $$key
            //para generar variables dinamicas
            // para mostrar el valor de la variable 
            $$key = $value;
        }

        ob_start();// inicia a guardar datos en memoria
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();// limpia los datos en la variable
        include __DIR__ . "/views/layout/layoutVendedor.php";
    }

    function renderRepartidor($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            //variable de variable $$key
            //para generar variables dinamicas
            // para mostrar el valor de la variable 
            $$key = $value;
        }

        ob_start();// inicia a guardar datos en memoria
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();// limpia los datos en la variable
        include __DIR__ . "/views/layout/layoutRepartidor.php";
    }
}