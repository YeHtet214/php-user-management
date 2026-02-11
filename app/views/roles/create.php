<?php
ob_start();
$errors = $_SESSION['errors'] ?? [];

// Clear the session immediately
unset($_SESSION['errors']);
?>

<section class="users-section">
  <div class="users-header">
    <h2>Create New Role</h2>
    <a href="/roles" class="action-navigate-link">Roles</a>
  </div>

  <form action="/roles/create" method="POST">
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" class="<?= isset($errors['name']) ? 'error-border' : '' ?>">

      <?php if (isset($errors['name'])): ?>
        <div class="error-text">
          <?= $errors['name'] ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="permission-head">
      <span>Feature</span>
      <span>Permissions</span>
    </div>

    <div class="feature-grid">
      <?php foreach ($features as $feature): ?>
        <div class="permission-row">
          <strong><?= htmlspecialchars($feature['name']) ?></strong>

          <div class="permission-actions">
            <label class="perm-label">
              <input type="checkbox" name="permissions[<?= $feature['id'] ?>][]" value="View"> View
            </label>

            <label class="perm-label">
              <input type="checkbox" name="permissions[<?= $feature['id'] ?>][]" value="Create"> Create
            </label>

            <label class="perm-label">
              <input type="checkbox" name="permissions[<?= $feature['id'] ?>][]" value="Update"> Update
            </label>

            <label class="perm-label">
              <input type="checkbox" name="permissions[<?= $feature['id'] ?>][]" value="Delete"> Delete
            </label>
          </div>
        </div>
      <?php endforeach; ?>

      <?php if (isset($errors['permissions'])): ?>
        <div class="error-text">
          <?= $errors['permissions'] ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="actions">
      <button type="submit">Submit</button>
    </div>
  </form>
</section>

<?php
$roleConent = ob_get_clean();

include __DIR__ . "/../../../app/views/roles/index.php";
?>