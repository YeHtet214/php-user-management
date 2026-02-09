<?php ob_start() ?>

<a href="/roles/create">Create Role</a>

<table class="roles-table">
    <thead>
        <tr>
            <th>Role</th>
            <th>Permissions</th>
        </tr>
    </thead>
    <tbody>
        <!-- <?php foreach ($roles as $role): ?>
            <tr>
                <td><?= htmlspecialchars($role['name']) ?></td>
                <td>
                    <ul>
                        <?php foreach (['Create', 'Read', 'Update', 'Delete'] as $permission): ?>
                            <li><?= htmlspecialchars($permission) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?> -->
        <tr>
          <td>Admin</td>
          <td>Create</td>
        </tr>
    </tbody>
</table>

<?php 
  $roleConent = ob_get_clean();

  include __DIR__ . "/../../../app/views/roles/index.php";
?>