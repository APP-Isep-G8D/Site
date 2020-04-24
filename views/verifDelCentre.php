
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>IOTnov</title>
  <link rel="stylesheet" href="style.css">
  <!--<script src="script.js"></script>-->
</head>
<?php require_once "menu.php";?>

<?php
if ( isset( $_SESSION['idUtilisateur'] ) ) {
    $db_host="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="appinfo";
    $bdd = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $value = $bdd->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = ?");
    $value ->bind_param('s',$_SESSION['idUtilisateur']);
    $value->execute();
    $result = $value->get_result();
    $user = $result->fetch_object();
    if($user->role == "administrateur"){
    }
    
    else{
        header("Location: main.php");
    }

}
 else {
    // Redirect them to the login page
    header("Location: login.php");
}
$nom=$prenom=$adresse=$numeroSecu="OUI";
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="appinfo";
$bdd = new mysqli($db_host, $db_user, $db_pass, $db_name);
$idCentre=$_GET["idC"];
$boitierQ = $bdd->query("SELECT * FROM centremedical WHERE numero=$idCentre");
$centre=$boitierQ->fetch_array();








?>

<body>
<div id="conteneurMainAdmin">
	<div id="conteneur1Admin">
		<div id="conteneurCentreAdmin">
            <p style="width:70%;margin:auto;margin-top:2%;margin-bottom:2%;">Etes vous sur de vouloir supprimer le centre <?php echo $centre['nom']?> ?</p>
            

            <a id="erreure_bouton" style="width:30%;margin:auto;" href="removeCentre.php?idC=<?php echo $idCentre;?>">oui</a>
            <br>
            <br>
            <br>
            <a id="erreure_bouton" style="width:30%;margin:auto;" href="centre.php?id=<?php echo $idCentre;?>">Retour</a>

		</div>
	</div>
</div>




</body>

<?php require_once "footer.php";?>




</html>
