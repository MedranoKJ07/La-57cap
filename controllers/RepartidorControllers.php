<?php
namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Repartidor;
use Model\Rol;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Classes\Email;

class RepartidorControllers
{
    public static function Repartidor(Router $router)
    {
        $router->renderRepartidor('Repartidor/RepartidorPages', [

            'titulo' => 'Repartidor'
        ]);
    }
    public static function GestionarRepartidores(Router $router)
    {
        $busqueda = $_POST['busqueda'] ?? '';
        $repartidores = Repartidor::obtenerTodosConUsuario($busqueda);

        $router->renderAdmin('Admin/repartidores/GestionRepartidores', [
            'repartidores' => $repartidores,
            'busqueda' => $busqueda,
            'titulo' => 'Gestionar Repartidores'
        ]);
    }

    public static function crearUsuarioRepartidor(Router $router)
    {
        $usuario = new Usuario;
        $roles = Rol::getEntreIds(3, 3); // Solo rol repartidor
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST['usuario']);
            $alertas = $usuario->validarUsuario();

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
                $usuario->hashPassword();
                $usuario->crearToken();

                $email = new Email($usuario->email, $usuario->userName, $usuario->token);
                $email->enviarConfirmacion();

                $resultado = $usuario->crear();
                header('Location: /admin/CrearRepartidor?id_usuario=' . $resultado['id']);
                exit;
            }
        }

        $router->renderAdmin('Admin/repartidores/CrearUsuarioRepartidor', [
            'titulo' => 'Crear Usuario Repartidor',
            'roles' => $roles,
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function CrearRepartidor(Router $router)
    {
        $id_usuario = $_GET['id_usuario'] ?? null;
        if (!$id_usuario || !is_numeric($id_usuario)) {
            header('Location: /admin/GestionarUsuario');
            exit;
        }

        $repartidor = new Repartidor;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $repartidor->sincronizar($_POST['repartidor']);
            $repartidor->id_usuario = $id_usuario;
            $alertas = $repartidor->validar();

            if (empty($alertas)) {
                $repartidor->crear();
                header('Location: /admin/GestionarRepartidor');
                exit;
            }
        }

        $router->renderAdmin('Admin/repartidores/CrearRepartidor', [
            'repartidor' => $repartidor,
            'alertas' => $alertas,
            'id_usuario' => $id_usuario,
            'titulo' => 'Registrar Repartidor'
        ]);
    }

    public static function ActualizarRepartidor(Router $router)
    {
        $id = s($_GET['id'] ?? null);
        FilterValidateInt($id, 'admin');
        verificarId(Repartidor::find($id, 'idrepartidor'), 'admin');
        $repartidor = Repartidor::find($id, 'idrepartidor');
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $repartidor->sincronizar($_POST['repartidor']);
            $alertas = $repartidor->validar();

            if (empty($alertas)) {
                $repartidor->actualizar($id);
                header('Location: /admin/GestionarRepartidor');
                exit;
            }
        }

        $router->renderAdmin('Admin/repartidores/ActualizarRepartidor', [
            'repartidor' => $repartidor,
            'alertas' => $alertas,
            'titulo' => 'Actualizar Repartidor'
        ]);
    }

    public static function EliminarRepartidor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'] ?? null;

            if (!$id || !is_numeric($id)) {
                header('Location: /admin/GestionarRepartidor');
                exit;
            }

            $repartidor = Repartidor::find($id, 'idrepartidor');
            if (!$repartidor) {
                header('Location: /admin/GestionarRepartidor');
                exit;
            }

            $id_usuario = $repartidor->id_usuario;
            $repartidor->eliminar($id);

            $usuario = Usuario::find($id_usuario, 'idusuario');
            if ($usuario) {
                $usuario->eliminar($id_usuario);
                $usuario->delete_image(); // Asegurate que este método exista
            }

            header('Location: /admin/GestionarRepartidor');
            exit;
        }
    }
}
