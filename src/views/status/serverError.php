<?php

use App\Classes\View;
use App\Enums\Layout;

$view = new View(
  status: 500,
  layout: Layout::Basic,
  data: [
    "feedback" => "Server error. Something went wrong, please try again later.",
    "meta" => [
      "title" => "Server Error"
    ]
  ]
);
?>

<?php $view->startBuffering(); ?>

<?php
require __DIR__ . "/../../partials/feedback.php";
?>
<a href="/">
  Back to home
</a>

<?php $view->stopBuffering(); ?>