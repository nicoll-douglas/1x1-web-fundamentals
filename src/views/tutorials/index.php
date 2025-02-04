<?php

use App\Classes\RequestGlobals;

$view = RequestGlobals::$view;
$data = $view->getData();
$user = $data["user"];
$tutorialIndex = $data["tutorialIndex"];
?>

<main>
  <h1>Tutorial Index</h1>

  <?php
  for ($i = 0; $i < count($tutorialIndex); $i++):
    [
      "tutorial_name" => $tname,
      "tutorial_href" => $thref,
      "tutorial_number" => $tnum,
      "module_name" => $mname,
      "module_number" => $mnum,
    ] = $tutorialIndex[$i];
  ?>
    <?php
    // If tutorial number is first in the module, initiate section, heading and list 
    if ($tnum === 1): ?>
      <section>
        <h2><?php echo $mname; ?></h2>
        <ol class="tutorial-list">
        <?php endif; ?>

        <li>
          <a href="<?php echo $thref; ?>"><?php echo $tname; ?></a>
        </li>

        <?php
        // If there are no more tutorials in the array or the module number has changed, close section and list tags
        $nextTut = $tutorialIndex[$i + 1];
        if (!isset($nextTut) || $nextTut["module_number"] > $mnum):
        ?>
        </ol>
      </section>
    <?php endif; ?>

  <?php endfor; ?>
</main>