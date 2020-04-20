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
        header("Location: login.php");
    }

}
 else {
    // Redirect them to the login page
    header("Location: login.php");
}
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="appinfo";
$bdd = new mysqli($db_host, $db_user, $db_pass, $db_name);
$username=$email="";

$adresse = "";
$nom ="";
$numBoitier = "";

$errors="";


if (isset($_POST['idBoitier'])) {
    // receive all input values from the form
  
    $idBoitier = $_POST["idBoitier"];
    $date = date("Y-m-d");                     // 2001-03-10(le format DATE de MySQL)
    $idP=$_GET["idP"];
    $idMedecin=$medecin->idMedecin;
    $query = "INSERT INTO test (date,idPatient,idMedecin) VALUES('$date', '$idP','$idMedecin')";
    mysqli_query($bdd, $query);

    $value = $bdd->prepare("SELECT * FROM test WHERE date LIKE ? AND idPatient LIKE ?");
    $value ->bind_param('ss',$date,$idP);
    $value->execute();
    $result = $value->get_result();
    $testResult = $result->fetch_array();

    $idTest=$testResult["idTest"];

    $fq=$temp=$audio=50;
    $reactivite=.5;
    $query = "INSERT INTO mesure (idTest,fq,temp,audio,reactivite) VALUES($idTest, $fq,$temp,$audio,$reactivite)";
    mysqli_query($bdd, $query);
    
    header("Location: profilPatient.php?idP=".$idPatient);

}



?>
<body>
<div id="conteneurAddMed">
    <div id="itemMed">
        <div id="itemMed2" style="text-align:center;" >
            <h1>
                Nouveau test :
            </h1>
            <form method="post" action="newTest.php?idP=<?php echo $_GET["idP"] ?>">

                <div class="input-group">
                    <label>Merci de selectionner le boitier à utiliser :</label>
                    <select name="idBoitier">
                        
                        
                        <?php
                        $value = $bdd->prepare("SELECT * FROM medecin WHERE idUtilisateur = ?");
                        $value ->bind_param('s',$_SESSION['idUtilisateur']);
                        $value->execute();
                        $result = $value->get_result();
                        $medecin = $result->fetch_array();
                        $idCentre = $medecin["idCentre"];
                        $value = $bdd->prepare("SELECT * FROM boitier WHERE idCentre = ?");
                        $value ->bind_param('s',$idCentre);
                        $value->execute();
                        $result = $value->get_result();
                        $array_length=count($listeBoitier);
                        while($listeBoitier = $result->fetch_array()){
                        ?>
                        <option value="<?=$listeBoitier["idBoitier"];?>"> <?=$listeBoitier["idBoitier"];?> </option>
                        <?php
                        }
                        ?>
                        
                    </select>
                </div>

                

                <?php echo $errors;?>

                <div class="input-group">
                    <br>
                    <button id="erreure_boutong" type="submit" class="btn" name="enregistrerMed" >Lancer le test</button>
                </div>

            </form>
        </div>
    </div>

</div>


</body>
<?php require_once "footer.php";?>
</html>