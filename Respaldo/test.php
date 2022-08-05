<?php

 // Impotar algunas clases de phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Cargar phpmailer via composer
require 'vendor/autoload.php';


$mail = new PHPMailer(true);
try {
    //Si el correo no te llega, quita el comentario
    //de la linea de abajo, para mas información
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'mail.grupodaxi.site';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'crm@grupodaxi.site';
    $mail->Password   = 'r.(A6y_95lzL';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    //Destinatarios
    $mail->setFrom('crm@grupodaxi.site', 'CRM Grupo Daxi');
    $mail->AddAddress('isc.alejandrozac@gmail.com');
    
    // Contenido
    $mail->isHTML(true);                          
    $mail->Subject = 'Leads de Grupodaxi.com';

    $mail->Body = '<p>123</p>';



    $mail->AltBody = 'Version en texto plano del correo (No HTML, no formato)';
    $mail->send();
    echo 'El correo fue enviado';
} catch (Exception $e) {
    echo "Ocurrio un error: {$mail->ErrorInfo}";
}



