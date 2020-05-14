<?php $title = 'test en cours'; ?>
<?php ob_start(); ?>

<div class="chargement">
 
</div>

<script type="text/javascript" src="public/js/pourcent.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
