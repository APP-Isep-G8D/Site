<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>IOTnov</title>
	<link rel="stylesheet" href="style.css">
	<!--<script src="script.js"></script>-->
</head>
<?php require_once "menu.php"; ?>


<body>
	<div id="opening">
		<div id="texteInfoPageP">
			<h4>
				Information
			</h4>
			<br>
		</div>
		<br>
		<br>
	</div>
	<p>
		<br>
		<div id="imageperso">
			<img src="../Image/photoprofil.jpg">
		</div>
		<div id="info">
			Nom<br />
			<FORM>
				<TEXTAREA name="Nom" rows=1 cols=35>Indiquez votre nom</TEXTAREA>
			</FORM>
			Prénom<br />
			<FORM>
				<TEXTAREA name="Prénom" rows=1 cols=35>Indiquez votre prénom</TEXTAREA>
			</FORM>
			Adresse<br />
			<FORM>
				<TEXTAREA name="Adresse" rows=1 cols=35>Indiquez votre adresse</TEXTAREA>
			</FORM>
		</div>
	</p>
	<p>
		<br>
		<a href="Profil.html" id="login">Confirmer</a>
		<br>
	</p>
</body>
<?php require_once "footer.php"; ?>

</html>