<?php $title = 'Ajout Centre'; ?>
<?php ob_start(); ?>

<?php
$username = $email = "";
$adresse = "";
$nom = "";
$numBoitier = "";
$errors = "";
addCentreM();
?>

<body>
    <div id="conteneurAddMed">
        <div id="itemMed">
            <div id="itemMed2">
                <h1 id="ajoutBoitier">
                    Ajouter un centre :
                </h1>
                <hr class="trait3">
                <br>
                <br>
                <form method="post" action="index.php?action=ajoutCentre">
                    <div class="input-group" style="color: white">
                        <input type="text" name="nom" required minlength="1">*
                        <span data-placeholder="Nom"></span>
                    </div>
                    <div class="input-group" style="color: white">
                        <input type="text" name="enseigne" required minlength="1">*
                        <span data-placeholder="Enseigne"></span>
                    </div>

                    <div class="input-group" style="color: white">
                        <label><b>Numéro de rue</b> </label>
                        <input type="text" name="numeroRue" required minlength="1" placeholder="15">*
                    </div>
                    <div class="input-group" style="color: white">
                        <label><b>Rue</b> </label>
                        <input type="text" name="rue" required minlength="1" placeholder="Rue Saint Martin">*
                    </div>

                    <div class="input-group" style="color: white">
                        <label><b>Ville</b> </label>
                        <input type="text" name="ville" required minlength="1" placeholder="Tours">*
                    </div>
                    <div class="input-group" style="color: white">
                        <label><b>code postal</b> </label>
                        <input type="text" name="codeP" required minlength="1" placeholder="37000">*
                    </div>
                    <div class="input-group" style="color: white">
                        <label><b>Region</b> </label>
                        <input type="text" name="region" required minlength="1" placeholder="Centre">*
                    </div>
                    <?php echo $errors; ?>

                    <div class="input-group">
                        <br>
                        <button id="erreur_boutong" type="submit" class="btn" name="enregistrerMed">Enregistrer le centre</button>
                    </div>

                </form>
                <br>
                <br>
                <div id="boxCentre1">
                    <a href="index.php?action=admin" id="erreur_boutonr">Retour</a>
                </div>
            </div>
        </div>

    </div>
    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>