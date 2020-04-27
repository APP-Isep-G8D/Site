<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>IOTnov</title>
	<link rel="stylesheet" href="style.css">
	<!--<script src="script.js"></script>-->
</head>

<body>
	<?php require_once "menu.php"; ?>

	<div id="titre"> Inscription </div>
	<form action="" method="GET">
		<p>Complétez le formulaire. <i>Les champs marqués par <em>*</em> sont <em>obligatoires</em></i></p>
		<fieldset>
			<legend>Informations</legend>
			<label for="nom">Prénom <em>*</em></label>
			<input id="nom" placeholder="Prénom" autofocus="" required=""><br>
			<label for="nom">Nom <em>*</em></label>
			<input id="nom" placeholder="Nom" autofocus="" required=""><br>
			<label for="telephone">Portable</label>
			<input id="telephone" type="tel" placeholder="06xxxxxxxx" pattern="06[0-9]{8}"><br>
			<label for="email">Email <em>*</em></label>
			<input id="email" type="email" placeholder="Email" required="" pattern="*@[a-zA-Z]*.[a-zA-Z]*"><br>
			<label for="NSS">Numéro de sécurité sociale <em>*</em></label>
			<input id="NSS" placeholder="15 chiffres" autofocus="" required="" pattern="[0-9]{15}"><br>
		</fieldset>
		<p><input id="login" type="submit" value="Soummettre"></p>
	</form>

	<?php require_once "footer.php"; ?>

</body>