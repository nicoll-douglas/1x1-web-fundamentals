<nav class="tutorial-nav">
  <ul>
    <?php foreach ($tutorialNav as [$text, $href]): ?>
      <li>
        <a href="<?php echo $href; ?>"><?php echo $text; ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>