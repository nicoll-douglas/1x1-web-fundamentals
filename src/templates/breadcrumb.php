<div class="breadcrumb">
  <?php
  for ($i = 0; $i < count($breadcrumb); $i++):
    if ($i === array_key_last($breadcrumb)):
  ?>
      <p><?php echo $breadcrumb[$i] ?></p>

    <?php else: ?>

      <a href="<?php echo $breadcrumb[$i]["href"] ?>">
        <?php echo $breadcrumb[$i]["name"] ?>
      </a>

      &gt;

  <?php endif;
  endfor; ?>
</div>