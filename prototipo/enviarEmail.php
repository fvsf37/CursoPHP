<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'pgavilansanc@gmail.com';                     //SMTP username
    $mail->Password   = 'tquv xgec yrob anhs';     //SMTP password DE LA CONTRASEÑA DE APLICACION. AL ESTAR HABILITADO SEGURIDAD 2 PASOS EN GMAIL


    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('pgavilansanc@gmail.com');
    $mail->addAddress('pgavilansanc@gmail.com');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    //$mail->addAttachment('C:\xampp\htdocs\cursoPHP\enviarEmail\adjuntarArchivosEnviarEmail/PracticaCookieLogin.pdf'); //TUVE PONER RUTA COMPLETA PARA QUE FUNCIONARA

    $mail->isHTML(true);

    if (isset($_GET["default"]) && $_GET["default"] == "true") {
        $mail->Subject = 'ASUNTO TEST';

        $file = fopen("bodyenviarEmail.html", "r");
        $str = fread($file, filesize("bodyenviarEmail.html"));
        $str = trim($str);
        fclose($file);

        $mail->Body = $str;

        $mail->addAttachment("./img/empty.jpg");

        $mail->send();

        header("Location:main-page.php?defaultEmail=sent");
    } else if (isset($_GET["default"]) && $_GET["default"] == "false") {
        $mail->Subject = $_POST["mailSubject"];
        $mail->Body = $_POST["mailContent"];

        $mail->addAttachment($_FILES["mailAttach"]["tmp_name"], $_FILES["mailAttach"]["name"]);

        $mail->send();

        header("Location:main-page.php?customEmail=sent");
    } else {
        header("Location:main-page.php?mail=failed");
    }

} catch (Exception $e) {
    echo "ERROR AL ENVIAR EMAIL: {$mail->ErrorInfo}";
}
