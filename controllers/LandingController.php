<?php

namespace Controllers;

use MVC\Router;

class LandingController
{
    public static function index(Router $router)
    {
        $router->renderLanding('landing', [
            'titulo' => 'Bienvenido a La 57 CAP'
        ]);
    }
}
