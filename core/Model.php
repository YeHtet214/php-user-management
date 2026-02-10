<?php

namespace Core;

abstract class Model
{
  protected $db;
  protected $table;

  public function __construct()
  {
    $this->db = Database::connect();
  }

  public function all()
  {
    $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function findById($id)
  {
    $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
  }

  public function create(array $data)
  {
    // Extract keys (columns) and values
    $columns = implode(", ", array_keys($data));

    // Create placeholders like :name, :email
    $placeholders = ":" . implode(", :", array_keys($data));

    $sql = "INSERT OR IGNORE INTO {$this->table} ($columns) VALUES ($placeholders)";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute($data);
  }

  public function delete($id)
  {
    $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
    return $stmt->execute(['id' => $id]);
  }
}