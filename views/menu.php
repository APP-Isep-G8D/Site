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

<script>
	function cacher(id) {
		document.getElementById(id).setAttribute("display", "none");
	}

	function montrer(id) {
		document.getElementById(id).setAttribute("display", "default");
	}
</script>

<header>
	<a href="main.php"><img id="logo" class="erreur_image" src="im.gif"></a>
	<a class="header2" href="main.php">Accueil</a>
	<a class="header2" href="Professionnel.php">Professionnels</a>
	<a class="header2" href="NousContacter.php">Nous contacter</a>
	<a class="header2" href="faq.php">FAQ</a>
	<button id="bouttonloupe" onclick="cacher('bouttonloupe'), montrer('recherche')"> 
		<img class="loupe" src="loupe.png"> 
	</button>
	<a class="header3" href="login.php"><?php echo $loginMsg; ?></a>
	<a class="header2" href="logout.php"><?php echo $profilconnecte; ?></a>
</header>

<form methode ="get" action="PageErreur.html" id="recherche">
   	<p> <input type="search" id="texteRecherche" placeholder="Que recherchez-vous ?"/></p>
</form>

<button id="gotop"><a href="#top">&#8743</a></button>


