<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
include 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    // Obtiene los productos de la base de datos
    $productos = obtenerProductos();

    // Verifica si hay productos para enviar en el correo
    if (mysqli_num_rows($productos) > 0) {
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

        // Genera el contenido de la tabla de productos en el correo
        $emailContent = "<h2>Tabla Completa de Productos</h2><table border='1'>
                        <tr>
                          <th>Código</th>
                          <th>Nombre</th>
                          <th>Sección</th>
                          <th>Precio</th>
                          <th>Fecha</th>
                          <th>Importado</th>
                          <th>País de Origen</th>
                        </tr>";

        // Añade cada producto a la tabla
        while ($producto = mysqli_fetch_assoc($productos)) {
            $emailContent .= "<tr>
                              <td>{$producto['CODIGOARTICULO']}</td>
                              <td>{$producto['NOMBREARTICULO']}</td>
                              <td>{$producto['SECCION']}</td>
                              <td>{$producto['PRECIO']}</td>
                              <td>{$producto['FECHA']}</td>
                              <td>{$producto['IMPORTADO']}</td>
                              <td>{$producto['PAISDEORIGEN']}</td>
                            </tr>";
        }
        $emailContent .= "</table>";

        $mail->Body = $emailContent;

        // Intenta enviar el correo
        if ($mail->send()) {
            $_SESSION['mensaje'] = 'Email con la tabla completa enviado exitosamente.';
        } else {
            $_SESSION['mensaje'] = 'Error al enviar el email con la tabla completa.';
        }
    } else {
        $_SESSION['mensaje'] = 'No hay productos disponibles para enviar.';
    }
} catch (Exception $e) {
    $_SESSION['mensaje'] = "Error al enviar email: {$mail->ErrorInfo}";
}

// Redirige a index.php con el mensaje en sesión
header("Location: index.php");
exit();
