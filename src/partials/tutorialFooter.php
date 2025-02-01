<?php

use App\Classes\RequestGlobals;

$view = RequestGlobals::$view;
$data = $view->getData();
?>

<?php
if ($data["user"]): ?>
  <?php require_once __DIR__ . "/saveAlert.php"; ?>
  <form id="mark-complete-form">
    <button
      data-tutorial-id="<?php echo $data["moduleNumber"] . "-" . $data["tutorialNumber"]; ?>"
      data-new-value="<?php echo $data["isCompleted"] ? "0" : "1"; ?>"
      data-csrf-token="<?php echo $_SESSION["csrfToken"]; ?>"
      type="submit">
      <?php echo $data["isCompleted"] ? "Completed" : "Mark tutorial as completed"; ?>
    </button>
  </form>
<?php endif; ?>

<nav aria-label="Hot links" class="hot-links">
  <?php if ($data["prev"]): ?>
    <a href="<?php echo $data["prev"]; ?>">&lt;&lt; Previous</a>
    |
  <?php endif; ?>
  <a href="/tutorials">Index</a>
  <?php if ($data["next"]): ?>
    |
    <a href="<?php echo $data["next"]; ?>">Next &gt;&gt;</a>
  <?php endif; ?>
</nav>