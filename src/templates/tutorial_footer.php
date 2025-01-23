<?php
require_once __DIR__ . "/../middleware/Authentication.php";
require_once __DIR__ . "/../controllers/TutorialController.php";

// check user auth if not checked
if (!defined("USER")) {
  define("USER", Authentication::verify());
}

try {
  // get tutorial fragment
  [
    "id" => $tutorial_id,
    "completed" => $is_completed,
    "previous" => $prev_tut,
    "next" => $next_tut
  ] = TutorialController::getFragment($tutorial_number, $module_number, !!USER);


  // if auth'd, add button to mark complet/incomplete + CSRF and alert
  if (USER):
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

  <?php
  // hot links if defined
  ?>
  <nav aria-label="Hot links" class="hot-links">
    <?php if (isset($prev_tut)): ?>
      <a href="<?php echo $prev_tut; ?>">&lt;&lt; Previous</a>
    <?php endif; ?>

    <?php if (isset($next_tut)): ?>
      <a href="<?php echo $next_tut; ?>">Next &gt;&gt;</a>
    <?php endif; ?>
  </nav>
<?php } catch (PDOException $e) {
} ?>