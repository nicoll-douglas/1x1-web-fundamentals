<header>
  <a href="/" id="wordmark">Jiggy&apos;s Web Fundamentals</a>
  <nav id="site-nav" aria-label="Site">
    <ul>
      <li>
        <a class="link-alt" href="/tutorials/index.php">Tutorials</a>
      </li>
      <li>
        <a href="/about.php">About</a>
      </li>
      <li>
        <a href="/contact.php">Contact</a>
      </li>
      <li>
        <?php
        require_once __DIR__ . "/../../middleware/authentication.php";
        if (checkAuth()):
        ?>
          <a href="/api/auth/logout.php">Logout</a>
        <?php else: ?>
          <a href="/sign-in.php">Sign In</a>
        <?php endif; ?>
      </li>
    </ul>
  </nav>
  <?php require_once __DIR__ . "/mobile_menu.php"; ?>
</header>