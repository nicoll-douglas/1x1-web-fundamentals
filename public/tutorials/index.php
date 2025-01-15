<?php

require_once __DIR__ . "/../../src/controllers/TutorialController.php";
require_once __DIR__ . "/../../src/middleware/Authentication.php";

try {
  define("USER", Authentication::verify());

  if (USER) {
    $tutorials = TutorialController::handleGetCompletions(USER["id"]);
  } else {
    $tutorials = TutorialController::handleGetAll();
  }

  $title = "Tutorials | Jiggy's Web Fundamentals";
  $view = __DIR__ . "/../../src/views/tutorials/index.php";

  $css_hrefs = ["/assets/css/tutorial-index.css", "/assets/css/alert.css"];
  require_once __DIR__ . "/../../src/templates/layout.php";
} catch (PDOException $e) {
  $title = "Server error. Something went wrong, please try again later.";
  $view = $title;
  http_response_code(500);
  $error = true;
  require_once __DIR__ . "/../../src/templates/api_response.php";
}
