<?php
namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Cliente;
use Classes\Email;

class RegistroController
{
    public static function crearCuenta(Router $router)
    {
        $usuario = new Usuario;
        $cliente = new Cliente;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sincronizar datos del formulario
            $usuario->sincronizar($_POST['usuario']);
            $cliente->sincronizar($_POST['cliente']);

            // Validar usuario
            $alertas = $usuario->validarNuevaCuenta();

            if (empty($alertas)) {
                // Verificar si ya existe
                $existeUsuario = Usuario::where('email', $usuario->email);
                if ($existeUsuario) {
                    Usuario::setAlerta('error', 'El correo ya está registrado');
                } else {
                    // Hash de contraseña y guardar usuario
                    $usuario->password = password_hash($usuario->password, PASSWORD_BCRYPT);
                    $usuario->confirmado = 0;
                    $usuario->id_roles = 4; // Cliente
                    $usuario->crearToken();
                    $resultado = $usuario->crear();

                    $idUsuario = $resultado['id'];

                    if ($resultado['resultado']) {
                        // Asociar cliente con usuario
                        $cliente->idusuario = $idUsuario;


                        $resultadoCliente = $cliente->crear();

                        if ($resultadoCliente['resultado']) {
                            header('Location: /mensaje-confirmacion');
                            exit;
                        } else {
                            // Eliminar usuario si falla cliente
                            $usuario->eliminar($idUsuario);
                            Usuario::setAlerta('error', 'Error al crear cliente. Intenta nuevamente.');
                        }
                    }
                }

                $alertas = Usuario::getAlertas();
            }
        }

        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'cliente' => $cliente,
            'alertas' => $alertas,
            'titulo' => 'Crea tu cuenta'
        ]);
    }
    public static function mensajeConfirmacion(Router $router)
    {
        $router->render('auth/mensaje-confirmacion', [
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

        $router->render('auth/reenviar-confirmacion', [
            'titulo' => 'Reenviar Confirmación',
            'alertas' => $alertas
        ]);
    }


}
