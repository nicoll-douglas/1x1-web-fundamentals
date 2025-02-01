<?php

use App\Classes\View;
use App\Middleware\CsrfProtection;
use App\Controllers\TutorialCompletionController;
use App\Controllers\TutorialController;

require_once __DIR__ . "/../router.php";

$router->set("GET", "/", function () {
  $view = new View("/home.php");
  $view->setTitle("Jiggy's Web Fundamentals");
  $view->style("/home.css");
  $view->show();
});

$router->set("GET", "/about", function () {
  $view = new View("/about.php");
  $view->setTitle("About");
  $view->show();
});

$router->set("GET", "/contact", function () {
  $view = new View("/contact.php");
  $view->setTitle("Contact");
  $view->show();
});

$router->set("GET", "/privacy", function () {
  $view = new View("/privacy.php");
  $view->setTitle("Privacy");
  $view->show();
});

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
