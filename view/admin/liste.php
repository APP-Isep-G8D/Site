<?php $title = 'Admin'; ?>
<?php ob_start(); ?>


<?php
$lieux=$_GET['id'];
?>
<body>
<div id="liste">
    <main class="carte-position">
    <?php
    if($lieux=='Provences-Alpes-Cotes-Dazur'){
        echo "</br></br>";
        echo "Liste des centre médicaux de la région Provences-Alpes-Cotes-D'Azur :"; 
    }
    else{
    echo "</br></br>";
    echo "Liste des centre médicaux de la région ";
    echo $lieux;
    echo ':';
    }  
    $medecin = $bdd->query("SELECT * FROM centremedical WHERE region LIKE '" . $lieux . "'");
    if(($medecin->num_rows)<1){

    echo "</br></br></br></br></br>";        
    echo "Il n'y a pas de centres médicaux enregistré dans cette région.";
    echo "</br></br></br>";
    }
    else{
        echo"</br>";
            while($a = $medecin->fetch_array()) {
                ?>
                </br>
                <p><?= $a['nom'] ?>
                <?= $a['adresse'] ?></p>
                <br>
                <?php
            }
        }   
    ?>
    </br>
    </br>
    </br>
    <a href="index.php?action=carte" id="retourcarte">Retour vers la carte</a>

</div>
</body>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>