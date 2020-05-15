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
        header("Location: admin.php");
    } elseif ($user->role == "medecin") {
        header("Location: medecin.php");
    } else {
        header("Location: profil.php");
    }
} else {
    // Redirect them to the login page
    header("Location: login.php");
}
