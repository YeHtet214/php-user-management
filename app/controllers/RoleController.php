<?php

namespace App\Controllers;

class RoleController {
  public function index() {

    require __DIR__ . "/../../app/views/roles/list.php";
  }

  public function create() {

    require __DIR__ . "/../../app/views/roles/create.php";
  }
}