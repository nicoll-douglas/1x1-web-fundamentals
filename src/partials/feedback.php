<?php

use App\Classes\RequestGlobals;

$viewRef = RequestGlobals::$view;
$data = $viewRef->getData();
$status = $viewRef->getStatus();
?>

<p class="<?php echo $status >= 400 ? "feedback-error" : "feedback-success"; ?>">
  <?php echo $data["feedback"]; ?>
</p>