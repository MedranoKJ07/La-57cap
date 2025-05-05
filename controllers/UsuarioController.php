<?php
namespace Controllers;
use Model\Rol;
use MVC\Router;
use Model\Usuario;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Classes\Email;
class UsuarioController
{
    public static function crearUsuario(Router $router)
    {
        $usuario = new Usuario;
        $roles = Rol::get2(3);
        $alertas = [];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST['usuario']);
            $alertas = $usuario->validarUsuario();


            //generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if ($_FILES['usuario']['tmp_name']['f_perfil']) {
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['usuario']['tmp_name']['f_perfil'])->cover(800, 600);
                $usuario->setImagen($nombreImagen);
            }

            $alertas = $usuario->validarUsuario();

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

                if (!is_dir(CARPETAS_IMAGENES_PERFILES)) {
                    mkdir(CARPETAS_IMAGENES_PERFILES);
                }

                $imagen->save(CARPETAS_IMAGENES_PERFILES . "/" . $nombreImagen);

                $usuario->crear();
                $alertas['exito'][] = 'Usuario creado correctamente';
                //Redireccionar a la pagina de usuarios
                header('Location: /admin/');

            } else {

            }
        }
        $router->renderAdmin('Admin/users/CrearUsuario', [
            'roles' => $roles,
            'usuario' => $usuario,
            'alertas' => $alertas,
            'titulo' => 'Crear Usuario'
        ]);
    }
    public static function GestionarUsuario(Router $router) {
        $rolSeleccionado = $_POST['rol'] ?? '';
        $busqueda = trim($_POST['busqueda'] ?? '');

        $usuarios = Usuario::filtrarUsuarios($rolSeleccionado, $busqueda);

        $rolesDisponibles = [
            '1' => 'Administrador',
            '2' => 'Vendedor',
            '3' => 'Repartidor',
            '4' => 'Cliente'
        ];

        $router->renderAdmin('Admin/users/GestionUsuario', [
            'usuarios' => $usuarios,
            'titulo' => 'Gestionar Usuario',
            'rolesDisponibles' => $rolesDisponibles,
            'rolSeleccionado' => $rolSeleccionado,
            'busqueda' => $busqueda
        ]);
    }


    public static function ActualizarUsuario(Router $router)
    {

        $alertas = Usuario::getAlertas();
        $roles = Rol::get2(3);
        $id = $_GET['id'];
        $usuario = new Usuario;
        FilterValidateInt($id, 'admin');
        verificarId(Usuario::find($id, 'idusuario'), 'admin');
        $usuario = Usuario::find($id, 'idusuario');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //asignar los atributos
            $args = $_POST['usuario'];
            $usuario->sincronizar($args);
            $alertas = $usuario->validar();

            //generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if ($_FILES['usuario']['tmp_name']['f_perfil']) {
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['usuario']['tmp_name']['f_perfil'])->cover(800, 600);
                $usuario->setImagen($nombreImagen);
            }

            if (empty($alertas)) {
                //Subida de archivos
                //Crear carpeta
                //verifica si la carpeta existe que la cree

                if (!is_dir(CARPETAS_IMAGENES_PERFILES)) {
                    mkdir(CARPETAS_IMAGENES_PERFILES);
                }

                $imagen->save(CARPETAS_IMAGENES_PERFILES . "/" . $nombreImagen);

                $usuario->actualizar($usuario->idusuario);
                $alertas['exito'][] = 'Usuario actualizado correctamente';
                //Redireccionar a la pagina de usuarios

                header('Location: /admin/');
            }
        }
        $router->renderAdmin('Admin/users/ActualizarUsuario', [
            'roles' => $roles,
            'usuario' => $usuario,
            'alertas' => $alertas,
            'titulo' => 'Actualizar Usuario'
        ]);
    }
    public static function EliminarUsuario(Router $router)
    {
        $alertas = Usuario::getAlertas();
        $id = $_POST['id'];
        $tipo = $_POST['tipo'];
        FilterValidateInt($id, 'admin');
        verificarId(Usuario::find($id, 'idusuario'), 'admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($tipo === 'usuario') {
                $usuario = Usuario::find($id, 'idusuario');
                $usuario->eliminar($id);
                header('Location: /admin');
            }
        }
    }
}