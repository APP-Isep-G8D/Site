<?php $title = 'profil'; ?>
<?php ob_start(); ?>

<div id="conteneurProfil">
    <div id="infoProfil">
        <h1 id="pageadmin_titre1">
            Mon profil:
        </h1>
        <hr class="trait3">
        <br>
        <br>
        <p><b>
                <font color="orange">Prénom :</font>
            </b><?php echo $user->$prenom; ?></p>
        <p><b>
                <font color="orange">Nom :</font>
            </b><?php echo $user->$nom; ?></p>
        <p><b>
                <font color="orange">Adresse :</font>
            </b><?php echo $user->$adresse; ?></p>
        <p><b>
                <font color="orange">Numéro de Sécurité Sociale :</font>
            </b><?php echo $user->$numeroSecu; ?></p>
    </div>
    <div id="listeTests">
        <h1 id="pageadmin_titre2">
            Mes tests :
        </h1>
        <hr class="trait2">
        <br>
        <br>
        <div class="listePreview">
            <?php
            $testQ = $bdd->query("SELECT * FROM test WHERE idPatient=$idPatient");
            while ($test = $testQ->fetch_array()) {
                $idTest = $test["idTest"];
            ?>
                <div class="previewTest">
                    <a style="color: #4488f3" href="test.php?idTest=<?php echo $idTest; ?>"><?php echo $test["date"] ?></a>
                    <br>
                    <a href="test.php?idTest=<?php echo $idTest; ?>"><img src="testIcon.png" alt="apercu image"></a>
                    <br>
                    <br>
                    <a style="color: #50b5a9" href="test.php?idTest=<?php echo $idTest; ?>">Résultats obtenus : <font color="#a51a4f"><?php echo  $test["resultat"] ?></font></a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>