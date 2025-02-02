<?php

use App\Classes\View;
use App\Enums\Layout;

$view = new View(
  status: 404,
  layout: Layout::Basic,
  data: [
    "feedback" => "Not found.",
    "meta" => [
      "title" => "Not Found"
    ]
  ]
);
?>

<?php $view->startBuffering(); ?>

<?php
require_once __DIR__ . "/../../partials/feedback.php";
?>
<a href="/">
  Back to home
</a>

<?php $view->stopBuffering(); ?>