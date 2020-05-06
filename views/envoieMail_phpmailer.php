<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);

$mail->setLanguage('fr', '../PHPMailer/language/');

try {
    //Server settings

    $mail->SMTPDebug = 4; // Niveau de debug
    $mail->isSMTP(); // Utiliser SMTP
    $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'infinitemeasures.society@gmail.com'; // SMTP username
    $mail->Password = '1@Razertyuiop'; // SMTP password
    $mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 465; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //En-tete
    $mail->setFrom('nouveaumail@mail.com', 'Envoyeur'); //Envoyeur
    $mail->addAddress('infinitemeasures.society@gmail.com', 'Receveur'); // Receveur
    $mail->addReplyTo('info@example.com', 'Information'); //Répondre à

    // Contenue
    $mail->isHTML(true); // Format HTML
    $mail->Subject = 'Encore un autre test'; //Objet
    $mail->Body = 'le texte est <b>en gras</b>'; //Texte
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; //Texte si non HTML

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
