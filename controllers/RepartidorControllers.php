<?php 
namespace Controllers;

use MVC\Router;
use Model\Repartidor;

class RepartidorControllers {

    public static function GestionarRepartidores(Router $router) {
        $busqueda = $_POST['busqueda'] ?? '';

        $repartidores = Repartidor::obtenerTodosConUsuario($busqueda);

        $router->renderAdmin('Admin/repartidores/GestionRepartidores', [
            'repartidores' => $repartidores,
            'busqueda' => $busqueda,
            'titulo' => 'Gestionar Repartidores'
        ]);
    }
}
