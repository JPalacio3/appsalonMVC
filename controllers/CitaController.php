<?php

namespace Controllers;

use MVC\Router;
// use Controllers\CitaController;

class CitaController
{
    public static function index(Router $router)
    {
        session_start();

        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'] ?? '',
        ]);
    }
}