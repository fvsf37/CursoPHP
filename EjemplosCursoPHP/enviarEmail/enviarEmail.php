<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username = 'cesurformacion2024@gmail.com';                     //SMTP username
    //$mail->Password   = 'slwc dtci owpw htxa';     //SMTP password DE LA CONTRASEÑA DE APLICACION. AL ESTAR HABILITADO SEGURIDAD 2 PASOS EN GMAIL
    $mail->Password = 'wnck vepq ubmm evqc';

    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('cesurformacion2024@gmail.com', 'Cesur-Gmail');
    $mail->addAddress('victormanuelnavarrocamino@gmail.com', 'VMNC-Gmail');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    $mail->addAttachment('C:\xampp\htdocs\cursoPHP\enviarEmail\adjuntarArchivosEnviarEmail/PracticaCookieLogin.pdf'); //TUVE PONER RUTA COMPLETA PARA QUE FUNCIONARA

    //TUVE QUE DESHABILITAR EL ANTIVIRUS PARA QUE FUNCIONARA

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'ASUNTO TEST';
    //------------------------------------------------------------------------

    //$mail->Body    = 'MENSAJE EJEMPLO ENVIADO DE <b>PRUEBA</b>'; //SI QUEREMOS PONER DIRECTAMENTE EL TEXTO DEL BODY
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    //----- PODEMOS PONER EL BODY LLAMANDO A UN HTML YA EXISTENTE: Ej bodyEnviarEmail.html
    $file = fopen("bodyenviarEmail.html", "r");
    $str = fread($file, filesize("bodyenviarEmail.html"));
    $str = trim($str);
    fclose($file);

    $mail->Body = $str;
    //-----------------------------------------------------------------------

    $mail->send();
    echo 'EMAIL ENVIADO CORRECTAMENTE';
} catch (Exception $e) {
    echo "ERROR AL ENVIAR EMAIL: {$mail->ErrorInfo}";
}

?>