
<?php $title = 'Supprimer un centre'; ?>
<?php ob_start(); ?>

<?php

$nom = $prenom = $adresse = $numeroSecu = "OUI";
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "appinfo";
$bdd = new mysqli($db_host, $db_user, $db_pass, $db_name);
$idCentre = $_GET["idC"];
$boitierQ = $bdd->query("SELECT * FROM centremedical WHERE numero=$idCentre");
$centre = $boitierQ->fetch_array();








?>


    <div id="conteneurMainAdmin">
        <div id="conteneur1Admin">
            <div id="conteneurCentreAdmin">
                <p style="width:70%;margin:auto;margin-top:2%;margin-bottom:2%;color:white">Êtes-vous sur de vouloir supprimer le centre <?php echo $centre['nom'] ?> ?</p>
                <a id="erreur_bouton" style="width:30%;margin:auto;" href="index.php?action=delCentre&id=<?php echo $idCentre; ?>">Oui</a>
                <br>
                <br>
                <br>
                <a id="erreur_boutonr" style="width:30%;margin:auto;" href="index.php?action=centre&id=<?php echo $idCentre; ?>">Annuler</a>
            </div>
        </div>
    </div>


    <?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
