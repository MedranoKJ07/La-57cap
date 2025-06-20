<?php
namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Cliente;
use Classes\Email;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class RegistroController
{
    public static function crearCuenta(Router $router)
    {
        $usuario = new Usuario;
        $cliente = new Cliente;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1. Sincronizar datos del formulario
            $usuario->sincronizar($_POST['usuario']);
            $cliente->sincronizar($_POST['cliente']);
            // 3. Validar datos del usuario
            $alertas = $usuario->validarNuevaCuenta();
            $alertas = $cliente->validar();
            // 4. Verificar si el usuario o email ya existe
            $usuario->existeUsuario();
            $usuario->existeEmail();
            $alertas = $usuario->getalertas();

            // 2. Procesar imagen de perfil (opcional)
            if (!empty($_FILES['usuario']['tmp_name']['f_perfil'])) {
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


                // 5. Preparar usuario para guardar
                $usuario->hashPassword();
                $usuario->confirmado = 0;
                $usuario->id_roles = 4; // Rol cliente
                $usuario->db_rol = 'cliente'; // Rol cliente
                $usuario->crearToken();

                //Crear registro del usuario en tu sistema (tabla usuario)
                $resultado = $usuario->crear(); // Debe retornar ['resultado' => true/false, 'id' => int|null]

                if (!$resultado['resultado']) {
                    throw new \Exception("No se pudo registrar el usuario en la base de datos de la aplicación.");
                }
                
                //Crear el usuario en el motor de MySQL (conectar y crear)
                $db_user_resultado = $usuario->crearUsuarioMySQL();
                Usuario::asignarPermisosUsuario($usuario->userName);
                Usuario::asignarRol($usuario->db_rol,$usuario->userName);

                if (!$db_user_resultado) {
                    throw new \Exception("No se pudo crear el usuario en MySQL.");
                }

                //Obtener ID generado
                $idUsuario = $resultado['id'];

                //Confirmar éxito de ambas operaciones
                if ($resultado['resultado'] && $db_user_resultado) {
                    // Opcional: asignar rol, enviar email, redirigir...
                    // 6. Asociar cliente al usuario
                    $cliente->id_usuario = $idUsuario;

                    $resultadoCliente = $cliente->crear();
                    // Enviar el Email
                    $email = new Email($usuario->email, $usuario->userName, $usuario->token);
                    $email->enviarConfirmacion();
                    if ($resultadoCliente['resultado']) {

                        header('Location: /mensaje-confirmacion');

                        exit;
                    } else {
                        // Si falla cliente, eliminar usuario para mantener coherencia
                    
                        $usuario->delete_image(); // También borramos imagen si se creó
                        Usuario::setAlerta('error', 'Error al crear cliente. Intenta nuevamente.');
                    }
                } else {
                    Usuario::setAlerta('error', 'No se pudo registrar el usuario. Intenta nuevamente.');
                }


                $alertas = Usuario::getAlertas();
            }
        }

        // 7. Mostrar formulario con datos y alertas
        $router->renderLogin('auth/crear-cuenta', [
            'usuario' => $usuario,
            'cliente' => $cliente,
            'alertas' => $alertas,
            'titulo' => 'Crea tu cuenta'
        ]);
    }

    public static function mensajeConfirmacion(Router $router)
    {
        $router->renderLogin('auth/mensaje-confirmacion', [
            'titulo' => 'Confirma tu cuenta'
        ]);
    }
    public static function reenviarConfirmacion(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';

            $usuario = Usuario::where('email', $email);
            if (!$usuario) {
                Usuario::setAlerta('error', 'El correo no está registrado.');
            } elseif ($usuario->confirmado == 1) {
                Usuario::setAlerta('error', 'Esta cuenta ya está confirmada.');
            } else {
                $usuario->creartoken();
                $usuario->actualizar($usuario->idusuario);

                // Enviar email
                $emailObj = new Email($usuario->email, $usuario->userName, $usuario->token);
                $emailObj->enviarConfirmacion();

                Usuario::setAlerta('exito', 'Correo de confirmación enviado.');
            }

            $alertas = Usuario::getAlertas();
        }

        $router->renderLogin('auth/reenviar-confirmacion', [
            'titulo' => 'Reenviar Confirmación',
            'alertas' => $alertas
        ]);
    }


}
