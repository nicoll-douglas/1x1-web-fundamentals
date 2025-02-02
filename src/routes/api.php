<?php

use App\Controllers\MessageController;
use App\Controllers\WebhookController;
use App\Controllers\UserController;
use App\Controllers\TutorialCompletionController;

require_once __DIR__ . "/../router.php";

// routes for the API

$router->set(
  "POST",
  "/api/messages",
  function () {
    $msgController = new MessageController();
    $view = $msgController->create();
    $view->show();
  }
);

$router->set(
  "POST",
  "/api/webhooks/github/push",
  function () {
    $whController = new WebhookController();
    $whController->githubSync();
  }
);

$router->set(
  "GET",
  "/api/me/logout",
  function () {
    if (!USER) {
      header("Location: /");
      exit;
    }
  },
  function () {
    $userController = new UserController();
    $userController->logout();
    header("Location: /");
    exit;
  }
);

$router->set(
  "GET",
  "/api/me/login/google",
  function () {
    if (USER) {
      header("Location: /tutorials");
      exit;
    }
  },
  function () {
    $userController = new UserController();
    $view = $userController->login();
    $view->show();
  }
);

$router->set(
  "DELETE",
  "/api/me",
  function () {
    if (!USER) {
      include __DIR__ . "/../views/status/unauthorized.php";
      $view->show();
    }
  },
  function () {
    $userController = new UserController();
    $view = $userController->delete();
    $view->show();
  }
);

$router->set(
  "PUT",
  "/api/me/completions",
  function () {
    if (!USER) {
      http_response_code(401);
      echo json_encode([
        "status" => "error",
        "message" => "Unauthorized.",
      ]);
      exit;
    }
  },
  function () {
    $completionController = new TutorialCompletionController();
    $result = $completionController->update() ?: "";
    echo $result;
    exit;
  }
);
