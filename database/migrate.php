<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Core\Database;

$pdo = Database::connect();

$migrations = glob(__DIR__ . '/migrations/*.php');
sort($migrations);

foreach ($migrations as $migration) {
    $sql = require $migration;
    echo "Running: " . basename($migration) . "\n";
    $pdo->exec($sql['up']);
    echo "✓ Complete\n";
}

echo "All migrations completed!\n"; 