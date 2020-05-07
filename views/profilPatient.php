<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Profil Patient</title>
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

    $idPatient = $_GET["idP"];
    $value = $bdd->prepare("SELECT * FROM patient WHERE idPatient = ?");
    $value->bind_param('s', $_GET["idP"]);
    $value->execute();
    $result = $value->get_result();
    $patient = $result->fetch_object();

    $value = $bdd->prepare("SELECT * FROM medecin WHERE idUtilisateur = ?");
    $value->bind_param('s', $user->idUtilisateur);
    $value->execute();
    $result = $value->get_result();
    $medecin = $result->fetch_object();

    if ($user->role == "medecin" && $patient->idMedecin == $medecin->idMedecin) {
    } else {
        header("Location: profil.php");
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
$value = $bdd->prepare("SELECT * FROM patient WHERE idPatient = ?");
$value->bind_param('s', $_GET["idP"]);
$value->execute();
$result = $value->get_result();
$patient = $result->fetch_array();

$value2 = $bdd->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = ?");
$value2->bind_param('s', $patient["idUtilisateur"]);
$value2->execute();
$result2 = $value2->get_result();
$patientInfo = $result2->fetch_array();

$nom = $patientInfo["nom"];
$prenom = $patientInfo["prenom"];
$adresse = $patientInfo["adresse"];
$mail = $patientInfo["mail"];
$idPatient = $_GET["idP"];

?>

<body>
    <div id="conteneurMainAdmin">
        <div id="conteneur3Admin">
            <div id="conteneurCentreC">
                <div id="infoCentre">
                    <h1>
                        <?php echo " ", $prenom, " ", $nom ?>
                    </h1>
                </div>
                <div style="color: white; font-weight: bold;">
                    <?php echo $adresse ?>
                    <?php echo $mail ?>
                </div>
                <br>
                <div id="ConteneurPatient">
                    Liste tests
                    <hr class="trait2">
                    <div class="listePreview">
                        <?php
                        $testQ = $bdd->query("SELECT * FROM test WHERE idPatient=$idPatient");
                        while ($test = $testQ->fetch_array()) {
                            $idTest = $test["idTest"];
                        ?>
                            <div class="previewTest">
                                <a style="color: #4488f3" href="test.php?idTest=<?php echo $idTest; ?>"><?php echo $test["date"] ?></a>
                                <br>
                                <a href="test.php?idTest=<?php echo $idTest; ?>"><img src="Image/testIcon.png" alt="apercu image"></a>
                                <br>
                                <br>
                                <a style="color: #50b5a9" href="test.php?idTest=<?php echo $idTest; ?>">Résultats obtenus : <font color="#a51a4f"><?php echo  $test["resultat"] ?></font></a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <br>
                    <div id="boxCentre1">
                        <p style="font-size:10px;color:green">*Pour accèder à un test, cliquez dessus</p>
                        <a style="font-size:x-large" href=" newTest.php?idP=<?php echo $_GET["idP"] ?>" id="erreur_boutonv">Nouveau Test</a>
                    </div>
                </div>
                <br><br>
                <div id="boxCentre1">
                    <a href="profil.php" id="erreur_boutong">Retour</a>
                </div>
                <br>
            </div>
            <div id="boitierInfo">
                <br>
            </div>
        </div>
    </div>
</body>
<?php require_once "footer.php"; ?>

</html>