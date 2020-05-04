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
    ?>

    <div class="mailEnvoye"> <br>
        <div id="mailPatiente">
            <img src="mailEnvoye.png" style="width: 400px; height: 200px;" class="patienter_image">
        </div>
        <br>
        <br>
        <div id="erreur"> Le Mail a été envoyé </div>
        <hr class="trait2">
        <br>
        <br>
        <p style="color: #a51a4f; font-size: large">Vous allez être redirigé dans <span id="compteur">5</span> <span id="secondes">secondes</span>.</p>
        <script type="text/javascript">
            function decompte() {
                var i = document.getElementById('compteur');
                let seconde = document.getElementById('secondes');
                if (parseInt(i.innerHTML) <= 0) {
                    location.href = 'main.php';
                    i.innerHTML = parseInt(i.innerHTML) + 1;
                }
                i.innerHTML = parseInt(i.innerHTML) - 1;
                if (parseInt(i.innerHTML) <= 1) {
                    seconde.innerHTML = 'seconde';
                }
            }
            setInterval(function() {
                decompte();
            }, 1000);
        </script>
        <br>
        <div><a class="erreur_boutonv" id="erreur_boutonv" href="main.php" .html> <b>Revenir à l'Accueil</b></a></div>
        <br>
        <br>
    </div>

    <?php require_once "footer.php"; ?>
</body>

</html>