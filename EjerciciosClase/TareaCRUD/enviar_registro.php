<?php
require 'vendor/autoload.php';
include 'db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    $producto = obtenerProductoPorCodigo($codigo); // Suponiendo que esta función está en db.php

    if ($producto) {
        $mail = new PHPMailer(true);
        try {
            // Configuración SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tucorreo@gmail.com';
            $mail->Password = 'tucontraseña';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Configuración del correo
            $mail->setFrom('tucorreo@gmail.com', 'Nombre');
            $mail->addAddress('destinatario@gmail.com');
            $mail->isHTML(true);
            $mail->Subject = 'Detalles del Producto';

            // Cuerpo del mensaje
            $mail->Body = "<h2>Detalles del Producto</h2>
                           <p><strong>Código:</strong> {$producto['CODIGOARTICULO']}</p>
                           <p><strong>Nombre:</strong> {$producto['NOMBREARTICULO']}</p>
                           <p><strong>Sección:</strong> {$producto['SECCION']}</p>
                           <p><strong>Precio:</strong> {$producto['PRECIO']}</p>
                           <p><strong>Fecha:</strong> {$producto['FECHA']}</p>
                           <p><strong>Importado:</strong> {$producto['IMPORTADO']}</p>
                           <p><strong>País de Origen:</strong> {$producto['PAISDEORIGEN']}</p>";

            $mail->send();
            echo 'Email enviado exitosamente';
        } catch (Exception $e) {
            echo "Error al enviar email: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Producto no encontrado';
    }
}
?>