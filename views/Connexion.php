<!doctype html>
<html lang="fr">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>IOTnov</title>
	<link rel="stylesheet" href="style.css">
	<style>
		form {
			overflow: hidden;
		}
	</style>
</head>

<?php require_once "menu.php"; ?>


<body>

	<div id=connexion>
		<div id="titre"> Connexion </div><label for="mail"></label>
		<br>
		<input type="text" id="mail" name="mail" required minlength="1" maxlength="30" size="20" placeholder="Adresse mail">

		<br>

		<label for="mdp"></label>
		<input type="password" id="mdp" name="mdp" required minlength="1" maxlength="30" size="20" placeholder="Mot de passe">
		<br>
		<br>

		<label for="sign"></label>
		<ul>
			<li><a id="login" href="#">Connexion</a></li>
		</ul>

	</div>

	<br><br><br><br><br><br><br>

</body>

<?php require_once "footer.php"; ?>


</html>