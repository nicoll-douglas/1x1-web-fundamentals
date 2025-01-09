<?php

require_once __DIR__ . "/../../src/controllers/MessageController.php";

$view = MessageController::handleRequest();
$title = $view;
$error = http_response_code() >= 400;

require_once __DIR__ . "/../../src/templates/api_response.php";
