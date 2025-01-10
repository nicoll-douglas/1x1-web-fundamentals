<?php

require_once __DIR__ . "/../src/middleware/authentication.php";

if (checkAuth()) {
  header("Location: /tutorials/index.php");
  exit;
}

$title = "Sign In | Jiggy's Web Fundamentals";
$view = __DIR__ . "/../src/views/sign-in.php";
$css_hrefs = ["/assets/css/sign-in.css"];

require_once __DIR__ . "/../src/templates/layout.php";
