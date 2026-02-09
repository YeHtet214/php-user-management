<?php ob_start(); ?>

<b>-></b><a href="/roles">Roles</a>

<h1>Create New Role</h1>

<?php 
  $roleConent = ob_get_clean();

  include __DIR__ . "/../../../app/views/roles/index.php";
?>