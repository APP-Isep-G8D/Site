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
	<a id="menuAccueil" class="header2" href="main.php">Accueil</a>
	<a id="menuPro" class="header2" href="Professionnel.php">Professionnels</a>
	<a id="menuContact" class="header2" href="NousContacter.php">Nous contacter</a>
	<a id="menuFAQ" class="header2" href="faq.php">FAQ</a>
	
	<form methode="get" action="PageErreur.html" id="recherche">
		<p> <input type="search" id="texteRecherche" placeholder="Que recherchez-vous ?" /></p>
	</form>
	
	<button id="bouttonloupe" onclick="animationRecherche()">
		<img class="loupe" src="loupe4.png">
	</button>

	<a class="header3" href="login.php"><?php echo $loginMsg; ?></a>
	<a class="header2" href="logout.php"><?php echo $profilconnecte; ?></a>
</header>


<button id="gotop"><a href="#top">&#8743</a></button>

<script type="text/javascript" src="modificationDisplay.js"></script>