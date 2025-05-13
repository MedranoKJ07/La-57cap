<?php 
namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Cliente;
use Model\Vendedor;
use Model\Repartidor;

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
                $usuario = Usuario::where($campo, $auth->email);

                if (!$usuario) {
                    Usuario::setAlerta('error', 'El usuario no existe');
                } elseif (!password_verify($auth->password, $usuario->password)) {
                    Usuario::setAlerta('error', 'La contraseña es incorrecta');
                } elseif ($usuario->confirmado != 1) {
                    Usuario::setAlerta('error', 'Tu cuenta no ha sido confirmada');
                } else {
                    // Iniciar sesión
                    session_start();
                    $_SESSION['id'] = $usuario->idusuario;
                    $_SESSION['email'] = $usuario->email;
                    $_SESSION['rol'] = $usuario->id_roles;
                    $_SESSION['login'] = true;

                    // Obtener nombre completo según el rol
                    switch ($usuario->id_roles) {
                        case '1': // Administrador
                            $_SESSION['nombre'] = 'Administrador';
                            break;

                        case '2': // Vendedor
                            $vendedor = Vendedor::where('id_usuario', $usuario->idusuario);
                            $_SESSION['nombre'] = "$vendedor->p_nombre $vendedor->p_apellido";
                            $_SESSION['telefono'] = $vendedor->n_telefono;
                            break;

                        case '3': // Repartidor
                            $repartidor = Repartidor::where('id_usuario', $usuario->idusuario);
                            $_SESSION['nombre'] = "$repartidor->p_nombre $repartidor->p_apellido";
                            $_SESSION['telefono'] = $repartidor->n_telefono;
                            break;

                        case '4': // Cliente
                            $cliente = Cliente::where('id_usuario', $usuario->idusuario);
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
                            header('Location: /vendedor');
                            break;
                        case '3':
                            header('Location: /repartidor');
                            break;
                        case '4':
                            header('Location: /cliente');
                            break;
                        default:
                            header('Location: /');
                            break;
                    }
                    exit;
                }

                $alertas = Usuario::getAlertas();
            }
        }

        $router->render('auth/login', [
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
    }
}
