<?php
session_start();
require 'vendor/autoload.php';
include 'db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    $producto = obtenerProductoPorCodigo($codigo); // Suponiendo que esta función está en db.php

    if ($producto) {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tucorreo@gmail.com'; // Cambia esto a tu correo
            $mail->Password = 'tucontraseña'; // Cambia esto a tu contraseña
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('tucorreo@gmail.com', 'Nombre');
            $mail->addAddress('destinatario@gmail.com'); // Cambia esto al correo del destinatario
            $mail->isHTML(true);
            $mail->Subject = 'Detalles del Producto';

            // Contenido del mensaje con detalles del producto
            $mail->Body = "<h2>Detalles del Producto</h2>
                           <p><strong>Código:</strong> {$producto['CODIGOARTICULO']}</p>
                           <p><strong>Nombre:</strong> {$producto['NOMBREARTICULO']}</p>
                           <p><strong>Sección:</strong> {$producto['SECCION']}</p>
                           <p><strong>Precio:</strong> {$producto['PRECIO']}</p>
                           <p><strong>Fecha:</strong> {$producto['FECHA']}</p>
                           <p><strong>Importado:</strong> {$producto['IMPORTADO']}</p>
                           <p><strong>País de Origen:</strong> {$producto['PAISDEORIGEN']}</p>";

            // Enviar el correo
            if ($mail->send()) {
                $_SESSION['mensaje'] = 'Email con los detalles del producto enviado exitosamente.';
            } else {
                $_SESSION['mensaje'] = 'Error al enviar el email con los detalles del producto.';
            }
        } catch (Exception $e) {
            $_SESSION['mensaje'] = "Error al enviar email: {$mail->ErrorInfo}";
        }
    } else {
        $_SESSION['mensaje'] = 'Producto no encontrado.';
    }
} else {
    $_SESSION['mensaje'] = 'Solicitud inválida.';
}

// Redirige de vuelta a index.php con el mensaje en sesión
header("Location: index.php");
exit();
