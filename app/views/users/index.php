<?php
ob_start();
?>

<section class="users-section">
  <div class="users-header">
    <h2>Users</h2>
    <a href="/users/create" class="action-navigate-link">Create User</a>
  </div>

  <div class="users-table-wrap">
    <table class="users-table">
      <thead>
        <tr>
          <th>User</th>
          <th>Email</th>
          <th>Role</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($usersWithRole)): ?>
          <?php foreach ($usersWithRole as $user): ?>
            <tr>
              <td class="user-name"><?= htmlspecialchars($user['user_name']) ?></td>
              <td class="user-email"><?= htmlspecialchars($user['email']) ?></td>
              <td><span class="role-badge"><?= htmlspecialchars($user['role_name']) ?></span></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="3" class="users-empty">No users found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</section>

<?php
$content = ob_get_clean();

include __DIR__ . "/../../../app/views/layout/main.php";
?>
