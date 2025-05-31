<?php

namespace Classes;
require __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__ . '');
$dotenv->safeLoad();


class Email
{

    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        $mail = $this->configurarMailer();
        $mail->Subject = 'Confirma tu Cuenta en La 57 CAP';

        $url = $_ENV['FRONTEND_URL'] . "/confirmar-cuenta?token={$this->token}";
        $contenido = $this->renderTemplate('confirmacion-cuenta', [
            'nombre' => $this->nombre,
            'url' => $url
        ]);

        $mail->Body = $contenido;
        $mail->send();
    }

    public function enviarInstrucciones()
    {
        $mail = $this->configurarMailer();
        $mail->Subject = 'Reestablece tu contraseña en La 57 CAP';

        $url = $_ENV['FRONTEND_URL'] . "/recuperar-cuenta?token={$this->token}";
        $contenido = $this->renderTemplate('recuperar-cuenta', [
            'nombre' => $this->nombre,
            'url' => $url
        ]);

        $mail->Body = $contenido;
        $mail->send();
    }

    // 🔒 Configuración común de PHPMailer
    private function configurarMailer(): PHPMailer
    {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USER'];
        $mail->Password = $_ENV['MAIL_PASS'];
        $mail->Port = $_ENV['MAIL_PORT'];

        $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
        $mail->addAddress($this->email, $this->nombre);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        return $mail;
    }


    // 📩 Renderizar templates HTML con variables
    private function renderTemplate($nombreArchivo, $variables): string
    {
        extract($variables); // convierte ['nombre' => 'Nahomi'] en $nombre = 'Nahomi'

        ob_start();
        include __DIR__ . "/../views/emails/{$nombreArchivo}.php";
        return ob_get_clean();
    }
}
