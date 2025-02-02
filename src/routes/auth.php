<?php

use App\Services\Google\AppClient;
use App\Classes\View;
use App\Middleware\CsrfProtection;

require_once __DIR__ . "/../router.php";

// routes for authentication-related pages

$router->set(
  "GET",
  "/auth/sign-in",
  function () {
    if (USER) {
      header("Location: /tutorials");
      exit;
    }
  },
  function () {
    $client = new AppClient();
    $authUrl = $client->createAuthUrl();
    $view = new View("/auth/signIn.php", [
      "authUrl" => $authUrl
    ]);
    $view->setTitle("Sign In");
    $view->style("/signIn.css");
    $view->show();
  }
);

$router->set(
  "GET",
  "/auth/delete-data",
  function () {
    if (!USER) {
      include View::DIR . "/status/unauthorized.php";
      $view->show();
    }
  },
  [CsrfProtection::class, "setToken"],
  function () {
    require View::DIR . "/auth/deleteData.php";
    $view->show();
  }
);

$router->set(
  "GET",
  "/auth/goodbye",
  function () {
    require View::DIR . "/auth/goodbye.php";
    $view->show();
  }
);
