<?php

use App\Classes\View;
use App\Enums\Layout;

$view = new View(
  status: 401,
  layout: Layout::Basic,
  data: [
    "feedback" => "Unauthorized. Please sign in to continue.",
    "meta" => [
      "title" => "Unauthorized"
    ]
  ]
);
$view->startBuffering();
require_once __DIR__ . "/../../partials/feedback.php";
?>
<a href="/auth/sign-in">
  Sign in
</a>
<?php
$view->stopBuffering();
