<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
  protected $table = "users";

  public function findbyEmail($email)
  {
    $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
  }

  public function findbyName($name)
  {
    $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE name = :name");
    $stmt->execute(["name" => $name]);
    return $stmt->fetch();
  }

  public function getUsersWithRole()
  {
    $sql = "
        SELECT u.name AS user_name, u.email, r.name AS role_name
        FROM users u
        JOIN roles r ON u.role_id = r.id
      ";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

}