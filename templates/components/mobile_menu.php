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
        href="/about.php"
        role="menuitem"
        id="mobile-menu-first-focus">
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
        href="/auth/register.php"
        role="menuitem">
        Register
      </a>
    </li>
    <li role="presentation">
      <a
        href="/auth/login.php"
        role="menuitem"
        id="mobile-menu-last-focus">
        Login
      </a>
    </li>
  </ul>
  <script type="module" src="/assets/js/features/mobileMenu.js"></script>
</div>