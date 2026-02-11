<?php
ob_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

// Clear the session immediately
unset($_SESSION['errors']);
unset($_SESSION['old']);
?>

<section class="users-section">
  <div class="users-header">
    <h2>Create New User</h2>
    <a href="/users" class="action-navigate-link">Users</a>
  </div>

  <form action="/users/create" method="POST">

    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>"
        class="<?= isset($errors['name']) ? 'error-border' : '' ?>">

      <?php if (isset($errors['name'])): ?>
        <div class="error-text">
          <?= $errors['name'] ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>">

      <?php if (isset($errors['email'])): ?>
        <div class="error-text">
          <?= $errors['email'] ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" value="<?= htmlspecialchars($old['password'] ?? '') ?>">

      <?php if (isset($errors['password'])): ?>
        <div class="error-text">
          <?= $errors['password'] ?>
        </div>
      <?php endif; ?>
    </div>


    <div class="form-group">
      <label>Role</label>
      <select name="role_id">
        <option value="" disabled selected>Select a Role</option>


        <?php foreach ($roles as $role): ?>
          <option value="<?= $role['id'] ?>">
            <?= $role['name'] ?>
          </option>
        <?php endforeach; ?>

        <!-- <option value="5" <?= ($old['role_id'] ?? '') == 5 ? 'selected' : '' ?>>Supervisor</option> -->
        <!-- <option value="9" <?= ($old['role_id'] ?? '') == 9 ? 'selected' : '' ?>>Manager</option> -->
      </select>

      <?php if (isset($errors['role_id'])): ?>
        <div class="error-text">
          <?= $errors['role_id'] ?>
        </div>
      <?php endif; ?>
    </div>

    <button type="submit">Create User</button>
  </form>
</section>

<?php
$content = ob_get_clean();

include __DIR__ . "/../../../app/views/layout/main.php";
?>
t_clean
);

include __DIR__ . "/../../../app/views/layout/main.php";
?>