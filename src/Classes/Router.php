<?php

declare(strict_types=1);

namespace App\Classes;

/**
 * Class to create a router for the application.
 */
class Router
{
  /**
   * The current routes set.
   * @var array<string, array<string, array<int, callable>>>
   */
  private array $routes;

  public function __construct()
  {
    $this->routes = [];
  }

  /**
   * Defines route handler functions to be executed for a route.
   * @param string $method The request method.
   * @param string $path The path of the route.
   * @param callable ...$handlers The route handler functions to be executed in order for the request.
   */
  public function set(string $method, string $path, callable ...$handlers)
  {
    $this->routes[$path][$method] = $handlers;
  }

  /**
   * Handles the incoming request with the current router configuration.
   */
  public function handleRequest()
  {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER["REQUEST_METHOD"];

    $pathHandlers = $this->routes[$path];
    if (!isset($pathHandlers)) {
      require __DIR__ . "/../views/status/notFound.php";
      $view->show();
    }

    $methodHandlers = $pathHandlers[$method];
    if (!isset($methodHandlers)) {
      require __DIR__ . "/../views/status/methodNotAllowed.php";
      $view->show();
    }

    foreach ($methodHandlers as $handler) {
      $handler();
    }
  }
}
