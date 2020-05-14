<?php $title = 'test en cours'; ?>
<?php ob_start(); ?>


<div id="chargement">
  Récupération des valeurs
</div>
<progress id="progressBarre"></progress>

<script type="text/javascript" src="public/js/pourcent.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>