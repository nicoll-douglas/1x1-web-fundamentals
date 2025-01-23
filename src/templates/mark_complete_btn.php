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
        "tutorial_number" => $tnum,
        "module_number" => $mnum,
        "tutorial_id" => $tid,
        "is_completed" => $compl
      ]
    ) {
      if ($tnum === $tutorial_number && $mnum === $module_number) {
        $is_completed = $compl;
        $tutorial_id = $tid;
        break;
      }
    }
  } catch (PDOException $e) {
  }
}
?>

<?php if (isset($is_completed)): ?>
  <?php
  require_once __DIR__ . "/alert.php";
  require_once __DIR__ . "/../middleware/CsrfProtection.php";
  $csrf_token = CsrfProtection::initiate();
  ?>
  <input name="csrf_token" value="<?php echo $csrf_token; ?>" style="display: none;" />
  <button
    id="mark-complete-btn"
    data-id="<?php echo $tutorial_id; ?>"
    data-new-value="<?php echo $is_completed ? "0" : "1"; ?>">
    <?php echo $is_completed ? "Completed" : "Mark tutorial as completed"; ?>
  </button>
  <script src="/assets/js/features/updateOneCompletion.js" type="module" defer></script>
<?php endif; ?>