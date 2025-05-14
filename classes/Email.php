<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email {

    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        $mail = $this->configurarMailer();
        $mail->Subject = 'Confirma tu Cuenta en La 57 CAP';

        $url = "http://localhost:3000/confirmar-cuenta?token={$this->token}";
        $contenido = $this->renderTemplate('confirmacion-cuenta', [
            'nombre' => $this->nombre,
            'url' => $url
        ]);

        $mail->Body = $contenido;
        // $mail->send();
    }

    public function enviarInstrucciones() {
        $mail = $this->configurarMailer();
        $mail->Subject = 'Reestablece tu contraseña en La 57 CAP';

        $url = "http://localhost:3000/recuperar-cuenta?token={$this->token}";
        $contenido = $this->renderTemplate('recuperar-cuenta', [
            'nombre' => $this->nombre,
            'url' => $url
        ]);

        $mail->Body = $contenido;
        // $mail->send();
    }

    // 🔒 Configuración común de PHPMailer
    private function configurarMailer(): PHPMailer {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'ca48939a5fe421';
        $mail->Password = 'd2888cccbe0023';
        $mail->Port = 2525;

        $mail->setFrom('cuentas@la57cap.com', 'LA 57 CAP');
        $mail->addAddress($this->email, $this->nombre);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        return $mail;
    }

    // 📩 Renderizar templates HTML con variables
    private function renderTemplate($nombreArchivo, $variables): string {
        extract($variables); // convierte ['nombre' => 'Nahomi'] en $nombre = 'Nahomi'

        ob_start();
        include __DIR__ . "/../views/emails/{$nombreArchivo}.php";
        return ob_get_clean();
    }
}
