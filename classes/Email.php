<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {

        //Crear el objeto de email
        // Looking to send emails in production? Check out our Email API/SMTP product!
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '40c8d967edec2a';
        $mail->Password = '7b3ffb2dad7a1a';

        $mail->setFrom('email@styloreserva.cl');
        $mail->addAddress('email@styloreserva.cl', 'StyloReserva.cl');
        $mail->Subject = 'Confirma tu cuenta';

        // Set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $confirmationLink = URL_BASE . "/confirmar-cuenta?token=" . $this->token;
        error_log('Enlace de confirmación generado: ' . $confirmationLink);
        
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en StyloReserva, debes confirmar tu cuenta en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $confirmationLink . "'>Confirmar Cuenta</a></p>";

        $contenido .= "<p>Si no has sido tú, ignora este mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        // Enviar el Email
        $mail->send();

    }

    public function enviarInstrucciones() {
        //Crear el objeto de email
        // Looking to send emails in production? Check out our Email API/SMTP product!
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '40c8d967edec2a';
        $mail->Password = '7b3ffb2dad7a1a';

        $mail->setFrom('email@styloreserva.cl');
        $mail->addAddress('email@styloreserva.cl', 'StyloReserva.cl');
        $mail->Subject = 'Reestablecer Contraseña';

        // Set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo. </p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:5000/recuperar?token=" . $this->token . "'>Reestablecer Contraseña</a></p>";

        $contenido .= "<p>Si tu no solicitaste este cambio, ignora este mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        // Enviar el Email
        $mail->send();
}
}