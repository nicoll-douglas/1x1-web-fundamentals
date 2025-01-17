<?php
require_once __DIR__ . "/../middleware/Authentication.php";
require_once __DIR__ . "/../controllers/TutorialController.php";

if (!defined("USER")) {
  define("USER", Authentication::verify());
}

if (USER) {
  try {
    $completions = TutorialController::handleGetCompletions(USER["id"]);

    foreach (
      $completions as [
        "tutorial_id" => $tid,
        "is_completed" => $compl
      ]
    ) {
      if ($tid === $tutorial_id) {
        $is_completed = $compl;
        break;
      }
    }
  } catch (PDOException $e) {
  }
}
?>

<?php if (isset($is_completed)): ?>
  <?php require_once __DIR__ . "/alert.php"; ?>
  <button
    id="mark-complete-btn"
    data-id="<?php echo $tutorial_id; ?>"
    data-new-value="<?php echo $is_completed ? "0" : "1"; ?>">
    <?php echo $is_completed ? "Completed" : "Mark tutorial as completed"; ?>
  </button>
  <script src="/assets/js/features/updateOneCompletion.js" type="module" defer></script>
<?php endif; ?>