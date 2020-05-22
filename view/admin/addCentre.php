<?php $title = 'Ajout Centre'; ?>
<?php ob_start(); ?>

<?php
$username = $email = "";
$adresse = "";
$nom = "";
$numBoitier = "";
$errors="";
addCentreM();
?>

<body>
    <div id="conteneurAddMed">
        <div id="formBox">
            <div id="itemMed2">
                <h1 id="ajoutBoitier">
                    Ajouter un centre :
                </h1>
                <hr class="trait3">
                <br>
                <br>
                <form method="post" action="index.php?action=ajoutCentre">

                    <div class="groupe_medecin">
                        <input type="text" name="nom" required minlength="1">
                        <span data-placeholder="Nom"></span>
                    </div>

                    <div class="groupe_medecin">
                        <input type="text" name="enseigne" required minlength="1">
                        <span data-placeholder="Enseigne"></span>
                    </div>

                    <div class="groupe_medecin">
                        <input type="text" name="numeroRue" required minlength="1">
                        <span data-placeholder="Numéro de rue"></span>
                    </div>

                    <div class="groupe_medecin">
                        <input type="text" name="rue" required minlength="1">
                        <span data-placeholder="Rue"></span>
                    </div>

                    <div class="groupe_medecin">
                        <input type="text" name="ville" required minlength="1">
                        <span data-placeholder="Ville"></span>
                    </div>

                    <div class="groupe_medecin">
                        <input type="text" name="codeP" required minlength="1">
                        <span data-placeholder="Code postal"></span>
                    </div>

                    <div class="groupe_medecin">
                        <input type="text" name="region" required minlength="1">
                        <span data-placeholder="Région"></span>
                    </div>

                    <?php echo $errors; ?>

                    <div class="input-group">
                        <button id="erreur_boutong" type="submit" class="btn" name="enregistrerMed">Enregistrer le centre</button>
                    </div>
                    <br>
                
                    <div id="boxCentre1">
                        <a href="index.php?action=admin" id="erreur_boutonr">Retour</a>
                    </div>
                    <br>   
                     
                </form>
               
                
            </div>
        </div>

    </div>

    <script type="text/javascript" src="public/js/form.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
