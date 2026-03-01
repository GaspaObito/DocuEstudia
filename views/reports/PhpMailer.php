<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();


$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['GMAIL_USER']; 
    $mail->Password = $_ENV['GMAIL_PASS'];
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('gaspa.obito2003@gmail.com', 'DocuEstudia');
    $mail->addAddress('jose-madara2003@hotmail.com'); // correo del estudiante
+
    $mail->isHTML(true);
    $mail->Subject = 'Notas actualizadas';
    $mail->Body    = 'Estimado estudiante, sus notas han sido actualizadas en el sistema.';

    $mail->send();
    echo "Correo enviado correctamente";
} catch (Exception $e) {
    echo "Error al enviar: {$mail->ErrorInfo}";
}

?>