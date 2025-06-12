<?php
namespace Controllers;

use MVC\Router;
use Model\Cliente;
use Model\Usuario;
use Model\Vendedor;
use Model\Repartidor;
use Model\ActiveRecord;
use Classes\Email;
class LoginController
{

    public static function login(Router $router)
    {
        $alertas = [];
        $auth = new Usuario;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $auth->sincronizar($_POST['usuario']);
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                // Buscar usuario por email o userName
                $campo = filter_var($auth->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'userName';
                $usuario = Usuario::wherelogico($campo, $auth->email);

                if (!$usuario) {
                    Usuario::setAlerta('error', 'El usuario no existe');
                } elseif (!password_verify($auth->password, $usuario->password)) {

                    // Aumentar intentos fallidos
                    $usuario->intentos_fallidos = ($usuario->intentos_fallidos ?? 0) + 1;

                    if ($usuario->intentos_fallidos >= 5) {
                        $usuario->confirmado = 0;
                        $usuario->crearToken();
                        $usuario->actualizar($usuario->idusuario);

                        // Enviar correo con link de activación
                        $email = new Email($usuario->email, $usuario->userName, $usuario->token);
                        $email->enviarConfirmacion();

                        Usuario::setAlerta('error', 'Tu cuenta ha sido bloqueada tras varios intentos. Revisa tu correo para reactivarla.');
                    } else {
                        $usuario->actualizar($usuario->idusuario);
                        Usuario::setAlerta('error', 'Contraseña incorrecta. Intento ' . $usuario->intentos_fallidos . ' de 5.');
                    }
                } elseif ($usuario->confirmado != 1) {
                    Usuario::setAlerta('error', 'Tu cuenta no ha sido confirmada');
                } else {
                    // Iniciar sesión
                    // Login exitoso
                    $usuario->intentos_fallidos = 0;
                    $usuario->actualizar($usuario->idusuario);
                    
                    var_dump("here");
                    $database = conectarDb();  //cambio
                    ActiveRecord::setDB($database);

                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['id'] = $usuario->idusuario;
                    $_SESSION['email'] = $usuario->email;
                    $_SESSION['rol'] = $usuario->id_roles;
                    $_SESSION['f_perfil'] = $usuario->f_perfil;
                    $_SESSION['login'] = true;
                    

                    // Obtener nombre completo según el rol
                    switch ($usuario->id_roles) {

                        case '1': // Administrador
                            $_SESSION['nombre'] = 'Administrador';
                            $_SESSION['AreaProtegida'] = true;
                            break;

                        case '2': // Vendedor
                            $vendedor = Vendedor::where('id_usuario', $usuario->idusuario);
                            $_SESSION['nombre'] = "$vendedor->p_nombre $vendedor->p_apellido";
                            $_SESSION['telefono'] = $vendedor->n_telefono;
                            $_SESSION['AreaProtegida'] = true;
                            break;

                        case '3': // Repartidor
                            $repartidor = Repartidor::where('id_usuario', $usuario->idusuario);
                            $_SESSION['nombre'] = "$repartidor->p_nombre $repartidor->p_apellido";
                            $_SESSION['telefono'] = $repartidor->n_telefono;
                            $_SESSION['AreaProtegida'] = true;
                            break;

                        case '4': // Cliente
                            $cliente = Cliente::where('id_usuario', $usuario->idusuario);
                            $_SESSION['autenticado_Cliente'] = true;
                            $_SESSION['id_cliente'] = $cliente->idcliente;
                            $_SESSION['nombre'] = "$cliente->p_nombre $cliente->p_apellido";
                            $_SESSION['telefono'] = $cliente->n_telefono;
                            break;
                    }

                    // Redirigir según el rol
                    switch ($usuario->id_roles) {
                        case '1':
                            header('Location: /admin');
                            break;
                        case '2':
                            header('Location: /Vendedor');
                            break;
                        case '3':

                            header('Location: /Repartidor');
                            break;
                        case '4':
                            header('Location: /');
                            break;
                        default:
                            $_SESSION = [];
                            // Rol no encontrado -> mostrar vista 404
                            http_response_code(404);
                            include __DIR__ . "/views/errores/404.php";
                            exit;
                    }
                    exit;
                }

                $alertas = Usuario::getAlertas();
            }
        }

        $router->renderLogin('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas,
            'usuario' => $auth
        ]);
    }

    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
        ActiveRecord::setDB('');
    }
}
