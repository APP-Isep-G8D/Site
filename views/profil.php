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
    if($user->role == "patient"){
    }
    
    else{
        header("Location: login.php");
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
$value = $bdd->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = ?");
$value ->bind_param('s',$_SESSION['idUtilisateur']);
$value->execute();
$result = $value->get_result();
$user = $result->fetch_object();
$nom=$user->nom;
$prenom=$user->prenom;
$adresse=$user->adresse;

$newReq = $bdd->prepare("SELECT * FROM patient WHERE idUtilisateur = ?");
$newReq ->bind_param('s',$user->idUtilisateur);
$newReq -> execute();
$resultat = $newReq->get_result();
$patient=$resultat->fetch_object();
$numeroSecu=$patient->numeroSS;


?>

<body>
		<div id="opening">
			<div id="texteInfoPageP">

			</div>
			<br>
			<br>
		</div>
		<p>
			
			<div id="infoProfil"> 
			<h1>
				Information profil patient:
			</h1>
				<br>
				<br>
				<p>prénom : <?php echo $prenom;?></p>
				<p>nom : <?php echo $nom;?></p>
				<p>adresse : <?php echo $adresse;?></p>
				<p>numéro de sécurité sociale :<?php echo $numeroSecu;?></p>
				
				
				<br/>
				
			</div>
		</p>
		<p>
			<a href="testsPatients.html" id="erreure_bouton">Accèder à mes tests</a>
		</p>	
</body>
<?php require_once "footer.php";?>

</html>
