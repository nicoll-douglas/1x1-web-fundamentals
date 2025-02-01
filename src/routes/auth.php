<?php

use App\Services\Google\AppClient;
use App\Classes\View;
use App\Middleware\CsrfProtection;

require_once __DIR__ . "/../router.php";

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
    $view = new View("/auth/deleteData.php");
    $view->setTitle("Delete Data");
    $view->script("/features/deleteData.js");
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
