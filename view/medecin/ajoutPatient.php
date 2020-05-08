<?php $title = 'Medecin'; ?>
<?php ob_start(); ?>

<?php


$nom = "";
$prenom = "";
$adresse = "";
$numeroSS = "";
$email = "";
$password_1 = "";
$password_2 = "";
$errors = "";

?>


<div id="conteneurAddMed">
    <div id="itemMed">
        <h1 id="pageadmin_titre1">Ajout d'un patient : </h1>
        <hr class="trait3">
        <br>
        <div id="itemMed4">
            <div id="itemMed2">
                <h1 id="ajoutBoitier">
                    Nouveau patient :
                </h1>
                <br>
                <br>
                <form method="post" action="index.php?action=ajoutPatient">
                    <div class="groupe_medecin">
                        <label>Prénom</label>
                        <input type="text" name="prenom" required minlength="1" value="<?php echo $prenom; ?>">
                    </div>

                    <div class="groupe_medecin">
                        <label>Nom</label>
                        <input type="text" name="nom" required minlength="1" value="<?php echo $nom; ?>">
                    </div>

                    <div class="groupe_medecin">
                        <label>Adresse</label>
                        <input type="text" name="adresse" required minlength="1" value="<?php echo $adresse; ?>">
                    </div>

                    <div class="groupe_medecin">
                        <label>Numéro de Sécurité Sociale</label>
                        <input type="text" name="numeroSS" required minlength="1" value="<?php echo $numeroSS; ?>">
                    </div>

                    <div class="groupe_medecin">
                        <label>Email</label>
                        <input type="email" required minlength="1" name="email" value="<?php echo $email; ?>">
                    </div>

                    <div class="groupe_medecin">
                        <label>Mot de passe</label>
                        <input type="password" required minlength="1" name="password_1">
                    </div>

                    <div class="groupe_medecin">
                        <label>Confirmer Mot de passe</label>
                        <input type="password" required minlength="1" name="password_2">
                    </div>
                    <?php echo $errors; ?>
                    <br>
                    <br>
                    <div class="input-group">
                        <center> <button id="erreur_boutong" type="submit" class="btn" name="enregistrerMed">Enregistrer le patient</button>
                        </center>
                    </div>
                </form>
            </div>
            <hr class="trait6">
            <div id="itemMed3">
                <h1 id="ajoutBoitier">
                    Autre(s) patient(s) du centre :
                </h1>
                <br><br>
                <?php
                foreach ($listePatients as $patient){ ?>
                <a href="index.php?action=ajoutPatient&idP=<?php echo $patient["idPatient"]; ?>&idM=<?php echo $patient["idMedecin"]; ?>" style="text-decoration:none;color:black;font-weight:bold;" name=<?php $patient["idUtilisateur"]; ?>><?php echo "", $patient["prenom"], " ", $patient["nom"], " (", $patient["adresse"], ")"; ?></a>
                <br><br><?php } ?>
            </div>
        </div>
        <br>
        <br>
        <div id="boxCentre1">
            <a href="index.php?action=medecin" id="erreur_boutonr">Retour</a>
        </div>
        <br>
        <br>
    </div>
</div>
<script type="text/javascript" src="public/js/login.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
