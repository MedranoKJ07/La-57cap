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


}
