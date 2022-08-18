<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];
        $auth = new Usuario;


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $auth = new Usuario($_POST);

            // Validar los datos del formulario de login
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                // Comprobar que el usuario exista:
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario) {
                    //Verificar el Password:
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)) {

                        //Autenticar al usuario:
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        // Redireccionamiento:
                        if ($usuario->admin === "1") {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /cita');
                        }

                        debuguear($_SESSION);
                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }
        $alertas = Usuario::getAlertas();


        $router->render('auth/login', [
            'alertas' => $alertas ?? [],
            'auth' => $auth ?? null,

        ]);
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

                    // Guardar el usuario en la base de datos:

                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        echo "<script>alert('Guardado Correctamente');</script>";
                        header('Location: /mensaje');
                    }
                }
            }
        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje');
    }
    public static function confirmar(Router $router)
    {
        $alertas = [];
        $token = s($_GET['tok']);
        $usuario = Usuario::where('token', $token);


        if (empty($usuario)) {
            //Mostrar mensaje de eror:
            Usuario::setAlerta('error', 'Usuario No Válido');
        } else {
            // Modificar a usuario confirmado:
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta verificada Correctamente');


            //Obtener alertas
            $alertas = Usuario::getAlertas();
            // $router->render('auth/login');
        }

        // renderizar la vista
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}