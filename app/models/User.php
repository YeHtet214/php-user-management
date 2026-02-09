<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
  protected $table = "admin_users";

  public function findbyEmail($email)
  {
    $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email");
    $stmt->execute(["email" => $email]);
    return $stmt->fetch();
  }

  public function findbyName($name)
  {
    $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE name = :name");
    $stmt->execute(["name" => $name]);
    return $stmt->fetch();
  }
}