<?php $title = 'Admin'; ?>
<?php ob_start(); ?>
<div id="conteneurAddMed">
    <div id="itemMed">
        <div id="itemMed2">
            <h1 id="ajoutBoitier">
                Formulaire d'ajout d'un nouveau boitier :
            </h1>
            <br>
            <hr class="trait3">
            <br>
            <form method="post" action="index.php?action=ajoutBoitier&idC=<?php echo $_GET['idC'] ?>">

                <div class="input-group">
                    <label style="color: white"><b>Numéro du boitier :</b> </label>
                    <input type="text" name="numeroBoitier" required minlength="1" value="">
                </div>
                <?php echo $errors; ?>
                <div class="input-group">
                    <br>
                    <br>
                    <button id="erreur_boutong" type="submit" class="btn" name="enregistrerMed">Ajouter le boitier</button>
                </div>
            </form>
            <br>
            <br>
            <div id="boxCentre1">
                <a href="index.php?action=centre&id=<?php echo $_GET["idC"] ?>" id="erreur_boutonr">Retour</a>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>