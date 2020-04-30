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
$nom=$prenom=$adresse=$numeroSecu="OUI";
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
$nom=$user->nom;
$prenom=$user->prenom;
$adresse=$user->adresse;
?>
<body>

    <h1>Liste des centres de la Corse:</h1>
<?php   
    $medecin = $bdd->query('SELECT * FROM centremedical WHERE region ="Corse"');
    while($a = $medecin->fetch_array()) { 
?>
    <p><?= $a['nom'] ?>
    <?= $a['adresse'] ?></p>
    <br>
    <?php 
}
?>
</body>
    <?php require_once "footer.php";?>  
</html>