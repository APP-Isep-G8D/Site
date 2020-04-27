<link rel="stylesheet" href="style.css">

<?php
session_start();
if ( isset( $_SESSION['idUtilisateur'] ) ) {
    $loginMsg="mon profil";
	$profilconnecte="Se déconnecter";
	?>
	<style>
		#login{
			background-color:transparent;
		}
		#login:hover{
			background-color: transparent;
			transition:0s;
			transform: scale(1);
		}
	</style>
	<?php
} else {
    // Redirect them to the login page
	$loginMsg="Se connecter";
	$profilconnecte="";

}
?>


<header>
	<ul>
		<li><a href="main.php"><img id="logo" class="erreure_image" src="im.gif"></a></li>
		<li><a href ="main.php">Accueil</a></li>
		<li><a href ="Professionnel.php">Professionnels</a></li>
		<li><a href ="NousContacter.php">Nous contacter</a></li>
		<li><a href ="faq.php">FAQ</a></li>
		<li><a href ="PageErreur.html">Recherche</a></li> <!-- Recherche a modifier pour integrer une animation : #javascript ou autre-->
		<li><a id="login" href="login.php"><?php echo $loginMsg;?></a></li>
		<li><a id="logout" href="logout.php"><?php echo $profilconnecte;?></a></li>

	</ul>
</header>
<button id="gotop"><a href="#top">&#8743</a></button>
