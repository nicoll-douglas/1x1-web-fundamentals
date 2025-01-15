<h1>Tutorial Index</h1>
<?php
foreach (
  $tutorials as [
    "tutorial_name" => $tname,
    "tutorial_href" => $thref,
    "tutorial_number" => $tnum,
    "module_name" => $mname,
    "is_completed" => $compl
  ]
):
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
              <input type="checkbox" id="<?php echo $thref ?>" />
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

      <?php if ($tnum === 1): ?>
      </ol>
    </section>
  <?php endif; ?>

<?php endforeach; ?>