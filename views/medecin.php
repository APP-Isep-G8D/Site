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
    if($user->role == "medecin"){
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



?>

<body>
<div id="conteneurMainAdmin">
	<div id="conteneur1Admin">
		
		<div id="infoAdmin">
			<h1>
				Mes information :
			</h1>
			<br>
			<br>
			<p>prénom : <?php echo $prenom;?></p>
			<p>nom : <?php echo $nom;?></p>
			<p>adresse : <?php echo $adresse;?></p>		
		</div>
		<div id="conteneurCentreAdmin">
			<div id="listeCentres">
				<h1>
                    Mes patients :
				</h1>
                <?php
                    
                    $medecinRQ = $bdd->prepare("SELECT * FROM medecin WHERE idUtilisateur= ?");
                    $medecinRQ -> bind_param('s',$_SESSION["idUtilisateur"]);
                    $medecinRQ->execute();
                    $medecinR = $medecinRQ->get_result();
                    $medecin = $medecinR->fetch_array();
                    $idMed= $medecin["idMedecin"];
                    $idCentre=$medecin["idCentre"];
                    $listeRQ = $bdd->prepare("SELECT * FROM patient WHERE idMedecin= ? AND idCentre= ?");
                    
                    $listeRQ->bind_param('ss',$idMed,$idCentre);
                    $listeRQ->execute();
                    $listeR = $listeRQ->get_result();
					while($row=$listeR->fetch_array() ){
                        $patientRQ = $bdd->prepare("SELECT * FROM utilisateur WHERE idUtilisateur= ?");
                        $patientRQ -> bind_param('s',$row["idUtilisateur"]);
                        $patientRQ->execute();
                        $patientR = $patientRQ->get_result();
                        $patient = $patientR->fetch_array();
                        $idPatient = $row["idPatient"]
						?><a href="profilPatient?idP=<?php echo $row["idPatient"];?>" style="text-decoration:none;color:black;font-weight:bold;" name=<?php  $row["idMedecin"];?>><?php echo  "- ",$patient["prenom"]," ", $patient["nom"], " (numéro : ", $row["numeroSS"],")";?></a>
						<br><br><?php
					}
				?>
			</div>
			<div id="buttonAdminCentre">
				
			<br>
			<a href="ajoutPatient.php" id="erreure_bouton">Ajouter ou retrouver un patient</a>


			</div>
			
		</div>
	</div>
	
</div>




</body>

<?php require_once "footer.php";?>




</html>
