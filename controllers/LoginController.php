<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Model\Cliente;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            
            $alertas = $auth->validarLogin();


            if (empty($alertas)) {
                // Comprobar que exista el usuario
                if ($auth->email) {
                    $usuario = Usuario::where('email', $auth->email);
                } else {
                    $usuario = Usuario::where('userName', $auth->email);
                }
                
                if ($usuario) {
                    // Verificar el password
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        $cliente = Cliente::where('id_usuario', $usuario->idusuario);
                        // Autenticar el usuario
                        session_start();

                        $_SESSION['idusuario'] = $usuario->idusuario;
                        $_SESSION['id_cliente'] = $cliente->idcliente;
                        $_SESSION['id_roles'] = $usuario->id_roles;
                        $_SESSION['userName'] = $usuario->userName;
                        $_SESSION['f_perfil'] = $usuario->f_perfil;
                        $_SESSION['nombre_cliente'] = $cliente->p_nombre . " " . $cliente->s_nombre . " " . $cliente->p_apellido . " " . $cliente->s_apellido;
                        $_SESSION['direccion'] = $cliente->direccion;
                        $_SESSION['municipio'] = $cliente->Municipio;
                        $_SESSION['telefono'] = $cliente->n_telefono;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        // Redireccionamiento 
                        // if ($usuario->id_roles === "1") {

                        //     $_SESSION['admin'] = $usuario->admin ?? null;
                        //     header('Location: /admin');
                        // } else {
                        //     header('Location: /cita');
                        // }
                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }

            }
        }

        $alertas = Usuario::getAlertas();
       
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }
}
