<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController
{
    public static function index(Router $router)
    {
        session_start();

        $router->render('/servicios/index', [
            'nombre' => $_SESSION['nombre'],

        ]);
    }

    public static function crear(Router $router)
    {
        session_start();
        $servicio = new Servicio;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if (empty($alertas)) {
                $servicio->guardar();

                header('Location: /servicios');
            }
        }

        $router->render('/servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router)
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }

        $router->render('/servicios/actualizar', [
            'nombre' => $_SESSION['nombre']
        ]);
    }

    public static function eliminar(Router $router)
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }
    }
}
