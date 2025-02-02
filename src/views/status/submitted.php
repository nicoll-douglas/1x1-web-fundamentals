<?php

use App\Classes\View;
use App\Enums\Layout;

$view = new View(
  layout: Layout::Basic,
  data: [
    "feedback" => "Successfully submitted.",
    "meta" => [
      "title" => "Success"
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