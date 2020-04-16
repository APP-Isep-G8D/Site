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

$nom = "";
$prenom = "";
$adresse = "";
$numeroSS ="";
$email = "";
$password_1 = "";
$password_2 = "";
$errors="";


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
	$errors= "The two passwords do not match";
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $alreadyExistQ = "SELECT * FROM utilisateur WHERE mail='$email' LIMIT 1";
  $result = mysqli_query($bdd, $alreadyExistQ);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['mail'] === $email) {
      $errors= "email already exists";
    }
  }

  // Finally, register user if there are no errors in the form
  if ($errors == "") {
  	$query = "INSERT INTO Utilisateur (mail,prenom,nom,adresse,role,motdepasse) VALUES('$email', '$prenom', '$nom','$adresse','medecin', '$password_1')";
    mysqli_query($bdd, $query);
    $Reqbdd2 = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = ?");
    $Reqbdd2 ->bind_param('s',$email);
    $Reqbdd2->execute();
    $resultReq2 = $Reqbdd2->get_result();
    $medecin = $resultReq2->fetch_object();
    $idUser="";
    $idCentre=$_GET["idC"];
    $idUser=$medecin->idUtilisateur;
    $query2 = "INSERT INTO medecin (idUtilisateur,idCentre,numeroSS) VALUES('$idUser', '$idCentre', '$numeroSS')";
    mysqli_query($bdd, $query2);
    
    header("Location: admin.php");
}

}



?>
<body>
<div id="conteneurAddMed">
    <div id="itemMed">
        <div id="itemMed2">
            <h1>
                formulaire d'ajout de medecin :
            </h1>
            <form method="post" action="ajoutMedecin.php?idC=<?php echo $_GET['idC'];?>">
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
                <?php echo $errors;?>

                <div class="input-group">
                    <br>
                    <button type="submit" class="btn" name="enregistrerMed" >Enregistrer le Medecin</button>
                </div>
            </form>
        </div>
    </div>

</div>


</body>
<?php require_once "footer.php";?>
</html>