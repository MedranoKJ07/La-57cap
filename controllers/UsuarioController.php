<?php
namespace Controllers;
use Model\Rol;
use MVC\Router;
use Model\Usuario;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
class UsuarioController
{
    public static function crearUsuario(Router $router)
    {
        $usuario = new Usuario;
        $roles = Rol::get2(3);
        $alertas = [];
       

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            $usuario = new Usuario($_POST['usuario']);

            //generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if ($_FILES['usuario']['tmp_name']['f_perfil']) {
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['usuario']['tmp_name']['f_perfil'])->cover(800, 600);
                $usuario->setImagen($nombreImagen);
            }
            
            $alertas = $usuario->validarNuevoUsuario();
            
            if (empty($alertas)) {
                //Subida de archivos
                //Crear carpeta
                //verifica si la carpeta existe que la cree
                $usuario->crearToken();
                
                if (!is_dir(CARPETAS_IMAGENES_PERFILES)) {
                    mkdir(CARPETAS_IMAGENES_PERFILES);
                }
                
                $imagen->save(CARPETAS_IMAGENES_PERFILES . "/" . $nombreImagen);
                
                $usuario->crear();
                $alertas['exito'][] = 'Usuario creado correctamente';
                //Redireccionar a la pagina de usuarios
                header('Location: /admin/');
                
            }else{

            }
        }
        $router->renderAdmin('Admin/users/CrearUsuario', [
            'roles' => $roles,
            'usuario' => $usuario,
            'alertas' => $alertas,
            'titulo' => 'Crear Usuario'
        ]);
    }
    public static function GestionarUsuario(Router $router)
    {
        $usuarios = Usuario::all();

        $router->renderAdmin('Admin/users/GestionUsuario', [
            'usuarios' => $usuarios,
            'titulo' => 'Gestionar Usuario'
        ]);
    }
}
