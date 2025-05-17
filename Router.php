<?php
namespace MVC;
class Router
{
    public $rutas = [
        'GET' => [],
        'POST' => []
    ];
    public function get($url, $fn)
    {
        $this->rutas['GET'][$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->rutas['POST'][$url] = $fn;
    }
    public function comprobarRutas()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        $rutas_protegidas = [''];

        $URLActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];
        if ($metodo === 'GET') {
            $fn = $this->rutas['GET'][$URLActual] ?? null;
        } else {
            $fn = $this->rutas['POST'][$URLActual] ?? null;
        }
        // if (in_array($URLActual,$rutas_protegidas) && !$auth) {
        //     header('Location: /');
        // }
        if ($fn) {
            call_user_func($fn, $this);
        } else {
            // Ruta no encontrada -> mostrar vista 404
            http_response_code(404);
            include __DIR__ . "/views/errores/404.php";
            exit;
        }
    }
    function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            //variable de variable $$key
            //para generar variables dinamicas
            // para mostrar el valor de la variable 
            $$key = $value;
        }

        ob_start();// inicia a guardar datos en memoria
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();// limpia los datos en la variable
        include __DIR__ . "/views/layout/layout.php";
    }
    function renderAdmin($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            //variable de variable $$key
            //para generar variables dinamicas
            // para mostrar el valor de la variable 
            $$key = $value;
        }

        ob_start();// inicia a guardar datos en memoria
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();// limpia los datos en la variable
        include __DIR__ . "/views/layout/layoutAdmin.php";
    }
    function renderVendedor($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            //variable de variable $$key
            //para generar variables dinamicas
            // para mostrar el valor de la variable 
            $$key = $value;
        }

        ob_start();// inicia a guardar datos en memoria
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();// limpia los datos en la variable
        include __DIR__ . "/views/layout/layoutVendedor.php";
    }
    function renderRepartidor($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            //variable de variable $$key
            //para generar variables dinamicas
            // para mostrar el valor de la variable 
            $$key = $value;
        }

        ob_start();// inicia a guardar datos en memoria
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();// limpia los datos en la variable
        include __DIR__ . "/views/layout/layoutRepartidor.php";
    }
}