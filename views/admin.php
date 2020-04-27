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
		header("Location: login.php");
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
$value = $bdd->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = ?");
$value->bind_param('s', $_SESSION['idUtilisateur']);
$value->execute();
$result = $value->get_result();
$user = $result->fetch_object();
$nom = $user->nom;
$prenom = $user->prenom;
$adresse = $user->adresse;



?>

<body>
	<div id="conteneurMainAdmin">
		<div id="conteneur1Admin">
			<div id="infoAdmin">
				<h1 style="color: orange">
					Mes informations :
				</h1>
				<br>
				<br>
				<p><b>
						<font color="orange">Prénom :</font>
					</b><?php echo $prenom; ?></p>
				<p><b>
						<font color="orange">Nom :</font>
					</b><?php echo $nom; ?></p>
				<p><b>
						<font color="orange">Adresse :</font>
					</b><?php echo $adresse; ?></p>
			</div>
			<div id="conteneurCentreAdmin">
				<div id="listeCentres">
					<h1>
						Liste des centres :
					</h1>
					<?php
					$donnee = $bdd->query("SELECT * FROM centremedical WHERE 1");
					while ($row = $donnee->fetch_array()) {
					?><a href="centre.php?id=<?php echo $row["numero"]; ?>" style="text-decoration:none;color:white;font-weight:bold;" name=<?php $row["numero"]; ?>><?php echo  "- ", $row["nom"], " ", $row["adresse"]; ?></a>
						<br><br><?php
							}
								?>
				</div>
				<div id="buttonAdminCentre">
					<br>
					<a href="addCentre.php" id="erreure_bouton">Ajouter un centre</a>
				</div>

			</div>
		</div>
		<div id="conteneur2Admin">
			<div id="mapAdmin">
				<br>
				<p style="color: white"> Bientôt : une carte interactive</p>

			</div>

		</div>
	</div>




</body>

<?php require_once "footer.php"; ?>




</html>