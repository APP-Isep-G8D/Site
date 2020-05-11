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
            <h1 id="pageadmin_titre1">Ajout d'un patient : </h1>
            <hr class="trait3">
            <br>
            <div id="itemMed4">
                <div id="itemMed2">
                    <h1 id="ajoutBoitier">
                        Nouveau patient :
                    </h1>
                    <br>
                    <br>
                    <form method="post" action="ajoutPatient.php">
                        <div class="groupe_medecin">
                            <input type="text" name="prenom" required minlength="1" value="<?php echo $prenom; ?>">
                            <span data-placeholder="Prénom"></span>
                        </div>

                       
                        <br>


                        <div class="groupe_medecin">
                            <input type="text" name="nom" required minlength="1" value="<?php echo $nom; ?>">
                            <span data-placeholder="Nom"></span>
                        </div>

                        
                        <br>


                        <div class="groupe_medecin">
                            <input type="text" name="adresse" required minlength="1" value="<?php echo $adresse; ?>">
                            <span data-placeholder="Adresse"></span>
                        </div>

                        
                        <br>


                        <div class="groupe_medecin">
                            <input type="text" name="numeroSS" required minlength="1" value="<?php echo $numeroSS; ?>">
                            <span data-placeholder="Numéro de Sécurité Sociale"></span>
                        </div>

                        
                        <br>


                        <div class="groupe_medecin">
                            <input type="email" required minlength="1" name="email" value="<?php echo $email; ?>">
                            <span data-placeholder="Email"></span>
                        </div>

                       
                        <br>


                        <div class="groupe_medecin">
                            <input type="password" required minlength="1" name="password_1">
                            <span data-placeholder="Mot de passe"></span>
                        </div>

                        
                        <br>


                        <div class="groupe_medecin">
                            <input type="password" required minlength="1" name="password_2">
                            <span data-placeholder="Confirmer Mot de passe"></span>
                        </div>
                        <?php echo $errors; ?>
                        <br>
                        <br>
                        <div class="input-group">
                            <center> <button id="erreur_boutong" type="submit" class="btn" name="enregistrerMed">Enregistrer le patient</button>
                            </center>
                        </div>
                    </form>
                </div>
                <hr class="trait6">
                <div id="itemMed3">
                    <h1 id="ajoutBoitier">
                        Autre(s) patient(s) du centre :
                    </h1>
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
            <br>
            <br>
            <div id="boxCentre1">
                <a href="profil.php" id="erreur_boutonr">Retour</a>
            </div>
            <br>
            <br>
        </div>
    </div>

    <script type="text/javascript">
    document.querySelectorAll(".groupe_medecin input").forEach(coco => {
      coco.onfocus = function() {
        coco.classList.add("focus");
        coco.style.borderColor="orange";
      }

      coco.onblur = function() {
        if (coco.value === "") {
          coco.classList.remove("focus");
          coco.style.borderColor="white";
        }
      }
    });
    </script>


</body>
<?php require_once "footer.php"; ?>

</html>