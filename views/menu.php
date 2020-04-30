<link rel="stylesheet" href="style.css">

<?php
session_start();
if (isset($_SESSION['idUtilisateur'])) {
	$loginMsg = "Mon profil";
	$profilconnecte = "Se déconnecter";
} else {
	// Redirect them to the login page
	$loginMsg = "Se connecter";
	$profilconnecte = "";
}
?>

<header>
	<a href="main.php"><img id="logo" class="erreur_image" src="im.gif"></a>
	<a class="header2" href="main.php">Accueil</a>
	<a class="header2" href="Professionnel.php">Professionnels</a>
	<a class="header2" href="NousContacter.php">Nous contacter</a>
	<a class="header2" href="faq.php">FAQ</a>
	<a class="header2" href="PageErreur.html"><img class="search" src="loupe4.png"></a>
	<a class="header3" href="login.php"><?php echo $loginMsg; ?></a>
	<a class="header2" href="logout.php"><?php echo $profilconnecte; ?></a>
</header>
<button id="gotop"><a href="#top">&#8743</a></button>
