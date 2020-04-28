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

$idCentre = $_GET['idC'];

$numBoitier = "";

$errors = "";


if (isset($_POST['enregistrerMed'])) {
    // receive all input values from the form
    $numBoitier = mysqli_real_escape_string($bdd, $_POST['numeroBoitier']);


    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $alreadyExistQ = "SELECT * FROM boitier WHERE idBoitier='$numBoitier' LIMIT 1";
    $result = mysqli_query($bdd, $alreadyExistQ);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists    
        if ($user['idBoitier'] === $numBoitier) {
            $errors = "Ce boitier est déjà assigné à un centre";
        }
    }
    $idCentre = $_GET['idC'];

    // Finally, register user if there are no errors in the form
    if ($errors == "") {
        $query = "INSERT INTO boitier (idBoitier,idCentre) VALUES('$numBoitier', '$idCentre')";
        mysqli_query($bdd, $query);
        header("Location: centre.php?id=" . $idCentre);
    }
}



?>

<body>
    <div id="conteneurAddMed">
        <div id="itemMed">
            <div id="itemMed2">
                <h1 id="ajoutBoitier">
                    Formulaire d'ajout d'un nouveau boitier :
                </h1>
                <br>
                <hr class="trait3">
                <br>
                <form method="post" action="ajoutBoitier.php?idC=<?php echo $_GET['idC'] ?>">

                    <div class="input-group">
                        <label style="color: white"><b>Numéro du boitier :</b> </label>
                        <input type="text" name="numeroBoitier" required minlength="1" value="<?php echo $numBoitier; ?>">
                    </div>
                    <?php echo $errors; ?>
                    <div class="input-group">
                        <br>
                        <br>
                        <button id="erreur_boutong" type="submit" class="btn" name="enregistrerMed">Ajouter le boitier</button>
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


</body>
<?php require_once "footer.php"; ?>

</html>