<?php

use App\Classes\View;
use App\Enums\Layout;

$view = new View(
  layout: Layout::Basic,
  data: [
    "feedback" => "Data successfully deleted.",
    "meta" => [
      "title" => "Data Successfully Deleted"
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
