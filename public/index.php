<?php

session_start();

require_once __DIR__ . "/../vendor/autoload.php";

use Core\Router;

$router = Router::load(__DIR__ . "/../routes/web.php");

$router->run(
  $_SERVER["REQUEST_URI"],
  $_SERVER["REQUEST_METHOD"],
);