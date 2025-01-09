<?php

http_response_code(404);
$error = true;
$view = "Page not found.";
$title = $view;

require_once __DIR__ . "/../src/templates/api_response.php";
