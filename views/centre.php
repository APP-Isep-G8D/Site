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
        header("Location: main.php");
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
$value = $bdd->prepare("SELECT * FROM centremedical WHERE numero = ?");
$value->bind_param('s', $_GET["id"]);
$value->execute();
$result = $value->get_result();
$user = $result->fetch_object();
$id = $user->numero;
$nom = $user->nom;
$adresse = $user->adresse;
?>

<body>
    <div id="conteneurMainAdmin">
        <div id="conteneur3Admin">
            <div id="conteneurCentreC">
                <div id="infoCentre">
                    <h1>
                        <?php echo $nom ?>
                    </h1>
                    <p>
                        <?php echo $adresse, "<br><br>" ?>
                    </p>
                </div>
                <div id="SepConteneurCentre">
                    <div id="infoCentreBoitier">
                        <?php echo "<p>Liste des boitiers utilisés :</p>";
                        $boitierQ = $bdd->query("SELECT * FROM boitier WHERE idCentre=$id");
                        while ($boitier = $boitierQ->fetch_array()) {
                            $idboitier = $boitier["idBoitier"];
                        ?>
                            <a href="verifDelBoitier.php?idB=<?php echo $idboitier; ?>" style="font-size:16px;text-decoration:none;font-weight:bold;color:white"><?php echo "Id boitier: #", $boitier["idBoitier"], "<br>" ?></a>
                        <?php
                        }
                        ?>
                        <div id="boxCentre">
                            <p style="font-size:10px;">*Pour enlever un boitier de la liste, cliquez sur son ID</p>
                            <a href="ajoutBoitier.php?idC=<?php echo $_GET["id"] ?>" id="erreure_bouton">Ajouter un boitier</a>
                        </div>
                    </div>
                    <div id="infoCentreMedecins">
                        <?php
                        echo "<p>Liste des médecins : </p>";
                        $donnee = $bdd->query("SELECT * FROM medecin WHERE idCentre=$id");
                        while ($row = $donnee->fetch_array()) {
                            $idUser = $row["idUtilisateur"];
                            $medecinQ = $bdd->query("SELECT * FROM utilisateur WHERE idUtilisateur=$idUser");
                            $medecin = $medecinQ->fetch_array();
                        ?><a href="verifDelMedecin.php?id=<?php echo $medecin["idUtilisateur"]; ?>" style="font-size:16px;text-decoration:none;color:white;font-weight:bold"><?php echo "", $medecin["prenom"], " ", $medecin["nom"], ",  ", $medecin["mail"], "<br>"; ?></a>
                        <?php
                        }
                        ?>
                        <div id="boxCentre">
                            <p style="font-size:10px;">*Pour enlever un médecin de la liste, cliquez sur son nom</p>
                            <a href="ajoutMedecin.php?idC=<?php echo $_GET["id"] ?>" id="erreure_bouton">Ajouter un médecin</a>
                        </div>
                    </div>
                </div>

                <br><br>
                <div id="boxCentre2">
                    <br>
                    <a href="verifDelCentre.php?idC=<?php echo $_GET["id"] ?>" id="erreure_boutonr">Supprimer le centre</a>
                </div>
                <br>
                <br>
                <div id="boxCentre2">
                    <a href="admin.php" id="erreure_boutong">Retour</a>
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