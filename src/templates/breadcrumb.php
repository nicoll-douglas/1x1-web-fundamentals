<p>
  <a href="/tutorials/index.php">Tutorials</a> &gt;
  <?php
  if (isset($breadcrumb)) {
    echo $breadcrumb[0] . " > " . $breadcrumb[1];
  }
  ?>
</p>