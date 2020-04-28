<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>IOTnov</title>
    <link rel="stylesheet" href="style.css">
    <!--<script src="script.js"></script>-->
</head>
<?php require_once "menu.php"; ?>

<?php
if (isset($_SESSION['idUtilisateur'])) {
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "appinfo";
    $bdd = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $value = $bdd->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = ?");
    $value->bind_param('s', $_SESSION['idUtilisateur']);
    $value->execute();
    $result = $value->get_result();
    $user = $result->fetch_object();
    if ($user->role == "administrateur") {
    } else {
        header("Location: main.php");
    }
} else {
    // Redirect them to the login page
    header("Location: login.php");
}
$nom = $prenom = $adresse = $numeroSecu = "OUI";
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "appinfo";
$bdd = new mysqli($db_host, $db_user, $db_pass, $db_name);
$value = $bdd->prepare("SELECT * FROM boitier WHERE idBoitier = ?");
$value->bind_param('s', $_GET["idB"]);
$value->execute();
$result = $value->get_result();
$boitier = $result->fetch_array();
$idBoitier = $boitier["idBoitier"];
$idCentre = $boitier["idCentre"];


$boitierQ = $bdd->query("SELECT * FROM centremedical WHERE numero=$idCentre");
$centre = $boitierQ->fetch_array();




?>

<body>
    <div id="conteneurMainAdmin">
        <div id="conteneur1Admin">
            <div id="conteneurCentreAdmin">
                <p style="width:70%;margin:auto;margin-top:2%;margin-bottom:2%;color:white">Êtes-vous sur de vouloir enlever le boitier #<?php echo $boitier["idBoitier"] ?> du centre <?php echo $centre['nom'] ?> ?</p>


                <a id="erreur_bouton" style="width:30%;margin:auto;" href="removeBoitier.php?idB=<?php echo $boitier["idBoitier"]; ?>">Oui</a>
                <br>
                <br>
                <br>
                <a id="erreur_boutonr" style="width:30%;margin:auto;" href="centre.php?id=<?php echo $idCentre; ?>">Annuler</a>
            </div>
        </div>
    </div>




</body>

<?php require_once "footer.php"; ?>




</html>