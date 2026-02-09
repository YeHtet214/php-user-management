<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Core\Router;


// TESTING USER CONTROLLER
use App\Controllers\UserController;

$router = Router::load(__DIR__ . "/../routes/web.php");

$router->run(
  $_SERVER["REQUEST_URI"],
  $_SERVER["REQUEST_METHOD"],
);

$user = new UserController();