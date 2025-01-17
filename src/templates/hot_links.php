<?php if (isset($hot_links)): ?>
  <nav aria-label="Hot links" class="hot-links">
    <?php if ($hot_links[0]): ?>
      <a href="<?php echo $hot_links[0]; ?>">&lt;&lt; Previous</a>
    <?php endif; ?>

    <?php if ($hot_links[1]): ?>
      <a href="<?php echo $hot_links[1]; ?>">Next &gt;&gt;</a>
    <?php endif; ?>
  </nav>
<?php endif; ?>