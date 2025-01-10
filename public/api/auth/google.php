<?php

http_response_code(405);
$view = "Method not allowed.";
$title = &$view;

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  require_once __DIR__ . "/../../../src/controllers/AuthController.php";
  $view = AuthController::handleUserConsent();
}

$error = http_response_code() >= 400;
$link = ["href" => "/sign-in.php", "text" => "Back to sign in"];

require_once __DIR__ . "/../../../src/templates/api_response.php";
