<?php
session_start();
require 'vendor/autoload.php';
include 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verifica si el formulario ha sido enviado y contiene código y tabla
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['codigo']) && isset($_POST['tabla'])) {
    $codigo = $_POST['codigo'];
    $tabla = $_POST['tabla'];

    // Carga el registro de productos o libros según la tabla
    if ($tabla == 'productos') {
        $registro = obtenerProductoPorCodigo($codigo);
    } elseif ($tabla == 'libros') {
        $registro = obtenerLibroPorId($codigo);
    } else {
        $_SESSION['mensaje'] = 'Tabla inválida.';
        header("Location: index.php");
        exit();
    }

    // Envía un correo si el registro existe
    if ($registro) {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'fvsalapic@gmail.com';
            $mail->Password = 'agrt jeiv ogru yrch';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('fvsalapic@gmail.com', 'Francisco Salapic');
            $mail->addAddress('fvsalapic@outlook.com');
            $mail->isHTML(true);
            $mail->Subject = 'Detalles del Registro';

            // Contenido del mensaje con detalles del registro
            $contenido = "<h2>Detalles del Registro</h2>";
            foreach ($registro as $campo => $valor) {
                $contenido .= "<p><strong>" . htmlspecialchars($campo) . ":</strong> " . htmlspecialchars($valor) . "</p>";
            }
            $mail->Body = $contenido;

            // Envía el correo y establece el mensaje de sesión según el resultado
            if ($mail->send()) {
                $_SESSION['mensaje'] = 'Email con los detalles del registro enviado exitosamente.';
            } else {
                $_SESSION['mensaje'] = 'Error al enviar el email con los detalles del registro.';
            }
        } catch (Exception $e) {
            $_SESSION['mensaje'] = "Error al enviar email: {$mail->ErrorInfo}";
        }
    } else {
        $_SESSION['mensaje'] = 'Registro no encontrado.';
    }
} else {
    $_SESSION['mensaje'] = 'Solicitud inválida.';
}

// Redirige a index.php con el mensaje en sesión
header("Location: index.php");
exit();
