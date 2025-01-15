<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  require_once __DIR__ . "/../../src/controllers/TutorialController.php";
  TutorialController::handleSetCompletions();
} else {
  http_response_code(405);
  $view = "Method not allowed.";
  $title = $view;
  $error = true;
  require_once __DIR__ . "/../../src/templates/api_response.php";
}
