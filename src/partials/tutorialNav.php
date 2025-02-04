<nav class="tutorial-nav">
  <ul>
    <?php
    function recurse(array $link)
    {
      [
        "href" => $href,
        "text" => $text,
        "children" => $children
      ] = $link;

      echo "<li><a href='$href'>$text</a>";

      if ($children) {
        echo "<ul>";
        foreach ($children as $childLink) {
          recurse($childLink);
        }
        echo "</ul>";
      }

      echo "</li>";
    }
    ?>

    <?php
    foreach ($tutorialNav as $link) {
      recurse($link);
    }
    ?>
  </ul>
</nav>