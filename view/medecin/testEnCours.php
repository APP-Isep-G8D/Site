<?php $title = 'test en cours'; ?>
<?php ob_start(); ?>


<div id="conteneurTest">
  <div id="chargement">
    Récupération des valeurs
  </div>

  <div style="margin-left: 20%;margin-right: 20%;">
    <div class="bordure">
      <div id="myBar" class="completion">0%</div>
    </div>
  </div>

  <div id="recommencer_test">
    <br>
    <br>
    <br>
    <a onclick="location.reload()" id="erreur_boutonv">
      Recommencer
    </a>
  </div>

  <div id="retour">
    <br>
    <br>
    <br>
    <a style="font-size:large" href="<?php echo $_SERVER['HTTP_REFERER']; ?>" id="erreur_boutonr">Retour</a>

  </div>
</div>

<script type="text/javascript" src="public/js/pourcent.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>