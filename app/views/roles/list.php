<?php ob_start() ?>

<section class="users-section">
  <div class="users-header">
    <h2>Roles</h2>
    <a href="/roles/create" class="action-navigate-link">Create Role</a>
  </div>

  <div class="users-table-wrap">
    <table class="roles-table">
      <thead>
        <tr>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($roles as $role): ?>
          <tr class="roles-row">
            <td><?= htmlspecialchars($role['name']) ?></td>
            <td>
              <a href="/roles?edit_id=<?= $role['id'] ?>" class="btn-edit">Edit</a>

              <form action="/roles/delete" method="POST" onsubmit="return confirm('Are you sure?');">
                <input type="hidden" name="id" value="<?= $role['id'] ?>">
                <button type="submit" class="btn-delete">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>

<?php if (isset($editRole)): ?>
  <div class="modal-overlay">
    <div class="modal-content"> <h3>Edit Role: <?= htmlspecialchars($editRole['name']) ?></h3>

      <form action="/roles/update" method="POST">
        <input type="hidden" name="id" value="<?= $editRole['id'] ?>">

        <label>Role Name</label>
        <input type="text" name="name" value="<?= htmlspecialchars($editRole['name']) ?>">
        <br><br>

        <h3>Permissions</h3>
        <div class="permission-head">
          <span>Feature</span>
          <span>Permissions</span>
        </div>
        <div class="feature-grid">
          <?php foreach ($features as $feature): ?>
            <?php 
                // Get existing permissions for THIS feature
                $existing = $currentPermissions[$feature['id']] ?? [];
            ?>
            
            <div class="permission-row">
              <strong><?= htmlspecialchars($feature['name']) ?></strong>

              <div class="permission-actions">
                <label class="perm-label">
                  <input type="checkbox" name="permissions[<?= $feature['id'] ?>][]" value="View"
                    <?= in_array('view', $existing) ? 'checked' : '' ?>> View
                </label>

                <label class="perm-label">
                  <input type="checkbox" name="permissions[<?= $feature['id'] ?>][]" value="Create"
                    <?= in_array('create', $existing) ? 'checked' : '' ?>> Create
                </label>

                <label class="perm-label">
                  <input type="checkbox" name="permissions[<?= $feature['id'] ?>][]" value="Update"
                    <?= in_array('update', $existing) ? 'checked' : '' ?>> Update
                </label>

                <label class="perm-label">
                  <input type="checkbox" name="permissions[<?= $feature['id'] ?>][]" value="Delete"
                    <?= in_array('delete', $existing) ? 'checked' : '' ?>> Delete
                </label>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="actions">
          <button type="submit">Update Role</button>
          <a href="/roles" class="cancel-btn">Cancel</a>
        </div>
      </form>
    </div>
  </div>
<?php endif; ?>

<?php
$roleConent = ob_get_clean();
include __DIR__ . "/../../../app/views/roles/index.php";
?>
