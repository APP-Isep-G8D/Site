<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

function envoyerMail($objet, $message, $envoyeur)
{
    $mail = new PHPMailer(true);
    $mail->setLanguage('fr', '../PHPMailer/language/');
    try {
        //Server settings

        $mail->SMTPDebug = 0; // Niveau de debug
        $mail->isSMTP(); // Utiliser SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'infinitemeasures.society@gmail.com'; // SMTP username
        $mail->Password = '1@Razertyuiop'; // SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 465; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //En-tete
        $mail->setFrom($envoyeur, 'Envoyeur'); //Envoyeur
        $mail->addAddress('infinitemeasures.society@gmail.com', 'Receveur'); // Receveur
        $mail->addReplyTo($envoyeur, 'Information'); //Répondre à

        // Contenue
        $mail->isHTML(true); // Format HTML
        $mail->Subject = $objet; //Objet
        $mail->Body = $message; //Texte
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; //Texte si non HTML

        $mail->send();
        echo '<p style="color: Green">Votre message a bien été envoyé.</p>';
        header("Location: patienter.php");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
