
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

    $idPatient=$_GET["idP"];
    $value = $bdd->prepare("SELECT * FROM patient WHERE idPatient = ?");
    $value ->bind_param('s',$_GET["idP"]);
    $value->execute();
    $result = $value->get_result();
    $patient = $result->fetch_object();
    
    $value = $bdd->prepare("SELECT * FROM medecin WHERE idUtilisateur = ?");
    $value ->bind_param('s',$user->idUtilisateur);
    $value->execute();
    $result = $value->get_result();
    $medecin = $result->fetch_object();

    if($user->role == "medecin" && $patient->idMedecin == $medecin->idMedecin){
    }
    
    else{
        header("Location: profil.php");
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
$value = $bdd->prepare("SELECT * FROM patient WHERE idPatient = ?");
$value ->bind_param('s',$_GET["idP"]);
$value->execute();
$result = $value->get_result();
$patient = $result->fetch_array();

$value2 = $bdd->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = ?");
$value2 ->bind_param('s',$patient["idUtilisateur"]);
$value2->execute();
$result2 = $value2->get_result();
$patientInfo = $result2->fetch_array();

$nom=$patientInfo["nom"];
$prenom=$patientInfo["prenom"];
$adresse=$patientInfo["adresse"];
$mail=$patientInfo["mail"];
$idPatient=$_GET["idP"];

?>

<body>
    <div id="conteneurMainAdmin">
        <div id="conteneur3Admin">
            <div id="conteneurCentreC">
                <div id="infoCentre">
                    <h1>
                        <?php echo " ",$prenom," ",$nom?>
                    </h1>
                    <p>
                        <?php echo $adresse ?>
                    </p>
                    <p>
                        <?php echo $mail ?>
                    </p>
                </div>
                <div id="SepConteneurCentre">
                    <div id="infoCentreBoitier">
                        <?php echo "<p>Liste des tests effectués :<br><br><br> </p>";?>
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
                        
                            <br>
                            <br>
                            <br>
                        <div id="boxCentre1">
                        <p style="font-size:10px;">*Pour accèder à un test, cliquez dessus</p>

                            <a href="newTest.php?idP=<?php echo $_GET["idP"] ?>" id="erreure_bouton">Nouveau Test</a>
                        </div>
                    </div>
                    
                    
                    
                    
                </div>
                
                <br><br>
                
                <div id="boxCentre1"> 
                    <a href="profil.php" id="erreure_boutong" >Retour</a>
                </div>
                <br>
            </div>
            <div id="boitierInfo">
                    <br>
                    
                </div>       
                
            
        </div>
    </div>
</body>
<?php require_once "footer.php";?>
</html>