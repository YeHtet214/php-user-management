<?php ob_start() ?>

<a href="/roles/create">Create Role</a>

<table class="roles-table">
  <thead>
    <tr>
      <th>Role</th>
      <th>Actions</th> </tr>
  </thead>
  <tbody>
    <?php foreach ($roles as $role): ?>
      <tr class="roles-row">
        <td><?= htmlspecialchars($role['name']) ?></td>
        <td>
          <a href="/roles?edit_id=<?= $role['id'] ?>" class="btn-edit">Edit</a>
          
          <form action="/roles/delete" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
            <input type="hidden" name="id" value="<?= $role['id'] ?>">
            <button type="submit" class="btn-delete">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php if (isset($editRole)): ?>
  <div class="modal-overlay">
    <div class="modal-content" style="width: 80%; max-width: 800px;"> <h3>Edit Role: <?= htmlspecialchars($editRole['name']) ?></h3>

      <form action="/roles/update" method="POST">
        <input type="hidden" name="id" value="<?= $editRole['id'] ?>">

        <label>Role Name</label>
        <input type="text" name="name" value="<?= htmlspecialchars($editRole['name']) ?>">
        <br><br>

        <h3>Permissions</h3>
        <div class="feature-grid">
          <?php foreach ($features as $feature): ?>
            <?php 
                // Get existing permissions for THIS feature
                $existing = $currentPermissions[$feature['id']] ?? [];
            ?>
            
            <div class="permission-group">
              <strong><?= htmlspecialchars($feature['name']) ?></strong>
              <br>
              
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
          <?php endforeach; ?>
        </div>

        <div class="actions" style="margin-top: 20px;">
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