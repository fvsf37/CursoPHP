<?php
// Importamos las clases PHPMailer en el espacio de nombres global
// Estas importaciones deben estar en la parte superior del script, no dentro de funciones
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Cargamos el autoloader de Composer
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Creamos una instancia de PHPMailer; pasando `true` habilitamos excepciones
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->SMTPDebug = 0;                      // Desactivamos la salida de depuración en producción
    $mail->isSMTP();                           // Usar SMTP para enviar
    $mail->Host = 'smtp.gmail.com';            // Definimos el servidor SMTP de Gmail
    $mail->SMTPAuth = true;                    // Habilitamos la autenticación SMTP
    $mail->Username = 'remitente@gmail.com';        // Usuario SMTP
    $mail->Password = 'wnck vepq ubmm evqc';   // Contraseña de la aplicación de Gmail
    $mail->SMTPSecure = 'ssl';                 // Habilitamos la encriptación SSL
    $mail->Port = 465;                         // Puerto TCP para conectarse, usa 587 si utilizas STARTTLS

    // Validación de la dirección de email del remitente
    if (!filter_var($mail->Username, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('La dirección de email del remitente no es válida.');
    }

    // Dirección de destino
    $destinatario = 'destinatario@gmail.com';
    // Validación de la dirección de email del destinatario
    if (!filter_var($destinatario, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('La dirección de email del destinatario no es válida.');
    }

    $mail->setFrom('remitente@gmail.com', 'Cesur-Gmail');  // Remitente del correo
    $mail->addAddress($destinatario, 'VMNC-Gmail');        // Añadimos destinatario

    // Archivos adjuntos
    $mail->addAttachment('C:/xampp/htdocs/cursoPHP/enviarEmail/adjuntarArchivosEnviarEmail/PracticaCookieLogin.pdf'); // Adjuntamos un archivo

    // Contenido del email
    $mail->isHTML(true);                           // Configuramos el formato del correo como HTML
    $mail->Subject = 'ASUNTO TEST';                // Asunto del correo

    // Leemos el contenido HTML desde un archivo
    $file = fopen("bodyenviarEmail.html", "r");
    $str = fread($file, filesize("bodyenviarEmail.html"));
    $str = trim($str);
    fclose($file);

    $mail->Body = $str;                            // Cuerpo del correo en HTML

    // Intentamos enviar el correo
    $mail->send();
    echo 'EMAIL ENVIADO CORRECTAMENTE';            // Mensaje en caso de éxito

} catch (Exception $e) {
    // Manejo mejorado de excepciones y registro de errores en un archivo log
    error_log("ERROR AL ENVIAR EMAIL: {$mail->ErrorInfo}", 3, '/var/log/phpmailer_errors.log');  // Guardamos el error en un archivo de log
    echo 'Hubo un error al enviar el correo. Por favor, revisa los registros para más detalles.';  // Mensaje para el usuario
}
?>