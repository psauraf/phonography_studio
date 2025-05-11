<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = strip_tags(trim($_POST["nombre"]));
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $asunto = strip_tags(trim($_POST["asunto"]));
  $mensaje = trim($_POST["mensaje"]);

  if (empty($nombre) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($asunto) || empty($mensaje)) {
    echo "<h3 style='color:red;text-align:center;margin-top:50px;'>Faltan datos o el email no es válido.</h3>";
    exit;
  }

  $mail = new PHPMailer(true);

  try {
    // Configuración SMTP Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'hello@phonographystudio.com'; // Tu email
    $mail->Password = 'bigp kilv erxe jxxp'; // Tu clave de aplicación generada
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Remitente y destinatario
    $mail->setFrom('hello@phonographystudio.com', 'Phonography Studio');
    $mail->addAddress('hello@phonographystudio.com');

    // Contenido
    $mail->isHTML(false);
    $mail->Subject = "Mensaje de contacto: $asunto";
    $mail->Body = "Nombre: $nombre\nEmail: $email\n\nMensaje:\n$mensaje";

    $mail->send();
    echo "<h3 style='color:green;text-align:center;margin-top:50px;'>Tu mensaje se ha enviado correctamente.</h3>";
  } catch (Exception $e) {
    echo "<h3 style='color:red;text-align:center;margin-top:50px;'>Error al enviar el mensaje. {$mail->ErrorInfo}</h3>";
  }
} else {
  http_response_code(403);
  echo "Acceso no permitido.";
}
