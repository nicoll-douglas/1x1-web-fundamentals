<?php

use App\Middleware\CsrfProtection;
use App\Controllers\TutorialCompletionController;
use App\Controllers\TutorialController;
use App\Classes\Dbh;

require_once __DIR__ . "/../router.php";
require_once __DIR__ . "/../helpers/tutorialRouteHandler.php";

// tutorial index route
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

// dynamically fetch tutorial routes

$db = new Dbh();
$pdo = $db->connectDB();

$stmt = $pdo->query("SELECT * FROM tutorials");
$tutorials = $stmt->fetchAll(\PDO::FETCH_ASSOC);

foreach (
  $tutorials as [
    "href" => $href,
    "name" => $name,
    "number" => $number,
    "module_number" => $moduleNumber
  ]
) {
  $router->set(
    "GET",
    $href,
    tutorialRouteHandler("$href.php", $moduleNumber, $number)
  );
}
