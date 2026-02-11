<?php

namespace App\Controllers;

use App\Models\Role;

class RoleController
{
  protected $roleModel;

  public function __construct()
  {
    $this->roleModel = new Role();
  }
  public function index()
  {
    $roles = $this->roleModel->all();
    $features = $this->roleModel->getAllFeatures();

    $editRole = null;
    $currentPermissions = [];

    // If Editing: Fetch Role and Grouped Permissions
    if (isset($_GET["edit_id"])) {
      $editRole = $this->roleModel->findById($_GET["edit_id"]);

      // Returns: [ feature_id => ['view', 'create'], ... ]
      $currentPermissions = $this->roleModel->getRolePermissions($_GET["edit_id"]);
    }

    require_once __DIR__ . "/../../app/views/roles/list.php";
  }

  public function create()
  {
    $errors = [];
    // POST request check the validation and DB actions
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

      $name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
      $permissions = $_POST["permissions"] ?? [];

      if (empty($name)) {
        $errors["name"] = "Role name is required";
      }

      if (empty($permissions) || !is_array($permissions)) {
        $errors["permissions"] = "At least one permission is required";
      }

      if (empty($errors)) {
        $this->roleModel->createRoleWithPermissions($name, $permissions);

        header("Location: /roles");
        exit;
      }
    }

    // for GET request
    $features = $this->roleModel->getAllFeatures() ?? [];

    require __DIR__ . "/../../app/views/roles/create.php";
  }

  public function update()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $id = $_POST['id'] ?? null;
      $name = trim($_POST['name'] ?? '');
      $permissions = $_POST['permissions'] ?? []; // [feature_id => [perms]]

      if ($id && !empty($name) && !empty($permissions)) {
        $this->roleModel->updateRoleWithPermissions($id, $name, $permissions);
      }
    }

    // Redirect back to list
    header("Location: /roles");
    exit;
  }

  public function destory()
  {
    $roleId = $_POST["id"];

    if (!empty($roleId)) {
      $this->roleModel->delete($roleId);
    }

    $roles = $this->roleModel->all();

    require_once __DIR__ . "/../../app/views/roles/list.php";
  }
}
