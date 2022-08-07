<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
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

            // Revisar que alerta esté vacío para autenticar un usuario:
            if (empty($alertas)) {
                // Verificar que el usuario esté autenticado
                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    // No está registrado
                    // Hashear el password:
                    $usuario->hashPassword();

                    // Generar un token único por cada usuario:
                    $usuario->crearToken();

                    // Enviar el Email:
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);


                    $email->enviarConfirmacion();


                    debuguear($usuario);
                }
            }
        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
}