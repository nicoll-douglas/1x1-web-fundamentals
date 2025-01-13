<?php

require_once __DIR__ . "/../src/middleware/Authentication.php";

if (Authentication::verify()) {
  header("Location: /tutorials/index.php");
  exit;
}

$title = "Sign In | Jiggy's Web Fundamentals";
$view = __DIR__ . "/../src/views/sign-in.php";
$css_hrefs = ["/assets/css/sign-in.css"];

require_once __DIR__ . "/../src/templates/layout.php";
