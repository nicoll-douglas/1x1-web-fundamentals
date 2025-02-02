<?php

// ini_set("display_errors", 1);
// error_reporting(E_ALL);

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../src/config/env.php";

use App\Exceptions\ExceptionHandler;
use App\Middleware\Auth;
use App\Middleware\Session;

Session::start();
define("USER", Auth::verify());

set_exception_handler([ExceptionHandler::class, "handle"]);

$routes = __DIR__ . "/../src/routes";

require_once __DIR__ . "/../src/router.php";
require_once $routes . "/static.php";
require_once $routes . "/auth.php";
require_once $routes . "/api.php";
require_once $routes . "/tutorials/index.php";
require_once $routes . "/tutorials/theWeb.php";

$router->handleRequest();
