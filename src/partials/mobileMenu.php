<?php

use App\Classes\RequestGlobals;

$view = RequestGlobals::$view;
$data = $view->getData();
?>

<div id="mobile-menu" class="menu-container">
  <button
    aria-haspopup="menu"
    aria-controls="mobile-menu-content"
    aria-expanded="false"
    id="mobile-menu-button">
    Menu
  </button>
  <ul
    role="menu"
    id="mobile-menu-content"
    aria-labelledby="mobile-menu-button"
    class="hidden">
    <?php
    require_once __DIR__ . "/../data/nav.php";
    ?>

    <?php for ($i = 0; $i < count($nav); $i++): ?>

      <?php
      [$text, $href] = $nav[$i];
      ?>
      <li role="presentation">
        <a
          href="<?php echo $href; ?>"
          role="menuitem"
          id="<?php echo $i === 0 ? "mobile-menu-first-focus" : ""; ?>"
          class="<?php echo $href === "/tutorials" ? "link-highlight" : ""; ?>">
          <?php echo $text; ?>
        </a>
      </li>

    <?php endfor; ?>

    <li role="presentation">
      <?php if ($data["user"]): ?>
        <a
          href="/api/me/logout"
          role="menuitem"
          id="mobile-menu-last-focus">
          Logout
        </a>
      <?php else: ?>
        <a
          href="/auth/sign-in"
          role="menuitem"
          id="mobile-menu-last-focus">
          Sign In
        </a>
      <?php endif; ?>
    </li>
  </ul>
</div>