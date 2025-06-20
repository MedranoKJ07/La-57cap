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
        $roles = Rol::get2(1);
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST['usuario']);
            $usuario->existeUsuario();
            $usuario->existeEmail();
            $alertas = Usuario::getAlertas();
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
                $usuario-> db_rol = 'admin';

                // Enviar el Email
                $email = new Email($usuario->email, $usuario->userName, $usuario->token);

                $email->enviarConfirmacion();
                //Crear registro del usuario en tu sistema (tabla usuario)
                $resultado = $usuario->crear(); // Debe retornar ['resultado' => true/false, 'id' => int|null]

                if (!$resultado['resultado']) {
                    throw new \Exception("No se pudo registrar el usuario en la base de datos de la aplicación.");
                }
                //Crear el usuario en el motor de MySQL (conectar y crear)
                $db_user_resultado = $usuario->crearUsuarioMySQL();
                Usuario::asignarPermisosUsuario($usuario->userName);
                Usuario::asignarRol($usuario->db_rol, $usuario->userName);
                if (!$db_user_resultado) {
                    throw new \Exception("No se pudo crear el usuario en MySQL.");
                }
                $alertas['exito'][] = 'Usuario creado correctamente';
                //Redireccionar a la pagina de usuarios
                header('Location: /admin/GestionarUsuario');

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
    public static function GestionarUsuario(Router $router)
    {
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
        $id = s($_GET['id'] ?? '');



        $usuario = Usuario::find($id, 'idusuario');
        $alertas = Usuario::getAlertas();

        $roles = Rol::getEntreIds(1, 1); // Solo admin
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['usuario'];
            $usuario->sincronizar($args);
            $alertas = $usuario->validar();

            if ($_FILES['usuario']['tmp_name']['f_perfil']) {
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['usuario']['tmp_name']['f_perfil'])->cover(800, 600);
                $usuario->setImagen($nombreImagen);
                $usuario->delete_image();
                if (!is_dir(CARPETAS_IMAGENES_PERFILES)) {
                    mkdir(CARPETAS_IMAGENES_PERFILES);
                }

                $imagen->save(CARPETAS_IMAGENES_PERFILES . "/" . $nombreImagen);
            }

            if (empty($alertas)) {
                $usuario->actualizar($usuario->idusuario);
                $alertas['exito'][] = 'Usuario actualizado correctamente';
                header('Location: /admin/GestionarUsuario');
                exit;
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($tipo === 'usuario') {
                $usuario = Usuario::find($id, 'idusuario');
                $usuario->eliminarLogico($id);
                header('Location:/admin/EliminarUsuario');
                $usuario->delete_image();
            }
        }
    }
    public static function confirmarCuenta(Router $router)
    {
        $token = s($_GET['token'] ?? '');
        $alertas = [];
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            // Mostrar mensaje de error
            Usuario::setAlerta('error', 'Token No Válido');
        } else {
            // Modificar a usuario confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->actualizar($usuario->idusuario);
            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }

        $router->renderLogin('auth/confirmar-cuenta', [
            'titulo' => 'Confirmar Cuenta',
            'alertas' => $alertas,
            'token' => $token
        ]);
    }
    public static function olvide(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if (empty($alertas)) {
                $usuario = Usuario::where('email', $usuario->email);

                if ($usuario && $usuario->confirmado === "1") {
                    // Generar un nuevo token
                    $usuario->crearToken();
                    $usuario->actualizar($usuario->idusuario);

                    // Enviar el email
                    $email = new Email($usuario->email, $usuario->userName, $usuario->token);
                    $email->enviarInstrucciones();
                    Usuario::setAlerta('exito', 'Revisa tu correo para recuperar tu contraseña');
                } else {
                    Usuario::setAlerta('error', 'El usuario no existe o no está confirmado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->renderLogin('auth/recuperar-olvide', [
            'alertas' => $alertas,
            'titulo' => 'Olvide mi contraseña'
        ]);
    }
    public static function recuperar(Router $router)
    {
        $alertas = [];
        $error = false;
        $token = s($_GET['token'] ?? '');

        // Buscar usuario por su token
        $usuario = Usuario::where('token', $token);
        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token No Válido');
            $error = true;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leer el nuevo password y guardarlo

            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if (empty($alertas)) {
                $usuario->password = null;

                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = '';
               
                $resultado = $usuario->actualizar($usuario->idusuario);
                
                $resultado2 = Usuario::cambiarPasswordUserPassword(trim($usuario->userName), trim($usuario->password));
                if ($resultado) {
                    header('Location: /');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->renderLogin('auth/recuperar-password', [
            'alertas' => $alertas,
            'error' => $error,
            'titulo' => 'Recuperar Password'
        ]);
    }

}