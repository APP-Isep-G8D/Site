<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/*
Exemple de requêtes
function getPosts()
{
    $db = dbConnect();
    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

    return $req;
}

function getPost($postId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
}

function getComments($postId)
{
    $db = dbConnect();
    $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
    $comments->execute(array($postId));

    return $comments;
}

function postComment($postId, $author, $comment)
{
    $db = dbConnect();
    $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
    $affectedLines = $comments->execute(array($postId, $author, $comment));

    return $affectedLines;
}


*/

function loginM()
{
    try {
        $bdd = dbConnect();

        $mail = $mdp = " ";
        $mailErr = $mdpErr = " ";
        $resultat = " ";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //Test de l'entrée de l'email
            if (empty($_POST["email"])) {
                $mailErr = "Une adresse mail est demandée";
            } else {
                $mail = htmlspecialchars($_POST["email"]);
                if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $mailErr = "Mauvais format d'adresse mail";
                }
            }

            //Test de l'entrée du mdp
            if (empty($_POST["motdepasse"])) {
                $mdpErr = "Un mot de passe est demandée";
            } else {
                $mdp = trim($_POST["motdepasse"]);
                $mdp = stripslashes($_POST["motdepasse"]);
                $mdp = htmlspecialchars($_POST["motdepasse"]);
            }

            $query = 'SELECT * FROM utilisateur WHERE mail = ?';
            $req = $bdd->prepare($query);
            $req->bind_param('s', $_POST["email"]);
            $req->execute();
            $result = $req->get_result();
            $user = $result->fetch_object();
            if (isset($user)) {
                if ($_POST['motdepasse'] == $user->motdepasse) {
                    $_SESSION['idUtilisateur'] = $user->idUtilisateur;
                    $resultat = "Connexion réussie";
                    header("Location: index.php?action=redirect");
                } else {
                    $resultat = "email ou mot de passe incorect";
                }
            } else {
                $resultat = "email ou mot de passe incorect";
            }
        }
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    return $resultat;
}



function profilRedirect()
{
    if (isset($_SESSION['idUtilisateur'])) {
        $bdd = dbConnect();
        $user = userFromSession($bdd);
        if ($user->role == "administrateur") {
            header("Location: index.php?action=admin");
        } elseif ($user->role == "medecin") {
            header("Location: index.php?action=medecin");
        } else {
            header("Location: index.php?action=patient");
        }
    } else {
        // Redirect them to the login page
        header("Location: index.php?action=login");
    }
}


function logoutUser()
{
    //logout.php  
    session_start();
    session_destroy();
    header("location:main.php");
}


function envoyerMail($objet, $message, $envoyeur)
{
    require 'public/PHPMailer/src/Exception.php';
    require 'public/PHPMailer/src/PHPMailer.php';
    require 'public/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);
    $mail->setLanguage('fr', 'public/PHPMailer/language/');
    try {
        //Server settings

        $mail->SMTPDebug = 0; // Niveau de debug
        $mail->isSMTP(); // Utiliser SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'bernardtapiisep@gmail.com'; // SMTP username
        $mail->Password = 'aze123rty'; // SMTP password
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
        header("Location: index.php?action=patienter");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function MenuConnected()
{
    if (isset($_SESSION['idUtilisateur'])) {
        $loginMsg = "Mon profil";
        $header = "header2";
        $profilconnecte = "Se déconnecter";
        return array($loginMsg, $profilconnecte, $header);
    } else {
        // Redirect them to the login page
        $loginMsg = "Se connecter";
        $profilconnecte = "";
        $header = "header3";
        return array($loginMsg, $profilconnecte, $header);
    }
}


function dbConnect()
{
    try {
        $db_host = "localhost";
        $db_user = "root";
        $db_pass = "root";
        $db_name = "appinfo";
        $bdd = new mysqli($db_host, $db_user, $db_pass, $db_name);
        return $bdd;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function  userFromSession($bdd)
{
    $bdd = dbConnect();
    $value = $bdd->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = ?");
    $value->bind_param('s', $_SESSION['idUtilisateur']);





    //$value->execute();
    $result = $value->get_result();
    $user = $result->fetch_object();
    return $user;
}

function isConnected()
{
    if (isset($_SESSION['idUtilisateur'])) {
        return true;
    } else {
        return false;
    }
}
