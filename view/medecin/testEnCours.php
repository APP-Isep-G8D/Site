<?php $title = 'test en cours'; ?>
<?php ob_start(); ?>


<div id="chargement">
  Récupération des valeurs
</div>

<div style="margin-left: 20%;margin-right: 20%;">
  <div class="bordure">
    <div id="myBar" class="completion">0%</div>
  </div>
</div>

<script type="text/javascript" src="public/js/pourcent.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>