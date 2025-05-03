<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Model\Cliente;
use Model\Rol;
class DashBoardController
{

    public static function Dashboard(Router $router)
    {
        $roles = Rol::get(3);

        $router->renderAdmin('Admin/Dashboard/dashboard', [
            'roles' => $roles,
            'titulo' => 'Dashboard',
        ]);
    }
}