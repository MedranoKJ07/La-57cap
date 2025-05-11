<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Model\Vendedor;
use Model\Rol;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Classes\Email;
class VendedorController
{
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
    public static function crearUsuarioVendedor(Router $router)
    {
        $usuario = new Usuario;
        $roles = Rol::getEntreIds(2, 2);
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST['usuario']);
            // $usuario->existeUsuario();
            // $usuario->existeEmail();
            // $alertas = Usuario::getAlertas();
            $alertas = $usuario->validarUsuario();



            //generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if ($_FILES['usuario']['tmp_name']['f_perfil']) {
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['usuario']['tmp_name']['f_perfil'])->cover(800, 600);
                $usuario->setImagen($nombreImagen);
                if (!is_dir(CARPETAS_IMAGENES_PERFILES)) {
                    mkdir(CARPETAS_IMAGENES_PERFILES);
                }
                $imagen->save(CARPETAS_IMAGENES_PERFILES . "/" . $nombreImagen);
            }
            if (empty($alertas)) {
                //Subida de archivos
                //Crear carpeta
                // Hashear el Password
                $usuario->hashPassword();
                //verifica si la carpeta existe que la cree
                $usuario->crearToken();

                // Enviar el Email
                $email = new Email($usuario->email, $usuario->userName, $usuario->token);

                $email->enviarConfirmacion();
                $resultado = $usuario->crear();

                $alertas['exito'][] = 'Usuario creado correctamente';
                //Redireccionar a la pagina de usuarios
                header('Location: /admin/CrearVendedor?id_usuario=' . $resultado['id']);
            } else {

            }
        }
        $router->renderAdmin('Admin/vendedores/CrearUsuarioVendedor', [
            'titulo' => 'Crear Usuario Vendedor',
            'roles' => $roles,
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function CrearVendedor(Router $router)
    {

        $id_usuario = $_GET['id_usuario'] ?? null;

        // Si no se pasa el id_usuario, redirigimos
        if (!$id_usuario || !is_numeric($id_usuario)) {
            header('Location: /admin/GestionarUsuario');
            exit;
        }

        $vendedor = new Vendedor;

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $vendedor->sincronizar($_POST['vendedor']);

            $alertas = $vendedor->validar();

            if (empty($alertas)) {
                $vendedor->crear();
                header('Location: /admin/GestionarVendedores');
                exit;
            }
        }

        $router->renderAdmin('Admin/vendedores/CrearVendedor', [
            'vendedor' => $vendedor,
            'alertas' => $alertas,
            'id_usuario' => $id_usuario,
            'titulo' => 'Registrar Vendedor'
        ]);
    }
    public static function ActualizarVendedor(Router $router)
    {
        $id = s($_GET['id'] ?? null);

        FilterValidateInt($id, 'admin');
        verificarId(Vendedor::find($id, 'idvendedor'), 'admin');

        // Buscar al vendedor por ID
        $vendedor = Vendedor::find($id, 'idvendedor');

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sincronizar datos del formulario con el modelo
            $vendedor->sincronizar($_POST['vendedor']);
            $alertas = $vendedor->validar();

            if (empty($alertas)) {
                // Guardar los cambios
                $vendedor->actualizar($id);
                header('Location: /admin/GestionarVendedores');
                exit;
            }
        }

        // Renderizar la vista con los datos del vendedor
        $router->renderAdmin('Admin/vendedores/ActualizarVendedor', [
            'vendedor' => $vendedor,
            'alertas' => $alertas,
            'titulo' => 'Actualizar Vendedor'
        ]);
    }
    public static function EliminarVendedor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            // Validar ID
            if (!$id || !is_numeric($id)) {
                header('Location: /admin/GestionarVendedores');
                exit;
            }

            // Buscar vendedor
            $vendedor = Vendedor::find($id , 'idvendedor'); 

            if (!$vendedor) {
                header('Location: /admin/GestionarVendedores');
                exit;
            }

            // Guardar id_usuario para eliminar el usuario también si se desea
            $id_usuario = $vendedor->id_usuario;

            // Eliminar el vendedor
            $vendedor->eliminar(    $id);

            // (Opcional) Eliminar el usuario asociado si lo considerás necesario
            
            $usuario = Usuario::find($id_usuario , 'idusuario');
            if ($usuario) {
                $usuario->eliminar( $id_usuario);
            }
            

            // Redirigir
            header('Location: /admin/GestionarVendedores');
            exit;
        }
    }


}
