<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>IOTnov</title>
  <link rel="stylesheet" href="style.css">
  <!--<script src="script.js"></script>-->
</head>
<body>
	<?php require_once "menu.php";?>

	

<img src="France.jpg" width="500" height="500" alt="Orientation" border="0" usemap="#carte" />
<map name="carte">
	<area shape="rect" coords="30,110,105,170" href="Bretagne.php" Alt="Sud Ouest"/>
	<area shape="rect" coords="110,70,210,120" href="Normandie.php" Alt="Sud Ouest"/>
	<area shape="rect" coords="218,10,282,100" href="Hauts-de-France.php" Alt="Sud Ouest"/>
	<area shape="rect" coords="220,110,270,140" href="Ile-de-France.php" Alt="Sud Ouest"/>
	<area shape="rect" coords="300,75,400,160" href="Grand-Est.php" Alt="Sud Ouest"/>
	<area shape="rect" coords="265,170,390,230" href="Bourgogne-Franche-Comté.php" Alt="Sud Ouest"/>
	<area shape="poly" coords="250,240,390,300,300,330" href="Auvergne-Rhones-Alpes.php" Alt="Sud Ouest"/>
	<area shape="rect" coords="450,400,500,500" href="Corse.php" Alt="Sud Ouest"/>
	<area shape="rect" coords="190,160,255,225" href="Centre-Val-De-Loire.php" Alt="Sud Ouest"/>
	<area shape="poly" coords="142,136,184,150,115,250,100,200" href="Pays-de-la-Loire.php" Alt="Sud Ouest"/>
	<area shape="poly" coords="156,210,216,270,120,400" href="Nouvelle-Aquitaine.php" Alt="Sud Ouest"/>
	<area shape="poly" coords="218,330,300,370,250,430,150,430" href="Occitanie.php" Alt="Sud Ouest"/>
	<area shape="poly" coords="330,380,368,312,400,370,380,400" href="Provences-Alpes-Cotes-D'Azur.php" Alt="Sud Ouest"/>
	<?php require_once "footer.php";?>	
</map>
</body>
</html>
