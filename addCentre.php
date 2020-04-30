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
    if($user->role == "administrateur"){
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
$region="";

$errors="";


if (isset($_POST['enregistrerMed'])) {
    // receive all input values from the form
  $nom = mysqli_real_escape_string($bdd, $_POST['nom']);
  $adresse = mysqli_real_escape_string($bdd, $_POST['adresse']);
  $region = mysqli_real_escape_string($bdd, $_POST['region']);


  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $alreadyExistQ = "SELECT * FROM centremedical WHERE adresse='$adresse' LIMIT 1";
  $result = mysqli_query($bdd, $alreadyExistQ);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists    
    if ($user['adresse'] === $adresse) {
      $errors= "Un centre est déjà renseigné à cette adresse";
    }

  }

  // Finally, register user if there are no errors in the form
  if ($errors == "") {
  	$query = "INSERT INTO centremedical (adresse,nom,region) VALUES('$adresse', '$nom','$region')";
    mysqli_query($bdd, $query);
    
    header("Location: admin.php");
}

}



?>
<body>
<div id="conteneurAddMed">
    <div id="itemMed">
        <div id="itemMed2">
            <h1>
                Ajouter un centre :
            </h1>
            <form method="post" action="addCentre.php">

                <div class="input-group">
                    <label>Nom  &nbsp  &nbsp </label>
                    <input type="text" name="nom" required minlength="1" value="<?php echo $nom; ?>">
                </div>

                <div class="input-group">
                    <label>Adresse</label>
                    <input type="text" name="adresse" required minlength="1" value="<?php echo $adresse; ?>">
                </div>

                <div class="input-group">
                    <label>Region</label>
                    <select name="region">
                    <option value="">--Veuillez choisir la région du centre--</option>
                    <option value="Auvergne-Rhones-Alpes">Auvergne-Rhones-Alpes</option>
                    <option value="Bourgogne-Franche-Comté">Bourgogne-Franche-Comté</option>
                    <option value="Bretagne">Bretagne</option>
                    <option value="Centre-Val-de-Loire">Centre-Val-De-Loire</option>
                    <option value="Corse">Corse</option>
                    <option value="Grand-Est">Grand-Est</option>
                    <option value="Hauts-de-France">Hauts-de-France</option>
                    <option value="Ile-de-France">Ile-de-France</option>
                    <option value="Normandie">Normandie</option>
                    <option value="Nouvelle-Aquitaine">Nouvelle-Aquitaine</option>
                    <option value="Occitanie">Occitanie</option>
                    <option value="Pays-de-la-Loire">Pays-de-la-Loire</option>
                    <option value="Provences-Alpes-Cotes-Dazur">Provences-Alpes-Cotes-D'azur</option>                                        
                </select>
                </div>

                <?php echo $errors;?>

                <div class="input-group">
                    <br>
                    <button id="erreure_boutong" type="menu" class="btn" name="enregistrerMed" >Enregistrer le centre</button>
                    <menu>

                    </menu>
                </div>

            </form>
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