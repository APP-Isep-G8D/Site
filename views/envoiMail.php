<?php
include_once('envoieMail_phpmailer.php');
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Envoyer un Mail</title>
    <link rel="stylesheet" href="style.css">
    <!--<script src="script.js"></script>-->
</head>

<body>
    <?php require_once "menu.php"; ?>
    <div id="titre">
        Contact par Mail
    </div>
    <hr class="trait2">
    <br>
    <br>
    <form method="post">
        <div class="groupe_mail">
            <label>Prénom-Nom</label>
            <input type="text" name="nom" required>
        </div>
        <div class="groupe_mail">
            <label>Votre Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="groupe_mail">
            <label>Objet du Mail</label>
            <input type="text" name="objet" required>
        </div>
        <div class="groupe_mail">
            <label>Message</label>
            <textarea name="message" style="width:30em; height:10em" required></textarea>
        </div>
        <div>
            <br>
            <button id="erreur_boutonv" type="submit" name="envoyerMail">Envoyer le mail</button>
        </div>
    </form>
    <br>
    <br>
    <?php
    if (isset($_POST['message'])) {
        $message = '<h1>Message envoyé depuis la page Contact de infinitemeasures.fr</h1>
        <p><b>Nom : </b>' . $_POST['nom'] . '<br>
        <b>Email : </b>' . $_POST['email'] . '<br>
        <b>Message : </b>' . $_POST['message'] . '</p>';

        envoyerMail($_POST['objet'], $message, $_POST['email']);
    }
    ?>

    <?php require_once "footer.php"; ?>
</body>

</html>