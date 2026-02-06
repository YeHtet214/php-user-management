<?php

namespace Core;

class Router
{
  protected $routes = [];

  public function get($uri, $controller)
  {
    $this->routes['GET'][$uri] = $controller;
  }

  public function post($uri, $controller)
  {
    $this->routes['POST'][$uri] = $controller;
  }

  public function delete($uri, $controller)
  {
    $this->routes['DELETE'][$uri] = $controller;
  }

  public function patch($uri, $controller)
  {
    $this->routes['PATCH'][$uri] = $controller;
  }

  public static function load($file)
  {
    $router = new static;

    require $file;

    return $router;
  }

  public function run($uri, $method)
  {
    $path = parse_url($uri, PHP_URL_PATH);

    // Check if route exists in map
    if (array_key_exists($path, $this->routes[$method])) {

      $action = $this->routes[$method][$path];
      [$controllerClass, $function] = $action;

      $controllerInstance = new $controllerClass();

      return call_user_func([$controllerInstance, $function]);
    }

    $this->notFound();
  }

  protected function notFound($code = 404)
  {
    http_response_code($code);

    echo "<h1>404 - Not Found</h1>";
    die();
  }
}