<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Core\Database;

$pdo = Database::connect();

try {
  // Check if 'admin' role already exists
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM roles WHERE name = ?");
  $stmt->execute(['admin']);
  $count = $stmt->fetchColumn();

  if ($count == 0) {
      $pdo->exec("INSERT INTO roles (name) VALUES ('admin')");
  }

  // Check if user already exists
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
  $stmt->execute(['example@abc.com']);
  $count = $stmt->fetchColumn();
  if ($count == 0) {
      $pdo->exec("INSERT INTO users (name, email, password, role_id) VALUES ('Jhon', 'example@abc.com', 'user123', 1)");
  }
} catch (PDOException $e) {
  echo "" . $e->getMessage() . " Seeding error!";
}

// Adding seeding for features
$features = ['User', 'Product', 'Report', 'Sale', 'Inventory'];
foreach ($features as $feature) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM features WHERE name = ?");
    $stmt->execute([$feature]);
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        $pdo->prepare("INSERT INTO features (name) VALUES (?)")->execute([$feature]);
    }
}

// Adding seeding for permissions
$features = $pdo->query("SELECT id, name FROM features")->fetchAll(PDO::FETCH_ASSOC);
$permissions = ['view', 'create', 'update', 'delete'];

print_r($features);
print_r($permissions);

foreach ($features as $feature) {
    foreach ($permissions as $permission) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM permissions WHERE name = ? AND feature_id = ?");
        $stmt->execute([$permission, $feature['id']]);
        $count = $stmt->fetchColumn();

        echo " start";
        echo " count: " . $count;
        echo $permission;

        if ($count == 0) {
          print_r("No feature permission yet ");
          print_r($feature);
          echo "<br>";
            try {
                $pdo->prepare("INSERT OR IGNORE INTO permissions (name, feature_id) VALUES (?, ?)")->execute([$permission, $feature['id']]);
            } catch (PDOException $e) {
                // If we hit a unique constraint on feature_id, it means this schema only allows one permission per feature
                // We can log it or just skip if we already have a permission for this feature
                // if ($e->getCode() == '23000') {
                //     continue;
                // }
                throw $e;
            }
        }
    }
}

echo "Seeding Complete";
