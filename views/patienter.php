<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Patienter</title>
    <link rel="stylesheet" href="style.css">
    <!--<script src="script.js"></script>-->


</head>

<body>
    <?php require_once "menu.php";
    header("Refresh: 4;URL=main.php");
    ?>

    <div class="mailEnvoye"> <br>
        <div id="mailPatiente">
            <img src="mailEnvoye.png" style="width: 400px; height: 200px;" class="patienter_image">
        </div>
        <br>
        <br>
        <br>
        <div id="erreur"> Le Mail a été envoyé </div>
        <br>
        <hr class="trait2">
        <br>
        <br>
        <p style="color: orange; font-size:medium">Vous allez être redirigé dans quelques secondes</p>
        <br>
        <div><a class="erreur_boutonv" id="erreur_boutonv" href="main.php" .html> <b>Revenir à l'Accueil</b></a></div>
        <br>
        <br>
    </div>

    <?php require_once "footer.php"; ?>
</body>

</html>