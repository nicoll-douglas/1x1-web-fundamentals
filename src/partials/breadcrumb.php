<p>
  <a href="/tutorials">Tutorials</a> &gt;
  <?php
  if (isset($breadcrumb)) {
    echo $breadcrumb[0] . " > " . $breadcrumb[1];
  }
  ?>
</p>