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
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="groupe_mail">
            <label>Message</label>
            <textarea name="message" required></textarea>
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
        $entete  = 'MIME-Version: 1.0' . "\r\n";
        $entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $entete .= 'From: ' . $_POST['email'] . "\r\n";

        $message = '<h1>Message envoyé depuis la page Contact de infinitemeasures.fr</h1>
        <p><b>Nom : </b>' . $_POST['nom'] . '<br>
        <b>Email : </b>' . $_POST['email'] . '<br>
        <b>Message : </b>' . $_POST['message'] . '</p>';

        $retour = mail('infinitemeasures.society@gmail.com', 'Envoi depuis page Contact par Mail', $message, $entete);
        if ($retour) {
            echo '<p style="color: Green">Votre message a bien été envoyé.</p>';
            header("Location: patienter.php");
        }
    }
    ?>

    <?php require_once "footer.php"; ?>
</body>

</html>