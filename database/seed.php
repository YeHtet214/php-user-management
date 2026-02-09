<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Core\Database;

$pdo = Database::connect();

// $userMigration = glob(__DIR__ . '/migrations/001_create_users_table.php');
// $roleMigration = glob(__DIR__ . '/migrations/002_create_roles_table.php');
// sort($migrations);

try {
  // Check if 'admin' role already exists
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM roles WHERE name = ?");
  $stmt->execute(['admin']);
  $count = $stmt->fetchColumn();

  if ($count == 0) {
      $pdo->exec("INSERT INTO roles (name) VALUES ('admin')");
  }

  $pdo->exec("INSERT INTO users (name, email, password, role_id) VALUES ('Jhon', 'example@abc.com', 'user123', 1)");
} catch (PDOException $e) {
  echo "" . $e->getMessage() . " Seeding error!";
}

