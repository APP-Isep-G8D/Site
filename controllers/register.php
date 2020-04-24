<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=appinfo;charset=utf8', 'root', '');
        $mail = $mdp = " ";
        $mailErr= $mdpErr = " ";
        $resultat=" ";
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
                $mdp = htmlspecialchars($_POST["motdepasse"]);
                
              }
    
            $req = $bdd->prepare('SELECT * FROM utilisateur WHERE mail = ? AND motdepasse=?');
            $req->execute(array($mail,$mdp));
            $count= $req->rowCount();
            if($count >0){
                $resultat="bonne combinaison";
            }
            else{
                $resultat="mauvaise combinaison";
            }
        }
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }
    
    
    

    
    ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <b>mail :</b> <input type="text" name="email">
  <span class="error">* <?php echo $mailErr;?></span>
  <br><br>
  <b>mot de passe :</b> <input type="password" name="motdepasse">
  <span class="error">*<?php echo $mdpErr;?> </span>
  <br><br>


  <br><br>
  <input type="submit" name="submit" value="Submit">  
  <span class="result"><?php echo $resultat;?> </span>

</form>


</body>
</html>