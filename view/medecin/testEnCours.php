<?php $title = 'test en cours'; ?>
<?php ob_start(); ?>

<div class="chargement">
  <div class="complétion"  style="width: 50%" data-perc="50%">

  </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>