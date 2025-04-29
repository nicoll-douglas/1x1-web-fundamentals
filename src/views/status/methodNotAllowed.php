<?php

use App\Classes\View;
use App\Enums\Layout;

$view = new View(
  status: 405,
  layout: Layout::Basic,
  data: [
    "feedback" => "Method not allowed.",
    "meta" => [
      "title" => "Method not allowed"
    ]
  ]
);
$view->startBuffering();
require_once __DIR__ . "/../../partials/feedback.php";
?>
<a href="/">
  Back to home
</a>
<?php
$view->stopBuffering();
