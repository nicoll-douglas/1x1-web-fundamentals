<?php

http_response_code(405);
$view = "Method not allowed.";
$title = &$view;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  require_once __DIR__ . "/../../src/controllers/MessageController.php";
  $view = MessageController::handleNewMessage();
}

$error = http_response_code() >= 400;

require_once __DIR__ . "/../../src/templates/api_response.php";
