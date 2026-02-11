<aside class="sidebar">
    <?php
    $currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $isUsersRoute = $currentPath === '/' || strpos($currentPath, '/users') === 0;
    $isRolesRoute = strpos($currentPath, '/roles') === 0;
    ?>
    <ul>
        <li><a href="/users" class="<?= $isUsersRoute ? 'active' : '' ?>">Users</a></li>
        <li><a href="/roles" class="<?= $isRolesRoute ? 'active' : '' ?>">Roles</a></li>
    </ul>
</aside>
