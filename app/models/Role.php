<?php

namespace App\Models;

use Core\Model;
use Exception;

class Role extends Model
{
  protected $table = "roles";

  public function getRolePermissions($roleId)
  {
    try {
      // Select feature_id AND permission name
      $sql = "
        SELECT p.feature_id, p.name 
        FROM permissions p
        JOIN role_permissions rp ON p.id = rp.permission_id
        WHERE rp.role_id = ?
      ";

      $stmt = $this->db->prepare($sql);
      $stmt->execute([$roleId]);
      $rows = $stmt->fetchAll();

      // Group by Feature ID:
      // Result: [ 1 => ['view', 'create'], 5 => ['delete'] ]
      $grouped = [];
      foreach ($rows as $row) {
        $grouped[$row['feature_id']][] = strtolower($row['name']);
      }

      return $grouped;

    } catch (Exception $e) {
      die("Failed to fetch role permissions: " . $e->getMessage());
    }
  }

  public function createRoleWithPermissions($name, $featurePermissions)
  {
    try {
      $this->db->beginTransaction();

      // Create the Role
      $this->db->prepare("INSERT INTO roles (name) VALUES (?)")->execute([$name]);
      $roleId = $this->db->lastInsertId();

      // featurePermissios: $featureId => ['Create', 'View'...]
      foreach ($featurePermissions as $featureId => $permissions) {

        foreach ($permissions as $permName) {
          $normalizedPermission = strtolower($permName);

          $this->db->prepare("INSERT OR IGNORE INTO permissions (name, feature_id) VALUES (?, ?)")
            ->execute(params: [$normalizedPermission, $featureId]);

          // Get the Permission ID
          $stmt = $this->db->prepare("SELECT id FROM permissions WHERE name = ? AND feature_id = ? LIMIT 1");
          $stmt->execute([$normalizedPermission, $featureId]);
          $permId = $stmt->fetchColumn();

          // Link Role to Permission
          if ($permId) {
            $this->db->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)")
              ->execute([$roleId, $permId]);
          }
        }
      }

      $this->db->commit();
      return true;

    } catch (Exception $e) {
      $this->db->rollBack();
      throw $e;
    }
  }

  public function updateRoleWithPermissions($roleId, $name, $featurePermissions)
  {
    try {
      $this->db->beginTransaction();

      // Update Role Name
      $this->db->prepare("UPDATE roles SET name = ? WHERE id = ?")
        ->execute([$name, $roleId]);

      // Delete ALL existing permissions for this role
      $this->db->prepare("DELETE FROM role_permissions WHERE role_id = ?")
        ->execute([$roleId]);

      // Insert Permissions again
      foreach ($featurePermissions as $featureId => $permissions) {
        foreach ($permissions as $permName) {
          $normalizedPermission = strtolower($permName);

          $this->db->prepare("INSERT OR IGNORE INTO permissions (name, feature_id) VALUES (?, ?)")
            ->execute([$normalizedPermission, $featureId]);

          // Get Permission ID
          $stmt = $this->db->prepare("SELECT id FROM permissions WHERE name = ? AND feature_id = ? LIMIT 1");
          $stmt->execute([$normalizedPermission, $featureId]);
          $permId = $stmt->fetchColumn();

          // Link to Role
          if ($permId) {
            $this->db->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)")
              ->execute([$roleId, $permId]);
          }
        }
      }

      $this->db->commit();
      return true;

    } catch (Exception $e) {
      $this->db->rollBack();
      throw $e;
    }
  }

  public function getAllFeatures()
  {
    $features = $this->db->query("SELECT id, name FROM features")->fetchAll();

    return $features;
  }
}
