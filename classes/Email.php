<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $nombre;
    public $email;
    public $token;


    public function __construct($nombre, $email, $token)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {

        //Crear el objeto del Email:
        $mail = new PHPMailer();
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '7e1f7247b9876f';
        $mail->Password = '0ce59f0b64df75';

        $mail->setFrom('noReply@appsalon.com');
        $mail->addAddress('noReply@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'CONFIRMA TU CUENTA';

        // Set HTML:
        $mail->isHTML(true);
        $mail->Charset = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p> <strong> Hola " . $this->nombre . "<br></strong> <br> Has creado tu cuenta en App Salon, solo debes
    confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p> Presiona Aquí: <a href='http://localhost:6969/confirmar-cuenta?tok=" . $this->token . "'> Confirmar
        Cuenta</a></p>";
        $contenido .= "<p>Este correo se genera de manera automática por el sistema, Si tú no solicitaste esta cuenta, puedes
    ignorar este correo</p>";
        $contenido .= "

</html>";

        $mail->Body = $contenido;

        $mail->send();
    }
}