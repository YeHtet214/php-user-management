<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\User;

class UserController
{
  protected $userModel;

  public function __construct()
  {
    $this->userModel = new User();
  }

  public function index()
  {
    $usersWithRole = $this->userModel->getUsersWithRole();

    require __DIR__ . '/../../app/views/users/index.php';
  }

  public function create()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      echo "request method: ";
      print_r($_SERVER['REQUEST_METHOD']);
      $data = [
        'name' => trim($_POST['name'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'password' => $_POST['password'] ?? '',
        'role_id' => (int) ($_POST['role_id'] ?? 0),
      ];

      $errors = [];

      // Required Fields
      if (empty($data['name']))
        $errors['name'] = "Name is required.";
      if (empty($data['role_id']))
        $errors['role_id'] = "Role is required.";
      if (empty($data['password']))
        $errors['password'] = "Password is required.";

      // Email Validation
      if (empty($data['email'])) {
        $errors['email'] = "Email is required.";
      } elseif (!filter_var($data['email'], filter: FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
      }

      if ($this->userModel->findByEmail(email: $data['email'])) {
        $errors['email'] = "Email already exists.";
      }

      // If there are validation errors, go back
      if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data; // Repopulate form
        header('Location: /users/create');
        exit();
      }

      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

      // Insert into Database
      try {
        $this->userModel->create($data);
        $_SESSION['success'] = "User created successfully!";
        echo "success";
        header('Location: /users');
        exit();
      } catch (\PDOException $e) {
        $_SESSION['errors'] = ["Database Error: " . $e->getMessage()];

        echo "server error for user creation:";

        header('Location: /users/create');
        exit();
      }
    }

    // For GET request
    $roleModel = new Role;
    $roles = $roleModel->all() ?? [];

    require __DIR__ . "/../../app/views/users/create.php";
  }
}