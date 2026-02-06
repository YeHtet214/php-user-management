<?php

namespace App\Controllers;

class UserController
{
  public function index()
  {
    echo "Get all users";
  }

  public function store()
  {
    echo "Store user";
  }

  public function create()
  {
    echo "Create user";
  }

  public function update($id)
  {
    echo "User " . $id . " is updated";
  }

  public function destroy($id)
  {
    echo "User " . $id . " is deleted";
  }
}