<main>
  <h1>Tutorial Index</h1>
  <?php
  // If authenticated, initiate form and handlers
  if (USER): ?>
    <script src="/assets/js/features/updateAllCompletions.js" defer type="module"></script>
    <form id="tutorial-completions">
      <?php
      require_once __DIR__ . "/../../middleware/CsrfProtection.php";
      $csrf_token = CsrfProtection::initiate();
      ?>
      <input value="<?php echo $csrf_token; ?>" name="csrf_token" style="display: none;" />
    <?php endif; ?>

    <?php
    // Loop over the tutorials fetched from the DB or cache
    for ($i = 0; $i < count($tutorials); $i++):
      [
        "tutorial_name" => $tname,
        "tutorial_href" => $thref,
        "tutorial_number" => $tnum,
        "tutorial_id" => $tid,
        "module_name" => $mname,
        "module_number" => $mnum,
        "is_completed" => $compl,
      ] = $tutorials[$i];
    ?>
      <?php
      // If tutorial number is first in the module, initiate section, heading and list 
      if ($tnum === 1): ?>
        <section>
          <h2><?php echo $mname; ?></h2>
          <ol class="indent-list tutorial-list">
          <?php endif; ?>

          <li>
            <?php
            // If the user is authenticated, completion status will be set so add checkboxes 
            if (isset($compl)): ?>
              <div class="tutorial-with-check">

                <?php if ($compl === 1): ?>
                  <input type="checkbox" name="<?php echo $tid; ?>" id="<?php echo $tid; ?>" checked />
                <?php else: ?>
                  <input type="checkbox" name="<?php echo $tid; ?>" id="<?php echo $tid; ?>" />
                <?php endif; ?>

                <label for="<?php echo $tid; ?>">
                  <a href="<?php echo $thref; ?>">
                    <?php echo $tname; ?>
                  </a>
                </label>

              </div>

            <?php
            // Else if the user is not authenticated, just add the tutorial link
            else: ?>

              <a href="<?php echo $thref; ?>"><?php echo $tname; ?></a>

            <?php endif; ?>
          </li>

          <?php
          // If there are no more tutorials in the array or the module number has changed, close section and list tags
          $next_tut = $tutorials[$i + 1];
          if (!isset($next_tut) || $next_tut["module_number"] > $mnum):
          ?>
          </ol>
        </section>
      <?php endif; ?>

    <?php endfor; ?>

    <?php
    // If authenticated, close the form
    if (USER): ?>
      <?php require_once __DIR__ . "/../../templates/alert.php"; ?>
      <button type="submit">Save</button>
    </form>
  <?php endif; ?>
</main>