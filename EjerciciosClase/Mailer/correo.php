<?php
// Incluir los archivos de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar Composer si lo estás utilizando
require 'vendor/autoload.php';

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->SMTPDebug = 0;                                       // Desactivar la depuración para no mostrar mensajes en pantalla
    $mail->isSMTP();                                            // Usar SMTP
    $mail->Host = 'smtp.gmail.com';                       // Servidor SMTP de Gmail
    $mail->SMTPAuth = true;                                   // Habilitar autenticación SMTP
    $mail->Username = 'tu_email@gmail.com';                   // Cambia por tu dirección de correo electrónico de Gmail
    $mail->Password = 'tu_contraseña';                        // Cambia por la contraseña de tu correo o una contraseña de aplicaciones
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Habilitar encriptación TLS
    $mail->Port = 587;                                    // Puerto de Gmail para TLS

    // Configuración del remitente y destinatarios
    $mail->setFrom('tu_email@gmail.com', 'Tu Nombre');          // Dirección del remitente (tu correo y nombre)
    $mail->addAddress('destinatario@ejemplo.com', 'Nombre Destinatario');  // Dirección del destinatario

    // Contenido del correo
    $mail->isHTML(true);                                        // Definir que el correo será en formato HTML
    $mail->Subject = 'Asunto del correo';                       // Asunto del correo
    $mail->Body = 'Este es el <b>contenido HTML</b> del correo';   // Contenido del correo en HTML
    $mail->AltBody = 'Este es el contenido en texto plano';     // Contenido en texto plano

    // Enviar el correo
    $mail->send();
    echo 'El mensaje ha sido enviado correctamente';
} catch (Exception $e) {
    echo "El mensaje no se pudo enviar. Error de PHPMailer: {$mail->ErrorInfo}";
}
?>