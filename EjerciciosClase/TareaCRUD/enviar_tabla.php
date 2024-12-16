<?php
require 'vendor/autoload.php';
include 'db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productos = obtenerProductos(); // Asumiendo que esta función devuelve todos los productos

    if ($productos) {
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
            $mail->Subject = 'Tabla de Productos Completa';

            // Cuerpo del mensaje
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

            $mail->send();
            echo 'Email con la tabla completa enviado exitosamente';
        } catch (Exception $e) {
            echo "Error al enviar email: {$mail->ErrorInfo}";
        }
    } else {
        echo 'No hay productos disponibles para enviar';
    }
}
?>