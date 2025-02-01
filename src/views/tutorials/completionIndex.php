<?php

use App\Classes\RequestGlobals;

$view = RequestGlobals::$view;
$data = $view->getData();
$user = $data["user"];
$completionsIndex = $data["completionsIndex"];
?>

<main>
  <h1>Tutorial Index</h1>
  <form id="tutorial-completions">
    <input value="<?php echo $_SESSION["csrfToken"]; ?>" name="csrfToken" style="display: none;" />

    <?php
    for ($i = 0; $i < count($completionsIndex); $i++):
      [
        "tutorial_href" => $thref,
        "tutorial_name" => $tname,
        "tutorial_number" => $tnum,
        "module_name" => $mname,
        "module_number" => $mnum,
        "is_completed" => $compl,
      ] = $completionsIndex[$i];
      $formKey = "{$mnum}-{$tnum}";

    ?>
      <?php
      if ($tnum === 1): ?>
        <section>
          <h2><?php echo $mname; ?></h2>
          <ol class="indent-list tutorial-list">
          <?php endif; ?>

          <li>
            <?php
            // the key/name for the form data
            ?>
            <div class="tutorial-with-check">
              <?php if ($compl === 1): ?>
                <input type="checkbox" name="<?php echo $formKey; ?>" id="<?php echo $formKey; ?>" checked />
              <?php else: ?>
                <input type="checkbox" name="<?php echo $formKey; ?>" id="<?php echo $formKey; ?>" />
              <?php endif; ?>

              <label for="<?php echo $formKey; ?>">
                <a href="<?php echo $thref; ?>">
                  <?php echo $tname; ?>
                </a>
              </label>

            </div>
          </li>

          <?php
          // If there are no more tutorials in the array or the module number has changed, close section and list tags
          $nextTut = $completionsIndex[$i + 1];
          if (!isset($nextTut) || $nextTut["module_number"] > $mnum):
          ?>
          </ol>
        </section>
      <?php endif; ?>

    <?php endfor; ?>

    <?php require_once __DIR__ . "/../../partials/saveAlert.php"; ?>
    <button type="submit">Save</button>
  </form>
</main>