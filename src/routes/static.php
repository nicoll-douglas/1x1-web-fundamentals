<?php

use App\Classes\View;

require_once __DIR__ . "/../router.php";

// routes for basic pages that don't need dynamic data

$router->set("GET", "/", function () {
  require_once View::DIR . "/static/home.php";
  $view->show();
});

$router->set("GET", "/about", function () {
  require_once View::DIR . "/static/about.php";
  $view->show();
});

$router->set("GET", "/contact", function () {
  require_once View::DIR . "/static/contact.php";
  $view->show();
});

$router->set("GET", "/privacy", function () {
  require_once View::DIR . "/static/privacy.php";
  $view->show();
});
