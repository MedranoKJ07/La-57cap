<?php

namespace Controllers;

use MVC\Router;
use Model\Proveedor;

class ProveedorController
{
    public static function GestionarProveedores(Router $router)
    {
        $busqueda = $_POST['busqueda'] ?? '';
        $proveedores = Proveedor::filtrar($busqueda);
       
        $router->renderAdmin('Admin/proveedores/GestionProveedores', [
            'titulo' => 'Gestionar Proveedores',
            'proveedores' => $proveedores,
            'busqueda' => $busqueda
        ]);
    }

    public static function CrearProveedor(Router $router)
    {
        $proveedor = new Proveedor;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proveedor->sincronizar($_POST['proveedor']);
            $alertas = $proveedor->validar();

            if (empty($alertas)) {
                $proveedor->crear();
                header('Location: /admin/GestionarProveedores');
                exit;
            }
        }

        $router->renderAdmin('Admin/proveedores/CrearProveedor', [
            'titulo' => 'Registrar Proveedor',
            'proveedor' => $proveedor,
            'alertas' => $alertas
        ]);
    }

    public static function ActualizarProveedor(Router $router)
    {
        $id = s($_GET['id'] ?? '');
        verificarId(Proveedor::find($id, 'idProveedores'), 'admin');
        $proveedor = Proveedor::find($id, 'idProveedores');
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proveedor->sincronizar($_POST['proveedor']);
            $alertas = $proveedor->validar();

            if (empty($alertas)) {
                $proveedor->actualizar($id);
                header('Location: /admin/GestionarProveedores');
                exit;
            }
        }

        $router->renderAdmin('Admin/proveedores/ActualizarProveedor', [
            'titulo' => 'Actualizar Proveedor',
            'proveedor' => $proveedor,
            'alertas' => $alertas
        ]);
    }

    public static function EliminarProveedor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if ($id && is_numeric($id)) {
                $proveedor = Proveedor::find($id, 'idProveedores');
                if ($proveedor) {
                    $proveedor->eliminarLogico($id);
                }
            }

            header('Location: /admin/GestionarProveedores');
            exit;
        }
    }
}
