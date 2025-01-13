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
        href="/tutorials/index.php"
        role="menuitem"
        id="mobile-menu-first-focus"
        class="link-alt">
        Tutorials
      </a>
    </li>
    <li role="presentation">
      <a
        href="/about.php"
        role="menuitem">
        About
      </a>
    </li>
    <li role="presentation">
      <a
        href="/contact.php"
        role="menuitem">
        Contact
      </a>
    </li>
    <li role="presentation">
      <a
        href="/privacy.php"
        role="menuitem">
        Privacy
      </a>
    </li>
    <li role="presentation">
      <?php
      require_once __DIR__ . "/../../middleware/Authentication.php";
      if (Authentication::verify()):
      ?>
        <a
          href="/api/logout.php"
          role="menuitem"
          id="mobile-menu-last-focus">
          Logout
        </a>
      <?php else: ?>
        <a
          href="/sign-in.php"
          role="menuitem"
          id="mobile-menu-last-focus">
          Sign In
        </a>
      <?php endif; ?>
    </li>
    <script type="module" src="/assets/js/features/mobileMenu.js"></script>
  </ul>
</div>