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
    if ($user->role == "medecin") {
        $rqe = $bdd->prepare("SELECT * FROM medecin WHERE idUtilisateur = ?");
        $rqe->bind_param('s', $_SESSION['idUtilisateur']);
        $rqe->execute();
        $rslt = $rqe->get_result();
        $medecin = $rslt->fetch_array();
        $idMedecin = $medecin["idMedecin"];
        $idCentre = $medecin["idCentre"];
    } else {
        header("Location: login.php");
    }
} else {
    // Redirect them to the login page
    header("Location: login.php");
}
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "appinfo";
$bdd = new mysqli($db_host, $db_user, $db_pass, $db_name);
$username = $email = "";

try {

    if (isset($_GET['idP'])) {
        $first = $bdd->prepare("UPDATE patient SET idMedecin = ? WHERE idPatient = ?");
        $idMedecin = $_GET["idM"];
        $idPatient = $_GET['idP'];
        $first->bind_param('ss', $idMedecin, $idPatient);
        $first->execute();
        header("Location: medecin.php");
    }
} catch (Exception $e) {
    print_r($e);
}


$nom = "";
$prenom = "";
$adresse = "";
$numeroSS = "";
$email = "";
$password_1 = "";
$password_2 = "";
$errors = "";



if (isset($_POST['enregistrerMed'])) {
    // receive all input values from the form
    $nom = mysqli_real_escape_string($bdd, $_POST['nom']);
    $prenom = mysqli_real_escape_string($bdd, $_POST['prenom']);
    $adresse = mysqli_real_escape_string($bdd, $_POST['adresse']);
    $numeroSS = mysqli_real_escape_string($bdd, $_POST['numeroSS']);
    $email = mysqli_real_escape_string($bdd, $_POST['email']);
    $password_1 = mysqli_real_escape_string($bdd, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($bdd, $_POST['password_2']);
    if ($password_1 != $password_2) {
        $errors = "The two passwords do not match";
    }

    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $alreadyExistQ = "SELECT * FROM utilisateur WHERE mail='$email' LIMIT 1";
    $result = mysqli_query($bdd, $alreadyExistQ);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['mail'] === $email) {
            $errors = "email already exists";
        }
    }

    // Finally, register user if there are no errors in the form
    if ($errors == "") {
        $query = "INSERT INTO Utilisateur (mail,prenom,nom,adresse,role,motdepasse) VALUES('$email', '$prenom', '$nom','$adresse','patient', '$password_1')";
        mysqli_query($bdd, $query);
        $Reqbdd2 = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = ?");
        $Reqbdd2->bind_param('s', $email);
        $Reqbdd2->execute();
        $resultReq2 = $Reqbdd2->get_result();
        $patient = $resultReq2->fetch_object();
        $idUser = "";

        $idUser = $patient->idUtilisateur;
        $query2 = "INSERT INTO patient (idUtilisateur,idCentre,numeroSS,idMedecin) VALUES('$idUser', '$idCentre', '$numeroSS','$idMedecin')";
        mysqli_query($bdd, $query2);

        header("Location: profil.php");
    }
}



?>

<body>
    <div id="conteneurAddMed">
        <div id="itemMed">
            <h1>Ajout d'un patient : </h1>
            <div id="itemMed4">
                <div id="itemMed2">
                    <h3>
                        Nouveau patient :
                    </h3>
                    <form method="post" action="ajoutPatient.php">
                        <div class="input-group">
                            <label>Prénom</label>
                            <input type="text" name="prenom" required minlength="1" value="<?php echo $prenom; ?>">
                        </div>

                        <div class="input-group">
                            <label>Nom</label>
                            <input type="text" name="nom" required minlength="1" value="<?php echo $nom; ?>">
                        </div>

                        <div class="input-group">
                            <label>adresse</label>
                            <input type="text" name="adresse" required minlength="1" value="<?php echo $adresse; ?>">
                        </div>

                        <div class="input-group">
                            <label>numero de sécurité sociale</label>
                            <input type="text" name="numeroSS" required minlength="1" value="<?php echo $numeroSS; ?>">
                        </div>

                        <div class="input-group">
                            <label>Email</label>
                            <input type="email" required minlength="1" name="email" value="<?php echo $email; ?>">
                        </div>

                        <div class="input-group">
                            <label>Password</label>
                            <input type="password" required minlength="1" name="password_1">
                        </div>

                        <div class="input-group">
                            <label>Confirm password</label>
                            <input type="password" required minlength="1" name="password_2">
                        </div>
                        <?php echo $errors; ?>

                        <div class="input-group">
                            <br>
                            <button id="erreur_boutong" type="submit" class="btn" name="enregistrerMed">Enregistrer le patient</button>
                        </div>
                    </form>
                </div>
                <div id="itemMed3">
                    <h2>
                        Autre patients du centre :
                    </h2>
                    <?php
                    $medecinRQ = $bdd->prepare("SELECT * FROM patient WHERE idCentre= ? AND idMedecin != ?");

                    $medecinRQ->bind_param('ss', $idCentre, $idMedecin);
                    $medecinRQ->execute();
                    $medecin = $medecinRQ->get_result();
                    while ($row = $medecin->fetch_array()) {
                        $medecinInfoRQ = $bdd->prepare("SELECT * FROM utilisateur WHERE idUtilisateur= ? ");
                        $medecinInfoRQ->bind_param('s', $row["idUtilisateur"]);
                        $medecinInfoRQ->execute();
                        $medecinInfoR = $medecinInfoRQ->get_result();
                        $medecinInfo = $medecinInfoR->fetch_array();
                        $idPatient = $row["idPatient"];
                    ?><a href="ajoutPatient.php?idP=<?php echo $idPatient; ?>&idM=<?php echo $idMedecin; ?>" style="text-decoration:none;color:black;font-weight:bold;" name=<?php $row["idUtilisateur"]; ?>><?php echo "", $medecinInfo["prenom"], " ", $medecinInfo["nom"], " (", $medecinInfo["adresse"], ")"; ?></a>
                        <br><br><?php
                            }
                                ?>
                </div>
            </div>
            <div id="boxCentre1">
                <a href="profil.php" id="erreur_boutong">Retour</a>
            </div>
            <br>
            <br>



        </div>



    </div>


</body>
<?php require_once "footer.php"; ?>

</html>