</php ob_start() ?>

<h2>Roles and Permissions</h2>

<div>
  <?php echo $roleConent; ?>
</div>

<?php
$content = ob_get_clean();

include __DIR__ . "/../../../app/views/layout/main.php";
?>