<?php ob_start(); ?>

<?php echo $roleConent; ?>

<?php
$content = ob_get_clean();

include __DIR__ . "/../../../app/views/layout/main.php";
?>
