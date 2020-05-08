<?php $title = 'Admin'; ?>
<?php ob_start(); ?>

<?php
$nom = $prenom = $adresse = $numeroSecu = "OUI";
$nom = $user->nom;
$prenom = $user->prenom;
$adresse = $user->adresse;
?>


<div id="conteneurMainAdmin">
	<div id="conteneur1Admin">
		<div id="infoAdmin">
			<h1 id="pageadmin_titre1">
				Mes informations :
			</h1>
			<hr class="trait3">
			
			<p><b>
					<font color="orange">Prénom :</font>
				</b><?php echo $prenom; ?></p>
			<p><b>
					<font color="orange">Nom :</font>
				</b><?php echo $nom; ?></p>
			<p><b>
					<font color="orange">Adresse :</font>
				</b><?php echo $adresse; ?></p>
		</div>
		<div id="conteneurCentreAdmin">
			<div id="listeCentres">
				<h1 id="pageadmin_titre2">
					Liste des centres :
				</h1>
				<hr class="trait2">
				<br>
				<br>
				<?php
				$donnee = $bdd->query("SELECT * FROM centremedical WHERE 1");
				while ($row = $donnee->fetch_array()) {
				?><a class="listeCentres" href="index.php?action=centre&id=<?php echo $row["numero"]; ?>" name=<?php $row["numero"]; ?>><?php echo  "- ", $row["nom"], " | ", $row["region"]; ?></a>
					<br>
					<br>
				<?php
				}
				?>
			</div>
			<div id="buttonAdminCentre">
				<br>
				<br>
				<a href="index.php?action=ajoutCentre" id="erreur_bouton">Ajouter un centre</a>
			</div>

		</div>
	</div>
	<div id="conteneur2Admin">
		<div id="mapAdmin">
			<br>
			<p style="color: white"> Bientôt : une carte interactive</p>

		</div>

	</div>
</div>




<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
