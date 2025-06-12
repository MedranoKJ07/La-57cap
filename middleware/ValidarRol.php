<?php
namespace Middleware;

use Model\Usuario;
class ValidarRol
{
    public function __construct()
    {

    }

    public function validarRol($idRol)
    {
        try {
            $conexion = conectarDb();

            $usuario = Usuario::find($_SESSION['id'], 'idusuario');
            if ($idRol == $usuario->id_roles)
                return true;
            return false;
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }

    }
}
