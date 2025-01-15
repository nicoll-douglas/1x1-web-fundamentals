<main>
  <h1>Tutorial Index</h1>
  <?php if (USER): ?>
    <script src="/assets/js/handleTutorialComplete.js" defer type="module"></script>
    <form id="tutorial-completions">
    <?php endif; ?>

    <?php
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
      <?php if ($tnum === 1): ?>
        <section>
          <h2><?php echo $mname; ?></h2>
          <ol class="indent-list tutorial-list">
          <?php endif; ?>

          <li>
            <?php if (isset($compl)): ?>
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
            <?php else: ?>

              <a href="<?php echo $thref; ?>"><?php echo $tname; ?></a>

            <?php endif; ?>
          </li>

          <?php
          $next_tut = $tutorials[$i + 1];
          if (!isset($next_tut) || $next_tut["module_number"] > $mnum):
          ?>
          </ol>
        </section>
      <?php endif; ?>

    <?php endfor; ?>

    <?php if (USER): ?>
      <?php require_once __DIR__ . "/../../templates/alert.php"; ?>
      <button type="submit">Save</button>
    </form>
  <?php endif; ?>
</main>