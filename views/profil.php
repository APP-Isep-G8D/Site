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
    if ($user->role == "patient") {
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
$prenom = $user->prenom;
$nom = $user->nom;
$adresse = $user->adresse;


$newReq = $bdd->prepare("SELECT * FROM patient WHERE idUtilisateur = ?");
$newReq->bind_param('s', $user->idUtilisateur);
$newReq->execute();
$resultat = $newReq->get_result();
$patient = $resultat->fetch_object();
$numeroSecu = $patient->numeroSS;
$idPatient = $patient->idPatient;

?>

<body>
    <div id="conteneurProfil">
        <div id="infoProfil">
            <h1 id="pageadmin_titre1">
                Mon profil:
            </h1>
            <hr class="trait3">
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
            <p><b>
                    <font color="orange">Numéro de Sécurité Sociale :</font>
                </b><?php echo $numeroSecu; ?></p>
        </div>
        <div id="listeTests">
            <h1 id="pageadmin_titre2">
                Mes tests :
            </h1>
            <hr class="trait2">
            <br>
            <br>
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
        </div>
    </div>
</body>
<?php require_once "footer.php"; ?>

</html>