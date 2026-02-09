<?php
  ob_start();
?>

<h1>Users</h1>
<ul>
  <li>User 1</li>
  <li>User 2</li>
  <li>User 3</li>
</ul>

<?php 
  $content = ob_get_clean();

  include __DIR__ . "/../../../app/views/layout/main.php";
?>