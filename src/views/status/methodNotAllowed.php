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
?>

<?php $view->startBuffering(); ?>

<?php
include __DIR__ . "/../../partials/feedback.php";
?>
<a href="/">
  Back to home
</a>

<?php $view->stopBuffering(); ?>