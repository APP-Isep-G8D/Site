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
$prenom=$user->prenom;
$nom=$user->nom;
$adresse=$user->adresse;





$newReq = $bdd->prepare("SELECT * FROM patient WHERE idUtilisateur = ?");
$newReq ->bind_param('s',$user->idUtilisateur);
$newReq -> execute();
$resultat = $newReq->get_result();
$patient=$resultat->fetch_object();
$numeroSecu=$patient->numeroSS;
$idPatient=$patient->idPatient;

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
				Mon profil:
			</h1>
				<br>
				<br>
				<p>prénom : <?php echo $prenom;?></p>
				<p>nom : <?php echo $nom;?></p>
				<p>adresse : <?php echo $adresse;?></p>
				<p>numéro de sécurité sociale :<?php echo $numeroSecu;?></p>
				
				
	
				<br><br><br><br>
				<p>mes tests  :</p>

				<div id="listeTests">
                            <?php
                            $testQ = $bdd->query("SELECT * FROM test WHERE idPatient=$idPatient");
                            while($test=$testQ->fetch_array() ){
                                $idTest = $test["idTest"];
                                ?>
                                <div id="testPreviewMed">
                                    <br>
                                    <img src="testIcon.png" alt="apercu image" ><br> 

                                    <a href="test.php?idTest=<?php echo $idTest;?>" style="font-size:16px;text-decoration:none;color:black;font-weight:bold" ><?php echo "date :<br>", $test["date"]?></a>
                                    <a href="test.php?idTest=<?php echo $idTest;?>" style="font-size:16px;text-decoration:none;color:black;font-weight:bold" ><?php echo "resultat obtenu :<br>", $test["resultat"]?></a>

                                </div>
                                <?php
                                }
                                ?>
                        </div>
			</div>

			
		</p>
</body>
<?php require_once "footer.php";?>

</html>
