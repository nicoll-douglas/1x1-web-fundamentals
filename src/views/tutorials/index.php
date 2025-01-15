<main>
  <h1>Tutorial Index</h1>
  <?php
  for ($i = 0; $i < count($tutorials); $i++):
    [
      "tutorial_name" => $tname,
      "tutorial_href" => $thref,
      "tutorial_number" => $tnum,
      "module_name" => $mname,
      "module_number" => $mnum,
      "is_completed" => $compl
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
                <input type="checkbox" id="<?php echo $thref; ?>" checked />
              <?php else: ?>
                <input type="checkbox" id="<?php echo $thref; ?>" />
              <?php endif; ?>

              <label for="<?php echo $thref; ?>">
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
  <button>Save</button>
</main>