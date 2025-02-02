<?php

use App\Middleware\CsrfProtection;
use App\Controllers\TutorialCompletionController;
use App\Controllers\TutorialController;

require_once __DIR__ . "/../../router.php";

$router->set(
  "GET",
  "/tutorials",
  function () {
    if (USER) {
      CsrfProtection::setToken();
      $completionController = new TutorialCompletionController();
      $view = $completionController->index();
      $view->script("/features/updateAllCompletions.js");
    } else {
      $tutorialController = new TutorialController();
      $view = $tutorialController->index();
    }
    $view->setTitle("Tutorial Index");
    $view->style("/tutorialIndex.css");
    $view->show();
  }
);
