<?php ob_start(); ?>

<a href="/roles">Roles</a>

<h2>Create New Role</h2>

<form action="/roles/create" method="POST">
  <label for="name">Role Name</label>
  <input type="text" name="name">

  <div>
    <h3>Features</h3>
    <h3>Permissions</h3>
  </div>

  <div>
    <div>
      <?php foreach ($features as $feature): ?>
        <p>
          <?= htmlspecialchars($feature['name']) ?>
        </p>

        <div>
          <label>
            <input type="checkbox" name="permissions[<?= $feature['id'] ?>][]" value="View"> View
          </label>

          <label>
            <input type="checkbox" name="permissions[<?= $feature['id'] ?>][]" value="Create"> Create
          </label>

          <label>
            <input type="checkbox" name="permissions[<?= $feature['id'] ?>][]" value="Update"> Update
          </label>

          <label>
            <input type="checkbox" name="permissions[<?= $feature['id'] ?>][]" value="Delete"> Delete
          </label>
        </div>
      <?php endforeach; ?>
    </div>

  </div>

  <br> <br>
  <button type="submit">Submit</button>
</form>

<?php
$roleConent = ob_get_clean();

include __DIR__ . "/../../../app/views/roles/index.php";
?>
