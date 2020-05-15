<header>
	<a href="index.php?action=main"><img id="logo" class="erreur_image" src="public/images/im.gif"></a>
	<a class="header2" href="index.php?action=main">Accueil</a>
	<a class="header2" href="index.php?action=Professionnel">Professionnels</a>
	<a class="header2" href="index.php?action=contactus">Nous contacter</a>
	<a class="header2" href="index.php?action=faq">FAQ</a>
	<button id="bouttonloupe" onclick="cacher('bouttonloupe'); montrer('recherche')">
		<img class="loupe" src="public/images/loupe4.png">
	</button>
	<a class="<?php echo $menu[2] ?>" href="index.php?action=login"><?php echo $menu[0]; ?></a>
	<a class="header2" href="index.php?action=logout"><?php echo $menu[1]; ?></a>
</header>

<form methode="get" action="PageErreur.html" id="recherche">
	<p> <input type="search" id="texteRecherche" placeholder="Que recherchez-vous ?" /></p>
</form>

<button id="gotop"><a href="#top">&#8743</a></button>

<script type="text/javascript" src="modificationDisplay.js"></script>