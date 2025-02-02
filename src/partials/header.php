<?php

use App\Classes\RequestGlobals;

$view = RequestGlobals::$view;
$data = $view->getData();
?>

<header>
  <a href="/" id="wordmark">Jiggy&apos;s Web Fundamentals</a>
  <nav id="site-nav" aria-label="Site">
    <ul>
      <?php
      require_once __DIR__ . "/../data/nav.php";
      ?>

      <?php foreach ($nav as [$text, $href]): ?>
        <li>
          <a
            class="<?php echo $href === "/tutorials" ? "link-highlight" : ""; ?>"
            href="<?php echo $href; ?>"><?php echo $text; ?></a>
        </li>
      <?php endforeach; ?>

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