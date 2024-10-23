<?php
// Incluir los archivos de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar Composer si lo estás utilizando
require 'vendor/autoload.php';

// ---------- Variables personalizables ---------- //

// Datos del servidor SMTP
$smtpHost = 'smtp.gmail.com';       // Servidor SMTP (ej: smtp.gmail.com para Gmail)
$smtpPort = 587;                    // Puerto (ej: 587 para TLS)
$smtpUsername = 'tu_email@gmail.com'; // Tu correo electrónico
$smtpPassword = 'tu_contraseña';    // Tu contraseña o contraseña de aplicaciones

// Configuración de correo (remitente y destinatario)
$fromEmail = 'tu_email@gmail.com';  // Correo del remitente
$fromName = 'Tu Nombre';            // Nombre del remitente
$toEmail = 'destinatario@ejemplo.com';  // Correo del destinatario
$toName = 'Nombre Destinatario';    // Nombre del destinatario

// Contenido del correo
$emailSubject = 'Asunto del correo';  // Asunto del correo
$emailBodyHtml = 'Este es el <b>contenido HTML</b> del correo';  // Cuerpo en HTML
$emailBodyText = 'Este es el contenido en texto plano'; // Cuerpo en texto plano (por si el destinatario no soporta HTML)


try {
    // Crear una instancia de PHPMailer
    $mail = new PHPMailer(true);

    // Configuración del servidor SMTP
    $mail->SMTPDebug = 0;                                       // Desactivar la depuración para no mostrar mensajes en pantalla
    $mail->isSMTP();                                            // Usar SMTP
    $mail->Host = $smtpHost;                              // Servidor SMTP
    $mail->SMTPAuth = true;                                   // Habilitar autenticación SMTP
    $mail->Username = $smtpUsername;                          // Correo electrónico del remitente
    $mail->Password = $smtpPassword;                          // Contraseña del correo
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Habilitar encriptación TLS
    $mail->Port = $smtpPort;                              // Puerto SMTP

    // Configuración del remitente y destinatario
    $mail->setFrom($fromEmail, $fromName);                      // Dirección y nombre del remitente
    $mail->addAddress($toEmail, $toName);                       // Dirección y nombre del destinatario

    // Contenido del correo
    $mail->isHTML(true);                                        // Definir que el correo será en formato HTML
    $mail->Subject = $emailSubject;                             // Asunto del correo
    $mail->Body = $emailBodyHtml;                            // Contenido en HTML
    $mail->AltBody = $emailBodyText;                            // Contenido en texto plano

    // Enviar el correo
    $mail->send();
    echo 'El mensaje ha sido enviado correctamente';
} catch (Exception $e) {
    echo "El mensaje no se pudo enviar. Error de PHPMailer: {$mail->ErrorInfo}";
}
?>