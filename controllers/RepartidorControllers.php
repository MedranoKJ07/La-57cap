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
public static function CrearRepartidor(Router $router)
{
    $usuario = new Usuario;
    $repartidor = new Repartidor;
    $alertas = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1. Sincronizar datos
        $usuario->sincronizar($_POST['usuario']);
        $repartidor->sincronizar($_POST['repartidor']);
        $usuario->id_roles = 3;

        // 2. Validación del usuario
        $alertas = $usuario->validarUsuario();
       
        if (empty($alertas)) {
            // 3. Procesar imagen si hay
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

            // 4. Crear usuario
            $usuario->hashPassword();
            $usuario->crearToken();
            
            $usuario->confirmado = 1;
            $resultadoUsuario = $usuario->crear();
            $idUsuario = $resultadoUsuario['id'];

            if ($resultadoUsuario['resultado']) {
                // 5. Asociar usuario al repartidor
                $repartidor->id_usuario = $idUsuario;
                $alertas = $repartidor->validar();

                if (empty($alertas)) {
                    $resultadoRepartidor = $repartidor->crear();

                    if ($resultadoRepartidor['resultado']) {
                        // Enviar email de confirmación
                        $email = new Email($usuario->email, $usuario->userName, $usuario->token);
                        $email->enviarConfirmacion();

                        header('Location: /admin/GestionarRepartidor');
                        exit;
                    } else {
                        // Falló al crear repartidor: eliminar usuario
                        $usuario->eliminar($idUsuario);
                        $usuario->delete_image();
                        Usuario::setAlerta('error', 'Error al registrar repartidor. Se eliminó el usuario creado.');
                    }
                } else {
                    // Si hay errores al validar repartidor, eliminar usuario creado
                    $usuario->eliminar($idUsuario);
                    $usuario->delete_image();
                }
            } else {
                Usuario::setAlerta('error', 'Error al registrar el usuario.');
            }
        }
    }

    $router->renderAdmin('Admin/repartidores/CrearRepartidor', [
        'titulo' => 'Registrar Repartidor',
        'usuario' => $usuario,
        'repartidor' => $repartidor,
        'alertas' => Usuario::getAlertas()
    ]);
}


public static function ActualizarRepartidor(Router $router)
{
    $id = s($_GET['id'] ?? null);
    FilterValidateInt($id, 'admin');
    verificarId(Repartidor::find($id, 'idrepartidor'), 'admin');

    $repartidor = Repartidor::find($id, 'idrepartidor');
    $usuario = Usuario::find($repartidor->id_usuario, 'idusuario');
    $alertas = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario->sincronizar($_POST['usuario']);
        $repartidor->sincronizar($_POST['repartidor']);

        $alertas = array_merge(
            $usuario->validar(),
            $repartidor->validar()
        );

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
            $repartidor->actualizar($repartidor->idrepartidor);

            header('Location: /admin/GestionarRepartidor');
            exit;
        }
    }

    $router->renderAdmin('Admin/repartidores/ActualizarRepartidor', [
        'usuario' => $usuario,
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
            $repartidor->eliminarLogico($id);
            if ($repartidor->id_usuario) {

                $usuario = Usuario::find($id_usuario, 'idusuario');
                if ($usuario) {
                    $usuario->eliminarLogico($id_usuario);
                    $usuario->delete_image(); // Asegurate que este método exista
                }
            }

            header('Location: /admin/GestionarRepartidor');
            exit;
        }
    }
}
