<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Model\Cliente;
use Model\Rol;
class AdminController
{

    public static function Admin(Router $router)
    {
        $roles = Rol::get(3);

        $router->renderAdmin('Admin/AdminPages', [
            'roles' => $roles,
            'titulo' => 'Administración',
        ]);
    }
}