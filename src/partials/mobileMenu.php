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
    <li role="presentation">
      <a
        href="/tutorials"
        role="menuitem"
        id="mobile-menu-first-focus"
        class="link-alt">
        Tutorials
      </a>
    </li>
    <li role="presentation">
      <a
        href="/about"
        role="menuitem">
        About
      </a>
    </li>
    <li role="presentation">
      <a
        href="/contact"
        role="menuitem">
        Contact
      </a>
    </li>
    <li role="presentation">
      <a
        href="/privacy"
        role="menuitem">
        Privacy
      </a>
    </li>
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