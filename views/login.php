<!doctype html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>IOTnov</title>
  <link rel="stylesheet" href="style.css">
  <style>
    html {
      overflow: hidden;
    }
  </style>
</head>

<?php require_once "menu.php"; ?>


<body>
  <?php
  try {
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
      $db_host = "localhost";
      $db_user = "root";
      $db_pass = "";
      $db_name = "appinfo";
      $bdd = new mysqli($db_host, $db_user, $db_pass, $db_name);
      $mail = $mdp = " ";
      $mailErr = $mdpErr = " ";
      $resultat = " ";
      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Test de l'entrée de l'email
        if (empty($_POST["email"])) {
          $mailErr = "Une adresse mail est demandée";
        } else {
          $mail = htmlspecialchars($_POST["email"]);
          if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $mailErr = "Mauvais format d'adresse mail";
          }
        }

        //Test de l'entrée du mdp
        if (empty($_POST["motdepasse"])) {
          $mdpErr = "Un mot de passe est demandée";
        } else {
          $mdp = trim($_POST["motdepasse"]);
          $mdp = stripslashes($_POST["motdepasse"]);

          $mdp = htmlspecialchars($_POST["motdepasse"]);
        }
        $query = 'SELECT * FROM utilisateur WHERE mail = ?';
        $req = $bdd->prepare($query);
        $req->bind_param('s', $_POST["email"]);
        $req->execute();
        $result = $req->get_result();
        $user = $result->fetch_object();
        if ($_POST['motdepasse'] == $user->motdepasse) {
          $_SESSION['idUtilisateur'] = $user->idUtilisateur;
          $resultat = "Connexion réussie";
          header("Location: profilRedirect.php");
        } else {
          $resultat = "Mauvaise combinaison";
        }
      }
    }
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }

  ?>




  <form id="connexion" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    <div id="titre"> Connexion </div><label for="mail"></label>
    <br>
    <input type="text" id="mail" name="email" required minlength="1" maxlength="30" size="20" placeholder="Adresse mail">
    <span class="error">* <?php echo $mailErr; ?></span>
    <br>

    <label for="mdp"></label>
    <input type="password" id="mdp" name="motdepasse" required minlength="1" maxlength="30" size="20" placeholder="Mot de passe">
    <span class="error">*<?php echo $mdpErr; ?> </span>
    <br>
    <br>

    <label for="sign"></label>

    <input id="login" type="submit" name="submit" value="Se connecter">
    <br><span class="result"><?php echo $resultat; ?> </span>


  </form>

  <br><br><br><br><br><br><br>

</body>

<?php require_once "footer.php"; ?>


</html>