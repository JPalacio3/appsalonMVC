<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;

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
        $usuario = new Usuario();

        // Alertas vacías
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            // debuguear($alertas);
        }

        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
}