<?php

use App\Classes\RequestGlobals;

$view = RequestGlobals::$view;
$data = $view->getData();
?>

<header>
  <a href="/" id="wordmark">Jiggy&apos;s Web Fundamentals</a>
  <nav id="site-nav" aria-label="Site">
    <ul>
      <li>
        <a class="link-alt" href="/tutorials">Tutorials</a>
      </li>
      <li>
        <a href="/about">About</a>
      </li>
      <li>
        <a href="/contact">Contact</a>
      </li>
      <li>
        <a href="/privacy">Privacy</a>
      </li>
      <li>
        <?php if ($data["user"]): ?>
          <a href="/api/me/logout">Logout</a>
        <?php else: ?>
          <a href="/auth/sign-in">Sign In</a>
        <?php endif; ?>
      </li>
    </ul>
  </nav>
  <?php require_once __DIR__ . "/mobileMenu.php"; ?>
</header>