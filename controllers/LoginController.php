<?php

namespace Controllers;

use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $router->render('auth/login');
    }

    public static function logout()
    {
        echo 'logout';
    }

    public static function olvide()
    {
        echo 'Olvide contraseña';
    }

    public static function recuperar()
    {
        echo 'Recuperar contraseña';
    }

    public static function crear(Router $router)
    {
        $router->render('auth/crear-cuenta', []);
    }
}