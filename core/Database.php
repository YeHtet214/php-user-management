<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
  private static $pdo = null;

  public static function connect()
  {
    if (self::$pdo !== null) {
      return self::$pdo;
    }

    try {
      $dbPath = __DIR__ . "/../database/database.sqlite";

      self::$pdo = new PDO("sqlite:" . $dbPath);
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

      self::$pdo->exec('PRAGMA foreign_keys = ON;');
      self::$pdo->exec('PRAGMA journal_mode = WAL;');

      return self::$pdo;
    } catch (PDOException $e) {
      die("Database connection failed: " . $e->getMessage());
    }
  }
}

