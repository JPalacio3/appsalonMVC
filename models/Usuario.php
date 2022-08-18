<?php

namespace Model;

class Usuario extends ActiveRecord
{

    // base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'email', 'admin', 'token', 'confirmado', 'password'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $admin;
    public $token;
    public $confirmado;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->password = $args['password'] ?? '';
    }

    // Mensaje de validación para la creación de una cuenta:
    public function validarNuevaCuenta()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'Nombre Obligatorio';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'Apellido Obligatorio';
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = 'Teléfono Obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'Email Obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'Es obligatorio escribir una contraseña';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La contraseña debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    // Validar Login
    public function validarLogin()
    {
        if (!$this->email) {
            self::$alertas['error'][] = "El Email es Obligatorio";
        }

        if (!$this->password) {
            self::$alertas['error'][] = "Password Obligatorio";
        }

        return self::$alertas;
    }





    // Verificar que el usuaio ya existe:
    public function existeUsuario()
    {
        $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1 ";

        $resultado = self::$db->query($query);
        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'El usuario ya existe';
        }

        return $resultado;
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken()
    {
        $this->token = uniqid();
    }
}