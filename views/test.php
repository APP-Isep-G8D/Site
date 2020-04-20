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

  
    $value = $bdd->prepare("SELECT * FROM medecin WHERE idUtilisateur = ?");
    $value ->bind_param('s',$user->idUtilisateur);
    $value->execute();
    $result = $value->get_result();
    $medecin = $result->fetch_object();

    $value = $bdd->prepare("SELECT * FROM patient WHERE idUtilisateur = ?");
    $value ->bind_param('s',$user->idUtilisateur);
    $value->execute();
    $result = $value->get_result();
    $patient = $result->fetch_object();

    $idTest = $_GET["idTest"];
    $value = $bdd->prepare("SELECT * FROM test  WHERE idTest = ?");
    $value ->bind_param('s',$idTest);
    $value->execute();
    $result = $value->get_result();
    $test = $result->fetch_array();

    $value = $bdd->prepare("SELECT * FROM mesure  WHERE idTest = ?");
    $value ->bind_param('s',$idTest);
    $value->execute();
    $result = $value->get_result();
    $mesures = $result->fetch_array();

    if($user->role == "medecin" && $test["idMedecin"] == $medecin->idMedecin){
    }
    elseif($user->role == "patient" && $test["idPatient"] == $patient->idPatient){
    }
    else{
        header("Location: main.php");

    }

}
 else {
    // Redirect them to the login page
    header("Location: login.php");
}


$dataPoints = array( 
	array("y" => $mesures["fq"], "label" => "Fréquence Cardiaque (bpm)" ),
	array("y" => $mesures["temp"], "label" => "Température (°C)" ),
	array("y" => $mesures["audio"], "label" => "Cohérence audio (%)" ),
	array("y" => $mesures["reactivite"]*100, "label" => "Réactivité (s 10^-2)" )
	
);
$nom=$prenom=$adresse=$numeroSecu="OUI";



?>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Test du <?php echo   $test["date"] ?>"
	},
	axisY: {
		title: " Réussite (%)"
	},
	data: [{
		type: "column",
		
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}</script>

<body>
    <div id="conteneurMainAdmin">
        <div id="conteneur3Admin">
            <div id="conteneurCentreC">
            <br>
            <div id="chartContainer" style="height: 370px; width: 70%;margin:auto;"></div>  
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            
            <br>
            <br>
            <div id="boxCentre1"> 
                    <a href="profil.php" id="erreure_boutong" >Retour</a>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require_once "footer.php";?>
</html>