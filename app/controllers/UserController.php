<?php

namespace App\Controllers;

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
    $users = $this->userModel->all();

    require __DIR__ . '/../../app/views/users/index.php';
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    // require __DIR__ . '/../../app/Views/users/create.php';
  }

  public function store()
  {
    $data = [
      'name' => trim($_POST['name'] ?? ''),
      'username' => trim($_POST['username'] ?? ''),
      'email' => trim($_POST['email'] ?? ''),
      'password' => $_POST['password'] ?? '',
      'role_id' => (int) ($_POST['role_id'] ?? 0),
      'phone' => trim($_POST['phone'] ?? ''),
      'address' => trim($_POST['address'] ?? ''),
      'gender' => isset($_POST['gender']) ? (int) $_POST['gender'] : null,
      'is_active' => isset($_POST['is_active']) ? 1 : 0,
    ];

    // 2. Validation Logic
    $errors = [];

    // Required Fields
    if (empty($data['name']))
      $errors[] = "Name is required.";
    if (empty($data['username']))
      $errors[] = "Username is required.";
    if (empty($data['role_id']))
      $errors[] = "Role is required.";
    if (empty($data['password']))
      $errors[] = "Password is required.";

    // Email Validation
    if (empty($data['email'])) {
      $errors[] = "Email is required.";
    } elseif (!filter_var($data['email'], filter: FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email format.";
    }

    // Unique Checks (Username & Email)
    if ($this->userModel->findByEmail($data['email'])) {
      $errors[] = "Email already exists.";
    }

    // If there are validation errors, go back
    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
      $_SESSION['old'] = $data; // Repopulate form
      header('Location: /users/create');
      exit();
    }

    // 3. Password Hashing (Critical!)
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    // 4. Insert into Database
    try {
      $this->userModel->create($data);
      $_SESSION['success'] = "User created successfully!";
      header('Location: /users');
      exit();
    } catch (\PDOException $e) {
      $_SESSION['errors'] = ["Database Error: " . $e->getMessage()];

      header('Location: /users/create');
      exit();
    }
  }

  public function edit()
  {
    if (!isset($_GET['id'])) {
      die("User ID not provided");
    }

    $user = $this->userModel->find($_GET['id']);

    if (!$user) {
      die("User not found");
    }

    require __DIR__ . '/../../app/Views/users/edit.php';
  }

  /**
   * Update the specified resource in storage.
   */
  public function update()
  {
    $id = $_POST['id'] ?? null;

    if (!$id)
      die("ID missing");

    // 1. Sanitize
    $data = [
      'name' => trim($_POST['name'] ?? ''),
      'username' => trim($_POST['username'] ?? ''),
      'email' => trim($_POST['email'] ?? ''),
      'role_id' => (int) ($_POST['role_id'] ?? 0),
      'phone' => trim($_POST['phone'] ?? ''),
      'address' => trim($_POST['address'] ?? ''),
      'gender' => isset($_POST['gender']) ? (int) $_POST['gender'] : null,
      'is_active' => isset($_POST['is_active']) ? 1 : 0,
    ];

    // 2. Validate
    $errors = [];
    if (empty($data['name']))
      $errors[] = "Name is required.";
    if (empty($data['email']))
      $errors[] = "Email is required.";

    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
      header("Location: /users/edit?id=$id");
      exit();
    }

    // 4. Update Database
    // Note: You need to implement update() in your core/Model.php
    $this->userModel->update($id, $data);

    $_SESSION['success'] = "User updated successfully!";
    header('Location: /users');
    exit();
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy()
  {
    $id = $_POST['id'] ?? null;

    if ($id) {
      $this->userModel->delete($id);
      $_SESSION['success'] = "User deleted successfully.";
    } else {
      $_SESSION['errors'] = ["Invalid ID."];
    }

    header('Location: /users');
    exit();
  }
}