<?php
// Variables del correo
$destinatario = "email@dominio.com";
$asunto = "Asunto del correo";
$mensaje = "Este es el cuerpo del mensaje.";
$cabeceras = "From: remitente@dominio.com" . "\r\n" .
    "Reply-To: remitente@dominio.com" . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

// Enviar correo
if (mail($destinatario, $asunto, $mensaje, $cabeceras)) {
    echo "Correo enviado exitosamente.";
} else {
    echo "Hubo un error al enviar el correo.";
}
?>