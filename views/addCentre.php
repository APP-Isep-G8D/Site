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

$adresse = "";
$nom = "";
$numBoitier = "";

$errors = "";


if (isset($_POST['enregistrerMed'])) {
    // receive all input values from the form
    $nom = mysqli_real_escape_string($bdd, $_POST['nom']);
    $adresse = mysqli_real_escape_string($bdd, $_POST['adresse']);


    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $alreadyExistQ = "SELECT * FROM centremedical WHERE adresse='$adresse' LIMIT 1";
    $result = mysqli_query($bdd, $alreadyExistQ);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists    
        if ($user['adresse'] === $adresse) {
            $errors = "Un centre est déjà renseigné à cette adresse";
        }
    }

    // Finally, register user if there are no errors in the form
    if ($errors == "") {
        $query = "INSERT INTO centremedical (adresse,nom) VALUES('$adresse', '$nom')";
        mysqli_query($bdd, $query);

        header("Location: admin.php");
    }
}

?>

<body>
    <div id="conteneurAddMed">
        <div id="itemMed">
            <div id="itemMed2">
                <h1 id="ajoutBoitier">
                    Ajouter un centre :
                </h1>
                <hr class="trait3">
                <br>
                <br>
                <form method="post" action="addCentre.php">
                <div class="groupe_medecin">
                    <input type="text" name="nom" value="<?php echo $nom; ?>">
                    <span data-placeholder="Nom"></span>
                </div>

                <br>

                <div class="groupe_medecin">
                    <input type="text" name="adresse" value="<?php echo $adresse; ?>">
                    <span data-placeholder="Adresse"></span>
                </div>

                    <?php echo $errors; ?>

                    <div class="input-group">
                        <br>
                        <button id="erreur_boutong" type="submit" class="btn" name="enregistrerMed">Enregistrer le centre</button>
                    </div>

                </form>
                <br>
                <br>
                <div id="boxCentre1">
                    <a href="profil.php" id="erreur_boutonr">Retour</a>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
    document.querySelectorAll(".groupe_medecin input").forEach(coco => {
      coco.onfocus = function() {
        coco.classList.add("focus");
        coco.style.borderColor="orange";
      }

      coco.onblur = function() {
        if (coco.value === "")
          coco.classList.remove("focus");
          coco.style.borderColor="white";
      }
    });
    </script>

</body>
<?php require_once "footer.php"; ?>

</html>