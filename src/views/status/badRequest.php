<?php

use App\Classes\View;
use App\Enums\Layout;

$view = new View(
  status: 400,
  layout: Layout::Basic,
  data: [
    "feedback" => "Bad Request." . ($errorMsg ? " " . $errorMsg : ""),
    "meta" => [
      "title" => "Bad Request"
    ]
  ]
);
?>

<?php $view->startBuffering(); ?>

<?php
include __DIR__ . "/../../partials/feedback.php";
?>
<a href="/">
  Back to home
</a>

<?php $view->stopBuffering(); ?>