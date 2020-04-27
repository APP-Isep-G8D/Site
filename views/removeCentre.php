
<?php
session_start();
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
$centreQ = $bdd->prepare("SELECT * FROM centremedical WHERE numero = ?");
$centreQ->bind_param('s', $_GET['idC']);
$centreQ->execute();
$centreR = $centreQ->get_result();
$centre = $centreR->fetch_object();
$idcentre = $centre->numero;

$RQ = $bdd->prepare("UPDATE medecin SET idCentre = '0' WHERE idCentre = ?");
$RQ->bind_param('s', $idcentre);
$RQ->execute();



$delCentre = $bdd->prepare("DELETE FROM `centremedical` WHERE numero= ?");
$delCentre->bind_param('s', $idcentre);
$delCentre->execute();



header("Location: admin.php");


?>
